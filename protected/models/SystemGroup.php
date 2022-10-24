<?php

    /**
     * This is the model class for table "{{system_group}}".
     *
     * The followings are the available columns in table '{{system_group}}':
     *
     * @property integer $id
     * @property string  $group_title
     * @property string  $group_desc
     * @property integer $status
     * @property string  $created_date
     */
    class SystemGroup extends CActiveRecord
    {
        /**
         * Returns the static model of the specified AR class.
         *
         * @param string $className active record class name.
         *
         * @return SystemGroup the static model class
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
            return '{{system_group}}';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('status', 'numerical', 'integerOnly' => TRUE),
                array('group_title', 'length', 'max' => 255),
                array('group_desc, created_date', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, group_title, group_desc, status, created_date', 'safe', 'on' => 'search'),
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
                'group_title'  => Yii::t('adm/system', 'group_title'),
                'group_desc'   => Yii::t('adm/system', 'group_desc'),
                'status'       => Yii::t('adm/system', 'status'),
                'created_date' => Yii::t('adm/system', 'created_date'),
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
            $criteria->compare('group_title', $this->group_title, TRUE);
            $criteria->compare('group_desc', $this->group_desc, TRUE);
            $criteria->compare('status', $this->status);
            $criteria->compare('created_date', $this->created_date, TRUE);

            return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
        }

        /**
         * function get status
         */
        public static function getStatusOptions()
        {
            return array(
                '0' => 'Ngừng hoạt động',
                '1' => 'Kích hoạt',
            );
        }

        public static function getStatusText($status_id)
        {
            $statusOptions = ASystemGroup::getStatusOptions();

            return isset($statusOptions[$status_id]) ? $statusOptions[$status_id] : 'unknown status({$status_id})';
        }
    }