<!DOCTYPE html>
<html>
<head>
<?php include_once('templete/pub_head.php') ?>
<link rel="stylesheet" href="/htdocs/admin/js/datatables/dataTables.bootstrap.css?<?php echo CACHE_TIME; ?>">
</head>
<body class="page-body">

  <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
      
    <?php include_once('templete/sidebar.php') ?>
    
    <div class="main-content">
      
      <?php include_once('templete/navbar.php') ?>
      
      <div class="page-title">
        
        <div class="title-env">
          <h1 class="title">管理员列表</h1>
        </div>
        
          <div class="breadcrumb-env">
          
            <ol class="breadcrumb bc-1">
              <li><a href="<?php echo base_url() ?>admin"><i class="fa-home"></i>首页</a></li>
              <li><a href="<?php echo base_url() ?>admin/admin_list">管理员管理</a></li>
              <li class="active"><strong>管理员列表</strong></li>
            </ol>
                
        </div>
          
      </div>
      <!-- Table Styles -->
      <div class="row">
        <div class="col-md-12">
        
          <div class="panel panel-default">
            
            <div class="panel-body">
              
              <div class="dataTables_wrapper form-inline dt-bootstrap">
                
                <div class="row">
                  <div class="col-xs-12">
                      <a href="<?php echo base_url() ?>admin/admin_update" class="btn btn-secondary btn-sm fl-r ml20">添加管理员</a>
                  </div>
                </div>
                
                <table cellspacing="0" class="table table-small-font table-bordered table-striped">
                  <thead>
                    <tr>
                      <th data-priority="1">编号</th>
                      <th data-priority="1">用户名</th>
                      <th data-priority="1">姓名</th>
                      <th data-priority="1">状态</th>
                      <th data-priority="1">操作</th>
                    </tr>
                  </thead>
                  <tbody class="middle-align">
                    <?php foreach ($admin_list as $admin){ ?>
                    <tr>
                        <td><?php echo $admin->admin_id; ?></td>
                        <td><?php echo $admin->admin_name; ?></td>
                        <td><?php echo $admin->real_name; ?></td>
                        <td><?php echo ($admin->status == 1)?'正常':'<span style="color:#f00;">冻结</span>'; ?></td>
                        <td><a href="<?php echo base_url() ?>admin/admin_update?admin_id=<?php echo $admin->admin_id; ?>" class="btn btn-orange btn-sm btn-icon icon-left">查看</a></td>
                    </tr>
                    <?php } ?>
                    <?php if(count($admin_list) == 0){ ?>
                    <tr>
                    	<td colspan="5">未搜索到相应结果</td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
                
                <div class="row">
                  <div class="col-xs-6">
                    <div class="dataTables_info">共<?php echo $page_count; ?>条记录，
                      <label>每页显示 <?php echo $page_size; ?> 条记录</label>
                    </div>
                  </div>
                  <div class="col-xs-6">
                    <div class="dataTables_paginate paging_simple_numbers">
                      <?php echo $this->pagination->create_links(); ?>
                    </div>
                  </div>
                </div>
                
              </div>
              
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