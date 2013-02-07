<?php
class CBlank {


	public function LogClean($params = '')
	{
		file_put_contents($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/blank/logs/result.log',print_r($params, 1).date('r'),FILE_APPEND);
		return;
	}
}
?>