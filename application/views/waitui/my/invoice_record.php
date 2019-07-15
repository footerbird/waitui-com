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
            <div class="panel-title mb20">
                <div class="panel-title-tab">
                    <a href="<?php echo base_url() ?>my_invoice">发票管理</a>
                    <a href="<?php echo base_url() ?>invoice_record" class="cur">申请记录</a>
                </div>
            </div>
            <table class="my-table" width="100%">
                <thead>
                    <tr>
                        <th align="left" width="30%" class="pl30">发票抬头</th>
                        <th align="left" width="10%">发票金额</th>
                        <th align="left" width="15%">发票类型</th>
                        <th align="left" width="15%">申请时间</th>
                        <th align="left" width="30%" class="pr30">状态</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="pl30">杭州舟航网络科技有限公司</td>
                        <td>4500.00</td>
                        <td>增值税普通发票</td>
                        <td>2018-09-04 11:44:41</td>
                        <td class="pr30">
                            已寄出，顺丰快递（765846373471）
                        </td>
                    </tr>
                    <tr>
                        <td class="pl30">杭州舟航网络科技有限公司</td>
                        <td>3500.00</td>
                        <td>增值税普通发票</td>
                        <td>2018-08-04 11:44:41</td>
                        <td class="pr30">
                            已发送，电子发票
                        </td>
                    </tr>
                    <tr>
                        <td class="pl30">杭州舟航网络科技有限公司</td>
                        <td>2500.00</td>
                        <td>增值税普通发票</td>
                        <td>2018-07-04 11:44:41</td>
                        <td class="pr30">
                            申请失败(信息有误)
                        </td>
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
