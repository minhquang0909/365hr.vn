<?php

    class AGallery extends Gallery
    {
        public $file;
        public $old_file;
        public $gallery_items;

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('file_name, file_ext, folder_path, status', 'required'),
                array('status, album_id, parent_id', 'numerical', 'integerOnly' => true),
                array('file_name', 'length', 'max' => 500),
                array('file_ext', 'length', 'max' => 10),
                array('folder_path, target_link', 'length', 'max' => 1000),
                array('file,gallery_items', 'file', 'on'    => 'insert',
                                                    'types' => 'jpg,jpeg,png', 'allowEmpty' => true
                ),
                array('file,gallery_items', 'file', 'on'    => 'update_file',
                                                    'types' => 'jpg,jpeg,png', 'allowEmpty' => true
                ),
                array('title', 'length', 'max' => 255),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('id, file_name, file_ext, folder_path, target_link, status, title, album_id, parent_id', 'safe', 'on' => 'search'),
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
                'id'          => 'ID',
                'file_name'   => 'File Name',
                'file_ext'    => 'File Ext',
                'folder_path' => 'Folder Path',
                'target_link' => 'Link',
                'status'      => 'Status',
                'title'       => 'Tên Ảnh',
                'album_id'    => 'Album',
                'parent_id'   => 'Sản phẩm',
                'created_time' => 'Ngày tạo',
                'gallery_items' =>  'Ảnh',
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
            $criteria->compare('file_name', $this->file_name, true);
            $criteria->compare('file_ext', $this->file_ext, true);
            $criteria->compare('folder_path', $this->folder_path, true);
            $criteria->compare('target_link', $this->target_link, true);
            $criteria->compare('status', $this->status);
            $criteria->compare('title', $this->title, true);
            $criteria->compare('album_id', $this->album_id);
            $criteria->compare('parent_id', $this->parent_id);

            return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
                'sort'     => array(
                    'defaultOrder' => 'id desc',
                )
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         * @param string $className active record class name.
         * @return Gallery the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        public function getNewsCategoriesNameByCateId()
        {
            $model = '';
            if ($this->album_id) {
                $model = AAlbum::model()->find('id=' . $this->album_id);
            }

            return ($model) ? CHtml::encode($model->title) : '<i style="color: pink;">Not set</i>';
        }

        public function getNewsProductNameByCateId()
        {
            $model = '';
            if ($this->parent_id) {
                $model = AProduct::model()->find('id=' . $this->parent_id);
            }

            return ($model) ? CHtml::encode($model->title) : '<i style="color: pink;">Not set</i>';
        }

        public function beforeSave()
        {
            if (parent::beforeSave()) {
                $this->created_time = date('Y-m-d H:i:s');
            }

            return true;
        }
    }
