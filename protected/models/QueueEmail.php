<?php

/**
 * This is the model class for table "{{queue_email}}".
 *
 * The followings are the available columns in table '{{queue_email}}':
 * @property string $id
 * @property string $type
 * @property string $email
 * @property string $content
 * @property string $created_date
 */
class QueueEmail extends CActiveRecord
{
    const TYPE_CONTACT = 'contact';
    const TYPE_GENERAL = 'general';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{queue_email}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, email, content, created_date', 'required'),
			array('type', 'length', 'max'=>7),
			array('email', 'length', 'max'=>150),
			array('created_date', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, email, content, created_date', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'type' => 'Type',
			'email' => 'Email nhận',
			'content' => 'Nội dung',
			'created_date' => 'Ngày tạo',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('created_date',$this->created_date,true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'     => array('defaultOrder' => 'id DESC'),
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return QueueEmail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
