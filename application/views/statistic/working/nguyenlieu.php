<table class="table table-default table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: 1.5em">
    <thead>
        <tr style="font-weight: bold;" align="center">
            <!-- <th>Lô</th> -->
            <th width="10%">Mã SP</th>
            <th>Sản phẩm</th>
            <th width="20%">Khối lượng</th>
            <th width="10%">Thời gian</th>
        </tr>
    </thead>
    <tbody>
        {foreach $result as $rs}
            <tr align="center">
                <!-- <td>{$rs.lo_id}</td> -->
                <td>{$rs.product_id}</td>
                <td>{$rs.product_name}</td>
                <td>{$rs.weight|number_format:3:",":"."}</td>
                <td>{$rs.time}</td>
            </tr>
        {/foreach}
    </tbody>
</table>