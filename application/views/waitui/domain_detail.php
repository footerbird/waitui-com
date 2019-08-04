<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once(VIEWPATH.'waitui/templete/pub_head.php') ?>
    </head>
    
    <body>
    
    <?php include_once(VIEWPATH.'waitui/templete/menubar.php') ?>
    
    <div class="container pt30 pb30">
        <div class="domain-detail bg-white">
            <div class="after-cls">
                <div class="domain-left">
                    <div class="info-box">
                        <h2 class="info-name"><?php echo $domain->domain_name; ?><span class="status">出售中</span></h2>
                        <div class="info-dl">
                            <dl class="mt10">
                                <dt>域名分类：</dt>
                                <dd><?php echo $domain->domain_type; ?></dd>
                            </dl>
                            <dl class="mt10">
                                <dt>注册商：</dt>
                                <dd><?php echo $domain->register_registrar; ?></dd>
                            </dl>
                            <dl>
                                <dt>注册日期：</dt>
                                <dd><?php echo date('Y-m-d',strtotime($domain->created_date)); ?></dd>
                            </dl>
                            <dl>
                                <dt>过期日期：</dt>
                                <dd><?php echo date('Y-m-d',strtotime($domain->expired_date)); ?><font class="distance">(距到期：<?php echo $domain->expired_distance; ?>天)</font></dd>
                            </dl>
                            <dl class="long">
                                <dt>域名简介：</dt>
                                <dd><?php echo $domain->domain_summary; ?></dd>
                            </dl>
                        </div>
                        <div class="info-bottom">
                            <span class="price">价格：<font>¥<?php echo number_format(1.2*$domain->domain_price); ?></font></span>
                            <a class="pub-btn-blue ml50" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo constant('SERVICE_QQ'); ?>&amp;site=qq&amp;menu=yes" target="_blank">在线咨询</a>
                            <?php if(empty($userinfo)){ ?>
                            <a href="javascript:;" onclick="func_upwin_login()" class="pub-btn ml20">立即下单</a>
                            <?php }else{ ?>
                            <a href="javascript:;" class="pub-btn ml20">立即下单</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="domain-right">
                    <div class="recommend pl20 pr20" style="border-top: none;">
                        <h4 class="title">猜你喜欢</h4>
                        <?php foreach ($domain_recommend as $recommend){ ?>
                        <a href="<?php echo base_url() ?>domain_detail/<?php echo $recommend->domain_name; ?>" target="_blank" class="recommend-item">
                            <span class="name"><?php echo $recommend->domain_name; ?></span>
                            <span class="price"><?php echo $recommend->domain_price; ?>元</span>
                            <p class="intro"><?php echo $recommend->domain_summary; ?></p>
                        </a>
                        <?php } ?>
                    </div>
                </div>
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
