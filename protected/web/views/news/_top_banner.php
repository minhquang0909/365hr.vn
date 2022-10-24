<?php
if(Yii::app()->controller->id=='site' && Yii::app()->controller->action->id=='index'){?>
    <div class="gf-page-heading">
        <div class="container">
            <h3 class="page-title">
                <?=isset($title)?$title:""?>
            </h3>
        </div>
    </div>
<?php }
?>