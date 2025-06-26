<?php /* Smarty version Smarty-3.1.16, created on 2025-06-23 02:44:37
         compiled from "D:\App\Wampp\www\check\application\views\footer.php" */ ?>
<?php /*%%SmartyHeaderCode:15530316096858bf95854022-24279883%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e94f5928b3fcb66426774e268ee739a80b206b85' => 
    array (
      0 => 'D:\\App\\Wampp\\www\\check\\application\\views\\footer.php',
      1 => 1617864600,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15530316096858bf95854022-24279883',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'current_year' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_6858bf95869f49_82952982',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6858bf95869f49_82952982')) {function content_6858bf95869f49_82952982($_smarty_tpl) {?><footer class="main-footer text-sm">
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
