<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once(VIEWPATH.'waitui/templete/pub_head.php') ?>
    </head>
    
    <body>
    
    <?php include_once(VIEWPATH.'waitui/templete/my_menubar.php') ?>
    
    <div class="my-container pt30">
        <?php include_once(VIEWPATH.'waitui/templete/my_leftmenu.php') ?>
        <div class="my-mainpanel my-mainpanel-console">
            <div class="my-console">
                <div class="console-left">
                    <div class="console-panel pb15 mb30">
                        <div class="panel-title f16 mt0 mb20"><?php echo $userinfo->user_name; ?>，您好！
                            <a href="<?php echo base_url() ?>my_account" class="f12 col-blue">修改资料</a>
                            <span class="f12 col-gray9 fl-r">最近登录&nbsp;<?php echo $login_list[1]->login_time; ?></span>
                        </div>
                        
                        <?php if(!empty($company_certify)){ ?>
                        <table class="my-table" width="100%">
                            <thead style="background-color: #f6f6f6;">
                                <tr>
                                    <th align="left" colspan="2" class="pl30 f16"><?php echo $company_certify->company_name; ?>
                                        <?php if($company_certify->status == 'failed'){ ?>
                                        <span class="col-warn f12">（认证失败）</span><a href="<?php echo base_url() ?>certify_list" class="fl-r f12 col-blue mt3">重新认证</a>
                                        <?php }elseif($company_certify->status == 'wait'){ ?>
                                        <span class="col-gray9 f12">（认证中）</span>
                                        <?php }else{ ?>
                                        <span class="col-green f12">（已认证）</span>
                                        <?php } ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="20%" class="pl30">类型</td>
                                    <td width="80%"><?php echo empty($company_certify->econ_kind)?'-':$company_certify->econ_kind; ?></td>
                                </tr>
                                <tr>
                                    <td width="20%" class="pl30">住所</td>
                                    <td width="80%"><?php echo empty($company_certify->address)?'-':$company_certify->address; ?></td>
                                </tr>
                                <tr>
                                    <td width="20%" class="pl30">法定代表人</td>
                                    <td width="80%"><?php echo empty($company_certify->oper_name)?'-':$company_certify->oper_name; ?></td>
                                </tr>
                                <tr>
                                    <td width="20%" class="pl30">注册资本</td>
                                    <td width="80%"><?php echo empty($company_certify->regist_capi)?'-':$company_certify->regist_capi; ?></td>
                                </tr>
                                <tr>
                                    <td width="20%" class="pl30">成立日期</td>
                                    <td width="80%"><?php echo empty($company_certify->start_date)?'-':date('Y-m-d',strtotime($company_certify->start_date)); ?></td>
                                </tr>
                                <tr>
                                    <td width="20%" class="pl30">营业期限</td>
                                    <td width="80%"><?php echo empty($company_certify->business_term)?'-':$company_certify->business_term; ?></td>
                                </tr>
                                <tr>
                                    <td width="20%" class="pl30">经营范围</td>
                                    <td width="80%">
                                        <div style="height: 44px; overflow: hidden;"><?php echo empty($company_certify->scope)?'-':$company_certify->scope; ?></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="h15"></div>
                        <?php }else{ ?>
                        <div>
                            <p class="ta-c f18 col-my pt50 pb30">您尚未进行公司认证</p>
                            <p class="ta-c"><img src="/htdocs/waitui/images/console-certify.png"></p>
                            <p class="ta-c f14 col-gray9 lh28 pt30">
                              您好，进行公司认证，可帮助我们更好的管理您的品牌资产，<br>树立良好的企业形象、打造品牌优势、发展品牌战略
                            </p>
                            <p class="ta-c pt30 pb22">
                                <a href="<?php echo base_url() ?>company_certify" class="pub-btn w180">立即认证</a>
                            </p>
                        </div>
                        <?php } ?>
                    </div>
                    
                    <div class="console-panel pb15 mb30">
                        <div class="panel-title mt0 mb20">我的订单
                            <a href="<?php echo base_url() ?>my_order" class="fl-r f12 col-blue">MORE&raquo;</a>
                        </div>
                        <table class="my-table" width="100%">
                            <thead>
                                <tr>
                                    <th align="left" class="pl30">订单编号</th>
                                    <th align="left">订单类型</th>
                                    <th align="left">订单内容</th>
                                    <th align="left">订单金额</th>
                                    <th align="right" class="pr30">状态</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pl30">19052200001</td>
                                    <td>域名注册</td>
                                    <td>hzwt.com.cn注册1年</td>
                                    <td>98元</td>
                                    <td align="right" class="pr30">
                                        <p><a href="" class="col-warn" title="点击查看">支付</a></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl30">19052200002</td>
                                    <td>域名续费</td>
                                    <td>waitui.com.cn续费3年</td>
                                    <td>294元</td>
                                    <td align="right" class="pr30">
                                        <p><a href="" class="col-warn" title="点击查看">支付</a></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pl30">19052200003</td>
                                    <td>域名求购</td>
                                    <td>waitui.com委托购买</td>
                                    <td>50,000元</td>
                                    <td align="right" class="pr30">
                                        <p><a href="" class="col-warn" title="点击查看">支付</a></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="h5"></div>
                    </div>
                    
                    <div class="console-panel pb15 mb30">
                        <div class="panel-title mt0 mb20">我的域名
                            <a href="<?php echo base_url() ?>my_domain" class="fl-r f12 col-blue">MORE&raquo;</a>
                        </div>
                        <table class="my-table" width="100%">
                            <thead>
                                <tr>
                                    <th align="left" class="pl30">域名</th>
                                    <th align="left">注册时间</th>
                                    <th align="left">过期时间</th>
                                    <th align="left">状态</th>
                                    <th align="right" class="pr30"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($domain_list) != 0){ ?>
                                    <?php foreach ($domain_list as $domain){ ?>
                                    <tr>
                                        <td class="f14 pl30"><?php echo $domain->domain_name; ?></td>
                                        <td><?php echo date('Y-m-d',strtotime($domain->created_date)); ?></td>
                                        <td><?php echo date('Y-m-d',strtotime($domain->expired_date)); ?></td>
                                        <td>
                                            <?php 
                                                if((int)$domain->expired_distance > 30){
                                                    echo '<span class="col-green">正常</span>';
                                                }elseif((int)$domain->expired_distance >= 0){
                                                    echo '<span class="col-warn">即将过期</span>';
                                                }else{
                                                    echo '<span class="col-gray9">已过期</span>';
                                                }
                                             ?>
                                        </td>
                                        <td align="right" class="pr30">
                                            <?php if((int)$domain->expired_distance > 30){ ?>
                                                <a href="javascript:;" class="ml10">续费</a>
                                                <a href="javascript:;" class="ml10" onclick="contactAdmin()">解析</a>
                                                <a href="javascript:;" class="ml10" onclick="contactAdmin()">转出</a>
                                            <?php }elseif((int)$domain->expired_distance >= 0){ ?>
                                                <a href="javascript:;" class="ml10">续费</a>
                                            <?php }else{ ?>
                                                <a href="javascript:;" class="ml10" onclick="contactAdmin()">购买</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <tr>
                                        <td colspan="5" class="pl30 pr30">
                                            <p class="ta-c"><img src="/htdocs/waitui/images/console-certify.png"></p>
                                            <p class="ta-c f14 col-gray9 lh28 pt30">
                                              暂无域名，您可以联系您的专属<a href="javascript:;" class="ml10 mr10" onclick="contactAdmin()">品牌管家</a>来注册和求购您心仪的域名
                                            </p>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="h5"></div>
                    </div>
                    
                    <div class="console-panel pb15 mb30">
                        <div class="panel-title mt0 mb20">我的商标
                            <a href="<?php echo base_url() ?>my_mark" class="fl-r f12 col-blue">MORE&raquo;</a>
                        </div>
                        <table class="my-table" width="100%">
                            <thead>
                                <tr>
                                    <th align="left" class="pl30">商标</th>
                                    <th align="left">注册号</th>
                                    <th align="left">使用期限</th>
                                    <th align="left">状态</th>
                                    <th align="right" class="pr30"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($mark_list) != 0){ ?>
                                    <?php foreach ($mark_list as $mark){ ?>
                                    <tr>
                                        <td class="f14 pl15">
                                            <a class="after-cls" href="<?php echo base_url() ?>mark_detail/<?php echo $mark->regno_md; ?>.html" target="_blank" title="<?php echo $mark->mark_name; ?>">
                                                <img class="thumb fl-l" src="<?php echo $mark->image_path; ?>" width="60" height="60" />
                                                <span class="fl-l ml20 mt20">[<?php echo $mark->mark_category<10?'0'.$mark->mark_category:$mark->mark_category; ?>&nbsp;&nbsp;<?php echo $mark->category_name; ?>]</span>
                                            </a>
                                        </td>
                                        <td><?php echo $mark->mark_regno; ?></td>
                                        <td><?php echo $mark->private_limit; ?></td>
                                        <td><?php echo $mark->mark_status; ?></td>
                                        <td align="right" class="pr30">
                                            <a class="ml10" href="<?php echo base_url() ?>mark_detail/<?php echo $mark->regno_md; ?>.html" target="_blank">查看</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <tr>
                                        <td colspan="5" class="pl30 pr30">
                                            <p class="ta-c"><img src="/htdocs/waitui/images/console-certify.png"></p>
                                            <p class="ta-c f14 col-gray9 lh28 pt30">
                                              暂无商标，您可以联系您的专属<a href="javascript:;" class="ml10 mr10" onclick="contactAdmin()">品牌管家</a>来注册和求购您心仪的商标
                                            </p>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="h5"></div>
                    </div>
                    
                </div>
                <div class="console-right">
                    
                    <div class="console-panel pb15 mb30">
                        <div class="panel-title mt0 mb20">待办事项</div>
                        <table class="todo-table" width="100%">
                            <tbody>
                                <tr class="lh28">
                                    <td align="center" width="33%">
                                        <p><a href="<?php echo base_url() ?>my_message?status=unread" class="f20 col-base"><?php echo $unreadCount; ?></a></p>
                                        <p class="f14">未读消息</p>
                                    </td>
                                    <td align="center" width="33%">
                                        <p><a href="<?php echo base_url() ?>my_order" class="f20 col-base">3</a></p>
                                        <p class="f14">未处理订单</p>
                                    </td>
                                    <td align="center" width="33%">
                                        <p><a href="<?php echo base_url() ?>my_coupon" class="f20 col-base">0</a></p>
                                        <p class="f14">可用优惠券</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <?php if(!empty($user_butler)){ ?>
                    <div class="console-panel pb15 mb30">
                        <div class="panel-title mt0 mb20">您好，我是品牌管家-<?php echo $user_butler->butler_name; ?><i class="butler ml5"></i></div>
                        <p class="ta-c f14 lh28 pb15">电话：<font class="col-blue"><?php echo $user_butler->butler_phone; ?></font>&nbsp;&nbsp;&nbsp;&nbsp;QQ：<font class="col-blue"><?php echo $user_butler->butler_qq; ?></font></p>
                        <p class="ta-c pb15">
                            <img src="<?php echo $user_butler->butler_wechat; ?>" width="144" height="144" />
                        </p>
                        <p class="ta-c f14 col-gray9 lh28">扫描二维码添加品牌管家好友</p>
                    </div>
                    <?php } ?>
                    
                    <div class="console-flash mb30">
                        <div class="panel-title mt0 mb20">24小时快讯</div>
                        <div class="flash">
                            <?php foreach ($flash_list as $flash){ ?>
                            <div class="flash-item">
                                <a href="javascript:;"><?php echo $flash->flash_title; ?></a>
                                <div><?php echo $flash->flash_content; ?></div>
                                <p><?php echo $flash->create_time; ?></p>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <div class="console-swiper mb30">
                        <div class="swiper-container swiper" id="article_swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <a href="javascript:;">
                                        <img src="<?php echo CDN_URL; ?>welfare/welfare_banner_1.jpg" />
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="javascript:;">
                                        <img src="<?php echo CDN_URL; ?>welfare/welfare_banner_2.jpg" />
                                    </a>
                                </div>
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination"></div>
                            <!-- 如果需要导航按钮 -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
    <?php include_once(VIEWPATH.'waitui/templete/my_foot.php') ?>
    
    <script type="text/javascript">
    $(function(){
        
        scrollTop("ico_top");//返回顶部
        
        var mySwiper = new Swiper ('#article_swiper', {
            loop : true,
            autoplay: {
                delay: 8000,//8秒切换一次
            },
            pagination: {
                el: '.swiper-pagination',
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            }
        })
        
        $(".flash-item a").on("click",function(){
            $(this).parent().toggleClass("active");
            $(this).siblings("div").slideToggle();
        })
        
    })
    </script>
    </body>
</html>
