<?php /* Smarty version Smarty-3.1.16, created on 2024-01-31 06:35:53
         compiled from "C:\xampp\htdocs\application\views\statistic\fillet\invalid.php" */ ?>
<?php /*%%SmartyHeaderCode:137036858765b4d4afbe0a70-10331537%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b89f12ccf8787a8618735c40bfd62d2a07d8f42f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\application\\views\\statistic\\fillet\\invalid.php',
      1 => 1676258698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '137036858765b4d4afbe0a70-10331537',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65b4d4afca0122_03650678',
  'variables' => 
  array (
    'base_url' => 0,
    'result' => 0,
    'khoi_luong_vao' => 0,
    'rs' => 0,
    'khoi_luong_ra' => 0,
    'i' => 0,
    'startDate' => 0,
    'endDate' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65b4d4afca0122_03650678')) {function content_65b4d4afca0122_03650678($_smarty_tpl) {?><div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
fillet/invalid" method="post" id="form">
                <div class="card-body">
                    <!-- Date and time range -->
                    <div class="form-group">
                        <label>Ngày giờ:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="text" class="form-control float-right" name="datetime" id="reservationtime">
                        </div>
                        <!-- /.input group -->
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
                            <td width="3%">STT</td>
                            <td>Lô</td>
                            <td width="10%">Mã CN</td>
                            <td>Công nhân</td>
                            <td width="10%">Mã SP</td>
                            <td>Sản phẩm</td>
                            <td>Thời gian</td>
                            <td width="15%">Khối lượng vào</td>
                            <td width="15%">Khối lượng ra</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['so_luong'] = new Smarty_variable(0, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong_vao'] = new Smarty_variable(0, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong_ra'] = new Smarty_variable(0, null, 0);?>
                        <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong_vao'] = new Smarty_variable($_smarty_tpl->tpl_vars['khoi_luong_vao']->value+$_smarty_tpl->tpl_vars['rs']->value['weight_in'], null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong_ra'] = new Smarty_variable($_smarty_tpl->tpl_vars['khoi_luong_ra']->value+$_smarty_tpl->tpl_vars['rs']->value['weight_out'], null, 0);?>
                        <tr>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['lo_id'];?>
</td>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['worker_id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['worker_name'];?>
</td>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_name'];?>
</td>
                            <td align="right"><?php echo $_smarty_tpl->tpl_vars['rs']->value['time_out'];?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_in'],3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_out'],3,",",".");?>
</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr align="right" style="font-weight: bold;">
                            <td align="right" colspan="6">Tổng: </td>
                            <td align="right"></td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['khoi_luong_vao']->value,3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['khoi_luong_ra']->value,3,",",".");?>
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
    $('#reservationtime').daterangepicker({
        timePicker: true,
        startDate: '<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
',
        endDate: '<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
',
        timePickerIncrement: 1,
        timePicker24Hour:true,
        locale: {
            format: 'DD/MM/YYYY HH:mm A'
        }
    })
});
</script><?php }} ?>
