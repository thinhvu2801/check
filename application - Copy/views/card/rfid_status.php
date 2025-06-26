<div class="table-responsive">
    <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr style="font-weight: bold;" align="center">
                <td width="3%">STT</td>
                <td>Client name</td>
                <td>Ngày</td>
                <td>Giờ cập nhật</td>
            </tr>
        </thead>
        <tbody>
            {$i=1}
            {foreach $status as $rs}
            <tr>
                <td align="center">{$i++}</td>
                <td align="center">{$rs->client_name}</td>
                <td align="center">{$rs->date|date_format:"d/m/Y"}</td>
                <td align="center">{$rs->time}</td>
            </tr>
            {/foreach}
        </tbody>
    </table>
</div>