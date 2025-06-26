<?php /* Smarty version Smarty-3.1.16, created on 2025-02-27 08:59:10
         compiled from "C:\xampp\htdocs\check\application\views\size\card.php" */ ?>
<?php /*%%SmartyHeaderCode:142646668767c01b4ef0b664-48407139%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8f518ae944cfde7d0d8fbb188408c8b6d8a42ed6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\check\\application\\views\\size\\card.php',
      1 => 1668593440,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '142646668767c01b4ef0b664-48407139',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'size' => 0,
    'h' => 0,
    'size_id' => 0,
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_67c01b4f085e75_26446726',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_67c01b4f085e75_26446726')) {function content_67c01b4f085e75_26446726($_smarty_tpl) {?><div class="row">
  <div class="col-md-6">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Danh sách size</h3>
      </div><!--card-header-->
      <div class="card-body">
        <input class="form-control" id="btnSearch" type="text" placeholder="Tìm kiếm...">
        <select size="20" class="form-control select2" name="object_id" id="object_id" style="font-size: 1.5em">
        <?php  $_smarty_tpl->tpl_vars['h'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['h']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['size']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['h']->key => $_smarty_tpl->tpl_vars['h']->value) {
$_smarty_tpl->tpl_vars['h']->_loop = true;
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['h']->value->size_id;?>
" <?php if ($_smarty_tpl->tpl_vars['h']->value->size_id==$_smarty_tpl->tpl_vars['size_id']->value) {?> selected <?php }?>>(<?php echo $_smarty_tpl->tpl_vars['h']->value->size_id;?>
) <?php echo $_smarty_tpl->tpl_vars['h']->value->size_name;?>
</option>
        <?php } ?>
        </select>
      </div><!--card-body-->
    </div><!--card-info-->
  </div><!--col-md5-->
  
  <div class="col-md-6" style="border-left: 1px solid #ccc;">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thông tin thẻ từ</h3>
      </div><!--card-header-->
      <div class="card-body">
        <div>
          <input type="password" id="card_id" name="card_id" class="form-control" maxlength="10" required>
          <input type="checkbox" id="autonext" name="autonext"><label for="autonext">&nbsp;Tự động chuyển</label>
        </div>
        <div id="info"></div>
        <div id="listcard">
        </div>
      </div><!--card-body-->
    </div><!--card-info-->
  </div><!--col-md-7-->
</div>
<script>
  function _delete(card_id){
      var x = confirm('Bạn có chắc chắn xóa không?');
      if (x){
          $.post("<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
size/card_delete",{
              card_id: card_id
          },function(data,status){
              loadlistcard();
          });
          $( "#info" ).html("");
      }
      $( "#card_id" ).focus();
  }
  function loadlistcard(){
    $("#listcard").html("Đang tải...");
    var obj_id = $( "#object_id" ).val();
    $.post("<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
size/card_read",
        {
          object_id: obj_id//.replace(/[&\/\\#, +()$~%.'":*?<>{}]/g, '')
        },
        function(data,status){
          $( "#listcard" ).html(data);
        }
    );
  }
  
  $( document ).ready(function() {
    $("#btnSearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
      $("#object_id option").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
    $( "#card_id" ).focus();
    loadlistcard();
    $("#card_id").keyup(function(event){
      if(event.keyCode == 13){
        var next = true;
        if (($.isNumeric($("#card_id" ).val()))&&($("#card_id" ).val().length==10)){
          $.post("<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
size/card_create",
          {
            card_id: $( "#card_id" ).val(),
            object_id: $( "#object_id" ).val()
          },
          function(data,status){
            loadlistcard();
            $("#card_id").val("");
            $("#info").html(data);
            if (data =='<p style="color:red">Thẻ đã tồn tại!</p>') next = false;
          }).done(function() {
            if ($( "#autonext" ).is(":checked")&&next){
              var select_obj = $('#object_id option:selected');
              if (select_obj.next().val()!=null)
                select_obj.prop("selected", false).next().prop("selected", true);
              $( "#card_id" ).focus();
            }
          });
        }else{
          $( "#info" ).html('<p style="color:red">Thẻ không hợp lệ!</p>');
          $( "#card_id" ).val("");
        }
      }
      if (event.keyCode == 40){
        var select_obj = $('#object_id option:selected');
        if (select_obj.next().val()!=null){
          $( "#mes" ).html("");
          select_obj.prop("selected", false).next().prop("selected", true);
          loadlistcard();
        }
      }
      if (event.keyCode == 38){
        var select_obj = $('#object_id option:selected');
        if (select_obj.prev().val()!=null){
          $( "#mes" ).html("");
          select_obj.prop("selected", false).prev().prop("selected", true);
          loadlistcard();
        }
      }
    });
    $( "#object_id option" ).click(function(){
        $( "#card_id" ).focus();
        $( "#info" ).html("");
        loadlistcard();
    });
    
    $( "#autonext" ).click(function(){
        $( "#card_id" ).focus();
    });
  });
</script><?php }} ?>
