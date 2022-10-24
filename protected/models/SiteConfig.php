<?php

    /**
     * This is the model class for table "{{site_config}}".
     *
     * The followings are the available columns in table '{{site_config}}':
     *
     * @property integer $id
     * @property string  $config_key
     * @property string  $config_value
     * @property integer $ordering
     */
    class SiteConfig extends CActiveRecord
    {
        /**
         * @return string the associated database table name
         */
        public function tableName()
        {
            return '{{site_config}}';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('config_key', 'required'),
                array('config_key', 'unique'),
                array('ordering', 'numerical', 'integerOnly' => true),
                array('config_key', 'length', 'max' => 50),
                array('config_value', 'safe'),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('id, config_key, config_value, ordering', 'safe', 'on' => 'search'),
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
                'id'           => 'ID',
                'config_key'   => 'Config Key',
                'config_value' => 'Config Value',
                'ordering'     => 'Ordering',
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
            $criteria->compare('config_key', $this->config_key, true);
            $criteria->compare('config_value', $this->config_value, true);
            $criteria->compare('ordering', $this->ordering);

            return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
                'sort'     => array(
                    'defaultOrder' => 'ordering asc',
                ),
                'pagination'=>array(
                    'pageSize'=>30
                )
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         *
         * @param string $className active record class name.
         *
         * @return SiteConfig the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }
    }
