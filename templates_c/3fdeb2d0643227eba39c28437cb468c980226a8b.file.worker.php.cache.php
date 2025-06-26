<?php /* Smarty version Smarty-3.1.16, created on 2024-02-01 03:21:43
         compiled from "C:\xampp\htdocs\application\views\statistic\fillet\worker.php" */ ?>
<?php /*%%SmartyHeaderCode:20135165865b46d4dc36892-50060109%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3fdeb2d0643227eba39c28437cb468c980226a8b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\application\\views\\statistic\\fillet\\worker.php',
      1 => 1689430314,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20135165865b46d4dc36892-50060109',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65b46d4dd20e95_73830754',
  'variables' => 
  array (
    'base_url' => 0,
    'lohang' => 0,
    'lo' => 0,
    'lo_id' => 0,
    'result' => 0,
    'so_luong' => 0,
    'rs' => 0,
    'khoi_luong_vao' => 0,
    'khoi_luong_ra' => 0,
    'i' => 0,
    'startDate' => 0,
    'endDate' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65b46d4dd20e95_73830754')) {function content_65b46d4dd20e95_73830754($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.date_format.php';
?><div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
fillet/worker" method="post" id="form">
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
                        <span>Cài đặt <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
threshold">Định mức chuẩn </a> để phân loại đậu, rớt định mức</span>
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
                            <td width="3%">TT</td>
                            <td width="7%">Ngày</td>
                            <td width="7%">Lô</td>
                            <td>Công nhân</td>
                            <td>Sản phẩm</td>
                            <td width="7%">&sum;SL</td>
                            <td width="7%">&sum;vào</td>
                            <td width="7%">&sum;ra</td>
                            <td width="7%">&sum;SL đạt</td>
                            <td width="7%">&sum;vào đạt</td>
                            <td width="7%">&sum;ra đạt</td>
                            <td width="7%">&sum;SL rớt</td>
                            <td width="7%">&sum;vào rớt</td>
                            <td width="7%">&sum;ra rớt</td>
                            <td width="7%">&sum;SL vượt</td>
                            <td width="7%">&sum;vào vượt</td>
                            <td width="7%">&sum;ra vượt</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['so_luong'] = new Smarty_variable(0, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong_vao'] = new Smarty_variable(0, null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong_ra'] = new Smarty_variable(0, null, 0);?>
                        <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                         <?php $_smarty_tpl->tpl_vars['so_luong'] = new Smarty_variable($_smarty_tpl->tpl_vars['so_luong']->value+$_smarty_tpl->tpl_vars['rs']->value['so_luong'], null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong_vao'] = new Smarty_variable($_smarty_tpl->tpl_vars['khoi_luong_vao']->value+$_smarty_tpl->tpl_vars['rs']->value['tong_kl_vao'], null, 0);?>
                        <?php $_smarty_tpl->tpl_vars['khoi_luong_ra'] = new Smarty_variable($_smarty_tpl->tpl_vars['khoi_luong_ra']->value+$_smarty_tpl->tpl_vars['rs']->value['tong_kl_ra'], null, 0);?>
                        <tr>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                            <td align="center"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rs']->value['date'],"d/m/Y");?>
</td>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['lo_id'];?>
</td>
                            <td>(<?php echo $_smarty_tpl->tpl_vars['rs']->value['worker_id'];?>
) <?php echo $_smarty_tpl->tpl_vars['rs']->value['worker_name'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_name'];?>
</td>
                            <td align="right"><?php echo $_smarty_tpl->tpl_vars['rs']->value['so_luong'];?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['tong_kl_vao'],3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['tong_kl_ra'],3,",",".");?>
</td>
                            <td align="right"><?php echo $_smarty_tpl->tpl_vars['rs']->value['so_luong_dat'];?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['kl_vao_dat_dm'],3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['kl_ra_dat_dm'],3,",",".");?>
</td>
                            <td align="right"><?php echo $_smarty_tpl->tpl_vars['rs']->value['so_luong_rot'];?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['kl_vao_rot_dm'],3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['kl_ra_rot_dm'],3,",",".");?>
</td>
                            <td align="right"><?php echo $_smarty_tpl->tpl_vars['rs']->value['so_luong_vuot'];?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['kl_vao_vuot_dm'],3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['kl_ra_vuot_dm'],3,",",".");?>
</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr align="right" style="font-weight: bold;">
                            <td align="right" colspan="5">Tổng: </td>
                             <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['so_luong']->value,0,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['khoi_luong_vao']->value,3,",",".");?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['khoi_luong_ra']->value,3,",",".");?>
</td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
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
        $('#dataTable').dataTable({ "scrollX": true});
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
