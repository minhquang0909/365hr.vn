<?php

    class ARecruitmentStep extends RecruitmentStep
    {
        public $file;
        public $old_file;
        public $lang;

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('question','required'),
                array('hot, sort_order, views, status', 'numerical', 'integerOnly' => TRUE),
                array('question, folder_path, created_by, updated_by', 'length', 'max' => 255),
                array('short_desc', 'length', 'max'=>500),
                array('answer', 'safe'),
                array('position,lang', 'safe'),
                array('file', 'file', 'on'    => 'insert',
                                      'types' => 'jpg, jpeg,  png','allowEmpty'=>true
                ),
                array('file', 'file', 'on'    => 'update_file',
                                      'types' => 'jpg, jpeg, png','allowEmpty'=>true
                ),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('id, categories_id, question,short_desc, slug, answer, folder_path, created_date, created_by, updated_date, updated_by, public_date, hot, sort_order, views, status', 'safe', 'on' => 'search'),
            );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
            return array(
                'id'            => Yii::t('adm/news', 'id'),
                'categories_id' => 'Danh mục câu hỏi',
                'question'         => 'Tiêu đề',
                'short_desc'         => 'Mô tả ngắn',
                'slug'          => Yii::t('adm/news', 'slug'),
                'answer'      => 'Chi tiết',
                'folder_path'   => Yii::t('adm/news', 'folder_path'),
                'created_date'  => Yii::t('adm/news', 'created_date'),
                'created_by'    => Yii::t('adm/news', 'created_by'),
                'updated_date'  => Yii::t('adm/news', 'updated_date'),
                'updated_by'    => Yii::t('adm/news', 'update_by'),
                'public_date'   => Yii::t('adm/news', 'public_date'),
                'hot'           => Yii::t('adm/news', 'hot'),
                'sort_order'    => Yii::t('adm/news', 'sort_order'),
                'views'         => Yii::t('adm/news', 'views'),
                'status'        => Yii::t('adm/news', 'status'),
                'position' => 'Vị trí',
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

            $criteria->compare('id', $this->id, TRUE);
            $criteria->compare('categories_id', $this->categories_id);
            $criteria->compare('question', $this->question, TRUE);
            $criteria->compare('short_desc', $this->short_desc, TRUE);
            $criteria->compare('slug', $this->slug, TRUE);
            $criteria->compare('answer', $this->answer, TRUE);
            $criteria->compare('folder_path', $this->folder_path, TRUE);
            $criteria->compare('created_date', $this->created_date, TRUE);
            $criteria->compare('created_by', $this->created_by, TRUE);
            $criteria->compare('updated_date', $this->updated_date, TRUE);
            $criteria->compare('updated_by', $this->updated_by, TRUE);
            $criteria->compare('public_date', $this->public_date, TRUE);
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

            return file_exists($dir_root . $this->folder_path) ? CHtml::image($dir_root . $this->folder_path, $this->question, array("width" => "100px", "height" => "60px", "title" => $this->question)) : CHtml::image("../images/no_img.png", "no image", array("width" => "100px", "height" => "60px", "title" => "no image"));
        }

        public function getNewsCategoriesNameByCateId()
        {
            $model = '';
            if ($this->categories_id) {
                $model = ANewsCategories::model()->find('id=' . $this->categories_id);
            }

            return ($model) ? CHtml::encode($model->name) : '<i style="color: pink;">Not set</i>';
        }

        public function beforeSave()
        {
            if (parent::beforeSave()) {
                $this->slug = Utils::unsign_string(uniqid());
                $this->updated_date = date('Y-m-d H:i:s', time());
                $this->updated_by   = Yii::app()->user->username;
                //delete old image
                $dir_old_file = '/../' . $this->old_file;
                if (!empty($this->old_file) && ($this->old_file != $this->folder_path) && file_exists(realpath(Yii::app()->getBasePath() . $dir_old_file))) {
                    unlink(realpath(Yii::app()->getBasePath() . $dir_old_file));
                }
            }

            return TRUE;
        }
    }
