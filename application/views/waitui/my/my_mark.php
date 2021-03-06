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
            <form id="search_form" action="<?php echo base_url() ?>my_mark" method="post">
                <div class="my-table-filter after-cls">
                    <input type="text" placeholder="输入商标名称" class="fl-l mr10" name="keyword" value="<?php echo $keyword; ?>" id="keyword" onkeyup="keywordEnter()" />
                    <a href="javascript:;" class="pub-btn fl-l mr10" onclick="keywordSearch()">搜索</a>
                    <a href="<?php echo base_url() ?>mark_list.html" target="_blank" class="pub-btn-yellow fl-l"><i class="ico-shop"></i>淘商标</a>
                    <div class="fl-r">
                        <a href="javascript:;" class="pub-btn-blue mr10" onclick="contactAdmin()">求购商标</a>
                        <a href="javascript:;" class="pub-btn-green" onclick="contactAdmin()">注册商标</a>
                    </div>
                </div>
            </form>
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
                            <p class="ta-c f18 col-my pt50 pb30">暂无商标</p>
                            <p class="ta-c"><img src="/htdocs/waitui/images/console-certify.png"></p>
                            <p class="ta-c f14 col-gray9 lh28 pt30">
                              您好，暂无搜索结果，<br>您可以联系您的专属<a href="javascript:;" class="ml10 mr10" onclick="contactAdmin()">品牌管家</a>来注册和求购您心仪的商标
                            </p>
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
    
    function keywordEnter(e){
        var eve = e || window.event;
        if(eve.keyCode == 13){
            keywordSearch();
        }
    }
    
    function keywordSearch(){
        $("#keyword").val($.trim($("#keyword").val()));
        $("#search_form").submit();
    }
    
    $(function(){
        
        scrollTop("ico_top");//返回顶部
        
    })
    </script>
    </body>
</html>
