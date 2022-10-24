<?php

/**
 * This is the model class for table "{{tags}}".
 *
 * The followings are the available columns in table '{{tags}}':
 * @property integer $id
 * @property string $name
 * @property string $slug
 */
class ATags extends Tags
{
    private static $_items = array();
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name, slug', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, slug', 'safe', 'on'=>'search'),
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
            'tags' => array(self::HAS_MANY, 'ANewsTags', 'tags_id'),
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
			'slug' => 'Slug',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('slug',$this->slug,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tags the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Get all tags to array(id=>name)
     * @return array
     */
    public static function getAllTags()
    {
        self::$_items = array();
        $models = self::model()->findAll();

        foreach ($models as $model)
            self::$_items[$model->id] = $model->name;

        return self::$_items;
    }

    /**
     * get all tags name
     * @return array|string
     *
     */
    public static function getAllTagsName()
    {
        $results = '';
        $models = self::model()->findAll();

        foreach ($models as $model)
            $results[] = $model->name;
        return $results;
    }

    /**
     * get all tags by news_id form table: tbl_tags, tbl_news_tags
     * @param $news_id
     * @return array|string
     */
    public static function getTagsNameByNewsId($news_id)
    {
        $results = '';
        $criteria = new CDbCriteria;
        $criteria->distinct = TRUE;
        $criteria->with = array('tags');
        $criteria->addCondition('nt.news_id = ' . $news_id);
        $tags = self::model()->findAll($criteria);
        foreach ($tags as $tag)
            $results[] = $tag->name;
        return $results;
    }

    /**
     * get tags id by tag_name
     * @param $name
     * @return mixed
     */
    public function getTagsIdByTagsName($name)
    {
        $models = self::model()->find('name = "' . $name . '"');

        return $models['id'];
    }

    /**
     * Check Exist Slug
     * @return bool
     */
    public function checkExistingSlug()
    {
        if (isset($this->slug)) {
            $result = self::model()->find('slug=:slug AND id<>:id', array('slug' => $this->slug, 'id' => $this->id));
            if ($result) return TRUE; else return FALSE;
        } else return FALSE;
    }
}
