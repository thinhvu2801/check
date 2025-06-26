<?php /* Smarty version Smarty-3.1.16, created on 2024-03-10 16:40:17
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\warehouse\inhistory.php" */ ?>
<?php /*%%SmartyHeaderCode:203218183965d3f9d1210961-19972097%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6cd63205888894501913af82818f7c00ba1744cb' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\warehouse\\inhistory.php',
      1 => 1710085214,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '203218183965d3f9d1210961-19972097',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65d3f9d125a226_83007224',
  'variables' => 
  array (
    'base_url' => 0,
    'mes' => 0,
    'start_date' => 0,
    'end_date' => 0,
    'warehouse_infor' => 0,
    'obj' => 0,
    'warehouse_id' => 0,
    'inhistory' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65d3f9d125a226_83007224')) {function content_65d3f9d125a226_83007224($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\xampp\\htdocs\\htdocsbentre\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.date_format.php';
?><div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Tra cứu</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
warehouse/inhistory" method="post">
                <div class="card-body">
                    <!-- <?php if ($_smarty_tpl->tpl_vars['mes']->value!='') {?>
                    <p class="mb-0" style="color: red;"><?php echo $_smarty_tpl->tpl_vars['mes']->value;?>
</p>
                    <?php }?> -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Từ</span>
                            </div>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $_smarty_tpl->tpl_vars['start_date']->value;?>
" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Đến</span>
                            </div>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $_smarty_tpl->tpl_vars['end_date']->value;?>
" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mã kho</span>
                            </div>
                            <select class="form-control" name="warehouse_id" id="warehouse_id">
                                <option value="">Tất cả</option>
                                <?php  $_smarty_tpl->tpl_vars['obj'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['obj']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['warehouse_infor']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['obj']->key => $_smarty_tpl->tpl_vars['obj']->value) {
$_smarty_tpl->tpl_vars['obj']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['obj']->value->warehouse_id;?>
" <?php if ($_smarty_tpl->tpl_vars['warehouse_id']->value==$_smarty_tpl->tpl_vars['obj']->value->warehouse_id) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['obj']->value->warehouse_id;?>

                                    (<?php echo $_smarty_tpl->tpl_vars['obj']->value->quycach_name;?>
, <?php echo $_smarty_tpl->tpl_vars['obj']->value->product_name;?>
, <?php echo $_smarty_tpl->tpl_vars['obj']->value->size_name;?>
)</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group btn-block">
                        <button type="submit" class="btn btn-info btn-sm" name="view">Xem</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Thêm từ Excel</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
warehouse/import" method="post" enctype="multipart/form-data">
                <div class="card-body">
                <?php if ($_smarty_tpl->tpl_vars['mes']->value!='') {?>
                    <p class="mb-0" style="color: red;"><?php echo $_smarty_tpl->tpl_vars['mes']->value;?>
</p>
                <?php }?>
                <div class="form-group">
                    <div class="input-group">
                    <input type="file" class="form-control" id="file_xls" name="file_xls" placeholder="Chọn file excel chứa dữ liệu" accept=".xls" required>
                    </div>
                    <div class="input-group">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
nhapkho.xls">Tải mẫu</a>
                    </div>
                    
                </div>
                <!-- /input-group -->
                <div class="form-group">
                    <label>
                    <input type="checkbox" name="thaythe" value="1">Thay thế
                    </label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm btn-block" name="import">Thêm</button>
                    </div>
                </div>
                <!-- /.card-body -->
            
            </form>
            </div>
    </div>
    <!-- col-md-3-->
    <div class="col-md-9">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Danh sách
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="font-weight: bold;" align="center">
                                <td width="2%">STT</td>
                                <td width="15%">Ngày nhập</td>
                                <td width="15%">Giờ nhập</td>
                                <td width="15%">Lý do nhập</td>
                                <td width="15%">Mã kho</td>
                                <td>Quy cách</td>
                                <td>Hàng hóa</td>
                                <td>Size</td>
                                <td>Số lượng</td>
                                <td>Khối lượng</td>
                                <td>Mã cân</td>
                            </tr>
                        </thead>
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                        <?php  $_smarty_tpl->tpl_vars['obj'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['obj']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['inhistory']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['obj']->key => $_smarty_tpl->tpl_vars['obj']->value) {
$_smarty_tpl->tpl_vars['obj']->_loop = true;
?>
                        <tr align="center">
                            <td><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                            <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['obj']->value->date,"d/m/Y");?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->time;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->reason_id;?>
</td>
                            <td><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
warehouse/inventory/<?php echo $_smarty_tpl->tpl_vars['obj']->value->warehouse_id;?>
"><?php echo $_smarty_tpl->tpl_vars['obj']->value->warehouse_id;?>
</a></td>
                            <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->quycach_name;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->product_name;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->size_name;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->quantity;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->weight;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->device_id;?>
</td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer -->
        </div>

    </div>
    <!-- col-md-8-->
</div>

<script>
    $(document).ready(function () {
        $("#size_id").focus();
        $("#warehouse_id").select2();
        $("#dataTable").DataTable({
            stateSave: true
        });
    });
</script><?php }} ?>
