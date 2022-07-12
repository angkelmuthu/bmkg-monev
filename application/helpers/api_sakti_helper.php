<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function create_token() {

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://monsakti.kemenkeu.go.id/sitp-monsakti-omspan/webservice/resetToken/ADM/tipedata/KL075");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c3IiOiJCQURBTiBNRVRFT1JPTE9HSSwgS0xJTUFUT0xPR0kgREFOIEdFT0ZJU0lLQSIsInVpZCI6Ik1LRyIsInJvbCI6IndlYnNlcnZpY2UiLCJrZHMiOiJLTDA3NSIsImtkYiI6IkFETSIsImtkdCI6IjIwMjIiLCJjcmUiOjE2NTU3MDM5NzEsImtpZCI6Ik1LRyIsImNvdSI6IjAiLCJhcGkiOiI5MDMwIn0.rSm7ecJrCObhqbv1zsbDdkA6M3VcfzsAVsbpWkIFw5A'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

			$response = curl_exec($ch);
			//var_dump($response);
			$response=json_decode($response);
			curl_close($ch);
			return $response[0]->TOKEN;

}
function create_token_realisasi() {

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://monsakti.kemenkeu.go.id/sitp-monsakti-omspan/webservice/resetToken/PEM/tipedata/KL075");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c3IiOiJCQURBTiBNRVRFT1JPTE9HSSwgS0xJTUFUT0xPR0kgREFOIEdFT0ZJU0lLQSIsInVpZCI6Ik1LRyIsInJvbCI6IndlYnNlcnZpY2UiLCJrZHMiOiJLTDA3NSIsImtkYiI6IlBFTSIsImtkdCI6IjIwMjIiLCJjcmUiOjE2NTU3MDM5NzEsImtpZCI6Ik1LRyIsImNvdSI6IjAiLCJhcGkiOiI5MDMwIn0._9kYlX4MEkkvBerJr6D-A0Zhb-MWhwcPzRJb5kAFOqE'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

			$response = curl_exec($ch);
			//var_dump($response);
			$response=json_decode($response);
			curl_close($ch);
			return $response[0]->TOKEN;

}
function create_token_anggaran() {

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://monsakti.kemenkeu.go.id/sitp-monsakti-omspan/webservice/resetToken/ANG/tipedata/KL075");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c3IiOiJCQURBTiBNRVRFT1JPTE9HSSwgS0xJTUFUT0xPR0kgREFOIEdFT0ZJU0lLQSIsInVpZCI6Ik1LRyIsInJvbCI6IndlYnNlcnZpY2UiLCJrZHMiOiJLTDA3NSIsImtkYiI6IkFORyIsImtkdCI6IjIwMjIiLCJjcmUiOjE2NTU3MDM5NzEsImtpZCI6Ik1LRyIsImNvdSI6IjAiLCJhcGkiOiI5MDMwIn0.P1RsaOBvX0M4HaODG_9sWAdITD6ixoBXkkaHfcjEaYg'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

			$response = curl_exec($ch);
			//var_dump($response);
			$response=json_decode($response);
			curl_close($ch);
			return $response[0]->TOKEN;

}
if ( !function_exists('refAdmin')) {
	   function refAdmin() {
		   $get=create_token();
		   $ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://monsakti.kemenkeu.go.id/sitp-monsakti-omspan/webservice/API/ADM/refAdmin/KL075/");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '.$get));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

			$response = curl_exec($ch);
			//var_dump($response);
			$response=json_decode($response);
			curl_close($ch);
			return $response[1];
		   
	   }
}
if ( !function_exists('refuraian')) {
	   function refuraian($jenis) {
		   $get=create_token();
		   $ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://monsakti.kemenkeu.go.id/sitp-monsakti-omspan/webservice/API/ADM/refUraian/KL075/".$jenis);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '.$get));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

			$response = curl_exec($ch);
			//var_dump($response);
			$response=json_decode($response);
			curl_close($ch);
			return $response[1];
		   
	   }
}
if ( !function_exists('refjenispp')) {
	   function refjenispp() {
		   $get=create_token();
		   $ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://monsakti.kemenkeu.go.id/sitp-monsakti-omspan/webservice/API/ADM/refJnsSPP/KL075/");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '.$get));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

			$response = curl_exec($ch);
			//var_dump($response);
			$response=json_decode($response);
			curl_close($ch);
			return $response[1];
		   
	   }
}
if ( !function_exists('pejabat')) {
	   function pejabat($satker) {
		   $get=create_token();
		   $ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://monsakti.kemenkeu.go.id/sitp-monsakti-omspan/webservice/API/ADM/pejabat/KL075/".$satker);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '.$get));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

			$response = curl_exec($ch);
			//var_dump($response);
			$response=json_decode($response);
			curl_close($ch);
			return $response[1];
		   
	   }
}
if ( !function_exists('realisasi')) {
	   function realisasi($kdsatker) {
		   $get=create_token_realisasi();
		   $ch = curl_init();
		   
			curl_setopt($ch, CURLOPT_URL, "https://monsakti.kemenkeu.go.id/sitp-monsakti-omspan/webservice/API/PEM/realisasi/KL075/".$kdsatker."/");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '.$get));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

			$response = curl_exec($ch);
			//var_dump($response);
			$response=json_decode($response);
			curl_close($ch);
			return $response[1];
		   
	   }
}
if ( !function_exists('capaian_ro')) {
	   function capaian_ro($kdsatker,$tahun,$bulan) {
		   $get=create_token_realisasi();
		   $ch = curl_init();
		   
			curl_setopt($ch, CURLOPT_URL, "https://monsakti.kemenkeu.go.id/sitp-monsakti-omspan/webservice/API/PEM/capaianRO/KL075/".$kdsatker."/".$tahun."-".$bulan);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '.$get));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

			$response = curl_exec($ch);
			//var_dump("https://monsakti.kemenkeu.go.id/sitp-monsakti-omspan/webservice/API/PEM/capaianRO/KL075/".$kdsatker."/".$tahun."-".$bulan);
			//var_dump($response);
			$response=json_decode($response);
			curl_close($ch);
			return $response[1];
		   
	   }
}
if ( !function_exists('refstatus')) {
	   function refstatus($kdsatker) {
		   $get=create_token_anggaran();
		   $ch = curl_init();
		   
			curl_setopt($ch, CURLOPT_URL, "https://monsakti.kemenkeu.go.id/sitp-monsakti-omspan/webservice/API/ANG/refSts/KL075/".$kdsatker."/");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '.$get));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

			$response = curl_exec($ch);
			//var_dump($response);
			$response=json_decode($response);
			curl_close($ch);
			return $response[1];
		   
	   }
}
if ( !function_exists('anggaran')) {
	   function anggaran($kdsatker) {
		   $get=create_token_anggaran();
		   $ch = curl_init();
		   
			curl_setopt($ch, CURLOPT_URL, "https://monsakti.kemenkeu.go.id/sitp-monsakti-omspan/webservice/API/ANG/dataAng/KL075/".$kdsatker."/");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '.$get));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

			$response = curl_exec($ch);
			//var_dump($response);
			$response=json_decode($response);
			curl_close($ch);
			return $response[1];
		   
	   }
}
