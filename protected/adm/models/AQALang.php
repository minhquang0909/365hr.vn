<?php


class AQALang extends QALang
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('answer, slug, answer', 'required'),
			array('categories_id, hot, sort_order, views, status, language_id, parent_id', 'numerical', 'integerOnly'=>true),
			array('answer, folder_path, created_by, updated_by', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, categories_id, answer, slug, answer, folder_path, created_date, created_by, updated_date, updated_by, public_date, hot, sort_order, views, status, language_id, parent_id', 'safe', 'on'=>'search'),
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
			'answer' => 'Answer',
			'slug' => 'Slug',
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
		$criteria->compare('answer',$this->answer,true);
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
    public function beforeSave()
    {
        if (parent::beforeSave()) {
            $this->slug = Utils::unsign_string($this->answer);
        }
        return TRUE;
    }
}
