<?php
/**
 * My mobile detech class extend from Mobile_detect class
 * I use for some purposes.
 *
 * @author thienhaxanh2405 <nguyenductoan2405@gmail.com>
 *
 * @license follow Mobile_detect library <http://mobiledetect.net/>
 *
 * @link thienhaxanh <http://thienhaxanh.info>
 *
 * @version 1.0.0
 *
 */

class MyMobileDetect extends Mobile_Detect
{

    /**
     * Is iphone device
     * @return bool
     */
    public function IsiPhoneDevice()
    {
        if (
            $this->isMobile() &&
            $this->isiPhone() &&
            $this->isiOS()
        ) {
            return true;
        } else {
            return false;
        }
    }// end function is device android


    /**
     * Is Android device
     * @return bool
     */
    public function IsAndroidDevice()
    {
        if (
            $this->isMobile() &&
            $this->isAndroidOS() &&
            $this->isSafari()
        ) {
            return true;
        } else {
            return false;
        }
    } //end function is android device


    /**
     * Is windows phone device
     * @return bool
     */
    public function IsWindowsPhoneDevice()
    {
        if (
            $this->isMobile() &&
            $this->isWindowsPhoneOS() &&
            $this->isIE()
        ) {
            return true;
        } else {
            return false;
        }
    } // end functoin is window phone device

    /**
     * code in the future
     */
    public function IsBlackberryMobile()
    {

    }

    /**
     * any other device
     */
}


?>