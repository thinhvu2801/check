<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage PluginsModifier
 */

/**
 * Smarty replace modifier plugin
 *
 * Type:     modifier<br>
 * Name:     replace<br>
 * Purpose:  simple search/replace
 *
 * @link http://smarty.php.net/manual/en/language.modifier.replace.php replace (Smarty online manual)
 * @author Monte Ohrt <monte at ohrt dot com>
 * @author Uwe Tews
 * @param string $string  input string
 * @param string $search  text to search for
 * @param string $replace replacement text
 * @return string
 */
function smarty_modifier_getproductname($product_id)
{
	$ci = &get_instance();
	$ci->load->model("MProduct");
	$product = $ci->MProduct->GetByProductId($product_id);
	if(sizeof($product)>0)
	return $product->PRODUCT_NAME;
	else return "";
}
