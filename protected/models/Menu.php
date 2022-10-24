<?php

    /**
     * This is the model class for table "{{menu}}".
     *
     * The followings are the available columns in table '{{menu}}':
     * @property integer $id
     * @property integer $parent_id
     * @property integer $type_menu
     * @property string  $title
     * @property string  $link
     * @property integer $ordering
     * @property integer $status
     * @property string  $created_at
     */
    class Menu extends CActiveRecord
    {
        const MENU_TOP = 0, MENU_MAIN = 1, MENU_FOOTER = 2, MENU_LEFT = 3, MENU_RIGHT = 4;
        const ACTIVE = 1, INACTIVE = 0;

        /**
         * @return string the associated database table name
         */
        public function tableName()
        {
            return '{{menu}}';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('type_menu, created_at', 'required'),
                array('parent_id, type_menu, ordering, status', 'numerical', 'integerOnly' => true),
                array('title, link', 'length', 'max' => 255),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('id, parent_id, type_menu, title, link, ordering, status, created_at', 'safe', 'on' => 'search'),
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
                'id'         => 'ID',
                'parent_id'  => 'Danh mục cha',
                'type_menu'  => 'Kiểu menu: 0 - menu top, 1 - menu main, 2 - menu footer',
                'title'      => 'Tên Menu',
                'link'       => 'Link',
                'ordering'   => 'Thứ tự',
                'status'     => 'Trạng thái',
                'created_at' => 'Created At',
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

            $criteria->compare('id', $this->id);
            $criteria->compare('parent_id', $this->parent_id);
            $criteria->compare('type_menu', $this->type_menu);
            $criteria->compare('title', $this->title, true);
            $criteria->compare('link', $this->link, true);
            $criteria->compare('ordering', $this->ordering);
            $criteria->compare('status', $this->status);
            $criteria->compare('created_at', $this->created_at, true);

            return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         * @param string $className active record class name.
         * @return Menu the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        public static function getType()
        {
            return array(
                self::MENU_TOP    => 'Menu Top',
                self::MENU_MAIN   => 'Menu chính',
                self::MENU_FOOTER => 'Menu chân trang',
                self::MENU_LEFT   => 'Menu trái',
                self::MENU_RIGHT  => 'Menu phải',
            );
        }
    }
