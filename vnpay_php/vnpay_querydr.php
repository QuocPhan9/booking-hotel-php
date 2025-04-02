<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tra cứu giao dịch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="text-center text-primary">VNPAY DEMO</h3>
        <h4 class="text-center">Tra cứu giao dịch</h4>
        <form action="/vnpay_php/vnpay_querydr.php" method="post">
            <div class="mb-3">
                <label class="form-label">Mã GD thanh toán cần truy vấn (vnp_TxnRef):</label>
                <input class="form-control" name="txnRef" type="text" required />
            </div>
            <div class="mb-3">
                <label class="form-label">Thời gian khởi tạo GD thanh toán (vnp_TransactionDate):</label>
                <input class="form-control" name="transactionDate" type="text" placeholder="yyyyMMddHHmmss" required />
            </div>
            <button type="submit" class="btn btn-primary w-100">Tra cứu</button>
        </form>
    </div>
</body>

</html>
