<?php

    /**
     * This is the model class for table "{{group_permission}}".
     *
     * The followings are the available columns in table '{{group_permission}}':
     *
     * @property integer $id
     * @property string  $controller
     * @property integer $group_id
     * @property string  $permission
     */
    class GroupPermission extends CActiveRecord
    {
        /**
         * Returns the static model of the specified AR class.
         *
         * @param string $className active record class name.
         *
         * @return GroupPermission the static model class
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
            return '{{group_permission}}';
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
                array('id, group_id', 'numerical', 'integerOnly' => TRUE),
                array('controller', 'length', 'max' => 255),
                array('permission', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, controller, group_id, permission', 'safe', 'on' => 'search'),
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
                'id'         => Yii::t('common/GroupPermission', 'id'),
                'controller' => Yii::t('common/GroupPermission', 'controller'),
                'group_id'   => Yii::t('common/GroupPermission', 'group_id'),
                'permission' => Yii::t('common/GroupPermission', 'permission'),
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
            $criteria->compare('group_id', $this->group_id);
            $criteria->compare('permission', $this->permission, TRUE);

            return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
        }
    }

?>