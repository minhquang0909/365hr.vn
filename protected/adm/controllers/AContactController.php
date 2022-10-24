<?php

class AContactController extends AController
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
                'actions'    => array('view', 'admin'),
                'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"view")',
            ),
            array('allow', // allow authenticated user to perform 'create'  actions
                'actions'    => array('create','reply'),
                'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"add")',
            ),
            array('allow', // allow authenticated user to perform 'update','changeStatus' actions
                'actions'    => array('update', 'changeStatus'),
                'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"edit")',
            ),
            array('allow', // allow authenticated user to perform 'delete' actions
                'actions'    => array('delete','deleteAll'),
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
		$model=new AContact;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AContact']))
		{
			$model->attributes=$_POST['AContact'];
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

		if(isset($_POST['AContact']))
		{
			$model->attributes=$_POST['AContact'];
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

	public function actionDeleteAll(){
	    $ids = Yii::app()->request->getPost('ids');
	    $status = -1; $message = 'Unkown error';
	    if(is_array($ids) && count($ids) > 0){
            $ids_string = '';
	        foreach ($ids as $id){
                $ids_string.= ","."'".$id."'";
            }
            $ids_string = trim($ids_string,",");
            $sql = "DELETE FROM {{contact}} WHERE `id` IN (".$ids_string.")";
            $conn = Yii::app()->db;
            $command = $conn->createCommand($sql);
            $rs = $command->execute();
            if($rs){
                $status = 1;
                $message = 'Xóa liên hệ thành công';
                Yii::app()->user->setFlash('success',$message);
            }else{
                $message = 'Đã có lỗi xảy ra vui lòng thử lại sau';
            }
        }else{
	        $message = 'Vui lòng chọn ít nhất liên hệ để xóa';
        }
        echo CJSON::encode(array(
            'status'    =>  $status,
            'message'   =>  $message
        ));
    }
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('AContact');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AContact('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AContact']))
			$model->attributes=$_GET['AContact'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionReply($id){
        $model = $this->loadModel($id);
        if($model===null) {
            throw new CHttpException(404, 'Liên hệ không tồn tại');
        }
        $title = $content = '';
        $email = $model->email;
        $error = '';
        if(Yii::app()->request->isPostRequest){
            $email = $_POST['email'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            if($email==""){
                $error = "Vui lòng nhập email người nhận";
            }else if(!CFunction::isEmail($email)){
                $error = "Email không đúng định dạng";
            } else if($title==""){
                $error = "Vui lòng nhập tiêu đề";
            }else if($content==""){
                $error = "Vui lòng nhập nội dung";
            }else{
                try{
                    $from = (isset($this->site_config['email_name'])?$this->site_config['email_name']:"");
                    $views_layout_path='adm.views.layouts';
                    //
                    $email_config = array(
                        'email_host'    =>  isset($this->site_config['email_host'])?$this->site_config['email_host']:'',
                        'email_username'    =>  isset($this->site_config['email_username'])?$this->site_config['email_username']:'',
                        'email_password'    =>  isset($this->site_config['email_password'])?$this->site_config['email_password']:'',
                        'email_port'    =>  isset($this->site_config['email_port'])?$this->site_config['email_port']:'',
                        'email_type'    =>  isset($this->site_config['email_type'])?$this->site_config['email_type']:'',
                    );
                    $content = '<div style="white-space: pre-wrap;">'.$content.'</div>';
                    $rs = Utils::sendEmail($email_config, $from, $email, $title, $title, $content,$views_layout_path);
                    if($rs){
                        Yii::app()->user->setFlash('success','Trả lời nhanh email: '.$email.' thành công');
                        $this->redirect(array('admin'));
                    }else{
                        $error = "Không thể gửi email, vui lòng thử lại sau";
                    }
                }catch (Exception $ex){
                    $error = $ex->getMessage();
                }
            }
        }
        $this->render('reply',array(
            'model'=>$model,
            'content'=>$content,
            'email'=>$email,
            'title'=>$title,
            'error'=>$error,
        ));
    }
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return AContact the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=AContact::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param AContact $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='acontact-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
