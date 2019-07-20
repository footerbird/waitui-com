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
                    <a href="<?php echo base_url() ?>my_account" class="cur">个人信息</a>
                    <a href="<?php echo base_url() ?>company_certify">公司认证</a>
                </div>
            </div>
            <div class="my-infomation mt40">
                <label class="info-figure">
                    <form enctype="multipart/form-data" style="display: none;">
                        <input type="file" name="file" accept="image/png,image/jpeg,image/gif" id="upload_figure">
                    </form>
                    <?php if(empty($userinfo->user_figure)){ ?>
                    <img class="figure" src="/htdocs/waitui/images/user-figure.png" />
                    <?php }else{ ?>
                    <img class="figure" src="<?php echo $userinfo->user_figure; ?>" />
                    <?php } ?>
                </label>
                <dl>
                    <dt>用户昵称</dt>
                    <dd>
                        <form action="<?php echo base_url() ?>waitui/Index_controller/edit_userNameAjax" method="post">
                            <span <?php if(empty($userinfo->user_name)){ echo 'class="noset"'; } ?>>
                                <?php if(empty($userinfo->user_name)){ echo '未设置'; }else{ echo $userinfo->user_name; } ?>
                            </span>
                            <input type="text" name="user_name" id="user_name" value="<?php echo $userinfo->user_name; ?>" style="display: none;" />
                            <a href="javascript:;" class="info-save" style="display: none;" >保存</a>
                            <a href="javascript:;" class="info-cancel" style="display: none;" >取消</a>
                            <a href="javascript:;" class="info-edit">修改</a>
                        </form>
                    </dd>
                </dl>
                <dl>
                    <dt>真实姓名</dt>
                    <dd>
                        <form action="<?php echo base_url() ?>waitui/Index_controller/edit_realNameAjax" method="post">
                            <span <?php if(empty($userinfo->real_name)){ echo 'class="noset"'; } ?>>
                                <?php if(empty($userinfo->real_name)){ echo '未设置'; }else{ echo $userinfo->real_name; } ?>
                            </span>
                            <input type="text" name="real_name" id="real_name" value="<?php echo $userinfo->real_name; ?>" style="display: none;" />
                            <a href="javascript:;" class="info-save" style="display: none;" >保存</a>
                            <a href="javascript:;" class="info-cancel" style="display: none;" >取消</a>
                            <a href="javascript:;" class="info-edit">修改</a>
                        </form>
                    </dd>
                </dl>
                <dl>
                    <dt>手机号码</dt>
                    <dd>
                        <form action="<?php echo base_url() ?>waitui/Index_controller/edit_userPhoneAjax" method="post">
                            <span <?php if(empty($userinfo->user_phone)){ echo 'class="noset"'; } ?>>
                                <?php if(empty($userinfo->user_phone)){ echo '未设置'; }else{ echo $userinfo->user_phone; } ?>
                            </span>
                            <input type="text" name="user_phone" id="user_phone" value="<?php echo $userinfo->user_phone; ?>" style="display: none;" />
                            <a href="javascript:;" class="info-save" style="display: none;" >保存</a>
                            <a href="javascript:;" class="info-cancel" style="display: none;" >取消</a>
                            <a href="javascript:;" class="info-edit">修改</a>
                        </form>
                    </dd>
                </dl>
                <dl>
                    <dt>QQ号码</dt>
                    <dd>
                        <form action="<?php echo base_url() ?>waitui/Index_controller/edit_userQQAjax" method="post">
                            <span <?php if(empty($userinfo->user_qq)){ echo 'class="noset"'; } ?>>
                                <?php if(empty($userinfo->user_qq)){ echo '未设置'; }else{ echo $userinfo->user_qq; } ?>
                            </span>
                            <input type="text" name="user_qq" id="user_qq" value="<?php echo $userinfo->user_qq; ?>" style="display: none;" />
                            <a href="javascript:;" class="info-save" style="display: none;" >保存</a>
                            <a href="javascript:;" class="info-cancel" style="display: none;" >取消</a>
                            <a href="javascript:;" class="info-edit">修改</a>
                        </form>
                    </dd>
                </dl>
                <dl>
                    <dt>电子邮箱</dt>
                    <dd>
                        <form action="<?php echo base_url() ?>waitui/Index_controller/edit_userEmailAjax" method="post">
                            <span <?php if(empty($userinfo->user_email)){ echo 'class="noset"'; } ?>>
                                <?php if(empty($userinfo->user_email)){ echo '未设置'; }else{ echo $userinfo->user_email; } ?>
                            </span>
                            <input type="text" name="user_email" id="user_email" value="<?php echo $userinfo->user_email; ?>" style="display: none;" />
                            <a href="javascript:;" class="info-save" style="display: none;" >保存</a>
                            <a href="javascript:;" class="info-cancel" style="display: none;" >取消</a>
                            <a href="javascript:;" class="info-edit">修改</a>
                        </form>
                    </dd>
                </dl>
                <dl>
                    <dt>微信号</dt>
                    <dd>
                        <form action="<?php echo base_url() ?>waitui/Index_controller/edit_userWechatAjax" method="post">
                            <span <?php if(empty($userinfo->user_wechat)){ echo 'class="noset"'; } ?>>
                                <?php if(empty($userinfo->user_wechat)){ echo '未设置'; }else{ echo $userinfo->user_wechat; } ?>
                            </span>
                            <input type="text" name="user_wechat" id="user_wechat" value="<?php echo $userinfo->user_wechat; ?>" style="display: none;" />
                            <a href="javascript:;" class="info-save" style="display: none;" >保存</a>
                            <a href="javascript:;" class="info-cancel" style="display: none;" >取消</a>
                            <a href="javascript:;" class="info-edit">修改</a>
                        </form>
                    </dd>
                </dl>
            </div>
            
        </div>
    </div>
    
    <?php include_once(VIEWPATH.'waitui/templete/my_foot.php') ?>
    
    <script type="text/javascript">
    $(function(){
        
        scrollTop("ico_top");//返回顶部
        
        $("#upload_figure").on("change",function(){
            var $this = $(this);
            var file_object = this.files[0];
            var reader = new FileReader();
            if (!window.FileReader || !file_object || !file_object.type.match('image.*')) {
                Pop.alert("上传图片类型错误！");
                return;
            }
            if (file_object.size > 10485760) {
                Pop.alert("图片大小应小于10M");
                return;
            }
            reader.readAsDataURL(file_object);
            reader.onload = function (e) {
                var result = this.result;
                var $form = $this.parent();
                $form.ajaxForm({
                    url:'/waitui/Index_controller/upload_userFigureTemp',
                    type:'post',
                    beforeSubmit:function () {
                    },
                    success: function (res) {
                        var result = eval('('+res+')');
                        if(result.state == 'success'){
                            $.ajax({
                                type:"post",
                                url:"<?php echo base_url() ?>waitui/Index_controller/upload_userFigureAjax",
                                async:true,
                                data:{
                                    figure_path: result.url
                                },
                                dataType:"json",
                                success:function(data){
                                    if(data.state == 'success'){
                                        $form.siblings(".figure").attr("src",data.figure);
                                        location.reload();
                                    }else{
                                        Pop.alert(data.msg);
                                    }
                                }
                            });
                        }else{
                            Pop.alert('程序错误，请重试');
                        }
                    },
                    error:function(XmlHttpRequest,textStatus,errorThrown){
                        Pop.alert('程序错误，请重试');
                    }
                }).submit();
            }
        })
        
        $(".info-edit").on("click",function(){
            var $form = $(this).parent("form");
            $form.find("span").hide();
            $form.find("input[type=text]").show();
            $form.find(".info-edit").hide();
            $form.find(".info-save").show();
            $form.find(".info-cancel").show();
        })
        
        $(".info-cancel").on("click",function(){
            var $form = $(this).parent("form");
            $form.find("span").show();
            $form.find("input[type=text]").hide();
            $form.find(".info-edit").show();
            $form.find(".info-save").hide();
            $form.find(".info-cancel").hide();
        })
        
        $(".info-save").on("click",function(){
            var $form = $(this).parent("form");
            $form.ajaxForm({
                dataType:'json',
                beforeSubmit:function () {
                },
                success:function (data) {
                    if(data.state == "success"){
                        location.reload();
                    }else{
                        Pop.alert(data.msg);
                    }
                },
                error:function(jqXHR, textStatus, errorThrown){
                    Pop.alert("程序异常："+errorThrown+"<br>请联系管理员");
                }
            }).submit();
        })
        
    })
    </script>
    </body>
</html>
