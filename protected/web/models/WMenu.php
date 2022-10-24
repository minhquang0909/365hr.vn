<?php

    class WMenu extends Menu
    {
        public static function getTopMenu()
        {
            $key_cache = 'cate';
            $cacheData = Yii::app()->cache->get($key_cache);
            if (!$cacheData) {
                $cate = WSoicauCategories::model()->findAll('status=1 order by sort_order desc');
                foreach ($cate as $row) {
                    $sub      = WSoicau::model()->findAll('status=1 and categories_id=' . $row->id . ' order by sort_order desc');
                    $row->sub = $sub;
                }
                $cacheData = $cate;
                Yii::app()->cache->set($key_cache, $cacheData, 3600);
            }
            return $cacheData;
        }
        public static function getNewsMenu()
        {

            $key_cache = 'cate_news';
            $cacheData = Yii::app()->cache->get($key_cache);
            if (!$cacheData) {
                $cate = WNewsCategories::model()->findAll('status=1 order by sort_order desc');
                foreach ($cate as $row) {
                    $sub      = WNewsCategories::model()->findAll('status=1 and parent_id=' . $row->id . ' order by sort_order desc');
                    $row->sub = $sub;
                }
                $cacheData = $cate;
                Yii::app()->cache->set($key_cache, $cacheData, 3600);
            }
            return $cacheData;
        }
    }
