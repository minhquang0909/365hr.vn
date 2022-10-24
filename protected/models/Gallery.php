<?php

/**
 * This is the model class for table "{{gallery}}".
 *
 * The followings are the available columns in table '{{gallery}}':
 * @property string $id
 * @property string $file_name
 * @property string $file_ext
 * @property string $folder_path
 * @property string $target_link
 * @property integer $status
 * @property string $title
 * @property integer $album_id
 * @property integer $parent_id
 * @property string $created_time
 */
class Gallery extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{gallery}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('file_name, file_ext, folder_path', 'required'),
			array('status, album_id, parent_id', 'numerical', 'integerOnly'=>true),
			array('file_name', 'length', 'max'=>500),
			array('file_ext', 'length', 'max'=>10),
			array('folder_path, target_link', 'length', 'max'=>1000),
			array('title', 'length', 'max'=>255),
			array('created_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, file_name, file_ext, folder_path, target_link, status, title, album_id, parent_id, created_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'file_name' => 'File Name',
			'file_ext' => 'File Ext',
			'folder_path' => 'Folder Path',
			'target_link' => 'Link',
			'status' => 'Status',
			'title' => 'Title',
			'album_id' => 'Album',
			'parent_id' => 'Parent',
			'created_time' => 'Ngày tạo',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('file_ext',$this->file_ext,true);
		$criteria->compare('folder_path',$this->folder_path,true);
		$criteria->compare('target_link',$this->target_link,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('album_id',$this->album_id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('created_time',$this->created_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Gallery the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
