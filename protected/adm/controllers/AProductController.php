<?php

    class AProductController extends AController
    {
        /**
         * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
         * using two-column layout. See 'protected/views/layouts/column2.php'.
         */
        public $layout = '//layouts/column1';

        /**
         * @return array action filters
         */
        public function filters()
        {
            return array(
                'accessControl', // perform access control for CRUD operations
                'postOnly + delete', // we only allow deletion via POST request
            );
        }

        /**
         * Specifies the access control rules.
         * This method is used by the 'accessControl' filter.
         * @return array access control rules
         */
        public function accessRules()
        {
            return array(
                array('allow', // allow authenticated users to perform 'admin' and 'view' actions
                    'actions'    => array('view', 'admin'),
                    'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"view")',
                ),
                array('allow', // allow authenticated user to perform 'create'  actions
                    'actions'    => array('create'),
                    'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"add")',
                ),
                array('allow', // allow authenticated user to perform 'update','changeStatus' actions
                    'actions'    => array('update', 'changeStatus'),
                    'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"edit")',
                ),
                array('allow', // allow authenticated user to perform 'delete' actions
                    'actions'    => array('delete'),
                    'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"del")',
                ),
                array('deny', // deny all users
                    'users' => array('*'),
                ),
            );
        }

        /**
         * Displays a particular model.
         * @param integer $id the ID of the model to be displayed
         */
        public function actionView($id)
        {
            $this->render('view', array(
                'model' => $this->loadModel($id),
            ));
        }

        /**
         * Creates a new model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         */
        public function actionCreate()
        {
            $model         = new AProduct;
            $time          = date("Ymdhis");
            $arr_tags_form = '';
            //get all tags from DB
            $model_tags         = ATags::getAllTags();
            $model->public_date = date('Y-m-d H:i:s', time());
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['AProduct'])) {
                $model->attributes = $_POST['AProduct'];
                /*Gadget*/
                $model->created_by = implode(',',$model->created_by);
                /*End Gadget*/
                /*get all tags input*/
                $tags_form = $_POST['tags_name'];
                if ($tags_form) {
                    $arr_tags_form = (explode(",", $tags_form));
                }
                //CVarDumper::dump($model->validate(),10,true);die;
                if ($model->validate()) {
                    if (!is_dir(Yii::app()->params->upload_dir_path . Yii::app()->params->upload_product_dir)) {
                        mkdir(Yii::app()->params->upload_dir_path . Yii::app()->params->upload_product_dir, 0777, true);
                    }
                    if (!is_dir(Yii::app()->params->upload_dir_path . Yii::app()->params->upload_gallery_dir)) {
                        mkdir(Yii::app()->params->upload_dir_path . Yii::app()->params->upload_gallery_dir, 0777, true);
                    }
                    $uploadedFile = CUploadedFile::getInstance($model, 'file');
                    if (isset($uploadedFile)) {
                        $uploads_dir        = str_replace('../', '', Yii::app()->params->upload_dir_path . Yii::app()->params->upload_product_dir);
                        $model->folder_path = $uploads_dir . $time . $uploadedFile;
                        $uploadedFile->saveAs(realpath(Yii::app()->getBasePath() . '/' . Yii::app()->params->upload_dir_path . Yii::app()->params->upload_product_dir . '/') . '/' . $time . $uploadedFile);
                    }
                    $model->created_date = date('Y-m-d H:i:s', time());
                    //$model->created_by   = Yii::app()->user->username;
                    if (empty($_POST['AProduct']['public_date'])) {
                        $model->public_date = date('Y-m-d H:i:s', time());
                    } else {
                        $model->public_date = date('Y-m-d H:i:s', strtotime($_POST['AProduct']['public_date']));
                    }

                    if ($model->save()) {
                        /*Gallery Files*/
                        $galleryFile = CUploadedFile::getInstances($model, 'gallery_items');
                        if (isset($galleryFile)) {
                            //CVarDumper::dump($model,10,true);die;
                            if (isset($galleryFile) && count($galleryFile) > 0) {
                                foreach ($galleryFile as $image => $uploadedFile) {
                                    $uploads_dir         = str_replace('../', '', Yii::app()->params->upload_dir_path . Yii::app()->params->upload_gallery_dir);
                                    $_file_name          = $time . CFunction::convertSpace($uploadedFile);
                                    $_file_name_save_dtb = $uploads_dir . $_file_name;
                                    $_uploaded_path_to   = realpath(Yii::app()->getBasePath() . '/' . Yii::app()->params->upload_dir_path . Yii::app()->params->upload_gallery_dir . '/') . '/' . $_file_name;
                                    if ($uploadedFile->saveAs($_uploaded_path_to)) {
                                        // add it to the main model now
                                        $img_add              = new Gallery();
                                        $img_add->title       = $model->title;
                                        $img_add->file_name   = $_file_name;
                                        $img_add->folder_path = $_file_name_save_dtb;
                                        $img_add->target_link = '#';
                                        $img_add->file_ext    = CFunction::get_file_ext($_file_name);
                                        $img_add->parent_id   = $model->id;
                                        $img_add->album_id    = '0';
                                        $img_add->status      = 1;
                                        $img_add->save(); // DONE
                                    }
                                }
                            }
                        }
                        /*End Gallery Files*/
                        /*Language*/
                        $data_lang = $model->lang;
                        foreach ((array)$data_lang as $k => $v) {
                            $lang_detail = ALanguages::model()->find("code_name='$k'");
                            $item        = new AProductLang();
                            Languages::copyAllAttributes($item, $model);
                            foreach ((array)$v as $_field => $_value) {
                                $item->$_field = $_value;
                                if ($_field == 'price') {
                                    $item->$_field = (int)$_value;
                                }
                            }

                            $item->parent_id   = $model->id;
                            $item->language_id = $lang_detail->id;

                            if (!$item->save()) {
                                $model->addError('title', CFunction::getErrorText($item->getErrors()));
                            }
                        }
                        /*End Language*/
                        $this->redirect(array('admin'));
                    }
                }
            } else {
                $model->categories_id = AProductCategories::model()->find('status=1')->id;
                $model->created_by = array_keys(CHtml::listData(AProductGadget::getAllGadget(),'id','name'));
            }
            $this->render('create', array(
                'model' => $model,
            ));
        }

        /**
         * Updates a particular model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id the ID of the model to be updated
         */
        public function actionUpdate($id)
        {
            $model           = $this->loadModel($id);
            $time            = date("Ymdhis");
            $model->old_file = $model->folder_path;

            $arr_tags_form = '';
            /*get all tags by news_id display in the selected tags */
            $tags_news        = '';
            $all_tags_by_news = ATags::getTagsNameByNewsId($id);
            if ($all_tags_by_news) {
                $tags_news = implode(', ', $all_tags_by_news);
            }

            //get all tags from DB
            $model_tags = ATags::getAllTags();

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['AProduct'])) {
                $model->attributes = $_POST['AProduct'];
                /*Gadget*/
                    $model->created_by = implode(',',$model->created_by);
                /*End Gadget*/
                /*get all tags input*/
                $tags_form = $_POST['tags_name'];
                if ($tags_form) {
                    $arr_tags_form = (explode(",", $tags_form));
                }
                if ($model->validate()) {
                    if (!is_dir(Yii::app()->params->upload_dir_path . Yii::app()->params->upload_product_dir)) {
                        mkdir(Yii::app()->params->upload_dir_path . Yii::app()->params->upload_product_dir, 0777, true);
                    }
                    if (!is_dir(Yii::app()->params->upload_dir_path . Yii::app()->params->upload_gallery_dir)) {
                        mkdir(Yii::app()->params->upload_dir_path . Yii::app()->params->upload_gallery_dir, 0777, true);
                    }
                    $uploadedFile = CUploadedFile::getInstance($model, 'file');

                    if (isset($uploadedFile)) {
                        $uploads_dir        = str_replace('../', '', Yii::app()->params->upload_dir_path . Yii::app()->params->upload_product_dir);
                        $model->folder_path = $uploads_dir . $time . $uploadedFile;
                        $uploadedFile->saveAs(realpath(Yii::app()->getBasePath() . '/' . Yii::app()->params->upload_dir_path . Yii::app()->params->upload_product_dir . '/') . '/' . $time . $uploadedFile);
                    }
                    /*Gallery Files*/
                    $galleryFile = CUploadedFile::getInstances($model, 'gallery_items');
                    if (isset($galleryFile)) {
                        //CVarDumper::dump($model,10,true);die;
                        if (isset($galleryFile) && count($galleryFile) > 0) {
                            foreach ($galleryFile as $image => $uploadedFile) {
                                $uploads_dir         = str_replace('../', '', Yii::app()->params->upload_dir_path . Yii::app()->params->upload_gallery_dir);
                                $_file_name          = $time . CFunction::convertSpace($uploadedFile);
                                $_file_name_save_dtb = $uploads_dir . $_file_name;
                                $_uploaded_path_to   = realpath(Yii::app()->getBasePath() . '/' . Yii::app()->params->upload_dir_path . Yii::app()->params->upload_gallery_dir . '/') . '/' . $_file_name;
                                if ($uploadedFile->saveAs($_uploaded_path_to)) {
                                    // add it to the main model now
                                    $img_add              = new Gallery();
                                    $img_add->title       = $model->title;
                                    $img_add->file_name   = $_file_name;
                                    $img_add->folder_path = $_file_name_save_dtb;
                                    $img_add->target_link = '#';
                                    $img_add->file_ext    = CFunction::get_file_ext($_file_name);
                                    $img_add->parent_id   = $model->id;
                                    $img_add->album_id    = '0';
                                    $img_add->status      = 1;
                                    $img_add->save(); // DONE
                                }
                            }
                        }
                    }
                    /*End Gallery Files*/
                    if (empty($_POST['AProduct']['public_date'])) {
                        $model->public_date = date('Y-m-d H:i:s', time());
                    } else {
                        $model->public_date = date('Y-m-d H:i:s', strtotime($_POST['AProduct']['public_date']));
                    }
                    if ($model->save()) {
                        /*Begin Language*/
                        $data_lang = $model->lang;

                        foreach ((array)$data_lang as $k => $v) {
                            $lang_detail = ALanguages::model()->find("code_name='$k'");
                            $item        = AProductLang::model()->find("parent_id=$model->id and language_id=$lang_detail->id");
                            if (!$item) {
                                $item = new AProductLang();
                            }
                            Languages::copyAllAttributes($item, $model);
                            foreach ((array)$v as $_field => $_value) {
                                $item->$_field = $_value;
                                if ($_field == 'price') {
                                    $item->$_field = (int)$_value;
                                }
                            }

                            $item->parent_id   = $model->id;
                            $item->language_id = $lang_detail->id;
                            $item->save();
                        }
                        /*End Language*/

                        $this->redirect(array('admin'));
                    }
                }
            } else {
                /*Load Data Lang*/
                $array_field      = array('title', 'short_des', 'full_des', 'price');
                $data_lang_detail = AProductLang::model()->findAll('parent_id=' . $model->id);
                foreach ((array)$data_lang_detail as $k => $v) {
                    $lang_detail = ALanguages::model()->findByPk($v->language_id);
                    foreach ((array)$array_field as $_field) {
                        $model->lang[$lang_detail->code_name][$_field] = $v->$_field;
                    }
                }
                /*End Load Data Lang*/
                /*Gadget*/
                $model->created_by = explode(',',$model->created_by);
                /*End Gadget*/
            }

            $this->render('update', array(
                'model'     => $model,
                'tags_news' => $tags_news
            ));
        }

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'admin' page.
         * @param integer $id the ID of the model to be deleted
         */
        public function actionDelete($id)
        {
            $model           = $this->loadModel($id);
            $model->old_file = $model->folder_path;
            /*Del Lang*/
            AProductLang::model()->deleteAll('parent_id=' . $model->id);
            /*End Del Lang*/
            /*Del image*/
            $gallery = Gallery::model()->findAll('parent_id=' . $model->id);

            if ($gallery) {
                foreach ($gallery as $row) {
                    $_del_file = '/../' . $row->folder_path;
                    if (!empty($row->folder_path) && file_exists(realpath(Yii::app()->getBasePath() . $_del_file))) {
                        $model->cleanup($_del_file);
                    }
                    $row->delete();
                }
            }
            /*End Del image*/

            $this->loadModel($id)->delete();
            $dir_old_file = '/../' . $model->old_file;
            if (!empty($model->old_file) && file_exists(realpath(Yii::app()->getBasePath() . $dir_old_file))) {
                $model->cleanup($dir_old_file);
            }

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }

        /**
         * Lists all models.
         */
        public function actionIndex()
        {
            $dataProvider = new CActiveDataProvider('AProduct');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }

        /**
         * Manages all models.
         */
        public function actionAdmin()
        {
            $model = new AProduct('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['AProduct']))
                $model->attributes = $_GET['AProduct'];

            $this->render('admin', array(
                'model' => $model,
            ));
        }

        /**
         * Returns the data model based on the primary key given in the GET variable.
         * If the data model is not found, an HTTP exception will be raised.
         * @param integer $id the ID of the model to be loaded
         * @return AProduct the loaded model
         * @throws CHttpException
         */
        public function loadModel($id)
        {
            $model = AProduct::model()->findByPk($id);
            if ($model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
            return $model;
        }

        /**
         * Performs the AJAX validation.
         * @param AProduct $model the model to be validated
         */
        protected function performAjaxValidation($model)
        {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'aproduct-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

        /**
         * Action change status
         */
        public function actionChangeStatus()
        {
            $result = false;
            $id     = Yii::app()->getRequest()->getParam('id');
            $status = Yii::app()->getRequest()->getParam('status');
            $model  = AProduct::model()->findByPk($id);
            if ($model) {
                $model->status = $status;
                if ($model->update()) {
                    $result = true;
                    Yii::app()->user->setFlash('success', Yii::t('adm/label', 'alert_success'));
                } else {
                    $result = false;
                    Yii::app()->user->setFlash('success', Yii::t('adm/label', 'alert_fail'));
                }
            }
            echo CJSON::encode($result);
            exit();
        }
    }
