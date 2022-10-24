<?php

class ACommentController extends AController
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
		$model=new AComment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AComment']))
		{
			$model->attributes=$_POST['AComment'];
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

		if(isset($_POST['AComment']))
		{
			$model->attributes=$_POST['AComment'];
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
        $model = $this->loadModel($id);
        $model->delete();
        //update news commnent
        $count = AComment::model()->count('status=:status',array(
            ':status'   =>  AComment::STATUS_ACTIVE
        ));
        $newsModel = ANews::model()->findByPk($model['news_id']);
        $newsModelLang = ANews::model()->findByPk($model['news_id']);
        if($newsModel){
            $newsModel->comment_count = $count;
            $newsModel->update();
        }
        if($newsModelLang){
            $newsModelLang->comment_count = $count;
            $newsModelLang->update();
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
		$dataProvider=new CActiveDataProvider('AComment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AComment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AComment']))
			$model->attributes=$_GET['AComment'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

    /**
     * Action change status
     */
    public function actionChangeStatus()
    {
        $result = false;
        $id     = Yii::app()->getRequest()->getParam('id');
        $status = Yii::app()->getRequest()->getParam('status');
        $model  = AComment::model()->findByPk($id);
        if ($model) {
            $model->status = $status;
            if ($model->update()) {
                $result = true;
                Yii::app()->user->setFlash('success', Yii::t('adm/label', 'alert_success'));
                //update news commnent
                $count = AComment::model()->count('status=:status',array(
                    ':status'   =>  AComment::STATUS_ACTIVE
                ));
                $newsModel = ANews::model()->findByPk($model['news_id']);
                $newsModelLang = ANews::model()->findByPk($model['news_id']);
                if($newsModel){
                    $newsModel->comment_count = $count;
                    $newsModel->update();
                }
                if($newsModelLang){
                    $newsModelLang->comment_count = $count;
                    $newsModelLang->update();
                }
            } else {
                $result = false;
                Yii::app()->user->setFlash('success', Yii::t('adm/label', 'alert_fail'));
            }
        }
        echo CJSON::encode($result);
        exit();
    }
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return AComment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=AComment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param AComment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='acomment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
