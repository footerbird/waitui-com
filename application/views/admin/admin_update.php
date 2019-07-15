<!DOCTYPE html>
<html>
<head>
<?php include_once('templete/pub_head.php') ?>
</head>
<body class="page-body">

  <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
      
    <?php include_once('templete/sidebar.php') ?>
    
    <div class="main-content">
      
      <?php include_once('templete/navbar.php') ?>
      
      <div class="page-title">
        
        <div class="title-env">
          <h1 class="title">管理员编辑</h1>
        </div>
        
          <div class="breadcrumb-env">
          
            <ol class="breadcrumb bc-1">
              <li><a href="<?php echo base_url() ?>admin"><i class="fa-home"></i>首页</a></li>
              <li><a href="<?php echo base_url() ?>admin/admin_list">管理员管理</a></li>
              <li class="active"><strong>管理员编辑</strong></li>
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
                        <label class="col-sm-2 control-label">用户名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="admin_name" id="admin_name" required="required" placeholder="请输入用户名" value="<?php if(isset($admin)){ echo $admin->admin_name; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">真实姓名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="real_name" id="real_name" required="required" placeholder="请输入真实姓名" value="<?php if(isset($admin)){ echo $admin->real_name; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">密码</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="admin_pwd" id="admin_pwd" required="required" placeholder="请输入密码" value="<?php if(isset($admin)){ echo $admin->admin_pwd; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">确认密码</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="admin_pwd_confirm" id="admin_pwd_confirm" required="required" placeholder="请输入确认密码" value="<?php if(isset($admin)){ echo $admin->admin_pwd; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">激活状态</label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <input name="status" type="radio" value="1" <?php if(!isset($admin) || $admin->status != 0){ echo 'checked="checked"'; } ?>>
                                是
                            </label>
                            <label class="radio-inline">
                                <input name="status" type="radio" value="0" <?php if(isset($admin) && $admin->status == 0){ echo 'checked="checked"'; } ?>>
                                否
                            </label>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="button" class="btn btn-orange" id="submitBtn" onclick="form_submit()" value="提交">
                            <a href="<?php echo base_url() ?>admin/admin_list" class="btn btn-white btn-sm ">返回</a>
                        </div>
                    </div>
                    <input type="hidden" name="admin_id" value="<?php if(isset($admin)){ echo $admin->admin_id; } ?>">
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
<script type="text/javascript">
function form_submit(){
    if($("#admin_name").val() == ""){
        toastr.error("用户名不能为空");
        return;
    }
    if($("#real_name").val() == ""){
        toastr.error("真实姓名不能为空");
        return;
    }
    if($("#admin_pwd").val() == ""){
        toastr.error("密码不能为空");
        return;
    }
    if($("#admin_pwd_confirm").val() == ""){
        toastr.error("确认密码不能为空");
        return;
    }
    if($("#admin_pwd").val() != $("#admin_pwd_confirm").val()){
        toastr.error("密码与确认密码不一致");
        return;
    }
    
    $("#sForm").ajaxForm({
        url:'/admin/Index_controller/admin_update_do',
        type:'post',
        dataType:'json',
        beforeSubmit:function () {
        },
        success:function (data) {
            if(data.state == "success"){
                location.href = '<?php echo base_url() ?>admin/admin_list';
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
    
})
</script>
</body>
</html>