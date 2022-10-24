<div class="view">

    <!--
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('/bsystemuser/view', 'id' => $data->id)); ?>
	<br />
-->

    <b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
    <?php echo CHtml::encode($data->username); ?>
    <br/>

    <!--
<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />
-->

    <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
    <?php //echo CHtml::encode($data->status);
        //echo Lookup::item("UserStatus",$data->status);
    ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
    <?php echo CHtml::encode($data->created_date); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('lastest_login')); ?>:</b>
    <?php echo CHtml::encode($data->lastest_login); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('ip')); ?>:</b>
    <?php echo CHtml::encode($data->ip); ?>
    <br/>
    a
    <?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('group_id')); ?>:</b>
	<?php echo CHtml::encode($data->group_id); ?>
	<br />

	*/
    ?>

</div>