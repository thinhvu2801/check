<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Sao lưu dữ liệu</h3>
            </div>
            <div class="card-body">
                {if $success eq "1"}
                <a href="{$base_url}MenTPS.bak">Tải về</a>
                {else}
                Có lỗi trong quá trình backup! Thử lại lần nữa!
                {/if}
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>