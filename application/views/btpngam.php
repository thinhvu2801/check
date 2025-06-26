<div class="table-responsive">
    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr style="font-weight: bold;color:blue;" align="center">
                <th>Rổ</th>
                <th>KL Vào</th>
                <th>KL Ra</th>
                <th>Tăng trọng</th>
            </tr>
        </thead>
        <tbody>
            {foreach $result as $rs}
            <tr align="center">
                {foreach $rs as $r}
                <td>{$r}</td>
                {/foreach}
            </tr>
            {/foreach}
        </tbody>
    </table>
</div>