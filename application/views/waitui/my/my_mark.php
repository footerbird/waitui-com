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
            <div class="panel-title mb20">我的商标</div>
            <div id="ajax_container">
                <table class="my-table" width="100%">
                    <thead>
                        <tr>
                            <th align="left" width="25%" class="pl30">商标</th>
                            <th align="left" width="15%">注册号</th>
                            <th align="left" width="20%">使用期限</th>
                            <th align="left" width="20%">状态</th>
                            <th align="right" width="20%" class="pr30"></th>
                        </tr>
                    </thead>
                    <tbody>
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
                            <td>商标已注册</td>
                            <td align="right" class="pr30">
                                <a class="ml10" href="<?php echo base_url() ?>mark_detail/<?php echo $mark->regno_md; ?>.html" target="_blank">查看</a>
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
    </div>
    
    <?php include_once(VIEWPATH.'waitui/templete/my_foot.php') ?>
    
    <script type="text/javascript">
    $(function(){
        
        scrollTop("ico_top");//返回顶部
        
    })
    </script>
    </body>
</html>
