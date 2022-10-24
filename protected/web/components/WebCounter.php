<?php

    class WebCounter
    {
        public static function start()
        {

            $locktime       =  15;
            $initialvalue   =    1;
            $records        =    100000;

            $s_today        =    1;
            $s_yesterday    =    1;
            $s_all          =    1;
            $s_week         =    1;
            $s_month        =    1;

            $s_digit        =    1;
            $disp_type      =     'Mechanical';

            $widthtable     =    '60';
            $pretext        =     '';
            $posttext       =     '';
            $locktime       =    $locktime * 60;
            // Now we are checking if the ip was logged in the database. Depending of the value in minutes in the locktime variable.
            $day            =    date('d');
            $month          =    date('n');
            $year           =    date('Y');
            $daystart       =    mktime(0,0,0,$month,$day,$year);
            $monthstart     =  mktime(0,0,0,$month,1,$year);
            // weekstart
            $weekday        =    date('w');
            $weekday--;
            if ($weekday < 0)    $weekday = 7;
            $weekday        =    $weekday * 24*60*60;
            $weekstart      =    $daystart - $weekday;

            $yesterdaystart =    $daystart - (24*60*60);
            $now            =    time();
            $ip             =    $_SERVER['REMOTE_ADDR'];

            //$query          =    "SELECT MAX(id) AS total FROM counter";


            $query = Yii::app()->db->createCommand()
                ->select('MAX(id) AS total')
                ->from('tbl_counter u')
                ->queryRow();

            $tongtruycap   =    $query['total'];

            if ($tongtruycap !== NULL) {
                $tongtruycap += $initialvalue;
            } else {
                $tongtruycap = $initialvalue;
            }

            // Delete old records
            $temp = $tongtruycap - $records;

            if ($temp>0){
                TblCounter::model()->deleteAll('id<'.$temp);
            }


            $query = Yii::app()->db->createCommand()
                ->select('COUNT(*) AS visitip ')
                ->from('tbl_counter u')
                ->where("ip='$ip' AND (tm+'$locktime')>'$now'")
                ->queryRow();

            $items             =    $query['visitip'];
            if (empty($items))
            {
                $_new_counter = new TblCounter();
                $_new_counter->tm = $now;
                $_new_counter->ip = $ip;
                $_new_counter->save();
            }

            $n                 =     $tongtruycap;
            $div = 100000;
            while ($n > $div) {
                $div *= 10;
            }

            $query = Yii::app()->db->createCommand()
                ->select('COUNT(*) AS todayrecord ')
                ->from('tbl_counter u')
                ->where("tm>'$daystart'")
                ->queryRow();

            $homnay     =    $query['todayrecord'];

            $query = Yii::app()->db->createCommand()
                ->select('COUNT(*) AS yesterdayrec ')
                ->from('tbl_counter u')
                ->where("tm>'$yesterdaystart' and tm<'$daystart'")
                ->queryRow();

            $homqua     =    $query['yesterdayrec'];

            $query = Yii::app()->db->createCommand()
                ->select('COUNT(*) AS weekrec ')
                ->from('tbl_counter u')
                ->where("tm>='$weekstart'")
                ->queryRow();

            $trongtuan     =    $query['weekrec'];

            $query = Yii::app()->db->createCommand()
                ->select('COUNT(*) AS monthrec ')
                ->from('tbl_counter u')
                ->where("tm>='$monthstart'")
                ->queryRow();

            $trongthang     =    $query['monthrec'];
        }
    }