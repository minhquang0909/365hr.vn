<?php

/**
 * This is the model class for table "{{product}}".
 *
 * The followings are the available columns in table '{{product}}':
 * @property string $id
 * @property integer $categories_id
 * @property string $title
 * @property string $slug
 * @property string $short_des
 * @property string $full_des
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
 * @property double $price
 * @property double $area
 * @property integer $pax
 * @property integer $bedroom
 */
class Product extends CActiveRecord
{
    const NEWS_ACTIVE   = 1;
    const NEWS_INACTIVE = 0;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{product}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('categories_id, title, slug, short_des, full_des, folder_path, created_date, created_by, updated_date, updated_by, public_date, sort_order', 'required'),
			array('categories_id, hot, sort_order, views, status, pax, bedroom', 'numerical', 'integerOnly'=>true),
			array('price, area', 'numerical'),
			array('title, folder_path, created_by, updated_by', 'length', 'max'=>255),
			array('slug', 'length', 'max'=>500),
			array('short_des', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, categories_id, title, slug, short_des, full_des, folder_path, created_date, created_by, updated_date, updated_by, public_date, hot, sort_order, views, status, price, area, pax, bedroom', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'slug' => 'Slug',
			'short_des' => 'Short Des',
			'full_des' => 'Full Des',
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
			'price' => 'Price',
			'area' => 'Area',
			'pax' => '"Số người/phòng"',
			'bedroom' => '"Số phòng ngủ"',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('short_des',$this->short_des,true);
		$criteria->compare('full_des',$this->full_des,true);
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
		$criteria->compare('price',$this->price);
		$criteria->compare('area',$this->area);
		$criteria->compare('pax',$this->pax);
		$criteria->compare('bedroom',$this->bedroom);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
