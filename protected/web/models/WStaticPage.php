<?php

    class WStaticPage extends StaticPage
    {
        public $sub;

        /**
         * @return array relational rules.
         */
        public function relations()
        {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                'lang_detail' => array(self::HAS_MANY, 'StaticPageLang', 'parent_id'),
            );
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

        public static function getMenu($position = self::MENU_TOP)
        {
            $key_cache = 'statistic_page_menu_'.$position . Yii::app()->session['language_id'];
            $cacheData = Yii::app()->cache->get($key_cache);
            if (!$cacheData) {
                $cate = self::model()->findAll("status=1 and position = '$position' order by sort_order asc");
                /*                $cate = self::model()->with(array(
                                    'lang_detail' => array(
                                        'select'    => 'title,slug',
                                        // but want to get only users with published posts
                                        'joinType'  => 'INNER JOIN',
                                        'condition' => 'lang_detail.language_id=' . Yii::app()->session['language_id'],
                                    ),
                                ))->findAll(array('order' => 't.sort_order asc', 'condition' => "t.status=1 and t.position = '$position' "));*/
                foreach ($cate as $row) {
                    $sub = StaticPageLang::model()->find(array(
                        'select'    => 'title,slug',
                        'condition' => "language_id=" . Yii::app()->session['language_id'] . " and parent_id=" . $row->id,
                    ));
                    //$sub      = StaticPageLang::model()->find('parent_id=' . $row->id);
                    $row->sub = $sub;
                }
                $cacheData = $cate;
                Yii::app()->cache->set($key_cache, $cacheData, 3600);
            }
            return $cacheData;
        }

        public function createUrl($id = null, $alias = null)
        {
            if (!$id && !$alias) {
                $id    = $this->id;
                $alias = $this->slug;
            }

            $str = Yii::app()->createUrl('page/detail', array('id' => $id, 'alias' => $alias));
            return $str;
        }

        public static function getDetails($id)
        {
            $model = self::model()->find('id="' . $id . '" AND status = ' . self::NEWS_ACTIVE);
            if ($model) {
                $sub        = StaticPageLang::model()->find(array(
                    'condition' => "language_id=" . Yii::app()->session['language_id'] . " and parent_id=" . $model->id,
                ));
                $model->sub = $sub;
            }
            return $model;
        }
    }
