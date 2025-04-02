<?php
// Bắt đầu session ở đầu file
session_start();

// Cấu hình cơ sở dữ liệu
$hname = 'localhost';
$uname = 'root';
$pass = '';
$db = 'db_booking';
require_once("./config.php");
require_once("../admin/database/db_config.php");

// Debug: Kiểm tra và ghi log dữ liệu session
$debug = true;
if ($debug) {
    error_log("Session data: " . print_r($_SESSION, true));
}

// Lấy thông tin từ session
$customer_name = $_SESSION['customer_name'] ?? '';
$customer_email = $_SESSION['customer_email'] ?? '';
$customer_phone = $_SESSION['customer_phone'] ?? '';
$note = $_SESSION['note'] ?? '';
$id_room = $_SESSION['id_room'] ?? '';
$check_in = $_SESSION['check_in'] ?? '';
$check_out = $_SESSION['check_out'] ?? '';

if (empty($customer_name) && isset($_GET['vnp_TxnRef'])) {
    $order_id = $_GET['vnp_TxnRef'];
    // Kiểm tra trong bảng tạm nếu có
    $check_sql = "SELECT * FROM booking WHERE order_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $order_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $customer_name = $row['customer_name'];
        $customer_email = $row['customer_email'];
        $customer_phone = $row['customer_phone'];
        $note = $row['note'];
        $id_room = $_SESSION['id_room'];
        $check_in = $_SESSION['check_in'];
        $check_out = $_SESSION['check_out'];
    }
    $check_stmt->close();
}

// Xử lý dữ liệu từ VNPAY
$vnp_SecureHash = $_GET['vnp_SecureHash'] ?? '';
$inputData = array();
foreach ($_GET as $key => $value) {
    if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
    }
}

// Xác thực chữ ký
$secureHash = '';
if (!empty($inputData)) {
    unset($inputData['vnp_SecureHash']);
    ksort($inputData);
    $hashData = "";
    $i = 0;
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashData .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
    }
    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
}

// Biến kết quả
$success = false;
$message = '';

// Xử lý thanh toán thành công
if ($secureHash == $vnp_SecureHash && isset($_GET['vnp_ResponseCode']) && $_GET['vnp_ResponseCode'] == '00') {
    $order_id = $_GET['vnp_TxnRef'];
    $amount = $_GET['vnp_Amount'] / 100;
    $order_info = $_GET['vnp_OrderInfo'];
    $transaction_no = $_GET['vnp_TransactionNo'];
    $bank_code = $_GET['vnp_BankCode'];
    $pay_date = $_GET['vnp_PayDate'];

    // Debug: Kiểm tra thông tin trước khi lưu
    if ($debug) {
        error_log("Payment info: order_id=$order_id, amount=$amount, name=$customer_name, email=$customer_email, phone=$customer_phone, note=$note, room_id=$id_room, check_in=$check_in, check_out=$check_out");
    }

    // Kiểm tra xem bảng booking đã có cột note chưa        
    $check_column = $conn->query("SHOW COLUMNS FROM booking LIKE 'note'");
    if ($check_column->num_rows == 0) {
        // Nếu chưa có cột note thì thêm vào
        $conn->query("ALTER TABLE booking ADD COLUMN note TEXT");
    }

    // Lưu thông tin vào cơ sở dữ liệu
    if (!empty($customer_name) || !empty($customer_email) || !empty($customer_phone)) {
        // Lưu dữ liệu với thông tin khách hàng
        $sql = "INSERT INTO booking (
                order_id, 
                amount, 
                order_info, 
                transaction_no, 
                bank_code, 
                pay_date, 
                status, 
                customer_name, 
                customer_email, 
                customer_phone, 
                note,
                room_id,
                check_in,
                check_out
            ) VALUES (?, ?, ?, ?, ?, ?, 'Success', ?, ?, ?, ?,?,?,?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sdsssssssssss",
            $order_id,
            $amount,
            $order_info,
            $transaction_no,
            $bank_code,
            $pay_date,
            $customer_name,
            $customer_email,
            $customer_phone,
            $note,
            $id_room,
            $check_in,
            $check_out
        );
    } else {
        // Lưu dữ liệu không có thông tin khách hàng
        $sql = "INSERT INTO booking (
                order_id, 
                amount, 
                order_info, 
                transaction_no, 
                bank_code, 
                pay_date, 
                status
            ) VALUES (?, ?, ?, ?, ?, ?, 'Success')";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sdssss",
            $order_id,
            $amount,
            $order_info,
            $transaction_no,
            $bank_code,
            $pay_date
        );
    }

    if ($stmt->execute()) {
        $success = true;
        $message = "<span style='color:blue'>Giao dịch thành công - Đã lưu vào CSDL</span>";

        // Ghi log kết quả
        if ($debug) {
            error_log("Đã lưu dữ liệu vào bảng booking thành công");
        }
    } else {
        $message = "<span style='color:red'>Lỗi lưu dữ liệu: " . $stmt->error . "</span>";
        // Ghi log lỗi
        if ($debug) {
            error_log("Lỗi SQL: " . $stmt->error);
        }
    }

    $stmt->close();
} else if (isset($_GET['vnp_ResponseCode']) && $_GET['vnp_ResponseCode'] != '00') {
    $message = "<span style='color:red'>Giao dịch không thành công</span>";
} else {
    $message = "<span style='color:red'>Chữ ký không hợp lệ</span>";
}

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kết quả thanh toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>

    </style>
</head>

<body>
    <div class="container">
        <div class="payment-container">
            <!-- Header -->
            <div class="payment-header">
                <h2 class="mb-1"><i class="fas fa-receipt me-2"></i>Chi tiết thanh toán</h2>
                <p class="mb-0">Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi</p>
                <img src="https://sandbox.vnpayment.vn/paymentv2/images/brands/logo.svg" alt="VNPAY"
                    class="payment-logo">
            </div>

            <!-- Payment Status -->
            <div class="payment-status">
                <?php if (isset($_GET['vnp_ResponseCode']) && $_GET['vnp_ResponseCode'] == '00'): ?>
                    <div class="status-card success-card">
                        <div class="icon-circle">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h4>Thanh toán thành công</h4>
                        <p class="mb-0">Giao dịch của bạn đã được xử lý thành công</p>
                    </div>
                <?php else: ?>
                    <div class="status-card error-card">
                        <div class="icon-circle" style="color: #dc3545;">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <h4>Thanh toán thất bại</h4>
                        <p class="mb-0">Đã xảy ra lỗi trong quá trình thanh toán</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Payment Details -->
            <div class="payment-body">
                <div class="text-center mb-4">
                    <h5 class="text-uppercase text-muted">Thông tin giao dịch</h5>
                    <div class="payment-amount">
                        <?php echo isset($_GET['vnp_Amount']) ? number_format($_GET['vnp_Amount'] / 100) . ' VND' : 'N/A' ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="info-group">
                            <div class="info-label"><i class="fas fa-hashtag me-2"></i>Mã đơn hàng</div>
                            <div class="info-value"><?php echo $_GET['vnp_TxnRef'] ?? 'N/A' ?></div>
                        </div>

                        <div class="info-group">
                            <div class="info-label"><i class="fas fa-info-circle me-2"></i>Nội dung thanh toán</div>
                            <div class="info-value"><?php echo $_GET['vnp_OrderInfo'] ?? 'N/A' ?></div>
                        </div>

                        <div class="info-group">
                            <div class="info-label"><i class="fas fa-university me-2"></i>Ngân hàng</div>
                            <div class="info-value"><?php echo $_GET['vnp_BankCode'] ?? 'N/A' ?></div>
                        </div>

                        <div class="info-group">
                            <div class="info-label"><i class="fas fa-calendar-alt me-2"></i>Thời gian thanh toán</div>
                            <div class="info-value">
                                <?php
                                if (isset($_GET['vnp_PayDate'])) {
                                    $payDate = $_GET['vnp_PayDate'];
                                    // Format: YYYYMMDDHHmmss -> DD/MM/YYYY HH:mm:ss
                                    $year = substr($payDate, 0, 4);
                                    $month = substr($payDate, 4, 2);
                                    $day = substr($payDate, 6, 2);
                                    $hour = substr($payDate, 8, 2);
                                    $minute = substr($payDate, 10, 2);
                                    $second = substr($payDate, 12, 2);
                                    echo "$day/$month/$year $hour:$minute:$second";
                                } else {
                                    echo 'N/A';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-group">
                            <div class="info-label"><i class="fas fa-exchange-alt me-2"></i>Mã GD VNPAY</div>
                            <div class="info-value"><?php echo $_GET['vnp_TransactionNo'] ?? 'N/A' ?></div>
                        </div>

                        <div class="info-group">
                            <div class="info-label"><i class="fas fa-reply me-2"></i>Mã phản hồi</div>
                            <div class="info-value">
                                <?php echo $_GET['vnp_ResponseCode'] ?? 'N/A' ?>
                                <?php if (isset($_GET['vnp_ResponseCode']) && $_GET['vnp_ResponseCode'] == '00'): ?>
                                    <span class="badge bg-success ms-2">Thành công</span>
                                <?php else: ?>
                                    <span class="badge bg-danger ms-2">Thất bại</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="info-group">
                            <div class="info-label"><i class="fas fa-user me-2"></i>Thông tin khách hàng</div>
                            <div class="info-value">
                                <?php if (!empty($_SESSION['customer_name'])): ?>
                                    <p class="mb-1"><strong>Tên:</strong>
                                        <?php echo htmlspecialchars($_SESSION['customer_name']); ?></p>
                                    <p class="mb-1"><strong>Email:</strong>
                                        <?php echo htmlspecialchars($_SESSION['customer_email']); ?></p>
                                    <p class="mb-1"><strong>SĐT:</strong>
                                        <?php echo htmlspecialchars($_SESSION['customer_phone']); ?></p>
                                    <p class="mb-1">
                                        <strong>Check_in:</strong><?php echo htmlspecialchars($_SESSION['check_in']); ?>
                                    </p>
                                    <p class="mb-1">
                                        <strong>Check_out:</strong><?php echo htmlspecialchars($_SESSION['check_out']); ?>
                                    </p>
                                <?php else: ?>
                                    <p class="text-muted mb-0">Không có thông tin</p>
                                <?php endif; ?>
                            </div>
                        </div>



                        <?php if (!empty($note)): ?>
                            <div class="info-group">
                                <div class="info-label"><i class="fas fa-sticky-note me-2"></i>Ghi chú</div>
                                <div class="info-value"><?php echo $note ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (isset($_GET['vnp_ResponseCode']) && $_GET['vnp_ResponseCode'] == '00'): ?>
                    <div class="alert alert-success mt-4">
                        <i class="fas fa-check-circle me-2"></i> <?php echo $message ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger mt-4">
                        <i class="fas fa-exclamation-circle me-2"></i> <?php echo $message ?>
                    </div>
                <?php endif; ?>
                <!--  check data session -->
                <!-- <?php if ($debug): ?>
                        <div class="debug-section">
                            <h6><i class="fas fa-bug me-2"></i>Thông tin debug:</h6>
                            <pre><?php echo "SESSION: " . print_r($_SESSION, true); ?></pre>
                        </div>
                    <?php endif; ?> -->
            </div>

            <!-- Footer with Back Button -->
            <div class="payment-footer">
                <a href="../index.php" class="btn btn-primary back-button">
                    <i class="fas fa-home me-2"></i>Quay lại trang chủ
                </a>
                <p class="mt-3 text-muted">&copy; <?php echo date('Y') ?> - Powered by VNPAY</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>