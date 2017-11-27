<?php
//$routes['admin/posts/post/(\d+)'] = ['\Controllers\Admin\Post', 'view', ['post_id']];
$routes[''] = ['\Controllers\Index\Main', 'index'];
$routes['login'] = ['\Controllers\Index\Auth', 'login'];
$routes['logout'] = ['\Controllers\Index\Auth', 'logout'];
$routes['operations'] = ['\Controllers\Index\Operations', 'index'];
$routes['operations/success'] = ['\Controllers\Index\Operations', 'success'];
$routes['operations/fail'] = ['\Controllers\Index\Operations', 'fail'];