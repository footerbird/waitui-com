<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once('templete/pub_head.php') ?>
    </head>
    
    <body>
    
    <?php include_once('templete/menubar.php') ?>
    
    <div class="home-banner home-banner<?php echo rand(0,9) ?>">
        <div class="fly-box"><i class="fly"></i></div>
        <div class="fade-in-up">
            <h1>您的一站式品牌管家</h1>
            <h4 style="text-indent: -5px;">广告直投，精准抵达目标用户；品牌资讯，增加企业品牌曝光；品牌管理，提升企业品牌价值</h4>
            <?php if(empty($userinfo)){ ?>
            <a href="javascript:;" onclick="func_upwin_login()" class="to-experience">立即体验</a>
            <?php }else{ ?>
            <a href="<?php echo base_url() ?>my/account" class="to-experience">立即体验</a>
            <?php } ?>
        </div>
    </div>
    
    <!--精准的客户定位-->
    <div class="home-topic home-topic-target">
        <div class="container">
            <div class="intro-box fl-l">
                <h2>精准的定向能力<br>瞄准活跃客户</h2>
                <p>我们根据用户的地理位置、使用设备、活跃时间以及用户的操作习惯为您描绘出精确的用户画像，帮助您选择合适的品牌营销群体</p>
                <?php if(empty($userinfo)){ ?>
                <a href="javascript:;" onclick="func_upwin_login()" >立即体验>></a>
                <?php }else{ ?>
                <a href="<?php echo base_url() ?>my/account" >立即体验>></a>
                <?php } ?>
            </div>
            <div class="image-box fl-r">
                <img src="/htdocs/waitui/images/home-topic-target.png" />
            </div>
        </div>
    </div>
    
    <!--多样的营销方式-->
    <div class="home-topic home-topic-types">
        <div class="container">
            <div class="image-box fl-l">
                <img src="/htdocs/waitui/images/home-topic-types.png" />
                <ul>
                    <li style="margin-top: 60px;"><i class="kaipin"></i><span>开屏广告</span></li>
                    <li style="margin-top: 15px;"><i class="fanye"></i><span>翻页广告</span></li>
                    <li style="margin-top: 0;"><i class="baodao"></i><span>品牌报道</span></li>
                    <li style="margin-top: 15px;"><i class="faxian"></i><span>发现频道</span></li>
                    <li style="margin-top: 60px;"><i class="pintuan"></i><span>品牌拼团</span></li>
                </ul>
            </div>
            <div class="intro-box fl-r">
                <h2 class="col-white">多样的营销方式<br>提升用户体验</h2>
                <p class="col-white">我们提供首页开屏广告、翻页刷屏广告、品牌品牌报道、品牌活动发现频道以及品牌助力拼团等多种营销方式，帮助企业将信息推送给真正有兴趣的用户</p>
                <?php if(empty($userinfo)){ ?>
                <a href="javascript:;" onclick="func_upwin_login()" >立即体验>></a>
                <?php }else{ ?>
                <a href="<?php echo base_url() ?>my/account" >立即体验>></a>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <!--专业的品牌管理-->
    <div class="home-topic home-topic-manage">
        <div class="container after-cls">
            <div class="intro-box fl-l">
                <h2>专业的品牌管理<br>提高市场竞争力</h2>
                <p>我们拥有来自域名、商标、知识产权等行业的专业品牌保护团队，可以解决在品牌建设中会遇到的各种各样的问题，从而帮助企业树立良好的企业形象、打造品牌优势、发展品牌战略。</p>
                <?php if(empty($userinfo)){ ?>
                <a href="javascript:;" onclick="func_upwin_login()" >立即体验>></a>
                <?php }else{ ?>
                <a href="<?php echo base_url() ?>my/account" >立即体验>></a>
                <?php } ?>
            </div>
            <div class="image-box fl-r">
                <img src="/htdocs/waitui/images/home-topic-manage.png" />
            </div>
        </div>
    </div>
    
    <?php include_once('templete/pub_foot.php') ?>
    
    <script type="text/javascript">
    $(function(){
        $(window).on("scroll",function(){
            if($(window).scrollTop()>50){
                $(".top-bar").removeClass("top-bar-home").addClass("top-bar-fixed");
            }else{
                $(".top-bar").removeClass("top-bar-fixed").addClass("top-bar-home");
            }
        })
    })
    </script>
    </body>
</html>
