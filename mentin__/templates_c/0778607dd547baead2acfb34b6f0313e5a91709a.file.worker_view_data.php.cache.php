<?php /* Smarty version Smarty-3.1.16, created on 2023-04-19 13:35:05
         compiled from "C:\xampp\htdocs\mentin\application\views\statistic\suaca\worker_view_data.php" */ ?>
<?php /*%%SmartyHeaderCode:19147763046424f9e9c80e36-38126952%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0778607dd547baead2acfb34b6f0313e5a91709a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mentin\\application\\views\\statistic\\suaca\\worker_view_data.php',
      1 => 1681904100,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19147763046424f9e9c80e36-38126952',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_6424f9e9cabf49_23464623',
  'variables' => 
  array (
    'result_yesterday' => 0,
    'result_today' => 0,
    'quantity' => 0,
    'rs' => 0,
    'weight_in' => 0,
    'weight_out' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6424f9e9cabf49_23464623')) {function content_6424f9e9cabf49_23464623($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\mentin\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.date_format.php';
?><div class="col-md-12">
    <div class="card card-info">
        <div class="card-header" style="text-align: center;">
            <h3 class="card-title">
                <h4>
                    <?php if (count($_smarty_tpl->tpl_vars['result_yesterday']->value)>0) {?>
                    (<?php echo $_smarty_tpl->tpl_vars['result_yesterday']->value[0]['worker_id'];?>
) <?php echo $_smarty_tpl->tpl_vars['result_yesterday']->value[0]['worker_name'];?>

                    <?php } else { ?>
                    <?php if (count($_smarty_tpl->tpl_vars['result_today']->value)>0) {?>
                    (<?php echo $_smarty_tpl->tpl_vars['result_today']->value[0]['worker_id'];?>
) <?php echo $_smarty_tpl->tpl_vars['result_today']->value[0]['worker_name'];?>

                    <?php }?>
                    <?php }?>
                </h4>
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive">
                        <div style="text-align:center">
                            <h5>
                                <?php if (count($_smarty_tpl->tpl_vars['result_yesterday']->value)>0) {?>
                                Ngày <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['result_yesterday']->value[0]['date'],"d/m/Y");?>

                                <?php } else { ?>
                                #
                                <?php }?>
                            </h5>
                        </div>
                        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr style="font-weight: bold;" align="center">
                                    <td width="3%">STT</td>
                                    <td>Lô</td>
                                    <td>Sản phẩm</td>
                                    <td>Số rổ</td>
                                    <td>&sum;KL vào</td>
                                    <td>&sum;KL ra</td>
                                    <td>Đ.mức</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                                <?php $_smarty_tpl->tpl_vars['quantity'] = new Smarty_variable(0, null, 0);?>
                                <?php $_smarty_tpl->tpl_vars['weight_in'] = new Smarty_variable(0, null, 0);?>
                                <?php $_smarty_tpl->tpl_vars['weight_out'] = new Smarty_variable(0, null, 0);?>
                                <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result_yesterday']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                                <?php $_smarty_tpl->tpl_vars['quantity'] = new Smarty_variable($_smarty_tpl->tpl_vars['quantity']->value+$_smarty_tpl->tpl_vars['rs']->value['quantity'], null, 0);?>
                                <?php $_smarty_tpl->tpl_vars['weight_in'] = new Smarty_variable($_smarty_tpl->tpl_vars['weight_in']->value+$_smarty_tpl->tpl_vars['rs']->value['weight_in'], null, 0);?>
                                <?php $_smarty_tpl->tpl_vars['weight_out'] = new Smarty_variable($_smarty_tpl->tpl_vars['weight_out']->value+$_smarty_tpl->tpl_vars['rs']->value['weight_out'], null, 0);?>
                                <tr>
                                    <td align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                                    <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['lo_id'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_name'];?>
</td>
                                    <td align="right"><?php echo $_smarty_tpl->tpl_vars['rs']->value['quantity'];?>
</td>
                                    <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_in'],3,",",".");?>
</td>
                                    <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_out'],3,",",".");?>
</td>
                                    <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['dinh_muc'],3,",",".");?>
</td>
                                    <!-- <td align="center"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rs']->value['min_time'],"%H:%M");?>
-<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rs']->value['max_time'],"%H:%M");?>
</td> -->
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr style="font-weight:bold;">
                                    <td align="right" colspan="3">Tổng giờ: <?php if (count($_smarty_tpl->tpl_vars['result_yesterday']->value)>0) {?>
                                        <?php echo $_smarty_tpl->tpl_vars['result_yesterday']->value[0]['total_time'];?>

                                        <?php }?></td>
                                    <td align="right"><?php echo $_smarty_tpl->tpl_vars['quantity']->value;?>
</td>
                                    <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['weight_in']->value,3,",",".");?>
</td>
                                    <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['weight_out']->value,3,",",".");?>
</td>
                                    <td align="right">

                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="table-responsive">
                        <div style="text-align:center">
                            <h5>
                                <?php if (count($_smarty_tpl->tpl_vars['result_today']->value)>0) {?>
                                Ngày <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['result_today']->value[0]['date'],"d/m/Y");?>

                                <?php } else { ?>
                                #
                                <?php }?>
                            </h5>
                        </div>
                        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr style="font-weight: bold;" align="center">
                                    <td width="3%">STT</td>
                                    <td>Lô</td>
                                    <td>Sản phẩm</td>
                                    <td>Số rổ</td>
                                    <td>&sum;KL vào</td>
                                    <td>&sum;KL ra</td>
                                    <td>Đ.mức</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                                <?php $_smarty_tpl->tpl_vars['quantity'] = new Smarty_variable(0, null, 0);?>
                                <?php $_smarty_tpl->tpl_vars['weight_in'] = new Smarty_variable(0, null, 0);?>
                                <?php $_smarty_tpl->tpl_vars['weight_out'] = new Smarty_variable(0, null, 0);?>
                                <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result_today']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                                <?php $_smarty_tpl->tpl_vars['quantity'] = new Smarty_variable($_smarty_tpl->tpl_vars['quantity']->value+$_smarty_tpl->tpl_vars['rs']->value['quantity'], null, 0);?>
                                <?php $_smarty_tpl->tpl_vars['weight_in'] = new Smarty_variable($_smarty_tpl->tpl_vars['weight_in']->value+$_smarty_tpl->tpl_vars['rs']->value['weight_in'], null, 0);?>
                                <?php $_smarty_tpl->tpl_vars['weight_out'] = new Smarty_variable($_smarty_tpl->tpl_vars['weight_out']->value+$_smarty_tpl->tpl_vars['rs']->value['weight_out'], null, 0);?>
                                <tr>
                                    <td align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                                    <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['lo_id'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_name'];?>
</td>
                                    <td align="right"><?php echo $_smarty_tpl->tpl_vars['rs']->value['quantity'];?>
</td>
                                    <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_in'],3,",",".");?>
</td>
                                    <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_out'],3,",",".");?>
</td>
                                    <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['dinh_muc'],3,",",".");?>
</td>
                                    <!-- <td align="center"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rs']->value['min_time'],"%H:%M");?>
-<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rs']->value['max_time'],"%H:%M");?>
</td> -->
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr style="font-weight:bold;">
                                    <td align="right" colspan="3">Tổng giờ: <?php if (count($_smarty_tpl->tpl_vars['result_today']->value)>0) {?>
                                        <?php echo $_smarty_tpl->tpl_vars['result_today']->value[0]['total_time'];?>

                                        <?php }?></td>
                                    <td align="right"><?php echo $_smarty_tpl->tpl_vars['quantity']->value;?>
</td>
                                    <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['weight_in']->value,3,",",".");?>
</td>
                                    <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['weight_out']->value,3,",",".");?>
</td>
                                    <td align="right">

                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer -->
    </div>
</div><!-- ./col-md-8--><?php }} ?>
