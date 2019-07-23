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
          <h1 class="title">企业认证列表</h1>
        </div>
        
          <div class="breadcrumb-env">
          
            <ol class="breadcrumb bc-1">
              <li><a href="<?php echo base_url() ?>admin"><i class="fa-home"></i>首页</a></li>
              <li><a href="<?php echo base_url() ?>admin/user_list">用户管理</a></li>
              <li class="active"><strong>企业认证列表</strong></li>
            </ol>
                
        </div>
          
      </div>
      <!-- Table Styles -->
      <div class="row">
        <div class="col-md-12">
        
          <div class="panel panel-default">
            
            <div class="panel-body">
              
              <div class="dataTables_wrapper form-inline dt-bootstrap">
                
                <table cellspacing="0" class="table table-small-font table-bordered table-striped">
                  <thead>
                    <tr>
                      <th data-priority="1">编号</th>
                      <th data-priority="1">认证用户</th>
                      <th data-priority="1">认证企业</th>
                      <th data-priority="1">认证状态</th>
                      <th data-priority="1">认证时间</th>
                      <th data-priority="1">操作</th>
                    </tr>
                  </thead>
                  <tbody class="middle-align">
                    <?php foreach ($certify_list as $certify){ ?>
                    <tr>
                        <td><?php echo $certify->certify_id; ?></td>
                        <td><?php echo $certify->certify_userid; ?></td>
                        <td><?php echo $certify->company_name; ?></td>
                        <td>
                            <?php 
                                switch($certify->status){
                                    case 0:
                                        echo '<span style="color:#999;">认证失败</span>';
                                        break;
                                    case 1:
                                        echo '<span style="color:#f00;">待认证</span>';
                                        break;
                                    case 2:
                                        echo '<span style="color:#080;">已认证</span>';
                                        break;
                                    default:
                                        echo '<span style="color:#999;">认证异常</span>';
                                        break;
                                }
                             ?>
                        </td>
                        <td><?php echo $certify->create_time; ?></td>
                        <td><a href="<?php echo base_url() ?>admin/company_certify_update?certify_id=<?php echo $certify->certify_id; ?>" class="btn btn-orange btn-sm btn-icon icon-left">查看</a></td>
                    </tr>
                    <?php } ?>
                    <?php if(count($certify_list) == 0){ ?>
                    <tr>
                    	<td colspan="6">未搜索到相应结果</td>
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