<?php /* Smarty version Smarty-3.1.16, created on 2024-05-02 03:26:32
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\statistic\fillet\over_threshold.php" */ ?>
<?php /*%%SmartyHeaderCode:206902426265d2f0a3a0d858-60015823%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4bf54ab11cc28f48dae761fc7c1f9c005cf6e439' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\statistic\\fillet\\over_threshold.php',
      1 => 1714613175,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '206902426265d2f0a3a0d858-60015823',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65d2f0a3a77000_78596606',
  'variables' => 
  array (
    'base_url' => 0,
    'date' => 0,
    'lohang' => 0,
    'lo' => 0,
    'lo_id' => 0,
    'result' => 0,
    'rs' => 0,
    'i' => 0,
    'startDate' => 0,
    'endDate' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65d2f0a3a77000_78596606')) {function content_65d2f0a3a77000_78596606($_smarty_tpl) {?><div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/fillet/over_threshold" method="post" id="form">
                <div class="card-body">
                    <!-- Date and time range -->
                    <!-- <div class="form-group">
                        <label>Ngày giờ:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="date" value="<?php echo $_smarty_tpl->tpl_vars['date']->value;?>
" class="form-control" name="date">
                        </div>
                    </div> -->
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
                        <tr style="font-weight: bold;" align="center" >
                            <!-- <td width="3%">STT</td> -->
                            <td>Lô</td>
                            <td width="10%">Mã CN</td>
                            <td>Công nhân</td>
                           <!--  <td width="10%">Mã SP</td> -->
                            <td>Sản phẩm</td>
                            <td>Định mức SP</td>
                            <td>KL vào</td>
                            <td>KL ra</td>
                            <td>Định mức</td>
                            <td>Loại</td>
                            <td>Thời gian</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                        <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                        <?php if ($_smarty_tpl->tpl_vars['rs']->value['type_over_threshold']=='Vượt') {?>
                            <tr style="color: blue;">
                        <?php } else { ?>
                            <tr style="color: red;">
                        <?php }?>
                            <!-- <td align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td> -->
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['lo_id'];?>
</td>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['worker_id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['worker_name'];?>
</td>
                            <!-- <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_id'];?>
</td> -->
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_name'];?>
</td>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['dinh_muc_min'];?>
 - <?php echo $_smarty_tpl->tpl_vars['rs']->value['dinh_muc_max'];?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_in'],3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_out'],3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['dinh_muc'],3,",",".");?>
</td>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['type_over_threshold'];?>
</td>
                            <td align="right"><?php echo $_smarty_tpl->tpl_vars['rs']->value['time_out'];?>
</td>
                        </tr>
                        <?php } ?>
                    </tbody>
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
