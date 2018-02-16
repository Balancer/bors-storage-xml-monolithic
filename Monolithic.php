<?php

namespace B2\Storage\Xml;

class Monolithic extends \B2\Storage
{
	var $objects = NULL;

	function load_array($class_name, $where)
	{
		if(is_null($this->objects))
		{
			$xml = simplexml_load_string($this->xml_content());
			$json = json_encode($xml);
			$data = json_decode($json, true);
			$rows = $this->items_list($data);

			$this->objects = [];
			foreach($rows as $row)
				$this->objects[] = $this->row_to_object($class_name, $row);
		}

		return $this->objects;
	}
}
