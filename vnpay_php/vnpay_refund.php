<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hoàn tiền giao dịch - VNPAY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="text-center mb-4">Hoàn tiền giao dịch</h3>
        <form action="/vnpay_php/vnpay_refund.php" method="post">
            <div class="mb-3">
                <label class="form-label">Mã giao dịch thanh toán (vnp_TxnRef):</label>
                <input type="text" class="form-control" name="TxnRef" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kiểu hoàn tiền (vnp_TransactionType):</label>
                <select name="TransactionType" class="form-select">
                    <option value="02">Hoàn tiền toàn phần</option>
                    <option value="03">Hoàn tiền một phần</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Số tiền hoàn:</label>
                <input type="number" class="form-control" name="Amount" min="1" max="100000000" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Thời gian giao dịch (yyyyMMddHHmmss):</label>
                <input type="text" class="form-control" name="TransactionDate" placeholder="yyyyMMddHHmmss" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Người khởi tạo hoàn (vnp_CreateBy):</label>
                <input type="text" class="form-control" name="CreateBy" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Xác nhận hoàn tiền</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>