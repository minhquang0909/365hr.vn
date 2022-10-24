<?php

/**
 * This is the model class for table "{{comment}}".
 *
 * The followings are the available columns in table '{{comment}}':
 * @property string $id
 * @property string $news_id
 * @property string $fullname
 * @property string $email
 * @property string $content
 * @property integer $created_date
 * @property integer $status
 * @property string $note
 */
class Comment extends CActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{comment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('news_id, fullname, email, content', 'required', 'message'=>Yii::t('web/app', 'can_not_blank')),
			array('created_date, status', 'numerical', 'integerOnly'=>true),
			array('news_id', 'length', 'max'=>11),
            array('email','email'),
			array('fullname, email', 'length', 'max'=>255),
			array('note', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, news_id, fullname, email, content, created_date, status, note', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
		    'id'       =>   'ID',
            'news_id' => Yii::t('web/app','news'),
            'fullname' => Yii::t('web/app','your_name'),
            'email' => Yii::t('web/app','email'),
            'content' => Yii::t('web/app','comment_content'),
            'created_date' => Yii::t('web/app','created_date'),
            'note' => Yii::t('web/app','note'),
            'status' => Yii::t('web/app','status'),
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
		$criteria->compare('news_id',$this->news_id,true);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('created_date',$this->created_date);
		$criteria->compare('status',$this->status);
		$criteria->compare('note',$this->note,true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'     => array('defaultOrder' => 'id DESC'),
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
