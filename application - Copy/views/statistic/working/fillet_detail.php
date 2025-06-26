<table class="table table-default table-striped" id="dataTable" 
width="100%" cellspacing="0" style="font-size: 2em">
    <thead>
        <tr style="font-weight: bold;" align="center">
            <!-- <th>Lô</th> -->
            <th>Mã CN</th>
            <th>Công nhân</th>
            <th>Mã SP</th>
            <!-- <th>Sản phẩm</th> -->
            <th>KL vào</th>
            <th>KL ra</th>
           
            <!-- <th>TG ra</th> -->
            <th>Định mức</th>
             <th>TG vào</th>
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
                <td>{$rs.weight_in|number_format:3:",":"."}</td>
                <td>{$rs.weight_out|number_format:3:",":"."}</td>
               
                <!-- <td>{$rs.time_out}</td> -->
                <td align="right">{$rs.dinh_muc|number_format:3:",":"."}</td>
                 <td>{$rs.time_in|date_format:"%H:%M"}</td>
            </tr>
        {/foreach}
    </tbody>
</table>