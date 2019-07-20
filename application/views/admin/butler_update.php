<!DOCTYPE html>
<html>
<head>
<?php include_once('templete/pub_head.php') ?>
<link rel="stylesheet" href="/htdocs/admin/js/dropzone/css/dropzone.css?<?php echo CACHE_TIME; ?>">
</head>
<body class="page-body">

  <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
      
    <?php include_once('templete/sidebar.php') ?>
    
    <div class="main-content">
      
      <?php include_once('templete/navbar.php') ?>
      
      <div class="page-title">
        
        <div class="title-env">
          <h1 class="title">品牌管家编辑</h1>
        </div>
        
          <div class="breadcrumb-env">
          
            <ol class="breadcrumb bc-1">
              <li><a href="<?php echo base_url() ?>admin"><i class="fa-home"></i>首页</a></li>
              <li><a href="<?php echo base_url() ?>admin/butler_list">品牌管家管理</a></li>
              <li class="active"><strong>品牌管家编辑</strong></li>
            </ol>
                
        </div>
          
      </div>
      <!-- Table Styles -->
      <div class="row">
        <div class="col-md-12">
        
          <div class="panel panel-default">
            
            <div class="panel-body">
                <form role="form" class="form-horizontal" id="sForm">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">管家昵称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="butler_name" id="butler_name" required="required" placeholder="请输入管家昵称" value="<?php if(isset($butler)){ echo $butler->butler_name; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">真实姓名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="real_name" id="real_name" required="required" placeholder="请输入真实姓名" value="<?php if(isset($butler)){ echo $butler->real_name; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">电话号码</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="butler_phone" id="butler_phone" required="required" placeholder="请输入电话号码" value="<?php if(isset($butler)){ echo $butler->butler_phone; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">QQ号码</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="butler_qq" id="butler_qq" required="required" placeholder="请输入QQ号码" value="<?php if(isset($butler)){ echo $butler->butler_qq; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">微信二维码</label>
                        <div class="col-sm-10">
                            <div id="advancedDropzone" class="droppable-area">
                              Drop Files Here
                            </div>
                            <input type="hidden" name="butler_wechat" id="butler_wechat" value="<?php if(isset($butler)){ echo $butler->butler_wechat; } ?>">
                            <?php if(isset($butler)){ echo '<img id="butler_wechat_preview" src="'.$butler->butler_wechat.'" width="150" height="150" class="ml20" />'; } ?>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">激活状态</label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <input name="status" type="radio" value="1" <?php if(!isset($butler) || $butler->status != 0){ echo 'checked="checked"'; } ?>>
                                是
                            </label>
                            <label class="radio-inline">
                                <input name="status" type="radio" value="0" <?php if(isset($butler) && $butler->status == 0){ echo 'checked="checked"'; } ?>>
                                否
                            </label>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="button" class="btn btn-orange" id="submitBtn" onclick="form_submit()" value="提交">
                            <a href="<?php echo base_url() ?>admin/butler_list" class="btn btn-white btn-sm ">返回</a>
                        </div>
                    </div>
                    <input type="hidden" name="butler_id" value="<?php if(isset($butler)){ echo $butler->butler_id; } ?>">
                    <input type="hidden" name="operate" value="<?php echo $operate; ?>">
                </form>
            </div>
            
          </div>
          
        </div>
      </div>
      
      <?php include_once('templete/copyright.php') ?>
    </div>
    
  </div>
  
  
  
<?php include_once('templete/pub_foot.php') ?>
<script src="/htdocs/admin/js/dropzone/dropzone.min.js?<?php echo CACHE_TIME; ?>"></script>
<script type="text/javascript">
function form_submit(){
    if($("#butler_name").val() == ""){
        toastr.error("管家昵称不能为空");
        return;
    }
    if($("#real_name").val() == ""){
        toastr.error("真实姓名不能为空");
        return;
    }
    if($("#butler_phone").val() == ""){
        toastr.error("电话号码不能为空");
        return;
    }
    if($("#butler_qq").val() == ""){
        toastr.error("QQ号码不能为空");
        return;
    }
    if($("#butler_wechat").val() == ""){
        toastr.error("微信二维码不能为空");
        return;
    }
    
    $("#sForm").ajaxForm({
        url:'/admin/Index_controller/butler_update_do',
        type:'post',
        dataType:'json',
        beforeSubmit:function () {
        },
        success:function (data) {
            if(data.state == "success"){
                location.href = '<?php echo base_url() ?>admin/butler_list';
            }else{
                toastr.error(data.msg);
            }
        },
        error:function(jqXHR, textStatus, errorThrown){
            toastr.error("程序异常："+errorThrown+"<br>请联系管理员");
        }
    }).submit();
}
$(function(){
    $("#advancedDropzone").dropzone({
        url: '<?php echo base_url() ?>admin/Index_controller/upload_butlerWechatTemp',
        maxFiles: 1,
        maxFilesize: 5,
        acceptedFiles: ".jpeg,.jpg,.gif,.png,.JPEG,.JPG,.GIF,.PNG",
        success: function(file,res){
            var result = eval('('+res+')');
            if(result.state == 'success'){
                $.ajax({//因为不能确定修改时有没有修改二维码,所以不能在提交的时候去移动临时目录的二维码图片,得提前移动
                    type:"post",
                    url:"<?php echo base_url() ?>admin/Index_controller/upload_butlerWechatAjax",
                    async:true,
                    data:{
                        wechat_path: result.url
                    },
                    dataType:"json",
                    success:function(data){
                        if(data.state == 'success'){
                            $("#butler_wechat").val(data.wechat);
                            if($("#butler_wechat_preview").length == 1){
                                $("#butler_wechat_preview").attr("src",data.wechat);
                            }else{
                                $("#advancedDropzone").after('<img id="butler_wechat_preview" src="'+data.wechat+'" width="150" height="150" class="ml20" />');
                            }
                        }else{
                            toastr.error(data.msg);
                        }
                    }
                });
            }else{
                toastr.error("上传失败");
            }
        },
        error: function(file,res){
            toastr.error("上传失败");
        },
        addedfile: function(file){}//阻止默认行为
    });
})
</script>
</body>
</html>