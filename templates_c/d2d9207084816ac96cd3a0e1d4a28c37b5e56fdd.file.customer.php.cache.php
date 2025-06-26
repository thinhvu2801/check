<?php /* Smarty version Smarty-3.1.16, created on 2024-03-12 07:45:03
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\statistic\truck\customer.php" */ ?>
<?php /*%%SmartyHeaderCode:202146899965eff195638314-87297518%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd2d9207084816ac96cd3a0e1d4a28c37b5e56fdd' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\statistic\\truck\\customer.php',
      1 => 1710225901,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '202146899965eff195638314-87297518',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65eff195686372_35454018',
  'variables' => 
  array (
    'base_url' => 0,
    'date' => 0,
    'result' => 0,
    'rs' => 0,
    'khoi_luong' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65eff195686372_35454018')) {function content_65eff195686372_35454018($_smarty_tpl) {?><div class="row">
    <div class="col-md-3">
        <div class="card card-info" id="card_filter">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
truck/customer" method="post" id="form">
                <div class="card-body">
                    <!-- Date and time range -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Ngày</span>
                            </div>
                            <input type="date" class="form-control" id="date" name="date" value="<?php echo $_smarty_tpl->tpl_vars['date']->value;?>
" required>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group btn-block">
                        <button type="submit" class="btn btn-info btn-sm" name="statistic">Thống kê</button>
                        <button type="submit" class="btn btn-success btn-sm" name="export">Xuất file</button>
                    </div>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div><!-- ./col-md-3-->
    <div class="col-md-9">
        <div class="card card-info" id="card_result">
            <div class="card-header">
                <h3 class="card-title">
                    Kết quả
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="font-weight: bold;" align="center">
                            <td>STT</td>
                            <td>Khách hàng</td>
                            <td>Khối lượng xe và hàng</td>
                            <td>Khối lượng xe</td>
                            <td>Khối lượng hàng</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong'] = new Smarty_variable(0, null, 0);?>
                        <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                        <?php if ($_smarty_tpl->tpl_vars['rs']->value['weight_out']!=0) {?>
                            <?php $_smarty_tpl->tpl_vars['khoi_luong'] = new Smarty_variable($_smarty_tpl->tpl_vars['khoi_luong']->value+($_smarty_tpl->tpl_vars['rs']->value['weight_in']-$_smarty_tpl->tpl_vars['rs']->value['weight_out']), null, 0);?>
                        <?php }?>
                        <tr align="center">
                            <td><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                            <td><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
truck/general/<?php echo $_smarty_tpl->tpl_vars['rs']->value['customer_id'];?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['rs']->value['customer_name'];?>
</a></td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['weight_in'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['weight_out'];?>
</td>
                            <td align="right"><?php if ($_smarty_tpl->tpl_vars['rs']->value['weight_out']==0) {?><?php echo ($_smarty_tpl->tpl_vars['rs']->value['weight_in']-$_smarty_tpl->tpl_vars['rs']->value['weight_in']);?>
<?php } else { ?><?php echo ($_smarty_tpl->tpl_vars['rs']->value['weight_in']-$_smarty_tpl->tpl_vars['rs']->value['weight_out']);?>
<?php }?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr align="right" style="font-weight: bold;">
                            <td align="right" colspan="4">Tổng: </td>
                            <td align="right"><?php echo $_smarty_tpl->tpl_vars['khoi_luong']->value;?>
</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer -->
        </div>
    </div><!-- ./col-md-8-->
</div>
<script>
$(document).ready(function() {
    $('#lo_id').select2();
    $('#dataTable').dataTable();
});
</script><?php }} ?>
