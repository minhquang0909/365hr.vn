<?php

    class ASystemGroup extends SystemGroup
    {
        public $from;
        public $to;

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('group_title, group_desc, status', 'required'),
                array('status', 'numerical', 'integerOnly' => TRUE),
                array('group_title', 'length', 'max' => 255),
                array('group_desc, created_date', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, group_title, group_desc, status, created_date', 'safe', 'on' => 'search'),
            );
        }

        public function totalUserInGroup()
        {
            $user = ASystemGroup::model()->count(array(
                'condition' => 'group_id=:group_id',
                'params'    => array(':group_id' => $this->id),
            ));

            return $user;
        }

        /**
         * function get status
         */
        public static function getStatusOptions()
        {
            return array(
                '0' => 'Ngừng hoạt động',
                '1' => 'Kích hoạt',
                '2' => 'Bản nháp'
            );
        }

        public static function getStatusText($status_id)
        {
            $statusOptions = ASystemGroup::getStatusOptions();

            return isset($statusOptions[$status_id]) ? $statusOptions[$status_id] : 'unknown status({$status_id})';
        }

        public static function getDescriptionController($text)
        {
            return Yii::t('adm/controller', "$text");
        }
    }

?>