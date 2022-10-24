<?php

class AFileController extends AController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

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
		$model=new AFile;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AFile']))
		{
			$model->attributes=$_POST['AFile'];
			//upload
            if(isset($_FILES['file'])){
                $file = $_FILES['file'];
                $upload_directory        = str_replace('../', '', Yii::app()->params->upload_dir_path . Yii::app()->params->upload_file_dir);
                $ext_str = AFile::FILE_EXT;
                $allowed_extensions=explode(',',$ext_str);
                $max_file_size = 10485760;//10 mb remember 1024bytes =1kbytes /* check allowed extensions here */
                $ext = substr($file['name'], strrpos($file['name'], '.') + 1); //get file extension from last sub string from last . character
                if (!in_array($ext, $allowed_extensions) ) {
                    $model->addError('path','Chỉ cho phép tải tệp định dạng'.$ext_str.'');

                } /* check file size of the file if it exceeds the specified size warn user */
                /*if($file['size'] >= $max_file_size){
                    $model->addError('path','Chỉ cho phép tải lên tệp dưới 10mb');
                }*/

                $tmp_filename = $file['name'];
                var_dump($tmp_filename);
                $tmp_filename = str_replace(array('.docx','.doc','.xlsx','.xls','.pptx','.ppt','.pdf','.txt'),'',$tmp_filename);
                $tmp_filename = CFunction::unsign_string($tmp_filename,'_');
                $path = $tmp_filename.'.'.$ext;
                $base_dir = dirname(dirname(dirname(dirname(__FILE__))));
                $upload_directory = $base_dir.'/'.$upload_directory;
                try{
                    if(@move_uploaded_file($file['tmp_name'],$upload_directory.$path)){
                        $model->path = $path;
                        $model->size = $file['size'];
                        $model->type = $file['type'];
                    }else{
                        $model->addError('path','Không thể upload file, vui lòng thử lại sau');
                    }
                }catch (Exception $ex){
                    $model->addError('path',$ex->getMessage());
                }
            }else{
                $model->addError('path','Vui lòng chọn file');
            }
            $model->created_time = time();
            $model->note = '';
            $download_link = CFunction::getCurrentDomain().'/uploads/files/'.$model->path.'';
            $model->download_link = $download_link;

            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('adm/label', 'alert_success'));
                $this->redirect(array('admin'));
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
        $old_path = $model->path;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['File']))
		{
			$model->attributes=$_POST['File'];
            $model->path = $old_path;
            //upload
            if(isset($_FILES['file'])){
                $file = $_FILES['file'];
                $upload_directory        = str_replace('../', '', Yii::app()->params->upload_dir_path . Yii::app()->params->upload_file_dir);
                $ext_str = AFile::FILE_EXT;
                $allowed_extensions=explode(',',$ext_str);
                $max_file_size = 10485760;//10 mb remember 1024bytes =1kbytes /* check allowed extensions here */
                $ext = substr($file['name'], strrpos($file['name'], '.') + 1); //get file extension from last sub string from last . character
                if (!in_array($ext, $allowed_extensions) ) {
                    $model->addError('path','Chỉ cho phép tải tệp định dạng'.$ext_str.'');

                } /* check file size of the file if it exceeds the specified size warn user */
                /*if($file['size'] >= $max_file_size){
                    $model->addError('path','Chỉ cho phép tải lên tệp dưới 10mb');
                }*/
                //$path=md5(microtime()).'.'.$ext;
                $path = $model->path;
                $base_dir = dirname(dirname(dirname(dirname(__FILE__))));
                $upload_directory = $base_dir.'/'.$upload_directory;
                try{
                    if(@move_uploaded_file($file['tmp_name'],$upload_directory.$path)){
                        $model->path = $path;
                        $model->size = $file['size'];
                        $model->type = $file['type'];
                    }else{
                        $model->addError('path','Không thể upload file, vui lòng thử lại sau');
                    }
                }catch (Exception $ex){
                    $model->addError('path',$ex->getMessage());
                }
            }else{
                $model->addError('path','Vui lòng chọn file');
            }
            //
            $download_link = CFunction::getCurrentDomain().'/uploads/files/'.$model->path.'';
            $model->download_link = $download_link;

			if($model->save()) {
                Yii::app()->user->setFlash('success', Yii::t('adm/label', 'alert_success'));
                $this->redirect(array('admin'));
            }
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
		$dataProvider=new CActiveDataProvider('AFile');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AFile('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AFile']))
			$model->attributes=$_GET['AFile'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return AFile the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=AFile::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param AFile $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='afile-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
