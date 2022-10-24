<?php

class WGallery extends Gallery
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
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('file_ext',$this->file_ext,true);
		$criteria->compare('folder_path',$this->folder_path,true);
		$criteria->compare('target_link',$this->target_link,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('album_id',$this->album_id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('created_time',$this->created_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Gallery the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getDataInCategory($categories_id, $dataProvider = false, $isParent = false, $limit = 6, $offset = 0, $order = null)
    {
        $criteria = new CDbCriteria();
        if ($isParent) {
            $criteria->condition = 'album_id in(' . $categories_id . ') AND status=:status';
        } else {
            $criteria->condition = 'album_id=:album_id AND status=:status';
        }
        $criteria->limit  = $limit;
        $criteria->offset = $offset;
        if ($order) {
            $criteria->order = $order;
        } else {
            $criteria->order = 'created_time DESC';
        }
        if ($isParent) {
            $criteria->params = array('status' => 1);
        } else {
            $criteria->params = array('album_id' => $categories_id, 'status' => 1);
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

}
