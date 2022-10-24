<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="<?= Yii::app()->baseUrl; ?>" class="site_title"><i class="fa fa-android"></i> <span><?= Yii::app()->name; ?></span></a>
        </div>
        <div class="clearfix"></div>
        <?php
        ?>
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <?php foreach ($this->main_menu as $row): ?>
                        <?php if (isset($row['visible']) && $row['visible']): ?>
                            <li><a href="<?= (isset($row['url']) && $row['url']!='') ? CHtml::normalizeUrl($row['url']) : 'javascript:void(0);'; ?>"><i class="<?= $row['icon_class'] ?>"></i><?= $row['label'] ?><?php if (isset($row['items']) && count($row['items'])) {
                                        echo '<span class="fa fa-chevron-down"></span>';
                                    } ?> </a>
                                <?php if (isset($row['items']) && count($row['items'])): ?>
                                    <ul class="nav child_menu" style="display: none">
                                        <?php foreach ($row['items'] as $srow): ?>
                                            <?php if (isset($srow['visible']) && $srow['visible']): ?>
                                                <li><a href="<?= CHtml::normalizeUrl($srow['url']); ?>"><?= $srow['label'] ?></a></li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a href="<?= Yii::app()->createUrl('aSystemUser/changePass'); ?>" data-toggle="tooltip" data-placement="top" title="Đổi mật khẩu">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a href="<?=Yii::app()->createUrl('aSite/logout');?>" data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                &nbsp;<!--<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>-->
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                &nbsp;<!--<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>-->
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>