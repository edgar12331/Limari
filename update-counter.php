<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

$counterFile = 'counter.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $count = isset($input['count']) ? intval($input['count']) : 0;
    
    file_put_contents($counterFile, json_encode(['count' => $count]));
    echo json_encode(['success' => true, 'count' => $count]);
} else {
    if (file_exists($counterFile)) {
        $data = json_decode(file_get_contents($counterFile), true);
        echo json_encode($data);
    } else {
        echo json_encode(['count' => 0]);
    }
}
?>