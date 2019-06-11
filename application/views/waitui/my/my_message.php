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
            <div class="panel-title mb20">我的消息</div>
            <div class="my-table-filter after-cls">
                <input type="text" placeholder="输入消息内容" class="fl-l mr10" />
                <a href="javascript:;" class="pub-btn fl-l">搜索</a>
                <div class="fl-r">
                    <a href="<?php echo base_url() ?>my_message" class="ml20">全部<span class="col-warn">（2）</span></a>
                    <a href="<?php echo base_url() ?>my_message" class="ml20">未读<span class="col-warn">（1）</span></a>
                    <a href="<?php echo base_url() ?>my_message" class="ml20">已读<span class="col-warn">（1）</span></a>
                    <a href="<?php echo base_url() ?>my_message" class="ml20">垃圾箱<span class="col-warn">（0）</span></a>
                </div>
            </div>
            <table class="my-table" width="100%">
                <thead>
                    <tr>
                        <th align="center" width="44">
                            <label><input type="checkbox" class="check-all" /><i></i></label>
                        </th>
                        <th align="left">消息摘要</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td align="center">
                            <label><input type="checkbox" name="message" /><i></i></label>
                        </td>
                        <td>
                            <p><a href="javascript:;" class="f14 col-default user-message-title"><i class="badge mr5"></i>2019年外推网五一劳动节放假公告</a></p>
                            <p class="f12 col-gray9 user-message-content" style="display: none;">您好！根据国家法定节假日并结合实际情况，外推网2019年五一劳动节假期安排如下：2019年5月1日至5月4日放假，假期共4天。假日期间，官网将暂停相关服务工作，感谢您一直以来对官网的关注和支持！</p>
                            <p class="f12 col-gray6">2019-01-09 10:00:00</p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <label><input type="checkbox" name="message" /><i></i></label>
                        </td>
                        <td>
                            <p><a href="javascript:;" class="f14 col-default user-message-title"></i>2019年外推网清明节放假公告</a></p>
                            <p class="f12 col-gray9 user-message-content" style="display: none;">您好！根据国家法定节假日并结合实际情况，外推网2019年清明节假期安排如下：2019年5月1日至5月4日放假，假期共4天。假日期间，官网将暂停相关服务工作，感谢您一直以来对官网的关注和支持！</p>
                            <p class="f12 col-gray6">2019-01-09 10:00:00</p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <label><input type="checkbox" class="check-all" /><i></i></label>
                        </td>
                        <td>
                            <a href="javascript:;" class="f14 mr10">批量已读</a>
                            <a href="javascript:;" class="f14 mr10">批量删除</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <?php include_once(VIEWPATH.'waitui/templete/my_foot.php') ?>
    
    <script type="text/javascript">
    $(function(){
        
        scrollTop("ico_top");//返回顶部
        
        $(".check-all").on("click",function(){
            $("input[name='message']").prop("checked", this.checked);
            $(".check-all").prop("checked", this.checked);
        })
        $("input[name='message']").on("click",function(){
            var $message = $("input[name='message']");
            $(".check-all").prop("checked", $message.length == $message.filter(":checked").length? true : false);
        })
        
        $(".user-message-title").on("click",function(){
            $(this).find(".badge").remove();
            var $content = $(this).parents("td").find(".user-message-content");
            if($content.length == 1){
                $content.toggle();
            }
        })
        
    })
    </script>
    </body>
</html>
