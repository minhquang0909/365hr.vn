<?php

    /**
     * This is the model class for table "{{banners}}".
     *
     * The followings are the available columns in table '{{banners}}':
     *
     * @property string  $id
     * @property string  $file_name
     * @property string  $file_ext
     * @property string  $folder_path
     * @property string  $target_link
     * @property integer $banner_positions_id
     * @property integer $banner_sizes_id
     * @property integer $status
     */
    class ABanners extends Banners
    {
        public $old_banner;

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('banner_positions_id, banner_sizes_id, status', 'required'),
                array('banner_positions_id, banner_sizes_id, status', 'numerical', 'integerOnly' => TRUE),
                array('file_name', 'length', 'max' => 500),
                array('file_ext', 'length', 'max' => 10),
                array('folder_path, target_link', 'length', 'max' => 1000),
                array('target_link','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),
                array('folder_path', 'file', 'on'    => 'insert',
                                             'types' => 'jpg, jpeg',
                                             'maxSize' => 1024 * 300 ,
                                             'tooLarge'=>Yii::t('common/Banners', 'error_file_size')
                ),
                array('folder_path', 'file', 'on'         => 'update_file',
                                             'types'      => 'jpg, jpeg',
                                             'allowEmpty' => TRUE,
                                             'maxSize' => 1024 * 300 ,
                                             'tooLarge'=>Yii::t('common/Banners', 'error_file_size')

                ),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('id, file_name, file_ext, folder_path, target_link, banner_positions_id, banner_sizes_id, status', 'safe', 'on' => 'search'),
            );
        }

        /**
         * @return array relational rules.
         */
        public function relations()
        {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                'positions' => array(self::HAS_MANY, 'ABannerPositions', 'banner_positions_id'),
                'sizes'     => array(self::HAS_MANY, 'ABannerSizes', 'banner_sizes_id'),
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
            $criteria->compare('file_name', $this->file_name, TRUE);
            $criteria->compare('file_ext', $this->file_ext, TRUE);
            $criteria->compare('folder_path', $this->folder_path, TRUE);
            $criteria->compare('target_link', $this->target_link, TRUE);
            $criteria->compare('banner_positions_id', $this->banner_positions_id);
            $criteria->compare('banner_sizes_id', $this->banner_sizes_id);
            $criteria->compare('status', $this->status);

            return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
        }

        /*
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         *
         * @param string $className active record class name.
         *
         * @return Banners the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        public static function getStatus()
        {
            return array(
                array('id' => '1', 'title' => Yii::t('common/Banners', 'active')),
                array('id' => '0', 'title' => Yii::t('common/Banners', 'inactive')),
            );
        }

        public function quickView($id)
        {
            Yii::app()->controller->widget('booster.widgets.TbButton',
                array(
                    'label'       => Yii::t('common/Banners', 'quick_view'),
                    'context'     => 'primary',
                    'htmlOptions' => array(
                        'data-toggle' => 'modal',
                        'data-target' => '#myModal',
                        'onclick'     => '
                            $.ajax({
                                url: "index.php?r=ABanners/quickview",
                                dataType: "json",
                                type: "POST",
                                data: {"id":' . $id . '},
                                success: function (json) {
                                    $("#viewbanner").html(json.content);
                                }
                            });
                        ',
                    ),
                ));
        }

        public function cleanup()
        {
            unlink(realpath(Yii::app()->getBasePath() . '/' . $this->old_banner));
        }
    }
