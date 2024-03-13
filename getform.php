<?php
//Данные для передачи
// KMA !!!

$channel = 'rc6iDF'; // Хеш ПОТОКА
const API_TOKEN = 'nsJV9oTkMf4ucWs6g7L56zLxEBdVL91B'; // АПИ КЛЮЧ
$ip = (isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:$_SERVER['REMOTE_ADDR']);
$referer = $_SERVER ['HTTP_REFERER'];

if (isset($_POST['name']) && $_POST['phone'] != '' ) {
$post = [
'name' => $_POST['name'],
'phone' => $_POST['phone'],
'channel' => $channel,
'ip' => $ip,
'referer' => $referer,
'country' => 'DZ',
'data1' => $_POST['subid'],
'data2' => $_POST['sub1'],
'data3' => $_POST['sub2'],
'data4' => $_POST['sub3'],
'data5' => $_POST['sub4']
];
// отправляем заявку
$ch = curl_init('https://api.kma.biz/lead/add');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
curl_setopt( $ch, CURLOPT_HTTPHEADER,
array(
'Content-Type: application/x-www-form-urlencoded',
'Authorization: Bearer '.API_TOKEN
)
);
$response = json_decode(curl_exec($ch));
//print_r($response);
curl_close($ch);
if($response->message == 'OK'){
	header('Location: ok.php?pixel='.$_POST['pixel']);
}else{
	echo 'lead is not accept';
}
}else{
	echo 'not found name or phone';
}
?>