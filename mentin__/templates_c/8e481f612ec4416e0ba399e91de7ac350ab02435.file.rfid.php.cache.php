<?php /* Smarty version Smarty-3.1.16, created on 2023-02-18 08:15:41
         compiled from "C:\xampp\htdocs\demo\application\views\card\rfid.php" */ ?>
<?php /*%%SmartyHeaderCode:518945963f07b1db15365-95056170%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8e481f612ec4416e0ba399e91de7ac350ab02435' => 
    array (
      0 => 'C:\\xampp\\htdocs\\demo\\application\\views\\card\\rfid.php',
      1 => 1589726992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '518945963f07b1db15365-95056170',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_63f07b1db640c8_29431745',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_63f07b1db640c8_29431745')) {function content_63f07b1db640c8_29431745($_smarty_tpl) {?><div id="status">
	
</div>
<script type="text/javascript">
$( document ).ready(function() {
  	 viewData();
  });
  var myVar = setInterval(viewData, 500);
  function viewData() {

    $.post("<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
card/viewDongbo",
      {
      },
      function(data,status){
      	if (data=="")
      		$( "#status" ).html("Đang chờ đồng bộ...");
      	else
      		$( "#status" ).html(data);
    });
  }
</script><?php }} ?>
