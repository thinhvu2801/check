<?php

function smarty_modifier_barcode($str)
{
	set_include_path(get_include_path() . PATH_SEPARATOR . 'Barcode/');
	require_once('BarcodeGenerator.php');
	require_once('BarcodeGeneratorPNG.php');
	require_once('BarcodeGeneratorSVG.php');
	require_once('BarcodeGeneratorJPG.php');
	require_once('BarcodeGeneratorHTML.php');
	$generator = new \Barcode\BarcodeGeneratorPNG();
	return base64_encode($generator->getBarcode($str, $generator::TYPE_CODE_128));
}
