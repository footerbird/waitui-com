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
                <div class="fl-r">
                    <a href="<?php echo base_url() ?>my_message" class="ml20 <?php if(empty($status)){ echo 'fb'; } ?>">全部<span class="col-warn fn">（<?php echo $allCount; ?>）</span></a>
                    <a href="<?php echo base_url() ?>my_message?status=unread" class="ml20 <?php if($status == 'unread'){ echo 'fb'; } ?>">未读<span class="col-warn fn">（<?php echo $unreadCount; ?>）</span></a>
                    <a href="<?php echo base_url() ?>my_message?status=read" class="ml20 <?php if($status == 'read'){ echo 'fb'; } ?>">已读<span class="col-warn fn">（<?php echo $readCount; ?>）</span></a>
                    <a href="<?php echo base_url() ?>my_message?status=del" class="ml20 <?php if($status == 'del'){ echo 'fb'; } ?>">垃圾箱<span class="col-warn fn">（<?php echo $delCount; ?>）</span></a>
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
                    <?php if(count($message_list) != 0){ ?>
                        <?php foreach ($message_list as $message){ ?>
                        <tr>
                            <td align="center">
                                <label><input type="checkbox" name="message" value="<?php echo $message->msg_id; ?>" /><i></i></label>
                            </td>
                            <td>
                                <p><a href="javascript:;" class="f14 user-message-title" data-message="<?php echo $message->msg_id; ?>"><?php if($message->status == 'unread'){ echo '<i class="badge mr5"></i>'; } ?><?php echo $message->msg_title; ?></a></p>
                                <p class="f12 col-gray9 user-message-content" style="display: none;"><?php echo $message->msg_content; ?></p>
                                <p class="f12 col-gray6"><?php echo $message->create_time; ?></p>
                            </td>
                        </tr>
                        <?php } ?>
                    <?php }else{ ?>
                        <tr>
                            <td align="center">&nbsp;</td>
                            <td>暂无消息</td>
                        </tr>
                    <?php } ?>
                    <?php if(count($message_list) != 0){ ?>
                    <tr>
                        <td align="center">
                            <label><input type="checkbox" class="check-all" /><i></i></label>
                        </td>
                        <td>
                            <?php if(empty($status) || $status == 'unread'){ ?>
                                <a href="javascript:;" class="f14 mr10 batchRead">批量已读</a>
                            <?php } ?>
                            <?php if($status != 'del'){ ?>
                                <a href="javascript:;" class="f14 mr10 batchDel">移到垃圾箱</a>
                            <?php } ?>
                            <?php if($status == 'del'){ ?>
                                <a href="javascript:;" class="f14 mr10 batchRoll">恢复</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
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
    function batchChangeStatus(msgid_arr,status,succCall,failCall){
        $.ajax({
            type:"post",
            url:"<?php echo base_url() ?>waitui/Index_controller/edit_myMessageStatusBatchAjax",
            async:true,
            data:{
                msgid_arr: msgid_arr,
                status: status
            },
            dataType:"json",
            success:function(data){
                if(data.state == 'success'){
                    succCall(data);
                }else{
                    failCall(data);
                }
            }
        });
    }
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
            if($(this).find(".badge").length != 0){
                var msgid_arr = [];
                msgid_arr.push($(this).data("message"));
                batchChangeStatus(msgid_arr,'read',function(){},function(){});
            }
            $(this).find(".badge").remove();
            var $content = $(this).parents("td").find(".user-message-content");
            if($content.length == 1){
                $content.toggle();
            }
        })
        
        $(".batchRead").on("click",function(){
            var msgid_arr = [];
            var $checked = $("input[name='message']:checked");
            if($checked.length == 0){
                Pop.alert("未选择消息");
                return;
            }
            $checked.each(function(i){
                msgid_arr.push($checked.eq(i).val());
            })
            batchChangeStatus(msgid_arr,'read',function(){
                location.reload();
            },function(data){
                Pop.alert("操作失败，请重试",function(){
                    location.reload();
                });
            });
        })
        
        $(".batchDel").on("click",function(){
            var msgid_arr = [];
            var $checked = $("input[name='message']:checked");
            if($checked.length == 0){
                Pop.alert("未选择消息");
                return;
            }
            $checked.each(function(i){
                msgid_arr.push($checked.eq(i).val());
            })
            batchChangeStatus(msgid_arr,'del',function(){
                location.reload();
            },function(data){
                Pop.alert("操作失败，请重试",function(){
                    location.reload();
                });
            });
        })
        
        $(".batchRoll").on("click",function(){
            var msgid_arr = [];
            var $checked = $("input[name='message']:checked");
            if($checked.length == 0){
                Pop.alert("未选择消息");
                return;
            }
            $checked.each(function(i){
                msgid_arr.push($checked.eq(i).val());
            })
            batchChangeStatus(msgid_arr,'read',function(){
                location.reload();
            },function(data){
                Pop.alert("操作失败，请重试",function(){
                    location.reload();
                });
            });
        })
        
    })
    </script>
    </body>
</html>
