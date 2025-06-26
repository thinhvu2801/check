<?php /* Smarty version Smarty-3.1.16, created on 2024-03-14 03:17:25
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\warehouse\total.php" */ ?>
<?php /*%%SmartyHeaderCode:87772857065f258588fc919-89531981%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '384e3e4c8f3eb8dde9499e2803673331a2eaf1de' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\warehouse\\total.php',
      1 => 1710382643,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '87772857065f258588fc919-89531981',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65f2585894fb21_77430741',
  'variables' => 
  array (
    'base_url' => 0,
    'date' => 0,
    'result' => 0,
    'so_luong' => 0,
    'rs' => 0,
    'khoi_luong' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65f2585894fb21_77430741')) {function content_65f2585894fb21_77430741($_smarty_tpl) {?><div class="row">
    <div class="col-md-3">
        <div class="card card-info" id="card_filter">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
warehouse/total" method="post" id="form">
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
                            <td>Mã kho</td>
                            <td>Quy cách</td>
                            <td>Hàng hóa</td>
                            <td>Size</td>
                            <td>Số lượng</td>
                            <td>Khối lượng</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong'] = new Smarty_variable(0, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['so_luong'] = new Smarty_variable(0, null, 0);?>
                        <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                        <?php $_smarty_tpl->tpl_vars['so_luong'] = new Smarty_variable($_smarty_tpl->tpl_vars['so_luong']->value+$_smarty_tpl->tpl_vars['rs']->value->quantity, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong'] = new Smarty_variable($_smarty_tpl->tpl_vars['khoi_luong']->value+$_smarty_tpl->tpl_vars['rs']->value->weight, null, 0);?>
                        <tr align="center">
                            <td><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value->warehouse_id;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value->quycach_name;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value->product_name;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value->size_name;?>
</td>
                            <td align="right"><?php echo $_smarty_tpl->tpl_vars['rs']->value->quantity;?>
</td>
                            <td align="right"><?php echo $_smarty_tpl->tpl_vars['rs']->value->weight;?>
</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr align="right" style="font-weight: bold;">
                            <td align="right" colspan="5">Tổng: </td>
                            <td align="right"><?php echo $_smarty_tpl->tpl_vars['so_luong']->value;?>
</td>
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
    $('#dataTable').dataTable({
        "stateSave": true,
        "pageLength":25
    });
});
</script><?php }} ?>
