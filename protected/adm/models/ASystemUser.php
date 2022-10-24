<?php

    class ASystemUser extends SystemUser
    {
        public $confirmPassword;
        public $initialPassword;

        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }


        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('username,password', 'required'),
                array('password', 'compare', 'compareAttribute' => 'confirmPassword' /*, 'on' => 'changePassword'*/),
                array('status, group_id,cp_code', 'numerical', 'integerOnly' => TRUE),
                array('id, password', 'length', 'max' => 255),
                array('username, ip', 'length', 'max' => 50),
                array('created_date, lastest_login', 'safe'),
                array('email', 'email', 'message' => Yii::t('adm/app', 'warning_email')),
                array('phonenumber', 'match', 'pattern' => '/^([+]?[0-9 ]+)$/'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, username, password,channel_code,cp_code, phonenumber, email, status, created_date, lastest_login, ip, group_id', 'safe', 'on' => 'search'),
            );
        }


        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
            return array(
                'id'              => 'ID',
                'ip'              => 'Ip',
                'username'        => Yii::t('adm/system', 'username'),
                'password'        => Yii::t('adm/system', 'password'),
                'confirmPassword' => Yii::t('adm/system', 'confirmPassword'),
                'status'          => Yii::t('adm/system', 'status'),
                'created_date'    => Yii::t('adm/system', 'create_date'),
                'lastest_login'   => Yii::t('adm/system', 'last_login'),
                'group_id'        => Yii::t('adm/system', 'group_id'),
                'phonenumber'     => Yii::t('adm/system', 'phonenumber'),
                'email'           => Yii::t('adm/system', 'email'),
                'cp_code'         => Yii::t('adm/system', 'cp_code'),
                'channel_code'    => Yii::t('adm/system', 'channel_code'),
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
                'groups' => array(self::BELONGS_TO, 'SystemGroup', 'group_id'),
            );
        }

        public function getSystemUserById($id)
        {
            return ASystemUser::model()->find('id=:id', array(':id' => (int)$id));
        }

        public static function getUserNameById($id)
        {
            $criteria            = new CDbCriteria;
            $criteria->select    = 'username';
            $criteria->condition = 'id=:id';
            $criteria->params    = array(
                ':id' => (int)$id,
            );

            $rs = ASystemUser::model()->find($criteria);
            if (isset($rs) && $rs['username'] != '') {
                return $rs['username'];
            } else {
                return FALSE;
            }
        }

        public static function changePass($id, $new_pass)
        {
            $user           = self::model()->findByPk($id);
            $user->password = $new_pass;

//            CVarDumper::dump()
            if ($user->save()) {
                return TRUE;
            } else {
                return $user->getErrors();
            }
        }
    }

?>