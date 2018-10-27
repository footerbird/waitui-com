<?php if(empty($userinfo)){ ?>
<!--用户登录弹出框-->
<div id="pop_login" class="weui-popup__container">
    <div class="weui-popup__overlay"></div>
    <div class="weui-popup__modal weui-popup__modal-cart">
        <div class="toolbar">
            <div class="toolbar-inner">
                <h1 class="title">密码登录</h1>
            </div>
        </div>
        <div class="modal-content">
            <div class="login-form">
                <ul>
                    <li>
                        <div class="login-input-box">
                            <input type="tel" class="login-input" id="phone_num" placeholder="输入手机号" maxlength="11" required="required" />
                            <a href="javascript:;" class="weui-icon-clear"></a>
                        </div>
                    </li>
                    <li id="code_num_box" style="display: none;">
                        <div class="login-input-box">
                            <input type="tel" class="login-input" id="code_num" placeholder="输入验证码" maxlength="6" required="required" />
                            <a href="javascript:;" class="weui-icon-clear"></a>
                        </div>
                        <a href="javascript:;" class="login-input-link forbid" id="code_btn" onclick="sendCodeLogin(this,60,$('#phone_num').val())">获取验证码</a>
                    </li>
                    <li id="pwd_num_box">
                        <div class="login-input-box">
                            <input type="password" class="login-input" id="pwd_num" placeholder="输入密码" required="required" />
                            <a href="javascript:;" class="weui-icon-clear"></a>
                        </div>
                    </li>
                </ul>
                <!--用户登录方式，sms_login短信登录，pwd_login密码登录-->
                <input type="hidden" id="login_type" value="pwd_login" />
                
                <div style="position: relative;">
                    <a href="javascript:;" class="login-forget-pwd" id="to_findpwd" onclick='$("#pop_findpwd").popup();'>忘记密码？</a>
                    <a href="javascript:;" id="login_btn" class="weui-btn weui-btn_disabled weui-btn_login">登录</a>
                </div>
                <div class="login-link-box">
                    <a href="javascript:;" class="login-link" id="to_login_type">短信登录</a>
                    <a href="javascript:;" class="login-link" id="to_register" onclick='$("#pop_register").popup();'>注册</a>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="javascript:;" class="weui-btn weui-btn_white close-popup">取消</a>
        </div>
    </div>
</div>

<!--用户注册弹出框-->
<div id="pop_register" class="weui-popup__container">
    <div class="weui-popup__overlay"></div>
    <div class="weui-popup__modal weui-popup__modal-cart">
        <div class="toolbar">
            <div class="toolbar-inner">
                <h1 class="title">新用户注册</h1>
            </div>
        </div>
        <div class="modal-content">
            <div class="login-form">
                <ul>
                    <li>
                        <div class="login-input-box">
                            <input type="tel" class="login-input" id="phone_reg" placeholder="输入手机号" maxlength="11" required="required" />
                            <a href="javascript:;" class="weui-icon-clear"></a>
                        </div>
                    </li>
                    <li>
                        <div class="login-input-box">
                            <input type="tel" class="login-input" id="code_reg" placeholder="输入验证码" maxlength="6" required="required" />
                            <a href="javascript:;" class="weui-icon-clear"></a>
                        </div>
                        <a href="javascript:;" class="login-input-link forbid" id="code_btn_reg" onclick="sendCodeRegister(this,60,$('#phone_reg').val())">获取验证码</a>
                    </li>
                    <li>
                        <div class="login-input-box">
                            <input type="password" class="login-input" id="pwd_reg" placeholder="设置密码" required="required" />
                            <a href="javascript:;" class="weui-icon-clear"></a>
                        </div>
                    </li>
                </ul>
                
                <a href="javascript:;" id="register_btn" class="weui-btn weui-btn_disabled weui-btn_login">注册</a>
            </div>
        </div>
        <div class="modal-footer">
            <a href="javascript:;" class="weui-btn weui-btn_white close-popup">取消</a>
        </div>
    </div>
</div>

<!--找回密码弹出框-->
<div id="pop_findpwd" class="weui-popup__container">
    <div class="weui-popup__overlay"></div>
    <div class="weui-popup__modal weui-popup__modal-cart">
        <div class="toolbar">
            <div class="toolbar-inner">
                <h1 class="title">找回密码</h1>
            </div>
        </div>
        <div class="modal-content">
            <div class="login-form">
                <ul>
                    <li>
                        <div class="login-input-box">
                            <input type="tel" class="login-input" id="phone_find" placeholder="输入手机号" maxlength="11" required="required" />
                            <a href="javascript:;" class="weui-icon-clear"></a>
                        </div>
                    </li>
                    <li>
                        <div class="login-input-box">
                            <input type="tel" class="login-input" id="code_find" placeholder="输入验证码" maxlength="6" required="required" />
                            <a href="javascript:;" class="weui-icon-clear"></a>
                        </div>
                        <a href="javascript:;" class="login-input-link forbid" id="code_btn_find" onclick="sendCodeFindpwd(this,60,$('#phone_find').val())">获取验证码</a>
                    </li>
                    <li>
                        <div class="login-input-box">
                            <input type="password" class="login-input" id="pwd_find" placeholder="重设密码" required="required" />
                            <a href="javascript:;" class="weui-icon-clear"></a>
                        </div>
                    </li>
                </ul>
                
                <a href="javascript:;" id="findpwd_btn" class="weui-btn weui-btn_disabled weui-btn_login">完成</a>
            </div>
        </div>
        <div class="modal-footer">
            <a href="javascript:;" class="weui-btn weui-btn_white close-popup">取消</a>
        </div>
    </div>
</div>

<?php } ?>

<script src="/htdocs/mobile/dist/js/jquery-2.1.4.js?<?php echo CACHE_TIME; ?>"></script>
<script src="/htdocs/mobile/dist/js/fastclick.js?<?php echo CACHE_TIME; ?>"></script>
<script type="text/javascript">
$(function(){
    FastClick.attach(document.body);
})
</script>
<script src="/htdocs/mobile/dist/js/jquery-weui.min.js?<?php echo CACHE_TIME; ?>"></script>
<script src="/htdocs/mobile/dist/js/rem.js?<?php echo CACHE_TIME; ?>"></script>
<?php if(isset($scripts)){ foreach($scripts as $script){ echo '<script src="'.$script.'"></script>';} }?>
<script src="http://pv.sohu.com/cityjson?ie=utf-8"></script> 
<script src="/htdocs/mobile/js/public.js?<?php echo CACHE_TIME; ?>"></script>
<script src="/htdocs/mobile/js/dom-ready.js?<?php echo CACHE_TIME; ?>"></script>
<script type="text/javascript">

function check_phoneRegister(phone,regCall,unregCall){
    $.ajax({
        type:"post",
        data:{
            phone:phone
        },
        url:"/mobile/Index_controller/check_phoneRegisterAjax",
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

function sendCodeLogin(obj,seconds,phone){
    check_phoneRegister(phone,function(){
        //手机已注冊回调
        sendCode(obj,seconds,phone);
    },function(){
        //手机未注册回调
        $.alert("手机号未注册");
    })
}

function sendCodeRegister(obj,seconds,phone){
    check_phoneRegister(phone,function(){
        //手机已注冊回调
        $.alert("手机号已注册");
    },function(){
        //手机未注册回调
        sendCode(obj,seconds,phone);
    })
}

function sendCodeFindpwd(obj,seconds,phone){
    check_phoneRegister(phone,function(){
        //手机已注冊回调
        sendCode(obj,seconds,phone);
    },function(){
        //手机未注册回调
        $.alert("手机号未注册");
    })
}

$(function(){
    
    //切换登录方式
    $("#to_login_type").on("click",function(){
        if($("#login_type").val() == "sms_login"){//如果当前是短信登录，则改为密码登录
            $(this).text("短信登录");
            $("#login_type").val("pwd_login");
            $("#pop_login .toolbar-inner .title").text("密码登录");
            $("#pwd_num_box").show();
            $("#code_num_box").hide();
            $("#forget_pwd").show();
        }else{//否则改为短信登录
            $(this).text("密码登录");
            $("#login_type").val("sms_login");
            $("#pop_login .toolbar-inner .title").text("短信登录");
            $("#code_num_box").show();
            $("#pwd_num_box").hide();
            $("#forget_pwd").hide();
        }
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
                $("#login_btn").removeClass("weui-btn_disabled");
            }else{
                $("#login_btn").addClass("weui-btn_disabled");
            }
        }else{
            if(Valid.isMobile($("#phone_num").val()) && $.trim($("#pwd_num").val()) != ""){
                $("#login_btn").removeClass("weui-btn_disabled");
            }else{
                $("#login_btn").addClass("weui-btn_disabled");
            }
        }
    })
    
    function func_login(){
        if($("#login_btn").hasClass("weui-btn_disabled")){
            return;
        }
        $("#login_btn").addClass("weui-btn_disabled");
        $.ajax({
            type:"post",
            url:"<?php echo base_url() ?>mobile/Index_controller/send_phoneLoginAjax",
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
                $("#login_btn").removeClass("weui-btn_disabled");
                if(data.state == 'success'){
                    $.toast(data.msg, function() {
                        location.reload();
                    });
                }else{
                    $.alert(data.msg);
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
            $("#register_btn").removeClass("weui-btn_disabled");
        }else{
            $("#register_btn").addClass("weui-btn_disabled");
        }
    })
    
    function func_register(){
        if($("#register_btn").hasClass("weui-btn_disabled")){
            return;
        }
        $("#register_btn").addClass("weui-btn_disabled");
        $.ajax({
            type:"post",
            url:"<?php echo base_url() ?>mobile/Index_controller/send_phoneRegisterAjax",
            async:true,
            data:{
                phone_reg: $("#phone_reg").val(),
                pwd_reg: $("#pwd_reg").val(),
                code_reg: $("#code_reg").val(),
                ip_address: returnCitySN["cip"] || ''
            },
            dataType:"json",
            success:function(data){
                $("#register_btn").removeClass("weui-btn_disabled");
                if(data.state == 'success'){
                    $.toast(data.msg, function() {
                        location.reload();
                    });
                }else{
                    $.alert(data.msg);
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
            $("#findpwd_btn").removeClass("weui-btn_disabled");
        }else{
            $("#findpwd_btn").addClass("weui-btn_disabled");
        }
    })
    
    function func_findpwd(){
        if($("#findpwd_btn").hasClass("weui-btn_disabled")){
            return;
        }
        $("#findpwd_btn").addClass("weui-btn_disabled");
        $.ajax({
            type:"post",
            url:"<?php echo base_url() ?>mobile/Index_controller/send_phoneFindpwdAjax",
            async:true,
            data:{
                phone_find: $("#phone_find").val(),
                pwd_find: $("#pwd_find").val(),
                code_find: $("#code_find").val()
            },
            dataType:"json",
            success:function(data){
                $("#findpwd_btn").removeClass("weui-btn_disabled");
                if(data.state == 'success'){
                    $.toast(data.msg, function() {
                        location.reload();
                    });
                }else{
                    $.alert(data.msg);
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
    
})
</script>
