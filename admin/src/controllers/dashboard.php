<?php
$action = "dashboard";
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
switch ($action) {
    case "dashboard":
        include "./src/views/dashboard/index.php";
        break;
}
