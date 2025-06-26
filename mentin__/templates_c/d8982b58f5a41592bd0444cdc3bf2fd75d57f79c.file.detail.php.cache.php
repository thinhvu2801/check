<?php /* Smarty version Smarty-3.1.16, created on 2023-03-20 04:36:31
         compiled from "C:\xampp\htdocs\mentin\application\views\statistic\weightgain\detail.php" */ ?>
<?php /*%%SmartyHeaderCode:2116108639641442fda35a21-46012197%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd8982b58f5a41592bd0444cdc3bf2fd75d57f79c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mentin\\application\\views\\statistic\\weightgain\\detail.php',
      1 => 1679283390,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2116108639641442fda35a21-46012197',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_641442fda8f8a1_80908533',
  'variables' => 
  array (
    'base_url' => 0,
    'lohang' => 0,
    'lo' => 0,
    'lo_id' => 0,
    'coi_id' => 0,
    'weight_in' => 0,
    'result' => 0,
    'khoi_luong' => 0,
    'rs' => 0,
    'i' => 0,
    'startDate' => 0,
    'endDate' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_641442fda8f8a1_80908533')) {function content_641442fda8f8a1_80908533($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\mentin\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.date_format.php';
?><div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
weightgain/detail" method="post" id="form">
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
                                <span class="input-group-text">Cối</span>
                            </div>
                           <input type="number" class="form-control"  name="coi_id" id="coi_id" value="<?php echo $_smarty_tpl->tpl_vars['coi_id']->value;?>
"/>
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
                                <td>Ngày lấy dữ liệu</td>
                                <td>Ngày cân</td>
                                <td>Mẻ</td>
                                <td>Giờ cân</td>
                                <td width="10%">Chất lượng</td>
                                <td>Size</td>
                                <td>Cối</td>
                                <td width="10%">Khối lượng</td>
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
                            <?php $_smarty_tpl->tpl_vars['khoi_luong'] = new Smarty_variable($_smarty_tpl->tpl_vars['khoi_luong']->value+$_smarty_tpl->tpl_vars['rs']->value['weight'], null, 0);?>
                            <tr>
                                <td align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                                <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['lo_id'];?>
</td>
                                <td align="center"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rs']->value['date_data'],"d/m/Y");?>
</td>
                                <td align="center"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rs']->value['date'],"d/m/Y");?>
</td>
                                <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['me_id'];?>
</td>
                                <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['time'];?>
</td>
                                <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['quality_id'];?>
</td>
                                <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['size_id'];?>
</td>
                                <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['coi_id'];?>
</td>
                                <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight'],3,",",".");?>
</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr style="font-weight:bold;">
                                <td align="right" colspan="9">Tổng: </td>
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
            timePicker24Hour: true,
            locale: {
                format: 'DD/MM/YYYY HH:mm A'
            }
        })
    });
</script><?php }} ?>
