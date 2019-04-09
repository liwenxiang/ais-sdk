<?php
/**
 * 语音识别服务token 方式请求的使用示例
 */
require "./ais_sdk/gettoken.php";
require "./ais_sdk/long_sentence.php";
require "./ais_sdk/utils.php";

// 当前支持北京1：cn-north-1
init_region($region = 'cn-north-1');
$username = "********";      // 配置用户名
$password = "********";      // 密码
$domainName = "*********";   // 配置用户名

$filepath = "./data/asr-sentence.wav";
$data = file_to_base64($filepath);

$data_url = "https://obs-ch-sdk-sample.obs.cn-north-1.myhwclouds.com/lsr-1.mp3";

$token = get_token($username, $password, $domainName);

// obs的url方式请求
$result = long_sentence($token, "", $data_url);
echo $result;
echo "\n";

// base64 方式请求
$result = long_sentence($token, $data, "");
echo $result;

