<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('controller')); ?>:</b>
    <?php echo CHtml::encode($data->controller); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
    <?php echo CHtml::encode($data->user_id); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('permission')); ?>:</b>
    <?php echo CHtml::encode($data->permission); ?>
    <br/>


</div>