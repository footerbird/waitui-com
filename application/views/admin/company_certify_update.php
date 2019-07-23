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
          <h1 class="title">企业认证编辑</h1>
        </div>
        
          <div class="breadcrumb-env">
          
            <ol class="breadcrumb bc-1">
              <li><a href="<?php echo base_url() ?>admin"><i class="fa-home"></i>首页</a></li>
              <li><a href="<?php echo base_url() ?>admin/user_list">用户管理</a></li>
              <li class="active"><strong>企业认证编辑</strong></li>
            </ol>
                
        </div>
          
      </div>
      <!-- Table Styles -->
      <div class="row">
        <div class="col-md-12">
        
          <div class="panel panel-default">
            
            <div class="panel-body">
                <form role="form" action="" method="post" class="form-horizontal" id="sForm">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">营业执照</label>
                        <div class="col-sm-10">
                            <img src="<?php if(isset($certify)){ echo $certify->business_license; } ?>" height="150" />
                            <a href="<?php if(isset($certify)){ echo $certify->business_license; } ?>" target="_blank" class="ml20">查看大图</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">企业名称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="company_name" id="company_name" required="required" placeholder="请输入企业名称" value="<?php if(isset($certify)){ echo $certify->company_name; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">法定代表人</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="oper_name" id="oper_name" required="required" placeholder="请输入法定代表人" value="<?php if(isset($certify)){ echo $certify->oper_name; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">注册资本</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="regist_capi" id="regist_capi" required="required" placeholder="请输入注册资本" value="<?php if(isset($certify)){ echo $certify->regist_capi; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">成立日期</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="start_date" id="start_date" placeholder="请输入成立日期" value="<?php if(isset($certify)){ echo $certify->start_date; } ?>" data-format="yyyy-mm-dd">
                                <div class="input-group-addon">
                                    <a href="#"><i class="linecons-calendar"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">统一社会信用代码</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="credit_code" id="credit_code" required="required" placeholder="请输入统一社会信用代码" value="<?php if(isset($certify)){ echo $certify->credit_code; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">企业类型</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="econ_kind" id="econ_kind" required="required" placeholder="请输入企业类型" value="<?php if(isset($certify)){ echo $certify->econ_kind; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">营业期限</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="business_term" id="business_term" required="required" placeholder="请输入营业期限" value="<?php if(isset($certify)){ echo $certify->business_term; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">企业地址</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="address" id="address" required="required" placeholder="请输入企业地址" value="<?php if(isset($certify)){ echo $certify->address; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">经营范围</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" name="scope" id="scope" placeholder="请输入经营范围"><?php if(isset($certify)){ echo $certify->scope; } ?></textarea>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">联系电话</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php if(isset($certify)){ echo $certify->contact_phone; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">联系邮箱</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php if(isset($certify)){ echo $certify->contact_email; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">联系地址</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php if(isset($certify)){ echo $certify->contact_address; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">备注</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" name="description" id="description" placeholder="请输入备注"><?php if(isset($certify)){ echo $certify->description; } ?></textarea>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="button" class="btn btn-secondary" onclick="certify_success()" value="认证通过">
                            <input type="button" class="btn btn-danger" onclick="certify_failed()" value="认证失败">
                            <a href="<?php echo base_url() ?>admin/company_certify_list" class="btn btn-white btn-sm fl-r">返回</a>
                        </div>
                    </div>
                    <input type="hidden" name="certify_id" value="<?php if(isset($certify)){ echo $certify->certify_id; } ?>">
                    <input type="hidden" name="operate" value="<?php echo $operate; ?>">
                    <input type="hidden" name="status" id="status" value="1">
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
function certify_success(){
    if($("#company_name").val() == ""){
        toastr.error("企业名称不能为空");
        return;
    }
    if($("#oper_name").val() == ""){
        toastr.error("法定代表人不能为空");
        return;
    }
    if($("#regist_capi").val() == ""){
        toastr.error("注册资本不能为空");
        return;
    }
    if($("#start_date").val() == ""){
        toastr.error("成立日期不能为空");
        return;
    }
    if($("#credit_code").val() == ""){
        toastr.error("统一社会信用代码不能为空");
        return;
    }
    if($("#econ_kind").val() == ""){
        toastr.error("企业类型不能为空");
        return;
    }
    if($("#business_term").val() == ""){
        toastr.error("营业期限不能为空");
        return;
    }
    if($("#address").val() == ""){
        toastr.error("企业地址不能为空");
        return;
    }
    if($("#scope").val() == ""){
        toastr.error("经营范围不能为空");
        return;
    }
    
    $("#status").val(2);//认证通过
    
    $("#sForm").ajaxForm({
        url:'/admin/Index_controller/company_certify_update_do',
        type:'post',
        dataType:'json',
        beforeSubmit:function () {
        },
        success:function (data) {
            if(data.state == "success"){
                location.href = '<?php echo base_url() ?>admin/company_certify_list';
            }else{
                toastr.error(data.msg);
            }
        },
        error:function(jqXHR, textStatus, errorThrown){
            toastr.error("程序异常："+errorThrown+"<br>请联系管理员");
        }
    }).submit();
}

function certify_failed(){
    if($("#company_name").val() == ""){
        toastr.error("企业名称不能为空");
        return;
    }
    if($("#oper_name").val() == ""){
        toastr.error("法定代表人不能为空");
        return;
    }
    
    if($("#description").val() == ""){
        toastr.error("认证失败原因不能为空");
        return;
    }
    
    $("#status").val(0);//认证失败
    
    $("#sForm").ajaxForm({
        url:'/admin/Index_controller/company_certify_update_do',
        type:'post',
        dataType:'json',
        beforeSubmit:function () {
        },
        success:function (data) {
            if(data.state == "success"){
                location.href = '<?php echo base_url() ?>admin/company_certify_list';
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