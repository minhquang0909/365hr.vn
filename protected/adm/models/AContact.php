<?php
class AContact extends Contact{
    public static function createCheckBox($id){
            return '<input type="checkbox" name="checkContact" value="'.$id.'"/>';
    }
}