<?php

session_start();
session_destroy();
// header('Location: index.php');
echo json_encode(['success' => true]);
exit();