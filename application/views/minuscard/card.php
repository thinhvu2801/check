<div class="row">
  <div class="col-md-5">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thẻ</h3>
      </div><!--card-header-->
      <div class="card-body">
        <select size="20" class="form-control" name="object_id" id="object_id" style="font-size: 1.5em">
        <option value="MINUS" selected>Thẻ trả về</option>
      </select>
      </div><!--card-body-->
    </div><!--card-info-->
  </div><!--col-md5-->
  <div class="col-md-7" style="border-left: 1px solid #ccc;">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thông tin thẻ từ</h3>
      </div><!--card-header-->
      <div class="card-body">
        <div>
          <input type="text" id="card_id" name="card_id" class="form-control" maxlength="10" required>
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
          $.post("{$base_url}minuscard/card_delete",{
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
    
    $.post("{$base_url}minuscard/card_read",
        {
          object_id: $( "#object_id" ).val()//.replace(/[&\/\\#, +()$~%.'":*?<>{}]/g, '')
        },
        function(data,status){
          $( "#listcard" ).html(data);
        }
    );
  }
  $( document ).click(function(){
      $( "#card_id" ).focus();
  });
  $( document ).ready(function() {
    $( "#card_id" ).focus();
    loadlistcard();
    $( "#card_id" ).keyup(function(event){
      if(event.keyCode == 13){
        var next = true;
        if (($.isNumeric($("#card_id" ).val()))&&($("#card_id" ).val().length==10)){
          $.post("{$base_url}minuscard/card_create",
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
</script>