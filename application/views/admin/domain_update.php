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
          <h1 class="title">域名编辑</h1>
        </div>
        
          <div class="breadcrumb-env">
          
            <ol class="breadcrumb bc-1">
              <li><a href="<?php echo base_url() ?>admin"><i class="fa-home"></i>首页</a></li>
              <li><a href="<?php echo base_url() ?>admin/domain_list">出售域名管理</a></li>
              <li class="active"><strong>域名编辑</strong></li>
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
                        <label class="col-sm-2 control-label">域名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="domain_name" id="domain_name" required="required" placeholder="请输入域名" value="<?php if(isset($domain)){ echo $domain->domain_name; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">注册商</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="register_registrar" id="register_registrar" placeholder="请输入注册商" value="<?php if(isset($domain)){ echo $domain->register_registrar; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">注册人</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="register_name" id="register_name" placeholder="请输入注册人" value="<?php if(isset($domain)){ echo $domain->register_name; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">注册邮箱</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="register_email" id="register_email" placeholder="请输入注册邮箱" value="<?php if(isset($domain)){ echo $domain->register_email; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">注册日期</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control datepicker" name="created_date" id="created_date" placeholder="请输入注册日期" value="<?php if(isset($domain)){ echo $domain->created_date; } ?>" data-format="yyyy-mm-dd">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">过期日期</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control datepicker" name="expired_date" id="expired_date" placeholder="请输入过期日期" value="<?php if(isset($domain)){ echo $domain->expired_date; } ?>" data-format="yyyy-mm-dd">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">域名类型</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="domain_type" id="domain_type" placeholder="请输入域名类型" value="<?php if(isset($domain)){ echo $domain->domain_type; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">域名价格</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="domain_price" id="domain_price" placeholder="请输入域名价格" value="<?php if(isset($domain)){ echo $domain->domain_price; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">域名简介</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="domain_summary" id="domain_summary" placeholder="请输入域名简介" value="<?php if(isset($domain)){ echo $domain->domain_summary; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="button" class="btn btn-orange" id="submitBtn" onclick="form_submit()" value="提交">
                            <a href="<?php echo base_url() ?>admin/domain_list" class="btn btn-white btn-sm ">返回</a>
                        </div>
                    </div>
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
<script src="/htdocs/admin/js/datepicker/bootstrap-datepicker.js?<?php echo CACHE_TIME; ?>"></script>
<script type="text/javascript">
function form_submit(){
    if($("#domain_name").val() == ""){
        toastr.error("域名不能为空");
        return;
    }
    
    $("#sForm").ajaxForm({
        url:'/admin/Index_controller/domain_update_do',
        type:'post',
        dataType:'json',
        beforeSubmit:function () {
        },
        success:function (data) {
            if(data.state == "success"){
                location.href = '<?php echo base_url() ?>admin/domain_list';
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