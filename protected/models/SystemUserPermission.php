<?php

    /**
     * This is the model class for table "{{systemuser_permission}}".
     *
     * The followings are the available columns in table '{{systemuser_permission}}':
     *
     * @property integer $id
     * @property string  $controller
     * @property string  $user_id
     * @property string  $permission
     */
    class SystemUserPermission extends CActiveRecord
    {
        /**
         * Returns the static model of the specified AR class.
         *
         * @param string $className active record class name.
         *
         * @return SystemuserPermission the static model class
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
            return '{{systemuser_permission}}';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('controller, user_id', 'length', 'max' => 255),
                array('permission', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, controller, user_id, permission', 'safe', 'on' => 'search'),
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
                'id'         => Yii::t('common/SystemUserPermission', 'id'),
                'controller' => Yii::t('common/SystemUserPermission', 'controller'),
                'user_id'    => Yii::t('common/SystemUserPermission', 'user_id'),
                'permission' => Yii::t('common/SystemUserPermission', 'permission'),
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
            $criteria->compare('controller', $this->controller, TRUE);
            $criteria->compare('user_id', $this->user_id, TRUE);
            $criteria->compare('permission', $this->permission, TRUE);

            return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
        }
    }