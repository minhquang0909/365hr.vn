<?php

    class WNewsCategories extends NewsCategories
    {
        public $sub;

        /**
         * Get Categories in home page
         * @return array|mixed|null
         */
        public static function GetCategoriesInHomePage()
        {
            $criteria           = new CDbCriteria;
            $criteria->distinct = true;
            $criteria->addCondition('status = ' . self::NEWS_CATE_ACTIVE . ' AND in_home_page = 1');
            $criteria->order = "sort_order ";
            $results         = self::model()->findAll($criteria);
            return $results;
        }

        /**
         * @param null $id
         * @param null $alias
         * @return mixed
         */
        public function createUrl($id = null, $alias = null)
        {
            if (!$id && !$alias) {
                $id    = $this->id;
                $alias = $this->slug;
            }

            $str = Yii::app()->createUrl('news/categories', array('id' => $id, 'alias' => $alias));
            return $str;
        }

        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         * @param string $className active record class name.
         * @return NewsCategories the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }
        public static function getMenu()
        {
            $key_cache = 'news_cat_menu_' . Yii::app()->session['language_id'];
            $cacheData = Yii::app()->cache->get($key_cache);
            if (!$cacheData) {
                $cate = self::model()->findAll("status=1 order by sort_order asc");
                foreach ($cate as $row) {
                    $sub      = NewsCategoriesLang::model()->find(array(
                        'select'    => 'name,slug',
                        'condition' => "language_id=" . Yii::app()->session['language_id'] . " and category_id=" . $row->id,
                    ));
                    $row->sub = $sub;
                }
                $cacheData = $cate;
                Yii::app()->cache->set($key_cache, $cacheData, 3600);
            }
            return $cacheData;
        }
    }
