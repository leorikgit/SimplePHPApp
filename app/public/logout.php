<?php
include_once __DIR__."../../core/ini.php";

$user = new User();
$user->logout();
Redirect::to('index.php');
