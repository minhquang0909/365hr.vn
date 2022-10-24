<?php

    class WAlbum extends Album
    {

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
            $criteria->compare('title', $this->title, true);
            $criteria->compare('status', $this->status);

            return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
        }

        public function createUrl($id = null, $alias = null)
        {
            if (!$id && !$alias) {
                $id    = $this->id;
                $alias = CFunction::unsign_string($this->title);
            }

            $str = Yii::app()->createUrl('gallery/categories', array('id' => $id, 'alias' => $alias));
            return $str;
        }

        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         * @param string $className active record class name.
         * @return Album the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        public function getDataHomePage()
        {
            $return = new CActiveDataProvider('WGallery', array(
                'sort' => array('defaultOrder' => 'id DESC'),
                'pagination' => array(
                    'pageSize' => 12,
                )
            ));
            return $return;
        }
    }
