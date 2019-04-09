<?php
/**
 * Created by PhpStorm.
 * User: askeyh3t
 * Date: 4/9/2019
 * Time: 1:15 AM
 */

if (!function_exists('sendMessage')) {
  function sendMessage($id)
  {
    $_this =& get_instance();
    $_this->load->model('post_model');
    $postModel = new Post_model();
    $data = $postModel->getById($id,'*','vi');
if(!empty($data)){
  $content      = array(
    "en" => $data->title
  );

  $hashes_array = array();
  array_push($hashes_array, array(
    "id" => $data->id,
    "text" => $data->title,
    "icon" => getImageThumb($data->thumbnail,100,100,true),
    "url" => getUrlNews($data)
  ));
  $fields = array(
    'app_id' => "23da72ca-689d-4b93-ba2f-fc4856c58a9f",
    'included_segments' => ["All"],
    'contents' => $content,
    'web_buttons' => $hashes_array
  );

  $fields = json_encode($fields);


  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charset=utf-8',
    'Authorization: Basic ZmVhZjliNDQtOTkwOS00MTMyLWFhNTQtYjVhMTQzMDZjNjBh'
  ));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, FALSE);
  curl_setopt($ch, CURLOPT_POST, TRUE);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

  $response = curl_exec($ch);
  curl_close($ch);
}

  }
}
