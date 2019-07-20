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
          <h1 class="title">文章作者</h1>
        </div>
        
          <div class="breadcrumb-env">
          
            <ol class="breadcrumb bc-1">
              <li><a href="<?php echo base_url() ?>admin"><i class="fa-home"></i>首页</a></li>
              <li><a href="<?php echo base_url() ?>admin/article_list">文章管理</a></li>
              <li class="active"><strong>文章作者</strong></li>
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
                      <a href="<?php echo base_url() ?>admin/article_author_update" class="btn btn-secondary btn-sm fl-r ml20">添加作者</a>
                  </div>
                </div>
                
                <table cellspacing="0" class="table table-small-font table-bordered table-striped">
                  <thead>
                    <tr>
                      <th data-priority="1">编号</th>
                      <th data-priority="1">作者名称</th>
                      <th data-priority="1">座右铭</th>
                      <th data-priority="1">操作</th>
                    </tr>
                  </thead>
                  <tbody class="middle-align">
                    <?php foreach ($author_list as $author){ ?>
                    <tr>
                        <td><?php echo $author->author_id; ?></td>
                        <td><?php echo $author->author_name; ?></td>
                        <td><?php echo $author->author_motto; ?></td>
                        <td><a href="<?php echo base_url() ?>admin/article_author_update?author_id=<?php echo $author->author_id; ?>" class="btn btn-orange btn-sm btn-icon icon-left">查看</a></td>
                    </tr>
                    <?php } ?>
                    <?php if(count($author_list) == 0){ ?>
                    <tr>
                    	<td colspan="4">未搜索到相应结果</td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
                
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