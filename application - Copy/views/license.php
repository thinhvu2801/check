<!DOCTYPE html>
<html lang="vi">
<head>
  <link rel="stylesheet" href="<?php echo $base_url?>dist/css/adminlte.min.css">
</head>
<body>
  <div class="row">
  <div class="col-md-2">
  </div>
  <div class="col-md-8">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Nhập key bản quyền</h3>
      </div><!--card-header-->
      <form class="form-horizontal" method="post" action="<?php echo $base_url?>user/license">
        <div class="card-body">
          <textarea id="key" name="key" class="form-control"></textarea>
          <div id="mes" class="text-danger"><?php echo $mes?></div>
        </div><!--card-body-->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary" id="updatelicense">Cập nhật</button>
          <a href="<?php echo $base_url?>" class="btn btn-default">Trang chủ</a>
        </div>
      </form>
    </div><!--card-info-->
  </div><!--col-md8-->
  <div class="col-md-2">
  </div>
</div>
</body>
</html>