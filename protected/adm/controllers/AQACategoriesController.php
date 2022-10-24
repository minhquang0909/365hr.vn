<?php

class AQACategoriesController extends AController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
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
        $model      = new AQACategories;
        $time       = date("Ymdhis");
        $model->sort_order  = 1;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['AQACategories'])) {
            $model->attributes      = $_POST['AQACategories'];

            if ($model->validate()) {
                if (!is_dir(Yii::app()->params->upload_dir_path . Yii::app()->params->upload_news_cate)) {
                    mkdir(Yii::app()->params->upload_dir_path . Yii::app()->params->upload_news_cate, 0777, true);
                }

                $uploadedFile = CUploadedFile::getInstance($model, 'thumbnail');
                if (isset($uploadedFile)) {
                    $uploads_dir        = str_replace('../', '', Yii::app()->params->upload_dir_path . Yii::app()->params->upload_news_cate);
                    $model->folder_path = $uploads_dir . $time . $uploadedFile;
                    $uploadedFile->saveAs(realpath(Yii::app()->getBasePath() . '/' . Yii::app()->params->upload_dir_path . Yii::app()->params->upload_news_cate . '/') . '/' . $time . $uploadedFile);
                }
                if ($model->save()) {
                    /*Language*/
                    $data_lang = $model->lang;
                    foreach ((array)$data_lang as $k => $v) {
                        $lang_detail = ALanguages::model()->find("code_name='$k'");
                        $item              = new AQACategoriesLang();
                        Languages::copyAllAttributes($item,$model);
                        foreach ((array)$v as $_field => $_value) {
                            $item->$_field     = $_value;
                        }
                        $item->category_id = $model->id;
                        $item->folder_path = $model->folder_path;
                        $item->language_id = $lang_detail->id;
                        $item->save(false);
                    }
                    /*End Language*/
                    $this->redirect(array('admin'));
                }
            }
        }

        $this->render('create', array(
            'model'      => $model,
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

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['AQACategories'])) {
            $model->attributes = $_POST['AQACategories'];

            if ($model->validate()) {
                if (!is_dir(Yii::app()->params->upload_dir_path . Yii::app()->params->upload_news_cate)) {
                    mkdir(Yii::app()->params->upload_dir_path . Yii::app()->params->upload_news_cate, 0777, true);
                }
                $uploadedFile = CUploadedFile::getInstance($model, 'file');
                if (isset($uploadedFile)) {
                    $uploads_dir        = str_replace('../', '', Yii::app()->params->upload_dir_path . Yii::app()->params->upload_news_cate);
                    $model->folder_path = $uploads_dir . $time . $uploadedFile;
                    $uploadedFile->saveAs(realpath(Yii::app()->getBasePath() . '/' . Yii::app()->params->upload_dir_path . Yii::app()->params->upload_news_cate . '/') . '/' . $time . $uploadedFile);
                }
                if ($model->save()) {
                    /*Begin Language*/
                    $data_lang = $model->lang;

                    foreach ((array)$data_lang as $k => $v) {
                        $lang_detail = ALanguages::model()->find("code_name='$k'");
                        $item = AQACategoriesLang::model()->find("category_id=$model->id and language_id=$lang_detail->id");
                        if(!$item){
                            $item              = new AQACategoriesLang();
                        }
                        Languages::copyAllAttributes($item,$model);
                        foreach ((array)$v as $_field => $_value) {
                            $item->$_field     = $_value;
                        }
                        $item->category_id = $model->id;
                        $item->folder_path = $model->folder_path;
                        $item->language_id = $lang_detail->id;
                        $item->save(false);
                    }
                    /*End Language*/

                    $this->redirect(array('admin'));
                }
            }
        }else{
            /*Load Data Lang*/
            $array_field = array('name');
            $data_lang_detail = AQACategoriesLang::model()->findAll('category_id='.$model->id);
            foreach ((array)$data_lang_detail as $k => $v) {
                $lang_detail = ALanguages::model()->findByPk($v->language_id);
                foreach ((array)$array_field as $_field) {
                    $model->lang[$lang_detail->code_name][$_field] = $v->$_field;
                }
            }
            /*End Load Data Lang*/
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
        $model->old_file = $model->folder_path;

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
        $dataProvider = new CActiveDataProvider('AQACategories');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new AQACategories('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['AQACategories']))
            $model->attributes = $_GET['AQACategories'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return AQACategories the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = AQACategories::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param ANewsCategories $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'anews-categories-form') {
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
        $model  = AQACategories::model()->findByPk($id);
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
