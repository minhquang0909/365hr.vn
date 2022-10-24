<?php

/**
 * This is the model class for table "{{news}}".
 *
 * The followings are the available columns in table '{{news}}':
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
 * @property integer $position
 */
class StaticPage extends CActiveRecord
{
	const NEWS_ACTIVE   = 1;
	const NEWS_INACTIVE = 0;
    const MENU_TOP = 'top_nav', MENU_MAIN = 'main_nav', MENU_FOOTER = 'footer_nav', MENU_LEFT = 'left_nav', MENU_RIGHT = 'right_nav';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{static_page}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, slug, short_des, full_des, folder_path, created_date, created_by, updated_date, updated_by, public_date, sort_order,views', 'required'),
			array('hot, sort_order, views, status', 'numerical', 'integerOnly'=>true),
			array('title, folder_path, created_by, updated_by', 'length', 'max'=>255),
			array('slug', 'length', 'max'=>500),
			array('position', 'safe'),
			array('short_des', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, categories_id, title, slug, short_des, full_des, folder_path, created_date, created_by, updated_date, updated_by, public_date, hot, sort_order, views, status', 'safe', 'on'=>'search'),
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
			'position' => 'Vị trí',
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public static function getType()
    {
        return array(
            self::MENU_TOP    => 'Menu Top',
            self::MENU_MAIN   => 'Menu chính',
            self::MENU_FOOTER => 'Menu chân trang',
            self::MENU_LEFT   => 'Menu trái',
            self::MENU_RIGHT  => 'Menu phải',
        );
    }

    public static function getList($skip=0,$limit=4,$category_id=0,$search_term=''){
        $where = " p.`status` = ".self::NEWS_ACTIVE." AND pl.`language_id` = ".Yii::app()->session['language_id']." ";
        if($category_id > 0){
            $where.=" AND p.`categories_id` = ".(int)$category_id." ";
        }
        $sql = " SELECT p.`id`,p.`folder_path`, p.`created_date`, p.`updated_date`, pl.`title`, pl.`short_des` FROM {{static_page}} p INNER JOIN {{static_page_lang}} pl ON p.`id` = pl.`parent_id`  WHERE ".$where." ORDER BY p.`sort_order` ASC LIMIT " . (int)$skip . "," . (int)$limit." ";
        $sql_total = "SELECT COUNT(*) AS 'total' FROM {{static_page}} p INNER JOIN {{static_page_lang}} pl ON p.`id` = pl.`parent_id`  WHERE ".$where."  ";
        $conn = Yii::app()->db;
        $command_total = $conn->createCommand($sql_total);
        $total = $command_total->queryRow($sql_total);
        $total = isset($total['total'])?$total['total']:0;
        if($total > 0){
            $command = $conn->createCommand($sql);
            $result = $command->queryAll($sql);
            return array(
                'total' =>  $total,
                'list_page'  => $result
            );
        }else{
            return array(
                'total' =>  0,
                'list_page'  => array()
            );
        }
    }

}
