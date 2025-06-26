<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quẹt thẻ để xem thông tin</h3>
                <input type="password" id="card_id" name="card_id" class="form-control" maxlength="10">
            </div>
            
        </div>
        <!--card-info-->
    </div>
</div>
<div class="row" id="card_info" style="font-size: 0.9em;">
   
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#card_id").focus();
        $("#card_id").keyup(function(event) {
            if (event.keyCode == 13) {
                $.post("{$base_url}suaca/dataworkerforview", {
                    card_id: $("#card_id").val(),
                }, function(data, status) {
                    $("#card_info").html(data);
                    $("#card_id").val("");
                });
            }
        });
    });
    $(document).click(function(){
        $("#card_id").focus();
    });
</script>