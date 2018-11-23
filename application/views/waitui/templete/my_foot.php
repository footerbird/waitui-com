<?php if(isset($this->footer) && $this->footer == 'no'){}else{ ?>
<!--默认有底部-->
<div class="footer my-footer">
    <div class="footer-box">
        
        <div class="friend-link">
            <div class="container">
                <ul>
                    <li><a href="/" target="_blank">关于我们</a></li>
                    <li><a href="<?php echo base_url() ?>agreement.html" target="_blank">用户协议</a></li>
                    <li><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=2165223868&amp;site=qq&amp;menu=yes" target="_blank">联系我们</a></li>
                </ul>
            </div>
        </div>
        
        <div class="friend-link">
            <div class="container" style="border-top: 1px solid #e6e8eb;">
                <div class="copyright">
                    <span class="mr15">Copyright © 2018 waitui.com All Rights Reserved.</span>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php } ?>

<!--默认有侧边栏-->
<div id="to_topbar" class="to-topbar my-to-topbar">
    <div class="ico-top" id="ico_top" style="display:none;"></div>
</div>

<script src="/htdocs/waitui/js/jquery-1.11.1.min.js?<?php echo CACHE_TIME; ?>"></script>
<?php if(isset($scripts)){ foreach($scripts as $script){ echo '<script src="'.$script.'"></script>';} }?>
<script src="/htdocs/waitui/js/public.js?<?php echo CACHE_TIME; ?>"></script>
<script src="/htdocs/waitui/js/dom-ready.js?<?php echo CACHE_TIME; ?>"></script>
<script type="text/javascript">

$(function(){
    
    $(".top-bar .nav-account").on("mouseenter",function(){
        $(this).find(".dropdown-menu").show();
    }).on("mouseleave",function(){
        $(this).find(".dropdown-menu").hide();
    })
    
    $(".my-mainpanel[data-screenh]").css({
        "min-height" : ($(window).height()-210) + "px"
    })
    
})
</script>