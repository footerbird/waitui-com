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
          <h1 class="title">企业列表</h1>
        </div>
        
          <div class="breadcrumb-env">
          
            <ol class="breadcrumb bc-1">
              <li><a href="<?php echo base_url() ?>admin"><i class="fa-home"></i>首页</a></li>
              <li><a href="<?php echo base_url() ?>admin/company_list">企业管理</a></li>
              <li class="active"><strong>企业列表</strong></li>
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
                    <form id="search_form" action="<?php echo base_url() ?>admin/company_list" method="get">
                      <label class="fl-l">关键字:
                        <input type="text" name="keyword" class="form-control input-sm" placeholder="请输入企业名称或法人姓名" value="<?php echo $keyword; ?>">
                      </label>
                      <a href="javascript:;" class="btn btn-orange btn-sm fl-l ml20" onclick="form_submit()" >搜索</a>
                      <a href="<?php echo base_url() ?>admin/company_update" class="btn btn-secondary btn-sm fl-r ml20">添加企业</a>
                    </form>
                  </div>
                </div>
                
                <table cellspacing="0" class="table table-small-font table-bordered table-striped">
                  <thead>
                    <tr>
                      <th data-priority="1">公司名称</th>
                      <th data-priority="1">法定代表人</th>
                      <th data-priority="1">注册资本</th>
                      <th data-priority="1">成立日期</th>
                      <th data-priority="1">所属地区</th>
                      <th data-priority="1">操作</th>
                    </tr>
                  </thead>
                  <tbody class="middle-align">
                    <?php foreach ($company_list as $company){ ?>
                    <tr>
                        <td><?php echo $company->name; ?></td>
                        <td><?php echo $company->oper_name; ?></td>
                        <td><?php echo $company->regist_capi; ?></td>
                        <td><?php echo date('Y-m-d',strtotime($company->start_date)); ?></td>
                        <td><?php echo $company->province; ?></td>
                        <td><a href="<?php echo base_url() ?>company_detail/<?php echo $company->company_id; ?>.html" class="btn btn-orange btn-sm btn-icon icon-left">查看</a></td>
                    </tr>
                    <?php } ?>
                    <?php if(count($company_list) == 0){ ?>
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
function form_submit(){
    $("#search_form").submit();
}

$(function(){
    
})
</script>
</body>
</html>