<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once('templete/pub_head.php') ?>
    </head>
    
    <body>
    
    <?php include_once('templete/menubar.php') ?>
    
    <div class="mark-top">
        <div class="container after-cls pt30">
            <div class="search">
                <form id="search_form" action="" method="post"><input type="hidden" name="filter_category" id="filter_category" /></form>
                <input type="text" placeholder="请输入商标关键字、商标名、产品名或注册号" id="keyword" onkeyup="keywordEnter()" />
                <input type="button" value="搜索" id="keywordBtn" onclick="keywordSearch()" />
            </div>
            
            <div class="category">
                <font>商标分类：</font>
                <ul>
                    <?php foreach ($mark_category as $category){ ?>
                    <li><a href="javascript:;" data-code="<?php echo $category->category_id; ?>"><?php echo $category->category_no.'类-'.$category->category_name; ?></a></li>
                    <?php } ?>
                </ul>
                <a href="javascript:;" class="more">更多<i></i></a>
            </div>
        </div>
    </div>
    
    <div class="container after-cls pb30">
        <?php 
            $block_category1 = array_slice($mark_category, 0,9);
            $mark_list1 = $mark_list[0];
        ?>
        <div class="mark-block">
            <div class="tab tab1">
                <ul>
                    <?php foreach ($block_category1 as $key => $category){ ?>
                    <li <?php if($key == 0){ echo 'class="cur"'; } ?>>
                        <a href="javascript:;" data-code="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="list">
                <ul>
                    <?php foreach ($mark_list1 as $mark){ ?>
                    <li><a href="<?php echo base_url() ?>mark_detail/<?php echo $mark->regno_md; ?>.html" target="_blank">
                        <img class="thumb" data-src="<?php echo $mark->image_path; ?>" src="<?php echo CDN_URL; ?>favicon_84X64.svg" />
                        <div class="limit">
                            <h4 class="price">¥<?php echo $mark->mark_price; ?></h4>
                            <h5 class="category"><?php echo $mark->mark_category<10?'0'.$mark->mark_category:$mark->mark_category; ?>类<i></i><?php echo $mark->mark_name; ?></h5>
                        </div>
                        <p><?php echo $mark->app_range; ?></p>
                    </a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        
        <?php 
            $block_category2 = array_slice($mark_category, 9,9);
            $mark_list2 = $mark_list[1];
        ?>
        <div class="mark-block">
            <div class="tab tab2">
                <ul>
                    <?php foreach ($block_category2 as $key => $category){ ?>
                    <li <?php if($key == 0){ echo 'class="cur"'; } ?>>
                        <a href="javascript:;" data-code="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="list">
                <ul>
                    <?php foreach ($mark_list2 as $mark){ ?>
                    <li><a href="<?php echo base_url() ?>mark_detail/<?php echo $mark->regno_md; ?>.html" target="_blank">
                        <img class="thumb" data-src="<?php echo $mark->image_path; ?>" src="<?php echo CDN_URL; ?>favicon_84X64.svg" />
                        <div class="limit">
                            <h4 class="price">¥<?php echo $mark->mark_price; ?></h4>
                            <h5 class="category"><?php echo $mark->mark_category<10?'0'.$mark->mark_category:$mark->mark_category; ?>类<i></i><?php echo $mark->mark_name; ?></h5>
                        </div>
                        <p><?php echo $mark->app_range; ?></p>
                    </a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        
        <?php 
            $block_category3 = array_slice($mark_category, 18,9);
            $mark_list3 = $mark_list[2];
        ?>
        <div class="mark-block">
            <div class="tab tab3">
                <ul>
                    <?php foreach ($block_category3 as $key => $category){ ?>
                    <li <?php if($key == 0){ echo 'class="cur"'; } ?>>
                        <a href="javascript:;" data-code="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="list">
                <ul>
                    <?php foreach ($mark_list3 as $mark){ ?>
                    <li><a href="<?php echo base_url() ?>mark_detail/<?php echo $mark->regno_md; ?>.html" target="_blank">
                        <img class="thumb" data-src="<?php echo $mark->image_path; ?>" src="<?php echo CDN_URL; ?>favicon_84X64.svg" />
                        <div class="limit">
                            <h4 class="price">¥<?php echo $mark->mark_price; ?></h4>
                            <h5 class="category"><?php echo $mark->mark_category<10?'0'.$mark->mark_category:$mark->mark_category; ?>类<i></i><?php echo $mark->mark_name; ?></h5>
                        </div>
                        <p><?php echo $mark->app_range; ?></p>
                    </a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        
        <?php 
            $block_category4 = array_slice($mark_category, 27,9);
            $mark_list4 = $mark_list[3];
        ?>
        <div class="mark-block">
            <div class="tab tab4">
                <ul>
                    <?php foreach ($block_category4 as $key => $category){ ?>
                    <li <?php if($key == 0){ echo 'class="cur"'; } ?>>
                        <a href="javascript:;" data-code="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="list">
                <ul>
                    <?php foreach ($mark_list4 as $mark){ ?>
                    <li><a href="<?php echo base_url() ?>mark_detail/<?php echo $mark->regno_md; ?>.html" target="_blank">
                        <img class="thumb" data-src="<?php echo $mark->image_path; ?>" src="<?php echo CDN_URL; ?>favicon_84X64.svg" />
                        <div class="limit">
                            <h4 class="price">¥<?php echo $mark->mark_price; ?></h4>
                            <h5 class="category"><?php echo $mark->mark_category<10?'0'.$mark->mark_category:$mark->mark_category; ?>类<i></i><?php echo $mark->mark_name; ?></h5>
                        </div>
                        <p><?php echo $mark->app_range; ?></p>
                    </a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        
        <?php 
            $block_category5 = array_slice($mark_category, 36,9);
            $mark_list5 = $mark_list[4];
        ?>
        <div class="mark-block">
            <div class="tab tab5">
                <ul>
                    <?php foreach ($block_category5 as $key => $category){ ?>
                    <li <?php if($key == 0){ echo 'class="cur"'; } ?>>
                        <a href="javascript:;" data-code="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="list">
                <ul>
                    <?php foreach ($mark_list5 as $mark){ ?>
                    <li><a href="<?php echo base_url() ?>mark_detail/<?php echo $mark->regno_md; ?>.html" target="_blank">
                        <img class="thumb" data-src="<?php echo $mark->image_path; ?>" src="<?php echo CDN_URL; ?>favicon_84X64.svg" />
                        <div class="limit">
                            <h4 class="price">¥<?php echo $mark->mark_price; ?></h4>
                            <h5 class="category"><?php echo $mark->mark_category<10?'0'.$mark->mark_category:$mark->mark_category; ?>类<i></i><?php echo $mark->mark_name; ?></h5>
                        </div>
                        <p><?php echo $mark->app_range; ?></p>
                    </a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        
    </div>
    
    <?php include_once('templete/pub_foot.php') ?>
    
    <script type="text/javascript">
    function keywordEnter(e){
        var eve = e || window.event;
        if(eve.keyCode == 13){
            keywordSearch();
        }
    }
    
    function keywordSearch(){
        if($.trim($("#keyword").val()) == ""){
            Pop.alert("商标关键词不能为空");
            return;
        }
        $("#search_form").attr('action','<?php echo base_url() ?>mark_search/'+$("#keyword").val());
        $("#search_form").submit();
    }
    
    $(function(){
        
        lazyLoading();//图片懒加载
        $(window).on("scroll",function(){
            lazyLoading();
        })
        
        scrollTop("ico_top");//返回顶部
        
        $(".mark-top .category li a").on("click",function(){
            $(this).parent().addClass("cur");
            var category = $(this).data("code");
            $("#filter_category").val(category);
            $("#search_form").attr('action','<?php echo base_url() ?>mark_search.html');
            $("#search_form").submit();
        })
        
        $(".mark-top .category .more").on("click",function(){
            if($(".mark-top .category").hasClass("category-expand")){//如果展开，则收起
                $(".mark-top .category").removeClass("category-expand");
                $(".mark-top .category .more").html('更多<i></i>');
            }else{
                $(".mark-top .category").addClass("category-expand");
                $(".mark-top .category .more").html('收起<i style="transform:rotate(180deg)"></i>');
            }
        })
        
        $(".mark-block .tab a").on("click",function(){
            var $this = $(this);
            if($this.parent().hasClass("cur")) return;
            $this.parent().addClass("cur").siblings().removeClass("cur");
            var category = $this.data("code");
            $.ajax({
                type:"post",
                url:"<?php echo base_url() ?>waitui/Index_controller/get_markBlockAjax_tpl",
                async:true,
                data:{
                    category:category
                },
                success:function(html){
                    $this.parents(".mark-block").find(".list ul").html(html);
                }
            });
        })
        
    })
    </script>
    </body>
</html>
