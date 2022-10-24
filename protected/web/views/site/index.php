<div id="home_page" class="home-page">
    <!--slider home banner-->
    <?php $this->renderPartial('/site/_home_banner', array()); ?>
    <!--end slider home banner-->

    <!--home news-->
    <?php $this->renderPartial('/site/_home_news', array()); ?>
    <!--end home news-->
    <p><strong></strong></p>

    <!--job-detail-->
    <?php $this->renderPartial('//page/job_details', array()); ?>
    <!--end job-detail-->
    <p><strong></strong></p>

    <!--job-recruitment_benefit-->
    <?php $this->renderPartial('/page/recruitment_benefit', array()); ?>
    <!--end job-recruitment_benefit-->
    <p><strong></strong></p>

    <?php
    $this->renderPartial('_contact_form', array());
    ?>
</div>

<script>
    $(document).ready(function () {
        $('.contact-us').hide();
    });
</script>