<?php

    class ProductController extends Controller
    {

        public $layout = '/layouts/main';

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
            $model          = new WProduct();
            $list_news      = $model->getNewsOfCategoryInHomepage();
            $news_top_views = $model->getListNewsByTopViews();
            $this->render('index', array(
                'list_news'      => $list_news,
                'news_top_views' => $news_top_views,
            ));
        } //end index

        /**
         *Action news detail
         *
         * @param $id
         */
        public function actionDetail($id)
        {
            $model        = new WProduct();
            $news         = $model->getNewsDetails($id);
            $news_related = '';
            $tags         = '';
            $category = '';
            if ($news) {
                $news->views += 1;
                $news->update();
                $news_related = $model->getNewsRelated($news['id'], $news['categories_id'], $news['public_date']);
                $tags         = $model->getAllTagsByNewsId($news['id']);
                $category = WProductCategories::model()->findByPk($news['categories_id']);
            }
            $this->render('detail', array(
                'news'         => $news,
                'news_related' => $news_related,
                'tags'         => $tags,
                'category'         => $category,
            ));
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
                $categories     = WProductCategories::model()->findByPk($id);
                if ($categories) {
                    $this->breadcrumbs = array(
                        $categories->name,
                    );
                    $model          = new WProduct();
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