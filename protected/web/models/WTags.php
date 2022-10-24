<?php

/**
 * This is the model class for table "{{tags}}".
 *
 * The followings are the available columns in table '{{tags}}':
 * @property integer $id
 * @property string $name
 * @property string $slug
 */
class WTags extends Tags
{

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'tags'    => array(self::HAS_MANY, 'WNewsTags', 'tags_id'),
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tags the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Create url by tag slug
     * @return bool|string
     */
    public function createUrl()
    {
        $slug = $this->clean($this->slug);
        if (isset($this->id)) {
            $str = Yii::app()->controller->createUrl('tags/' . $this->id .'/' . $slug);

            return $str;
        } else {
            return FALSE;
        }
    }

    /**
     * Get tags by id
     * @param $id
     * @return array|mixed|null|string|static
     */
    public static function getTagsIdById($id)
    {
        $results = '';
        if ($id) {
            $results = self::model()->find('id="' . $id . '"');
        }

        return $results;
    }
	/*replace all characters that are not alpha, number and - to -*/
    private function clean($string) {
        $string = str_replace(' ', '-', $string);
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);

        return preg_replace('/-+/', '-', $string);
    }
}
