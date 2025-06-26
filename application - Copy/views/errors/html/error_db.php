<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  $server = "http://".$_SERVER["SERVER_NAME"]."/";
  $uri = $_SERVER['REQUEST_URI'];
  $elements = explode("/", $uri);
  $object ="";
  $action ="";
  $param = "";
  if (count($elements)>2)
    $object = $elements[2];
  if (count($elements)>3)
    $action = $elements[3];
  if (count($elements)>4)
    $param = $elements[4];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href='<?php echo $server.$elements[1] ?>/plugins/fontawesome-free/css/all.min.css'>
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo $server.$elements[1] ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $server.$elements[1] ?>/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
  <div class="card bg-light">
    <div class="card-header text-muted border-bottom-0">
      <h3>Lỗi cơ sở dữ liệu</h3>
    </div>
    <div class="card-body pt-0">
      <div class="row">
      	<?php
    			 echo "<p>- Đã xảy ra lỗi khi " . $action . " " . $object;
           if ($param != "") echo " với tham số " . $param."</p>";
           echo "<p>- Có thể đối tượng này đã có dữ liệu cân nên không thể thực hiện thao tác " . $action;
           echo " hoặc một lỗi khác như sai hàm/tham số/giá trị/...</p>";
           echo '<p>'.$message."</p>";
      	?>
		
      </div>
    </div>
    <div class="card-footer">
      <div class="text-right">
        <!-- <a href="#" class="btn btn-sm bg-teal">
          <i class="fas fa-comments"></i>
        </a> -->
        <a href="javascript:history.back()" class="btn btn-sm btn-primary">
          <i class="fas fa-user"></i>Quay lại
        </a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
