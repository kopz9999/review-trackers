<?php
/*
Plugin Name: Review Trackers
Plugin URI: https://github.com/kopz9999/review-trackers
Description: Display reviews for a site on Wordpress
Version: 0.0.1
Author: Luis Canales
Author URI: https://github.com/kopz9999
License: GPL2
*/


function pull_reviews() {
  // ini_set('display_errors', '1');

  $curl = curl_init();
  $username = $_ENV["API_USER"];
  $password = $_ENV["API_PASS"];
  $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.reviewtrackers.com/auth",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_USERAGENT => $agent,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "",
    CURLOPT_HTTPHEADER => array(
     "accept: application/vnd.rtx.authorization.v2.hal+json;charset=utf-8",
     "authorization: Basic " . base64_encode($username.":".$password), 
     "content-type: application/vnd.rtx.auth.v2.hal+json;charset=utf-8"
    ),
  ));
  $response = curl_exec($curl);
  $err = curl_error($curl);
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    echo $response;
    $result = json_decode($response);
    $auth_token = $result->token;
    $account_id = $result->account_id;
    echo $result->token;
  }
}


// pull_reviews();
// phpinfo();
?>
