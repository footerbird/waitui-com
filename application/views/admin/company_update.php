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
          <h1 class="title">企业数据爬取</h1>
        </div>
        
          <div class="breadcrumb-env">
          
            <ol class="breadcrumb bc-1">
              <li><a href="<?php echo base_url() ?>admin"><i class="fa-home"></i>首页</a></li>
              <li><a href="<?php echo base_url() ?>admin/company_list">企业管理</a></li>
              <li class="active"><strong>企业数据爬取</strong></li>
            </ol>
                
        </div>
          
      </div>
      <!-- Table Styles -->
      <div class="row">
        <div class="col-md-12">
        
          <div class="panel panel-default">
            
            <div class="panel-body">
                <form role="form" action="/admin/Index_controller/company_update" method="post" class="form-horizontal" id="sForm">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">爬取地址</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="10" name="site_list" id="site_list" placeholder="请输入企查查企业详情页面网址,一行一个"><?php if(isset($site_list)){ echo $site_list; } ?></textarea>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="button" class="btn btn-orange" id="submitBtn" onclick="form_submit()" value="爬取">
                            <a href="<?php echo base_url() ?>admin/company_update" class="btn btn-secondary btn-sm">重置</a>
                            <a href="<?php echo base_url() ?>admin/company_list" class="btn btn-white btn-sm fl-r">返回</a>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">爬取结果</label>
                        <div class="col-sm-10">
                            <?php if(isset($result_list)){ ?>
                            <?php foreach ($result_list as $result){ ?>
                                <?php if($result['state'] == 'failed'){ ?>
                                    <p style="color:#f00;"><?php echo $result['msg']; ?></p>
                                <?php }else{ ?>
                                    <p style="color:#080;"><?php echo $result['msg']; ?></p>
                                <?php } ?>
                            <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
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
    if($.trim($("#site_list").val()) == ""){
        toastr.error("网址不能为空");
        return;
    }
    $("#submitBtn").val("爬取中...");
    $("#sForm").submit();
}
$(function(){
    
})
</script>
</body>
</html>