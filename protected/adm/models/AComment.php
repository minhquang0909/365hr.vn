<?php
class AComment extends Comment{
    public function attributeLabels()
    {
        return array(
            'id'       =>   'ID',
            'news_id' => 'Tin tức',
            'fullname' => 'Tên',
            'email' => 'Email',
            'comment_content' => 'Nội dung bình luận',
            'created_date' => 'Ngày tạo',
            'note' => 'Ghi chú',
            'status' => 'Trạng thái',
        );
    }
}