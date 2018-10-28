<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once('templete/pub_head.php') ?>
    </head>
    
    <body>
    
    <?php include_once('templete/menubar.php') ?>
    
    <div class="domain-top">
        <div class="container after-cls pt30 pb25">
            <div class="search">
                <form id="search_form" action="" method="post"><input type="hidden" name="filter_category" id="filter_category" /></form>
                <input type="text" placeholder="请输入域名关键字" value="" id="keyword" onkeyup="keywordEnter()" />
                <input type="button" value="搜索" id="keywordBtn" onclick="keywordSearch()" />
            </div>
        </div>
    </div>
    
    <div class="bg-white mb20">
        <div class="container after-cls pb30">
            <div class="domain-list" id="domain_list">
                <table class="domain-table" width="100%">
                    <thead>
                        <tr>
                            <th width="20%" class="pl30">域名</th>
                            <th width="35%">简介</th>
                            <th>交易类型</th>
                            <th>当前价格</th>
                            <th>距到期</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($domain_list as $domain){ ?>
                        <tr>
                            <td class="pl30"><a href="" target="_blank" class="domain"><?php echo $domain->domain_name; ?></a></td>
                            <td><?php echo $domain->domain_summary; ?></td>
                            <td>一口价</td>
                            <td><?php echo $domain->domain_price; ?>元</td>
                            <td><?php echo $domain->expired_date; ?>天</td>
                            <?php if(empty($userinfo)){ ?>
                            <td><a href="javascript:;" onclick="func_upwin_login()" class="buy-btn">购买</a></td>
                            <?php }else{ ?>
                            <td><a href="javascript:;" class="buy-btn">购买</a></td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                
                <div class="domain-pagination">
                <?php echo $this->pagination->create_links(); ?>
                <div class="total">共<font><?php echo $page_count; ?></font>条，每页显示<font><?php echo $page_size; ?></font>条</div>
                </div>
                
            </div>
        </div>
    </div>
    
    <?php include_once('templete/pub_foot.php') ?>
    
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
            $("#search_form").attr('action','<?php echo base_url() ?>domain.html');
            $("#search_form").submit();
        }else{
            $("#search_form").attr('action','<?php echo base_url() ?>domain.html');
            $("#search_form").submit();
        }
        
    }
    
    $(function(){
        
        scrollTop("ico_top");//返回顶部
        
    })
    </script>
    </body>
</html>
