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
          <h1 class="title">文章列表</h1>
        </div>
        
          <div class="breadcrumb-env">
          
            <ol class="breadcrumb bc-1">
              <li><a href="<?php echo base_url() ?>admin"><i class="fa-home"></i>首页</a></li>
              <li><a href="<?php echo base_url() ?>admin/article_list">文章管理</a></li>
              <li class="active"><strong>文章列表</strong></li>
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
                      <a href="<?php echo base_url() ?>admin/article_update" class="btn btn-secondary btn-sm fl-r ml20">添加文章</a>
                  </div>
                </div>
                
                <table cellspacing="0" class="table table-small-font table-bordered table-striped">
                  <thead>
                    <tr>
                      <th data-priority="1">编号</th>
                      <th data-priority="1">标题</th>
                      <th data-priority="1">类型</th>
                      <th data-priority="1">作者</th>
                      <th data-priority="1">是否发布</th>
                      <th data-priority="1">发布时间</th>
                      <th data-priority="1">阅读量</th>
                      <th data-priority="1">操作</th>
                    </tr>
                  </thead>
                  <tbody class="middle-align">
                    <?php foreach ($article_list as $article){ ?>
                    <tr>
                        <td><?php echo $article->article_id; ?></td>
                        <td width="200" title="<?php echo $article->article_title; ?>"><div class="w200 ellip"><?php echo $article->article_title; ?></div></td>
                        <td><?php echo $article->category_name; ?></td>
                        <td><?php echo $article->author_name; ?></td>
                        <td><?php echo ($article->status == 'active')?'已发布':'<span style="color:#f00;">未发布</span>'; ?></td>
                        <td><?php echo $article->create_time; ?></td>
                        <td><?php echo $article->article_read; ?></td>
                        <td><a href="<?php echo base_url() ?>admin/article_update?article_id=<?php echo $article->article_id; ?>" class="btn btn-orange btn-sm btn-icon icon-left">查看</a></td>
                    </tr>
                    <?php } ?>
                    <?php if(count($article_list) == 0){ ?>
                    <tr>
                    	<td colspan="8">未搜索到相应结果</td>
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