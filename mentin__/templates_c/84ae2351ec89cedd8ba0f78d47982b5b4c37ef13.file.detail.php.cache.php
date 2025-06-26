<?php /* Smarty version Smarty-3.1.16, created on 2023-03-22 04:21:24
         compiled from "C:\xampp\htdocs\mentin\application\views\statistic\suaca\detail.php" */ ?>
<?php /*%%SmartyHeaderCode:1149296891641a74348b0f40-82086478%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '84ae2351ec89cedd8ba0f78d47982b5b4c37ef13' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mentin\\application\\views\\statistic\\suaca\\detail.php',
      1 => 1669714245,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1149296891641a74348b0f40-82086478',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'lohang' => 0,
    'lo' => 0,
    'lo_id' => 0,
    'worker' => 0,
    'wk' => 0,
    'worker_id' => 0,
    'product' => 0,
    'pr' => 0,
    'product_id' => 0,
    'weight_in' => 0,
    'total' => 0,
    'startDate' => 0,
    'endDate' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_641a7435384568_08533578',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_641a7435384568_08533578')) {function content_641a7435384568_08533578($_smarty_tpl) {?><div class="row">
    <div class="col-md-2">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
suaca/detail" method="post" id="form">
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
                                <span class="input-group-text">LÔ</span>
                            </div>
                            <select class="form-control" name="lo_id" id="lo_id">
                                <option value="">Tất cả</option>
                                <?php  $_smarty_tpl->tpl_vars['lo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lohang']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lo']->key => $_smarty_tpl->tpl_vars['lo']->value) {
$_smarty_tpl->tpl_vars['lo']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['lo']->value->lo_id;?>
" <?php if ($_smarty_tpl->tpl_vars['lo_id']->value==$_smarty_tpl->tpl_vars['lo']->value->lo_id) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['lo']->value->lo_id;?>
</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">CN</span>
                            </div>
                            <select class="form-control" name="worker_id" id="worker_id">
                                <option value="">Tất cả</option>
                                <?php  $_smarty_tpl->tpl_vars['wk'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['wk']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['worker']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['wk']->key => $_smarty_tpl->tpl_vars['wk']->value) {
$_smarty_tpl->tpl_vars['wk']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['wk']->value->worker_id;?>
" <?php if ($_smarty_tpl->tpl_vars['worker_id']->value==$_smarty_tpl->tpl_vars['wk']->value->worker_id) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['wk']->value->worker_name;?>
</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">SP</span>
                            </div>
                            <select class="form-control" name="product_id" id="product_id">
                                <option value="">Tất cả</option>
                                <?php  $_smarty_tpl->tpl_vars['pr'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pr']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pr']->key => $_smarty_tpl->tpl_vars['pr']->value) {
$_smarty_tpl->tpl_vars['pr']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['pr']->value->product_id;?>
" <?php if ($_smarty_tpl->tpl_vars['product_id']->value==$_smarty_tpl->tpl_vars['pr']->value->product_id) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['pr']->value->product_name;?>
</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">KL vào</span>
                            </div>
                            <input type="number" value="<?php echo $_smarty_tpl->tpl_vars['weight_in']->value;?>
" step="0.001" name="weight_in" class="form-control">
                        </div>
                    </div> -->
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
    <div class="col-md-10">
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
                                <td>Ngày</td>
                                <td>TT vào</td>
                                <td>TG vào</td>
                                <td>TT ra</td>
                                <td>TG ra</td>
                                <td>TG hoàn thành</td>
                                <td>Lô</td>
                                <td>Mã NM</td>
                                <td>Mã CN</td>
                                <td>Công nhân</td>
                                <td>Mã SP</td>
                                <td>Sản phẩm</td>
                                <td>KL vào</td>
                                <td>KL ra</td>
                                <td>Định mức</td>
                               
                            </tr>
                        </thead>
                        <tfoot>
                            <td colspan="12" align="right" style="font-weight: bold;">Tổng</td>
                            <td><?php echo number_format($_smarty_tpl->tpl_vars['total']->value->weight_in,3,",",".");?>
</td>
                            <td><?php echo number_format($_smarty_tpl->tpl_vars['total']->value->weight_out,3,",",".");?>
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
            timePickerIncrement: 1,
            timePicker24Hour: true,
            locale: {
                format: 'DD/MM/YYYY HH:mm A'
            }
        })
        $('#dataTable').DataTable({
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "ajax": {
                "url": "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
suaca/detail_read",
                "data": function(d) {
                    d.start_date = "<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
";
                    d.end_date = "<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
";
                    d.weight_in = "<?php echo $_smarty_tpl->tpl_vars['weight_in']->value;?>
";
                    d.product_id = "<?php echo $_smarty_tpl->tpl_vars['product_id']->value;?>
";
                    d.worker_id = "<?php echo $_smarty_tpl->tpl_vars['worker_id']->value;?>
";
                    d.lo_id = "<?php echo $_smarty_tpl->tpl_vars['lo_id']->value;?>
";
                }
            }
        });
        $('#worker_id').select2();
    });
</script><?php }} ?>
