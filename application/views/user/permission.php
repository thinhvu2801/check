<!-- /.card -->
<div class="row">
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Chọn tài khoản</h3>
      </div>
      <div class="card-body">
        <select size="5" class="form-control" name="users" id="users" style="font-size: 1.3em">
        {$i=1}
        {foreach $users as $us}
          <option value="{$us->username}" {if $i eq 1} selected {/if}>{$us->username} ({$us->hoten})</option>
          {$i=$i+1}
        {/foreach}
        </select>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
          
      </div>
        <!-- /.card-footer -->
    </div><!-- /.card-info -->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm tài khoản</h3>
      </div>
      <form action="{$base_url}user/insert" method="post">
        <div class="card-body">
          {if $mes neq ""}
          <p class="mb-0" style="color: red;">{$mes}</p>
          {/if}
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="username" name="username" 
            required maxlength="20" placeholder="Tài khoản" {literal}pattern="[A-Za-z0-9+-_]{3,}"{/literal}>
          </div>
           <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Họ tên" name="hoten">
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Mật khẩu" name="password" value="" require>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="repassword" value="" require>
          </div>
          <!-- /input-group -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">Thêm</button>
        </div>
        <!-- /.card-footer -->
      </form>
    </div><!-- /.card-info -->
  </div><!-- ./col-md-3-->
  <div class="col-md-9">
    <!-- /.card -->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Phân quyền</h3>
      </div>
      <!-- /.card-header -->
      <form action="#" method="post" id="demoform">
        <div class="card-body">
        <div class="row">
        <div class="col-12">
          <div class="form-group" id="list_role">
            
          </div>
          <div id="mes"></div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="button" name="permission" id="update_role" class="btn btn-info btn-sm">Hoàn tất</button>
          <p>Nếu không có quyền nào, tài khoản sẽ bị xóa!</p>
        </div>
      </form>
    </div>
    <!-- /.card -->
  </div><!-- ./col-md-9-->
</div>
<script type="text/javascript">
  $( document ).ready(function() {
    read_role();
  });
  function read_role(){
    $.post("{$base_url}user/role",{
        username: $("#users").val()
      },
      function(data,status){
          $( "#list_role" ).html(data);
      }
    );
  }
  $('#role').bootstrapDualListbox();
  $("#update_role").click(function() {
    $( "#mes" ).html("");
    $.post("{$base_url}user/update_role",{
        role: $('#role').val(),
        username: $("#users").val()
      },
      function(data,status){
          alert("Đã cập nhật");
          //$( "#mes" ).html("Đã cập nhật");
      }
    );
    if ($('#role').val()=="")
      window.location.href = "{$base_url}user/permission";
  });
  $("#users").click(function(){
    read_role();
  });
</script>