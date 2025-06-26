<table class="table table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: 1.5em">
    <thead>
        <tr style="font-weight: bold;" align="center" class="text-danger">
            <!-- <td width="3%">STT</td> -->
            <!-- <td>Lô</td> -->
            <td >Mã CN</td>
            <td>Công nhân</td>
            <td>Mã SP</td>
            <!-- <td>Sản phẩm</td> -->
            <td>Định mức SP</td>
            <td>KL vào</td>
            <td>KL ra</td>
            <td>Định mức</td>
            <td>Thời gian</td>
        </tr>
    </thead>
    <tbody>
        {$i=1}
        {foreach $result as $rs}
        <tr align="center">
            <!-- <td align="center">{$i++}</td> -->
            <!-- <td align="center">{$rs.lo_id}</td> -->
            <td align="center">{$rs.worker_id}</td>
            <td align="left">{$rs.worker_name}</td>
            <td align="center">{$rs.product_id}</td>
            <!-- <td>{$rs.product_name}</td> -->
            <td align="right">{$rs.dinh_muc_chuan|number_format:3:",":"."}</td>
            <td align="right">{$rs.weight_in|number_format:3:",":"."}</td>
            <td align="right">{$rs.weight_out|number_format:3:",":"."}</td>
            <td>{$rs.dinh_muc|number_format:3:",":"."}</td>
            <td>{$rs.time_out|date_format:"%H:%M"}</td>
        </tr>
        {/foreach}
    </tbody>
</table>