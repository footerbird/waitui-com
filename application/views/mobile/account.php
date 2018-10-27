<!DOCTYPE html>
<html>

    <head>
    <?php include_once('templete/pub_head.php') ?>
    </head>

    <body>
    <div class="header"></div>
    <div class="container" style="padding-bottom: 50px;">
        
        <div class="account-header">
            <a href="javascript:;" class="account-header-sign <?php if($is_signed == 1){ echo 'signed'; } ?>"><?php if($is_signed == 1){ echo '挖矿中'; }else{ echo '挖矿'; } ?></a>
            <div class="account-header-info">
                <a href="<?php echo base_url() ?>m/userinfo.html" target="_parent" class="account-header-figure">
                    <?php if(empty($userinfo->user_figure)){ ?>
                    <img src="<?php echo CDN_URL; ?>logo.png" />
                    <?php }else{ ?>
                    <img src="<?php echo $userinfo->user_figure; ?>" />
                    <?php } ?>
                </a>
                <div class="account-header-name">
                    <h4><a href="<?php echo base_url() ?>m/userinfo.html" target="_parent"><?php echo $userinfo->user_name; ?></a></h4>
                    <p><a href="<?php echo base_url() ?>m/userinfo.html" target="_parent">点击查看或编辑个人信息</a></p>
                </div>
            </div>
            <div class="account-header-tab">
                <a href="javascript:;">
                    <h4><?php echo $userinfo->user_balance; ?></h4>
                    <p>钱包</p>
                </a>
                <a href="javascript:;">
                    <h4><?php echo $msg_count; ?></h4>
                    <p>消息</p>
                </a>
                <a href="javascript:;">
                    <h4 id="user_score"><?php echo $userinfo->user_score; ?></h4>
                    <p>W币</p>
                </a>
            </div>
        </div>
        
        <div class="weui-cells" style="margin-top: 15px;">
            <a class="weui-cell weui-cell_access" href="javascript:;">
                <div class="weui-cell__bd">
                    <p>任务</p>
                </div>
                <div class="weui-cell__ft">10</div>
            </a>
            <a class="weui-cell weui-cell_access" href="javascript:;">
                <div class="weui-cell__bd">
                    <p>商城</p>
                </div>
                <div class="weui-cell__ft">即将开放</div>
            </a>
        </div>
        
        <div class="weui-cells" style="margin-top: 15px;">
            <a class="weui-cell weui-cell_access" href="<?php echo base_url() ?>m/about.html" target="_parent">
                <div class="weui-cell__bd">
                    <p>关于我们</p>
                </div>
                <div class="weui-cell__ft"></div>
            </a>
            <a class="weui-cell weui-cell_access" href="<?php echo base_url() ?>m/agreement.html" target="_parent">
                <div class="weui-cell__bd">
                    <p>用户协议</p>
                </div>
                <div class="weui-cell__ft"></div>
            </a>
        </div>
        
        <div class="weui-cells" style="margin-top: 15px;">
            <a class="weui-cell weui-cell_access" href="<?php echo base_url() ?>m/login_out">
                <div class="weui-cell__bd">
                    <p style="text-align: center; color: #f9907e;">退出登录</p>
                </div>
            </a>
        </div>
        
    </div>
    <?php include_once('templete/tabbar.php') ?>
    
    <?php include_once('templete/pub_foot.php') ?>
    <script>
    window.onload = function(){
        
    }
    
    $(function(){
        $(".account-header-sign").on("click",function(){
            var $this = $(this);
            if($this.hasClass("signed")){
                return;
            }
            
            $.ajax({
                type:"post",
                url:"<?php echo base_url() ?>mobile/Index_controller/get_signScoreAjax",
                async:true,
                dataType:"json",
                success:function(data){
                    if(data.state == 'success'){
                        $this.addClass("signed").text("挖矿中");
                    }else{
                        $.alert(data.msg);
                    }
                }
            });
            
        })
    })
    
    </script>
    </body>
</html>