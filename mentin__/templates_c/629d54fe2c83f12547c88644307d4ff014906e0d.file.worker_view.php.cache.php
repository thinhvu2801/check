<?php /* Smarty version Smarty-3.1.16, created on 2023-04-19 13:31:54
         compiled from "C:\xampp\htdocs\mentin\application\views\statistic\suaca\worker_view.php" */ ?>
<?php /*%%SmartyHeaderCode:16775508786424f7158b91b1-61415715%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '629d54fe2c83f12547c88644307d4ff014906e0d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mentin\\application\\views\\statistic\\suaca\\worker_view.php',
      1 => 1681903902,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16775508786424f7158b91b1-61415715',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_6424f7158e8152_87819922',
  'variables' => 
  array (
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6424f7158e8152_87819922')) {function content_6424f7158e8152_87819922($_smarty_tpl) {?><div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quẹt thẻ để xem thông tin</h3>
                <input type="password" id="card_id" name="card_id" class="form-control" maxlength="10">
            </div>
            
        </div>
        <!--card-info-->
    </div>
</div>
<div class="row" id="card_info" style="font-size: 0.9em;">
   
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#card_id").focus();
        $("#card_id").keyup(function(event) {
            if (event.keyCode == 13) {
                $.post("<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
suaca/dataworkerforview", {
                    card_id: $("#card_id").val(),
                }, function(data, status) {
                    $("#card_info").html(data);
                    $("#card_id").val("");
                });
            }
        });
    });
    $(document).click(function(){
        $("#card_id").focus();
    });
</script><?php }} ?>
