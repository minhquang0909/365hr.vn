<?php

    class ASystemGroupController extends AController
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
                array('allow',
                    'actions'    => array('index', 'view'),
                    'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"view")',
                ),
                array('allow',
                    'actions'    => array('update', 'permission', 'active'),
                    'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"edit")',
                ),
                array('allow',
                    'actions'    => array('create', 'permission', 'active'),
                    'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"add")',
                ),
                array('allow',
                    'actions'    => array('admin', 'delete'),
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
            $this->pageTitle = Yii::t('adm/controller', 'ASystemGroupController');

            $permission           = AGroupPermission::model()->findAll(
                'group_id = :group_id',
                array(
                    ':group_id' => $id
                )
            );
            $arrayGroupPermission = array();
            foreach ($permission as $row) {
                $arrayGroupPermission[$row['controller']] = unserialize($row['permission']);
            }
            /* get all controller */
            $arrayController = array();
            $declaredClasses = get_declared_classes();
            foreach (glob(Yii::getPathOfAlias('application.adm.controllers') . "/*Controller.php") as $controller) {
                $class             = basename($controller, ".php");
                $arrayController[] = $class;
            }
            $index = 1;
            if (is_array($arrayController)) {
                foreach ($arrayController as $item) {
                    $temp['id']   = $index;
                    $temp['name'] = $item;
                    if (isset($arrayGroupPermission[$item])) {
                        $temp['permission'] = array(
                            'view'    => in_array("view", $arrayGroupPermission[$item]) ? TRUE : FALSE,
                            'publish' => in_array("publish", $arrayGroupPermission[$item]) ? TRUE : FALSE,
                            'add'     => in_array("add", $arrayGroupPermission[$item]) ? TRUE : FALSE,
                            'edit'    => in_array("edit", $arrayGroupPermission[$item]) ? TRUE : FALSE,
                            'del'     => in_array("del", $arrayGroupPermission[$item]) ? TRUE : FALSE,
                        );
                    } else {
                        $temp['permission'] = array(
                            'view'    => FALSE,
                            'publish' => FALSE,
                            'add'     => FALSE,
                            'edit'    => FALSE,
                            'del'     => FALSE
                        );
                    }
                    $index++;
                    $rawData[] = $temp;
                }
            }

            $arrayDataProvider = new CArrayDataProvider($rawData, array(
                'id'         => 'id',
                /* 'sort'=>array(
                    'attributes'=>array(
                        'username', 'email',
                    ),
                ), */
                'pagination' => array(
                    'pageSize' => 100,
                ),
            ));

            /* get list user in group */
            $bSystemUserDataProvider = new CActiveDataProvider('ASystemUser', array(
                'criteria'   => array(
                    'condition' => 'group_id=:groupId',
                    'params'    => array(':groupId' => $id),
                ),
                'pagination' => array(
                    'pageSize' => 20,
                ),
            ));


            $this->render('view', array(
                'model'                   => $this->loadModel($id),
                'bSystemUserDataProvider' => $bSystemUserDataProvider,
                'arrayDataProvider'       => $arrayDataProvider,
            ));
        }

        /**
         * Creates a new model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         */
        public function actionCreate()
        {
            $this->pageTitle = Yii::t('adm/controller', 'ASystemGroupController');

            $model = new ASystemGroup;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['ASystemGroup'])) {
                $model->attributes = $_POST['ASystemGroup'];
                if ($model->save())
                    $this->redirect(array('view', 'id' => $model->id));
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
            $this->pageTitle = Yii::t('adm/controller', 'ASystemGroupController');

            $model = $this->loadModel($id);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['SystemGroup'])) {
                $model->attributes = $_POST['SystemGroup'];
                if ($model->save())
                    $this->redirect(array('view', 'id' => $model->id));
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
            if (Yii::app()->request->isPostRequest) {
                // we only allow deletion via POST request
                $this->loadModel($id)->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if (!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            } else
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }

        public function actionPermission()
        {
            $arrayController = array();
            $declaredClasses = get_declared_classes();
            foreach (glob(Yii::getPathOfAlias('application.adm.controllers') . "/*Controller.php") as $controller) {
                $class = basename($controller, ".php");
                //check exist group permission
                $objBGroupPermission = AGroupPermission::model()->find(array(
                    'select'    => 'permission',
                    'condition' => 'group_id = :groupId AND controller = :controller',
                    'params'    => array(
                        ':groupId'    => $_REQUEST['id'],
                        ':controller' => $class,
                    )
                ));
                if (isset($_REQUEST[$class])) {
                    if (!$objBGroupPermission) {
                        //insert
                        $bGroupPermission             = new AGroupPermission();
                        $bGroupPermission->controller = $class;
                        $bGroupPermission->group_id   = $_REQUEST['id'];
                        $bGroupPermission->permission = serialize($_REQUEST[$class]);
                        $bGroupPermission->insert();
                    } else {
                        //update
                        $objBGroupPermission->permission = serialize($_REQUEST[$class]);
                        AGroupPermission::model()->updateAll(
                            array(
                                'permission' => serialize($_REQUEST[$class])
                            ),
                            'group_id = :group_id AND controller = :controller',
                            array(
                                ':group_id'   => $_REQUEST['id'],
                                ':controller' => $class
                            )
                        );
                    }
                } else {
                    AGroupPermission::model()->deleteAll(
                        'group_id = :group_id AND controller = :controller',
                        array(
                            ':group_id'   => $_REQUEST['id'],
                            ':controller' => $class
                        )
                    );
                }
            }
            $this->redirect(array('view', 'id' => $_REQUEST['id']));
        }

        /**
         * Lists all models.
         */
        public function actionIndex()
        {
            $dataProvider = new CActiveDataProvider('ASystemGroup');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        }

        /**
         * Manages all models.
         */
        public function actionAdmin()
        {
            $this->pageTitle = Yii::t('adm/controller', 'ASystemGroupController');

            $model = new ASystemGroup('search');
            $model->unsetAttributes(); // clear any default values
            if (isset($_GET['ASystemGroup']))
                $model->attributes = $_GET['ASystemGroup'];

            $this->render('admin', array(
                'model' => $model,
            ));
        }

        /**
         * Active a system user
         */

        public function actionActive()
        {
            $id     = Yii::app()->getRequest()->getParam('id'); //var_dump($id);
            $status = Yii::app()->getRequest()->getParam('status'); //var_dump($status); exit();

            $status_new = ($status == 1) ? 0 : 1;
            $value      = ($status_new == 1) ? ('<span class="active">' . Yii::t('app', 'actived') . '</span>') : ('<span class="inactive">' . Yii::t('app', 'inactived') . '</span>');

            $excu_active = ASystemGroup::model()->updateByPk($id, array('status' => $status_new), new CDbCriteria(array('condition' => 'id = :id', 'params' => array('id' => $id))));
            //Post::model()->updateByPk($pks, new CDbCriteria(array('condition'=>'author_id = :author_id', 'params'=>array('author_id'=>$myId))));
            if ($excu_active) {
                $arrReturn = array('status' => TRUE, 'msg' => Yii::t('adm/app', 'LBL_SUCCESS'), 'value' => $value, 'stt_value' => $status_new);
            } else {
                $arrReturn = array('status' => FALSE, 'msg' => Yii::t('adm/app', 'LBL_UNSUCCESS'));
            }

            echo CJSON::encode($arrReturn);
            exit();
        }

        /**
         * Returns the data model based on the primary key given in the GET variable.
         * If the data model is not found, an HTTP exception will be raised.
         *
         * @param integer the ID of the model to be loaded
         */
        public function loadModel($id)
        {
            $model = ASystemGroup::model()->findByPk($id);
            if ($model === NULL)
                throw new CHttpException(404, 'The requested page does not exist.');

            return $model;
        }

        /**
         * Performs the AJAX validation.
         *
         * @param CModel the model to be validated
         */
        protected function performAjaxValidation($model)
        {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'bsystem-group-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

    }
