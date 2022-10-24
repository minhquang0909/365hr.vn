<?php

    class NewsController extends Controller
    {
        /**
         * This is the action to handle external exceptions.
         */
        public function actionError()
        {
            if ($error = Yii::app()->errorHandler->error) {
                if (Yii::app()->request->isAjaxRequest) {
                    echo $error['message'];
                } else {
                    $this->render('error', $error);
                }
            }
        }

        /**
         * Default action
         */
        public function actionIndex()
        {
            $this->pageUrl = Yii::app()->createAbsoluteUrl('news/index');
            $page = Yii::app()->request->getParam('page',1);
            $limit = 6;
            $skip = ($page - 1)*$limit;
            $list_news = WNews::getList($skip,$limit);
            $total = isset($list_news['total'])?$list_news['total']:0;
            $list_news = isset($list_news['list_news'])?$list_news['list_news']:array();
            $baseUrl = Yii::app()->createUrl('news/index',array('page'=>$page));
            $pagination = CFunction::buildPagination(
                CFunction::removeParam($baseUrl, array('page')),
                ceil($total/$limit),
                $page,
                3
            );
            $this->render('index', array(
                'total'      => $total,
                'page'      => $page,
                'skip'      => $skip,
                'pagination'      => $pagination,
                'list_news'      => $list_news,
            ));
        } //end index

        /**
         *Action news detail
         *
         * @param $id
         */
        public function actionDetail($id)
        {
            $this->pageUrl = Yii::app()->createAbsoluteUrl('news/detail',array('id'=>$id));
            $news = News::model()->findByPk($id,'status=:status',array(
                ':status'   =>  News::NEWS_ACTIVE
            ));
            if ($news) {
                $news->views += 1;
                $news->update();
                //news lang
                $newsData = NewsLang::model()->find('parent_id=:parent_id AND language_id=:language_id', array(
                    ':parent_id' =>  $news->id,
                    ':language_id' =>  Yii::app()->session['language_id'],
                ));
                //
                $news_related = News::getRelatedNews($news['id'], $news['categories_id']);
                //comment
                $modelComment = new WComment();
                $modelComment->news_id = $id;
                if(isset($_POST['WComment']))
                {
                    $modelComment->attributes=$_POST['WComment'];
                    if($modelComment->validate())
                    {
                        $modelComment->created_date = time();
                        $modelComment->status = WComment::STATUS_INACTIVE;
                        $modelComment->save();
                        Yii::app()->user->setFlash('success', Yii::t('web/app','Thanks for your comment'));
                        //TODO, send email to admin
                        $this->redirect($this->createUrl('news/detail',array('id'=>$id)));
                        exit;
                    }
                }
                //comment list
                $page = Yii::app()->request->getParam('page',1);
                $limit = 20;
                $skip = ($page - 1)*$limit;
                $list_comment = WComment::getList($id,$skip,$limit);
                $total = isset($list_comment['total'])?$list_comment['total']:0;
                $list_comment = isset($list_comment['list_comment'])?$list_comment['list_comment']:array();

                $baseUrl = Yii::app()->createUrl('news/detail',array('id'=>$id,'page'=>$page));
                $pagination = CFunction::buildPagination(
                    CFunction::removeParam($baseUrl, array('page')),
                    ceil($total/$limit),
                    $page,
                    3
                );
                $this->render('detail', array(
                    'news'         => $news,
                    'newsData'         => $newsData,
                    'news_related'         => $news_related,
                    'modelComment'         => $modelComment,
                    'total'      => $total,
                    'page'      => $page,
                    'skip'      => $skip,
                    'pagination'      => $pagination,
                    'list_comment'      => $list_comment,
                ));
            }else{
                throw new CHttpException(404, Yii::t('web/app','The requested page does not exist'));
            }
        }


        /**
         * action Categories
         *
         * @param $id
         */
        public function actionCategories($id)
        {
            if ($id) {
                $news           = array();
                $news_top_views = array();
                $categories     = WNewsCategories::model()->findByPk($id);
                if ($categories) {
                    $this->breadcrumbs = array(
                        $categories->name,
                    );
                    $model          = new WNews();
                    $news           = $model->getNewsInCategory($categories->id, true, ($categories->parent_id == 0) ? true : false, 6);

                }
                $this->render('categories', array(
                    'categories'     => $categories,
                    'news'           => $news,
                    'news_top_views' => $news_top_views,
                ));
            }
        }
    } //end class