<?php

class AMenuController extends AController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';
	public $defaultAction='admin';
	public $modelDisplayName='Menu';
	public $modelDisplayAttribute='Menu';

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
		$model=new AMenu;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AMenu']))
		{
			$model->attributes=$_POST['AMenu'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AMenu']))
		{
			$model->attributes=$_POST['AMenu'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->redirect(array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AMenu('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AMenu']))
			$model->attributes=$_GET['AMenu'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return AMenu the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=AMenu::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param AMenu $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='amenu-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


    /**
     * Thay đổi trạng thái.
     */
    public function actionChangeStatus()
    {
        $result = FALSE;
        $id              = Yii::app()->getRequest()->getParam('id');
        $status          = Yii::app()->getRequest()->getParam('status');
        $model           = $this->loadModel($id);
        $model->scenario = 'changeStatus';
        if ($model) {
            $model->status = $status;
            if ($model->update()) {
                $result = TRUE;
                Yii::app()->user->setFlash('success', Yii::t('adm/label', 'alert_success'));
            } else {
                $result = FALSE;
                Yii::app()->user->setFlash('error', Yii::t('adm/label', 'alert_fail'));
            }
        }
        echo CJSON::encode($result);
        exit();
    }
}
