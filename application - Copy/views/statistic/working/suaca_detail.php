<table class="table table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: 1.5em">
    <thead>
        <tr style="font-weight: bold;" align="center">
            <!-- <th>Lô</th> -->
            <th>Mã CN</th>
            <th>Công nhân</th>
            <th>Mã SP</th>
            <!-- <th>Sản phẩm</th> -->
            <th>Vào</th>
            <th>Ra</th>
           
            <th>Đ/M</th>
             <th>TG</th>
        </tr>
    </thead>
    <tbody>
        {foreach $result as $rs}
            <tr align="center">
                <!-- <td>{$rs.lo_id}</td> -->
                <td>{$rs.worker_id}</td>
                <td align="left">{$rs.worker_name}</td>
                <td>{$rs.product_id}</td>
                <!-- <td>{$rs.product_name}</td> -->
                 <td align="right">{$rs.weight_in|number_format:3:",":"."}</td> 
                <td align="right">{$rs.weight_out|number_format:3:",":"."}</td>
                
                <td>{$rs.dinh_muc|number_format:3:",":"."}</td>
                <td>{$rs.time_out|date_format:"%H:%M"}</td>
            </tr>
        {/foreach}
    </tbody>
</table>