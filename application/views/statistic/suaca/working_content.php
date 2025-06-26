<div class="row" style="overflow: visible;">
    <div class="col-md-5">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr style="font-weight: bold; color:red;" align="center">
                        <th>Lô</th>
                        <th>Rổ</th>
                        <th>CN</th>
                        <th>SP</th>
                        <th>KL Vào</th>
                        <th>Giờ Vào</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $result_in as $rs}
                    <tr align="center">
                        {foreach $rs as $r}
                        <td>{$r}</td>
                        {/foreach}
                    </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-7">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr style="font-weight: bold;color:blue;" align="center">
                        <th>Lô</th>
                        <th>Rổ</th>
                        <th>CN</th>
                        <th>SP</th>
                        <th>KL Vào</th>
                        <th>Giờ Vào</th>
                        <th>KL Ra</th>
                        <th>Giờ Ra</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $result_out as $rs}
                    <tr align="center">
                        {foreach $rs as $r}
                        <td>{$r}</td>
                        {/foreach}
                    </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
</div>