<?php foreach ($article_list as $article){ ?>
<a href="<?php echo base_url() ?>m/article_detail/<?php echo $article->article_id ?>.html" target="_parent" class="weui-media-box weui-media-box_appmsg">
    <div class="weui-media-box__bd">
        <h4 class="weui-media-box__title"><?php echo $article->article_title; ?></h4>
        <p class="weui-media-box__desc"><?php echo $article->article_tag; ?>&nbsp;&nbsp;<?php echo $article->create_time; ?></p>
    </div>
    <div class="weui-media-box__hd">
        <img class="weui-media-box__thumb" src="<?php echo $article->thumb_path; ?>">
    </div>
</a>
<?php } ?>