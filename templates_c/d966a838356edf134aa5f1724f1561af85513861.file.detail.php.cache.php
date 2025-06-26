<?php /* Smarty version Smarty-3.1.16, created on 2024-03-19 08:24:07
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\statistic\errorlog\detail.php" */ ?>
<?php /*%%SmartyHeaderCode:200163879965f93a74c022d0-67428587%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd966a838356edf134aa5f1724f1561af85513861' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\statistic\\errorlog\\detail.php',
      1 => 1710833044,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '200163879965f93a74c022d0-67428587',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65f93a75131885_72912654',
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
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65f93a75131885_72912654')) {function content_65f93a75131885_72912654($_smarty_tpl) {?><div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
errorlog/detail" method="post" id="form">
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
                            <td width="10%" align="left">Thiết bị</td>
                            <td width="10%">Mã thẻ</td>
                            <td  width="10%">Mã lỗi</td>
                            <td>Diễn giải</td>
                            <td  width="10%">Thời gian</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                        <tr align="center">
                            <td><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['DEVICE_ID'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['WORKER_ID'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['ERROR_CODE'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['error_name'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['GIO'];?>
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
        $('#dataTable').DataTable();
    });
</script><?php }} ?>
