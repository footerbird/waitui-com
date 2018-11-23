<?php if(isset($this->footer) && $this->footer == 'no'){}else{ ?>
<!--默认有底部-->
<div class="footer">
    <div class="footer-box">
        <div class="container pt20 pb20 after-cls">
            <dl>
                <dt>企业服务</dt>
                <dd><a href="/" target="_blank">企业名录</a></dd>
                <dd><a href="<?php echo base_url() ?>mark_list.html" target="_blank">商标服务</a></dd>
                <dd><a href="<?php echo base_url() ?>domain_list.html" target="_blank">域名服务</a></dd>
            </dl>
            <dl>
                <dt>帮助中心</dt>
                <dd><a href="<?php echo base_url() ?>agreement.html" target="_blank">用户协议</a></dd>
                <dd><a href="/" target="_blank">常见问题</a></dd>
                <dd><a href="/" target="_blank">寻求报道</a></dd>
            </dl>
            <dl>
                <dt>联系我们</dt>
                <dd><a href="/" target="_blank">杭州再下一城网络科技有限公司</a></dd>
                <dd><p>公司地址&nbsp;&nbsp;杭州拱墅区上塘路333号海外海写字楼11楼</p></dd>
                <dd><p>公司电话&nbsp;&nbsp;400-889-0135（09:00~18:00）</p></dd>
            </dl>
            
            <dl class="fl-r">
                <dt class="ta-r"><img class="bottom-logo" src="/htdocs/waitui/images/bottom-logo.png" /></dt>
                <dd class="ta-r"><p>QQ咨询：<a class="in-block" href="http://wpa.qq.com/msgrd?v=3&amp;uin=2165223868&amp;site=qq&amp;menu=yes" target="_blank">2165223868</a></p></dd>
                <dd class="ta-r"><p>加入我们：<a class="in-block w90" href="mailto:hr@waitui.com" target="_blank">hr@waitui.com</a></p></dd>
                <dd class="ta-r"><p>商务合作：<a class="in-block w90" href="mailto:bd@waitui.com" target="_blank">bd@waitui.com</a></p></dd>
            </dl>
            
            <div class="fl-r"></div>
            
        </div>
        
        <div class="friend-link">
            <div class="container">
                <ul>
                    <li><label>友情链接：</label></li>
                    <li><a href="https://www.marksmile.com/" target="_blank">名商网</a></li>
                    <li><a href="http://www.yumi.com/" target="_blank">玉米网</a></li>
                    <li><a href="http://www.shangbiao.com/" target="_blank">商标圈</a></li>
                </ul>
                <div class="copyright">
                    <span class="mr15">Copyright © 2018 外推网</span>
                    <span>浙ICP备14009787号-1</span>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php } ?>

<!--默认有侧边栏-->
<div id="to_topbar" class="to-topbar">
    <div class="ico-top" id="ico_top" style="display:none;"></div>
</div>

<?php if(!empty($redirect)){ ?>
<!--底部固定栏-->
<div id="redirect_bar" class="redirect-bar">
    <div class="container">【<font><?php echo $redirect; ?></font>】您正在访问的域名可以转让！<a class="pub-btn-blue fl-r" href="http://wpa.qq.com/msgrd?v=3&amp;uin=1003049243&amp;site=qq&amp;menu=yes" target="_blank">在线咨询</a><a class="close" href="javascript:;" onclick="removeRedirectBar();"></a></div>
</div>
<?php } ?>

<?php if(empty($userinfo)){ ?>
<!--用户登录弹框-->
<div id="upwin_login" class="upwin" style="height: 390px; display: none;">
    <div class="upwin-title">用户登录<a href="javascript:;" class="upwin-title-close" onclick="Pop.exit();"></a></div>
    <div class="upwin-content">
        <div class="upwin-form">
            <div class="login-tab">
                <a href="javascript:;" class="cur">密码登录</a>
                <a href="javascript:;">短信登录</a>
            </div>
            <div class="form-tip" id="upwin_login_error"></div>
            <ul>
                <li>
                    <div class="form-input-box">
                        <i class="ico ico-phone"></i>
                        <input type="tel" class="form-input" id="phone_num" placeholder="输入手机号" maxlength="11" required="required" />
                        <!--<a href="javascript:;" class="form-clear"></a>-->
                    </div>
                </li>
                <li id="code_num_box" style="display: none;">
                    <div class="form-input-box">
                        <div class="form-code-box">
                            <i class="ico ico-code"></i>
                            <input type="tel" class="form-input" id="code_num" placeholder="输入验证码" maxlength="6" required="required" />
                            <!--<a href="javascript:;" class="form-clear"></a>-->
                        </div>
                        <a href="javascript:;" class="form-input-link forbid" id="code_btn" onclick="sendCodeLogin(this,60,$('#phone_num').val(),'upwin_login_error')">获取验证码</a>
                    </div>
                </li>
                <li id="pwd_num_box">
                    <div class="form-input-box">
                        <i class="ico ico-pwd"></i>
                        <input type="password" class="form-input" id="pwd_num" placeholder="输入密码" required="required" />
                        <!--<a href="javascript:;" class="form-clear"></a>-->
                    </div>
                </li>
            </ul>
            <!--用户登录方式，sms_login短信登录，pwd_login密码登录-->
            <input type="hidden" id="login_type" value="pwd_login" />
            
            <div class="ta-r mb10 h15" style="margin-top: -15px;"><a href="javascript:;" class="upwin-link" id="upwin_tofindpwd">忘记密码?</a></div>
            <a href="javascript:;" id="login_btn" class="upwin-btn mb20 forbid">登录</a>
            <div class="login-bottom-text">没有账号？<a href="javascript:;" class="upwin-link" id="upwin_toregister">立即注册</a></div>
        </div>
    </div>
</div>

<!--用户注册弹框-->
<div id="upwin_register" class="upwin" style="height: 390px; display: none;">
    <div class="upwin-title">用户注册<a href="javascript:;" class="upwin-title-close" onclick="Pop.exit();"></a></div>
    <div class="upwin-content">
        <div class="upwin-form pt0">
            <div class="form-tip" id="upwin_register_error"></div>
            <ul>
                <li>
                    <div class="form-input-box">
                        <i class="ico ico-phone"></i>
                        <input type="tel" class="form-input" id="phone_reg" placeholder="输入手机号" maxlength="11" required="required" />
                        <!--<a href="javascript:;" class="form-clear"></a>-->
                    </div>
                </li>
                <li>
                    <div class="form-input-box">
                        <div class="form-code-box">
                            <i class="ico ico-code"></i>
                            <input type="tel" class="form-input" id="code_reg" placeholder="输入验证码" maxlength="6" required="required" />
                            <!--<a href="javascript:;" class="form-clear"></a>-->
                        </div>
                        <a href="javascript:;" class="form-input-link forbid" id="code_btn_reg" onclick="sendCodeRegister(this,60,$('#phone_reg').val(),'upwin_register_error')">获取验证码</a>
                    </div>
                </li>
                <li>
                    <div class="form-input-box">
                        <i class="ico ico-pwd"></i>
                        <input type="password" class="form-input" id="pwd_reg" placeholder="设置密码" required="required" />
                        <!--<a href="javascript:;" class="form-clear"></a>-->
                    </div>
                </li>
            </ul>
            
            <a href="javascript:;" id="register_btn" class="upwin-btn mb20 forbid">注册</a>
            <div class="login-bottom-text">已有账号&nbsp;&nbsp;<a href="javascript:;" class="upwin-link" id="upwin_tologin">直接登录</a></div>
        </div>
    </div>
</div>

<!--找回密码弹框-->
<div id="upwin_findpwd" class="upwin" style="height: 390px; display: none;">
    <div class="upwin-title">找回密码<a href="javascript:;" class="upwin-title-close" onclick="Pop.exit();"></a></div>
    <div class="upwin-content">
        <div class="upwin-form pt0">
            <div class="form-tip" id="upwin_findpwd_error"></div>
            <ul>
                <li>
                    <div class="form-input-box">
                        <i class="ico ico-phone"></i>
                        <input type="tel" class="form-input" id="phone_find" placeholder="输入手机号" maxlength="11" required="required" />
                        <!--<a href="javascript:;" class="form-clear"></a>-->
                    </div>
                </li>
                <li>
                    <div class="form-input-box">
                        <div class="form-code-box">
                            <i class="ico ico-code"></i>
                            <input type="tel" class="form-input" id="code_find" placeholder="输入验证码" maxlength="6" required="required" />
                            <!--<a href="javascript:;" class="form-clear"></a>-->
                        </div>
                        <a href="javascript:;" class="form-input-link forbid" id="code_btn_find" onclick="sendCodeFindpwd(this,60,$('#phone_find').val(),'upwin_findpwd_error')">获取验证码</a>
                    </div>
                </li>
                <li>
                    <div class="form-input-box">
                        <i class="ico ico-pwd"></i>
                        <input type="password" class="form-input" id="pwd_find" placeholder="重设密码" required="required" />
                        <!--<a href="javascript:;" class="form-clear"></a>-->
                    </div>
                </li>
            </ul>
            
            <a href="javascript:;" id="findpwd_btn" class="upwin-btn mb20 forbid">完成</a>
            
        </div>
    </div>
</div>

<?php } ?>

<script src="/htdocs/waitui/js/jquery-1.11.1.min.js?<?php echo CACHE_TIME; ?>"></script>
<?php if(isset($scripts)){ foreach($scripts as $script){ echo '<script src="'.$script.'"></script>';} }?>
<script src="http://pv.sohu.com/cityjson?ie=utf-8"></script> 
<script src="/htdocs/waitui/js/public.js?<?php echo CACHE_TIME; ?>"></script>
<script src="/htdocs/waitui/js/dom-ready.js?<?php echo CACHE_TIME; ?>"></script>
<script type="text/javascript">

function func_upwin_login(){
    $("#upwin_login").addClass("animated zoomIn");
    Pop.open("upwin_login");
}

function func_upwin_register(){
    $("#upwin_register").addClass("animated zoomIn");
    Pop.open("upwin_register");
}

function check_phoneRegister(phone,regCall,unregCall){
    $.ajax({
        type:"post",
        data:{
            phone:phone
        },
        url:"/waitui/Index_controller/check_phoneRegisterAjax",
        async:true,
        dataType:"json",
        success:function(data){
            if(data.state == "reg"){
                regCall();
            }else{
                unregCall();
            }
        }
    });
}

function sendCodeLogin(obj,seconds,phone,errorId){
    check_phoneRegister(phone,function(){
        //手机已注冊回调
        $("#"+errorId).text("");
        sendCode(obj,seconds,phone,errorId);
    },function(){
        //手机未注册回调
        $("#"+errorId).text("手机号未注册");
    })
}

function sendCodeRegister(obj,seconds,phone,errorId){
    check_phoneRegister(phone,function(){
        //手机已注冊回调
        $("#"+errorId).text("手机号已注册");
    },function(){
        //手机未注册回调
        $("#"+errorId).text("");
        sendCode(obj,seconds,phone,errorId);
    })
}

function sendCodeFindpwd(obj,seconds,phone,errorId){
    check_phoneRegister(phone,function(){
        //手机已注冊回调
        $("#"+errorId).text("");
        sendCode(obj,seconds,phone,errorId);
    },function(){
        //手机未注册回调
        $("#"+errorId).text("手机号未注册");
    })
}

function removeRedirectBar(){
    $("#redirect_bar").remove();
}

$(function(){
    
    $("#upwin_login .login-tab a").on("click",function(){
        var $this = $(this);
        if($this.hasClass("cur")) return;
        $("#upwin_login").removeClass("animated zoomIn").addClass("upwin-flip");
        setTimeout(function(){
          $this.addClass("cur").siblings().removeClass("cur");
          $this.parent().prepend($this);
          if($("#login_type").val() == "sms_login"){//如果当前是短信登录，则改为密码登录
              $("#login_type").val("pwd_login");
              $("#pwd_num_box").show();
              $("#code_num_box").hide();
              $("#upwin_tofindpwd").show();
          }else{//否则改为短信登录
              $("#login_type").val("sms_login");
              $("#code_num_box").show();
              $("#pwd_num_box").hide();
              $("#upwin_tofindpwd").hide();
          }
        },400)
        setTimeout(function(){
            $("#upwin_login").removeClass("upwin-flip");
        },810)
    })
    
    $("#upwin_tologin").on("click",function(){
        Pop.exit();
        func_upwin_login();
    })
    
    $("#upwin_toregister").on("click",function(){
        Pop.exit();
        func_upwin_register();
    })
    
    $("#upwin_tofindpwd").on("click",function(){
        Pop.exit();
        $("#upwin_findpwd").addClass("animated zoomIn");
        Pop.open("upwin_findpwd");
    })
    
    
    //登录框相关操作
    $("#phone_num,#pwd_num,#code_num").on("input",function(e){
        var target = e.target;
        if(target.id == "phone_num" && Valid.isMobile($("#phone_num").val()) && $("#code_btn").text() == "获取验证码"){
            $("#code_btn").removeClass("forbid");
        }
        
        if(target.id == "phone_num" && !Valid.isMobile($("#phone_num").val()) && $("#code_btn").text() == "获取验证码"){
            $("#code_btn").addClass("forbid");
        }
        
        if($("#login_type").val() == "sms_login"){//如果当前是短信登录
            if(Valid.isMobile($("#phone_num").val()) && Valid.isCode6($("#code_num").val())){
                $("#login_btn").removeClass("forbid");
            }else{
                $("#login_btn").addClass("forbid");
            }
        }else{
            if(Valid.isMobile($("#phone_num").val()) && $.trim($("#pwd_num").val()) != ""){
                $("#login_btn").removeClass("forbid");
            }else{
                $("#login_btn").addClass("forbid");
            }
        }
    })
    
    function func_login(){
        if($("#login_btn").hasClass("forbid")){
            return;
        }
        $("#login_btn").addClass("forbid");
        $.ajax({
            type:"post",
            url:"<?php echo base_url() ?>waitui/Index_controller/send_phoneLoginAjax",
            async:true,
            data:{
                login_type: $("#login_type").val(),
                phone_num: $("#phone_num").val(),
                pwd_num: $("#pwd_num").val(),
                code_num: $("#code_num").val(),
                ip_address: returnCitySN["cip"] || ''
            },
            dataType:"json",
            success:function(data){
                $("#login_btn").removeClass("forbid");
                if(data.state == 'success'){
                    $("#upwin_login .form-tip").html('');
                    Pop.msg(data.msg,function(){
                        location.reload();
                    })
                }else{
                    $("#upwin_login .form-tip").html(data.msg);
                }
            }
        });
    }
    $("#login_btn").on("click",function(){
        func_login();
    })
    $("#code_num,#pwd_num").on("keydown",function(e){
        if(e.keyCode == 13){
            func_login();
        }
    })
    
    
    //注册框相关操作
    $("#phone_reg,#pwd_reg,#code_reg").on("input",function(e){
        var target = e.target;
        if(target.id == "phone_reg" && Valid.isMobile($("#phone_reg").val()) && $("#code_btn_reg").text() == "获取验证码"){
            $("#code_btn_reg").removeClass("forbid");
        }
        
        if(target.id == "phone_reg" && !Valid.isMobile($("#phone_reg").val()) && $("#code_btn_reg").text() == "获取验证码"){
            $("#code_btn_reg").addClass("forbid");
        }
        
        if(Valid.isMobile($("#phone_reg").val()) && Valid.isCode6($("#code_reg").val()) && $.trim($("#pwd_reg").val()) != ""){
            $("#register_btn").removeClass("forbid");
        }else{
            $("#register_btn").addClass("forbid");
        }
    })
    
    function func_register(){
        if($("#register_btn").hasClass("forbid")){
            return;
        }
        $("#register_btn").addClass("forbid");
        $.ajax({
            type:"post",
            url:"<?php echo base_url() ?>waitui/Index_controller/send_phoneRegisterAjax",
            async:true,
            data:{
                phone_reg: $("#phone_reg").val(),
                pwd_reg: $("#pwd_reg").val(),
                code_reg: $("#code_reg").val(),
                ip_address: returnCitySN["cip"] || ''
            },
            dataType:"json",
            success:function(data){
                $("#register_btn").removeClass("forbid");
                if(data.state == 'success'){
                    $("#upwin_register .form-tip").html('');
                    Pop.msg(data.msg,function(){
                        location.reload();
                    })
                }else{
                    $("#upwin_register .form-tip").html(data.msg);
                }
            }
        });
    }
    $("#register_btn").on("click",function(){
        func_register();
    })
    $("#pwd_reg").on("keydown",function(e){
        if(e.keyCode == 13){
            func_register();
        }
    })
    
    
    //找回密码相关操作
    $("#phone_find,#pwd_find,#code_find").on("input",function(e){
        var target = e.target;
        if(target.id == "phone_find" && Valid.isMobile($("#phone_find").val()) && $("#code_btn_find").text() == "获取验证码"){
            $("#code_btn_find").removeClass("forbid");
        }
        
        if(target.id == "phone_find" && !Valid.isMobile($("#phone_find").val()) && $("#code_btn_find").text() == "获取验证码"){
            $("#code_btn_find").addClass("forbid");
        }
        
        if(Valid.isMobile($("#phone_find").val()) && Valid.isCode6($("#code_find").val()) && $.trim($("#pwd_find").val()) != ""){
            $("#findpwd_btn").removeClass("forbid");
        }else{
            $("#findpwd_btn").addClass("forbid");
        }
    })
    
    function func_findpwd(){
        if($("#findpwd_btn").hasClass("forbid")){
            return;
        }
        $("#findpwd_btn").addClass("forbid");
        $.ajax({
            type:"post",
            url:"<?php echo base_url() ?>waitui/Index_controller/send_phoneFindpwdAjax",
            async:true,
            data:{
                phone_find: $("#phone_find").val(),
                pwd_find: $("#pwd_find").val(),
                code_find: $("#code_find").val()
            },
            dataType:"json",
            success:function(data){
                $("#findpwd_btn").removeClass("forbid");
                if(data.state == 'success'){
                    $("#upwin_findpwd .form-tip").html('');
                    Pop.msg(data.msg,function(){
                        location.reload();
                    })
                }else{
                    $("#upwin_findpwd .form-tip").html(data.msg);
                }
            }
        });
    }
    $("#findpwd_btn").on("click",function(){
        func_findpwd();
    })
    $("#pwd_find").on("keydown",function(e){
        if(e.keyCode == 13){
            func_register();
        }
    })
    
    
    $(".top-bar .nav-account").on("mouseenter",function(){
        $(this).find(".dropdown-menu").show();
    }).on("mouseleave",function(){
        $(this).find(".dropdown-menu").hide();
    })
    
})
</script>