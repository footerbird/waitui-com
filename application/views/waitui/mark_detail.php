<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once(VIEWPATH.'waitui/templete/pub_head.php') ?>
    <script type="text/javascript">
    function loadHtmlImg(obj){}
    </script>
    </head>
    
    <body>
    
    <?php include_once(VIEWPATH.'waitui/templete/menubar.php') ?>
    
    <div class="container pt30 pb30">
        <div class="mark-detail bg-white">
            <div class="after-cls">
                <div class="thumb-box"><img class="thumb" src="<?php echo $mark->image_path; ?>" /></div>
                <div class="info-box">
                    <h2 class="info-name"><?php echo $mark->mark_name; ?><span class="status">出售中</span></h2>
                    <div class="info-dl">
                        <dl class="mt10">
                            <dt>商标分类：</dt>
                            <dd>第<?php echo $mark->mark_category<10?'0'.$mark->mark_category:$mark->mark_category; ?>类&nbsp;&nbsp;<?php echo $mark->category_name; ?></dd>
                        </dl>
                        <dl class="mt10">
                            <dt>注册号：</dt>
                            <dd class="h20"><img src="<?php echo base_url().'captcha_regno_image/'.$mark->regno_encode; ?>"/></dd>
                        </dl>
                        <dl>
                            <dt>使用期限：</dt>
                            <dd><?php echo $mark->private_limit; ?></dd>
                        </dl>
                        <dl>
                            <dt>注册年限：</dt>
                            <dd><?php echo $mark->reg_year; ?></dd>
                        </dl>
                        <dl class="long">
                            <dt>商品服务：</dt>
                            <dd><?php echo $mark->app_range; ?></dd>
                        </dl>
                    </div>
                    <div class="info-bottom">
                        <span class="price">价格：<font>¥<?php echo $mark->mark_price; ?></font></span>
                        <a class="pub-btn-blue ml50" href="http://wpa.qq.com/msgrd?v=3&amp;uin=1003049243&amp;site=qq&amp;menu=yes" target="_blank">在线咨询</a>
                        <?php if(empty($userinfo)){ ?>
                        <a href="javascript:;" onclick="func_upwin_login()" class="pub-btn ml20">立即下单</a>
                        <?php }else{ ?>
                        <a href="javascript:;" class="pub-btn ml20">立即下单</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            
            <div class="detail-title mt30">商标详情信息</div>
            <div>
                <table class="info-table" width="100%">
                    <tr>
                        <td width="25%" class="title">初审公告期号：</td>
                        <td width="25%"><?php echo $mark->announce_issue; ?></td>
                        <td width="25%" class="title">初审公告日期：</td>
                        <td width="25%"><?php echo date('Y-m-d',strtotime($mark->announce_date)); ?></td>
                    </tr>
                    <tr>
                        <td width="25%" class="title">注册公告期号：</td>
                        <td width="25%"><?php echo $mark->reg_issue; ?></td>
                        <td width="25%" class="title">注册公告日期：</td>
                        <td width="25%"><?php echo date('Y-m-d',strtotime($mark->reg_date)); ?></td>
                    </tr>
                    <tr>
                        <td width="25%" class="title">专用权期限：</td>
                        <td colspan="3"><?php echo $mark->private_limit; ?></td>
                    </tr>
                    <tr>
                        <td width="25%" class="title">类似群：</td>
                        <td colspan="3"><?php echo $mark->mark_group; ?></td>
                    </tr>
                    <tr>
                        <td width="25%" class="title">商品/服务列表：</td>
                        <td colspan="3"><?php echo $mark->app_range; ?></td>
                    </tr>
                    <tr>
                        <td width="25%" class="title">商标状态：</td>
                        <td colspan="3">
                            <?php 
                                $mark_flow = $mark->mark_flow;
                                foreach ($mark_flow as $flow){
                                    echo $flow->flowDate."&nbsp;&nbsp;&nbsp;&nbsp;".$flow->flowName."<br/>";
                                }
                             ?>
                        </td>
                    </tr>
                </table>
            </div>
            
        </div>
    </div>
    
    <?php include_once(VIEWPATH.'waitui/templete/pub_foot.php') ?>
    
    <script type="text/javascript">
    $(function(){
        
        scrollTop("ico_top");//返回顶部
        
    })
    </script>
    </body>
</html>
