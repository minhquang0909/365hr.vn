<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class WContacts extends Contacts
{
   // public $verifyCode;
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fullname, email, phone,message', 'required','message'=>(Yii::t('web/contact', 'error_field_blank')." {attribute}")),
            array('status', 'numerical', 'integerOnly'=>true),
            array('fullname', 'length','min'=>6, 'max'=>100),
            array('company', 'length', 'max'=>255),
            array('email', 'email'),
            array('phone','length','min'=>9,'max'=>15,),
            array('email', 'length', 'max'=>50),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, fullname, company, email, phone, message, status', 'safe', 'on'=>'search'),
          //  array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
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
            'fullname' => Yii::t('web/contact','fullname'),
            'company' => Yii::t('web/contact','company'),
            'email' => Yii::t('web/contact','email'),
            'phone' => Yii::t('web/contact','phone'),
            'message' => Yii::t('web/contact','message'),
            'status' => 'Status',

          // 'verifyCode'=>Yii::t('web/contact','verify_code'),
        );
    }

    public static function getContactMailList($mail,$class=''){
        $arr = explode('|',$mail);
        $return = '';
        foreach ((array)$arr as $row){
            $return.='<a href="mailto:'.$row.'" class="'.$class.'">'.$row.'</a>';
        }
        echo $return;
    }
    public static function getContactPhoneList($mail,$class='',$title=''){
        $arr = explode('|',$mail);
        $return = '';
        foreach ((array)$arr as $row){
            $row = trim($row);
            $return.=' <a title="'.$title.'" href="tel:'.$row.'" class="'.$class.'">'.$row.'</a>';
        }
        echo $return;
    }
}