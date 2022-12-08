<?php
$action = "default";
if (isset($_GET["action"])) {
    $action = $_GET["action"];
}
switch ($action) {
    case "default":
        include "./src/views/header.php";
        break;
    case "thamkhao_act":
        include "./src/views/thamkhao.php";
        break;
}
