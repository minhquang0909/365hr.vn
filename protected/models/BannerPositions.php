<?php

    /**
     * This is the model class for table "{{banner_positions}}".
     *
     * The followings are the available columns in table '{{banner_positions}}':
     *
     * @property integer $id
     * @property string  $name
     * @property string  $code_name
     * @property integer $status
     */
    class BannerPositions extends CActiveRecord
    {
        const POSITION_ACTIVE   = 1;
        const POSITION_INACTIVE = 0;
        /**
         * @return string the associated database table name
         */
        public function tableName()
        {
            return '{{banner_positions}}';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('name, code_name', 'required'),
                array('status', 'numerical', 'integerOnly' => TRUE),
                array('name', 'length', 'max' => 255),
                array('code_name', 'length', 'max' => 300),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('id, name, code_name, status', 'safe', 'on' => 'search'),
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
                'id'        => Yii::t('common/BannerPosition', 'id'),
                'name'      => Yii::t('common/BannerPosition', 'name'),
                'code_name' => Yii::t('common/BannerPosition', 'code_name'),
                'status'    => Yii::t('common/BannerPosition', 'status'),
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
            $criteria->compare('name', $this->name, TRUE);
            $criteria->compare('code_name', $this->code_name, TRUE);
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
         * @return BannerPositions the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }
    }
