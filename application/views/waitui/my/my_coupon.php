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
            <div class="panel-title mb20">优惠券</div>
            
            <div class="my-coupon">
                <div class="coupon-item">
                    <div class="box">
                        <div class="code">券码：67404420113</div>
                        <div class="price"><em>&yen;</em><font>50</font>优惠券</div>
                        <div class="limit">满99元可用</div>
                        <div class="range">全场通用</div>
                        <div class="time">2019.06.18-2019.07.20</div>
                    </div>
                </div>
                <div class="coupon-item">
                    <div class="box">
                        <div class="code">券码：67404420113</div>
                        <div class="price"><em>&yen;</em><font>50</font>优惠券</div>
                        <div class="limit">满99元可用</div>
                        <div class="range">仅限域名续费</div>
                        <div class="time">2019.06.18-2019.07.20</div>
                    </div>
                </div>
                <div class="coupon-item">
                    <div class="box">
                        <div class="code">券码：67404420113</div>
                        <div class="price"><em>&yen;</em><font>50</font>优惠券</div>
                        <div class="limit">满99元可用</div>
                        <div class="range">仅限域名注册</div>
                        <div class="time">2019.06.18-2019.07.20</div>
                    </div>
                </div>
                <div class="coupon-item">
                    <div class="box">
                        <div class="code">券码：67404420113</div>
                        <div class="price"><em>&yen;</em><font>500</font>优惠券</div>
                        <div class="limit">满5000元可用</div>
                        <div class="range">仅限域名求购</div>
                        <div class="time">2019.06.18-2019.07.20</div>
                    </div>
                </div>
                <div class="coupon-item">
                    <div class="box">
                        <div class="code">券码：67404420113</div>
                        <div class="price"><em>&yen;</em><font>50</font>优惠券</div>
                        <div class="limit">满99元可用</div>
                        <div class="range">仅限商标注册</div>
                        <div class="time">2019.06.18-2019.07.20</div>
                    </div>
                </div>
                <div class="coupon-item used">
                    <div class="box">
                        <div class="code">券码：67404420113</div>
                        <div class="price"><em>&yen;</em><font>50</font>优惠券</div>
                        <div class="limit">满99元可用</div>
                        <div class="range">仅限商标服务（非注册、求购）</div>
                        <div class="time">2019.06.18-2019.07.20</div>
                    </div>
                </div>
                <div class="coupon-item used">
                    <div class="box">
                        <div class="code">券码：67404420113</div>
                        <div class="price"><em>&yen;</em><font>50</font>优惠券</div>
                        <div class="limit">满99元可用</div>
                        <div class="range">仅限商标求购</div>
                        <div class="time">2019.06.18-2019.07.20</div>
                    </div>
                </div>
                <div class="coupon-item overdue">
                    <div class="box">
                        <div class="code">券码：67404420113</div>
                        <div class="price"><em>&yen;</em><font>50</font>优惠券</div>
                        <div class="limit">满99元可用</div>
                        <div class="range">全场通用</div>
                        <div class="time">2019.06.18-2019.07.20</div>
                    </div>
                </div>
                <div class="coupon-item overdue">
                    <div class="box">
                        <div class="code">券码：67404420113</div>
                        <div class="price"><em>&yen;</em><font>50</font>优惠券</div>
                        <div class="limit">满99元可用</div>
                        <div class="range">全场通用</div>
                        <div class="time">2019.06.18-2019.07.20</div>
                    </div>
                </div>
            </div>
            
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
