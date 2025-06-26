<?php /* Smarty version Smarty-3.1.16, created on 2024-02-20 01:43:03
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\warehouse\reason_out.php" */ ?>
<?php /*%%SmartyHeaderCode:32920444965d3f597d5e5b6-60679990%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '66af7c19a13389de2ee13f25704ff683332b9c43' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\warehouse\\reason_out.php',
      1 => 1705929538,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32920444965d3f597d5e5b6-60679990',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'mes' => 0,
    'date' => 0,
    'reason_out' => 0,
    'i' => 0,
    'obj' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65d3f597da7a52_69133656',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65d3f597da7a52_69133656')) {function content_65d3f597da7a52_69133656($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\xampp\\htdocs\\htdocsbentre\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.date_format.php';
?><div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Thêm thủ công</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
warehouse/reason_out" method="post">
                <div class="card-body">
                    <?php if ($_smarty_tpl->tpl_vars['mes']->value!='') {?>
                    <p class="mb-0" style="color: red;"><?php echo $_smarty_tpl->tpl_vars['mes']->value;?>
</p>
                    <?php }?>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mã lý do xuất</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Mã lý do xuất" id="reason_id"
                                name="reason_id" required maxlength="20" pattern="[A-Za-z0-9-_]{2,}"
                                >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mô tả</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Mô tả" id="reason_description"
                                name="reason_description" required pattern="[A-Za-z0-9-_]{2,}"
                                >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Ngày</span>
                            </div>
                            <input type="date" class="form-control" id="date" name="date" value="<?php echo $_smarty_tpl->tpl_vars['date']->value;?>
" required>
                        </div>
                    </div>
                   
                    <div class="input-group mb-3">
                        <button type="submit" class="btn btn-success btn-sm btn-block">Thêm</button>
                    </div>
                    <!-- /input-group -->
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
                                <td width="15%">Mã lý do xuất</td>
                                <td>Mô tả</td>
                                <td>Ngày</td>
                                <td width="15%">Chức năng</td>
                            </tr>
                        </thead>
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                        <?php  $_smarty_tpl->tpl_vars['obj'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['obj']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['reason_out']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['obj']->key => $_smarty_tpl->tpl_vars['obj']->value) {
$_smarty_tpl->tpl_vars['obj']->_loop = true;
?>
                        <tr align="center">
                            <td><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->reason_id;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->reason_description;?>
</td>
                            <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['obj']->value->date,"d/m/Y");?>
</td>
                            <td>
                            <a style="color: #17a2b8" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
warehouse/out/<?php echo $_smarty_tpl->tpl_vars['obj']->value->reason_id;?>
">
                                    Xuất hàng
                                </a>
                                 | 
                                <a style="color: #da251d" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
warehouse/reasonout_delete/<?php echo $_smarty_tpl->tpl_vars['obj']->value->reason_id;?>
"
                                    onclick="return confirm('Bạn có chắc chắn xóa không?');">
                                    <i class="fas fa-trash">
                                    </i>
                                </a>
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
        $("#quycach_id").select2();
        $("#product_id").select2();
        $("#size_id").select2();
        $("#dataTable").DataTable({
            stateSave: true
        });
    });
</script><?php }} ?>
