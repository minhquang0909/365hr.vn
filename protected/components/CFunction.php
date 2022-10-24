<?php

    class CFunction
    {
        public static function generateFileNameByDate()
        {
            $today = date("U") + (7 * 3600); //GMT+7
            return date("Ymd");
        }

        public static function encrypt($value, $hashKey)
        {
            return md5($hashKey.$value);
        }


        public static function GUID()
        {
            return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
        }

        public static function getRandIdCat($cat_id)
        {
            $numberId = Yii::app()->params->number_catid;
            $countstr = strlen($cat_id);
            $add      = $numberId - $countstr;
            $i        = 1;
            for ($i = 1; $i <= $add; $i++) {
                $cat_id = '0'.$cat_id;
            }

            return $cat_id;
        }


        public static function makePhoneNumberStandard($phonenumber)
        {
            $newnumber = $phonenumber;
            if ($phonenumber!='') {
                if (substr($phonenumber, 0, 1)=='0') {
                    $newnumber = substr($phonenumber, 1, strlen($phonenumber));
                } else if (substr($phonenumber, 0, 2)=='84') {
                    $newnumber = substr($phonenumber, 2, strlen($phonenumber));
                }
                $newnumber = "84".$newnumber;
            }

            return $newnumber;
        }


        public static function random_generator($digits)
        {
            srand((double)microtime() * 10000000);
            $input = array(
                'a',
                'b',
                'c',
                'd',
                'e',
                'f',
                'g',
                'h',
                'i',
                'j',
                'k',
                'l',
                'm',
                'n',
                'o',
                'p',
                'q',
                'r',
                's',
                't',
                'u',
                'v',
                'w',
                'x',
                'y',
                'z',
            );
            $temp  = "";
            for ($i = 1; $i < $digits + 1; $i++) {
                if (rand(1, 2)==1) {
                    $rand_index = array_rand($input);
                    $temp .= $input[$rand_index];
                } else {
                    $temp .= rand(0, 9);
                }

            }

            return $temp;
        }

        public static function sendMail($email, $subject, $message)
        {
            $adminEmail = Yii::app()->params['adminEmail'];
            $headers    = "MIME-Version: 1.0\r\nFrom: $adminEmail\r\nReply-To: $adminEmail\r\nContent-Type: text/html; charset=utf-8";
            $message    = wordwrap($message, 70);
            $message    = str_replace("\n.", "\n..", $message);

            return mail($email, '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $headers);
        }

        public static function highlight_keywords($text, $keyword)
        {
            $color     = Yii::app()->params->color;
            $tag_start = "<span style='background-color:".$color."'>";
            $tag_end   = "</span>";
            if ($text!='' && $keyword!='') {
                $original = $text;
                $text     = CFunction::vn_str_filter(strtolower($text));
                $tagLen   = (strlen($tag_start) + strlen($tag_end));
                $keyword  = CFunction::vn_str_filter(strtolower($keyword));
                $current  = $offset = $delta = 0;
                $len      = mb_strlen($keyword, "utf-8");
                $total    = mb_strlen($text, "utf-8");
                while ((false!==($pos = strpos($text, $keyword, $offset)))) {
                    $original = mb_substr($original, 0, ($pos + $delta), "utf-8").$tag_start.mb_substr($original, ($pos + $delta), $len, "utf-8").$tag_end.mb_substr($original, ($pos + $delta + $len), $total, "utf-8");
                    $delta += $tagLen;
                    $offset = $pos + 1;

                }

                return $original;
            } else {
                return $text;
            }

        }

        public static function vn_str_filter($str)
        {
            $unicode = array(
                'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
                'd' => 'đ',
                'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
                'i' => 'í|ì|ỉ|ĩ|ị',
                'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
                'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
                'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
                'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
                'D' => 'Đ',
                'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
                'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
                'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
                'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
                'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            );

            foreach ($unicode as $nonUnicode => $uni) {
                $str = preg_replace("/($uni)/i", $nonUnicode, $str);
            }

            return $str;
        }


        public static function output_file($file, $name, $mime_type = '')
        {
            if (!is_readable($file)) {
                die('File not found or inaccessible!');
            }
            $size             = filesize($file);
            $name             = rawurlencode($name);
            $known_mime_types = array(
                "application/rar",
                "application/x-rar-compressed",
                "application/arj",
                "application/excel",
                "application/gnutar",
                "application/octet-stream",
                "application/pdf",
                "application/powerpoint",
                "application/postscript",
                "application/plain",
                "application/rtf",
                "application/vocaltec-media-file",
                "application/wordperfect",
                "application/x-zip",
                "application/x-bzip",
                "application/x-bzip2",
                "application/x-compressed",
                "application/x-excel",
                "application/x-gzip",
                "application/x-latex",
                "application/x-midi",
                "application/x-msexcel",
                "application/x-rtf",
                "application/x-sit",
                "application/x-stuffit",
                "application/x-shockwave-flash",
                "application/x-troff-msvideo",
                "application/x-zip-compressed",
                "application/xml",
                "application/zip",
                "application/msword",
                "application/mspowerpoint",
                "application/vnd.ms-excel",
                "application/vnd.ms-powerpoint",
                "application/vnd.ms-word",
                "application/vnd.ms-word.document.macroEnabled.12",
                "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                "application/vnd.ms-word.template.macroEnabled.12",
                "application/vnd.openxmlformats-officedocument.wordprocessingml.template",
                "application/vnd.ms-powerpoint.template.macroEnabled.12",
                "application/vnd.openxmlformats-officedocument.presentationml.template",
                "application/vnd.ms-powerpoint.addin.macroEnabled.12",
                "application/vnd.ms-powerpoint.slideshow.macroEnabled.12",
                "application/vnd.openxmlformats-officedocument.presentationml.slideshow",
                "application/vnd.ms-powerpoint.presentation.macroEnabled.12",
                "application/vnd.openxmlformats-officedocument.presentationml.presentation",
                "application/vnd.ms-excel.addin.macroEnabled.12",
                "application/vnd.ms-excel.sheet.binary.macroEnabled.12",
                "application/vnd.ms-excel.sheet.macroEnabled.12",
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                "application/vnd.ms-excel.template.macroEnabled.12",
                "application/vnd.openxmlformats-officedocument.spreadsheetml.template",
                "text/vnd.sun.j2me.app-descriptor",
                "application/java-archive",
                "audio/*",
                "image/*",
                "video/*",
                "multipart/x-zip",
                "multipart/x-gzip",
                "text/richtext",
                "text/plain",
                "text/xml",
            );
            if (!in_array($mime_type, $known_mime_types)) {
                $mime_type = 'application/force-download';
            }
            @ob_end_clean();
            if (ini_get('zlib.output_compression')) {
                ini_set('zlib.output_compression', 'Off');
            }
            header('Content-Type: '.$mime_type);
            header('Content-Disposition: attachment; filename="'.$name.'"');
            header("Content-Transfer-Encoding: binary");
            header('Accept-Ranges: bytes');
            /* The three lines below basically make the
            download non-cacheable */
            header("Cache-control: private");
            header('Pragma: private');
            header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            // multipart-download and download resuming support
            if (isset($_SERVER['HTTP_RANGE'])) {
                list($a, $range) = explode("=", $_SERVER['HTTP_RANGE'], 2);
                list($range) = explode(",", $range, 2);
                list($range, $range_end) = explode("-", $range);
                $range = intval($range);
                if (!$range_end) {
                    $range_end = $size - 1;
                } else {
                    $range_end = intval($range_end);
                }

                $new_length = $range_end - $range + 1;
                header("HTTP/1.1 206 Partial Content");
                header("Content-Length: $new_length");
                header("Content-Range: bytes $range-$range_end/$size");
            } else {
                $new_length = $size;
                header("Content-Length: ".$size);
            }
            /* output the file itself */
            $chunksize  = 1 * (1024 * 1024); //you may want to change this
            $bytes_send = 0;
            if ($file = fopen($file, 'r')) {
                if (isset($_SERVER['HTTP_RANGE'])) {
                    fseek($file, $range);
                }

                while (!feof($file) && (!connection_aborted()) && ($bytes_send < $new_length)) {
                    $buffer = fread($file, $chunksize);
                    print ($buffer); //echo($buffer); // is also possible
                    flush();
                    if (connection_status()!=0) {
                    } else {
                        $statusDownloadFile = '1';
                        //$this->updateDownloadFileStatus2DB($statusDownloadFile);
                    }
                    $bytes_send += strlen($buffer);
                }
                fclose($file);
            } else {
                die('Error - can not open file.');
            }
        }

        public static function games_lead_zero($s, $maxlength)
        {

            if (strlen($s) >= $maxlength) {
                return $s;
            } else {
                return self::games_lead_zero("0".$s, $maxlength);
            }
        }

        public static function number_format($string, $decimals = "", $dec_sep = ",", $thous_sep = ".")
        {
            $ret = '0';
            if ($string!='') {
                $ret = number_format($string, $decimals, $dec_sep, $thous_sep);
            }

            return $ret;
        }

        public static function aes_encrypt($key, $str)
        {
            $aes = new AES($key);

            return $aes->encrypt($str);
        }

        public static function aes_encrypt_2_base64($key, $str)
        {
            $aes = new AES($key);

            return base64_encode($aes->encrypt($str));
        }

        public static function tripleDesEncrypt($key, $value)
        {
            $key   = base64_decode($key);
            $iv    = substr($key, -8);
            $key   = substr($key, 0, 24);
            $value = mcrypt_encrypt(MCRYPT_3DES, $key, $value, MCRYPT_MODE_CBC, $iv);

            return bin2hex($value);
        }

        public static function tripleDesDecrypt($key, $value)
        {
            $key   = base64_decode($key);
            $iv    = substr($key, -8);
            $key   = substr($key, 0, 24);
            $value = pack("H*", $value);
            $value = mcrypt_decrypt(MCRYPT_3DES, $key, ($value), MCRYPT_MODE_CBC, $iv);

            return trim($value);
        }

        public static function getSignature($value, $pri_key_cp)
        {
            $signature = '';
            openssl_sign($value, $signature, $pri_key_cp, OPENSSL_ALGO_SHA1);
            // Base64 Encode
            $signature = base64_encode($signature);
            // URL Encode
            $signature = urlencode($signature);

            return $signature;
        }

        public static function verifySignature($value, $signature, $public_key)
        {
            //$signature = urldecode($signature);
            $signature = base64_decode($signature);
            $res       = openssl_verify($value, $signature, $public_key, OPENSSL_ALGO_SHA1);
            if ($res==1) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * @param $password
         * @param $min
         *
         * @return bool
         */
        public static function checkPasswordStrength($password, $min)
        {
            if (preg_match("/^.*(?=.{".$min.",})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).*$/", $password)) {
                return true;
            } else {
                return false;
            }
        }

        public static function getWeekOfRangeday($day)
        {
            $start_week = strtotime("last monday midnight", strtotime($day));
            $end_week   = strtotime("+1 week", $start_week);

            $start_week = date("Y-m-d", $start_week);
            $end_week   = date("Y-m-d", $end_week);

            return array(
                'start_week' => $start_week,
                'end_week'   => $end_week,
            );
        }

        public static function getURLContent($url, $time_out = 10)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_AUTOREFERER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, $time_out);
            $data   = curl_exec($ch);
            //$header = curl_getinfo($ch, CURLINFO_HTTP_CODE);;
            curl_close($ch);

            return  $data;
        }

        public static function callCURL($url, $time_out = 10)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_AUTOREFERER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, $time_out);
            $data   = curl_exec($ch);
            $header = curl_getinfo($ch, CURLINFO_HTTP_CODE);;
            curl_close($ch);

            return array(
                'header' => $header,
                'data'   => $data,
            );
        }


        public static function convertSpace($string)
        {

            $a      = array('Ấ', "ễ", "Á", "À", "Ả", "Ã", "Ạ", "Ó", "Ò", "Ỏ", "Õ", "Ọ", "Ă", "Ắ", "Ằ", "Ẳ", "Ẵ", "Ặ", "Ô", "Ố", "Ồ", "Ổ", "Ỗ", "Ộ", "Â", "Ã", "Á", "À", "Ả", "Ẫ", "Ậ", "Ơ", "Ớ", "Ờ", "Ở", "Ỡ", "Ợ", "É", "È", "Ẻ", "Ẽ", "Ẹ", "Ú", "Ù", "Ủ", "Ũ", "Ụ", "Ê", "Ễ", "Ề", "Ể", "Ệ", "Ư", "Ứ", "Ừ", "Ử", "Ữ", "Ự", "Í", "Ì", "Ỉ", "Ĩ", "Ị", "Ý", "Ỳ", "Ỷ", "Ỹ", "Ỵ", "Đ", "á", "à", "ả", "ã", "ạ", "ó", "ò", "ỏ", "õ", "ọ", "ă", "ắ", "ằ", "ẳ", "ẵ", "ặ", "ô", "ố", "ồ", "ổ", "ỗ", "ộ", "â", "ã", "ấ", "ầ", "ẩ", "ẫ", "ậ", "ơ", "ớ", "ờ", "ở", "ỡ", "ợ", "é", "è", "ẻ", "ê", "ế", "ề", "ệ", "ẽ", "ẹ", "ú", "ù", "ủ", "ũ", "ụ", "ê", "ẽ", "ề", "ể", "ệ", "ư", "ứ", "ừ", "ử", "ữ", "ự", "í", "ì", "ỉ", "ĩ", "ị", "ý", "ỳ", "ỷ", "ỹ", "ỵ", "đ", "!", "@", "?", ":", "à");
            $b      = array('ấ', "e", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "a", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "o", "a", "a", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "o", "e", "e", "e", "e", "e", "u", "u", "u", "u", "u", "e", "e", "e", "e", "e", "u", "u", "u", "u", "u", "u", "i", "i", "i", "i", "i", "y", "y", "y", "y", "y", "d", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "a", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "o", "a", "a", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "o", "e", "e", "e", "e", "e", "e", "e", "e", "e", "u", "u", "u", "u", "u", "e", "e", "e", "e", "e", "u", "u", "u", "u", "u", "u", "i", "i", "i", "i", "i", "y", "y", "y", "y", "y", "d", "", "", "", "", "", "a");
            $string = strtolower(str_replace($a, $b, $string));
            $string = str_replace(" ", "-", $string);
            $string = str_replace("--", "", $string);


            return $string;
        }

        public static function unsign_string($string, $separator = '-')
        {
            $a      = array('+', 'ö', 'þ', 'ð', '̃', '́', '̣', '̀', '̉', '%', ' - ', '’', '\"', '#', '…', 'Ấ', "'", '"', ")", "(", "ễ", ";", ",", "&", "&quot;", "“", "”", "/", "Á", "À", "Ả", "Ã", "Ạ", "Ó", "Ò", "Ỏ", "Õ", "Ọ", "Ă", "Ắ", "Ằ", "Ẳ", "Ẵ", "Ặ", "Ô", "Ố", "Ồ", "Ổ", "Ỗ", "Ộ", "Â", "Ã", "Á", "À", "Ả", "Ẫ", "Ậ", "Ơ", "Ớ", "Ờ", "Ở", "Ỡ", "Ợ", "É", "È", "Ẻ", "Ẽ", "Ẹ", "Ú", "Ù", "Ủ", "Ũ", "Ụ", "Ê", "Ễ", "Ề", "Ể", "Ệ", "Ư", "Ứ", "Ừ", "Ử", "Ữ", "Ự", "Í", "Ì", "Ỉ", "Ĩ", "Ị", "Ý", "Ỳ", "Ỷ", "Ỹ", "Ỵ", "Đ", "á", "à", "ả", "ã", "ạ", "ó", "ò", "ỏ", "õ", "ọ", "ă", "ắ", "ằ", "ẳ", "ẵ", "ặ", "ô", "ố", "ồ", "ổ", "ỗ", "ộ", "â", "ã", "ấ", "ầ", "ẩ", "ẫ", "ậ", "ơ", "ớ", "ờ", "ở", "ỡ", "ợ", "é", "è", "ẻ", "ê", "ế", "ề", "ệ", "ẽ", "ẹ", "ú", "ù", "ủ", "ũ", "ụ", "ê", "ẽ", "ề", "ể", "ệ", "ư", "ứ", "ừ", "ử", "ữ", "ự", "í", "ì", "ỉ", "ĩ", "ị", "ý", "ỳ", "ỷ", "ỹ", "ỵ", "đ", "!", "@", "?", ".", ":", "à");
            $b      = array('-', 'o', 'b', 'o', '', '', '', '', '', '', '', '', '', '', '', 'ấ', '', '', "", "", "e", "", "", "", "", "", "", "-", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "a", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "o", "a", "a", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "o", "e", "e", "e", "e", "e", "u", "u", "u", "u", "u", "e", "e", "e", "e", "e", "u", "u", "u", "u", "u", "u", "i", "i", "i", "i", "i", "y", "y", "y", "y", "y", "d", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "a", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "o", "a", "a", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "o", "e", "e", "e", "e", "e", "e", "e", "e", "e", "u", "u", "u", "u", "u", "e", "e", "e", "e", "e", "u", "u", "u", "u", "u", "u", "i", "i", "i", "i", "i", "y", "y", "y", "y", "y", "d", "", "", "", "", "", "", "a");
            $string = strtolower(str_replace($a, $b, str_replace(" ", $separator, $string)));
            $string = str_replace("--", "", $string);

            return trim(strtolower($string));
        }


        public static function setglobal($key, $value, $group = null)
        {
            global $_G;
            $k = explode('/', $group===null ? $key : $group.'/'.$key);
            switch (count($k)) {
                case 1:
                    $_G[$k[0]] = $value;
                    break;
                case 2:
                    $_G[$k[0]][$k[1]] = $value;
                    break;
                case 3:
                    $_G[$k[0]][$k[1]][$k[2]] = $value;
                    break;
                case 4:
                    $_G[$k[0]][$k[1]][$k[2]][$k[3]] = $value;
                    break;
                case 5:
                    $_G[$k[0]][$k[1]][$k[2]][$k[3]][$k[4]] = $value;
                    break;
            }

            return true;
        }

        public static function getglobal($key, $group = null)
        {
            global $_G;
            $k = explode('/', $group===null ? $key : $group.'/'.$key);
            switch (count($k)) {
                case 1:
                    return isset($_G[$k[0]]) ? $_G[$k[0]] : null;
                    break;
                case 2:
                    return isset($_G[$k[0]][$k[1]]) ? $_G[$k[0]][$k[1]] : null;
                    break;
                case 3:
                    return isset($_G[$k[0]][$k[1]][$k[2]]) ? $_G[$k[0]][$k[1]][$k[2]] : null;
                    break;
                case 4:
                    return isset($_G[$k[0]][$k[1]][$k[2]][$k[3]]) ? $_G[$k[0]][$k[1]][$k[2]][$k[3]] : null;
                    break;
                case 5:
                    return isset($_G[$k[0]][$k[1]][$k[2]][$k[3]][$k[4]]) ? $_G[$k[0]][$k[1]][$k[2]][$k[3]][$k[4]] : null;
                    break;
            }

            return null;
        }


        public static function valid_phone($input)
        {
            if (preg_match("/0[0-9]{9,10}$/i", $input)==true || preg_match("/84[0-9]{9,10}$/i", $input)==true) {
                return true;
            } else {
                return false;
            }
        }


        public static function validateDate($date, $format = 'YmdHis')
        {
            $d = DateTime::createFromFormat($format, $date);

            return $d && $d->format($format)==$date;
        }


        public static function redirect($url, $js = false)
        {
            @header('Location: '.$url);
            if ($js==true) {
                echo '<script type="text/javascript">window.document.location.href="'.$url.'";</script>';
            }
        }

        public static function decryptData($value, $public_key)
        { //decrypt data from upro.vn
            $value = base64_decode($value);
            openssl_public_decrypt($value, $newsource, $public_key);

            return trim($newsource);
        }

        public static function privateKeyDecrypt($value, $private_key)
        {
            $data_encrypt = base64_decode($value);
            openssl_private_decrypt($data_encrypt, $newsource, $private_key);

            return trim($newsource);
        }

        public static function  getCurrentUrl()
        {
            $pageURL = (@$_SERVER["HTTPS"]=="on") ? "https://" : "http://";
            if ($_SERVER["SERVER_PORT"]!="80") {
                $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
            } else {
                $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
            }

            return $pageURL;
        }


        public static function createRandomString($lengthChars = 32)
        {
            if ($lengthChars <= 0) {
                return false;
            } else {
                $alphaString  = 'abcdefghijklmnopqrstuvwxyz';
                $numberString = '1234567890';

                $shuffleString = $alphaString.$numberString;
                $randomString  = substr(str_shuffle($shuffleString), 0, $lengthChars);

                return $randomString;
            }
        }

        public static function createRandomNumber($length = 4)
        {
            if ($length <= 0) {
                return false;
            } else {
                $alphaString  = '';
                $numberString = '1234567890';

                $shuffleString = $alphaString.$numberString;
                $randomString  = substr(str_shuffle($shuffleString), 0, $length);

                return $randomString;
            }
        }


        public static function safe_b64encode($string)
        {
            $data = base64_encode($string);
            $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);

            return $data;
        }

        public static function safe_b64decode($string)
        {
            $data = str_replace(array('-', '_'), array('+', '/'), $string);
            $mod4 = strlen($data) % 4;
            if ($mod4) {
                $data .= substr('====', $mod4);
            }

            return base64_decode($data);
        }

        public static function getDownloadLink()
        {
            if (Yii::app()->session['msisdn']!='') {
                $week_url  = Yii::app()->createUrl('package/'.WCustomers::WEEK_PACKGAGE);
                $month_url = Yii::app()->createUrl('package/'.WCustomers::MONTH_PACKGAGE);
            } else {
                $week_url  = Yii::app()->createUrl('verifyuser/'.strtolower(WCustomers::WEEK_PACKGAGE));
                $month_url = Yii::app()->createUrl('verifyuser/'.strtolower(WCustomers::MONTH_PACKGAGE));
            }

            return array('week_url' => $week_url, 'month_url' => $month_url);
        }


        public static function cutText($string, $setlength)
        {

            $length = $setlength;
            if ($length < strlen($string)) {
                while (($string{$length}!=" ") AND ($length > 0)) {
                    $length--;
                }
                if ($length==0) {
                    return substr($string, 0, $setlength);
                } else {
                    return substr($string, 0, $length);
                }
            } else {
                return $string;
            }
        }

        /*hunghn 2015-09-04*/
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


        /*hunghn 2015-09-22 url login fb */
        public static function urlLoginFB()
        {

            require Yii::app()->params->facebook_sdk_path;
            $fb = new Facebook\Facebook(Yii::app()->params['facebook']);

            $helper           = $fb->getRedirectLoginHelper();
            $facebookLoginUrl = $helper->getLoginUrl(Yii::app()->params->facebook['url_callback'], Yii::app()->params['facebookPermissions']);

            return $facebookLoginUrl;
        }

        /*Function clean url*/
        public static function clean_url($string)
        {

            $string = self::unsign_string(strtolower($string));
            $string = str_replace(' ', '-', $string);
            $string = self::cutText($string, 45);

            return preg_replace('/-+/', '-', $string);
        }

        public static function getAsciiTitle($string)
        {

            $string = self::unsign_string(strtolower($string));
            $string = str_replace(' ', '-', $string);
            $string = str_replace('+', '-', $string);

            return $string;
        }

        public static function getFileTile($file_name)
        {
            $file_name = str_replace('-', ' ', $file_name);
            $file_name = str_replace('_', ' ', $file_name);
            $file_name = str_replace('.', ' ', $file_name);

            return $file_name;
        }

        public static function get_file_ext($file)
        {
            return strtolower(str_replace(".", "", substr($file, strrpos($file, '.'))));
        }

        public static function get_string_between($string, $start, $end){
            $string = " ".$string;
            $ini = strpos($string,$start);
            if ($ini == 0) return "";
            $ini += strlen($start);
            $len = strpos($string,$end,$ini) - $ini;
            return substr($string,$ini,$len);
        }
        /**
         * Google Recaptcha
         * @return string
         */
        public static function googleVerify()
        {
            $recaptcha         = Yii::app()->request->getParam('g-recaptcha-response', '');
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
        public static function getErrorText($errors){
            $string = "";
            if($errors){
                foreach($errors as $error) {
                    $string = $error[0];
                    return $string;
                }
            }
            return $string;
        }

        public static function require_auth() {
            $AUTH_USER = 'admin';
            $AUTH_PASS = 'admin';
            header('Cache-Control: no-cache, must-revalidate, max-age=0');
            $has_supplied_credentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));
            $is_not_authenticated = (
                !$has_supplied_credentials ||
                $_SERVER['PHP_AUTH_USER'] != $AUTH_USER ||
                $_SERVER['PHP_AUTH_PW']   != $AUTH_PASS
            );
            if ($is_not_authenticated) {
                header('HTTP/1.1 401 Authorization Required');
                header('WWW-Authenticate: Basic realm="Access denied"');
                exit;
            }
        }
        /**
         * @param int $number
         * @return string
         */
        public  static function numberToRomanRepresentation($number) {
            $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
            $returnValue = '';
            while ($number > 0) {
                foreach ($map as $roman => $int) {
                    if($number >= $int) {
                        $number -= $int;
                        $returnValue .= $roman;
                        break;
                    }
                }
            }
            return $returnValue;
        }

        public static function convertDateTimeToTimestamp($date){
            $timestamp = strtotime($date);
            return $timestamp;
        }

        public static function buildPagination($baseUrl, $totalPage, $currentPage, $offsetPage = 3, $addClass = ''){
            if(strpos($baseUrl,'?') > 1){
                $indicate = '&';
            }else{
                $indicate = '?';
            }
            if($totalPage > 1){
                $output = "<div class='mava_pagination'><div class='mava_pagination_inner ". $addClass ."'>";
                $page = max($currentPage,1);
                $start = $page - $offsetPage;
                if($start < 1){
                    $start = 1;
                }

                $end = $page + $offsetPage;
                if($end > $totalPage){
                    $end = $totalPage;
                }

                if($page > 1){
                    $output .= "<a href='". $baseUrl . $indicate .'page='. ($page-1) ."' class='prev' title='". Yii::t('web/app','prev_page') ."'><span class='prev_page_icon'></span>". Yii::t('web/app','prev_page') ."</a> ";
                }else{
                    $output .= "<a class='prev disabled'><span class='prev_page_icon'></span>".Yii::t('web/app','prev_page') ."</a> ";
                }


                if($page-$offsetPage > 1){
                    $output .= " <a href='". $baseUrl ."'>1</a> ";
                }

                if($page > ($offsetPage+2)){
                    $output .= "<a href='javascript:void(0);' class='disabled' style='border: 0;background: none;'>...</a>";
                }

                for($i=$start;$i<= $end; $i++){
                    if($i == $page){
                        $output .= " <a href='javascript:void(0);' class='selected'>". $i ."</a> ";
                    }else{
                        $output .= " <a href='". $baseUrl . $indicate .'page='. $i ."'>". $i ."</a> ";
                    }

                }

                if($page < ($totalPage-$offsetPage-1)){
                    $output .= "<a href='javascript:void(0);' class='disabled' style='border: 0;background: none;'>...</a>";
                }


                if($page+$offsetPage < $totalPage){
                    $output .= " <a href='". $baseUrl . $indicate .'page='. $totalPage ."'>". $totalPage ."</a> ";
                }

                if($page < $totalPage){
                    $output .= "<a href='". $baseUrl . $indicate .'page='. ($page+1) ."' class='next' title='". Yii::t('web/app','next_page') ."'>". Yii::t('web/app','next_page') ."<span class='next_page_icon'></span></a> ";
                }else{
                    $output .= "<a class='next disabled'>". Yii::t('web/app','next_page') ."<span class='next_page_icon'></span></a> ";
                }

                $output .= '</div></div>';
                return $output;
            }else{
                return '';
            }
        }

        public static function getCurrentAddress(){
            $address = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
            $address .= isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : getenv('HTTP_HOST');
            $address .= isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : getenv('REQUEST_URI');
            return $address;
        }
        public static function getCurrentDomain(){
            $address = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
            $address .= isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : getenv('HTTP_HOST');
            return $address;
        }

        public static function removeParam($url, $params){
            if($url == ''){
                $url = self::getCurrentAddress();
            }
            $segments = explode('?', $url);
            $query = array();
            if(count($segments) > 1){
                parse_str($segments[1], $current_params);
                foreach($params as $k){
                    if(isset($current_params[$k])){
                        unset($current_params[$k]);
                    }
                }
                $query = $current_params;
            }

            $final_params = array();
            if(count($query) > 0){
                foreach($query as $k => $v){
                    if(is_array($v)){
                        foreach($v as $i){
                            $final_params[] = $k ."[]=". $i;
                        }
                    }else{
                        $final_params[] = $k ."=". $v;
                    }
                }
            }

            return $segments[0] . (count($final_params) > 0?"?". implode('&', $final_params):"");
        }

        public static function isEmail($email){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                return true;
            }else{
                return false;
            }
        }

        public static function responseGifNull(){
            header('Content-Type: image/gif');
            die(base64_decode('R0lGODlhAQABAJAAAP8AAAAAACH5BAUQAAAALAAAAAABAAEAAAICBAEAOw=='));
        }


        public static function encrypt_string($string,$key='nguyenpv'){
            $encrypt_method = "AES-256-CBC";
            $secret_key = 'nguyenpv';
            $secret_iv = 'NguyenPV';
            // hash
            $key = hash('sha256', $secret_key);

            // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
            $iv = substr(hash('sha256', $secret_iv), 0, 16);
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
            return $output;
        }
        public static function decrypt_string($string,$key='nguyenpv'){
            $encrypt_method = "AES-256-CBC";
            $secret_key = 'nguyenpv';
            $secret_iv = 'NguyenPV';
            // hash
            $key = hash('sha256', $secret_key);

            // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
            $iv = substr(hash('sha256', $secret_iv), 0, 16);
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
            return $output;
        }

        public static function isIE(){
            $ua = htmlentities($_SERVER['HTTP_USER_AGENT'], ENT_QUOTES, 'UTF-8');
            if (preg_match('~MSIE|Internet Explorer~i', $ua) || (strpos($ua, 'Trident/7.0; rv:11.0') !== false)){
                return true;
            }else{
                return false;
            }
        }

        /**
         * @param $youtube_id
         * @param string $type: default, hqdefault, mqdefault, sddefault, maxresdefault
         * @return string
         */
        public static function get_youtube_thumbnail($youtube_id, $type = "hqdefault.jpg")
        {
            return 'https://img.youtube.com/vi/' . $youtube_id . '/' . $type . '';
        }

        public static function getYoutubeId($url){
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
            return $match[1];
        }

        public static function checkGoogleCaptcha($captcha){
            $google_recaptcha = Yii::app()->params['google_recaptcha'];
            $ip = isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:'';
            $secretkey = $google_recaptcha['secret_key'];
            $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretkey."&response=".$captcha."&remoteip=".$ip);
            $responseKeys = json_decode($response,true);
            if(intval($responseKeys["success"])== 1){
                return true;
            }else{
                return false;
            }
        }

    }

?>