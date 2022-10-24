<?php
$this->renderPartial('/page/_about', array());
$this->renderPartial('/page/_page_bottom', array());
?>
<?php
$youtube_link = isset($this->site_config['youtube_video_link'])?$this->site_config['youtube_video_link']:'';
$youtube_link = trim($youtube_link);
if($youtube_link!=''){ ?>
    <div class="container">
        <div class="youtube-video-about">
            <div class="row">
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-9">
                    <?php
                        $youtube_id = CFunction::getYoutubeId($youtube_link);
                        /*$data_poster = CFunction::get_youtube_thumbnail($youtube_id);*/
                        /*$data_poster = "";
                        echo '<video class="video-js video-player" id="video_player" data-poster="'.$data_poster.'" data-video-type="youtube">
                                <source src="'. $youtube_link.'" type="video/youtube"/>
                            </video>';*/

                    ?>

                    <div id="youtube_iframe">
                        <iframe src="https://www.youtube.com/embed/<?=$youtube_id?>"></iframe>
                    </div>

                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                //fix height player
                var $youtube_player = $('#youtube_iframe iframe');
                var $_width = $($youtube_player).width();
                var $_height = ( $_width * 9 ) / 16;
                $($youtube_player).height($_height);
                //resize
                $(window).on('resize', function(){
                    var $_width = $($youtube_player).width();
                    var $_height = ( $_width * 9 ) / 16;
                    $($youtube_player).height($_height);
                }).trigger('resize');
            });
        </script>
    </div>
<?php }
?>