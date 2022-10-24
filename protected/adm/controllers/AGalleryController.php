<?php

    class AGalleryController extends AController
    {
        /**
         * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
         * using two-column layout. See 'protected/views/layouts/column2.php'.
         */
        public $layout = '//layouts/column1';
        public $defaultAction = 'admin';
        public $modelDisplayName = 'AGallery';
        public $modelDisplayAttribute = 'AGallery';

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
                    'actions'    => array('admin'),
                    'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"view")',
                ),
                array('allow', // allow authenticated user to perform 'create'  actions
                    'actions'    => array('create'),
                    'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"add")',
                ),
                array('allow', // allow authenticated user to perform 'update','changeStatus' actions
                    'actions'    => array('update'),
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
            $this->redirect(array('update', 'id' => $id));
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
            $model = new AGallery;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['AGallery'])) {
                $model->attributes = $_POST['AGallery'];
                $time              = date("Ymdhis");
                /*Gallery Files*/
                $galleryFile = CUploadedFile::getInstances($model, 'gallery_items');
                if (isset($galleryFile)) {
                    if (isset($galleryFile) && count($galleryFile) > 0) {
                        foreach ($galleryFile as $image => $uploadedFile) {
                            $uploads_dir         = str_replace('../', '', Yii::app()->params->upload_dir_path . Yii::app()->params->upload_gallery_dir);
                            $_file_name          = $time . CFunction::convertSpace($uploadedFile);
                            $_file_name_save_dtb = $uploads_dir . $_file_name;
                            $_uploaded_path_to   = realpath(Yii::app()->getBasePath() . '/' . Yii::app()->params->upload_dir_path . Yii::app()->params->upload_gallery_dir . '/') . '/' . $_file_name;
                            if ($uploadedFile->saveAs($_uploaded_path_to)) {
                                // add it to the main model now
                                $img_add              = new AGallery();
                                $img_add->title       = $model->title;
                                $img_add->file_name   = $_file_name;
                                $img_add->folder_path = $_file_name_save_dtb;
                                $img_add->target_link = '#';
                                $img_add->file_ext    = CFunction::get_file_ext($_file_name);
                                $img_add->parent_id   = $model->parent_id;
                                $img_add->album_id    = $model->album_id;
                                $img_add->status      = 1;
                                if ($img_add->save()) {
                                    //Pass to validate
                                    $model->folder_path = $img_add->folder_path;
                                    $model->file_ext    = $img_add->file_ext;
                                    $model->file_name   = $img_add->file_name;
                                }; // DONE
                            }
                        }
                    }
                }
                /*End Gallery Files*/
                if ($model->validate()) {
                    Yii::app()->user->setFlash('success', 'Tạo mới ảnh thành công');
                    $this->redirect(array('admin'));
                }
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
            $model = $this->loadModel($id);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['AGallery'])) {
                $model->attributes = $_POST['AGallery'];
                $time              = date("Ymdhis");
                /*Gallery Files*/
                $galleryFile = CUploadedFile::getInstances($model, 'gallery_items');

                if (isset($galleryFile)) {
                    if (isset($galleryFile) && count($galleryFile) > 0) {
                        $count = 0;
                        foreach ($galleryFile as $image => $uploadedFile) {
                            $uploads_dir         = str_replace('../', '', Yii::app()->params->upload_dir_path . Yii::app()->params->upload_gallery_dir);
                            $_file_name          = $time . CFunction::convertSpace($uploadedFile);
                            $_file_name_save_dtb = $uploads_dir . $_file_name;
                            $_uploaded_path_to   = realpath(Yii::app()->getBasePath() . '/' . Yii::app()->params->upload_dir_path . Yii::app()->params->upload_gallery_dir . '/') . '/' . $_file_name;

                            if ($uploadedFile->saveAs($_uploaded_path_to)) {
                                if ($count == 0) {
                                    $model->folder_path = $_file_name_save_dtb;
                                    $model->file_name   = $_file_name;
                                    $model->file_ext    = CFunction::get_file_ext($_file_name);;
                                    $model->save();
                                } else {
                                    // add it to the main model now
                                    $img_add              = new AGallery();
                                    $img_add->title       = $model->title;
                                    $img_add->file_name   = $_file_name;
                                    $img_add->folder_path = $_file_name_save_dtb;
                                    $img_add->target_link = '#';
                                    $img_add->file_ext    = CFunction::get_file_ext($_file_name);
                                    $img_add->parent_id   = $model->parent_id;
                                    $img_add->album_id    = $model->album_id;
                                    $img_add->status      = 1;
                                    if ($img_add->save()) {
                                        //Pass to validate
                                      /*  $model->folder_path = $img_add->folder_path;
                                        $model->file_ext    = $img_add->file_ext;
                                        $model->file_name   = $img_add->file_name;*/
                                    }; // DONE
                                }
                            }

                            $count++;
                        }
                    }
                }

                if ($model->save()) {
                    Yii::app()->user->setFlash('success', 'Cập nhật ảnh thành công');
                    $this->redirect(array('admin'));
                }
            }

            $this->render('update', array(
                'model' => $model,
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
            $model->delete();
            $_del_file = '/../' . $model->folder_path;
            if (!empty($model->folder_path) && file_exists(realpath(Yii::app()->getBasePath() . $_del_file))) {
                @unlink(realpath(Yii::app()->getBasePath() . $_del_file));
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
            $dataProvider = new CActiveDataProvider('AGallery');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }
        /**
         * Manages all models.
         */
        public function actionAdmin()
        {
            $model = new AGallery('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['AGallery']))
                $model->attributes = $_GET['AGallery'];

            $this->render('admin', array(
                'model' => $model,
            ));
        }

        /**
         * Returns the data model based on the primary key given in the GET variable.
         * If the data model is not found, an HTTP exception will be raised.
         * @param integer $id the ID of the model to be loaded
         * @return AGallery the loaded model
         * @throws CHttpException
         */
        public function loadModel($id)
        {
            $model = AGallery::model()->findByPk($id);
            if ($model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
            return $model;
        }

        /**
         * Performs the AJAX validation.
         * @param AGallery $model the model to be validated
         */
        protected function performAjaxValidation($model)
        {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'agallery-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }
    }
