
<?php


$file = 'https://instagram.fist4-1.fna.fbcdn.net/v/t50.2886-16/66478566_497528664333011_7663243195820449790_n.mp4?efg=eyJ2ZW5jb2RlX3RhZyI6InZ0c192b2RfdXJsZ2VuLjcyMC5mZWVkIn0&_nc_ht=instagram.fist4-1.fna.fbcdn.net&vs=18087553153006544_2311406546&_nc_vs=HBksFQAYJEdPWmg5Z1BUbWszcmY4UUJBUDZmVHNJVlQxbHFia1lMQUFBRhUAABUAGCRHTUpQQWdTSmRURll5MjhBQU5pa3NhZDlPNXhiYmtZTEFBQUYVAgAoABgAGwGIB3VzZV9vaWwBMBUAABgAFqCon4OToqFAFQIZBRgCQzMsF0A4XbItDlYEGBJkYXNoX2Jhc2VsaW5lXzFfdjERAHXqBwA%3D&_nc_rid=11cf05996c&oe=5D2EB04A&oh=a11b90867b57c224e768aa1da5a1803e';
$url  = $file;
$path = 'new-video.mp4';
$fp = fopen($path, 'w');

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_FILE, $fp);

$data = curl_exec($ch);

curl_close($ch);
fclose($fp);
?>