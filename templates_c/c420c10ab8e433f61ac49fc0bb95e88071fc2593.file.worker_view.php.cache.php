<?php /* Smarty version Smarty-3.1.16, created on 2024-04-02 09:41:03
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\statistic\suaca\worker_view.php" */ ?>
<?php /*%%SmartyHeaderCode:532130444660bb68f9a6f68-15606793%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c420c10ab8e433f61ac49fc0bb95e88071fc2593' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\statistic\\suaca\\worker_view.php',
      1 => 1681903904,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '532130444660bb68f9a6f68-15606793',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_660bb68f9e0630_15182795',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_660bb68f9e0630_15182795')) {function content_660bb68f9e0630_15182795($_smarty_tpl) {?><div class="row">
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
