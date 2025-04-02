<?php
// Start session and output buffering at the very top of the file
session_start();
require 'admin/database/db_config.php';

// Process form submission
// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['customer_name'] = isset($_POST['customer_name']) ? trim($_POST['customer_name']) : '';
    $_SESSION['customer_email'] = isset($_POST['customer_email']) ? trim($_POST['customer_email']) : '';
    $_SESSION['customer_phone'] = isset($_POST['customer_phone']) ? trim($_POST['customer_phone']) : '';
    $_SESSION['note'] = isset($_POST['note']) ? trim($_POST['note']) : '';
    $_SESSION['id_room'] = isset($_POST['id_room']) ? trim($_POST['id_room']) : '';

    // Lưu check-in và check-out vào session
    $_SESSION['check_in'] = isset($_POST['checkIn']) ? trim($_POST['checkIn']) : '';
    $_SESSION['check_out'] = isset($_POST['checkOut']) ? trim($_POST['checkOut']) : '';

    // Debugging - check if session values are set
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
}



// Get room information
$room_data = null;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM rooms WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $room_data = $result->fetch_assoc();
}

$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đặt phòng khách sạn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <!-- Form đặt phòng -->
        <form action="/booking-hotel-php/vnpay_php/vnpay_create_payment.php" method="post"
            class="row booking-form shadow p-4 rounded">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-primary">Thông tin đặt phòng</h3>
                <p class="text-muted">Vui lòng điền đầy đủ thông tin để hoàn tất đặt phòng</p>
            </div>

            <!-- Thông tin cá nhân -->
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4"><i class="fas fa-user-circle me-2"></i>Thông tin cá nhân</h5>

                        <!-- Input họ tên -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="fullName" name="customer_name"
                                placeholder="Họ và tên" required>
                            <label for="fullName"><i class="fas fa-user me-2"></i>Họ và tên</label>
                        </div>

                        <!-- Input số điện thoại -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="phone" name="customer_phone"
                                placeholder="Số điện thoại" required>
                            <label for="phone"><i class="fas fa-phone me-2"></i>Số điện thoại</label>
                        </div>

                        <!-- Input email -->
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="customer_email"
                                placeholder="Email" required>
                            <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                        </div>

                        <!-- Input ngày nhận và trả phòng -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" id="checkIn" name="checkIn" required>
                                    <label for="checkIn"><i class="fas fa-calendar-check me-2"></i>Nhận phòng</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" id="checkOut" name="checkOut" required>
                                    <label for="checkOut"><i class="fas fa-calendar-minus me-2"></i>Trả phòng</label>
                                </div>
                            </div>
                        </div>

                        <!-- Ghi chú -->
                        <div class="form-floating mb-3">
                            <textarea name="note" id="note" class="form-control"></textarea>
                            <label for="note">Ghi chú</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thông tin thanh toán -->
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4"><i class="fas fa-credit-card me-2"></i>Thông tin thanh toán</h5>

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control fs-2 text-primary"
                                value="<?= htmlspecialchars($room_data['name']) ?>">
                        </div>

                        <div class="form-floating mb-4">
                            <input type="hidden" class="form-control text-primary" name="id_room" id="id_room"
                                value="<?= $id ?>">
                        </div>

                        <!-- Hiển thị số đêm thuê -->
                        <div class="form-floating mb-4">
                            <input type="number" class="form-control" id="numNights" name="numNights" min="0" value="0"
                                readonly>
                            <label for="numNights"><i class="fas fa-moon me-2"></i>Số đêm</label>
                        </div>

                        <!-- Xử lý giá phòng -->
                        <div class="form-floating mb-4">
                            <?php if ($room_data): ?>
                                <input type="number" class="form-control" id="pricePerNight"
                                    value="<?= htmlspecialchars(intval($room_data['price'])) * 1000 ?>" readonly hidden>
                                <input type="number" class="form-control" id="amount" name="amount" min="1" max="100000000"
                                    value="0" required>

                                <label for="amount"><i class="fas fa-money-bill-wave me-2"></i>Số tiền thanh toán
                                    (VND)</label>
                            <?php elseif (isset($_GET['id'])): ?>
                                <div class="alert alert-danger text-center">Không tìm thấy phòng!</div>
                            <?php else: ?>
                                <div class="alert alert-warning text-center">Vui lòng chọn một phòng!</div>
                            <?php endif; ?>
                        </div>

                        <!-- Chọn phương thức thanh toán -->
                        <div class="payment-methods mt-4">
                            <h5 class="mb-3">Phương thức thanh toán</h5>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" id="atmcard" name="bankCode"
                                    value="VNBANK">
                                <label class="form-check-label fw-bold w-100" for="atmcard">
                                    <i class="fas fa-university text-warning me-2"></i>Thanh toán qua thẻ ATM/Tài
                                    khoản nội địa
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" id="intcard" name="bankCode"
                                    value="INTCARD">
                                <label class="form-check-label fw-bold w-100" for="intcard">
                                    <i class="far fa-credit-card text-danger me-2"></i>Thanh toán qua thẻ quốc tế
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100">Tiến hành thanh toán</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- JavaScript tính tổng tiền -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const checkIn = document.getElementById("checkIn");
            const checkOut = document.getElementById("checkOut");
            const totalAmount = document.getElementById("amount");
            const numNights = document.getElementById("numNights");
            const pricePerNight = document.getElementById("pricePerNight");

            function calculateTotal() {
                const checkInDate = new Date(checkIn.value);
                const checkOutDate = new Date(checkOut.value);

                if (checkInDate && checkOutDate && checkOutDate > checkInDate) {
                    const nights = Math.floor((checkOutDate - checkInDate) / (1000 * 60 * 60 * 24));
                    numNights.value = nights;
                    totalAmount.value = nights * parseFloat(pricePerNight.value);
                } else {
                    numNights.value = "0";
                    totalAmount.value = "0";
                }
            }

            checkIn.addEventListener("change", calculateTotal);
            checkOut.addEventListener("change", calculateTotal);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>