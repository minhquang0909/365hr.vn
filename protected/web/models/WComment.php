<?php
class WComment extends Comment{
    public static function getList($news_id=0, $skip, $limit){
        $where = " `status` = '".(int)Comment::STATUS_ACTIVE."' ";
        if($news_id > 0){
            $where.= " AND `news_id` = '".(int)$news_id."' ";
        }
        $conn = Yii::app()->db;
        $sql_total = " SELECT COUNT(*) AS 'total' FROM {{comment}} WHERE ".$where." ";
        $sql = " SELECT * FROM {{comment}} WHERE ".$where."  LIMIT ".(int)$skip.", ".(int)$limit." ";
        $command_total = $conn->createCommand($sql_total);
        $total = $command_total->queryRow();
        $total = isset($total['total'])?$total['total']:0;
        if($total > 0) {
            $command = $conn->createCommand($sql);
            $rs = $command->queryAll();
            return array(
                'total' =>  $total,
                'list_comment'  =>  $rs
        );
        }else{
            return array(
                'total' =>  0,
                'list_comment'  =>  array()
            );
        }
    }
}