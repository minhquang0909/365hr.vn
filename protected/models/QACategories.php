<?php

/**
 * This is the model class for table "{{qa_categories}}".
 *
 * The followings are the available columns in table '{{qa_categories}}':
 * @property string $id
 * @property integer $parent_id
 * @property string $name
 * @property string $slug
 * @property string $folder_path
 * @property integer $sort_order
 * @property integer $in_home_page
 * @property integer $status
 */
class QACategories extends CActiveRecord
{
    const NEWS_CATE_ACTIVE   = 1;
    const NEWS_CATE_INACTIVE = 0;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{qa_categories}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, slug, status', 'required'),
            array('parent_id, sort_order, status, in_home_page', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            array('folder_path, slug', 'length', 'max'=>500),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, parent_id, folder_path, sort_order, slug, status, in_home_page', 'safe', 'on'=>'search'),
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
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return NewsCategories the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public static function getAll(){
        $where = "q.`status` = ".self::NEWS_CATE_ACTIVE." AND d.`language_id` = ".Yii::app()->session['language_id']." ";
        $sql = "SELECT q.`id`,q.`sort_order`, d.`name` FROM {{qa_categories}} q INNER JOIN {{qa_categories_lang}} d ON q.`id` = d.`category_id` WHERE ".$where." ORDER BY q.`sort_order` ";
        $conn = Yii::app()->db;
        $command = $conn->createCommand($sql);
        $result = $command->queryAll($sql);
        return $result;

    }
}
