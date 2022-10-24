<?php

/**
 * This is the model class for table "{{contact}}".
 *
 * The followings are the available columns in table '{{contact}}':
 * @property string $id
 * @property string $conpany_name
 * @property string $department_name
 * @property string $contact_name
 * @property integer $phone
 * @property string $email
 * @property string $district
 * @property string $address
 * @property string $subject
 * @property string $created_date
 * @property string $content
 * @property string $note
 */
class Contact extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{contact}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contact_name, email, subject', 'required'),
			array('phone', 'numerical', 'integerOnly'=>true),
			array('conpany_name, department_name, contact_name, district, address', 'length', 'max'=>255),
			array('email', 'length', 'max'=>50),
			array('subject', 'length', 'max'=>100),
			array('created_date', 'length', 'max'=>11),
			array('content', 'length', 'max'=>2200),
			array('note', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, conpany_name, department_name, contact_name, phone, email, district, address, subject, created_date, content, note', 'safe', 'on'=>'search'),
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
			'conpany_name' => 'Tên công ty',
			'department_name' => 'Tên bộ phận',
			'contact_name' => 'Tên liên hệ',
			'phone' => 'Điện thoại',
			'email' => 'Email',
			'district' => 'Quận',
			'address' => 'Địa chỉ',
			'subject' => 'Chủ đề',
			'created_date' => 'Ngày tạo',
			'content' => 'Nội dung',
			'note' => 'Ghi chú',
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
		$criteria->compare('conpany_name',$this->conpany_name,true);
		$criteria->compare('department_name',$this->department_name,true);
		$criteria->compare('contact_name',$this->contact_name,true);
		$criteria->compare('phone',$this->phone);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('district',$this->district,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('content',$this->content,true);
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
	 * @return Contact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
