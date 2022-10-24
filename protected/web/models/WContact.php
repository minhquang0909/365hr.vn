<?php
class WContact extends Contact{
    public $agree;
    public $captcha;
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('contact_name, subject,email,content', 'required','message'=>Yii::t('web/app', 'can_not_blank')),
            array('agree', 'numerical', 'integerOnly'=>true),
            array('agree', 'checkAgree'),
            array('captcha', 'checkCaptcha'),
            array('phone', 'numerical', 'integerOnly'=>true,'message' => Yii::t('web/app', "Phone numbers must be numeric")),
            //array('phone', 'match', 'pattern' => '/^([0-9])+$/', 'message' => Yii::t('web/app','Phone numbers must be numeric')),
            array('district, address', 'length', 'max'=>200),
            array('conpany_name, department_name,contact_name', 'length', 'max'=>100),
            array('email', 'length', 'max'=>50),
            array('email','email','message'=>Yii::t('web/app','Email not vaidate')),
            array('phone', 'validatePhone'),
            array('subject', 'length', 'max'=>100),
            array('created_date', 'length', 'max'=>11),
            array('content', 'length', 'max'=>2200),
            array('note', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, conpany_name, department_name, contact_name, phone, email, district, address, subject, created_date, content, note', 'safe', 'on'=>'search'),
        );
    }

    public function validatePhone(){
        if ( (str_replace(array(" "),"",trim($this->phone))!="") && (strlen($this->phone) < 9 ) || (strlen($this->phone) > 15) ) {
            $this->addError('phone', Yii::t('web/app', 'Enter the correct phone number'));
            return false;
        }
        return true;
    }
    public function checkAgree() {
        if ($this->agree == 0) {
            $this->addError('agree', Yii::t('web/app', 'can_not_blank'));
            return false;
        }
        return true;
    }

    public function checkCaptcha() {
        if ($this->captcha == 0) {
            $this->addError('captcha', Yii::t('web/app', 'can_not_blank'));
            return false;
        }
        return true;
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'conpany_name' => Yii::t('web/app','conpany_name'),
            'department_name' => Yii::t('web/app','department_name'),
            'contact_name' => Yii::t('web/app','contact_name'),
            'phone' => Yii::t('web/app','phone'),
            'email' => Yii::t('web/app','email'),
            'district' => Yii::t('web/app','district'),
            'address' => Yii::t('web/app','address'),
            'subject' => Yii::t('web/app','subject'),
            'created_date' => Yii::t('web/app','created_date'),
            'content' => Yii::t('web/app','content'),
            'note' => Yii::t('web/app','note'),
            'agree' => Yii::t('web/app','I agree with the above terms'),
            'captcha' => 'captcha',
        );
    }
}