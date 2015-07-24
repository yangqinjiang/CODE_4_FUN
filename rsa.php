<?php
$private_key = '-----BEGIN RSA PRIVATE KEY-----
MIICXgIBAAKBgQCzy2pCcUFnSeost+0mkT9Oyn91KswPWm/zm2eHcF4e+7oC+t1y
ONQqf9XG9YD/OdiQR2ra2aupbhueOe5THA9ozkcVNhXf6lvmkCjIJmXHFQMvCn7J
ibEHBJj4gQwarUtDstwWjUNhQR/g3k18nkJr/5jWFy2dqsM+QFyenYhiSwIDAQAB
AoGACxSjRNsEA+CbTQw80l6rPyjduBPeJagWNDZEqCU1t8Udzqc1VJ/J+6CLRUrG
G3SuMx4jqL83hCakDxlU5cxZ6qoxgymHQnOXUiAv+kT4JdcCiUAi5vtCaZReXg3P
0DqFX1cmbuMTqbDNJB9NY8lBKgnyydTu+cYo/OuUOd2T97ECQQDZZmG5SSW1mMyN
S6d2pQoM5XPXkUtdZR6svD7l9vfv+zZzpADYS+UtnKIack6H2mh3EIspTLAXj46m
6cuT7QBTAkEA07e72fHOn+RlJmofrQBCYKMSDZYEqNE1z1c3N7U8c4+yMn5fg79X
ytL8Dx8etU7lWzmmR8Q8CImABuZnrki3KQJBALWOt1ZSLFf4f/wQjo6bTkVu6svA
37vj0zZXEABlvLKCjfsNoFcDKyZohUio5cS3Nj8ZZd7b2MQUdAIZhpbHe1kCQQCI
JKtQn/TtzrHYvP93gSYt/E7cm66NXFMM7JmeYhXofevqGmeTUdTDoV7i3nEhyAUm
33B0z9SG7Nx+E2VypmHZAkEAyTl7ywe47O6n89TjKQcFDagRpzUOLcd34K7Xjrb9
y6j7W/K2SOAxQTBFLzOfqnRAYVckzYKuBcSPlubRpKb7ZQ==
-----END RSA PRIVATE KEY-----';

$public_key = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCzy2pCcUFnSeost+0mkT9Oyn91
KswPWm/zm2eHcF4e+7oC+t1yONQqf9XG9YD/OdiQR2ra2aupbhueOe5THA9ozkcV
NhXf6lvmkCjIJmXHFQMvCn7JibEHBJj4gQwarUtDstwWjUNhQR/g3k18nkJr/5jW
Fy2dqsM+QFyenYhiSwIDAQAB
-----END PUBLIC KEY-----';

//echo $private_key;
$pi_key =  openssl_pkey_get_private($private_key);//这个函数可用来判断私钥是否是可用的，可用返回资源id Resource id
$pu_key = openssl_pkey_get_public($public_key);//这个函数可用来判断公钥是否是可用的
print_r($pi_key);echo "\n";
print_r($pu_key);echo "\n";


$data = "aassssasssddd";//原始数据
$encrypted = ""; 
$decrypted = ""; 

echo "source data:",$data,"\n";

echo "private key encrypt:\n";

openssl_private_encrypt($data,$encrypted,$pi_key);//私钥加密
$encrypted = base64_encode($encrypted);//加密后的内容通常含有特殊字符，需要编码转换下，在网络间通过url传输时要注意base64编码是否是url安全的
echo $encrypted,"\n";

echo "public key decrypt:\n";

openssl_public_decrypt(base64_decode($encrypted),$decrypted,$pu_key);//私钥加密的内容通过公钥可用解密出来
echo $decrypted,"\n";

// echo "---------------------------------------\n";
// echo "public key encrypt:\n";

// openssl_public_encrypt($data,$encrypted,$pu_key);//公钥加密
// $encrypted = base64_encode($encrypted);
// echo $encrypted,"\n\n";

// echo "private key decrypt:\n";
// openssl_private_decrypt(base64_decode($encrypted),$decrypted,$pi_key);//私钥解密
// echo $decrypted,"\n";
// var_dump($decrypted == $data);