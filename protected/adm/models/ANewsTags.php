<?php

/**
 * This is the model class for table "{{news_tags}}".
 *
 * The followings are the available columns in table '{{news_tags}}':
 * @property integer $news_id
 * @property integer $tags_id
 */
class ANewsTags extends NewsTags
{

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('news_id, tags_id', 'required'),
            array('news_id, tags_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('news_id, tags_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'news_id' => 'News',
            'tags_id' => 'Tags',
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

        $criteria = new CDbCriteria;

        $criteria->compare('news_id', $this->news_id);
        $criteria->compare('tags_id', $this->tags_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return NewsTags the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function checkNewsTagsExists($news_id, $tags_id)
    {
        $models = self::model()->find('news_id = "' . $news_id . '" and tags_id = "' . $tags_id . '"');

        if ($models) {
            return true;
        } else {
            return false;
        }
    }
}
