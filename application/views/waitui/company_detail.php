<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once(VIEWPATH.'waitui/templete/pub_head.php') ?>
    </head>
    
    <body>
    
    <?php include_once(VIEWPATH.'waitui/templete/menubar.php') ?>
    
    <div class="container">
        <div class="breadcrumbs" style="height: 40px; line-height: 41px;"><a href="<?php echo base_url() ?>company_list.html">企业名录</a><em></em><span><?php echo $company->name; ?></span></div>
    </div>
    
    <div class="bg-white mb20">
        <div class="container pt30 pb30">
            <div class="company-detail">
                
                <div class="after-cls mb20">
                    <?php if(empty($userinfo)){ ?>
                    <a href="javascript:;" onclick="func_upwin_login()" class="thumb-box">
                        <img src="/htdocs/waitui/images/ad/ad-brandcheckin.png" class="thumb" />
                    </a>
                    <?php }else{ ?>
                    <a href="<?php echo base_url() ?>/certify_list" target="_blank" class="thumb-box">
                        <img src="/htdocs/waitui/images/ad/ad-brandcheckin.png" class="thumb" />
                    </a>
                    <?php } ?>
                    <div class="info-box">
                        <h3 class="ellip"><?php echo $company->name; ?></h3>
                        <div class="pt10 pb10 after-cls">
                            <em class="tag-status mr5">在业</em>
                            <?php if(!empty($company->certify_status) && $company->certify_status == 'success'){ ?>
                            <em class="tag-certify mr5">认证</em>
                            <?php } ?>
                        </div>
                        <table width="100%">
                            <tbody>
                                <tr>
                                    <td width="40%">
                                        <font>电话：</font>
                                        <span><?php echo empty($company->contact_phone)?'暂无':$company->contact_phone; ?></span>
                                    </td>
                                    <td width="60%">
                                        <font>官网：</font>
                                        <?php if(!empty($company->website)){ ?>
                                        <a href="<?php echo $company->website; ?>" target="_blank"><?php echo $company->website; ?></a>
                                        <?php }else{ ?>
                                        <span>暂无</span>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <font>邮箱：</font>
                                        <span><?php echo empty($company->contact_email)?'暂无':$company->contact_email; ?></span>
                                    </td>
                                    <td class="ellip">
                                        <font>地址：</font>
                                        <span><?php echo empty($company->contact_address)?'暂无':$company->contact_address; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ellip" colspan="2">
                                        <font>简介：</font>
                                        <span><?php echo empty($company->description)?'暂无':$company->description; ?></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="detail-title">工商信息</div>
                
                <div class="after-cls">
                    <div class="company-left">
                        <table width="100%" class="info-table">
                            <tbody>
                                <tr>
                                    <td width="20%" rowspan="2" class="tb">法定代表人</td>
                                    <td width="30%" rowspan="2" class=""><img src="/htdocs/waitui/images/legal-figure.png" width="40" height="40" class="mr10 va-m" /><?php echo $company->oper_name; ?></td>
                                    <td width="20%" class="tb">注册资本</td>
                                    <td width="30%" class=""><?php echo $company->regist_capi; ?></td>
                                </tr>
                                <tr>
                                    <td width="20%" class="tb">实缴资本</td>
                                    <td width="30%" class=""><?php echo $company->real_capi; ?></td>
                                </tr>
                                <tr>
                                    <td class="tb">经营状态</td>
                                    <td class=""><?php echo $company->status; ?></td>
                                    <td class="tb">成立日期</td>
                                    <td class=""><?php echo date('Y-m-d',strtotime($company->start_date)); ?></td>
                                </tr>
                                <tr>
                                    <td class="tb">统一社会信用代码</td>
                                    <td class=""><?php echo $company->credit_code; ?></td>
                                    <td class="tb">纳税人识别号</td>
                                    <td class=""><?php echo $company->tax_no; ?></td>
                                </tr>
                                <tr>
                                    <td class="tb">注册号</td>
                                    <td class=""><?php echo $company->no; ?></td>
                                    <td class="tb">组织机构代码</td>
                                    <td class=""><?php echo $company->org_no; ?></td>
                                </tr>
                                <tr>
                                    <td class="tb">公司类型</td>
                                    <td class=""><?php echo $company->econ_kind; ?></td>
                                    <td class="tb">所属行业</td>
                                    <td class=""><?php echo $company->industry; ?></td>
                                </tr>
                                <tr>
                                    <td class="tb">核准日期</td>
                                    <td class=""><?php echo date('Y-m-d',strtotime($company->check_date)); ?></td>
                                    <td class="tb">登记机关</td>
                                    <td class=""><?php echo $company->belong_org; ?></td>
                                </tr>
                                <tr>
                                    <td class="tb">所属地区</td>
                                    <td class=""><?php echo $company->province; ?></td>
                                    <td class="tb">英文名</td>
                                    <td class=""><?php echo $company->en_name; ?></td>
                                </tr>
                                <tr>
                                    <td class="tb">曾用名</td>
                                    <td class=""><?php echo $company->original_name; ?></td>
                                    <td class="tb">参保人数</td>
                                    <td class=""><?php echo $company->insured_person; ?></td>
                                </tr>
                                <tr>
                                    <td class="tb">人员规模</td>
                                    <td class=""><?php echo $company->staff_size; ?></td>
                                    <td class="tb">营业期限</td>
                                    <td class=""><?php echo $company->business_term; ?></td>
                                </tr>
                                <tr>
                                    <td class="tb">企业地址</td>
                                    <td class="" colspan="3"><?php echo $company->address; ?></td>
                                </tr>
                                <tr>
                                    <td class="tb">经营范围</td>
                                    <td class="" colspan="3"><?php echo $company->scope; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="company-right">
                        
                        <div class="swiper-container swiper" id="company_swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=2165223868&amp;site=qq&amp;menu=yes" target="_blank">
                                        <img src="/htdocs/waitui/images/ad/ad-domain-entrust.png" />
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="<?php echo base_url() ?>/domain_list.html" target="_blank">
                                        <img src="/htdocs/waitui/images/ad/ad-domain-market.png" />
                                    </a>
                                </div>
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination"></div>
                            <!-- 如果需要导航按钮 -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                        
                        <div class="recommend mt20" style="border-top: none;">
                            <h4 class="title">推荐阅读</h4>
                            <?php foreach ($article_recommend as $recommend){ ?>
                            <div class="recommend-item">
                                <a href="<?php echo base_url() ?>article_detail/<?php echo $recommend->article_id ?>.html" target="_blank"><?php echo $recommend->article_title ?></a>
                            </div>
                            <?php } ?>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <?php include_once(VIEWPATH.'waitui/templete/pub_foot.php') ?>
    
    <script type="text/javascript">
    $(function(){
        
        scrollTop("ico_top");//返回顶部
        
        var mySwiper = new Swiper ('#company_swiper', {
            loop : true,
            autoplay: {
                delay: 8000,//8秒切换一次
            },
            pagination: {
                el: '.swiper-pagination',
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            }
        })
        
    })
    </script>
    </body>
</html>
