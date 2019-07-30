<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once(VIEWPATH.'waitui/templete/pub_head.php') ?>
    </head>
    
    <body>
    
    <?php include_once(VIEWPATH.'waitui/templete/menubar.php') ?>
    
    <div class="mark-top">
        <div class="container after-cls pt30">
            <div class="search">
                <form id="search_form" action="" method="post"><input type="hidden" name="filter_category" id="filter_category" /></form>
                <input type="text" placeholder="请输入商标关键字、商标名、产品名或注册号" value="<?php echo $keyword; ?>" id="keyword" onkeyup="keywordEnter()" />
                <input type="button" value="搜索" id="keywordBtn" onclick="keywordSearch()" />
                <div class="mod-select" id="search_category" data-filter="<?php echo $filter_category; ?>">
                    <font data-default="商标分类">商标分类</font>
                    <div class="select-menu">
                        <ul>
                            <li data-code=""><a href="javascript:;" data-val="商标分类">不限</a></li>
                            <?php foreach ($mark_category as $category){ ?>
                            <li data-code="<?php echo $category->category_id; ?>"><a href="javascript:;" data-val="<?php echo $category->category_name; ?>"><?php echo $category->category_no.'类-'.$category->category_name; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="filter">
                <div class="dropdown" id="filter_select_category" data-target="filter_category" data-filter="<?php echo $filter_category; ?>">
                    <div class="dropdown-text">
                        <font data-default="商标分类">商标分类</font>
                        <div class="dropdown-menu">
                            <ul>
                                <li data-code=""><a href="javascript:;" data-val="商标分类">不限</a></li>
                                <?php foreach ($mark_category as $category){ ?>
                                <li data-code="<?php echo $category->category_id; ?>"><a href="javascript:;" data-val="<?php echo $category->category_name; ?>"><?php echo $category->category_no.'类-'.$category->category_name; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="dropdown" id="filter_select_type" data-target="filter_type">
                    <div class="dropdown-text">
                        <font data-default="商标类型">商标类型</font>
                        <div class="dropdown-menu">
                            <ul>
                                <li data-code=""><a href="javascript:;" data-val="商标类型">不限</a></li>
                                <li data-code="cn"><a href="javascript:;" data-val="纯中文">纯中文</a></li>
                                <li data-code="en"><a href="javascript:;" data-val="纯英文(拼音)">纯英文(拼音)</a></li>
                                <li data-code="graph"><a href="javascript:;" data-val="纯图形">纯图形</a></li>
                                <li data-code="num"><a href="javascript:;" data-val="纯数字">纯数字</a></li>
                                <li data-code="other"><a href="javascript:;" data-val="其他类型">其他</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="dropdown" id="filter_select_price" data-target="filter_price">
                    <div class="dropdown-text">
                        <font data-default="价格范围">价格范围</font>
                        <div class="dropdown-menu">
                            <ul>
                                <li data-code=""><a href="javascript:;" data-val="价格范围">不限</a></li>
                                <li data-code="0-5000"><a href="javascript:;" data-val="5千以下">5千以下</a></li>
                                <li data-code="5000-10000"><a href="javascript:;" data-val="5千-1万">5千-1万</a></li>
                                <li data-code="10000-30000"><a href="javascript:;" data-val="1-3万">1-3万</a></li>
                                <li data-code="30000-50000"><a href="javascript:;" data-val="3-5万">3-5万</a></li>
                                <li data-code="50000-100000"><a href="javascript:;" data-val="5-10万">5-10万</a></li>
                                <li data-code="100000-10000000"><a href="javascript:;" data-val="10万以上">10万以上</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="dropdown" id="filter_select_length" data-target="filter_length">
                    <div class="dropdown-text">
                        <font data-default="名称长度">名称长度</font>
                        <div class="dropdown-menu">
                            <ul>
                                <li data-code=""><a href="javascript:;" data-val="名称长度">不限</a></li>
                                <li data-code="2-3"><a href="javascript:;" data-val="两字">两字</a></li>
                                <li data-code="3-4"><a href="javascript:;" data-val="三字">三字</a></li>
                                <li data-code="4-5"><a href="javascript:;" data-val="四字">四字</a></li>
                                <li data-code="5-100"><a href="javascript:;" data-val="四字以上">四字以上</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <a href="javascript:;" class="empty-filter">清空筛选条件</a>
            </div>
        </div>
    </div>
    
    <!--ajax提交的字段,还有一个filter_category字段，一个keyword字段在搜索框位置-->
    <input type="hidden" id="filter_type" value="" />
    <input type="hidden" id="filter_price" value="" />
    <input type="hidden" id="filter_length" value="" />
    <input type="hidden" id="mark_sort" value="" />
    <input type="hidden" id="mark_page" value="1" />
    
    <div class="container after-cls pt20 pb30">
        <div class="mark-list" id="mark_list">
            <div class="sort">
                <a href="javascript:;" data-sort="" class="cur">综合排序</a>
                <a href="javascript:;" data-sort="mark_price">商标价格</a>
                <a href="javascript:;" data-sort="reg_date">注册时间</a>
                <a href="javascript:;" data-sort="mark_length">商标长度</a>
                <div class="result">共找到<font id="mark_count"><?php echo $mark_count; ?></font>件商标</div>
            </div>
            
            <div class="box after-cls">
                <?php foreach ($mark_list as $mark){ ?>
                <a href="<?php echo base_url() ?>mark_detail/<?php echo $mark->regno_md; ?>.html" target="_blank" class="mark-item">
                    <!--tag有八种形式-->
                    <!--<div class="tag">优+</div>-->
                    <!--<div class="tag">促销</div>-->
                    <!--<div class="tag">HOT</div>-->
                    <!--<div class="tag">甩</div>-->
                    <!--<div class="tag">01类</div>-->
                    <!--<div class="tag">精品</div>-->
                    <!--<div class="tag">推荐</div>-->
                    <!--<div class="tag-type"><i class="type1"></i></div>-->
                    
                    <div class="tag-type"><i class="type<?php echo $mark->mark_category; ?>"></i></div>
                    <img class="thumb" data-src="<?php echo $mark->image_path; ?>" src="<?php echo CDN_URL; ?>favicon_120X90.png" />
                    <div class="limit">
                        <h4 class="price">¥<?php echo number_format($mark->mark_price); ?></h4>
                        <h5 class="category"><?php echo $mark->mark_category<10?'0'.$mark->mark_category:$mark->mark_category; ?>类<i></i><?php echo $mark->mark_name; ?></h5>
                    </div>
                    <p><?php echo $mark->app_range; ?></p>
                </a>
                <?php } ?>
            </div>
            
        </div>
        
        <?php if(count($mark_list) == 25){ ?>
        <div class="article-loadmore" id="mark_loading">加载中，请稍后...</div>
        <div class="article-loadmore" id="mark_loadnone" style="display: none;">喂喂，你触碰到我的底线了</div>
        <?php }else{ ?>
        <div class="article-loadmore" id="mark_loading" style="display: none;">加载中，请稍后...</div>
        <div class="article-loadmore" id="mark_loadnone">喂喂，你触碰到我的底线了</div>
        <?php } ?>
    </div>
    
    <?php include_once(VIEWPATH.'waitui/templete/pub_foot.php') ?>
    
    <script type="text/javascript">
    
    var mark_loading = false;//状态标记
    
    function keywordEnter(e){
        var eve = e || window.event;
        if(eve.keyCode == 13){
            keywordSearch();
        }
    }
    
    function keywordSearch(){
        if($.trim($("#keyword").val()) == ""){
            $("#search_form").attr('action','<?php echo base_url() ?>mark_search.html');
            $("#search_form").submit();
        }else{
            $("#search_form").attr('action','<?php echo base_url() ?>mark_search/'+$("#keyword").val());
            $("#search_form").submit();
        }
        
    }
    
    function resetFilter(obj){
        var $obj = $(obj);
        
        $obj.parents(".dropdown").find("li:first a")[0].click();
        
        $obj.parents(".dropdown").removeClass("selected");
        var $dropfont = $obj.parents(".dropdown").find("font");
        $dropfont.html($dropfont.data("default"));
        $obj.remove();
        
    }
    
    function autoSelectFilter(obj,val){//自动选中模拟下拉框的值
        var $obj = $(obj);
        var $select_font = $obj.find("font");
        var font_default = $select_font.data("default");
        
        var $items = $obj.find("li");
        $items.each(function(i){
            if($(this).data("code") == val){
                $(this).addClass("cur").siblings().removeClass("cur");
                var select_val = $(this).find("a").data("val");
                $select_font.html(select_val);
                
                if($obj.hasClass("dropdown")){//如果在下面的筛选区域内，需要标红和添加叉号
                    if(select_val == font_default){
                        $obj.removeClass("selected").find("em").remove();
                    }else{
                        if(!$obj.hasClass("selected")){
                            $obj.addClass("selected").prepend('<em onclick="resetFilter(this)"></em>');
                        }
                    }
                }
            }
        })
        $("#filter_category").val(val);
        
    }
    
    function get_markSearchAjax(current_page,type){//type为0表示筛选，1表示向下滚动
        $.ajax({
            type:"post",
            url:"<?php echo base_url() ?>waitui/Index_controller/get_markSearchAjax_tpl",
            async:true,
            data:{
                keyword:$("#keyword").val(),
                filter_category:$("#filter_category").val(),
                filter_type:$("#filter_type").val(),
                filter_price:$("#filter_price").val(),
                filter_length:$("#filter_length").val(),
                mark_sort:$("#mark_sort").val(),
                mark_page: current_page+1
            },
            success:function(html){
                var $html = $(html);
                if($html.length < 25){
                    $("#mark_loading").hide();
                    $("#mark_loadnone").show();
                }
                if(type == 0){
                    $("#mark_list .box").html(html);
                }else{
                    $("#mark_list .box").append(html);
                }
                $("#mark_page").val(current_page+1);
                mark_loading = false;
            }
        });
    }
    
    function get_markSearchCountAjax(){
        $.ajax({
            type:"post",
            url:"<?php echo base_url() ?>waitui/Index_controller/get_markSearchCountAjax",
            async:true,
            data:{
                keyword:$("#keyword").val(),
                filter_category:$("#filter_category").val(),
                filter_type:$("#filter_type").val(),
                filter_price:$("#filter_price").val(),
                filter_length:$("#filter_length").val()
            },
            dataType:'json',
            success:function(json){
                $("#mark_count").text(json.mark_count);
            }
        });
    }
    
    $(function(){
        
        lazyLoading();//图片懒加载
        $(window).on("scroll",function(){
            lazyLoading();
        })
        
        $("[data-filter]").each(function(){//被查询的分类初始化，相当于直接给select设定value的效果
            var $this = $(this);
            autoSelectFilter(this,$this.data("filter"));
        })
        
        scrollTop("ico_top");//返回顶部
        
        $(".mark-top .search .mod-select").on("mouseenter",function(){
            $(this).find(".select-menu").show();
        }).on("mouseleave",function(){
            $(this).find(".select-menu").hide();
        })
        
        $(".mark-top .select-menu a").on("click",function(){
            $(this).parent().addClass("cur").siblings().removeClass("cur");
            $(this).parents(".mod-select").find("font").html($(this).data("val"));
            $(this).parents(".select-menu").hide();
            
            var filter = $(this).parent().data("code");
            autoSelectFilter($("#filter_select_category")[0],filter);//同时改变另一个下拉框
            
        })
        
        $(".mark-top .dropdown-text").on("mouseenter",function(){
            $(this).find(".dropdown-menu").show();
        }).on("mouseleave",function(){
            $(this).find(".dropdown-menu").hide();
        })
        
        $(".mark-top .dropdown-menu a").on("click",function(){
            var select_val = $(this).data("val");
            var $dropdown = $(this).parents(".dropdown");
            var $select_font = $dropdown.find("font");
            var font_default = $select_font.data("default");
            
            if(select_val == font_default){
                $dropdown.removeClass("selected").find("em").remove();
                $select_font.html(font_default);
            }else{
                if(!$dropdown.hasClass("selected")){
                    $dropdown.addClass("selected").prepend('<em onclick="resetFilter(this)"></em>');
                }
                $select_font.html(select_val);
                $(this).parent().addClass("cur").siblings().removeClass("cur");
            }
            $(this).parents(".dropdown-menu").hide();
            var filter = $(this).parent().data("code");
            $("#"+$dropdown.data("target")).val(filter);
            
            //如果商标分类下拉框
            if($dropdown[0].id == "filter_select_category"){
                autoSelectFilter($("#search_category")[0],filter);//同时改变另一个下拉框
            }
            
            $("#mark_list .box").empty();
            $("#mark_page").val(0);
            $("#mark_loading").show();
            $("#mark_loadnone").hide();
            mark_loading = true;
            var current_page = parseInt($("#mark_page").val());
            get_markSearchAjax(current_page,0);
            get_markSearchCountAjax();
            
        })
        
        $(".empty-filter").on("click",function(){
            location.href = "<?php echo base_url() ?>mark_search.html";
        })
        
        $(".mark-list .sort a").on("click",function(){
            $(this).addClass("cur").siblings().removeClass("cur");
            $("#mark_sort").val($(this).data("sort"));
            
            $("#mark_list .box").empty();
            $("#mark_page").val(0);
            $("#mark_loading").show();
            $("#mark_loadnone").hide();
            mark_loading = true;
            var current_page = parseInt($("#mark_page").val());
            get_markSearchAjax(current_page,0);
            
        })
        
        $(window).on("scroll",function(){
            if($("#mark_loadnone").is(":visible")) return;
            if($(window).scrollTop() + $(window).height() + 100 < $(document).height()) return;
            if(mark_loading) return;
            mark_loading = true;
            var current_page = parseInt($("#mark_page").val());
            get_markSearchAjax(current_page,1);
        })
        
    })
    </script>
    </body>
</html>
