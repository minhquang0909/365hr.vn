<?php

    class ACustomers extends Customers
    {
        private       $_identity;
        public static $old_avatar;

        const SILVER_POINT = 0;
        const GOLD_POINT   = 1;
        const BUY_CARD     = 'buycard';
        const DOC_SALE     = 'docsale';
        const DOC_BUY      = 'download';
        const DOC_SHARE    = 'share';

        /**
         * @return array relational rules.
         */
        public function relations()
        {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                'documents'  => array(self::HAS_MANY, 'WDocument', 'user_id'),//Quan Tam
                'following'  => array(self::HAS_MANY, 'FollowerList', 'user_id'),//Quan Tam
                'followers'  => array(self::HAS_MANY, 'FollowerList', 'follower_id'),//Duoc Quan Tam
                'docGallery' => array(self::HAS_MANY, 'DocumentGallery', 'user_id'),
                'docGallery' => array(self::HAS_MANY, 'DocumentGallery', 'user_id'),
                'eBank'      => array(self::HAS_ONE, 'AEbank', 'customer_id'),
            );
        }


        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
            return array(
                'id'            => 'ID',
                'msisdn'        => 'Điện thoại',
                'username'      => 'Tài khoản',
                'password'      => 'Mật khẩu',
                'email'         => 'Email',
                'birthday'      => 'Birthday',
                'address'       => 'Address',
                'create_time'   => 'Ngày đăng ký',
                'last_update'   => 'Last Update',
                'expire_date'   => 'Expire Date',
                'token_key'     => 'Token Key',
                'first_name'    => 'Tên',
                'last_name'     => 'Họ',
                'bio'           => 'Bio',
                'status'        => 'Trạng thái',
                'facebook_id'   => 'Facebook ID',
                'googleplus_id' => 'Googleplus ID',
                'avatar'        => 'Avatar',
                'gender'        => 'Gender',
                'login_count'   => 'Login Count',
                'total_upload'  => 'Tải lên',
            );
        }

        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         *
         * @param string $className active record class name.
         *
         * @return Customers the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        public function beforeSave()
        {
            $this->last_update = date('Y-m-d H:i:s');

            return true;
        }


        public function getAllMembers()
        {
            $criteria            = new CDbCriteria();
            $criteria->condition = 'status=1';
            $criteria->order     = 'id desc';
            $dataProvider        = new CActiveDataProvider($this, array(
                'criteria'   => $criteria,
                'pagination' => array(
                    'pageSize' => 18,
                    'pageVar'  => 'c_page',
                ),
            ));

            return $dataProvider;

        } //end get customer bet list

        public function getImage()
        {
            if (substr($this->avatar, 0, 4)=='http') {
                return $this->avatar;
            } else {
                return $GLOBALS['config_common']['project']['upload_url'].$this->avatar;
            }
        }

        /**
         * CREATE CUSTOMER URL
         *
         * @return string
         */
        public function createUrl()
        {
            $str_alias = CFunction::clean_url($this->first_name.''.$this->last_name);
            if (isset($this->id)) {
                return Yii::app()->createUrl('customer/member', array('id' => $this->id, 'alias' => $str_alias));
            } else {
                return '';
            }

        }

        public function getMoney($type = self::GOLD_POINT, $formated = true)
        {
            $money = 0;
            if (isset($this->eBank)) {
                if ($type==self::GOLD_POINT) {
                    $money = $this->eBank->gold_point;
                } else {
                    $money = $this->eBank->silver_point;
                }
            }
            if ($formated) {
                return CFunction::number_format($money, 0, '.');
            } else {
                return $money;
            }
        }

        public function search()
        {
            // @todo Please modify the following code to remove attributes that should not be searched.

            $criteria = new CDbCriteria;

            $criteria->compare('id', $this->id, true);
            $criteria->compare('msisdn', $this->msisdn, true);
            $criteria->compare('username', $this->username, true, 'OR');
            $criteria->compare('password', $this->password, true);
            $criteria->compare('email', $this->email, true, 'OR');
            $criteria->compare('birthday', $this->birthday, true);
            $criteria->compare('address', $this->address, true);

            $criteria->compare('create_time', $this->create_time, true);
            $criteria->compare('last_update', $this->last_update, true);
            $criteria->compare('expire_date', $this->expire_date, true);
            $criteria->compare('token_key', $this->token_key, true);
            $criteria->compare('first_name', $this->first_name, true, 'OR');
            $criteria->compare('last_name', $this->last_name, true, 'OR');
            $criteria->compare('bio', $this->bio, true);
            $criteria->compare('status', $this->status);
            $criteria->compare('facebook_id', $this->facebook_id, true);
            $criteria->compare('googleplus_id', $this->googleplus_id, true);
            $criteria->compare('avatar', $this->avatar, true);
            $criteria->compare('gender', $this->gender, true);
            $criteria->compare('login_count', $this->login_count);

            return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
                'sort'     => array(
                    'defaultOrder' => 'id desc',
                ),
            ));
        }
        /**
         * Get Top Doanh thu
         *
         * @param $limit
         *
         * @return array|bool|CActiveDataProvider|static[]
         */
        public static function getTopDoanhThu($limit = 5)
        {
            $criteria            = new CDbCriteria();
            $criteria->condition = 'account_type is null';
            $criteria->order     = 'silver_point desc';
            $criteria->limit     = $limit;
            $return              = AEbank::model()->findAll($criteria);

            return $return;

        } //end get customer bet list
    }