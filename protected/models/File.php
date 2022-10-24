<?php

/**
 * This is the model class for table "{{file}}".
 *
 * The followings are the available columns in table '{{file}}':
 * @property string $id
 * @property string $name
 * @property double $size
 * @property string $type
 * @property string $path
 * @property string $download_link
 * @property integer $created_time
 * @property string $note
 */
class File extends CActiveRecord
{
    const FILE_EXT = 'doc,docx,xls,xlsx,ppt,pptx,pdf,txt';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{file}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, path', 'required'),
			array('created_time', 'numerical', 'integerOnly'=>true),
			array('size', 'numerical'),
			array('name, type, path, download_link', 'length', 'max'=>255),
			array('note', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, size, type, path, download_link, created_time, note', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'size' => 'Size',
			'type' => 'Type',
			'path' => 'Path',
			'download_link' => 'Download Link',
			'created_time' => 'Created Time',
			'note' => 'Note',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('size',$this->size);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('download_link',$this->download_link,true);
		$criteria->compare('created_time',$this->created_time);
		$criteria->compare('note',$this->note,true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'     => array('defaultOrder' => 'id DESC'),
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return File the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
