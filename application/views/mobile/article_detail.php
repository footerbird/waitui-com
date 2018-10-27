<!DOCTYPE html>
<html>

    <head>
    <?php include_once('templete/pub_head.php') ?>
    <script type="text/javascript">
    function loadHtmlImg(obj){}
    </script>
    </head>

    <body>
    <div class="container">
        
        <article class="weui-article">
            <h1 class="article-title"><?php echo $article->article_title; ?></h1>
            <div class="article-author">
                <img class="article-author-figure" src="<?php echo $article->figure_path; ?>" />
                <span class="article-author-name"><?php echo $article->author_name; ?></span>
                <span class="article-author-time"><?php echo $article->create_time; ?></span>
            </div>
            <div class="article-summary"><?php echo $article->article_lead; ?></div>
            <section><?php echo $article->article_content; ?></section>
        </article>
        
    </div>
    
    <?php include_once('templete/pub_foot.php') ?>
    <script>
    window.onload = function(){
        
    }
    
    $(function(){
        
    })
    
    </script>
    </body>
</html>