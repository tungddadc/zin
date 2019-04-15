<?php
//echo '<pre>';
//function sendMessage() {
//  $content      = array(
//    "en" => 'Có bài viết mới'
//  );
//  $hashes_array = array();
//  array_push($hashes_array, array(
//    "id" => "like-button",
//    "text" => "Tin nhắn mới",
//    "icon" => "http://i.imgur.com/N8SN8ZS.png",
//    "url" => "http://112.213.86.209/ten-san-pham"
//  ));
//  $fields = array(
//    'app_id' => "23da72ca-689d-4b93-ba2f-fc4856c58a9f",
//    'included_segments' => ["All"],
//    'contents' => $content,
//    'web_buttons' => $hashes_array,
//    "isChromeWeb" => true,
//  );
//
//  $fields = json_encode($fields);
//
//
//  $ch = curl_init();
//  curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
//  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//    'Content-Type: application/json; charset=utf-8',
//    'Authorization: Basic ZmVhZjliNDQtOTkwOS00MTMyLWFhNTQtYjVhMTQzMDZjNjBh'
//  ));
//  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//  curl_setopt($ch, CURLOPT_HEADER, FALSE);
//  curl_setopt($ch, CURLOPT_POST, TRUE);
//  curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
//  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//
//  $response = curl_exec($ch);
//  curl_close($ch);
//
//  return $response;
//}
//
//$response = sendMessage();
//$return["allresponses"] = $response;
//$return = json_encode($return);
//
//$data = json_decode($response, true);
//print_r($data);
//print($return);
//print("\n");
//?>