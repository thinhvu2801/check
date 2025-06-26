<?php /* Smarty version Smarty-3.1.16, created on 2025-06-23 02:47:07
         compiled from "D:\App\Wampp\www\check\application\views\card\rfid.php" */ ?>
<?php /*%%SmartyHeaderCode:11647557246858c02bd820f1-25700693%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a406e3f5599c6e2006e3dc74bec68875951822fd' => 
    array (
      0 => 'D:\\App\\Wampp\\www\\check\\application\\views\\card\\rfid.php',
      1 => 1589726992,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11647557246858c02bd820f1-25700693',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_6858c02bd87cc2_92512069',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6858c02bd87cc2_92512069')) {function content_6858c02bd87cc2_92512069($_smarty_tpl) {?><div id="status">
	
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
