<?php /* Smarty version Smarty-3.1.16, created on 2023-02-28 15:05:55
         compiled from "C:\xampp\htdocs\demo\application\views\statistic\machine\dataweigh\general.php" */ ?>
<?php /*%%SmartyHeaderCode:103084250063f86b5d5e5464-46204044%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '34b93dddd9a2a83dfe46f1213ed43113b0ccb867' => 
    array (
      0 => 'C:\\xampp\\htdocs\\demo\\application\\views\\statistic\\machine\\dataweigh\\general.php',
      1 => 1677593154,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '103084250063f86b5d5e5464-46204044',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_63f86b5d694117_25083637',
  'variables' => 
  array (
    'base_url' => 0,
    'machine_code' => 0,
    'machine_serial' => 0,
    'option' => 0,
    'result' => 0,
    'soluong' => 0,
    'rs' => 0,
    'khoiluong' => 0,
    'i' => 0,
    'tong' => 0,
    'reject' => 0,
    'startDate' => 0,
    'endDate' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_63f86b5d694117_25083637')) {function content_63f86b5d694117_25083637($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\demo\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.date_format.php';
?><div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
machine/index/<?php echo $_smarty_tpl->tpl_vars['machine_code']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['machine_serial']->value;?>
" method="post" id="form">
                <input type="hidden" name="machine_code" value="<?php echo $_smarty_tpl->tpl_vars['machine_code']->value;?>
" />
                <input type="hidden" name="machine_serial" value="<?php echo $_smarty_tpl->tpl_vars['machine_serial']->value;?>
" />
                <input type="hidden" name="option" value="<?php echo $_smarty_tpl->tpl_vars['option']->value;?>
" />
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
                        <button type="submit" class="btn btn-info btn-sm" name="detail">Chi tiết</button>
                        <button type="submit" class="btn btn-info btn-sm" name="general">Tổng hợp</button>
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
                    <?php if ($_smarty_tpl->tpl_vars['option']->value==1) {?>
                    <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="font-weight: bold;" align="center">
                                <td width="3%">STT</td>
                                <td>Túi</td>
                                <td>Size</td>
                                <td>Miếng</td>
                                <td>Số lượng</td>
                                <td>Khối lượng</td>
                                <td>Trung bình</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['soluong'] = new Smarty_variable(0, null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['khoiluong'] = new Smarty_variable(0, null, 0);?>
                            <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                            <?php $_smarty_tpl->tpl_vars['soluong'] = new Smarty_variable($_smarty_tpl->tpl_vars['soluong']->value+$_smarty_tpl->tpl_vars['rs']->value['count_combine'], null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['khoiluong'] = new Smarty_variable($_smarty_tpl->tpl_vars['khoiluong']->value+$_smarty_tpl->tpl_vars['rs']->value['total_weight'], null, 0);?>
                            <tr>
                                <td align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                                <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['batch'];?>
</td>
                                <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['size'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['num_pieces'];?>
</td>
                                <td align="right"><?php echo $_smarty_tpl->tpl_vars['rs']->value['count_combine'];?>
</td>
                                <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['total_weight'],0,",",".");?>
</td>
                                <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['avg_combine'],0,",",".");?>
</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td align="right" colspan="4">Tổng: </td>
                                <td align="right"><?php echo $_smarty_tpl->tpl_vars['soluong']->value;?>
</td>
                                <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['khoiluong']->value,0,",",".");?>
</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    <?php } else { ?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="btn-success" style="font-weight: bold;" align="center">
                                <td width="3%">TT</td>
                                <td>Số miếng</td>
                                <td>Size</td>
                                <td>Túi</td>
                                <td>KL túi</td>
                                <td>KL từng miếng</td>
                                <td>Thời gian</td>
                            </tr>
                        </thead>
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['tong'] = new Smarty_variable(0, null, 0);?>
                        <tbody>
                            <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                            <?php $_smarty_tpl->tpl_vars['tong'] = new Smarty_variable($_smarty_tpl->tpl_vars['tong']->value+$_smarty_tpl->tpl_vars['rs']->value['total_weight'], null, 0);?>
                            <tr align="center">
                                <td><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['num_pieces'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['size'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['batch'];?>
</td>
                                <td><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['total_weight'],0,",",".");?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['weight_scale'];?>
</td>
                                <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rs']->value['time'],"%H:%M");?>
</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr style="font-weight: bold;" align="right">
                                <td colspan="4">Tổng cộng: </td>
                                <td align="center"><?php echo number_format($_smarty_tpl->tpl_vars['tong']->value,0,",",".");?>
</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    <?php }?>
                </div>
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTableReject" width="100%" cellspacing="0">
                        <thead>
                            <tr class="btn-danger" style="font-weight: bold;" align="center">
                                <td width="3%">TT</td>
                                <td>Tổ hợp loại</td>
                                <td>Số miếng</td>
                                <td>Số lần loại</td>
                                <td>Khối lượng</td>
                            </tr>
                        </thead>
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['tong'] = new Smarty_variable(0, null, 0);?>
                        <tbody>
                            <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['reject']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                            <?php $_smarty_tpl->tpl_vars['tong'] = new Smarty_variable($_smarty_tpl->tpl_vars['tong']->value+$_smarty_tpl->tpl_vars['rs']->value['total_weight'], null, 0);?>
                            <tr>
                                <td  align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['type_combine'];?>
</td>
                                <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['num_pieces'];?>
</td>
                                <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['count_combine'];?>
</td>
                                <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['total_weight'],0,",",".");?>
</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr style="font-weight: bold;" align="right">
                                <td colspan="4">Tổng cộng: </td>
                                <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['tong']->value,0,",",".");?>
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
            timePicker24Hour: true,
            locale: {
                format: 'DD/MM/YYYY HH:mm A'
            }
        })
    });
</script><?php }} ?>
