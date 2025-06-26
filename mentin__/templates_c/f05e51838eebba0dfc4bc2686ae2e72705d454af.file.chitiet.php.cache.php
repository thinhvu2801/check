<?php /* Smarty version Smarty-3.1.16, created on 2023-03-22 10:22:12
         compiled from "C:\xampp\htdocs\mentin\application\views\nguyenlieu\chitiet.php" */ ?>
<?php /*%%SmartyHeaderCode:1588944000641ac8c4c6fbd6-58942186%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f05e51838eebba0dfc4bc2686ae2e72705d454af' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mentin\\application\\views\\nguyenlieu\\chitiet.php',
      1 => 1677583362,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1588944000641ac8c4c6fbd6-58942186',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'lohang' => 0,
    'x' => 0,
    'lo_id' => 0,
    'result' => 0,
    'sum_weight' => 0,
    'rs' => 0,
    'i' => 0,
    'startDate' => 0,
    'endDate' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_641ac8c4cb34f6_15385241',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_641ac8c4cb34f6_15385241')) {function content_641ac8c4cb34f6_15385241($_smarty_tpl) {?><div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
nguyenlieu/chitiet" method="post" id="form">
                <div class="card-body">
                    <!-- Date and time range -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="text" class="form-control float-right" name="datetime" id="reservationtime">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Lô</span>
                            </div>
                            <select class="form-control" name="lo_id" id="lo_id">
                                <option value="">Tất cả</option>
                                <?php  $_smarty_tpl->tpl_vars['x'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['x']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lohang']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['x']->key => $_smarty_tpl->tpl_vars['x']->value) {
$_smarty_tpl->tpl_vars['x']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['x']->value->lo_id;?>
" <?php if ($_smarty_tpl->tpl_vars['lo_id']->value==$_smarty_tpl->tpl_vars['x']->value->lo_id) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['x']->value->lo_id;?>
</option>
                                <?php } ?>
                            </select>
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
        <div class="card card-info">
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
                                <th width="5%">TT</th>
                                <th width="10%">Mã SP</th>
                                <th>Sản phẩm</th>
                                <th width="15%">Khối lượng</th>
                                <th width="15%">Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['sum_weight'] = new Smarty_variable(0, null, 0);?>
                            <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                            <?php $_smarty_tpl->tpl_vars['sum_weight'] = new Smarty_variable($_smarty_tpl->tpl_vars['sum_weight']->value+$_smarty_tpl->tpl_vars['rs']->value['weight'], null, 0);?>
                            <tr>
                                <td align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_id'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_name'];?>
</td>
                                <td align="right"><?php echo $_smarty_tpl->tpl_vars['rs']->value['weight'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['time'];?>
</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot style="font-weight: bold;">
                            <td colspan="3" align="right">Tổng</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['sum_weight']->value,1,",",".");?>
</td>
                            <td></td>
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
        $('#reservationtime').daterangepicker({
            timePicker: true,
            startDate: '<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
',
            endDate: '<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
',
            timePicker24Hour: true,
            timePickerIncrement: 1,
            locale: {
                format: 'DD/MM/YYYY HH:mm A'
            }
        });
        $('#dataTable').DataTable();
    });
</script><?php }} ?>
