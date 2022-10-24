<?php

    /**
     * This is the model class for table "{{system_user_group}}".
     *
     * The followings are the available columns in table '{{system_user_group}}':
     *
     * @property integer $id
     * @property string  $name
     * @property string  $description
     * @property integer $status
     * @property string  $create_time
     * @property integer $create_user_id
     */
    class SystemUserGroup extends CActiveRecord
    {
        /**
         * Returns the static model of the specified AR class.
         *
         * @param string $className active record class name.
         *
         * @return SystemUserGroup the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        /**
         * @return string the associated database table name
         */
        public function tableName()
        {
            return '{{system_user_group}}';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('id', 'required'),
                array('id, status, create_user_id', 'numerical', 'integerOnly' => TRUE),
                array('name', 'length', 'max' => 255),
                array('description, create_time', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, name, description, status, create_time, create_user_id', 'safe', 'on' => 'search'),
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
                'id'             => Yii::t('common/SystemUserGroup', 'id'),
                'name'           => Yii::t('common/SystemUserGroup', 'name'),
                'description'    => Yii::t('common/SystemUserGroup', 'description'),
                'status'         => Yii::t('common/SystemUserGroup', 'status'),
                'create_time'    => Yii::t('common/SystemUserGroup', 'create_time'),
                'create_user_id' => Yii::t('common/SystemUserGroup', 'create_user_id'),
            );
        }

        /**
         * Retrieves a list of models based on the current search/filter conditions.
         *
         * @return CActiveDataProvider the data provider that can return the models based on the search/filter
         *                             conditions.
         */
        public function search()
        {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria = new CDbCriteria;

            $criteria->compare('id', $this->id);
            $criteria->compare('name', $this->name, TRUE);
            $criteria->compare('description', $this->description, TRUE);
            $criteria->compare('status', $this->status);
            $criteria->compare('create_time', $this->create_time, TRUE);
            $criteria->compare('create_user_id', $this->create_user_id);

            return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
        }
    }