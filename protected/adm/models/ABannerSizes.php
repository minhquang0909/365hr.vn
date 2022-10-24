<?php

    /**
     * This is the model class for table "{{banner_sizes}}".
     *
     * The followings are the available columns in table '{{banner_sizes}}':
     *
     * @property integer $id
     * @property string  $name
     * @property integer $width
     * @property integer $height
     * @property integer $status
     */
    class ABannerSizes extends BannerSizes
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
                array('name, width, height, status', 'required'),
                array('name', 'unique', 'message' => 'Code Name already exists!'),
                array('name', 'filter', 'filter' => array($obj = new CHtmlPurifier(), 'purify')),
                array('width, height, status', 'numerical', 'integerOnly' => TRUE),
                array('name', 'length', 'max' => 255),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('id, name, width, height, status', 'safe', 'on' => 'search'),
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
            $criteria->compare('width', $this->width);
            $criteria->compare('height', $this->height);
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
         * @return BannerSizes the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        public static function itemsBannerSizes($type)
        {
            self::$_items = array();
            $models       = self::model()->findAll(array(
                "condition" => "status = ".BannerSizes::SIZE_ACTIVE,
                "group"     => "name"
            ));

            foreach ($models as $model)
                self::$_items[$model->id] = $model->name;

            return self::$_items;
        }

        public static function getBannerSizeName($sizes)
        {
            $criteria            = new CDbCriteria;
            $criteria->select    = "name,status";
            $criteria->condition = "id=:id";
            $criteria->params    = array(
                ':id' => $sizes
            );
            $results             = ABannerSizes::model()->findAll($criteria);
            foreach ($results as $size) {
                if ($size['status'] == BannerSizes::SIZE_ACTIVE) {
                    return $size['name'];
                } else {
                    return $size['name'] . '</br><span style="font-style: italic;font-size: 12px;color: red;">(' . Yii::t('common/BannerSizes', 'not_available') . ')</span>';
                }
            }
        }

        public static function getAllBannerSizes()
        {
            $sizes     = '';
            $arr_sizes = array();
            $models    = ABannerSizes::model()->findAll();
            foreach ($models as $model) {
                $sizes['id']   = $model->id;
                $sizes['name'] = $model->name;
                $arr_sizes[]   = $sizes;
            }

            return $arr_sizes;
        }
    }
