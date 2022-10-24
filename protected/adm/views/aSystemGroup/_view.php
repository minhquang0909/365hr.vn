<div class="view">

    <!--<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />-->

    <b><?php echo CHtml::encode($data->getAttributeLabel('group_title')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->group_title), array('view', 'id' => $data->id)) . ' (' . $data->totalUserInGroup() . ' ' . Yii::t('group', 'lbl_user') . ')'; ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('group_desc')); ?>:</b>
    <?php echo CHtml::encode($data->group_desc); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
    <?php echo CHtml::encode($data->getStatusText($data->status)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
    <?php echo CHtml::encode($data->created_date); ?>
    <br/>


</div>