<?PHP

$data = array( "device_id" => "18", "day" => array("Sun","Sat"), "start_time" => date('2016-03-01 14:30:00'), "end_time" => date('2016-03-01 14:00:00'), "repetition" => "once" );
$jsonData = urlencode(json_encode($data));
$url = "localhost/api/schedule/set_schedule.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, array("data"=>$jsonData) );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);

echo $result;
?>
