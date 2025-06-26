<?php /* Smarty version Smarty-3.1.16, created on 2025-02-27 01:40:52
         compiled from "C:\xampp\htdocs\check\application\views\card\index.php" */ ?>
<?php /*%%SmartyHeaderCode:98284154367bfb49444d671-95491386%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2d91f8d0202a1bb144f38b4e25fe79aaca813dbd' => 
    array (
      0 => 'C:\\xampp\\htdocs\\check\\application\\views\\card\\index.php',
      1 => 1734588060,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '98284154367bfb49444d671-95491386',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'role' => 0,
    'admin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_67bfb4944b5df2_90875890',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_67bfb4944b5df2_90875890')) {function content_67bfb4944b5df2_90875890($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_in_array')) include 'C:\\xampp\\htdocs\\check\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.in_array.php';
?><div class="row">
  <div class="col-md-4">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thẻ từ</h3>
      </div>
      <!--card-header-->
      <div class="card-body">
        <div class="form-group row">
          <div class="col-sm-12">
          <input type="text" id="card_id" name="card_id" class="form-control" maxlength="10">
          </div>
        </div>
        <!-- <div class="form-group row">
          <div class="col-sm-12">
          <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
card/dongbo" class="btn btn-primary">Đồng bộ thẻ</a>
          </div>
        </div> -->
        
      </div>
      <!--card-body-->
    </div>
    <!--card-info-->
  </div>
  <!--col-md5-->
  <div class="col-md-8">
    <div id="card_info">
      <div class="col-lg-12 col-12">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>Thẻ ---</h3>
            <h4>Mã: ---</h4>
            <h4>Tên: ---</h4>
          </div>
          <div class="icon">
            <i class="fas fa-credit-card"></i>
          </div> 
          <?php if (smarty_modifier_in_array('delete_card',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
          <a href="#" class="small-box-footer">
            <i class="fas fa-trash"></i>
            Hủy thẻ
          </a>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $("#card_id").focus();
    $("#card_id").keyup(function(event) {
      if (event.keyCode == 13) {
        $.post("<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
card/viewinfo", {
          card_id: $("#card_id").val(),
          delete_card:<?php if (smarty_modifier_in_array('delete_card',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>1<?php } else { ?>0<?php }?>
        }, function(data, status) {
          $("#card_info").html(data);
          $("#card_id").val("");
        });
      }
    });
  });
</script><?php }} ?>
