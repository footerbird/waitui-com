<!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
<!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
<!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
<div class="sidebar-menu toggle-others fixed">
  
  <div class="sidebar-menu-inner">  
    
    <header class="logo-env">
      
      <!-- logo -->
      <div class="logo">
        <a href="<?php echo base_url() ?>admin/table" class="logo-expanded">
          <img src="/htdocs/admin/images/logo@2x.png?<?php echo CACHE_TIME; ?>" width="80" alt="" />
        </a>
        
        <a href="<?php echo base_url() ?>admin/table" class="logo-collapsed">
          <img src="/htdocs/admin/images/logo-collapsed@2x.png?<?php echo CACHE_TIME; ?>" width="40" alt="" />
        </a>
      </div>
      
      <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
      <div class="mobile-menu-toggle visible-xs">
        <a href="#" data-toggle="mobile-menu">
          <i class="fa-bars"></i>
        </a>
      </div>
      
    </header>
        
    
        
    <ul id="main-menu" class="main-menu">
      <!-- add class "multiple-expanded" to allow multiple submenus to open -->
      <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
      <li class="<?php if($this->module == 'console'){ echo 'active'; } ?>">
        <a href="<?php echo base_url() ?>admin">
          <i class="linecons-desktop"></i>
          <span class="title">控制台</span>
        </a>
      </li>
      <li class="<?php if($this->module == 'admin'){ echo 'active'; } ?>">
        <a href="<?php echo base_url() ?>admin/admin_list">
          <i class="linecons-star"></i>
          <span class="title">管理员管理</span>
        </a>
      </li>
      <li class="<?php if($this->module == 'butler'){ echo 'active'; } ?>">
        <a href="<?php echo base_url() ?>admin/butler_list">
          <i class="linecons-star"></i>
          <span class="title">品牌管家管理</span>
        </a>
      </li>
      <li class="<?php if($this->module == 'user'){ echo 'active opened'; } ?>">
        <a href="<?php echo base_url() ?>admin/user_list">
          <i class="linecons-star"></i>
          <span class="title">会员管理</span>
        </a>
        <ul>
          <li class="<?php if($this->sub_menu == 'user'){ echo 'active'; } ?>">
            <a href="<?php echo base_url() ?>admin/user_list">
              <span class="title">会员列表</span>
            </a>
          </li>
          <li class="<?php if($this->sub_menu == 'company_certify'){ echo 'active'; } ?>">
            <a href="<?php echo base_url() ?>admin/company_certify_list">
              <span class="title">公司认证列表</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="<?php if($this->module == 'domain'){ echo 'active'; } ?>">
        <a href="<?php echo base_url() ?>admin/domain_list">
          <i class="linecons-star"></i>
          <span class="title">出售域名管理</span>
        </a>
      </li>
    </ul>
        
  </div>
  
</div>