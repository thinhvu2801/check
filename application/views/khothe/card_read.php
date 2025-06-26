{if $card_list|count neq 0}
<table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
	<thead>
		<tr class="btn-success">
			<td>TT thẻ</td>
			<td width="35%">Chức năng</td>
		</tr>
	</thead>
	<tbody>
	{$i=1}
	{foreach $card_list as $lst}
	<tr>
	<td>Thẻ {$i++}</td>	
	<td align="center">
		<a class="btn btn-danger btn-sm" href="#" onclick="_delete('{$lst->card_id}');">
            <i class="fas fa-trash"></i>
        </a>
    </td>
	</tr>
	{/foreach}	
	</tbody>
</table>
{else}
Chưa có thẻ nào được liên kết
{/if}