<?php

class ANewsCategoriesLang extends NewsCategoriesLang
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, slug, status', 'required'),
			array('parent_id, sort_order, in_home_page, status, language_id, category_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('slug, folder_path', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_id, name, slug, folder_path, sort_order, in_home_page, status, language_id, category_id', 'safe', 'on'=>'search'),
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
			'parent_id' => 'Parent',
			'name' => 'Name',
			'slug' => 'Slug',
			'folder_path' => 'Folder Path',
			'sort_order' => 'Sort Order',
			'in_home_page' => 'In Home Page',
			'status' => 'Status',
			'language_id' => 'Language',
			'category_id' => 'Category',
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('folder_path',$this->folder_path,true);
		$criteria->compare('sort_order',$this->sort_order);
		$criteria->compare('in_home_page',$this->in_home_page);
		$criteria->compare('status',$this->status);
		$criteria->compare('language_id',$this->language_id);
		$criteria->compare('category_id',$this->category_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NewsCategoriesLang the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}