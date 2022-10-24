<h1>Đổi mật khẩu</h1>
<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'users-form',
        'enableAjaxValidation'=>false,
    )); ?>


    <?php echo $form->errorSummary($model); ?>

    <div style="float:left;">
        <div class="alert alert-warning">Mật khẩu phải lớn hơn 6 ký tự, bao gồm cả chữ cái, chữ số, chữ in HOA và ký tự đặc biệt!</div>
        <div class="row">
            <div class="checkbox">
                <label><input type="checkbox" class="btn-show-pass">Hiển thị mật khẩu?</label>
            </div>
            <div class="row">
                <label>Tên đăng nhập: <span class="required"> *</span></label>
                <?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>100,'disabled'=>'disabled','class'=>'form-control')); ?>
            </div>
        </div>
        <div class="row">
            <label>Mật khẩu mới<span class="required"> *</span></label>
            <input type="password" size="50" maxlength="50" autocomplete="off" name="password" class="show-pass form-control"/>
        </div>
        <div class="row">
            <label>Nhập lại mật khẩu mới<span class="required"> *</span></label>
            <input type="password" size="50"  autocomplete="off" maxlength="50" name="repeat_password" class="show-pass form-control"/>
        </div>
        <?php $this->widget('booster.widgets.TbButton',array('buttonType' => 'submit',
            'icon'       => 'ok white',
            'label'      => 'Cập nhật',
            'context' => 'primary'
        )); ?>
    </div>
    <div class="clear"></div>

    <?php $this->endWidget(); ?>
</div><!-- form -->

<script type="text/javascript">
    $(document).ready(function(){
        $('.btn-show-pass').click(function(){
            if ($(this).is(':checked')){
                $('.show-pass').attr('type','text');
            }else{
                $('.show-pass').attr('type','password');
            }
        });
    });
</script>