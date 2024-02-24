<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
header('Content-Type: application/json; charset=UTF-8');

include "db_config.php";
$postjson = json_decode(file_get_contents('php://input'), true);
$aksi=strip_tags($postjson['aksi']);
$data    = array();
switch($aksi)

   {
   
case "add_register":
 $nama = filter_var($postjson['nama'], FILTER_SANITIZE_STRING,
FILTER_FLAG_ENCODE_LOW);
 $nohp = filter_var($postjson['nohp'], FILTER_SANITIZE_STRING,
FILTER_FLAG_ENCODE_LOW);
 $askot = filter_var($postjson['askot'], FILTER_SANITIZE_STRING,
FILTER_FLAG_ENCODE_LOW);
 $bias = filter_var($postjson['bias'], FILTER_SANITIZE_STRING,
FILTER_FLAG_ENCODE_LOW);
 $tahungabung = filter_var($postjson['tahungabung'], FILTER_SANITIZE_STRING,
FILTER_FLAG_ENCODE_LOW);
$tanggal_lahir = filter_var($postjson['tanggal_lahir'], FILTER_SANITIZE_STRING,
FILTER_FLAG_ENCODE_LOW);
 $zodiak = filter_var($postjson['zodiak'], FILTER_SANITIZE_STRING,
FILTER_FLAG_ENCODE_LOW);
 $fandom = filter_var($postjson['fandom'], FILTER_SANITIZE_STRING,
FILTER_FLAG_ENCODE_LOW);
 try {
 $sql = "INSERT INTO anggota
 (nama, nohp, askot, bias, tahungabung, tanggal_lahir, zodiak, fandom) VALUES
 (:nama, :nohp, :askot, :bias, :tahungabung, :tanggal_lahir, :zodiak, :fandom)";
 $stmt = $pdo->prepare($sql);
 $stmt->bindParam(':nama', $nama, PDO::PARAM_STR);
 $stmt->bindParam(':nohp', $nohp, PDO::PARAM_STR);
 $stmt->bindParam(':askot', $askot, PDO::PARAM_STR);
 $stmt->bindParam(':bias', $bias, PDO::PARAM_STR);
 $stmt->bindParam(':tahungabung', $tahungabung, PDO::PARAM_STR);
 $stmt->bindParam(':tanggal_lahir', $tanggal_lahir, PDO::PARAM_STR);
 $stmt->bindParam(':zodiak', $zodiak, PDO::PARAM_STR);
 $stmt->bindParam(':fandom', $fandom, PDO::PARAM_STR);
 $stmt->execute();
 if($sql) $result = json_encode(array('success' =>true));

 else $result = json_encode(array('success' => false, 'msg'=>'error ,
please try again'));

 echo $result;
 }
 catch(PDOException $e)
 {
 echo $e->getMessage();
 }
 break;
 case "getdata":
 $limit = filter_var($postjson['limit'], FILTER_SANITIZE_STRING,
FILTER_FLAG_ENCODE_LOW);
 $start = filter_var($postjson['start'], FILTER_SANITIZE_STRING,
FILTER_FLAG_ENCODE_LOW);
 try {
 $sql = "SELECT * FROM anggota ORDER BY id DESC LIMIT :start,:limit";
 $stmt = $pdo->prepare($sql);
 $stmt->bindParam(':start', $start, PDO::PARAM_STR);
 $stmt->bindParam(':limit', $limit, PDO::PARAM_STR);
 $stmt->execute();
 $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
 foreach($rows as $row){
 $data[] = array(
 'id' => $row['id'],
 'nama' => $row['nama'],
 'nohp' => $row['nohp'],
 'askot' => $row['askot'],
 'bias' => $row['bias'],
 'tahungabung' => $row['tahungabung'],
 'tanggal_lahir' => $row['tanggal_lahir'],
 'zodiak' => $row['zodiak'],
 'fandom' => $row['fandom']
 );
 }
 if($stmt) $result = json_encode(array('success'=>true,
'result'=>$data));
 else $result = json_encode(array('success'=>false));

 echo $result;
 }
 catch(PDOException $e)
 {
 echo $e->getMessage();
}

break;
}