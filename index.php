<?

$client = new SoapClient('http://ws.intime.ua/API/ws/API20/?wsdl');
	$res=$client->CatalogList(array('CatalogListRequest'=>array('AuthData'=>array('ID'=>'5258189','KEY'=>'2222222222'),'CatalogNameEng'=>'Departments')));
	$homes=array();
	$cities=(array)$res->return->ListCatalog->Catalog;
	//print_r($cities);
	foreach($cities as $city)
	{
		foreach($city->AppendField as $f)
		{
			if(trim($f->AppendFieldName)=='Adress')
			{
				$home['ADRESS']=trim($f->AppendFieldValue);
			}
			if(trim($f->AppendFieldName)=='City')
			{
				$home['CITY']=trim($f->AppendFieldValue);
			}
		}
		$homes[$home['CITY']][]=$home['ADRESS'];
	}

	echo json_encode($homes[$_REQUEST['city']]);
}
?>
