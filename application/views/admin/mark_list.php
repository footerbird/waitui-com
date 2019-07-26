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
          <h1 class="title">商标列表</h1>
        </div>
        
          <div class="breadcrumb-env">
          
            <ol class="breadcrumb bc-1">
              <li><a href="<?php echo base_url() ?>admin"><i class="fa-home"></i>首页</a></li>
              <li><a href="<?php echo base_url() ?>admin/mark_list">商标管理</a></li>
              <li class="active"><strong>商标列表</strong></li>
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
                      <th data-priority="1">商标</th>
                      <th data-priority="1">大类</th>
                      <th data-priority="1">注册号</th>
                      <th data-priority="1">商标申请人</th>
                      <th data-priority="1">状态</th>
                      <th data-priority="1">价格</th>
                      <th data-priority="1">是否出售</th>
                      <th data-priority="1">操作</th>
                    </tr>
                  </thead>
                  <tbody class="middle-align">
                    <?php foreach ($mark_list as $mark){ ?>
                    <tr>
                        <td><?php echo $mark->mark_name; ?></td>
                        <td>[<?php echo $mark->mark_category<10?'0'.$mark->mark_category:$mark->mark_category; ?>&nbsp;&nbsp;<?php echo $mark->category_name; ?>]</td>
                        <td><?php echo $mark->mark_regno; ?></td>
                        <td><?php echo $mark->mark_applicant; ?></td>
                        <td><?php echo $mark->mark_status; ?></td>
                        <td><?php echo number_format($mark->mark_price); ?>元</td>
                        <td><?php echo $mark->is_onsale=='sale'?'是':'否'; ?></td>
                        <td>
                          <a href="<?php echo base_url() ?>mark_detail/<?php echo $mark->regno_md; ?>.html" target="_blank" class="btn btn-orange btn-sm btn-icon icon-left">查看</a>
                          <a href="<?php echo base_url() ?>admin/mark_update?mark_regno=<?php echo $mark->mark_regno; ?>" class="btn btn-turquoise btn-sm btn-icon icon-left">修改价格</a>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if(count($mark_list) == 0){ ?>
                    <tr>
                    	<td colspan="7">未搜索到相应结果</td>
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