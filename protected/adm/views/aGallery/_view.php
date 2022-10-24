<?php
/* @var $this AGalleryController */
/* @var $data AGallery */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('file_name')); ?>:</b>
	<?php echo CHtml::encode($data->file_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('file_ext')); ?>:</b>
	<?php echo CHtml::encode($data->file_ext); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('folder_path')); ?>:</b>
	<?php echo CHtml::encode($data->folder_path); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('target_link')); ?>:</b>
	<?php echo CHtml::encode($data->target_link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('album_id')); ?>:</b>
	<?php echo CHtml::encode($data->album_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent_id')); ?>:</b>
	<?php echo CHtml::encode($data->parent_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_time')); ?>:</b>
	<?php echo CHtml::encode($data->created_time); ?>
	<br />

	*/ ?>

</div>