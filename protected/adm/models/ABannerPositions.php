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
    class ABannerPositions extends BannerPositions
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
                array('name, code_name', 'required'),
                array('code_name', 'unique', 'message' => 'Code Name already exists!'),
                array('name, code_name', 'filter', 'filter' => array($obj = new CHtmlPurifier(), 'purify')),
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

        public static function itemsBannerPosition($type)
        {
            self::$_items = array();
            $models       = self::model()->findAll(array(
                "condition" => "status = ".BannerPositions::POSITION_ACTIVE,
                "group"     => "name"
            ));

            foreach ($models as $model)
                self::$_items[$model->id] = $model->name;

            return self::$_items;
        }

        public static function getBannerPositionName($positions)
        {
            $criteria            = new CDbCriteria;
            $criteria->select    = "name,status";
            $criteria->condition = "id=:id";
            $criteria->params    = array(
                ':id' => $positions
            );
            $results             = ABannerPositions::model()->findAll($criteria);
            foreach ($results as $position) {
                if ($position['status'] == BannerPositions::POSITION_ACTIVE) {
                    return $position['name'];
                } else {
                    return $position['name'] . '</br><span style="font-style: italic;font-size: 12px;color: red;">(' . Yii::t('common/BannerPosition', 'not_available') . ')</span>';
                }
            }
        }

        public static function getAllBannerPositions()
        {
            $possitions   = '';
            $arr_position = array();
            $models       = ABannerPositions::model()->findAll();
            foreach ($models as $model) {
                $possitions['id']   = $model->id;
                $possitions['name'] = $model->name;
                $arr_position[]     = $possitions;
            }

            return $arr_position;
        }
    }
