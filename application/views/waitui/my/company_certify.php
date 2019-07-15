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
            <div class="panel-title mb20">
                <div class="panel-title-tab">
                    <a href="<?php echo base_url() ?>my_account">个人信息</a>
                    <a href="<?php echo base_url() ?>company_certify" class="cur">公司认证</a>
                </div>
            </div>
            <div class="my-form mt50" id="certify_form">
                <dl class="mb30">
                    <dt class="w140 ta-l">工商营业执照</dt>
                    <dd>
                        <div class="mt5 mb5">
                            <p class="col-gray9 f14 lh24">请上传<a href="/htdocs/waitui/images/business_license.jpg" target="_blank" class="col-my ml5">最新的工商营业执照</a></p>
                            <p class="col-gray9 f14 lh24">格式要求：原件照片、扫描件或者加盖公章的复印件，支持.jpg .png .gif格式照片，大小不超过5M。</p>
                        </div>
                        <a href="javascript:;" class="upload-btn" id="upload_licence_btn">上传文件</a>
                        <input type="file" id="upload_licence_file" style="display: none;" />
                        <div class="upload-result" id="upload_licence_result" style="display: none;"></div>
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">公司全称</dt>
                    <dd>
                        <input type="text" placeholder="请填写公司全称" id="company_name" name="company_name" />
                        <div class="mt5 mb5">
                            <p class="col-gray9 f14 lh24">主体名称需严格按照证件填写，避免因主体原因导致认证失败。</p>
                        </div>
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">法定代表人姓名</dt>
                    <dd>
                        <input type="text" placeholder="请填写法定代表人姓名" id="legal_name" name="legal_name" />
                        <div class="mt5 mb5">
                            <p class="col-gray9 f14 lh24">法定代表人姓名需与工商营业执照一致。</p>
                        </div>
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">公司电话</dt>
                    <dd>
                        <input type="text" placeholder="请填写公司电话" id="company_phone" name="company_phone" />
                        <div class="mt5 mb5">
                            <p class="col-gray9 f14 lh24">手机联系不到时备用。</p>
                        </div>
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">公司邮箱</dt>
                    <dd>
                        <input type="text" placeholder="请填写公司邮箱" id="company_email" name="company_email" />
                        <div class="mt5 mb5">
                            <p class="col-gray9 f14 lh24">用于后续相关服务通知。</p>
                        </div>
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">通讯地址</dt>
                    <dd>
                        <input type="text" placeholder="请填写通讯地址" id="company_address" name="company_address" />
                        <div class="mt5 mb5">
                            <p class="col-gray9 f14 lh24">请填写企业实际办公地址。</p>
                        </div>
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">&nbsp;</dt>
                    <dd>
                        <a href="javascript:;" class="pub-btn mr20" id="certify">提交认证</a>
                        <a href="javascript:;" class="pub-btn-gray mr20" id="cancel_certify" style="display: none;">取消操作</a>
                    </dd>
                </dl>
            </div>
            
            <div class="my-form mt50" id="certifing_form" style="display: none;">
                <dl class="mb30">
                    <dt class="w140 ta-l">工商营业执照</dt>
                    <dd></dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">公司全称</dt>
                    <dd>
                        <input type="text" placeholder="请填写公司全称" value="杭州外推网络有限公司" disabled="disabled" />
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">法定代表人姓名</dt>
                    <dd>
                        <input type="text" placeholder="请填写法定代表人姓名" value="无牙子" disabled="disabled" />
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">公司电话</dt>
                    <dd>
                        <input type="text" placeholder="请填写公司电话" value="88365365" disabled="disabled" />
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">公司邮箱</dt>
                    <dd>
                        <input type="text" placeholder="请填写公司邮箱" value="waituicom@163.com" disabled="disabled" />
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">通讯地址</dt>
                    <dd>
                        <input type="text" placeholder="请填写通讯地址" value="杭州市拱墅区上塘路333号" disabled="disabled" />
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">&nbsp;</dt>
                    <dd>
                        <a href="javascript:;" class="pub-btn-gray forbid mr20" id="certifing">认证中...</a>
                        <a href="javascript:;" class="pub-btn mr20" id="re_certify" style="display: none;">重新认证</a>
                    </dd>
                </dl>
            </div>
            
        </div>
    </div>
    
    <?php include_once(VIEWPATH.'waitui/templete/my_foot.php') ?>
    
    <script type="text/javascript">
    $(function(){
        
        scrollTop("ico_top");//返回顶部
        
        $("#upload_licence_btn").on("click",function(){
            $("#upload_licence_file")[0].click();
        })
        
        $("#upload_licence_file").on("change",function(){
            var $this = $(this);
            var file_object = this.files[0];
            if (!file_object) {
                return;
            }
            var reader = new FileReader();
            if (!window.FileReader || !file_object || !file_object.type.match('image.*')) {
                Pop.alert('图片格式错误！<br>请选择.jpg， .png 或 .gif 格式图片，重新上传');
                return;
            }
            if (file_object.size > 1024*1024*5) {
                Pop.alert('大小应小于5M');
                return
            }
            
            $("#upload_licence_btn").text("重新上传");
            
            var str = '';
            str += '<span class="upload-result-title">'+file_object.name+'</span>';
            var filesize = '';
            if(file_object.size < 1024){
                filesize = file_object.size+"B";
            }else if(file_object.size > 1024*1024){
                filesize = (file_object.size/(1024*1024)).toFixed(1)+"M";
            }else{
                filesize = (file_object.size/1024).toFixed(1)+"K";
            }
            str += '<span class="upload-result-size">'+filesize+'</span>';
            str += '<a href="">查看</a><a href="">删除</a>';
            $("#upload_licence_result").html(str).show();
            
            reader.readAsDataURL(file_object);
            reader.onload = function (theFile) {
                var img_width = 0;
                var img_height = 0;
                var image = new Image();
                image.src = theFile.target.result;
                image.onload = function () {
                    img_width = this.width;
                    img_height = this.height;
                    console.log("宽度："+img_width+"px，高度："+img_height);
                }
            }
        })
        
        $("#certify").on("click",function(){
            $("#certify_form").hide();
            $("#certifing_form").show();
            $("#certifing").show();
            $("#re_certify").hide();
            setTimeout(function(){
                $("#certifing").hide();
                $("#re_certify").show();
            },3000)
        })
        
        $("#re_certify").on("click",function(){
            $("#certifing_form").hide();
            $("#certify_form").show();
            $("#certify").show();
            $("#cancel_certify").show();
        })
        
        $("#cancel_certify").on("click",function(){
            $("#certify_form").hide();
            $("#certifing_form").show();
            $("#certifing").hide();
            $("#re_certify").show();
        })
        
    })
    </script>
    </body>
</html>
