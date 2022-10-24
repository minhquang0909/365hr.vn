<?php

    /**
     * This is the model class for table "{{languages}}".
     *
     * The followings are the available columns in table '{{languages}}':
     *
     * @property integer $id
     * @property string  $name
     * @property integer $status
     * @property string  $code_name
     */
    class Languages extends CActiveRecord
    {
        /**
         * @return string the associated database table name
         */
        public function tableName()
        {
            return '{{languages}}';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('name, status', 'required'),
                array('status', 'numerical', 'integerOnly' => true),
                array('name', 'length', 'max' => 100),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('id, name, status', 'safe', 'on' => 'search'),
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
                'id'        => Yii::t('common/Languages', 'id'),
                'name'      => Yii::t('common/Languages', 'name'),
                'status'    => Yii::t('common/Languages', 'status'),
                'code_name' => Yii::t('common/Languages', 'code_name'),
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

            $criteria->compare('id', $this->id);
            $criteria->compare('name', $this->name, true);
            $criteria->compare('status', $this->status);

            return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         *
         * @param string $className active record class name.
         *
         * @return Languages the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        public static function getLanguageByCodeName($codename)
        {
            $model = self::model()->find('code_name=:code_name', array(':code_name' => $codename));
            return $model->name;
        }

        public static function getDisplayLanguageName()
        {
            $current_lang = Yii::app()->language;
            $list_lang    = Languages::model()->find("code_name !='$current_lang'");
            if ($list_lang) return $list_lang->name;
        }

        public static function getAllLanguages()
        {
            $key_cache = 'all_language';
            $cacheData = Yii::app()->cache->get($key_cache);
            if (!$cacheData) {
                $cacheData = self::model()->findAll("status=1");
                Yii::app()->cache->set($key_cache, $cacheData, 3600);
            }
            return $cacheData;
        }

        public static function copyAllAttributes(&$to,$from)
        {
          foreach ((array)$from->attributes as $att=>$value){
              if($att!='id'){
                  $to->$att  = $from->$att;
              }
          }
        }

    }
