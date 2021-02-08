<?php

$new=gettcurl("https://api.bilibili.com/x/web-interface/newlist");

$json=json_decode($new,true);

$av=$json["data"]["archives"][0]["aid"];

$ti=gettcurl("你的域名/bili.php?id=av$av");

$urlti=urlencode($ti);

$add=postcurl("https://api.bilibili.com/x/v2/reply/add","oid=$av&type=1&message=%E7%89%A9%E7%90%86%E8%AF%BE%E4%BB%A3%E8%A1%A8%E6%9D%A5%E4%BA%86---".$urlti."&plat=1&ordering=heat&jsonp=jsonp");

if(strstr($add,"发送成功")){

sleep(2);

$addjson=json_decode($add,true);

$rid=$addjson["data"]["reply"]["rpid"];

$cc=postcurl("https://api.bilibili.com/x/v2/reply/action","oid=$av&type=1&rpid=$rid&action=1&ordering=heat&jsonp=jsonp");

echo "发送成功，视频av号",$av,$cc,$rid;

}else{echo $add;}

function gettcurl($url){

$curl = curl_init();//初始化curl

curl_setopt($curl, CURLOPT_URL,$url);//访问的url

curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);

$re=curl_exec($curl);//执行curl;

curl_close($curl); // 关闭CURL会话

return $re;

}

function postcurl($u,$code){

$url=$u;

$ua='Mozilla/5.0 (Linux; Android 20; MI 11 Build/PKQ1.181121.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/74.0.3729.136 Mobile Safari/537.36';

$curl = curl_init();//初始化curl

curl_setopt($curl, CURLOPT_URL,$url);//访问的url

$httpheader[] = "Accept-Language:zh-CN,zh;q=0.8";

$httpheader[] = "origin:https://member.bilibili.com";

curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);

$file=file_get_contents("你的cookie文件位置");

preg_match('/bili_jct=(.*?);/',$file,$csrf);

curl_setopt($curl, CURLOPT_COOKIE,$file);//发送cookie

curl_setopt($curl, CURLOPT_POST, 1);//开启post

curl_setopt($curl, CURLOPT_POSTFIELDS,$code."&csrf=".$csrf[1]);//post参数

curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);//获取的信息以文件流的方式

curl_setopt($curl, CURLOPT_USERAGENT, $ua);//设置UA

$a=curl_exec($curl);//执行curl;

curl_close($curl); // 关闭CURL会话

return $a;

}

?>
