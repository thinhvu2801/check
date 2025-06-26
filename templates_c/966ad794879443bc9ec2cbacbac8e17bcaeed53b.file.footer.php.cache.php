<?php /* Smarty version Smarty-3.1.16, created on 2025-02-27 01:17:16
         compiled from "C:\xampp\htdocs\check\application\views\footer.php" */ ?>
<?php /*%%SmartyHeaderCode:26046703767bfaf0c5dc482-03725597%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '966ad794879443bc9ec2cbacbac8e17bcaeed53b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\check\\application\\views\\footer.php',
      1 => 1617864600,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26046703767bfaf0c5dc482-03725597',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'current_year' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_67bfaf0c634ba5_86599667',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_67bfaf0c634ba5_86599667')) {function content_67bfaf0c634ba5_86599667($_smarty_tpl) {?><footer class="main-footer text-sm">
    &nbsp;
    <div class="float-right d-none d-sm-inline-block">
        <strong>Copyright &copy; 2014-<?php echo $_smarty_tpl->tpl_vars['current_year']->value;?>
 <a href="http://mentautomation.com">MenT Automation</a>.</strong>
        All rights reserved.
    </div>
</footer>
<script>
var elem = document.documentElement;
$("#exitfullscreen").hide();
function openFullscreen() {
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    } else if (elem.mozRequestFullScreen) {
        /* Firefox */
        elem.mozRequestFullScreen();
    } else if (elem.webkitRequestFullscreen) {
        /* Chrome, Safari & Opera */
        elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) {
        /* IE/Edge */
        elem.msRequestFullscreen();
    }
    $("#exitfullscreen").show();
    $("#fullscreen").hide();
}

function closeFullscreen() {
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
    }
    $("#fullscreen").show();
    $("#exitfullscreen").hide();
}
</script><?php }} ?>
