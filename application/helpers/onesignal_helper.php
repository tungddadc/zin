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
    'app_id' => ON_APP_AI,
    'included_segments' => ["All"],
    'contents' => $content,
    'web_buttons' => $hashes_array
  );

  $fields = json_encode($fields);


  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charset=utf-8',
    'Authorization: Basic '.ON_AUTH
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
