<!DOCTYPE html>
<html>

    <head>
    <?php include_once('templete/pub_head.php') ?>
    </head>

    <body>
    <div class="header"></div>
    <div class="container">
        
        <div class="weui-cells" style="margin-top: 15px;">
            <label class="weui-cell weui-cell_access">
                <div class="weui-cell__bd">
                    <p>头像</p>
                </div>
                <div class="weui-cell__ft">
                    <form enctype="multipart/form-data" style="display: none;">
                        <input type="file" name="file" accept="image/png,image/jpeg,image/gif" id="upload_figure" />
                    </form>
                    <?php if(empty($userinfo->user_figure)){ ?>
                    <img class="userinfo-figure" src="/htdocs/mobile/images/user-figure.png" />
                    <?php }else{ ?>
                    <img class="userinfo-figure" src="<?php echo $userinfo->user_figure; ?>" />
                    <?php } ?>
                </div>
            </label>
            <a class="weui-cell weui-cell_access" href="<?php echo base_url() ?>m/nickname.html" target="_parent">
                <div class="weui-cell__bd">
                    <p>昵称</p>
                </div>
                <div class="weui-cell__ft"><?php echo $userinfo->user_name; ?></div>
            </a>
        </div>
        
    </div>
    
    <?php include_once('templete/pub_foot.php') ?>
    <script>
    window.onload = function(){
        
    }
    
    $(function(){
        $("#upload_figure").on("change",function(){
            var $this = $(this);
            var file_object = this.files[0];
            var reader = new FileReader();
            if (!window.FileReader || !file_object || !file_object.type.match('image.*')) {
                $.alert("上传图片类型错误！");
                return;
            }
            if (file_object.size > 10485760) {
                $.alert("图片大小应小于10M");
                return;
            }
            reader.readAsDataURL(file_object);
            reader.onload = function (e) {
                var result = this.result;
                //$this.siblings(".userinfo-figure").attr("src",result);//FileReader预览图片
                
                //ajax表单提交
                $.showLoading();
                var $form = $this.parent();
                $form.ajaxForm({
                    url:'/mobile/Index_controller/upload_userFigureTemp',
                    type:'post',
                    beforeSubmit:function () {
                    },
                    success: function (res) {
                        var result = eval('('+res+')');
                        if(result.state == 'success'){
                            $.ajax({
                                type:"post",
                                url:"<?php echo base_url() ?>mobile/Index_controller/upload_userFigureAjax",
                                async:true,
                                data:{
                                    figure_path: result.url
                                },
                                dataType:"json",
                                success:function(data){
                                    if(data.state == 'success'){
                                        $form.siblings(".userinfo-figure").attr("src",data.figure);
                                        $.hideLoading();
                                    }else{
                                        $.alert(data.msg);
                                    }
                                }
                            });
                        }else{
                            $.alert(result);
                        }
                    },
                    error:function(XmlHttpRequest,textStatus,errorThrown){
                        $.alert('程序错误，请重试');
                    }
                }).submit();
            }
        })
    })
    
    </script>
    </body>
</html>