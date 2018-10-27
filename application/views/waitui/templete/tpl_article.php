<?php foreach ($article_list as $article){ ?>
<a href="<?php echo base_url() ?>article_detail/<?php echo $article->article_id ?>.html" target="_blank" class="article-item">
    <div class="thumb">
        <img src="<?php echo $article->thumb_path; ?>" alt="<?php echo $article->article_title; ?>" />
    </div>
    <div class="limit">
        <h4 class="title"><?php echo $article->article_title; ?></h4>
        <h5 class="summary"><?php echo $article->article_lead; ?></h5>
    </div>
    <p><span class="author"><?php echo $article->author_name; ?></span><span class="tag"><?php echo $article->article_tag; ?>&nbsp;&nbsp;<?php echo $article->create_time; ?></span></p>
</a>
<?php } ?>