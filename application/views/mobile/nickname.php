<!DOCTYPE html>
<html>

    <head>
    <?php include_once('templete/pub_head.php') ?>
    </head>

    <body>
    <div class="header">
        <div class="header-container">
            <a href="javascript:history.go(-1);" class="back-text">返回</a>
            <a href="javascript:;" id="save_nickname" class="save-text">保存</a>
        </div>
    </div>
    <div class="container" style="padding-top: 45px;">
        
        <div class="weui-cells" style="margin-top: 15px;">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" id="nickname" value="<?php echo $userinfo->user_name; ?>" placeholder="请输入昵称">
                </div>
            </div>
        </div>
        
    </div>
    
    <?php include_once('templete/pub_foot.php') ?>
    <script>
    window.onload = function(){
        
    }
    
    $(function(){
        $("#nickname").on("input",function(){
            var $nickname = $(this).val();
            if($.trim($nickname) == ''){
                $("#save_nickname").addClass("forbid");
            }else{
                $("#save_nickname").removeClass("forbid");
            }
        })
        
        $("#save_nickname").on("click",function(){
            if($(this).hasClass("forbid")){
                return;
            }
            $.ajax({
                type:"post",
                url:"<?php echo base_url() ?>mobile/Index_controller/edit_userNameAjax",
                async:true,
                data:{
                    user_name: $("#nickname").val()
                },
                dataType:"json",
                success:function(data){
                    if(data.state == 'success'){
                        $.toast('修改成功', function() {
                            location.href = '<?php echo base_url() ?>m/account.html';
                        });
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