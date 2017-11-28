<?php
//$routes['admin/posts/post/(\d+)'] = ['\Controllers\Admin\Post', 'view', ['post_id']];
$routes[''] = ['\App\Controllers\Index\Main', 'index'];
$routes['login'] = ['\App\Controllers\Index\Auth', 'login'];
$routes['logout'] = ['\App\Controllers\Index\Auth', 'logout'];
$routes['operations'] = ['\App\Controllers\Index\Operations', 'index'];
$routes['operations/success'] = ['\App\Controllers\Index\Operations', 'success'];
$routes['operations/fail'] = ['\App\Controllers\Index\Operations', 'fail'];