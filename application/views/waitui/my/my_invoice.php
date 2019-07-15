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
                    <a href="<?php echo base_url() ?>my_invoice" class="cur">发票管理</a>
                    <a href="<?php echo base_url() ?>invoice_record">申请记录</a>
                </div>
            </div>
            <div class="my-table-filter after-cls">
                <div class="fl-r">
                    <a href="javascript:;" class="pub-btn">添加新模板</a>
                </div>
            </div>
            <table class="my-table" width="100%">
                <thead>
                    <tr>
                        <th align="left" width="40%" class="pl30">发票抬头</th>
                        <th align="left" width="20%">开具类型</th>
                        <th align="left" width="20%">发票类型</th>
                        <th align="right" width="20%" class="pr30">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="pl30"><label><input type="radio" name="invoiceCompany" /><i class="mr5"></i>杭州舟航网络科技有限公司</label></td>
                        <td>企业</td>
                        <td>增值税普通发票</td>
                        <td align="right" class="pr30">
                            <a href="javascript:;" class="ml10">修改</a>
                            <a href="javascript:;" class="ml10">删除</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="pl30"><label><input type="radio" name="invoiceCompany" /><i class="mr5"></i>杭州名商网络科技有限公司</label></td>
                        <td>企业</td>
                        <td>增值税普通发票</td>
                        <td align="right" class="pr30">
                            <a href="javascript:;" class="ml10">修改</a>
                            <a href="javascript:;" class="ml10">删除</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="my-form mt40">
                <input type="hidden" id="invoiceType" name="invoiceType" value="add" />
                <input type="hidden" id="invoiceNum" name="invoiceNum" value="" />
                <dl>
                    <dt>开具类型：</dt>
                    <dd>企业</dd>
                </dl>
                <dl>
                    <dt>发票类型：</dt>
                    <dd>
                        <select id="invoiceType" name="invoiceType">
                            <option>增值税普通发票</option>
                            <option>增值税专用发票</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>发票抬头：</dt>
                    <dd>
                        <input type="text" placeholder="发票抬头" id="invoiceCompany" name="invoiceCompany" />
                        <span class="ml10 col-gray9">请正确填写公司名称</span>
                    </dd>
                </dl>
                <dl>
                    <dt>纳税人识别号：</dt>
                    <dd>
                        <input type="text" placeholder="纳税人识别号" id="invoiceTaxnum" name="invoiceTaxnum" />
                        <span class="ml10 col-gray9">请正确填写纳税人识别号</span>
                    </dd>
                </dl>
                <dl>
                    <dt>&nbsp;</dt>
                    <dd>
                        <a href="javascript:;" class="pub-btn">保存</a>
                    </dd>
                </dl>
            </div>
            
            <div class="my-form mt40">
                <dl>
                    <dt>开具类型：</dt>
                    <dd>企业</dd>
                </dl>
                <dl>
                    <dt>发票类型：</dt>
                    <dd>增值税普通发票</dd>
                </dl>
                <dl>
                    <dt>发票抬头：</dt>
                    <dd>杭州舟航网络科技有限公司</dd>
                </dl>
                <dl>
                    <dt>可索取发票总额：</dt>
                    <dd class="col-green">14476.37 元</dd>
                </dl>
                <dl>
                    <dt>发票金额：</dt>
                    <dd>
                        <input type="text" placeholder="发票金额" id="invoiceAmount" name="invoiceAmount" />
                        <span class="ml10 col-gray9">请正确填写发票金额</span>
                    </dd>
                </dl>
                <dl>
                    <dt>&nbsp;</dt>
                    <dd>
                        <a href="javascript:;" class="pub-btn">提交</a>
                    </dd>
                </dl>
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
