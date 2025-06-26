<?php /* Smarty version Smarty-3.1.16, created on 2024-02-27 10:00:40
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\khothe\card.php" */ ?>
<?php /*%%SmartyHeaderCode:204690268165dda4b821e992-66503467%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15dc38a855de63a1150c3b608998433efb7675f0' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\khothe\\card.php',
      1 => 1706175096,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204690268165dda4b821e992-66503467',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'khothe' => 0,
    'bk' => 0,
    'id' => 0,
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65dda4b8256b32_35272332',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65dda4b8256b32_35272332')) {function content_65dda4b8256b32_35272332($_smarty_tpl) {?><div class="row">
  <div class="col-md-7">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Danh sách mã cân</h3>
      </div><!--card-header-->
      <div class="card-body">
         <input class="form-control" id="btnSearch" type="text" placeholder="Tìm kiếm...">
        <select size="20" class="form-control" name="object_id" id="object_id" style="font-size: 1.5em">
        <?php  $_smarty_tpl->tpl_vars['bk'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['bk']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['khothe']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['bk']->key => $_smarty_tpl->tpl_vars['bk']->value) {
$_smarty_tpl->tpl_vars['bk']->_loop = true;
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['bk']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['bk']->value->id==$_smarty_tpl->tpl_vars['id']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['bk']->value->id;?>
</option>
        <?php } ?>
      </select>
      </div><!--card-body-->
    </div><!--card-info-->
  </div><!--col-md5-->
  <div class="col-md-5" style="border-left: 1px solid #ccc;">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thông tin thẻ từ</h3>
      </div><!--card-header-->
      <div class="card-body">
        <div>
          <input type="password" id="card_id" name="card_id" class="form-control" maxlength="10" required>
          <input type="checkbox" id="autonext" name="autonext"><label for="autonext">&nbsp;Tự động chuyển</label>
        </div>
        <div id ="info">
        </div>
        <div id ="listcard">
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
khothe/card_delete",{
              card_id: card_id
          },function(data,status){
              loadlistcard();
          });
          $( "#info" ).html("");
      }
      $( "#card_id" ).focus();
  }
  function loadlistcard(){
    $( "#listcard" ).html("Đang tải...");
    
    $.post("<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
khothe/card_read",
        {
          object_id: $( "#object_id" ).val()//.replace(/[&\/\\#, +()$~%.'":*?<>{}]/g, '')
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
    $( "#card_id" ).keyup(function(event){
      if(event.keyCode == 13){
        var next = true;
        if (($.isNumeric($("#card_id" ).val()))&&($("#card_id" ).val().length==10)){
          $.post("<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
khothe/card_create",
          {
            card_id: $( "#card_id" ).val(),
            object_id: $( "#object_id" ).val()
          },
          function(data,status){
            $( "#info" ).html(data);
            if (data =='<p style="color:red">Thẻ đã tồn tại!</p>') next = false;
            loadlistcard();
            $( "#card_id" ).val("");
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
