<?php

    class Utils
    {

        public static function getCurlData($url)
        {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_TIMEOUT, 5);
            curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
            $curlData = curl_exec($curl);
            curl_close($curl);

            return $curlData;
        }

        /**
         * Do post request
         *
         * @param string $url           This is full, qualified, web service or web page URL, it must contain with
         *                              http:// or https://
         * @param string $function_name string, optional, default empty string - Remote functio name, no need for
         *                              access web pages
         * @param array  $ary_param     associative array - post values
         * @param bool   $auth_flag     It makes a request with authentication or not, if it chagne to true, next 2
         *                              params(username and pasword) should not be empty
         * @param string $username      username for authentication
         * @param string $password      password for authentication
         *
         * @return string or FALSE on failure.
         */
        public static function do_post_request($url, $function_name = '', $param = '', $timeout = 3, $auth_flag = false, $username = '', $password = '')
        {
            $auth_param = ""; // check authentication enable or not
            if ($auth_flag) {
                if ($username=="") {
                    return false;
                }
                if ($password=="") {
                    return false;
                }
                $auth_param = "Authorization: Basic ".base64_encode($username.':'.$password)."\r\n";
            }

            // construct web service URL
            $ws_req_url = $url.($function_name ? '/'.$function_name : '');
//            $ws_req_url .= ($function_name ? '/' . $function_name : '');// check whether function name available or not

            // construct params array to query string format
            $query_param = is_array($param) ? http_build_query($param) : $param;

            $params = array(
                'http' => array(
                    'ignore_errors' => true,
                    'method'        => 'POST',
                    'header'        => "Content-type: application/x-www-form-urlencoded\r\n".$auth_param,
                    'content'       => $query_param,
                ),
            );

            $context = stream_context_create($params);
            stream_set_timeout($context, $timeout);
            $stream   = fopen($ws_req_url, 'r', false, $context); //check to make sure that allow_url_fopen is enabled
            $response = stream_get_contents($stream);

            return $response;
        }

        /**
         * Do get request
         *
         * @param string $url           This is full, qualified, web service or web page URL, it must contain with
         *                              http:// or https://
         * @param string $function_name string, optional, default empty string - Remote functio name, no need for
         *                              access web pages
         * @param array  $ary_param     associative array - post values
         * @param bool   $auth_flag     It makes a request with authentication or not, if it chagne to true, next 2
         *                              params(username and pasword) should not be empty
         * @param string $username      username for authentication
         * @param string $password      password for authentication
         *
         * @return string
         */
        public static function do_get_request($url, $function_name = '', $ary_param = '', $auth_flag = false, $username = '', $password = '')
        {
            $auth_param = ""; // check authentication enable or not
            if ($auth_flag) {
                if ($username=="") {
                    return false;
                }
                if ($password=="") {
                    return false;
                }
                $auth_param = "Authorization: Basic ".base64_encode($username.':'.$password)."\r\n";
            }

            // construct web service URL
            $ws_req_url = $url.($function_name ? '/'.$function_name : '');

            // construct params array to query string format
            $query_param = is_array($ary_param) ? http_build_query($ary_param) : '';
//            $query_param = http_build_query($ary_param);

            $ws_req_url = $ws_req_url.'?'.$query_param;

            $params = array(
                'http' => array(
                    'ignore_errors' => true,
                    'method'        => 'GET',
                    'header'        => "Content-type: application/x-www-form-urlencoded\r\n".$auth_param,
                ),
            );

            $context  = stream_context_create($params);
            $stream   = fopen($ws_req_url, 'r', false, $context);
            $response = stream_get_contents($stream);

            return $response;
        }

        public static function unsign_string($str, $separator = '-', $keep_special_chars = false)
        {
            $str = str_replace(array("à", "á", "ạ", "ả", "ã", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ"), "a", $str);
            $str = str_replace(array("À", "Á", "Ạ", "Ả", "Ã", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ"), "A", $str);
            $str = str_replace(array("è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ"), "e", $str);
            $str = str_replace(array("È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ"), "E", $str);
            $str = str_replace("đ", "d", $str);
            $str = str_replace("Đ", "D", $str);
            $str = str_replace(array("ỳ", "ý", "ỵ", "ỷ", "ỹ", "ỹ"), "y", $str);
            $str = str_replace(array("Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ"), "Y", $str);
            $str = str_replace(array("ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ"), "u", $str);
            $str = str_replace(array("Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ"), "U", $str);
            $str = str_replace(array("ì", "í", "ị", "ỉ", "ĩ"), "i", $str);
            $str = str_replace(array("Ì", "Í", "Ị", "Ỉ", "Ĩ"), "I", $str);
            $str = str_replace(array("ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ"), "o", $str);
            $str = str_replace(array("Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ"), "O", $str);
            if ($keep_special_chars==false) {
                $str = str_replace(array('–', '…', '“', '”', "~", "!", "@", "#", "$", "%", "^", "&", "*", "/", "\\", "?", "<", ">", "'", "\"", ":", ";", "{", "}", "[", "]", "|", "(", ")", ",", ".", "`", "+", "=", "-"), $separator, $str);
                $str = preg_replace("/[^_A-Za-z0-9- ]/i", '', $str);
            }

            $str = str_replace(' ', $separator, $str);

            return trim(strtolower($str), "-");
        }

        /**
         * Google Recaptcha
         *
         * @return string
         */
        public static function googleVerify()
        {
            $recaptcha = Yii::app()->request->getParam('g-recaptcha-response', '');
            if (!empty($recaptcha)) {
                $google_url     = Yii::app()->params['reCapcha']['url'];
                $recaptcha_data = array(
                    'secret'   => Yii::app()->params['reCapcha']['secret_key'],
                    'remoteip' => $_SERVER['REMOTE_ADDR'],
                    'response' => $recaptcha,
                );
                $url            = $google_url.http_build_query($recaptcha_data);
                $res            = file_get_contents($url);
                $res_data       = json_decode($res, true);

                //reCaptcha success check
                return ($res_data['success']) ? 'ok' : '';
            } else {
                return '';
            }
        }

        /**
         * Generate random string|number
         *
         * @param int       $length    : $length = 0 is random length
         * @param bool|TRUE $is_number : whether is number or mix text.
         *                             -Number format : yyyymmddhhiissxxx
         */
        public static function genRandKey($is_number = true, $length = 15)
        {
            $randStr = '';
            if ($is_number) {
                $timeREQ = date('YmdHis', time());
                $endREQ  = rand(1000, 9999);
                $randStr = $timeREQ.$endREQ;
            } else {
//                $randStr = CApplication::getSecurityManager()->generateRandomString($length);
                $randStr = substr(md5(rand()), 0, $length);
            }

            return $randStr;
        }

        /**
         * Get substring between 2 string node
         *
         * @param $string
         * @param $start
         * @param $end
         *
         * @return bool|string
         */
        public static function get_string_between($string, $start, $end)
        {
            $string = " ".$string;
            $ini    = strpos($string, $start);
            if ($ini==0) {
                return false;
            }
            $ini += strlen($start);
            $len = strpos($string, $end, $ini) - $ini;

            return $start.substr($string, $ini, $len).$end;
        }


        /**
         * @param     $url
         * @param     $post_string
         * @param int $time_out
         * @param     $http_status
         *
         * @return mixed
         */
        function cUrlPost($url, $post_string, $time_out = 15, &$http_status)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
            curl_setopt($ch, CURLOPT_TIMEOUT, $time_out);
            $data        = curl_exec($ch);
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            return $data;
        }

        /**
         * Get Content from url (CURL)
         *
         * @param $url (api url)
         * @param $timeout
         * @param $http_code
         *
         * @return mixed (array|bool)
         */
        public static function cUrlGet($url, $timeout = 15, &$http_code)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $rs        = curl_exec($ch);
            curl_close($ch);

            return $rs;
        }

        public static function sendEmail($email_config=array(), $from, $to, $subject, $short_desc, $content = '',$views_layout_path='web.views.layouts')
        {
            $mail = new YiiMailer();
            $mail->setLayoutPath($views_layout_path);
            $mail->setData(array('message' => $content, 'name' => $from, 'description' => $short_desc));

            $mail->setFrom($email_config['email_username'], $from);
            $mail->setTo($to);
            $mail->setSubject($subject);
            $mail->setSmtp($email_config['email_host'], $email_config['email_port'], $email_config['email_type'], true, $email_config['email_username'], $email_config['email_password']);
            if ($mail->send()) {// echo 'Email was sent';
                return true;
            } else {
                return false;
            }
        }
    }

?>