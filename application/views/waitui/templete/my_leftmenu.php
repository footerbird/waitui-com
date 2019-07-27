<div class="my-leftmenu">
    <ul>
        <li class="module-li"><a class="module module-home <?php if($this->leftmenu == 'my_console'){ echo 'cur'; } ?>" href="<?php echo base_url() ?>my_console"><span>控制台</span></a></li>
        <li class="module-li"><a class="module module-domain" href="<?php echo base_url() ?>my_domain"><i></i><span>域名管理</span></a>
            <ul>
                <li><a class="<?php if($this->leftmenu == 'my_domain'){ echo 'cur'; } ?>" href="<?php echo base_url() ?>my_domain"><span>我的域名</span></a></li>
            </ul>
        </li>
        <li class="module-li"><a class="module module-mark" href="<?php echo base_url() ?>my_mark"><i></i><span>商标管理</span></a>
            <ul>
                <li><a class="<?php if($this->leftmenu == 'my_mark'){ echo 'cur'; } ?>" href="<?php echo base_url() ?>my_mark"><span>我的商标</span></a></li>
                <!-- <li><a href="<?php echo base_url() ?>my_mark"><span>注册模板</span></a></li> -->
                <!-- <li><a href="<?php echo base_url() ?>my_account"><span>商标设计</span></a></li> -->
            </ul>
        </li>
        <li class="module-li"><a class="module module-order" href="<?php echo base_url() ?>my_order"><i></i><span>财务管理</span></a>
            <ul>
                <li><a class="<?php if($this->leftmenu == 'my_order'){ echo 'cur'; } ?>" href="<?php echo base_url() ?>my_order"><span>我的订单</span></a></li>
                <!-- <li><a class="<?php if($this->leftmenu == 'my_invoice'){ echo 'cur'; } ?>" href="<?php echo base_url() ?>my_invoice"><span>发票管理</span></a></li> -->
                <li><a class="<?php if($this->leftmenu == 'my_coupon'){ echo 'cur'; } ?>" href="<?php echo base_url() ?>my_coupon"><span>优惠券</span></a></li>
            </ul>
        </li>
        <li class="module-li"><a class="module module-account" href="<?php echo base_url() ?>my_account"><i></i><span>账户管理</span></a>
            <ul>
                <li><a class="<?php if($this->leftmenu == 'my_account'){ echo 'cur'; } ?>" href="<?php echo base_url() ?>my_account"><span>个人资料</span></a></li>
                <li><a class="<?php if($this->leftmenu == 'my_message'){ echo 'cur'; } ?>" href="<?php echo base_url() ?>my_message"><span>消息列表</span></a></li>
                <li><a class="<?php if($this->leftmenu == 'login_log'){ echo 'cur'; } ?>" href="<?php echo base_url() ?>login_log"><span>登录日志</span></a></li>
            </ul>
        </li>
    </ul>
</div>