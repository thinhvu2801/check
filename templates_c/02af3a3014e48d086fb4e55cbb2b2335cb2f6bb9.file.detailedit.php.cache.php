<?php /* Smarty version Smarty-3.1.16, created on 2024-03-23 07:54:46
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\statistic\baotubongbong\detailedit.php" */ ?>
<?php /*%%SmartyHeaderCode:159284360865fce46ca25c57-76231132%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '02af3a3014e48d086fb4e55cbb2b2335cb2f6bb9' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\statistic\\baotubongbong\\detailedit.php',
      1 => 1711176879,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '159284360865fce46ca25c57-76231132',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65fce46ca76b22_43777122',
  'variables' => 
  array (
    'base_url' => 0,
    'mes' => 0,
    'result_id' => 0,
    'rsid' => 0,
    'product' => 0,
    'pr' => 0,
    'result' => 0,
    'i' => 0,
    'rs' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65fce46ca76b22_43777122')) {function content_65fce46ca76b22_43777122($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\xampp\\htdocs\\htdocsbentre\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.date_format.php';
?><div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Kiểm tra ID</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
baotubongbong/detail_edit" method="post">
                <div class="card-body">
                    <?php if ($_smarty_tpl->tpl_vars['mes']->value!='') {?>
                    <p class="mb-0" style="color: red;"><?php echo $_smarty_tpl->tpl_vars['mes']->value;?>
</p>
                    <?php }?>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ID</span>
                            </div>
                            <input type="text" class="form-control" placeholder="ID" id="id" name="id" required pattern="[0-9]+" >
                        </div>
                    </div>
                   
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group btn-block">
                        <button type="submit" class="btn btn-info btn-sm" name="check">Kiểm tra</button>
                    </div>
                </div>
            </form>
        </div>
        <?php  $_smarty_tpl->tpl_vars['rsid'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rsid']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result_id']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rsid']->key => $_smarty_tpl->tpl_vars['rsid']->value) {
$_smarty_tpl->tpl_vars['rsid']->_loop = true;
?>
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Chỉnh sửa</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
baotubongbong/update" method="post">
                <div class="card-body">
                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['rsid']->value['id'];?>
">
                    <input type="hidden" name="worker_id" value="<?php echo $_smarty_tpl->tpl_vars['rsid']->value['worker_id'];?>
">
                    <input type="hidden" name="old_product_id" value="<?php echo $_smarty_tpl->tpl_vars['rsid']->value['product_id'];?>
">
                    <input type="hidden" name="weight" value="<?php echo $_smarty_tpl->tpl_vars['rsid']->value['weight'];?>
">
                    <input type="hidden" name="date" value="<?php echo $_smarty_tpl->tpl_vars['rsid']->value['date'];?>
">
                    <input type="hidden" name="time" value="<?php echo $_smarty_tpl->tpl_vars['rsid']->value['time'];?>
">
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Ngày</span>
                            </div>
                            <input type="text" class="form-control" id="date" name="date" required value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rsid']->value['date'],"d/m/Y");?>
" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Giờ</span>
                            </div>
                            <input type="text" class="form-control" id="time" name="time" required value="<?php echo $_smarty_tpl->tpl_vars['rsid']->value['time'];?>
" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mã CN</span>
                            </div>
                            <input type="text" class="form-control" id="worker_id" name="worker_id" required value="<?php echo $_smarty_tpl->tpl_vars['rsid']->value['worker_id'];?>
" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Tên CN</span>
                            </div>
                            <input type="text" class="form-control" id="worker_name" name="worker_name" required value="<?php echo $_smarty_tpl->tpl_vars['rsid']->value['worker_name'];?>
" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Sản phẩm:</span>
                            </div>
                            <select class="form-control" style="width: 100%;" name="product_id" id="product_id">
                                <?php  $_smarty_tpl->tpl_vars['pr'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pr']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pr']->key => $_smarty_tpl->tpl_vars['pr']->value) {
$_smarty_tpl->tpl_vars['pr']->_loop = true;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['pr']->value->product_id;?>
" <?php if ($_smarty_tpl->tpl_vars['rsid']->value['product_id']==$_smarty_tpl->tpl_vars['pr']->value->product_id) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['pr']->value->product_name;?>
</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Khối lượng</span>
                            </div>
                            <input type="text" class="form-control" id="weight" name="weight" required value="<?php echo number_format($_smarty_tpl->tpl_vars['rsid']->value['weight'],2,",",".");?>
" disabled>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group btn-block">
                        <button type="submit" class="btn btn-success btn-sm" name="capnhat">Cập nhật</button>
                    </div>
                </div>
            </form>
        </div>
        <?php } ?>
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
                                <td>ID</td>
                                <td>Mã công nhân</td>
                                <td>Tên công nhân</td>
                                <td width="15%">Sản phẩm</td>
                                <td>Khối lượng</td>
                                <td>Ngày</td>
                                <td>Thời gian</td>
                                <td>Ghi chú</td>
                            </tr>
                        </thead>
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                        <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                        <tr align="center">
                            <td><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['worker_id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['worker_name'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['product_name'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['weight'];?>
</td>
                            <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rs']->value['date'],"d/m/Y");?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['time'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['rs']->value['note'];?>
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
