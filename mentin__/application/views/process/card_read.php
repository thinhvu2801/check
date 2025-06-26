{if $card_list|count neq 0}
<table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-weight: 1.3em">
	<thead>
		<tr class="btn-success">
			<td>Mã thẻ</td>
			<td width="35%">Chức năng</td>
		</tr>
	</thead>
	<tbody>
	{foreach $card_list as $lst}
	<tr>
	<td>{$lst->card_id}</td>	
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
