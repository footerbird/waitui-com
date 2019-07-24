<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once(VIEWPATH.'waitui/templete/pub_head.php') ?>
    </head>
    
    <body>
    
    <?php include_once(VIEWPATH.'waitui/templete/my_menubar.php') ?>
    
    <div class="my-container pt30">
        <?php include_once(VIEWPATH.'waitui/templete/my_leftmenu.php') ?>
        <div class="my-mainpanel">
            <div class="panel-title mb20">我的域名</div>
            <form id="search_form" action="<?php echo base_url() ?>my_domain" method="post">
                <div class="my-table-filter after-cls">
                    <input type="text" placeholder="输入域名" class="fl-l mr10" name="keyword" value="<?php echo $keyword; ?>" id="keyword" onkeyup="keywordEnter()" />
                    <a href="javascript:;" class="pub-btn fl-l mr10" onclick="keywordSearch()">搜索</a>
                    <a href="<?php echo base_url() ?>domain_list.html" target="_blank" class="pub-btn-yellow fl-l"><i class="ico-shop"></i>淘域名</a>
                    <div class="fl-r">
                        <a href="javascript:;" class="pub-btn-blue mr10" onclick="contactAdmin()">求购域名</a>
                        <a href="javascript:;" class="pub-btn-green" onclick="contactAdmin()">注册域名</a>
                    </div>
                </div>
            </form>
            <table class="my-table" width="100%">
                <thead>
                    <tr>
                        <th align="left" width="24%" class="pl30">域名</th>
                        <th align="left" width="12%">注册时间</th>
                        <th align="left" width="12%">过期时间</th>
                        <th align="left" width="12%">状态</th>
                        <th align="left" width="20%">注册机构</th>
                        <th align="right" width="20%" class="pr30"></th>
                    </tr>
                </thead>
                <tbody>
                <?php if(count($domain_list) != 0){ ?>
                    <?php foreach ($domain_list as $domain){ ?>
                    <tr>
                        <td class="f14 pl30"><?php echo $domain->domain_name; ?></td>
                        <td><?php echo date('Y-m-d',strtotime($domain->created_date)); ?></td>
                        <td><?php echo date('Y-m-d',strtotime($domain->expired_date)); ?></td>
                        <td>
                            <?php 
                                if((int)$domain->expired_distance > 30){
                                    echo '<span class="col-green">正常</span>';
                                }elseif((int)$domain->expired_distance >= 0){
                                    echo '<span class="col-warn">即将过期</span>';
                                }else{
                                    echo '<span class="col-gray9">已过期</span>';
                                }
                             ?>
                        </td>
                        <td><?php echo $domain->register_name; ?></td>
                        <td align="right" class="pr30">
                            <?php if((int)$domain->expired_distance > 30){ ?>
                                <a href="javascript:;" class="ml10">续费</a>
                                <a href="javascript:;" class="ml10" onclick="contactAdmin()">解析</a>
                                <a href="javascript:;" class="ml10" onclick="contactAdmin()">转出</a>
                            <?php }elseif((int)$domain->expired_distance >= 0){ ?>
                                <a href="javascript:;" class="ml10">续费</a>
                            <?php }else{ ?>
                                <a href="javascript:;" class="ml10" onclick="contactAdmin()">购买</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                <?php }else{ ?>
                    <tr>
                        <td colspan="6" class="pl30 pr30">
                            <p class="ta-c f18 col-my pt50 pb30">暂无域名</p>
                            <p class="ta-c"><img src="/htdocs/waitui/images/console-certify.png"></p>
                            <p class="ta-c f14 col-gray9 lh28 pt30">
                              您好，暂无搜索结果，<br>您可以联系您的专属<a href="javascript:;" class="ml10 mr10" onclick="contactAdmin()">品牌管家</a>来注册和求购您心仪的域名
                            </p>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="route-pagination">
            <?php echo $this->pagination->create_links(); ?>
            <div class="total">共<font><?php echo $page_count; ?></font>条，每页显示<font><?php echo $page_size; ?></font>条</div>
            </div>
        </div>
    </div>
    
    <?php include_once(VIEWPATH.'waitui/templete/my_foot.php') ?>
    
    <script type="text/javascript">
    
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
    
    $(function(){
        
        scrollTop("ico_top");//返回顶部
        
    })
    </script>
    </body>
</html>
