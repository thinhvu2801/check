<?php /* Smarty version Smarty-3.1.16, created on 2025-06-23 02:54:58
         compiled from "D:\App\Wampp\www\check\application\views\statistic\errorlog\general.php" */ ?>
<?php /*%%SmartyHeaderCode:19079442526858c202b12cc9-72879278%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9c33c585493c5d34512f68067e2c828a1d7f4585' => 
    array (
      0 => 'D:\\App\\Wampp\\www\\check\\application\\views\\statistic\\errorlog\\general.php',
      1 => 1668505746,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19079442526858c202b12cc9-72879278',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'result' => 0,
    'i' => 0,
    'rs' => 0,
    'startDate' => 0,
    'endDate' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_6858c202b30707_99238386',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6858c202b30707_99238386')) {function content_6858c202b30707_99238386($_smarty_tpl) {?><div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
errorlog/general" method="post" id="form">
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
                            <td width="10%">Thiết bị</td>
                            <td width="10%">Mã thẻ</td>
                            <td width="10%">Mã lỗi</td>
                            <td>Diễn giải</td>
                            <td width="10%">Số lượng</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                        <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                        <tr>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['DEVICE_ID'];?>
</td>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['WORKER_ID'];?>
</td>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['ERROR_CODE'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['error_name'];?>
</td>
                            <td align="right"><?php echo $_smarty_tpl->tpl_vars['rs']->value['SO_LUONG'];?>
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
