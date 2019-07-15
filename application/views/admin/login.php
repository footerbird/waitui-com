<!DOCTYPE html>
<html>
<head>
<?php include_once('templete/pub_head.php') ?>
</head>
<body class="page-body lockscreen-page">

  <div class="login-container">
  
    <div class="row">
    
      <div class="col-sm-7">
        <form role="form" action="<?php echo base_url() ?>admin/login" method="post" onsubmit="return admin_login()" id="lockscreen" class="lockcreen-form">
          
          <div class="user-thumb">
            <a href="<?php echo base_url() ?>admin/login">
              <img src="/htdocs/admin/images/logo-collapsed@2x.png" class="img-responsive img-circle" />
            </a>
          </div>
          
          <div class="form-group">
            <h3>欢迎登录外推网管理员后台!</h3>
            <p>Enter your username and password to access the admin.</p>
            
            <div class="input-group" style="width: 100%;">
              <input type="text" class="form-control input-dark" name="admin_name" id="admin_name" placeholder="用户名" />
            </div>
            <div class="input-group">
              <input type="password" class="form-control input-dark" name="admin_pwd" id="admin_pwd" placeholder="密码" />
              <span class="input-group-btn">
                <button type="submit" class="btn btn-primary">登录</button>
              </span>
            </div>
          </div>
          
        </form>
        
      </div>
      
    </div>
    
  </div>
  
  
  
<?php include_once('templete/pub_foot.php') ?>
<script type="text/javascript">
function admin_login(){
    if($("#admin_name").val() == ""){
        toastr.error("用户名不能为空");
        return false;
    }
    if($("#admin_pwd").val() == ""){
        toastr.error("密码不能为空");
        return false;
    }
    return true;
}
$(function(){
    
})
</script>
</body>
</html>