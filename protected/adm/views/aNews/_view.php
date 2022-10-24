<?php
    /* @var $this ANewsController */
    /* @var $data ANews */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
    <?php echo CHtml::encode($data->title); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('short_des')); ?>:</b>
    <?php echo CHtml::encode($data->short_des); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('full_des')); ?>:</b>
    <?php echo CHtml::encode($data->full_des); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('folder_path')); ?>:</b>
    <?php echo CHtml::encode($data->folder_path); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
    <?php echo CHtml::encode($data->created_date); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('updated_date')); ?>:</b>
    <?php echo CHtml::encode($data->updated_date); ?>
    <br/>

    <?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>