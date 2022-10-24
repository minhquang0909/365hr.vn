<?php

    class WNews extends News
    {
        /**
         * @return array relational rules.
         */
        public function relations()
        {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                'news' => array(self::HAS_MANY, 'WNewsTags', 'news_id'),
                'lang_detail' => array(self::HAS_MANY, 'NewsLang', 'parent_id'),
            );
        }

        /**
         * @param int $limit
         *
         * @return array|bool
         */
        public function getNewsOfCategoryInHomepage($limit = 3)
        {
            $results    = array();
            $categories = WNewsCategories::GetCategoriesInHomePage();
            if ($categories) {
                foreach ($categories as $one) {
                    $temp['category'] = $one;
                    $temp['news']     = $this->getNewsInCategory($one->id, false, false, $limit);
                    if ($temp) {
                        array_push($results, $temp);
                    }
                }
                if ($results) {
                    return $results;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        /**
         * @param            $categories_id
         * @param bool|FALSE $dataProvider
         * @param bool|FALSE $isParent
         * @param int        $limit
         * @param int        $offset
         * @param null       $order
         *
         * @return array|mixed|null
         */
        public function getNewsInCategory($categories_id, $dataProvider = false, $isParent = false, $limit = 6, $offset = 0, $order = null)
        {
            $criteria = new CDbCriteria();
            if ($isParent) {
                $criteria->condition = 'LENGTH(title) > 1  AND categories_id in(' . $categories_id . ') AND status=:status';
            } else {
                $criteria->condition = 'LENGTH(title) > 1  AND categories_id=:categories_id AND status=:status';
            }
            $criteria->limit  = $limit;
            $criteria->offset = $offset;
            if ($order) {
                $criteria->order = $order;
            } else {
                $criteria->order = 'created_date DESC';
            }
            if ($isParent) {
                $criteria->params = array('status' => self::NEWS_ACTIVE);
            } else {
                $criteria->params = array('categories_id' => $categories_id, 'status' => self::NEWS_ACTIVE);
            }

            if ($dataProvider) {
                $results = new CActiveDataProvider($this, array(
                    'criteria'   => $criteria,
                    'sort'       => array('defaultOrder' => 'id DESC'),
                    'pagination' => array(
                        'pageSize' => $limit,
                    )
                ));
            } else {
                $results = self::model()->findAll($criteria);

            }
            return $results;
        }

        /**
         * @param $id
         * @param $alias
         * @return bool
         */
        public function createUrl($id = null, $alias = null)
        {
            if (!$id && !$alias) {
                $id    = $this->id;
                $alias = $this->slug;
            }

            $str = Yii::app()->createUrl('news/detail', array('id' => $id, 'alias' => $alias));
            return $str;
        }

        /**
         * @param $id
         * @param $slug
         *
         * @return bool
         */
        public static function createUrlCaseStudy($id, $slug)
        {
            if (isset($id)) {
                $str = Yii::app()->controller->createUrl('case-study/detail/' . $id . '/' . $slug);
                return $str;
            } else {
                return false;
            }
        }

        /**
         * get list hot news
         * @param int $limit
         * @param int $offset
         *
         * @return static[]
         */
        public static function getListHotNews($limit = 4, $offset = 0)
        {
            $criteria           = new CDbCriteria;
            $criteria->distinct = true;
            $criteria->addCondition('status = ' . self::NEWS_ACTIVE);
            $criteria->addCondition('public_date <= NOW() ');
            $criteria->limit  = $limit;
            $criteria->offset = $offset;
            $criteria->order  = "public_date DESC, id DESC ";
            $results          = WNews::model()->findAll($criteria);
            return $results;
        }

        /**
         * @param int $limit
         * @param int $offset
         *
         * @return array|mixed|null
         */
        public function getListNewsByTopViews($limit = 5, $offset = 0)
        {
            $criteria           = new CDbCriteria;
            $criteria->distinct = true;
            $criteria->addCondition('status = ' . self::NEWS_ACTIVE);
            $criteria->addCondition('public_date <= NOW() ');
            $criteria->limit  = $limit;
            $criteria->offset = $offset;
            $criteria->order  = "views DESC, public_date DESC ";
            $results          = WNews::model()->findAll($criteria);
            return $results;
        }

        public static function getNewsDetails($id)
        {
            $results = self::model()->find('id="' . $id . '" AND status = ' . self::NEWS_ACTIVE);
            return $results;
        }

        /**
         * get list news related
         * @param     $news_id
         * @param     $categories_id
         * @param     $public_date
         * @param int $limit
         * @param int $offset
         *
         * @return array|mixed|null
         */
        public function getNewsRelated($news_id, $categories_id, $public_date, $limit = 4, $offset = 0)
        {
            $criteria           = new CDbCriteria;
            $criteria->distinct = true;
            $criteria->addCondition('status = ' . self::NEWS_ACTIVE);
            $criteria->addCondition('id <> "' . $news_id . '"');
            $criteria->addCondition('categories_id = "' . $categories_id . '"');
            $criteria->limit  = $limit;
            $criteria->offset = $offset;
            $results          = self::model()->findAll($criteria);

            return $results;
        }

        /**
         * Get list tag by news
         * @param $news_id
         *
         * @return static[]
         */
        public function getAllTagsByNewsId($news_id)
        {
            $criteria           = new CDbCriteria;
            $criteria->distinct = true;
            $criteria->with     = array('tags');
            $criteria->addCondition('nt.news_id = ' . $news_id);
            $results = WTags::model()->findAll($criteria);

            return $results;
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
        public function getDetailLang(){
            $data = NewsLang::model()->find('language_id='.Yii::app()->session['language_id'] .' AND parent_id='.$this->id);
            return $data;
        }
    }
