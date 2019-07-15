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
                    <form action="<?php echo base_url() ?>Upload_controller" method="post" enctype="multipart/form-data" style="display: none;">
                        <input type="file" name="file" accept="image/png,image/jpeg,image/gif" id="upload_figure">
                    </form>
                    <?php if(empty($userinfo->user_figure) || !@file_get_contents($userinfo->user_figure)){ ?>
                    <img class="figure" src="/htdocs/waitui/images/user-figure.png" />
                    <?php }else{ ?>
                    <img class="figure" src="<?php echo $userinfo->user_figure; ?>" />
                    <?php } ?>
                </label>
                <dl>
                    <dt>用户昵称</dt>
                    <dd>
                        <form action="" method="post">
                            <span class="noset">未设置</span>
                            <input type="text" name="nickname" id="nickname" style="display: none;" />
                            <a href="javascript:;" class="info-save" style="display: none;" >保存</a>
                            <a href="javascript:;" class="info-cancel" style="display: none;" >取消</a>
                            <a href="javascript:;" class="info-edit">修改</a>
                        </form>
                    </dd>
                </dl>
                <dl>
                    <dt>真实姓名</dt>
                    <dd>
                        <form action="" method="post">
                            <span class="noset">未设置</span>
                            <input type="text" name="realname" id="realname" style="display: none;" />
                            <a href="javascript:;" class="info-save" style="display: none;" >保存</a>
                            <a href="javascript:;" class="info-cancel" style="display: none;" >取消</a>
                            <a href="javascript:;" class="info-edit">修改</a>
                        </form>
                    </dd>
                </dl>
                <dl>
                    <dt>手机号码</dt>
                    <dd>
                        <form action="" method="post">
                            <span>18767120068</span>
                            <input type="text" name="user_phone" id="user_phone" style="display: none;" value="18767120068" />
                            <a href="javascript:;" class="info-save" style="display: none;" >保存</a>
                            <a href="javascript:;" class="info-cancel" style="display: none;" >取消</a>
                            <a href="javascript:;" class="info-edit">修改</a>
                        </form>
                    </dd>
                </dl>
                <dl>
                    <dt>QQ号</dt>
                    <dd>
                        <form action="" method="post">
                            <span class="noset">未设置</span>
                            <input type="text" name="user_qq" id="user_qq" style="display: none;" />
                            <a href="javascript:;" class="info-save" style="display: none;" >保存</a>
                            <a href="javascript:;" class="info-cancel" style="display: none;" >取消</a>
                            <a href="javascript:;" class="info-edit">修改</a>
                        </form>
                    </dd>
                </dl>
                <dl>
                    <dt>电子邮箱</dt>
                    <dd>
                        <form action="" method="post">
                            <span class="noset">未设置</span>
                            <input type="text" name="user_email" id="user_email" style="display: none;" />
                            <a href="javascript:;" class="info-save" style="display: none;" >保存</a>
                            <a href="javascript:;" class="info-cancel" style="display: none;" >取消</a>
                            <a href="javascript:;" class="info-edit">修改</a>
                        </form>
                    </dd>
                </dl>
                <dl>
                    <dt>微信号</dt>
                    <dd>
                        <form action="" method="post">
                            <span class="noset">未设置</span>
                            <input type="text" name="user_wechat" id="user_wechat" style="display: none;" />
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
                $this.parent().siblings(".figure").attr("src",result);//FileReader预览图片
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
            $form.submit();
        })
        
    })
    </script>
    </body>
</html>
