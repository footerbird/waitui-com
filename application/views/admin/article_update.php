<!DOCTYPE html>
<html>
<head>
<?php include_once('templete/pub_head.php') ?>
<link rel="stylesheet" href="/htdocs/admin/js/dropzone/css/dropzone.css?<?php echo CACHE_TIME; ?>">
<style type="text/css">
/*编辑器优化*/
.wang-editor {
  height: 345px;
}
.wang-editor .w-e-toolbar {
  background-color: #fff !important;
  padding: 9px 3px;
  border-color: #d1dde6 !important;
  border-bottom: 1px solid #f3f3f3 !important;
}
.wang-editor .w-e-text-container {
  border-color: #d1dde6 !important;
}
/*美化滚动条*/
.wang-editor .w-e-text::-webkit-scrollbar-track-piece {
  background-color: #fff;
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
}
.wang-editor .w-e-text::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}
.wang-editor .w-e-text::-webkit-scrollbar-thumb {
  height: 50px;
  background-color: #d1d4db;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
}
.wang-editor .w-e-text::-webkit-scrollbar-thumb:hover {
  height: 50px;
  background-color: #bfc1c9;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
}
</style>
</head>
<body class="page-body">

  <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
      
    <?php include_once('templete/sidebar.php') ?>
    
    <div class="main-content">
      
      <?php include_once('templete/navbar.php') ?>
      
      <div class="page-title">
        
        <div class="title-env">
          <h1 class="title">资讯编辑</h1>
        </div>
        
          <div class="breadcrumb-env">
          
            <ol class="breadcrumb bc-1">
              <li><a href="<?php echo base_url() ?>admin"><i class="fa-home"></i>首页</a></li>
              <li><a href="<?php echo base_url() ?>admin/article_list">资讯管理</a></li>
              <li class="active"><strong>资讯编辑</strong></li>
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
                        <label class="col-sm-2 control-label">文章标题</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="article_title" id="article_title" required="required" placeholder="请输入文章标题" value="<?php if(isset($article)){ echo $article->article_title; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">缩略图</label>
                        <div class="col-sm-10">
                            <div id="advancedDropzone" class="droppable-area">
                              Drop Files Here
                            </div>
                            <input type="hidden" name="thumb_path" id="thumb_path" value="<?php if(isset($article)){ echo $article->thumb_path; } ?>">
                            <?php if(isset($article)){ echo '<img id="thumb_path_preview" src="'.$article->thumb_path.'" width="220" height="140" class="ml20" />'; } ?>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">作者</label>
                        <div class="col-sm-2">
                            <select class="form-control" name="author_id" id="author_id">
                                <?php foreach ($author_list as $author){ ?>
                                <option value="<?php echo $author->author_id; ?>" <?php if(isset($article) && ($article->author_id == $author->author_id)){ echo 'selected'; } ?> ><?php echo $author->author_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">文章类型</label>
                        <div class="col-sm-2">
                            <select class="form-control" name="article_category" id="article_category">
                                <?php foreach ($category_list as $category){ ?>
                                <option value="<?php echo $category->category_type; ?>" <?php if(isset($article) && ($article->article_category == $category->category_type)){ echo 'selected'; } ?> ><?php echo $category->category_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">文章标签</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="article_tag" id="article_tag" required="required" placeholder="请输入文章标签，用、隔开" value="<?php if(isset($article)){ echo $article->article_tag; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">文章导语</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" name="article_lead" id="article_lead" placeholder="请输入文章导语"><?php if(isset($article)){ echo $article->article_lead; } ?></textarea>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">文章内容</label>
                        <div class="col-sm-10">
                            <div id="editor" class="wang-editor">
                                <?php if(isset($article)){ echo $article->article_content; } ?>
                            </div>
                            <textarea name="article_content" id="article_content" style="display: none;">
                                <?php if(isset($article)){ echo $article->article_content; } ?>
                            </textarea>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">是否发布</label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <input name="status" type="radio" value="active" <?php if(!isset($article) || $article->status == 'active'){ echo 'checked="checked"'; } ?>>
                                是
                            </label>
                            <label class="radio-inline">
                                <input name="status" type="radio" value="inactive" <?php if(isset($article) && $article->status == 'inactive'){ echo 'checked="checked"'; } ?>>
                                否
                            </label>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="button" class="btn btn-orange" id="submitBtn" onclick="form_submit()" value="提交">
                            <a href="<?php echo base_url() ?>admin/article_list" class="btn btn-white btn-sm ">返回</a>
                        </div>
                    </div>
                    <input type="hidden" name="article_id" value="<?php if(isset($article)){ echo $article->article_id; } ?>">
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
<!-- 注意， 只需要引用 JS，无需引用任何 CSS ！！！-->
<script src="/htdocs/admin/js/wangEditor.min.js?<?php echo CACHE_TIME; ?>"></script>
<script type="text/javascript">
var E = window.wangEditor
var editor = new E('#editor')
// 或者 var editor = new E( document.getElementById('editor') )
// 配置服务器端地址
editor.customConfig.uploadImgServer = '<?php echo base_url() ?>admin/Article_controller/upload_articleImage'
editor.customConfig.zIndex = 10
// 将图片大小限制为 3M
editor.customConfig.uploadImgMaxSize = 3 * 1024 * 1024
// 限制一次最多上传 1 张图片
editor.customConfig.uploadImgMaxLength = 1
// 自定义 fileName
editor.customConfig.uploadFileName = 'file'
editor.create()

function form_submit(){
    if($("#article_title").val() == ""){
        toastr.error("文章标题不能为空");
        return;
    }
    if($("#thumb_path").val() == ""){
        toastr.error("文章缩略图不能为空");
        return;
    }
    if($("#author_id").val() == ""){
        toastr.error("文章作者不能为空");
        return;
    }
    if($("#article_category").val() == ""){
        toastr.error("文章类型不能为空");
        return;
    }
    if($("#article_tag").val() == ""){
        toastr.error("文章标签不能为空");
        return;
    }
    
    if($("#article_lead").val() == ""){
        toastr.error("文章导语不能为空");
        return;
    }
    
    $("#article_content").val(editor.txt.html());
    if($("#article_content").val() == ""){
        toastr.error("文章内容不能为空");
        return;
    }
    
    $("#sForm").ajaxForm({
        url:'/admin/Article_controller/article_update_do',
        type:'post',
        dataType:'json',
        beforeSubmit:function () {
        },
        success:function (data) {
            if(data.state == "success"){
                location.href = '<?php echo base_url() ?>admin/article_list';
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
        url: '<?php echo base_url() ?>admin/Article_controller/upload_articleThumb',
        //maxFiles: 1,//这里设置 Dropzone 最多可以处理多少文件，该文件数量指的是多次上传文件的总和,超出就会报error
        maxFilesize: 5,
        acceptedFiles: ".jpeg,.jpg,.gif,.png,.JPEG,.JPG,.GIF,.PNG",
        success: function(file,res){
            var result = eval('('+res+')');
            if(result.state == 'success'){
                $("#thumb_path").val(result.url);
                if($("#thumb_path_preview").length == 1){
                    $("#thumb_path_preview").attr("src",result.url);
                }else{
                    $("#advancedDropzone").after('<img id="thumb_path_preview" src="'+result.url+'" width="220" height="140" class="ml20" />');
                }
            }else{
                toastr.error("上传失败，请重试");
            }
        },
        error: function(file,res){
            toastr.error("上传失败，请重试");
        },
        addedfile: function(file){}//阻止默认行为
    });
})
</script>
</body>
</html>