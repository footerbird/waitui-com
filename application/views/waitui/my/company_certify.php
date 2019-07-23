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
            
            <div class="my-form mt50" id="certify_form" <?php if(!empty($company_certify)){ echo 'style="display:none;"'; } ?> >
            <form id="certifyForm">
                <dl class="mb30">
                    <dt class="w140 ta-l">工商营业执照</dt>
                    <dd>
                        <div class="mt5 mb5">
                            <p class="col-gray9 f14 lh24">请上传<a href="/htdocs/waitui/images/business_license.jpg" target="_blank" class="col-my ml5">最新的工商营业执照</a></p>
                            <p class="col-gray9 f14 lh24">格式要求：原件照片、扫描件或者加盖公章的复印件，支持.jpg .png .gif格式照片，大小不超过5M。</p>
                        </div>
                        <a href="javascript:;" class="upload-btn" id="upload_licence_btn">上传文件</a>
                        <input type="hidden" name="business_license" id="business_license" value="<?php if(!empty($company_certify)){ echo $company_certify->business_license; } ?>">
                        <div class="upload-result" id="upload_licence_result" style="display: none;"></div>
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">公司全称</dt>
                    <dd>
                        <input type="text" placeholder="请填写公司全称" id="company_name" name="company_name" value="<?php if(!empty($company_certify)){ echo $company_certify->company_name; } ?>" />
                        <div class="mt5 mb5">
                            <p class="col-gray9 f14 lh24">主体名称需严格按照证件填写，避免因主体原因导致认证失败。</p>
                        </div>
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">法定代表人姓名</dt>
                    <dd>
                        <input type="text" placeholder="请填写法定代表人姓名" id="oper_name" name="oper_name" value="<?php if(!empty($company_certify)){ echo $company_certify->oper_name; } ?>" />
                        <div class="mt5 mb5">
                            <p class="col-gray9 f14 lh24">法定代表人姓名需与工商营业执照一致。</p>
                        </div>
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">公司电话</dt>
                    <dd>
                        <input type="text" placeholder="请填写公司电话" id="contact_phone" name="contact_phone" value="<?php if(!empty($company_certify)){ echo $company_certify->contact_phone; } ?>" />
                        <div class="mt5 mb5">
                            <p class="col-gray9 f14 lh24">手机联系不到时备用。</p>
                        </div>
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">公司邮箱</dt>
                    <dd>
                        <input type="text" placeholder="请填写公司邮箱" id="contact_email" name="contact_email" value="<?php if(!empty($company_certify)){ echo $company_certify->contact_email; } ?>" />
                        <div class="mt5 mb5">
                            <p class="col-gray9 f14 lh24">用于后续相关服务通知。</p>
                        </div>
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">通讯地址</dt>
                    <dd>
                        <input type="text" placeholder="请填写通讯地址" id="contact_address" name="contact_address" value="<?php if(!empty($company_certify)){ echo $company_certify->contact_address; } ?>" />
                        <div class="mt5 mb5">
                            <p class="col-gray9 f14 lh24">请填写企业实际办公地址。</p>
                        </div>
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">&nbsp;</dt>
                    <dd>
                        <a href="javascript:;" class="pub-btn mr20" id="certify" onclick="form_submit()" <?php if(!empty($company_certify)){ echo 'style="display:none;"'; } ?> >提交认证</a>
                        <a href="javascript:;" class="pub-btn-gray mr20" id="cancel_certify" style="display: none;">取消操作</a>
                        <input type="hidden" name="operate" value="<?php echo $operate; ?>">
                    </dd>
                </dl>
            </form>
            </div>
            
            <div class="my-form mt50" id="certifing_form" <?php if(empty($company_certify)){ echo 'style="display:none;"'; } ?> >
                <dl class="mb30">
                    <dt class="w140 ta-l">工商营业执照</dt>
                    <dd>
                        <img src="<?php if(!empty($company_certify)){ echo $company_certify->business_license; } ?>" width="90" height="120" class="fl-l mr20" />
                        <a href="<?php if(!empty($company_certify)){ echo $company_certify->business_license; } ?>" target="_blank" class="fl-l">查看大图</a>
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">公司全称</dt>
                    <dd>
                        <input type="text" placeholder="请填写公司全称" value="<?php if(!empty($company_certify)){ echo $company_certify->company_name; } ?>" disabled="disabled" />
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">法定代表人姓名</dt>
                    <dd>
                        <input type="text" placeholder="请填写法定代表人姓名" value="<?php if(!empty($company_certify)){ echo $company_certify->oper_name; } ?>" disabled="disabled" />
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">公司电话</dt>
                    <dd>
                        <input type="text" placeholder="请填写公司电话" value="<?php if(empty(!$company_certify)){ echo $company_certify->contact_phone; } ?>" disabled="disabled" />
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">公司邮箱</dt>
                    <dd>
                        <input type="text" placeholder="请填写公司邮箱" value="<?php if(!empty($company_certify)){ echo $company_certify->contact_email; } ?>" disabled="disabled" />
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">通讯地址</dt>
                    <dd>
                        <input type="text" placeholder="请填写通讯地址" value="<?php if(!empty($company_certify)){ echo $company_certify->contact_address; } ?>" disabled="disabled" />
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt class="w140 ta-l">&nbsp;</dt>
                    <dd>
                        <a href="javascript:;" class="pub-btn-gray forbid mr20" id="certifing" <?php if(!(!empty($company_certify) && $company_certify->status == 1)){ echo 'style="display:none;"'; } ?> >认证中...</a>
                        <a href="javascript:;" class="pub-btn mr20" id="re_certify" <?php if(!(!empty($company_certify) && $company_certify->status != 1)){ echo 'style="display:none;"'; } ?> >重新认证</a>
                        <?php if(!empty($company_certify) && $company_certify->status == 0){ ?>
                        <span class="col-warn">认证失败：<?php echo $company_certify->description; ?></span>
                        <?php } ?>
                        <?php if(!empty($company_certify) && $company_certify->status == 2){ ?>
                        <span class="col-green">已认证</span>
                        <?php } ?>
                    </dd>
                </dl>
            </div>
            
        </div>
    </div>
    
    <?php include_once(VIEWPATH.'waitui/templete/my_foot.php') ?>
    
    <script type="text/javascript">
    function form_submit(){
        if($("#business_license").val() == ""){
            Pop.alert("营业执照不能为空");
            return;
        }
        if($("#company_name").val() == ""){
            Pop.alert("公司全称不能为空");
            return;
        }
        if($("#oper_name").val() == ""){
            Pop.alert("法定代表人姓名不能为空");
            return;
        }
        if($("#contact_phone").val() == ""){
            Pop.alert("公司电话不能为空");
            return;
        }
        if($("#contact_email").val() == ""){
            Pop.alert("公司邮箱不能为空");
            return;
        }
        if($("#contact_address").val() == ""){
            Pop.alert("通讯地址不能为空");
            return;
        }
        
        $("#certifyForm").ajaxForm({
            url:'/waitui/Index_controller/company_certifyAjax',
            type:'post',
            dataType:'json',
            beforeSubmit:function () {
            },
            success:function (data) {
                if(data.state == "success"){
                    location.reload();
                }else{
                    Pop.alert(data.msg);
                }
            },
            error:function(jqXHR, textStatus, errorThrown){
                Pop.alert("程序异常："+errorThrown+"<br>请联系管理员");
            }
        }).submit();
    }
    
    $(function(){
        
        scrollTop("ico_top");//返回顶部
        
        $("#upload_licence_btn").dropzone({
            url: '<?php echo base_url() ?>waitui/Index_controller/upload_businessLicenseTemp',
            //maxFiles: 1,//这里设置 Dropzone 最多可以处理多少文件，该文件数量指的是多次上传文件的总和,超出就会报error
            maxFilesize: 5,
            acceptedFiles: ".jpeg,.jpg,.gif,.png,.JPEG,.JPG,.GIF,.PNG",
            success: function(file,res){
                var result_str = '';
                result_str += '<span class="upload-result-title">'+file.name+'</span>';
                var filesize = '';
                if(file.size < 1024){
                    filesize = file.size+"B";
                }else if(file.size > 1024*1024){
                    filesize = (file.size/(1024*1024)).toFixed(1)+"M";
                }else{
                    filesize = (file.size/1024).toFixed(1)+"K";
                }
                result_str += '<span class="upload-result-size">'+filesize+'</span>';
                
                var result = eval('('+res+')');
                if(result.state == 'success'){
                    $.ajax({
                        type:"post",
                        url:"<?php echo base_url() ?>waitui/Index_controller/upload_businessLicenseAjax",
                        async:true,
                        data:{
                            license_path: result.url
                        },
                        dataType:"json",
                        success:function(data){
                            if(data.state == 'success'){
                                $("#business_license").val(data.license);
                                $("#upload_licence_btn").text("重新上传");
                                result_str += '<a href="'+data.license+'" target="_blank">查看</a>';
                                $("#upload_licence_result").html(result_str).show();
                            }else{
                                Pop.alert("上传失败，请重试");
                            }
                        }
                    });
                }else{
                    Pop.alert("上传失败，请重试");
                }
            },
            error: function(file,res){
                Pop.alert("上传失败，请重试");
            },
            addedfile: function(file){}//阻止默认行为
        });
        
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
