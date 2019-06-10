<div class="header my-header">
    <div class="top-bar">
        <div class="container after-cls">
            <a href="/" class="top-logo"></a>
            <div class="top-nav fl-r">
                <ul>
                    <li class="nav-account margin0">
                        <a href="<?php echo base_url() ?>my_account">
                            <?php if(empty($userinfo->user_figure)){ ?>
                            <img class="figure" src="<?php echo CDN_URL; ?>logo.png" />
                            <?php }else{ ?>
                            <img class="figure" src="<?php echo $userinfo->user_figure; ?>" />
                            <?php } ?>
                            <i class="arrow"></i>
                        </a>
                        <div class="dropdown-menu">
                            <dl>
                                <dt class="pl15 pr15"><a href="<?php echo base_url() ?>my_account"><?php echo $userinfo->user_name; ?></a></dt>
                                <dd><a href="/">免费品牌推广</a></dd>
                                <dd><a href="/">W币交易中心</a></dd>
                                <dd><a href="<?php echo base_url() ?>login_out">退出</a></dd>
                            </dl>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
