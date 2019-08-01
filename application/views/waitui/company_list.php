<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once(VIEWPATH.'waitui/templete/pub_head.php') ?>
    </head>
    
    <body>
    
    <?php include_once(VIEWPATH.'waitui/templete/menubar.php') ?>
    
    <div class="company-top">
        <div class="container after-cls pt25 pb20">
            <div class="search">
                <form id="search_form" action="" method="post"></form>
                <input type="text" placeholder="请输入企业名称 / 法人姓名" name="keyword" value="" id="keyword" onkeyup="keywordEnter()" />
                <input type="button" value="搜索" id="keywordBtn" onclick="keywordSearch()" />
            </div>
            <div class="province">
                <dl>
                    <dt>所属地区：</dt>
                    <dd>
                        <?php foreach ($province_list as $province){ ?>
                        <a href="<?php echo base_url() ?>company_<?php echo $province['code']; ?>.html"><?php echo $province['code'].' - '.$province['name']; ?></a>
                        <?php } ?>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
    
    <div class="bg-white mt20 mb20">
        <div class="container after-cls pt20 pb30">
            <div class="company-list">
                <table class="company-table" width="100%">
                    <thead>
                        <tr>
                            <th width="5%" class="ta-c">序号</th>
                            <th width="25%">公司名称</th>
                            <th>法定代表人</th>
                            <th>所属地区</th>
                            <th>所属行业</th>
                            <th>注册资本</th>
                            <th>成立时间</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($company_list as $key => $company){ ?>
                        <tr>
                            <td class="ta-c"><?php echo ($cur_page-1)*$page_size+$key+1; ?></td>
                            <td><a href="<?php echo base_url() ?>company_detail/<?php echo $company->company_id; ?>.html" target="_blank"><?php echo $company->name; ?></a></td>
                            <td><?php echo $company->oper_name; ?></td>
                            <td><?php echo $company->province; ?></td>
                            <td><?php echo $company->industry; ?></td>
                            <td><?php echo $company->regist_capi; ?></td>
                            <td><?php echo date('Y-m-d',strtotime($company->start_date)); ?></td>
                        </tr>
                        <?php } ?>
                        <?php if(count($company_list) == 0){ ?>
                        <tr>
                            <td colspan="6" class="ta-c">未搜索到相应结果</td>
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
    
    <?php include_once(VIEWPATH.'waitui/templete/pub_foot.php') ?>
    
    <script type="text/javascript">
    function keywordEnter(e){
        var eve = e || window.event;
        if(eve.keyCode == 13){
            keywordSearch();
        }
    }
    
    function keywordSearch(){
        if($.trim($("#keyword").val()) == ""){
            Pop.alert("企业关键词不能为空");
            return;
        }
        $("#search_form").attr('action','<?php echo base_url() ?>company_search/'+$("#keyword").val());
        $("#search_form").submit();
    }
    
    $(function(){
        
        scrollTop("ico_top");//返回顶部
        
    })
    </script>
    </body>
</html>
