<?php

/**
 * This is the model class for table "{{news_tags}}".
 *
 * The followings are the available columns in table '{{news_tags}}':
 * @property integer $news_id
 * @property integer $tags_id
 */
class WNewsTags extends NewsTags
{
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NewsTags the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}
