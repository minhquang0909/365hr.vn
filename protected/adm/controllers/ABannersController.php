<?php

    class ABannersController extends AController
    {
        /**
         * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
         * using two-column layout. See 'protected/views/layouts/column2.php'.
         */
        public $layout = '//layouts/column2';

        /**
         * @return array action filters
         */
        public function filters()
        {
            return array(
                'accessControl', // perform access control for CRUD operations
                //'postOnly + delete', // we only allow deletion via POST request
            );
        }

        /**
         * Specifies the access control rules.
         * This method is used by the 'accessControl' filter.
         *
         * @return array access control rules
         */
        public function accessRules()
        {
            return array(
                array('allow', // allow authenticated users to perform 'admin' and 'view' actions
                    'actions'    => array('view', 'admin', 'quickview'),
                    'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"view")',
                ),
                array('allow', // allow authenticated user to perform 'create'  actions
                    'actions'    => array('create'),
                    'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"add")',
                ),
                array('allow', // allow authenticated user to perform 'update','active' actions
                    'actions'    => array('update', 'active'),
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
         *
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
            $model = new ABanners;
            $time  = date("Ymdhis");

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['ABanners'])) {
                $model->attributes = $_POST['ABanners'];
                if ($model->validate()) {
                    $uploadedFile       = CUploadedFile::getInstance($model, 'folder_path');
                    $model->file_name   = $time . $uploadedFile->name;
                    $model->file_ext    = $uploadedFile->extensionName;
                    $model->folder_path = Yii::app()->params->upload_banners_dir . $time . $uploadedFile;
                    if ($model->save()) {
                        $uploadedFile->saveAs(realpath(Yii::app()->getBasePath() . '/' . Yii::app()->params->upload_banners_dir . '/') . '/' . $time . $uploadedFile);
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                }
            }

            $this->render('create', array(
                'model' => $model,
            ));
        }

        /**
         * Updates a particular model.
         * If update is successful, the browser will be redirected to the 'view' page.
         *
         * @param integer $id the ID of the model to be updated
         */

        public function actionUpdate($id)
        {
            $model             = $this->loadModel($id);
            $time              = date("Ymdhis");
            $model->old_banner = $model->folder_path;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['ABanners'])) {
                $_POST['ABanners']['folder_path'] = $model->folder_path;
                $model->attributes                = $_POST['ABanners'];
                if ($model->validate()) {
                    $uploadedFile = CUploadedFile::getInstance($model, 'folder_path');
                    if (isset($uploadedFile) && count($uploadedFile) > 0) {
                        $model->scenario    = 'update_file';
                        $model->file_name   = $time . $uploadedFile->name;
                        $model->file_ext    = $uploadedFile->extensionName;
                        $model->folder_path = Yii::app()->params->upload_banners_dir . $time . $uploadedFile;
                        $uploadedFile->saveAs(realpath(Yii::app()->getBasePath() . '/' . Yii::app()->params->upload_banners_dir . '/') . '/' . $time . $uploadedFile);
                    }
                    if ($model->save()) {
                        if (!empty($model->old_banner) && ($model->old_banner != $model->folder_path) && file_exists(realpath(Yii::app()->getBasePath() . '/' . $model->old_banner))) {
                            $model->cleanup();
                        }
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                }
            }

            $this->render('update', array(
                'model' => $model,
            ));
        }

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'admin' page.
         *
         * @param integer $id the ID of the model to be deleted
         */
        public function actionDelete($id)
        {
            $model             = $this->loadModel($id);
            $model->old_banner = $model->folder_path;

            $this->loadModel($id)->delete();
            if (!empty($model->old_banner) && file_exists(realpath(Yii::app()->getBasePath() . '/' . $model->old_banner))) {
                $model->cleanup();
            }
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }

        /**
         * Lists all models.
         */
        public function actionIndex()
        {
            $dataProvider = new CActiveDataProvider('ABanners');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }

        /**
         * Manages all models.
         */
        public function actionAdmin()
        {
            $model = new ABanners('search');
            $model->unsetAttributes(); // clear any default values
            if (isset($_GET['ABanners']))
                $model->attributes = $_GET['ABanners'];

            $this->render('admin', array(
                'model' => $model,
            ));
        }

        /**
         * Returns the data model based on the primary key given in the GET variable.
         * If the data model is not found, an HTTP exception will be raised.
         *
         * @param integer $id the ID of the model to be loaded
         *
         * @return ABanners the loaded model
         * @throws CHttpException
         */
        public function loadModel($id)
        {
            $model = ABanners::model()->findByPk($id);
            if ($model === NULL)
                throw new CHttpException(404, 'The requested page does not exist.');

            return $model;
        }

        /**
         * Performs the AJAX validation.
         *
         * @param ABanners $model the model to be validated
         */
        protected function performAjaxValidation($model)
        {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'abanners-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

        public function actionActive()
        {
            $id     = Yii::app()->getRequest()->getParam('id');
            $status = Yii::app()->getRequest()->getParam('status');

            $status_new  = ($status == 1) ? 0 : 1;
            $sql         = " UPDATE {{banners}} SET status = '" . $status_new . "' WHERE id = '" . $id . "' ";
            $excu_active = Yii::app()->db->createCommand($sql)->execute();

            if ($excu_active) {
                $arrReturn = array('status' => 1, 'msg' => Yii::t('common/Banners', 'successful'));
            } else {
                $arrReturn = array('status' => -1, 'msg' => Yii::t('common/Banners', 'unsuccessful'));
            }

            echo CJSON::encode($arrReturn);
            exit();
        }

        public function actionQuickView()
        {
            $id = Yii::app()->request->getParam('id', '');
            echo CJSON::encode(array('content' => $this->renderPartial('quickview', array(
                'model' => $this->loadModel($id),
            ), TRUE)));
        }
    }
