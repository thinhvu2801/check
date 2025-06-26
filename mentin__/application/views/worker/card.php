<div class="row">
  <div class="col-md-4">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Danh sách công nhân</h3>
      </div><!--card-header-->
      <div class="card-body">
        <input class="form-control" id="btnSearch" type="text" placeholder="Tìm kiếm..." autocomplete="new-password">
        <select size="20" class="form-control" name="worker_id" id="worker_id" style="font-size: 1.3em">
          {foreach $worker as $wk}
            <option value="{$wk->worker_id}" {if $wk->worker_id eq $worker_id} selected {/if}>({$wk->factory_id}) {$wk->worker_name}</option>
          {/foreach}
        </select>
      </div><!--card-body-->
    </div><!--card-info-->
  </div><!--col-md5-->
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Danh sách sản phẩm được liên kết</h3>
      </div><!--card-header-->
      <div class="card-body">

        <select size="20" class="form-control" name="product_id" id="product_id" style="font-size: 1.3em">
          <option value="0" selected>Không liên kết</option>
          {foreach $product as $pr}
            <option value="{$pr->product_id}">({$pr->product_id}) {$pr->product_name}</option>
          {/foreach}
        </select>
      </div><!--card-body-->
    </div><!--card-info-->
  </div>
  <div class="col-md-5" style="border-left: 1px solid #ccc;">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thông tin thẻ từ</h3>
      </div><!--card-header-->
      <div class="card-body">
        <div>
          <input type="password" id="card_id" name="card_id" class="form-control" maxlength="10" required autocomplete="new-password">
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
          $.post("{$base_url}worker/card_delete",{
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
    
    $.post("{$base_url}worker/card_read",
        {
          object_id: $( "#worker_id" ).val()//.replace(/[&\/\\#, +()$~%.'":*?<>{}]/g, '')
        },
        function(data,status){
          $( "#listcard" ).html(data);
        }
    );
  }
 
  $( document ).ready(function() {
    $("#btnSearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
      $("#worker_id option").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
    $( "#card_id" ).focus();
    loadlistcard();
    $( "#card_id" ).keyup(function(event){
      if(event.keyCode == 13){
        var next = true;
        if (($.isNumeric($("#card_id" ).val()))&&($("#card_id" ).val().length==10)){
          $.post("{$base_url}worker/card_create",
          {
            card_id: $( "#card_id" ).val(),
            worker_id: $( "#worker_id" ).val(),
            product_id: $( "#product_id" ).val()
          },
          function(data,status){
            $( "#info" ).html(data);
            if (data =='<p style="color:red">Thẻ đã tồn tại!</p>') next = false;
            loadlistcard();
            $( "#card_id" ).val("");
          }).done(function() {
            if ($( "#autonext" ).is(":checked")&&next){
              var select_obj = $('#worker_id option:selected');
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
        var select_obj = $('#worker_id option:selected');
        if (select_obj.next().val()!=null){
          $( "#mes" ).html("");
          select_obj.prop("selected", false).next().prop("selected", true);
          loadlistcard();
        }
      }
      if (event.keyCode == 38){
        var select_obj = $('#worker_id option:selected');
        if (select_obj.prev().val()!=null){
          $( "#mes" ).html("");
          select_obj.prop("selected", false).prev().prop("selected", true);
          loadlistcard();
        }
      }
    });
    $( "#worker_id option").click(function(){
        $( "#card_id" ).focus();
        $( "#info" ).html("");
        loadlistcard();
    });
    $( "#product_id option" ).click(function(){
        $( "#card_id" ).focus();
    });
    $( "#autonext" ).click(function(){
        $( "#card_id" ).focus();
    });
  });
</script>