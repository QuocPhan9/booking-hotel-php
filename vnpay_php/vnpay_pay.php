<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Tạo đơn hàng thanh toán qua cổng VNPAY">
    <meta name="author" content="VNPAY">

    <title>Tạo mới đơn hàng - VNPAY</title>

    <!-- CSS Libraries -->
    <link href="vnpay_php/assets/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>

    </style>
</head>

<body>
    <div class="vnpay-container">
        <div class="vnpay-header">
            <img src="/api/placeholder/140/40" alt="VNPAY Logo" class="vnpay-logo">
            <h1 class="vnpay-title">Tạo mới đơn hàng</h1>
        </div>

        <div class="vnpay-content">
            <form action="/booking-hotel-php/vnpay_php/vnpay_create_payment.php" id="frmCreateOrder" method="post">
                <h4 class="form-title">Thông tin thanh toán</h4>

                <div class="amount-group mb-4">
                    <label for="amount" class="form-label">Số tiền thanh toán</label>
                    <span class="currency-prefix">VND</span>
                    <input class="form-control" data-val="true" data-val-number="Số tiền phải là số."
                        data-val-required="Vui lòng nhập số tiền." id="amount" max="100000000" min="1" name="amount"
                        type="number" value="10000">
                    <div class="form-text text-muted">Số tiền tối đa: 100,000,000 VND</div>
                </div>

                <div class="payment-section">
                    <h4 class="payment-method-title">Chọn phương thức thanh toán</h4>

                    <div class="payment-option">
                        <input type="radio" checked id="gateway" name="bankCode" value="">
                        <label for="gateway">
                            <span class="payment-icon"><i class="fas fa-credit-card"></i></span>
                            Cổng thanh toán VNPAYQR
                        </label>
                    </div>
                    <div class="method-description">Chuyển hướng đến Cổng VNPAY để chọn phương thức thanh toán</div>

                    <hr class="my-3">
                    <h5 class="mt-4 mb-3">Hoặc chọn phương thức thanh toán ngay tại đây</h5>

                    <div class="payment-option">
                        <input type="radio" id="qrcode" name="bankCode" value="VNPAYQR">
                        <label for="qrcode">
                            <span class="payment-icon"><i class="fas fa-qrcode"></i></span>
                            Thanh toán bằng ứng dụng hỗ trợ VNPAYQR
                        </label>
                    </div>

                    <div class="payment-option">
                        <input type="radio" id="atmcard" name="bankCode" value="VNBANK">
                        <label for="atmcard">
                            <span class="payment-icon"><i class="fas fa-university"></i></span>
                            Thanh toán qua thẻ ATM/Tài khoản nội địa
                        </label>
                    </div>

                    <div class="payment-option">
                        <input type="radio" id="intcard" name="bankCode" value="INTCARD">
                        <label for="intcard">
                            <span class="payment-icon"><i class="far fa-credit-card"></i></span>
                            Thanh toán qua thẻ quốc tế
                        </label>
                    </div>
                </div>

                <div class="mb-4">
                    <h5 class="payment-method-title">Ngôn ngữ hiển thị</h5>
                    <div class="language-selector">
                        <div class="language-option">
                            <input type="radio" checked id="lang-vi" name="language" value="vn">
                            <label for="lang-vi" class="ms-2">
                                <img src="/api/placeholder/22/16" alt="VN" class="language-flag">
                                Tiếng Việt
                            </label>
                        </div>

                        <div class="language-option">
                            <input type="radio" id="lang-en" name="language" value="en">
                            <label for="lang-en" class="ms-2">
                                <img src="/api/placeholder/22/16" alt="EN" class="language-flag">
                                Tiếng Anh
                            </label>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-lock"></i> Tiến hành thanh toán
                    </button>
                </div>
            </form>
        </div>

        <div class="vnpay-footer">
            <div class="secure-badge">
                <i class="fas fa-shield-alt"></i> Giao dịch bảo mật
            </div>
            <div>
                &copy; VNPAY 2025
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>