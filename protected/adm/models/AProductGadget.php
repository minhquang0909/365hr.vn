<?php

    class AProductGadget extends ProductGadget
    {
        public $file;
        public $old_file;
        private static $_items = array();
        /*Language*/
        public $lang;
        /*End Language*/
        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('name, status', 'required'),
                array('parent_id, sort_order, status, in_home_page', 'numerical', 'integerOnly' => true),
                array('name', 'length', 'max' => 255),
                array('folder_path, slug', 'length', 'max' => 500),
                array('file', 'file', 'on'    => 'insert',
                                      'types' => 'jpg, jpeg, png', 'allowEmpty' => true
                ),
                array('file', 'file', 'on'    => 'update_file',
                                      'types' => 'jpg, jpeg, png', 'allowEmpty' => true
                ),
                array('created_date, updated_date,lang', 'safe'),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('id, name, parent_id, folder_path, sort_order, slug, status, in_home_page', 'safe', 'on' => 'search'),
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
                'id'           => Yii::t('adm/news', 'id'),
                'parent_id'    => Yii::t('adm/news', 'parent_id'),
                'name'         => Yii::t('adm/news', 'name'),
                'slug'         => Yii::t('adm/news', 'slug'),
                'folder_path'  => Yii::t('adm/news', 'folder_path'),
                'sort_order'   => Yii::t('adm/news', 'sort_order'),
                'in_home_page' => Yii::t('adm/news', 'in_home_page'),
                'status'       => Yii::t('adm/news', 'status'),
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
            $criteria->compare('parent_id', $this->parent_id);
            $criteria->compare('name', $this->name, true);
            $criteria->compare('slug', $this->slug, true);
            $criteria->compare('folder_path', $this->folder_path, true);
            $criteria->compare('sort_order', $this->sort_order);
            $criteria->compare('in_home_page', $this->in_home_page);
            $criteria->compare('status', $this->status);

            return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
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
         * @return NewsCategories the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        public static function getListNewsCategoriesName()
        {
            self::$_items = array();
            $models       = self::model()->findAll(array(
                "condition" => "status = " . self::NEWS_CATE_ACTIVE,
                "group"     => "name"
            ));

            foreach ($models as $model)
                self::$_items[$model->id] = $model->name;

            return self::$_items;
        }

        /**
         * Get News Categories Name by id
         *
         * @return string
         */
        public function getNewsCategoriesName()
        {
            $model = '';
            if ($this->parent_id) {
                $model = self::model()->find('id=' . $this->parent_id);
            }

            return ($model) ? CHtml::encode($model->name) : '<i style="color: pink;">Not set</i>';
        }

        /**
         * delete image in folder
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
            return ($this->status == 1) ? Yii::t('adm/news', 'active') : Yii::t('adm/news', 'inactive');
        }

        /**
         * Get image url
         *
         * @return string
         */
        public function getImageUrl()
        {
            $dir_root = '../';
            return file_exists($dir_root . $this->folder_path) ? CHtml::image($dir_root . $this->folder_path, $this->name, array("width" => "100px", "height" => "60px", "title" => $this->name)) : CHtml::image("../images/no_img.png", "no image", array("width" => "100px", "height" => "60px", "title" => "no image"));
        }

        public function beforeSave()
        {
            if (parent::beforeSave()) {
                //$this->slug = strtolower(str_replace(' ', '-',$this->name));
                $this->slug = Utils::unsign_string($this->name);
                //delete old image
                $dir_old_file = '/../' . $this->old_file;
                if (!empty($this->old_file) && ($this->old_file != $this->folder_path) && file_exists(realpath(Yii::app()->getBasePath() . $dir_old_file))) {
                    unlink(realpath(Yii::app()->getBasePath() . $dir_old_file));
                }
            }
            return true;
        }

        /**
         * get value status display index file
         *
         * @return string
         */
        public function getInHomePageLabel()
        {
            return ($this->in_home_page == 1) ? Yii::t('adm/news', 'yes') : Yii::t('adm/news', 'no');
        }
        public static  function getAllGadget()
        {
            return self::model()->findAll('1=1 order by `name` asc');
        }
    }
