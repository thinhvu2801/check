<?php /* Smarty version Smarty-3.1.16, created on 2024-03-15 12:44:26
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\statistic\fillet\no_output.php" */ ?>
<?php /*%%SmartyHeaderCode:108188348865f3e03ae5a686-06498580%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a955b56543d62ecf09c213bf657e62efd521c0f' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\statistic\\fillet\\no_output.php',
      1 => 1679017190,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '108188348865f3e03ae5a686-06498580',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'lohang' => 0,
    'lo' => 0,
    'lo_id' => 0,
    'result' => 0,
    'i' => 0,
    'rs' => 0,
    'startDate' => 0,
    'endDate' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65f3e03aeb1783_00853406',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65f3e03aeb1783_00853406')) {function content_65f3e03aeb1783_00853406($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\xampp\\htdocs\\htdocsbentre\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.date_format.php';
?><div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
fillet/no_output" method="post" id="form">
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
                            <td>Ngày</td>
                            <td>Thời gian</td>
                            <td>Lô</td>
                            <td>Rổ</td>
                            <td>Mã CN</td>
                            <td>Công nhân</td>
                            <td>Mã SP</td>
                            <td>Sản phẩm</td>
                            <td width="7%">&sum;Khối lượng</td>
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
                        <tr>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                            <td align="center"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rs']->value['date'],"d/m/Y");?>
</td>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['time_in'];?>
</td>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['lo_id'];?>
</td>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['basket_id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['worker_id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['worker_name'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_name'];?>
</td>
                            <td align="right"><?php echo $_smarty_tpl->tpl_vars['rs']->value['weight_in'];?>
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
