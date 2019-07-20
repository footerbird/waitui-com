<!DOCTYPE html>
<html>
<head>
<?php include_once('templete/pub_head.php') ?>
<link rel="stylesheet" href="/htdocs/admin/js/dropzone/css/dropzone.css?<?php echo CACHE_TIME; ?>">
</head>
<body class="page-body">

  <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
      
    <?php include_once('templete/sidebar.php') ?>
    
    <div class="main-content">
      
      <?php include_once('templete/navbar.php') ?>
      
      <div class="page-title">
        
        <div class="title-env">
          <h1 class="title">文章作者编辑</h1>
        </div>
        
          <div class="breadcrumb-env">
          
            <ol class="breadcrumb bc-1">
              <li><a href="<?php echo base_url() ?>admin"><i class="fa-home"></i>首页</a></li>
              <li><a href="<?php echo base_url() ?>admin/article_list">文章管理</a></li>
              <li class="active"><strong>文章作者编辑</strong></li>
            </ol>
                
        </div>
          
      </div>
      <!-- Table Styles -->
      <div class="row">
        <div class="col-md-12">
        
          <div class="panel panel-default">
            
            <div class="panel-body">
                <form role="form" class="form-horizontal" id="sForm">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">作者名称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="author_name" id="author_name" required="required" placeholder="请输入作者名称" value="<?php if(isset($author)){ echo $author->author_name; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">座右铭</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="author_motto" id="author_motto" required="required" placeholder="请输入座右铭" value="<?php if(isset($author)){ echo $author->author_motto; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">作者头像</label>
                        <div class="col-sm-10">
                            <div id="advancedDropzone" class="droppable-area">
                              Drop Files Here
                            </div>
                            <input type="hidden" name="figure_path" id="figure_path" value="<?php if(isset($author)){ echo $author->figure_path; } ?>">
                            <?php if(isset($author)){ echo '<img id="figure_path_preview" src="'.$author->figure_path.'" width="150" height="150" class="ml20" />'; } ?>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="button" class="btn btn-orange" id="submitBtn" onclick="form_submit()" value="提交">
                            <a href="<?php echo base_url() ?>admin/article_author_list" class="btn btn-white btn-sm ">返回</a>
                        </div>
                    </div>
                    <input type="hidden" name="author_id" value="<?php if(isset($author)){ echo $author->author_id; } ?>">
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
<script src="/htdocs/admin/js/dropzone/dropzone.min.js?<?php echo CACHE_TIME; ?>"></script>
<script type="text/javascript">
function form_submit(){
    if($("#author_name").val() == ""){
        toastr.error("作者名称不能为空");
        return;
    }
    if($("#author_figure").val() == ""){
        toastr.error("作者头像不能为空");
        return;
    }
    
    $("#sForm").ajaxForm({
        url:'/admin/Index_controller/article_author_update_do',
        type:'post',
        dataType:'json',
        beforeSubmit:function () {
        },
        success:function (data) {
            if(data.state == "success"){
                location.href = '<?php echo base_url() ?>admin/article_author_list';
            }else{
                toastr.error(data.msg);
            }
        },
        error:function(jqXHR, textStatus, errorThrown){
            toastr.error("程序异常："+errorThrown+"<br>请联系管理员");
        }
    }).submit();
}
$(function(){
    $("#advancedDropzone").dropzone({
        url: '<?php echo base_url() ?>admin/Index_controller/upload_authorFigure',
        maxFiles: 1,
        maxFilesize: 5,
        acceptedFiles: ".jpeg,.jpg,.gif,.png,.JPEG,.JPG,.GIF,.PNG",
        success: function(file,res){
            var result = eval('('+res+')');
            if(result.state == 'success'){
                $("#figure_path").val(result.url);
                if($("#figure_path_preview").length == 1){
                    $("#figure_path_preview").attr("src",result.url);
                }else{
                    $("#advancedDropzone").after('<img id="figure_path_preview" src="'+result.url+'" width="150" height="150" class="ml20" />');
                }
            }else{
                toastr.error("上传失败");
            }
        },
        error: function(file,res){
            toastr.error("上传失败");
        },
        addedfile: function(file){}//阻止默认行为
    });
})
</script>
</body>
</html>