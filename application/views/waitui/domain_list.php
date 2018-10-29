<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once('templete/pub_head.php') ?>
    </head>
    
    <body>
    
    <?php include_once('templete/menubar.php') ?>
    
    <div class="domain-top">
    <form id="search_form" action="<?php echo base_url() ?>domain_list.html" method="post">
        <div class="container after-cls pt30">
            <div class="search">
                <input type="text" placeholder="请输入域名关键字 / 域名含义" name="keyword" value="<?php echo $keyword; ?>" id="keyword" onkeyup="keywordEnter()" />
                <input type="button" value="搜索" id="keywordBtn" onclick="keywordSearch()" />
            </div>
            <div class="quick">
                <input type="hidden" name="domain_type" id="domain_type" value="<?php echo $domain_type; ?>" />
                <label>快速查找：</label>
                <a href="javascript:;" onclick="typeSearch()">全部</a>
                <a href="javascript:;" onclick="typeSearch('四声COM')">四声母COM</a>
                <a href="javascript:;" onclick="typeSearch('四声CN')">四声母CN</a>
                <a href="javascript:;" onclick="typeSearch('四声COMCN')">四声母COM.CN</a>
            </div>
        </div>
    </form>
    </div>
    
    <div class="bg-white mb20">
        <div class="container after-cls pb30">
            <div class="domain-list" id="domain_list">
                <table class="domain-table" width="100%">
                    <thead>
                        <tr>
                            <th width="20%" class="pl30">域名</th>
                            <th width="20%">简介</th>
                            <th>交易类型</th>
                            <th>当前价格</th>
                            <th>距到期</th>
                            <th>注册商</th>
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
                            <td><?php echo $domain->register_registrar; ?></td>
                            <?php if(empty($userinfo)){ ?>
                            <td><a href="javascript:;" onclick="func_upwin_login()" class="buy-btn">购买</a></td>
                            <?php }else{ ?>
                            <td><a href="javascript:;" class="buy-btn">购买</a></td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                        <?php if(count($domain_list) == 0){ ?>
                        <tr>
                        	<td colspan="7" class="ta-c">未搜索到相应结果</td>
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
        $("#keyword").val($.trim($("#keyword").val()));
        $("#search_form").submit();
    }
    
    function typeSearch(type){
    	$("#domain_type").val(type);
    	keywordSearch();
    }
    
    $(function(){
        
        scrollTop("ico_top");//返回顶部
        
    })
    </script>
    </body>
</html>
