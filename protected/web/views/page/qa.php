<div class="iz-qa">
    <?php
    $this->renderPartial('/page/_qa', array(
        'qa_categories'    =>  $qa_categories
    ));
    $this->renderPartial('/page/_page_bottom', array());
    ?>
</div>