<?php /* Smarty version Smarty-3.1.16, created on 2024-09-10 04:19:00
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\statistic\baotubongbong\worker.php" */ ?>
<?php /*%%SmartyHeaderCode:161353515765e27851b469c8-98236639%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5328affe9360acedc94d738ad64690444e85abfa' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\statistic\\baotubongbong\\worker.php',
      1 => 1725934738,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '161353515765e27851b469c8-98236639',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65e27851bc9ed4_40438668',
  'variables' => 
  array (
    'base_url' => 0,
    'result' => 0,
    'khoi_luong' => 0,
    'rs' => 0,
    'khoi_luong_before18' => 0,
    'khoi_luong_after18' => 0,
    'i' => 0,
    'startDate' => 0,
    'endDate' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65e27851bc9ed4_40438668')) {function content_65e27851bc9ed4_40438668($_smarty_tpl) {?><div class="row">
    <div class="col-md-3">
        <div class="card card-info" id="card_filter">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
baotubongbong/worker" method="post" id="form">
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
                            <td width="3%">STT</td>
                            <td>Mã CN</td>
                            <td>Tên CN</td>
                            <td>SP</td>
                            <td width="15%">KL trước 18h30</td>
                            <td width="15%">KL sau 18h30</td>
                            <td width="15%">KL tổng</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong'] = new Smarty_variable(0, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong_before18'] = new Smarty_variable(0, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong_after18'] = new Smarty_variable(0, null, 0);?>
                        <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong'] = new Smarty_variable($_smarty_tpl->tpl_vars['khoi_luong']->value+$_smarty_tpl->tpl_vars['rs']->value['weight_total'], null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong_before18'] = new Smarty_variable($_smarty_tpl->tpl_vars['khoi_luong_before18']->value+$_smarty_tpl->tpl_vars['rs']->value['weight_before_18'], null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong_after18'] = new Smarty_variable($_smarty_tpl->tpl_vars['khoi_luong_after18']->value+$_smarty_tpl->tpl_vars['rs']->value['weight_after_18'], null, 0);?>
                        <tr>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['worker_id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['worker_name'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_name'];?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_before_18'],3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_after_18'],3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_total'],3,",",".");?>
</td>
                            
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr align="right" style="font-weight: bold;">
                            <td align="right" colspan="4">Tổng: </td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['khoi_luong_before18']->value,3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['khoi_luong_after18']->value,3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['khoi_luong']->value,3,",",".");?>
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
