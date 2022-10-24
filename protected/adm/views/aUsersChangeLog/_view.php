<?php
/* @var $this AUsersChangeLogController */
/* @var $data AUsersChangeLog */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_before')); ?>:</b>
	<?php echo CHtml::encode($data->data_before); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_after')); ?>:</b>
	<?php echo CHtml::encode($data->data_after); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_update')); ?>:</b>
	<?php echo CHtml::encode($data->last_update); ?>
	<br />


</div>