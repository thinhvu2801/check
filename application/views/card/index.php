<div class="row">
  <div class="col-md-4">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thẻ từ</h3>
      </div>
      <!--card-header-->
      <div class="card-body">
        <div class="form-group row justify-content-end ">
          <div class="col-sm-12">
          <input type="text" id="card_id" name="card_id" class="form-control" maxlength="10">
          <div id="reset-message" class="mt-2"></div>
          </div>
          <div class="pr-2 pt-2 text-right">
            <button type="button" class="btn btn-danger btn-sm" id="reset-btn">
              Reset dữ liệu
            </button>
          </div>
        </div>
        <!-- <div class="form-group row">
          <div class="col-sm-12">
          <a href="{$base_url}card/dongbo" class="btn btn-primary">Đồng bộ thẻ</a>
          </div>
        </div> -->
        
      </div>
      <!--card-body-->
    </div>
    <!--card-info-->
  </div>
  <!--col-md5-->
  <div class="col-md-8">
    <div id="card_info">
      <div class="col-lg-12 col-12">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>Thẻ ---</h3>
            <h4>Mã: ---</h4>
            <h4>Tên: ---</h4>
          </div>
          <div class="icon">
            <i class="fas fa-credit-card"></i>
          </div> 
          {if 'delete_card'|in_array:$role:$admin}
          <a href="#" class="small-box-footer">
            <i class="fas fa-trash"></i>
            Hủy thẻ
          </a>
          {/if}
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $("#card_id").focus();
    $("#card_id").keyup(function(event) {
      if (event.keyCode == 13) {
        $.post("{$base_url}card/viewinfo", {
          card_id: $("#card_id").val(),
          delete_card:{if 'delete_card'|in_array:$role:$admin}1{else}0{/if}
        }, function(data, status) {
          $("#card_info").html(data);
          $("#card_id").val("");
        });
      }
    $('#reset-btn').click(function () {
        if (!confirm('Bạn có chắc chắn muốn reset dữ liệu?')) return;
        $.post("{$base_url}card/reset_data", function (response) {
          $('#reset-message').html(`
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              Reset dữ liệu thành công!
              <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
          `);
        }).fail(function (xhr) {
          console.error("Reset failed:", xhr.responseText);
          $('#reset-message').html(`
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              Reset thất bại. Vui lòng thử lại!
              <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
          `);
        });
      });
    });
});
</script>