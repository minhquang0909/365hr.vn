<?php

/**
 * This is the model class for table "{{recruitment_step_lang}}".
 *
 * The followings are the available columns in table '{{recruitment_step_lang}}':
 * @property string $id
 * @property integer $categories_id
 * @property string $question
 * @property string $short_desc
 * @property string $slug
 * @property string $answer
 * @property string $folder_path
 * @property string $created_date
 * @property string $created_by
 * @property string $updated_date
 * @property string $updated_by
 * @property string $public_date
 * @property integer $hot
 * @property integer $sort_order
 * @property integer $views
 * @property integer $status
 * @property integer $language_id
 * @property integer $parent_id
 */
class RecruitmentStepLang extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{recruitment_step_lang}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('categories_id, question, short_des, answer, folder_path, created_date, created_by, updated_date, updated_by, public_date, sort_order', 'required'),
			array('categories_id, hot, sort_order, views, status, language_id, parent_id', 'numerical', 'integerOnly'=>true),
			array('question, folder_path, created_by, updated_by', 'length', 'max'=>255),
			array('short_desc', 'length', 'max'=>500),
			array('short_des', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, categories_id, question,short_desc, slug, short_des, answer, folder_path, created_date, created_by, updated_date, updated_by, public_date, hot, sort_order, views, status, language_id, parent_id', 'safe', 'on'=>'search'),
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
			'categories_id' => 'Categories',
			'question' => 'Question',
			'short_desc' => 'short_desc',
			'slug' => 'Slug',
			'short_des' => 'Short Des',
			'answer' => 'Answer',
			'folder_path' => 'Folder Path',
			'created_date' => 'Created Date',
			'created_by' => 'Created By',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated By',
			'public_date' => 'Public Date',
			'hot' => 'Hot',
			'sort_order' => 'Sort Order',
			'views' => 'Views',
			'status' => 'Status',
			'language_id' => 'Language',
			'parent_id' => 'Parent',
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
		$criteria->compare('categories_id',$this->categories_id);
		$criteria->compare('question',$this->question,true);
		$criteria->compare('short_desc',$this->short_desc,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('folder_path',$this->folder_path,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('public_date',$this->public_date,true);
		$criteria->compare('hot',$this->hot);
		$criteria->compare('sort_order',$this->sort_order);
		$criteria->compare('views',$this->views);
		$criteria->compare('status',$this->status);
		$criteria->compare('language_id',$this->language_id);
		$criteria->compare('parent_id',$this->parent_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StaticPageLang the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
