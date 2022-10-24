<?php

    class ASystemUserController extends AController
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
        public function action()
        {

        }

        public function accessRules()
        {
            return array(
                array('allow',
                    'actions' => array('changepass'),
                    'users'   => array('*'),
                ),
                array('allow',
                    'actions'    => array('admin', 'view', 'changePassword'),
                    'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"view")',
                ),
                array('allow',
                    'actions'    => array('update', 'active', 'activeAll', 'unActiveAll', 'permission', 'getFormChangePass'),
                    'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"edit")',
                ),
                array('allow',
                    'actions'    => array('create'),
                    'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"add")',
                ),
                array('allow',
                    'actions'    => array('admin', 'delete', 'deleteAll'),
                    'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"del")',
                ),
                array('deny', // deny all users
                    'users' => array('*'),
                ),
            );
        }

        public function actionChangePass(){
            $id     = Yii::app()->user->id;
            $user   = ASystemUser::model()->find('id = :id', array(':id' => $id));
            $parser = new CHtmlPurifier();

            if ($user == null) {
                Yii::app()->user->setFlash('warning', 'Không tìm thấy tài khoản');
            } else {

                $user->initialPassword = $user->password;
                if (Yii::app()->request->isPostRequest) {
                    $current_password = $parser->purify($_POST['current_password']);
                    $current_password = ASystemUser::encrypt($current_password, Yii::app()->params->hashkey);
                    $password         = $parser->purify($_POST['password']);
                    $repeat_password  = $parser->purify($_POST['repeat_password']);

                    if ($current_password != $user->initialPassword) {
                        Yii::app()->user->setFlash('error', 'Mật khẩu cũ không đúng');
                    } else if ($password != $repeat_password) {
                        Yii::app()->user->setFlash('error', 'Nhập lại mật khẩu không đúng');
                    } else if (!CFunction::checkPasswordStrength($password, 6)) {
                        Yii::app()->user->setFlash('error', 'Mật khẩu cần bảo mật hơn');
                    } else {
                        $password = ASystemUser::encrypt($password, Yii::app()->params->hashkey);
                        if($password==$user->initialPassword){
                            Yii::app()->user->setFlash('error', 'Mật khẩu này đã được dùng trước đó. Vui lòng thử lại mật khẩu khác');
                        }else{
                            ASystemUser::model()->updateByPk($id, array(
                                'password'                  => $password,
                                'last_change_password_time' => date('Y-m-d H:i:s')
                            ));
                            Yii::app()->session['must_change_password'] = false;
                            Yii::app()->user->setFlash('success', 'Đổi mật khẩu thành công');
                            $this->redirect(array('aSite/index'));
                        }
                    }
                }

                $this->render('change_user_pass', array(
                    'model' => $user
                ));
            }
        }

        public function actionChangePassword($id)
        {
            $user   = ASystemUser::model()->find('id = :id', array(':id' => $id));
            $parser = new CHtmlPurifier();

            if ($user == null) {
                Yii::app()->user->setFlash('warning', 'Không tìm thấy tài khoản');
            } else {

                $user->initialPassword = $user->password;
                if (Yii::app()->request->isPostRequest) {
                    $current_password = $parser->purify($_POST['current_password']);
                    $current_password = ASystemUser::encrypt($current_password, Yii::app()->params->hashkey);
                    $password         = $parser->purify($_POST['password']);
                    $repeat_password  = $parser->purify($_POST['repeat_password']);

                    if ($password != $repeat_password) {
                        Yii::app()->user->setFlash('error', 'Nhập lại mật khẩu không đúng');
                    } else if (!CFunction::checkPasswordStrength($password, 6)) {
                        Yii::app()->user->setFlash('error', 'Mật khẩu cần bảo mật hơn');
                    } else {
                        $password = ASystemUser::encrypt($password, Yii::app()->params->hashkey);
                        if($password==$user->initialPassword){
                            Yii::app()->user->setFlash('error', 'Mật khẩu này đã được dùng trước đó. Vui lòng thử lại mật khẩu khác');
                        }else{
                            ASystemUser::model()->updateByPk($id, array(
                                'password'                  => $password,
                                'last_change_password_time' => date('Y-m-d H:i:s')
                            ));
                            Yii::app()->session['must_change_password'] = false;
                            Yii::app()->user->setFlash('success', 'Đổi mật khẩu thành công');
                            $this->redirect(array('aSite/index'));
                        }
                    }
                }

                $this->render('_changePass', array(
                    'model' => $user
                ));
            }
        }

        /**
         * Displays a particular model.
         *
         * @param integer $id the ID of the model to be displayed
         */
        public function actionView($id)
        {
            $user = $this->loadModel($id);
            /*get group permission*/
            $permissionCache = Yii::app()->cache->get('group_per_' . $user->group_id);
            if ($permissionCache === FALSE) {
                $permission = AGroupPermission::model()->findAll(
                    'group_id = :group_id',
                    array(
                        ':group_id' => $user->group_id,
                    )
                );
                Yii::app()->cache->set('group_per_' . $user->group_id, $permission, 1000);
                $permissionCache = Yii::app()->cache->get('group_per_' . $user->group_id);
            }

            $arrayGroupPermission = array();
            foreach ($permissionCache as $row) {
                $arrayGroupPermission[$row['controller']] = unserialize($row['permission']);
            }
            /*get user permission*/
            $uerPermission       = ASystemUserPermission::model()->findAll(
                'user_id = :user_id',
                array(
                    ':user_id' => $id,
                )
            );
            $arrayUserPermission = array();
            if (is_array($uerPermission)) {
                foreach ($uerPermission as $row) {
                    $arrayUserPermission[$row['controller']] = unserialize($row['permission']);
                }
            }


            $resutUserPermission = array_merge($arrayGroupPermission, $arrayUserPermission);

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
                    if (isset($resutUserPermission[$item])) {
                        $temp['permission'] = array(
                            'view'    => in_array("view", $resutUserPermission[$item]) ? TRUE : FALSE,
                            'publish' => in_array("publish", $resutUserPermission[$item]) ? TRUE : FALSE,
                            'add'     => in_array("add", $resutUserPermission[$item]) ? TRUE : FALSE,
                            'edit'    => in_array("edit", $resutUserPermission[$item]) ? TRUE : FALSE,
                            'del'     => in_array("del", $resutUserPermission[$item]) ? TRUE : FALSE,
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
                    'pageSize' => 2,
                ),
            ));


            $this->render('view', array(
                'model'             => $this->loadModel($id),
                'arrayDataProvider' => $arrayDataProvider,
            ));
        }

        /**
         * Creates a new model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         */
        public function actionCreate()
        {
            $this->pageTitle = Yii::t('adm/controller', 'ASystemUserController');

            $model = new ASystemUser;

            // Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation($model);

            if (isset($_POST['ASystemUser'])) { //var_dump($_POST['SystemUser']); exit();
                $model->attributes      = $_POST['ASystemUser'];
                $model->id              = CFunction::GUID();
                $model->created_date    = date("ymdHis");
                $model->password        = SystemUser::encrypt($_POST['ASystemUser']['password'], Yii::app()->params->hashkey);
                $model->confirmPassword = SystemUser::encrypt($_POST['ASystemUser']['confirmPassword'], Yii::app()->params->hashkey);
                $model->phonenumber     = $_POST['ASystemUser']['phonenumber'];

                if (!CFunction::checkPasswordStrength($_POST['ASystemUser']['password'], 8)) {
                    Yii::app()->user->setFlash('warning', 'Yêu cầu Mật khẩu phải chứa ít nhất 1 kí tự thường, ít nhất 1 kí tự HOA, ít nhất 1 chữ số và ít nhất 1 kí tự đặc biệt.');
                    $this->redirect(array('aSystemUser/create'));
                    exit();
                }
                if ($model->save()) {
                    Yii::app()->user->setFlash('success', Yii::t('adm/user', 'success_user') . " <b>" . CHtml::encode($model->username) . "</b>");
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
         *
         * @param integer $id the ID of the model to be updated
         */
        public function actionUpdate($id)
        {

            $this->pageTitle = Yii::t('adm/controller', 'ASystemUserController');

            $model = $this->loadModel($id);

            // Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation($model);
            if (isset($_POST['ASystemUser'])) {
                $model->attributes      = $_POST['ASystemUser'];
                $model->confirmPassword = $model->password;
                $model->created_date    = date("ymdHis");
                $model->status          = $_POST['ASystemUser']['status'];
                $model->email           = $_POST['ASystemUser']['email'];
                $model->phonenumber     = $_POST['ASystemUser']['phonenumber'];
                $model->group_id        = $_POST['ASystemUser']['group_id'];

                if ($model->save()) {
                    Yii::app()->user->setFlash('success', "Bạn đã cập nhật thành công <b>" . CHtml::encode($model->username) . "</b>");

                    $this->redirect(array('admin'));
                }
            }

            $this->render('update', array(
                'model' => $model,
            ));
        }

        /**
         * Active a system user
         */

        public function actionActive()
        {
            $id         = Yii::app()->getRequest()->getParam('userId');
            $status     = Yii::app()->getRequest()->getParam('status');
            $status_new = ($status == 1) ? 0 : 1;
            $value      = ($status_new == 1) ? ('<span class="active">' . Yii::t('app', 'actived') . '</span>') : ('<span class="inactive">' . Yii::t('app', 'inactived') . '</span>');

            $excu_active = SystemUser::model()->updateByPk($id, array('status' => $status_new), new CDbCriteria(array('condition' => 'id = :id', 'params' => array('id' => $id))));
            if ($excu_active) {
                $arrReturn = array('status' => TRUE, 'msg' => Yii::t('adm/app', 'LBL_SUCCESS'), 'value' => $value, 'stt_value' => $status_new);
            } else {
                $arrReturn = array('status' => FALSE, 'msg' => Yii::t('adm/app', 'LBL_UNSUCCESS'));
            }

            echo CJSON::encode($arrReturn);
            exit();
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

        /**
         * Lists all models.
         */
        /*
       public function actionIndex()
       {
           $dataProvider=new CActiveDataProvider('SystemUser');
           $this->render('index',array(
               'dataProvider'=>$dataProvider,
           ));
       }
       */
        /**
         * Manages all models.
         */
        public function actionAdmin()
        {
            $this->pageTitle = Yii::t('adm/controller', 'ASystemUserController');
            $model           = new SystemUser('search');
            $model->unsetAttributes(); // clear any default values
            if (isset($_GET['ASystemUser']))
                $model->attributes = $_GET['ASystemUser'];

            $this->render('admin', array(
                'model' => $model,
            ));
        }

        /**
         * Returns the data model based on the primary key given in the GET variable.
         * If the data model is not found, an HTTP exception will be raised.
         *
         * @param integer the ID of the model to be loaded
         */
        public function loadModel($id)
        {
            $model = ASystemUser::model()->findByPk($id);
            if ($model === NULL)
                throw new CHttpException(404, 'The requested page does not exist.');

            return $model;
        }

        public function actionActiveAll()
        {
            $ids             = $_REQUEST['ids'];
            $status          = $_REQUEST['status'];
            $crit            = new CDbCriteria();
            $crit->condition = "id IN ($ids)";
            $models          = SystemUser::model()->findAll($crit);
            foreach ($models as $model) {
                $model->status = $status;
                $model->update();
            }
            Yii::app()->user->setFlash('success', "Successfull");
            $this->redirect(Yii::app()->request->urlReferrer);
        }

        public function actionDeleteAll()
        {
            $ids             = $_REQUEST['ids'];
            $crit            = new CDbCriteria();
            $crit->condition = "id IN ($ids)";
            SystemUser::model()->deleteAll($crit);
            Yii::app()->user->setFlash('success', "Ðã xóa thành công");
            $this->redirect(Yii::app()->request->urlReferrer);
        }

        /**
         * Performs the AJAX validation.
         *
         * @param CModel the model to be validated
         */
        protected function performAjaxValidation($model)
        {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'system-user-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

        public function actionPermission()
        {
            $user = $this->loadModel($_REQUEST['id']);
            /*get group permission*/
            $permission           = AGroupPermission::model()->findAll(
                'group_id = :group_id',
                array(
                    ':group_id' => $user->group_id,
                )
            );
            $arrayGroupPermission = array();
            foreach ($permission as $row) {
                $arrayGroupPermission[$row['controller']] = unserialize($row['permission']);
            }


            $arrayController = array();
            $declaredClasses = get_declared_classes();
            foreach (glob(Yii::getPathOfAlias('application.adm.controllers') . "/*Controller.php") as $controller) {
                $class = basename($controller, ".php");
                //check exist user permission
                $objBSystemUserPermission = ASystemUserPermission::model()->find(array(
                    'select'    => 'permission',
                    'condition' => 'user_id = :userId AND controller = :controller',
                    'params'    => array(
                        ':userId'     => $_REQUEST['id'],
                        ':controller' => $class,
                    )
                ));
                if (isset($_REQUEST[$class])) {
                    if ($objBSystemUserPermission) {
                        if (unserialize($objBSystemUserPermission->permission) === $_REQUEST[$class]) {

                        } else {
                            //update
                            ASystemUserPermission::model()->updateAll(
                                array(
                                    'permission' => serialize($_REQUEST[$class])
                                ),
                                'user_id = :user_id AND controller = :controller',
                                array(
                                    ':user_id'    => $_REQUEST['id'],
                                    ':controller' => $class
                                )
                            );
                        }
                    } else {
                        /*get user permission*/
                        $uerPermission       = ASystemUserPermission::model()->findAll(
                            'user_id = :user_id',
                            array(
                                ':user_id' => $_REQUEST['id'],
                            )
                        );
                        $arrayUserPermission = array();
                        if (is_array($uerPermission)) {
                            foreach ($uerPermission as $row) {
                                $arrayUserPermission[$row['controller']] = unserialize($row['permission']);
                            }
                        }
                        if (isset($arrayUserPermission[$class]) && ($arrayUserPermission[$class] === $_REQUEST[$class])) {

                        } else {
                            //insert
                            $bSystemUserPermission             = new ASystemUserPermission();
                            $bSystemUserPermission->controller = $class;
                            $bSystemUserPermission->user_id    = $_REQUEST['id'];
                            $bSystemUserPermission->permission = serialize($_REQUEST[$class]);
                            $bSystemUserPermission->insert();
                        }
                    }
                } else {
                    if (isset($arrayGroupPermission[$class])) {
                        if (!$objBSystemUserPermission) {
                            $bSystemUserPermission             = new ASystemUserPermission();
                            $bSystemUserPermission->controller = $class;
                            $bSystemUserPermission->user_id    = $_REQUEST['id'];
                            $bSystemUserPermission->permission = serialize(array());
                            $bSystemUserPermission->insert();
                        } else {
                            ASystemUserPermission::model()->updateAll(
                                array(
                                    'permission' => serialize(array())
                                ),
                                'user_id = :user_id AND controller = :controller',
                                array(
                                    ':user_id'    => $_REQUEST['id'],
                                    ':controller' => $class
                                )
                            );
                        }
                    } else {
                        $aSystemUserPermission = ASystemUserPermission::model()->find(
                            'user_id = :user_id AND controller = :controller',
                            array(
                                ':user_id'    => $_REQUEST['id'],
                                ':controller' => $class
                            )

                        );
                        if ($aSystemUserPermission === NULL) {
                            $aSystemUserPermission             = new ASystemUserPermission;
                            $aSystemUserPermission->user_id    = $_REQUEST['id'];
                            $aSystemUserPermission->controller = $class;
                            $aSystemUserPermission->permission = serialize(array());
                            $aSystemUserPermission->save();
                        } else {
                            ASystemUserPermission::model()->updateAll(
                                array(
                                    'permission' => serialize(array())
                                ),
                                'user_id = :user_id AND controller = :controller',
                                array(
                                    ':user_id'    => $_REQUEST['id'],
                                    ':controller' => $class
                                )
                            );
                        }

                    }
                }

            }
            Yii::app()->user->setFlash('success', "Bạn đã sửa quyền thành công");
            $this->redirect(array('view', 'id' => $_REQUEST['id']));
        }

        public function actionGetFormChangePass($id){
            $model = $this->loadModel($id);
            if (isset($_POST['ASystemUser'])) {
                $id              = $_POST['ASystemUser']['id'];
                $password        = $_POST['ASystemUser']['password'];
                $confirmPassword = $_POST['ASystemUser']['confirmPassword'];
                $user = ASystemUser::model()->findByPk($id);
                if ($user) {
                    //CVarDumper::dump($user,10,true);die;
                    if ($password != '' && $confirmPassword != '' && $password==$confirmPassword) {
                        $user->password        = SystemUser::encrypt($password, Yii::app()->params->hashkey);
                        $user->confirmPassword = SystemUser::encrypt($confirmPassword, Yii::app()->params->hashkey);
                        if ($user->save()) {
                            Yii::app()->user->setFlash('success', "Bạn đã cập nhật thành công <b>" . CHtml::encode($user->username) . "</b>");
                            $this->redirect(array('admin'));
                        }
                    }
                    else{
                        Yii::app()->user->setFlash('success', "Bạn không thể cập nhật mật khẩu cho <b>" . CHtml::encode($user->username) . "</b>");
                        $this->redirect(array('admin'));
                    }
                }
            }
            $model->password='';
            $this->render('_changePass',array('model'=>$model));
        }

    }

?>