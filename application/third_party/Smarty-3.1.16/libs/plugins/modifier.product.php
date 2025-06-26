<?php

function smarty_modifier_product($parent_id)
{
    $ci = &get_instance();
    $ci->load->model("MProduct");
    $result = $ci->MProduct->Read($parent_id);
	return $result;
}
