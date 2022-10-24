<?php

class ARecruitmentStepController extends AController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
    public $defaultAction = 'admin';
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ARecruitmentStep();
		$time  = date("Ymdhis");
		$model->public_date = date('Y-m-d H:i:s', time());
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ARecruitmentStep']))
		{
			$model->attributes=$_POST['ARecruitmentStep'];
            if ($model->validate()) {
                $model->created_date = date('Y-m-d H:i:s', time());
                $model->created_by = Yii::app()->user->username;
                if(empty($_POST['ARecruitmentStep']['public_date'])){
                    $model->public_date = date('Y-m-d H:i:s', time());
                }else{
                    $model->public_date = date('Y-m-d H:i:s', strtotime($_POST['AQA']['public_date']));
                }
                
                if ($model->save()) {
                    /*Language*/
                    $data_lang = $model->lang;
                    foreach ((array)$data_lang as $k => $v) {
                        $lang_detail = ALanguages::model()->find("code_name='$k'");
                        $item        = new ARecruitmentStepLang();
                        Languages::copyAllAttributes($item, $model);
                        foreach ((array)$v as $_field => $_value) {
                            $item->$_field = $_value;
                        }

                        $item->parent_id   = $model->id;
                        $item->language_id = $lang_detail->id;

                        try{
                            $item->save(false);
                        }catch (Exception $ex){
                            Yii::app()->user->setFlash('error',$ex->getMessage());
                        }
                    }

                    /*End Language*/
                    $this->redirect(array('admin'));
                }
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        $time  = date("Ymdhis");
        $model->old_file = $model->folder_path;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ARecruitmentStep']))
		{
			$model->attributes=$_POST['ARecruitmentStep'];
            if ($model->validate()) {
                if(empty($_POST['ARecruitmentStep']['public_date'])){
                    $model->public_date = date('Y-m-d H:i:s', time());
                }else{
                    $model->public_date = date('Y-m-d H:i:s', strtotime($_POST['AQA']['public_date']));
                }
                if ($model->save()) {
                    /*Begin Language*/
                    $data_lang = $model->lang;

                    foreach ((array)$data_lang as $k => $v) {
                        $lang_detail = ALanguages::model()->find("code_name='$k'");
                        $item = ARecruitmentStepLang::model()->find("parent_id=$model->id and language_id=$lang_detail->id");
                        if(!$item){
                            $item              = new ARecruitmentStepLang();
                        }
                        Languages::copyAllAttributes($item,$model);
                        foreach ((array)$v as $_field => $_value) {
                            $item->$_field     = $_value;
                        }
                        $item->parent_id = $model->id;
                        $item->language_id = $lang_detail->id;
                        $item->save(false);
                    }
                    /*End Language*/

                    $this->redirect(array('admin'));
                }
            }
		} else {
            /*Load Data Lang*/
            $array_field      = array('question', 'answer','short_desc');
            $data_lang_detail = ARecruitmentStepLang::model()->findAll('parent_id=' . $model->id);
            foreach ((array)$data_lang_detail as $k => $v) {
                $lang_detail = ALanguages::model()->findByPk($v->language_id);
                foreach ((array)$array_field as $_field) {
                    $model->lang[$lang_detail->code_name][$_field] = $v->$_field;
                }
            }
            /*End Load Data Lang*/
        }

		$this->render('update',array(
			'model'=>$model,
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
        $dir_old_file = '/../'.$model->old_file;
        if (!empty($model->old_file) && file_exists(realpath(Yii::app()->getBasePath() . $dir_old_file))) {
            $model->cleanup($dir_old_file);
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('AStaticPage');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ARecruitmentStep('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ARecruitmentStep'])) {
            $model->attributes = $_GET['ARecruitmentStep'];
        }

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ANews the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ARecruitmentStep::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ANews $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='anews-form')
		{
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
		$id = Yii::app()->getRequest()->getParam('id');
		$status = Yii::app()->getRequest()->getParam('status');
		$model = ARecruitmentStep::model()->findByPk($id);
		if ($model) {
            $model->status = $status;
            if ($model->update()) {
                $result = TRUE;
                Yii::app()->user->setFlash('success', Yii::t('adm/label','alert_success'));
            }else{
                $result = FALSE;
                Yii::app()->user->setFlash('success', Yii::t('adm/label','alert_fail'));
            }
		}
		echo CJSON::encode($result);
        exit();
	}
}
