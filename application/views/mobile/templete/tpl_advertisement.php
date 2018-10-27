<?php foreach ($ad_list as $advertisement){ ?>
<!-------------slide----------------->
<section class="swiper-slide swiper-slide-v">
    <?php if($advertisement->ad_type == 'image'){ ?>
    <img class="banner" src="<?php echo $advertisement->ad_address; ?>" />
    <?php }else if($advertisement->ad_type == 'iframe'){ ?>
    <iframe src="<?php echo $advertisement->ad_address; ?>" frameborder="0" class="banner" width="100%" height="100%"></iframe>
    <?php }else{ ?>
    <video class="banner" src="<?php echo $advertisement->ad_address; ?>" poster="<?php echo $advertisement->video_poster; ?>" type="video/mp4" loop="loop" preload="load" muted webkit-playsinline="true" playsinline="true" x-webkit-airplay="true" x5-video-player-type="h5" x5-video-player-fullscreen="portraint">当前浏览器不支持</video>
    <?php } ?>
    <div class="swiper-mask">
        <div class="author-info">
            <font class="ad">广告</font>
            <h4>@<?php echo $advertisement->author_name; ?></h4>
            <p><?php echo $advertisement->ad_desc; ?></p>
        </div>
        <div class="side-bar">
            <div class="figure">
                <img src="<?php echo $advertisement->author_figure; ?>" class="ico-figure" />
            </div>
            <div class="heart">
                <i data-adid="<?php echo $advertisement->ad_id; ?>" class="ico-heart <?php if(!empty($userinfo) && $advertisement->is_heart > 0){ echo 'heartAnimation'; } ?>" onclick="heartClick(this,<?php echo $advertisement->ad_id; ?>)"></i>
                <p><?php echo $advertisement->heart_amount; ?></p>
            </div>
        </div>
        <?php if($advertisement->ad_type == 'video'){ ?>
        <div class="video-play"></div>
        <?php } ?>
    </div>
    
    <?php if(empty($userinfo)){ ?>
        <?php if($advertisement->is_award == 1){ ?>
        <div class="swiper-hongbao">
            <img src="/htdocs/mobile/images/hongbao2.png" data-adid="<?php echo $advertisement->ad_id; ?>" onclick="linkTo(this,'<?php echo $advertisement->ad_link; ?>')" />
        </div>
        <?php } ?>
    <?php }else{ ?>
        <?php if($advertisement->is_pick == 0 && $advertisement->is_award == 1){ ?>
        <div class="swiper-hongbao">
            <img src="/htdocs/mobile/images/hongbao2.png" data-adid="<?php echo $advertisement->ad_id; ?>" onclick="linkTo(this,'<?php echo $advertisement->ad_link; ?>')" />
        </div>
        <?php } ?>
    <?php } ?>
    
</section>
<?php } ?>