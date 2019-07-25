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
                    <a href="<?php echo base_url() ?>my_account">个人信息</a>
                    <a href="<?php echo base_url() ?>certify_list" class="cur">公司认证</a>
                </div>
            </div>
            
            <div class="my-table-filter after-cls">
                <div class="fl-r">
                    <a href="<?php echo base_url() ?>company_certify" class="pub-btn-green">添加认证</a>
                </div>
            </div>
            <table class="my-table" width="100%">
                <thead>
                    <tr>
                        <th align="left" width="32%" class="pl30">公司全称</th>
                        <th align="left" width="12%">法定代表人</th>
                        <th align="left" width="12%">公司电话</th>
                        <th align="left" width="20%">公司邮箱</th>
                        <th align="left" width="12%">认证状态</th>
                        <th align="right" width="12%" class="pr30"></th>
                    </tr>
                </thead>
                <tbody>
                <?php if(count($certify_list) != 0){ ?>
                    <?php foreach ($certify_list as $certify){ ?>
                    <tr>
                        <td class="f14 pl30"><?php echo $certify->company_name; ?></td>
                        <td><?php echo $certify->oper_name; ?></td>
                        <td><?php echo $certify->contact_phone; ?></td>
                        <td><?php echo $certify->contact_email; ?></td>
                        <td>
                            <?php 
                                if($certify->status == 'failed'){
                                    echo '<span class="col-warn">认证失败</span>';
                                }elseif($certify->status == 'wait'){
                                    echo '<span class="col-gray9">认证中</span>';
                                }else{
                                    echo '<span class="col-green">已认证</span>';
                                }
                             ?>
                        </td>
                        <td align="right" class="pr30">
                            <a href="<?php echo base_url() ?>company_certify?certify_id=<?php echo $certify->certify_id; ?>" class="ml10">查看</a>
                        </td>
                    </tr>
                    <?php } ?>
                <?php }else{ ?>
                    <tr>
                        <td colspan="6" class="pl30 pr30">
                            <p class="ta-c f18 col-my pt50 pb30">暂无认证企业</p>
                            <p class="ta-c"><img src="/htdocs/waitui/images/console-certify.png"></p>
                            <p class="ta-c f14 col-gray9 lh28 pt30">
                              您好，暂无搜索结果，<br>您可以联系您的专属<a href="javascript:;" class="ml10 mr10" onclick="contactAdmin()">品牌管家</a>来帮助您进行企业认证
                            </p>
                        </td>
                    </tr>
                <?php } ?>
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
