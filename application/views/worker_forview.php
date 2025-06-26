<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="../dist/img/ment.ico" type="image/x-icon" rel="shortcut icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MenT Automation</title>
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/v4-shims.min.css">
    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
    <link href="../dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../dist/css/scroller.dataTables.min.css">
    <style>
        ::-ms-reveal {
        display: none;
    }
    </style>
</head>
<body>
    <input type="password" id="card_id" name="card_id" class="form-control" maxlength="10">
    <div class="row" id="card_info" style="font-size: 0.9em;"></div>
    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="../plugins/select2/js/select2.full.min.js"></script>
    <script src="../dist/js/jquery.dataTables.js"></script>
    <script src="../dist/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <script src="../dist/js/adminlte.js"></script>
    <script src="../dist/js/dataTables.scroller.min.js"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
<script type="text/javascript">
$(document).ready(function() {
    $("#card_id").focus();
    $("#card_id").keyup(function(event) {
        if (event.keyCode == 13) {
            $.post("../worker/dataworkerforview", {
                card_id: $("#card_id").val(),
            }, function(data, status) {
                $("#card_info").html(data);
                $("#card_id").val("");
                setTimeout(function() {
                    $("#card_info").empty();
                }, 10000);
            });
        }
    });
});
$(document).click(function(){
    $("#card_id").focus();
});
</script>
</body>
</html>