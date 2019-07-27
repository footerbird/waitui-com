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
          <h1 class="title">用户列表</h1>
        </div>
        
          <div class="breadcrumb-env">
          
            <ol class="breadcrumb bc-1">
              <li><a href="<?php echo base_url() ?>admin"><i class="fa-home"></i>首页</a></li>
              <li><a href="<?php echo base_url() ?>admin/user_list">用户管理</a></li>
              <li class="active"><strong>用户列表</strong></li>
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
                    <form id="search_form" action="<?php echo base_url() ?>admin/user_list" method="get">
                      <label class="fl-l">关键字:
                        <input type="text" name="keyword" class="form-control input-sm" placeholder="请输入用户昵称或手机号码" value="<?php echo $keyword; ?>">
                      </label>
                      <label class="fl-l ml20">用户编号:
                        <input type="text" name="user_id" class="form-control input-sm" placeholder="请输入用户编号" value="<?php echo $user_id; ?>">
                      </label>
                      <a href="javascript:;" class="btn btn-orange btn-sm fl-l ml20" onclick="form_submit()" >搜索</a>
                    </form>
                  </div>
                </div>
                
                <table cellspacing="0" class="table table-small-font table-bordered table-striped">
                  <thead>
                    <tr>
                      <th data-priority="1">编号</th>
                      <th data-priority="1">用户昵称</th>
                      <th data-priority="1">手机号码</th>
                      <th data-priority="1">操作</th>
                    </tr>
                  </thead>
                  <tbody class="middle-align">
                    <?php foreach ($user_list as $user){ ?>
                    <tr>
                        <td><?php echo $user->user_id; ?></td>
                        <td><?php echo $user->user_name; ?></td>
                        <td><?php echo $user->user_phone; ?></td>
                        <td><a href="<?php echo base_url() ?>admin/user_update?user_id=<?php echo $user->user_id; ?>" class="btn btn-orange btn-sm btn-icon icon-left">查看</a></td>
                    </tr>
                    <?php } ?>
                    <?php if(count($user_list) == 0){ ?>
                    <tr>
                    	<td colspan="4">未搜索到相应结果</td>
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
function form_submit(){
    $("#search_form").submit();
}

$(function(){
    
})
</script>
</body>
</html>