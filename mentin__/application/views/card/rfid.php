<div id="status">
	
</div>
<script type="text/javascript">
$( document ).ready(function() {
  	 viewData();
  });
  var myVar = setInterval(viewData, 500);
  function viewData() {

    $.post("{$base_url}card/viewDongbo",
      {
      },
      function(data,status){
      	if (data=="")
      		$( "#status" ).html("Đang chờ đồng bộ...");
      	else
      		$( "#status" ).html(data);
    });
  }
</script>