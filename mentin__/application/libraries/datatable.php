<?php
class DataTable {
	static function data_output ($data )
	{
		$out = array();
		foreach ($data as $dt) {
			$out[] = array_values($dt);
		}
		return $out;
	}
	
	static function load ($request, $data, $recordsTotal)
	{
        return json_encode(array(
			"draw"            => isset ($request['draw']) ? intval($request['draw']):0,
			"recordsTotal"    => intval($recordsTotal),
			"recordsFiltered" => intval($recordsTotal),
			"data"            => self::data_output($data)
		));
	}
}
?>