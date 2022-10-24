<?php

    class WAds extends Ads
    {

        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         *
         * @param string $className active record class name.
         *
         * @return Ads the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }
        public static function getAdsByCode($code=''){
            $model = self::model()->findAllByAttributes(array('ads_code'=>$code),'status=1');
            return $model;
        }
    }
