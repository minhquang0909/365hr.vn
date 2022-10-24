<div class="news_sidebar">
    <div class="space_20"></div>
    <div class="col-md-12 col-xs-12">
        <div class="font_17"><?= Yii::t('web/home', 'news') ?></div>
        <div class="line_2"></div>
    </div>
    <div class="space_20"></div>
    <div class="col-md-12 col-xs-12">
        <p>
        <?php
        if($tags){
            $i=1;
            foreach($tags as $tag){
                if($i%2==0){
                    $class = 'font_15';
                }else{
                    $class = 'font_22';
                }
                echo '<span class="'.$class.'">'.CHtml::encode($tag['name']).', </span>';
                $i++;
            }
        }?>
    </div>
    <div class="space_30"></div>
</div>