<?php /* Smarty version Smarty-3.1.16, created on 2024-03-22 09:22:07
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\statistic\baotubongbong\detail.php" */ ?>
<?php /*%%SmartyHeaderCode:157162031565e13fa0dd0ad1-16137870%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f3a6f8b4b668f6b318ae78534332be834db7ef50' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\statistic\\baotubongbong\\detail.php',
      1 => 1711091745,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '157162031565e13fa0dd0ad1-16137870',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65e13fa0e2c6a9_57528591',
  'variables' => 
  array (
    'base_url' => 0,
    'lohang' => 0,
    'lo' => 0,
    'lo_id' => 0,
    'worker' => 0,
    'wk' => 0,
    'worker_id' => 0,
    'product' => 0,
    'pr' => 0,
    'product_id' => 0,
    'result' => 0,
    'khoi_luong' => 0,
    'rs' => 0,
    'i' => 0,
    'admin' => 0,
    'startDate' => 0,
    'endDate' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65e13fa0e2c6a9_57528591')) {function content_65e13fa0e2c6a9_57528591($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\xampp\\htdocs\\htdocsbentre\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.date_format.php';
?><div class="row">
    <div class="col-md-3">
        <div class="card card-info" id="card_filter">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
baotubongbong/detail" method="post" id="form">
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
                                <span class="input-group-text">CN</span>
                            </div>
                            <select class="form-control" name="worker_id" id="worker_id">
                                <option value="">Tất cả</option>
                                <?php  $_smarty_tpl->tpl_vars['wk'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['wk']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['worker']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['wk']->key => $_smarty_tpl->tpl_vars['wk']->value) {
$_smarty_tpl->tpl_vars['wk']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['wk']->value->worker_id;?>
" <?php if ($_smarty_tpl->tpl_vars['worker_id']->value==$_smarty_tpl->tpl_vars['wk']->value->worker_id) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['wk']->value->worker_name;?>
</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">SP</span>
                            </div>
                            <select class="form-control" name="product_id" id="product_id">
                                <option value="">Tất cả</option>
                                <?php  $_smarty_tpl->tpl_vars['pr'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pr']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pr']->key => $_smarty_tpl->tpl_vars['pr']->value) {
$_smarty_tpl->tpl_vars['pr']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['pr']->value->product_id;?>
" <?php if ($_smarty_tpl->tpl_vars['product_id']->value==$_smarty_tpl->tpl_vars['pr']->value->product_id) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['pr']->value->product_name;?>
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
                            <td>Id</td>
                            <td>Mã thẻ</td>
                            <td>Mã công nhân</td>
                            <td width="20%">Công nhân</td>
                            <!-- <td>Mã sản phẩm</td> -->
                            <td>Sản phẩm</td>
                            <td width="10%">Khối lượng</td>
                            <td width="13%">Ngày</td>
                            <td>TG</td>
                            <!-- <td></td> -->
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
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['factory_id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['worker_id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['worker_name'];?>
</td>
                            <!-- <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_id'];?>
</td> -->
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_name'];?>
</td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['rs']->value['weight'],3,",",".");?>
</td>
                            <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rs']->value['date'],"d/m/Y");?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['time'];?>
</td>
                            <!-- <td>
                                <?php if (($_smarty_tpl->tpl_vars['admin']->value==1)||($_smarty_tpl->tpl_vars['admin']->value==99)) {?>
                                    <?php if ((empty($_smarty_tpl->tpl_vars['rs']->value['note']))) {?>
                                        <input type="button" name="editButton" style="margin-top:5px; padding:5px;" value="Sửa" data-toggle="modal" data-target="#update<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" style="cursor: pointer;" alt="Điều chỉnh">
                                        </input>
                                    <?php }?>
                                <?php }?>
                            </td> -->
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr align="right" style="font-weight: bold;">
                            <td align="right" colspan="7">Tổng: </td>
                            <td align="right"><?php echo number_format($_smarty_tpl->tpl_vars['khoi_luong']->value,3,",",".");?>
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
    </div><!-- ./col-md-8-->
</div>
<?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
<div class="modal fade" id="update<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Điều chỉnh</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="post" name="updateproduct" action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
baotubongbong/update">
        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">
        <div class="modal-body">
            <div class="form-group row">
            <label for="worker_id" class="col-sm-2 col-form-label">Mã công nhân:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="worker_id<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" name="worker_id" placeholder="Mã công nhân" required value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['worker_id'];?>
" disabled>
                </div>
            </div>
          <div class="form-group row">
            <label for="worker_name" class="col-sm-2 col-form-label">Tên công nhân:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="worker_name<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" name="worker_name" placeholder="Tên công nhân" required value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['worker_name'];?>
" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="product_id" class="col-sm-2 col-form-label">Sản phẩm:</label>
            <div class="col-sm-10">
              <select class="form-control group_product" style="width: 100%;" name="product_id" id="product_id<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">
                    <?php  $_smarty_tpl->tpl_vars['pr'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pr']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pr']->key => $_smarty_tpl->tpl_vars['pr']->value) {
$_smarty_tpl->tpl_vars['pr']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['pr']->value->product_id;?>
" <?php if ($_smarty_tpl->tpl_vars['rs']->value['product_id']==$_smarty_tpl->tpl_vars['pr']->value->product_id) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['pr']->value->product_name;?>
</option>
                    <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary btn-sm" name="editcapnhat" data-so-phieu="<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">Cập nhật</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>
<script>
$(document).ready(function() {
    $('#lo_id,#worker_id,#product_id').select2();
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
