<?php
    return array(
        'hashkey'             => 'centech',
        'xml_folder'          => dirname(dirname(__FILE__)) . '/xml/',
        'image_ext'           => array('gif', 'jpg', 'jpeg', 'pjpeg', 'png'),
        'status'              => array(
            '1' => 'Kích hoạt',
            '0' => 'Tạm ngừng',
        ),
        'upload_dir_path'     => '../uploads/',
        'upload_product_dir'  => 'products/',
        'upload_gallery_dir'  => 'products/gallery/',
        'upload_product_gadget_dir'  => 'products/gadget/',
        'upload_page_dir'     => 'pages/',
        'upload_news_dir'     => 'news/thumbnails/',
        'upload_file_dir'     => 'files/',
        'news_categories_dir' => 'news/categories/',
        'upload_news_cate'    => 'news/categories/',
        'customers_dir'       => '../uploads/customers/',
        'document_type'       => array(
            'pdf'  => 'pdf',
            'doc'  => 'doc',
            'docx' => 'docx',
            'ppt'  => 'ppt',
            'pptx' => 'pptx',
            'pot'  => 'pot',
            'potx' => 'potx',
        ),
        'ftp_upload_config'   => array(
            'base_folder' => 'uploads',
            'base_url'    => 'http://128.199.154.84/uploads/',
        ),
        'display_position'    => array('main_right_sidebar' => 'Cột phải trang chủ'),
        //google_recaptcha
        'google_recaptcha'  =>  array(
            'site_key'  =>  '6LfIOr0UAAAAAPAXgxnbQ7pt0UMpB7lmsocs6CbW',
            'secret_key'  =>  '6LfIOr0UAAAAADwiDKJ1mhUDFAfFPWMltQ4utXNh',
            'version'     =>    '2'
        ),
    );
?>