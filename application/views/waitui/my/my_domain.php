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
            <div class="my-table-filter after-cls">
                <input type="text" placeholder="输入域名" class="fl-l mr10" />
                <a href="javascript:;" class="pub-btn fl-l mr10">搜索</a>
                <a href="<?php echo base_url() ?>domain_list.html" target="_blank" class="pub-btn-yellow fl-l"><i class="ico-shop"></i>淘域名</a>
                <div class="fl-r">
                    <a href="javascript:;" class="pub-btn-blue mr10" onclick="contactAdmin()">求购域名</a>
                    <a href="javascript:;" class="pub-btn-green" onclick="contactAdmin()">注册域名</a>
                </div>
            </div>
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
                    <tr>
                        <td class="f14 pl30">hzwt.com.cn</td>
                        <td>2019-04-11</td>
                        <td>2022-04-11</td>
                        <td>正常</td>
                        <td>杭州外推网络科技有限公司</td>
                        <td align="right" class="pr30">
                            <a href="javascript:;" class="ml10">续费</a>
                            <a href="javascript:;" class="ml10" onclick="contactAdmin()">解析</a>
                            <a href="javascript:;" class="ml10" onclick="contactAdmin()">转出</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="f14 pl30">wtwl.com.cn</td>
                        <td>2018-04-31</td>
                        <td>2019-06-31</td>
                        <td>即将过期</td>
                        <td>杭州外推网络科技有限公司</td>
                        <td align="right" class="pr30">
                            <a href="javascript:;" class="ml10">续费</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="f14 col-gray9 pl30">wtwl.com.cn<span class="f13">（已过期）</span></td>
                        <td colspan="5" align="right" class="pr30">
                            <a href="javascript:;" class="ml10" onclick="contactAdmin()">购买</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="f14 col-gray9 pl30">wtwl.com.cn<span class="f13">（已转出）</span></td>
                        <td colspan="5" align="right" class="pr30"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <?php include_once(VIEWPATH.'waitui/templete/my_foot.php') ?>
    
    <script type="text/javascript">
    $(function(){
        
        scrollTop("ico_top");//返回顶部
        
    })
    </script>
    </body>
</html>
