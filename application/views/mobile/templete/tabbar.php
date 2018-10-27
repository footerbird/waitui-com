<div class="footer">
    <div class="footer-container <?php if($this->router->fetch_class() == "Index_controller" && $this->router->fetch_method() == 'index'){ echo 'footer-container-index'; } ?>">
        <a href="<?php echo base_url() ?>m/" target="_parent" class="item <?php if($this->router->fetch_method() == 'index'){ echo 'cur'; } ?>">首页</a>
        <a href="<?php echo base_url() ?>m/article_list.html" target="_parent" class="item <?php if($this->router->fetch_method() == 'article_list'){ echo 'cur'; } ?>">头条</a>
        <a href="<?php echo base_url() ?>m/welfare_list.html" target="_parent" class="item <?php if($this->router->fetch_method() == 'welfare_list'){ echo 'cur'; } ?>">发现</a>
        <?php if(empty($userinfo)){ ?>
        <a href="javascript:;" class="item" onclick='$("#pop_login").popup();'>我的</a>
        <?php }else{ ?>
        <a href="<?php echo base_url() ?>m/account.html" target="_parent" class="item <?php if($this->router->fetch_method() == 'account'){ echo 'cur'; } ?>">我的</a>
        <?php } ?>
    </div>
</div>
