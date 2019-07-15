<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once(VIEWPATH.'waitui/templete/pub_head.php') ?>
    </head>
    
    <body>
    
    <?php include_once(VIEWPATH.'waitui/templete/my_menubar.php') ?>
    
    <div class="my-container pt30">
        <?php include_once(VIEWPATH.'waitui/templete/my_leftmenu.php') ?>
        <div class="my-mainpanel">
            <div class="panel-title mb20">我的订单</div>
            <div class="my-table-filter after-cls">
                <input type="text" placeholder="输入订单内容" class="fl-l mr10" />
                <a href="javascript:;" class="pub-btn fl-l mr10">搜索</a>
                <div class="fl-r">
                    <a href="<?php echo base_url() ?>my_order" class="ml20">全部<span class="col-warn">（360）</span></a>
                    <a href="<?php echo base_url() ?>my_order" class="ml20">域名<span class="col-warn">（195）</span></a>
                    <a href="<?php echo base_url() ?>my_order" class="ml20">商标<span class="col-warn">（165）</span></a>
                    <a href="<?php echo base_url() ?>my_order" class="ml20">其他<span class="col-warn">（0）</span></a>
                </div>
            </div>
            <table class="my-table" width="100%">
                <thead>
                    <tr>
                        <th align="left" width="15%" class="pl30">订单编号</th>
                        <th align="left" width="15%">订单类型</th>
                        <th align="left" width="35%">订单内容</th>
                        <th align="left" width="15%">订单金额</th>
                        <th align="right" width="20%" class="pr30">状态</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="pl30">19052200001</td>
                        <td>域名注册</td>
                        <td>hzwt.com.cn注册1年</td>
                        <td>98元</td>
                        <td align="right" class="pr30">
                            <p><a href="" title="点击查看">交易完成</a></p>
                            <p class="col-gray9">2019-08-30 13:09:19</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="pl30">19052200002</td>
                        <td>域名续费</td>
                        <td>waitui.com.cn续费3年</td>
                        <td>294元</td>
                        <td align="right" class="pr30">
                            <p><a href="" class="col-warn" title="点击查看">支付</a></p>
                            <p class="col-gray9">2019-08-30 13:09:19</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="pl30">19052200003</td>
                        <td>域名求购</td>
                        <td>waitui.com委托购买</td>
                        <td>50,000元</td>
                        <td align="right" class="pr30">
                            <p><a href="" class="col-warn" title="点击查看">支付</a></p>
                            <p class="col-gray9">2019-08-30 13:09:19</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="pl30">19052200003</td>
                        <td>域名求购</td>
                        <td>waitui.com委托购买</td>
                        <td>50,000元</td>
                        <td align="right" class="pr30">
                            <p><a href="" title="点击查看">交易取消</a></p>
                            <p class="col-gray9">2019-08-30 13:09:19</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="pl30">19052200003</td>
                        <td>域名求购</td>
                        <td>waitui.com委托购买</td>
                        <td>50,000元</td>
                        <td align="right" class="pr30">
                            <p><a href="" title="点击查看">交易失败</a></p>
                            <p class="col-gray9">2019-08-30 13:09:19</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="pl30">19052200004</td>
                        <td>商标注册</td>
                        <td>天妒</td>
                        <td>900元</td>
                        <td align="right" class="pr30">
                            <p><a href="" title="点击查看">交易完成</a></p>
                            <p class="col-gray9">2019-08-30 13:09:19</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="pl30">19052200005</td>
                        <td>商标注册</td>
                        <td>海纳百川及图</td>
                        <td>900元</td>
                        <td align="right" class="pr30">
                            <p><a href="" class="col-warn" title="点击查看">支付</a></p>
                            <p class="col-gray9">2019-08-30 13:09:19</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="pl30">19052200006</td>
                        <td>商标求购</td>
                        <td>一叶子[35类]委托购买</td>
                        <td>20,000元</td>
                        <td align="right" class="pr30">
                            <p><a href="" class="col-warn" title="点击查看">支付</a></p>
                            <p class="col-gray9">2019-08-30 13:09:19</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="pl30">19052200007</td>
                        <td>商标服务</td>
                        <td>DOPA[10138900]商标变更</td>
                        <td>800元</td>
                        <td align="right" class="pr30">
                            <p><a href="" title="点击查看">交易完成</a></p>
                            <p class="col-gray9">2019-08-30 13:09:19</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="pl30">19052200007</td>
                        <td>商标服务</td>
                        <td>DOPA[10138900]商标变更</td>
                        <td>800元</td>
                        <td align="right" class="pr30">
                            <p><a href="" title="点击查看">交易失败</a></p>
                            <p class="col-gray9">2019-08-30 13:09:19</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="route-pagination">
            <?php echo $this->pagination->create_links(); ?>
            <div class="total">共<font><?php echo $page_count; ?></font>条，每页显示<font><?php echo $page_size; ?></font>条</div>
            </div>
        </div>
    </div>
    
    <?php include_once(VIEWPATH.'waitui/templete/my_foot.php') ?>
    
    <script type="text/javascript">
    $(function(){
        
        scrollTop("ico_top");//返回顶部
        
    })
    </script>
    </body>
</html>
