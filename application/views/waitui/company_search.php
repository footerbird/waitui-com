<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once(VIEWPATH.'waitui/templete/pub_head.php') ?>
    </head>
    
    <body>
    
    <?php include_once(VIEWPATH.'waitui/templete/menubar.php') ?>
    
    <div class="company-top">
        <div class="container after-cls pt25 pb20">
            <div class="search">
                <form id="search_form" action="" method="post"></form>
                <input type="text" placeholder="请输入企业名称 / 法人姓名" name="keyword" value="<?php echo $keyword; ?>" id="keyword" onkeyup="keywordEnter()" />
                <input type="button" value="搜索" id="keywordBtn" onclick="keywordSearch()" />
            </div>
            <div class="province">
                <dl>
                    <dt>所属地区：</dt>
                    <dd>
                        <?php foreach ($province_list as $province){ ?>
                        <a href="<?php echo base_url() ?>company_<?php echo $province['code']; ?>.html"><?php echo $province['code'].' - '.$province['name']; ?></a>
                        <?php } ?>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
    
    <div class="bg-white mt20 mb20">
        <div class="container after-cls pb30">
            <div class="company-left">
                <div class="company-list" id="company_list">
                    <div class="company-item-title">查询结果(<?php echo $page_count; ?>)</div>
                    <?php foreach ($company_list as $key => $company){ ?>
                    <div class="company-item">
                        <div class="title"><a href="<?php echo base_url() ?>company_detail/<?php echo $company->company_id; ?>.html" target="_blank"><?php echo $company->name; ?></a></div>
                        <p>法定代表人：<?php echo $company->oper_name; ?>&nbsp;&nbsp;注册资本：<?php echo $company->regist_capi; ?>&nbsp;&nbsp;成立时间：<?php echo date('Y-m-d',strtotime($company->start_date)); ?>&nbsp;&nbsp;所属行业：<?php echo $company->industry; ?></p>
                        <p>地址：<?php echo $company->address; ?></p>
                    </div>
                    <?php } ?>
                    
                    <div class="route-pagination">
                    <?php echo $this->pagination->create_links(); ?>
                    <div class="total">共<font><?php echo $page_count; ?></font>条，每页显示<font><?php echo $page_size; ?></font>条</div>
                    </div>
                    
                </div>
            </div>
            <div class="company-right">
                
                <div class="flash" style="border-top: none;">
                    <h4 class="title">7×24h&nbsp;快讯</h4>
                    <?php foreach ($flash_list as $flash){ ?>
                    <div class="flash-item">
                        <a href="javascript:;"><?php echo $flash->flash_title; ?></a>
                        <div><?php echo $flash->flash_content; ?></div>
                        <p><?php echo $flash->create_time; ?></p>
                    </div>
                    <?php } ?>
                </div>
                
                <div class="swiper-container swiper mt20" id="company_swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=2165223868&amp;site=qq&amp;menu=yes" target="_blank">
                                <img src="/htdocs/waitui/images/ad/ad-domain-entrust.png" />
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="<?php echo base_url() ?>/domain_list.html" target="_blank">
                                <img src="/htdocs/waitui/images/ad/ad-domain-market.png" />
                            </a>
                        </div>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- 如果需要导航按钮 -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                
                <div class="recommend mt20" style="border-top: none;">
                    <h4 class="title">推荐阅读</h4>
                    <?php foreach ($article_recommend as $recommend){ ?>
                    <div class="recommend-item">
                        <a href="<?php echo base_url() ?>article_detail/<?php echo $recommend->article_id ?>.html" target="_blank"><?php echo $recommend->article_title ?></a>
                    </div>
                    <?php } ?>
                </div>
                
            </div>
        </div>
    </div>
    
    <?php include_once(VIEWPATH.'waitui/templete/pub_foot.php') ?>
    
    <script type="text/javascript">
    function keywordEnter(e){
        var eve = e || window.event;
        if(eve.keyCode == 13){
            keywordSearch();
        }
    }
    
    function keywordSearch(){
        if($.trim($("#keyword").val()) == ""){
            $("#search_form").attr('action','<?php echo base_url() ?>company_list.html');
            $("#search_form").submit();
        }else{
            $("#search_form").attr('action','<?php echo base_url() ?>company_search/'+$("#keyword").val());
            $("#search_form").submit();
        }
    }
    
    $(function(){
        
        scrollTop("ico_top");//返回顶部
        
        var mySwiper = new Swiper ('#company_swiper', {
            loop : true,
            autoplay: {
                delay: 8000,//8秒切换一次
            },
            pagination: {
                el: '.swiper-pagination',
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            }
        })
        
        $(".flash-item a").on("click",function(){
            $(this).parent().toggleClass("active");
            $(this).siblings("div").slideToggle();
        })
        
    })
    </script>
    </body>
</html>
