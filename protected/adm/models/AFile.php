<?php
/**
 * User: NguyenPV
 * Date: 10/14/2019
 * Time: 10:07 AM
 */
class  AFile extends File{
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Tên file',
            'size' => 'Kích thước',
            'type' => 'Kiểu file',
            'path' => 'File( '.File::FILE_EXT.' )',
            'download_link' => 'Download Link',
            'created_time' => 'Ngày tạo',
            'note' => 'Ghi chú',
        );
    }
}