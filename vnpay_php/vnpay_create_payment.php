<?php
// Thiết lập báo lỗi và múi giờ
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');

require_once("./config.php");

// Kiểm tra và xử lý dữ liệu đầu vào
if (!isset($_POST['amount']) || !is_numeric($_POST['amount']) || $_POST['amount'] <= 0) {
    die('Số tiền không hợp lệ!');
}

if (!isset($_POST['id_room'])) {
    die('id không hợp lệ!');
}
session_start();

// Lưu thông tin vào session ngay lập tức
$_SESSION['note'] = $_POST['note'] ?? '';
$_SESSION['id_room'] = $_POST['id_room'] ? trim($_POST['id_room']) : '';
$_SESSION['check_in'] = isset($_POST['checkIn']) ? trim($_POST['checkIn']) : '';
$_SESSION['check_out'] = isset($_POST['checkOut']) ? trim($_POST['checkOut']) : '';

// Tạo mã giao dịch
$vnp_TxnRef = date('YmdHis') . rand(10, 99);
$vnp_Amount = $_POST['amount'];
$vnp_Locale = isset($_POST['language']) ? $_POST['language'] : 'vn';
$vnp_BankCode = isset($_POST['bankCode']) ? $_POST['bankCode'] : '';
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

// Tạo ngày hết hạn: +15 phút từ thời điểm tạo giao dịch
$expire = date('YmdHis', strtotime('+15 minutes'));

// Chuẩn bị dữ liệu cho VNPAY
$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount * 100,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
    "vnp_OrderType" => "other",
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
    "vnp_ExpireDate" => $expire
);

// Thêm mã ngân hàng nếu có
if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}

// Sắp xếp dữ liệu theo thứ tự key
ksort($inputData);

// Tạo chuỗi query và chuỗi hash
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

// Tạo URL thanh toán
$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) {
    // Tạo chữ ký bảo mật
    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}

// Log thông tin giao dịch (tuỳ chọn)
$logData = [
    'time' => date('Y-m-d H:i:s'),
    'txn_ref' => $vnp_TxnRef,
    'amount' => $vnp_Amount,
    'ip' => $vnp_IpAddr
];

// Chuyển hướng người dùng sang trang thanh toán VNPAY
header('Location: ' . $vnp_Url);
die();