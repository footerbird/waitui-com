<!DOCTYPE html>
<html>
    
    <head>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no' />
    <link rel="icon" href="/htdocs/waitui/images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/htdocs/waitui/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/htdocs/waitui/css/public.css?<?php echo CACHE_TIME; ?>">
    <style type="text/css">
    .info-box{
        width: 1000px;
        margin: 0 auto;
        text-align: center;
        padding: 20px;
    }
    .info-box textarea{
        width: 600px;
        height: 300px;
        text-align: left;
        padding: 15px;
    }
    .info-box .search-btn{
        display: inline-block;
        width: 120px;
        height: 36px;
        line-height: 36px;
        text-align: center;
        font-size: 14px;
        color: #fff;
        background-color: #ea6f5a;
        border: none;
        cursor: pointer;
        box-sizing: border-box;
        border-radius: 3px;
        margin-top: 20px;
    }
    .info-box .search-result{
        width: 600px;
        margin: 0 auto;
        text-align: left;
        padding: 15px;
        font-size: 14px;
        line-height: 24px;
    }
    .info-box .search-result .red{
        color: #f00;
    }
    .info-box .search-result .green{
        color: #080;
    }
    </style>
    </head>
    <body>
    
    <div class="info-box">
        <form id="mark_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" >
            <textarea placeholder="格式：注册号#商标大类#价格（一行一个），例如（12815700#43#128000）" name="regno_list" id="regno_list" ><?php if(isset($regno_list)){ echo $regno_list; } ?></textarea><br>
            <a href="javascript:;" class="search-btn" id="search_btn">查询</a>
        </form>
        
        <div class="search-result">
            <?php if(isset($result_list)){ ?>
            <?php foreach ($result_list as $result){ ?>
                <?php if($result['status'] == 0){ ?>
                    <p class="red"><?php echo $result['msg']; ?></p>
                <?php }else{ ?>
                    <p class="green"><?php echo $result['msg']; ?></p>
                <?php } ?>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
    
    <script src="/htdocs/waitui/js/jquery-1.11.1.min.js?<?php echo CACHE_TIME; ?>"></script>
    <script src="/htdocs/waitui/js/public.js?<?php echo CACHE_TIME; ?>"></script>
    <script type="text/javascript">
    $(function(){
        $("#search_btn").on("click",function(){
            $("#regno_list").val($.trim($("#regno_list").val()));
            
            var regno_list_val = $("#regno_list").val();
            if($.trim(regno_list_val) == ""){
                Pop.alert("不能为空")
            }else{
                var errorLine = [];
                var regno_list_arr = regno_list_val.split(/[\n\r]/g);
                $.each(regno_list_arr, function(i) {
                    var regno_item_arr = regno_list_arr[i].split("#");
                    if(regno_item_arr.length != 3){
                        errorLine.push(i+1);
                    }
                });
                
                if(errorLine.length != 0){
                    Pop.alert("第"+errorLine.join("、")+"行数据格式错误");
                }else{
                    $("#mark_form").submit();
                }
            }
        })
    })
    </script>
    </body>
</html>
