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
          <h1 class="title">商标编辑</h1>
        </div>
        
          <div class="breadcrumb-env">
          
            <ol class="breadcrumb bc-1">
              <li><a href="<?php echo base_url() ?>admin"><i class="fa-home"></i>首页</a></li>
              <li><a href="<?php echo base_url() ?>admin/mark_list">商标管理</a></li>
              <li class="active"><strong>商标编辑</strong></li>
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
                        <label class="col-sm-2 control-label">商标名称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $mark->mark_name; ?>" readonly="readonly" />
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">注册号</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $mark->mark_regno; ?>" readonly="readonly" />
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">商标大类</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="[<?php echo $mark->mark_category<10?'0'.$mark->mark_category:$mark->mark_category; ?>&nbsp;&nbsp;<?php echo $mark->category_name; ?>]" readonly="readonly" />
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">是否出售</label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <input name="is_onsale" type="radio" value="sale" <?php if(isset($mark) && $mark->is_onsale == 'sale'){ echo 'checked="checked"'; } ?>>
                                是
                            </label>
                            <label class="radio-inline">
                                <input name="is_onsale" type="radio" value="unsale" <?php if(!isset($mark) || $mark->is_onsale == 'unsale'){ echo 'checked="checked"'; } ?>>
                                否
                            </label>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">商标价格</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="mark_price" id="mark_price" placeholder="请输入商标价格" value="<?php if(isset($mark)){ echo $mark->mark_price; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <?php if(isset($mark) && !empty($mark->mark_userid)){ ?>
                            <span>用户商标，暂时无法编辑</span>
                            <a href="<?php echo base_url() ?>admin/mark_list" class="btn btn-white btn-sm fl-r">返回</a>
                            <?php }else{ ?>
                            <input type="button" class="btn btn-orange" id="submitBtn" onclick="form_submit()" value="提交">
                            <a href="<?php echo base_url() ?>admin/mark_list" class="btn btn-white btn-sm">返回</a>
                            <?php } ?>
                        </div>
                    </div>
                    <input type="hidden" name="mark_regno" value="<?php if(isset($mark)){ echo $mark->mark_regno; } ?>">
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
    if($("#mark_price").val() == ""){
        toastr.error("商标价格不能为空");
        return;
    }
    
    $("#sForm").ajaxForm({
        url:'/admin/Index_controller/mark_update_do',
        type:'post',
        dataType:'json',
        beforeSubmit:function () {
        },
        success:function (data) {
            if(data.state == "success"){
                location.href = '<?php echo base_url() ?>admin/mark_list';
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