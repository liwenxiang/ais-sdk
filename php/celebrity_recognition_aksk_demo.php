<?php
/**
 * 名人识别检测服务的ak,sk 方式请求示例
 */
require "./ais_sdk/celebrity_recognition.php";
require "./ais_sdk/utils.php";

$app_key = "*************";
$app_secret = "*************";
initRegion($region = "cn-north-1");

$filepath = "./data/celebrity-recognition.jpg";
$data = fileToBase64($filepath);

// obs链接需要和region区域一致，不同的region的obs资源不共享
$data_url = "https://ais-sample-data.obs.cn-north-1.myhuaweicloud.com/celebrity-recognition.jpg";

// 图片的base64 的方式请求接口
$result = celebrity_recognition_aksk($app_key, $app_secret, $data, "");
echo $result;

// 图片的osb的url 方式请求接口
$result = celebrity_recognition_aksk($app_key, $app_secret, "", $data_url);
echo $result;
