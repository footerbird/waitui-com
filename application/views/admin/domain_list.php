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
          <h1 class="title">域名列表</h1>
        </div>
        
          <div class="breadcrumb-env">
          
            <ol class="breadcrumb bc-1">
              <li><a href="<?php echo base_url() ?>admin"><i class="fa-home"></i>首页</a></li>
              <li><a href="<?php echo base_url() ?>admin/domain_list">域名管理</a></li>
              <li class="active"><strong>域名列表</strong></li>
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
                    <form id="search_form" action="<?php echo base_url() ?>admin/domain_list" method="get">
                      <label class="fl-l">关键字:
                        <input type="text" name="keyword" class="form-control input-sm" placeholder="请输入域名关键字" value="<?php echo $keyword; ?>">
                      </label>
                      <label class="fl-l ml20">出售状态:
                        <select name="is_onsale" class="form-control input-sm">
                          <option value="">所有</option>
                          <option value="sale" <?php if($is_onsale == 'sale'){ echo 'selected'; } ?>>是</option>
                          <option value="unsale" <?php if($is_onsale == 'unsale'){ echo 'selected'; } ?>>否</option>
                        </select>
                      </label>
                      <label class="fl-l ml20">注册商:
                        <select name="register_registrar" class="form-control input-sm">
                          <option value="">所有</option>
                          <option value="阿里云" <?php if($register_registrar == '阿里云'){ echo 'selected'; } ?>>阿里云</option>
                          <option value="爱名网" <?php if($register_registrar == '爱名网'){ echo 'selected'; } ?>>爱名网</option>
                          <option value="易名中国" <?php if($register_registrar == '易名中国'){ echo 'selected'; } ?>>易名中国</option>
                        </select>
                      </label>
                      <label class="fl-l ml20">用户编号:
                        <input type="text" name="user_id" class="form-control input-sm" placeholder="请输入用户编号" value="<?php echo $user_id; ?>">
                      </label>
                      <a href="javascript:;" class="btn btn-orange btn-sm fl-l ml20" onclick="form_submit()" >搜索</a>
                      <a href="<?php echo base_url() ?>admin/domain_update" class="btn btn-secondary btn-sm fl-r ml20">添加域名</a>
                    </form>
                  </div>
                </div>
                
                <table cellspacing="0" class="table table-small-font table-bordered table-striped">
                  <thead>
                    <tr>
                      <th data-priority="1">域名</th>
                      <th data-priority="1">简介</th>
                      <th data-priority="1">当前价格</th>
                      <th data-priority="1">距到期</th>
                      <th data-priority="1">注册商</th>
                      <th data-priority="1">是否出售</th>
                      <th data-priority="1">操作</th>
                    </tr>
                  </thead>
                  <tbody class="middle-align">
                    <?php foreach ($domain_list as $domain){ ?>
                    <tr>
                        <td><?php echo $domain->domain_name; ?></td>
                        <td><?php echo $domain->domain_summary; ?></td>
                        <td><?php echo $domain->domain_price; ?></td>
                        <td><?php echo $domain->expired_date.'天'; ?></td>
                        <td><?php echo $domain->register_registrar; ?></td>
                        <td><?php echo $domain->is_onsale=='sale'?'是':'否'; ?></td>
                        <td><a href="<?php echo base_url() ?>admin/domain_update?domain_name=<?php echo $domain->domain_name; ?>" class="btn btn-orange btn-sm btn-icon icon-left">查看</a></td>
                    </tr>
                    <?php } ?>
                    <?php if(count($domain_list) == 0){ ?>
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