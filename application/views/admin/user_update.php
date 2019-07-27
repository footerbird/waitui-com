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
          <h1 class="title">用户编辑</h1>
        </div>
        
          <div class="breadcrumb-env">
          
            <ol class="breadcrumb bc-1">
              <li><a href="<?php echo base_url() ?>admin"><i class="fa-home"></i>首页</a></li>
              <li><a href="<?php echo base_url() ?>admin/user_list">用户管理</a></li>
              <li class="active"><strong>用户编辑</strong></li>
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
                        <label class="col-sm-2 control-label">用户昵称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="user_name" required="required" placeholder="请输入用户昵称" value="<?php if(isset($user)){ echo $user->user_name; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">手机号码</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="user_phone" required="required" placeholder="请输入手机号码" value="<?php if(isset($user)){ echo $user->user_phone; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">用户头像</label>
                        <div class="col-sm-10">
                            <?php if(isset($user)){ echo '<img id="user_figure_preview" src="'.$user->user_figure.'" width="150" height="150" class="ml20" />'; } ?>
                        </div>
                    </div>
                    <?php if(isset($user)){ ?>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">用户域名</label>
                        <div class="col-sm-10">
                            <a href="<?php echo base_url() ?>admin/domain_list?user_id=<?php echo $user->user_id; ?>" target="_blank" class="btn btn-orange btn-sm ">域名列表</a>
                            <a href="<?php echo base_url() ?>admin/user_domain_add" target="_blank" class="btn btn-secondary ">添加域名</a>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">用户商标</label>
                        <div class="col-sm-10">
                            <a href="<?php echo base_url() ?>admin/mark_list?user_id=<?php echo $user->user_id; ?>" target="_blank" class="btn btn-orange btn-sm ">商标列表</a>
                            <a href="<?php echo base_url() ?>admin/user_mark_add" target="_blank" class="btn btn-secondary ">添加商标</a>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="<?php echo base_url() ?>admin/user_list" class="btn btn-white btn-sm ">返回</a>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" value="<?php if(isset($user)){ echo $user->user_id; } ?>">
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
$(function(){
    
})
</script>
</body>
</html>