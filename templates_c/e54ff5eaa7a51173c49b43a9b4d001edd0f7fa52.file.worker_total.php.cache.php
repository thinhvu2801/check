<?php /* Smarty version Smarty-3.1.16, created on 2024-03-21 08:29:21
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\statistic\fillet\worker_total.php" */ ?>
<?php /*%%SmartyHeaderCode:99603905865d2ef0d9b3bd3-18991546%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e54ff5eaa7a51173c49b43a9b4d001edd0f7fa52' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\statistic\\fillet\\worker_total.php',
      1 => 1710984559,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '99603905865d2ef0d9b3bd3-18991546',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65d2ef0df22a77_44128994',
  'variables' => 
  array (
    'base_url' => 0,
    'lohang' => 0,
    'lo' => 0,
    'lo_id' => 0,
    'result' => 0,
    'quantity' => 0,
    'rs' => 0,
    'weight_in' => 0,
    'weight_out' => 0,
    'i' => 0,
    'startDate' => 0,
    'endDate' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65d2ef0df22a77_44128994')) {function content_65d2ef0df22a77_44128994($_smarty_tpl) {?><div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
fillet/worker_total" method="post" id="form">
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
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">LÔ</i></span>
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
                    
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group btn-block">
                    <button type="submit" class="btn btn-info btn-sm" name="statistic">Thống kê</button>
                    <button type="submit" class="btn btn-success btn-sm" name="export">Xuất file</button>
                    <button type="submit" class="btn btn-success btn-sm" name="export_">Xuất file 2</button>
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
                            <td>Mã NM</td>
                            <td>Mã CN</td>
                            <td>Công nhân</td>
                            <td>Mã SP</td>
                            <td>Sản phẩm</td>
                            <td width="7%">Số lượng</td>
                            <td width="7%">&sum;KL vào</td>
                            <td width="7%">&sum;KL ra</td>
                            <td width="7%">Định mức</td>
                            <td width="7%">Thời gian</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['quantity'] = new Smarty_variable(0, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['weight_in'] = new Smarty_variable(0, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['weight_out'] = new Smarty_variable(0, null, 0);?>
                        <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                        <?php $_smarty_tpl->tpl_vars['quantity'] = new Smarty_variable($_smarty_tpl->tpl_vars['quantity']->value+$_smarty_tpl->tpl_vars['rs']->value['quantity'], null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['weight_in'] = new Smarty_variable($_smarty_tpl->tpl_vars['weight_in']->value+$_smarty_tpl->tpl_vars['rs']->value['weight_in'], null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['weight_out'] = new Smarty_variable($_smarty_tpl->tpl_vars['weight_out']->value+$_smarty_tpl->tpl_vars['rs']->value['weight_out'], null, 0);?>
                        <tr>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['factory_id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['worker_id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['worker_name'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_id'];?>
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
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['min_time'];?>
 - <?php echo $_smarty_tpl->tpl_vars['rs']->value['max_time'];?>
</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td align="right" colspan="6">Tổng: </td>
                            <td align="right"><?php echo $_smarty_tpl->tpl_vars['quantity']->value;?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['weight_in']->value,3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['weight_out']->value,3,",",".");?>
</td>
                            <td></td><td></td>
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
