<label>Danh sách quyền</label>
<select id="role" multiple="multiple" name="role">
    {foreach $role_list as $rl}
    <option value="{$rl->role_id}" {if $rl->role_id|in_array:$role:$admin}selected{/if}>{$rl->role_name}
    </option>
    {/foreach}
</select>
<script type="text/javascript">
$('#role').bootstrapDualListbox();
</script>