<?php

    class GalleryController extends Controller
    {

        public $layout = '/layouts/gallery_layout';

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
            $model             = new WAlbum();
            $data_list         = $model->getDataHomePage();
            $this->breadcrumbs = array(
                'Gallery',
            );
            $this->render('index', array(
                'data_list' => $data_list,
            ));
        } //end index

        /**
         * action Categories
         *
         * @param $id
         */
        public function actionCategories($id)
        {
            if ($id) {
                $news           = array();
                $categories     = WAlbum::model()->findByPk($id);
                if ($categories) {
                    $this->breadcrumbs = array(
                        $categories->title,
                    );
                    $model             = new WGallery();
                    $data_list              = $model->getDataInCategory($categories->id, true, false, 12);
                }
                $this->render('categories', array(
                    'categories'     => $categories,
                    'data_list'           => $data_list,

                ));
            }
        }
    } //end class