<div class="col-lg-12 col-12">
    <div class="small-box bg-info">
        <div class="inner">
        <h4>{$card_sl}</h4>
        <h4>Loại thẻ: {$typecard}</h4>
        {if $card neq null}
            <h3>Mã thẻ: {$card_id}</h3>
            <h3>Loại thẻ: {$card->object_type}</h3>
            <h4>Mã: {$card->object_id}</h4>
            <h4>Tên: {$card->object_name}</h4>
        {else}
            <h3>Mã thẻ: {$card_id}</h3>
            <h3>Thẻ trống</h3>
            <h4>Mã: ---</h4>
            <h4>Tên: ---</h4>
        {/if}
        </div>
        <div class="icon">
          <i class="fas fa-credit-card"></i>
        </div>
        {if $delete_card eq 1}
        {if $card neq null}
        <a href="{$base_url}card/delete/{$card_id}" onclick="return confirm('Bạn có chắc chắn hủy thẻ {$card_id} không?');" class="small-box-footer">
            <i class="fas fa-trash"></i>
            Hủy thẻ
        </a>
        {/if}
        {/if}
        
    </div>
</div>