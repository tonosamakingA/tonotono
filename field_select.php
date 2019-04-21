<?php
header("Content-Type: application/join; charset=UTF-8");
header("X-Content-Type-Options: nosniff");
$query = "SELECT DISTINCT HOME FROM MONSTER";
$param = $_REQUEST;
try {
	$con = new PDO('mysql:host=localhost;dbname=vantan;charset=utf8','root','');
	$con->setAttribute(PDO::ATTR_CASE,PDO::CASE_LOWER);

	if (!isset($param['attribute']) || $param['attribute'] == '')
	{
		$stmt = $con->prepare($query);
	} else {
		//$query .= ' WHERE ATTRIBUTE = '.$param['attribute'];
		//$stmt = $con->prepare($query);

		//新しい　SQLインジェクション対策
		$query .= ' WHERE ATTRIBUTE = :attribute';
		$stmt = $con->prepare($query);
		$stmt->bindParam(':attribute', $param['attribute'], PDO::PARAM_STR);
	}

	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $Exception){
	die('接続エラー'.$Exception->getMessage());
}
$data = json_encode($result);
$data = preg_replace_callback('/\\\\u([0-9a-zA-Z]{4})/',
function($matches){
	return mb_convert_encoding(pack('H*',$matches[1])
	,'UTF-8','UTF-16');
}
, $data);
$data = '{"monsters":'.$data.'}';
echo $data;
?>