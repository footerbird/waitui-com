<div class="header">
    <div class="top-bar <?php if($this->module == 'home'){ echo 'top-bar-home'; } ?>">
        <div class="container after-cls">
            <a href="/" class="top-logo"></a>
            <div class="top-nav">
                <ul>
                    <li class="<?php if($this->module == 'home'){ echo 'cur'; } ?>"><a href="/">首页</a></li>
                    <li class="<?php if($this->module == 'article'){ echo 'cur'; } ?>"><a href="<?php echo base_url() ?>article_list.html">头条</a></li>
                    <li class="<?php if($this->module == 'mark'){ echo 'cur'; } ?>"><a href="<?php echo base_url() ?>mark_list.html">商标</a></li>
                    <li class="<?php if($this->module == 'domain'){ echo 'cur'; } ?>"><a href="<?php echo base_url() ?>domain_list.html">域名</a></li>
                    <li><a href="/">APP</a></li>
                </ul>
            </div>
            <div class="top-nav fl-r">
                <ul>
                    <?php if(empty($userinfo)){ ?>
                    <li><a href="javascript:;" onclick="func_upwin_login()">免费品牌推广</a></li>
                    <li><a href="/">W币交易中心</a></li>
                    <li><a href="javascript:;" onclick="func_upwin_register()" class="to-register">注册</a></li>
                    <li class="split"><a href="javascript:;">|</a></li>
                    <li class="mr0"><a href="javascript:;" onclick="func_upwin_login()" class="to-login">登录</a></li>
                    <?php }else{ ?>
                    <li class="nav-account margin0"><a href="<?php echo base_url() ?>my_account">管理中心</a>
                        <div class="dropdown-menu">
                            <dl>
                                <dt><a href="<?php echo base_url() ?>my_account">
                                    <?php if(empty($userinfo->user_figure)){ ?>
                                    <img class="figure" src="<?php echo CDN_URL; ?>logo.png" />
                                    <?php }else{ ?>
                                    <img class="figure" src="<?php echo $userinfo->user_figure; ?>" />
                                    <?php } ?>
                                    <?php echo $userinfo->user_name; ?>
                                    </a>
                                </dt>
                                <dd><a href="/">免费品牌推广</a></dd>
                                <dd><a href="/">W币交易中心</a></dd>
                                <dd><a href="<?php echo base_url() ?>login_out">退出</a></dd>
                            </dl>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
