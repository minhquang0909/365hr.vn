<?php

    class AProduct extends Product
    {
        public $file;
        public $old_file;
        /*Language*/
        public $lang;
        public $gallery_items;
        /*End Language*/
        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('categories_id, title', 'required'),
                array('categories_id, hot, sort_order, views, status', 'numerical', 'integerOnly' => true),
                array('title, folder_path, created_by, updated_by', 'length', 'max' => 255),
                array('slug', 'length', 'max' => 500),
                array('short_des', 'length', 'max' => 1000),
                array('full_des,public_date,lang,price,pax,area', 'safe'),
                array('file,gallery_items', 'file', 'on'    => 'insert',
                                      'types' => 'jpg,jpeg,png', 'allowEmpty' => true
                ),
                array('file,gallery_items', 'file', 'on'    => 'update_file',
                                      'types' => 'jpg,jpeg,png', 'allowEmpty' => true
                ),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('id, categories_id, title, slug, short_des, full_des, folder_path, created_date, created_by, updated_date, updated_by, public_date, hot, sort_order, views, status', 'safe', 'on' => 'search'),
            );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
            return array(
                'id'            => Yii::t('adm/product', 'id'),
                'categories_id' => Yii::t('adm/product', 'categories'),
                'title'         => Yii::t('adm/product', 'title'),
                'slug'          => Yii::t('adm/product', 'slug'),
                'short_des'     => Yii::t('adm/product', 'short_des'),
                'full_des'      => Yii::t('adm/product', 'full_des'),
                'folder_path'   => Yii::t('adm/product', 'folder_path'),
                'created_date'  => Yii::t('adm/product', 'created_date'),
                'created_by'    => 'Các tiện ích hiện có',
                'updated_date'  => Yii::t('adm/product', 'updated_date'),
                'updated_by'    => Yii::t('adm/product', 'update_by'),
                'public_date'   => Yii::t('adm/product', 'public_date'),
                'hot'           => Yii::t('adm/product', 'hot'),
                'sort_order'    => Yii::t('adm/product', 'sort_order'),
                'views'         => Yii::t('adm/product', 'views'),
                'status'        => Yii::t('adm/product', 'status'),
                'area'          => 'Diện tích (m2)',
                'pax'           => 'Số người/phòng',
                'bedroom'       => 'Số phòng ngủ',
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

            $criteria->compare('id', $this->id, true);
            $criteria->compare('categories_id', $this->categories_id);
            $criteria->compare('title', $this->title, true);
            $criteria->compare('slug', $this->slug, true);
            $criteria->compare('short_des', $this->short_des, true);
            $criteria->compare('full_des', $this->full_des, true);
            $criteria->compare('folder_path', $this->folder_path, true);
            $criteria->compare('created_date', $this->created_date, true);
            $criteria->compare('created_by', $this->created_by, true);
            $criteria->compare('updated_date', $this->updated_date, true);
            $criteria->compare('updated_by', $this->updated_by, true);
            $criteria->compare('public_date', $this->public_date, true);
            $criteria->compare('hot', $this->hot);
            $criteria->compare('sort_order', $this->sort_order);
            $criteria->compare('views', $this->views);
            $criteria->compare('status', $this->status);
            $criteria->order = 'created_date DESC';

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
         * @return News the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        /**
         * delete image in folder
         *
         * @param $link_file
         */
        public function cleanup($link_file)
        {
            if ($link_file) {
                unlink(realpath(Yii::app()->getBasePath() . $link_file));
            }
        }

        /**
         * get value status display index file
         *
         * @return string
         */
        public function getStatusLabel()
        {
            return ($this->status == 1) ? Yii::t('adm/product', 'active') : Yii::t('adm/product', 'inactive');
        }

        /**
         * Get image url
         *
         * @return string
         */
        public function getImageUrl()
        {
            $dir_root = '../';

            return file_exists($dir_root . $this->folder_path) ? CHtml::image($dir_root . $this->folder_path, $this->title, array("width" => "100px", "height" => "60px", "title" => $this->title)) : CHtml::image("../images/no_img.png", "no image", array("width" => "100px", "height" => "60px", "title" => "no image"));
        }

        public function getNewsCategoriesNameByCateId()
        {
            $model = '';
            if ($this->categories_id) {
                $model = AProductCategories::model()->find('id=' . $this->categories_id);
            }

            return ($model) ? CHtml::encode($model->name) : '<i style="color: pink;">Not set</i>';
        }

        public function beforeSave()
        {
            if (parent::beforeSave()) {
                $this->slug         = Utils::unsign_string($this->title);
                $this->updated_date = date('Y-m-d H:i:s', time());

                $this->updated_by = Yii::app()->user->username;
                //delete old image
                $dir_old_file = '/../' . $this->old_file;
                if (!empty($this->old_file) && ($this->old_file != $this->folder_path) && file_exists(realpath(Yii::app()->getBasePath() . $dir_old_file))) {
                    unlink(realpath(Yii::app()->getBasePath() . $dir_old_file));
                }
            }

            return true;
        }

        public static function getListCategoriesName()
        {
            $_items = array();
            $models       = self::model()->findAll(array(
                "condition" => "status = 1",
            ));

            foreach ($models as $model)
                $_items[$model->id] = $model->title;

            return $_items;
        }
    }
