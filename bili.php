<?php

$bv=$_GET["id"];

$urlreturn=gettcurl("https://m.bilibili.com/video/".$bv);

preg_match('/time">(.*?)<\/div>/', $urlreturn, $matches);

$ti=$matches[1];

$p=explode(":",$ti);

$m=$p[0];

$s=$p[1];

for($i=0;$m>=$i;$i++){

if($m==$i){

for($iii=0;$iii<=$s;$iii++){

if(strlen($iii)==1){$iii="0".$iii;}

print_r($m.":".$iii." ");

}

}else{

for($ii=0;$ii<=59;$ii++){

if(strlen($ii)==1){$ii="0".$ii;}

print_r($i.":".$ii." ");

}

}

}

function gettcurl($u){

$url=$u;

$ua='Mozilla/5.0 (Linux; Android 20; MI 11  Build/PKQ1.181121.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/74.0.3729.136 Mobile Safari/537.36';

$curl = curl_init();//初始化curl

curl_setopt($curl, CURLOPT_URL,$url);//访问的url

$httpheader[] = "Accept-Language:zh-CN,zh;q=0.8";

$httpheader[] = "origin:https://member.bilibili.com";

curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);

curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);//获取的信息以文件流的方式

curl_setopt($curl, CURLOPT_USERAGENT, $ua);//设置UA

$a=curl_exec($curl);//执行curl;

curl_close($curl); // 关闭CURL会话

return $a;

}

?>
