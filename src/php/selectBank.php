<?php
header('Content-Type: application/json');

$selectedBankId = $_GET['bankId'];

// Check the selected bank ID and set data accordingly
if ($selectedBankId == 1) {
    $data = [
        'image' => '../../public/image/SCBQR.png',
        'Name' => 'เทพพิทักษ์ เกรียงไกรฉัตร'
    ];
} elseif ($selectedBankId == 2) {
    $data = [
        'image' => '../../public/image/KTBQR.png',
        'Name' => 'กษิดิ์เดช สังข์แก้ว',
    ];
} else {
    $data = [
        'error' => 'Invalid bank ID',
    ];
}

echo json_encode($data);
?>