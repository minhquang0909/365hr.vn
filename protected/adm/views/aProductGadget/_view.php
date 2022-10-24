<?php
    /* @var $this AProductGadgetController */
    /* @var $data AProductGadget */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
    <?php echo CHtml::encode($data->name); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('parent_id')); ?>:</b>
    <?php echo CHtml::encode($data->parent_id); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('folder_path')); ?>:</b>
    <?php echo CHtml::encode($data->folder_path); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('top')); ?>:</b>
    <?php echo CHtml::encode($data->top); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('sort_order')); ?>:</b>
    <?php echo CHtml::encode($data->sort_order); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
    <?php echo CHtml::encode($data->created_date); ?>
    <br/>

    <?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_date')); ?>:</b>
	<?php echo CHtml::encode($data->updated_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slug')); ?>:</b>
	<?php echo CHtml::encode($data->slug); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>