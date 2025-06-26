<?php /* Smarty version Smarty-3.1.16, created on 2025-04-11 12:23:13
         compiled from "C:\xampp\htdocs\check\application\views\statistic\suaca\product.php" */ ?>
<?php /*%%SmartyHeaderCode:150271197867f8ed916ac4d7-40906820%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '82ac73a0c98e8e4460fd17c5d45cb6becc44493f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\check\\application\\views\\statistic\\suaca\\product.php',
      1 => 1725933243,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150271197867f8ed916ac4d7-40906820',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'lohang' => 0,
    'lo' => 0,
    'lo_id' => 0,
    'weight_in' => 0,
    'result' => 0,
    'rs' => 0,
    'khoi_luong_tra_ve_vao' => 0,
    'khoi_luong_tra_ve_ra' => 0,
    'kl_vao_real' => 0,
    'kl_vao' => 0,
    'kl_ra' => 0,
    'i' => 0,
    'khoi_luong' => 0,
    'khoi_luong_ra' => 0,
    'startDate' => 0,
    'endDate' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_67f8ed9175bb16_66309496',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_67f8ed9175bb16_66309496')) {function content_67f8ed9175bb16_66309496($_smarty_tpl) {?><div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
suaca/product" method="post" id="form">
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
                    <!-- <button type="submit" class="btn btn-success btn-sm" name="export">Xuất file</button> -->
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
                <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
suaca/product" method="post">
                    <input type="hidden" class="form-control float-right" name="datetime" id="reservationtime2">
                    <button type="submit" class="btn btn-success btn-sm float-right" name="export">Xuất file</button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="font-weight: bold;" align="center">
                            <td width="3%">STT</td>
                            <!-- <td>Lô</td> -->
                            <td width="10%">Mã</td>
                            <td>Sản phẩm</td>
                            <td width="10%">KL vào thực tế</td>
                            <td width="10%">KL vào</td>
                            <td width="10%">KL vào trả về</td>
                            <td width="10%">KL ra</td>
                            <td width="10%">KL ra trả về</td>
                            <td width="10%">Định mức</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['kl_vao_real'] = new Smarty_variable(0, null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['khoi_luong_tra_ve_vao'] = new Smarty_variable(0, null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['khoi_luong_tra_ve_ra'] = new Smarty_variable(0, null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['kl_vao'] = new Smarty_variable(0, null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['kl_ra'] = new Smarty_variable(0, null, 0);?>
                    <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                        <?php if (strpos($_smarty_tpl->tpl_vars['rs']->value['product_id'],'TRAVE')===false) {?>
                            <?php $_smarty_tpl->tpl_vars['khoi_luong_tra_ve_vao'] = new Smarty_variable($_smarty_tpl->tpl_vars['khoi_luong_tra_ve_vao']->value+($_smarty_tpl->tpl_vars['rs']->value['weightback']), null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['khoi_luong_tra_ve_ra'] = new Smarty_variable($_smarty_tpl->tpl_vars['khoi_luong_tra_ve_ra']->value+($_smarty_tpl->tpl_vars['rs']->value['weight_out_back']), null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['kl_vao_real'] = new Smarty_variable($_smarty_tpl->tpl_vars['kl_vao_real']->value+$_smarty_tpl->tpl_vars['rs']->value['weight_in_real'], null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['kl_vao'] = new Smarty_variable($_smarty_tpl->tpl_vars['kl_vao']->value+$_smarty_tpl->tpl_vars['rs']->value['weight_in'], null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['kl_ra'] = new Smarty_variable($_smarty_tpl->tpl_vars['kl_ra']->value+$_smarty_tpl->tpl_vars['rs']->value['weight_out'], null, 0);?>
                            <tr>
                                <td align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                                <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_id'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_name'];?>
</td>
                                <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_in_real'],3,",",".");?>
</td>
                                <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_in'],3,",",".");?>
</td>
                                <td align="right">
                                    <?php echo number_format(($_smarty_tpl->tpl_vars['rs']->value['weightback']),3,",",".");?>

                                </td>
                                <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_out'],3,",",".");?>
</td>
                                <td align="right">
                                    <?php echo number_format(($_smarty_tpl->tpl_vars['rs']->value['weight_out_back']),3,",",".");?>

                                </td>
                                <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['dinh_muc'],3,",",".");?>
</td>
                            </tr>
                        <?php }?>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr align="right" style="font-weight: bold;">
                            <td align="right" colspan="3">Tổng khối lượng trước khi có cá trả về: </td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['kl_vao_real']->value,3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['kl_vao']->value,3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['khoi_luong_tra_ve_vao']->value,3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['kl_ra']->value,3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['khoi_luong_tra_ve_ra']->value,3,",",".");?>
</td>
                            <td></td>
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
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Kết quả trả về
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable2" width="100%" cellspacing="0">
                    <thead>
                        <tr style="font-weight: bold;" align="center">
                            <td>STT</td>
                            <td>Mã sản phẩm</td>
                            <td>Sản phẩm</td>
                            <td>Khối lượng vào</td>
                            <td>Khối lượng ra</td>
                            <td>Định mức</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong'] = new Smarty_variable(0, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong_ra'] = new Smarty_variable(0, null, 0);?>
                        <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                        <?php if (strpos($_smarty_tpl->tpl_vars['rs']->value['product_id'],'TRAVE')!==false) {?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong'] = new Smarty_variable($_smarty_tpl->tpl_vars['khoi_luong']->value+$_smarty_tpl->tpl_vars['rs']->value['weight_in'], null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong_ra'] = new Smarty_variable($_smarty_tpl->tpl_vars['khoi_luong_ra']->value+$_smarty_tpl->tpl_vars['rs']->value['weight_out'], null, 0);?>
                        <tr>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_name'];?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_in'],3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight_out'],3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['dinh_muc'],3,",",".");?>
</td>
                        </tr>
                        <?php }?>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr align="right" style="font-weight: bold;">
                            <td align="right" colspan="3">Tổng: </td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['khoi_luong']->value,3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['khoi_luong_ra']->value,3,",",".");?>
</td>
                            <td align="right"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div><!-- ./col-md-8-->
</div>
<script>
    $(document).ready(function() {
        $('#lo_id').select2();
        $('#dataTable').dataTable({
        "stateSave": true,
        "pageLength":25
    });
    $('#dataTable2').dataTable();
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
    });
    $('#reservationtime2').daterangepicker({
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
