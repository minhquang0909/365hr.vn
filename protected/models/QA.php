<?php

/**
 * This is the model class for table "{{news}}".
 *
 * The followings are the available columns in table '{{news}}':
 * @property string $id
 * @property integer $categories_id
 * @property string $question
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
 */
class QA extends CActiveRecord
{
	const NEWS_ACTIVE   = 1;
	const NEWS_INACTIVE = 0;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{qa}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question,categories_id, slug, answer, folder_path, created_date, created_by, updated_date, updated_by, public_date, sort_order,views', 'required'),
			array('hot, sort_order, categories_id,views, status', 'numerical', 'integerOnly'=>true),
			array('question, folder_path, created_by, updated_by', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, categories_id, question, slug, answer, folder_path, created_date, created_by, updated_date, updated_by, public_date, hot, sort_order, views, status', 'safe', 'on'=>'search'),
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
            'category' => array(self::BELONGS_TO, 'QACategories', 'categories_id'),
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

	public static function getQuestionAnswerByCategoryId($category_id){
        $where = "q.`categories_id` = ".(int)$category_id." AND q.`status` = ".self::NEWS_ACTIVE." AND l.`language_id` = ".Yii::app()->session['language_id']." ";
        $sql = "SELECT q.`id`,q.`sort_order`, l.`question`,l.`answer` FROM {{qa}} q INNER JOIN {{qa_lang}} l ON q.`id` = l.`parent_id` WHERE ".$where." ORDER BY q.`sort_order` ";
        $conn = Yii::app()->db;
        $command = $conn->createCommand($sql);
        $result = $command->queryAll($sql);
        return $result;
    }
}
