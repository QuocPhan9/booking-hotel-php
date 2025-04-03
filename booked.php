<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết phòng đã đặt | Luxury Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="vnpay_php/assets/style.css">
    <?php require('shares/links.php'); ?>
    <style>
        .custom-bg {
            background-color: #86B817;
        }

        .custom-bg:hover {
            background-color: #98c33a;
        }

        .availability-form {
            margin-top: -80px;
            z-index: 2;
            position: relative;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .autoplay-progress {
            position: absolute;
            right: 16px;
            bottom: 16px;
            z-index: 10;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: var(--swiper-theme-color);
        }

        .autoplay-progress svg {
            --progress: 0;
            position: absolute;
            left: 0;
            top: 0px;
            z-index: 10;
            width: 100%;
            height: 100%;
            stroke-width: 4px;
            stroke: var(--swiper-theme-color);
            fill: none;
            stroke-dashoffset: calc(125.6px * (1 - var(--progress)));
            stroke-dasharray: 125.6;
            transform: rotate(-90deg);
        }
    </style>

</head>

<body>
    <?php require 'shares/header.php'; ?>

    <main class="container my-5">
        <div id="room-details" class="row justify-content-center">
            <div class="col-12 text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function () {
            const roomId = <?php echo isset($_GET['id']) ? $_GET['id'] : 0; ?>;

            if (roomId) {
                $.ajax({
                    url: 'ajax/booked_room.php',
                    type: 'GET',
                    data: { id: roomId },
                    dataType: 'json',
                    success: function (response) {
                        $('#room-details').empty();

                        if (response.success && response.room) {
                            const room = response.room;
                            const checkInDate = new Date(room.check_in);
                            const checkOutDate = new Date(room.check_out);
                            const nights = Math.ceil((checkOutDate - checkInDate) / (1000 * 60 * 60 * 24));

                            $('#room-details').html(`
                                <div class="col-md-8">
                                    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                                        <img src="${room.room_thumb || 'default-image.jpg'}" class="card-img-top" alt="${room.room_name}">
                                        <div class="card-body p-4">
                                            <h3 class="card-title text-primary fw-bold">${room.room_name || 'Deluxe Room'}</h3>
                                            <p class="card-text text-muted">${room.description || 'Không có mô tả'}</p>
                                            <h5 class="text-danger fw-bold">${room.price * 1000 || '2,500,000'} VNĐ / đêm</h5>
                                            <hr>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><strong>Tên:</strong> ${room.name}</li>
                                                <li class="list-group-item"><strong>Email:</strong> ${room.email}</li>
                                                <li class="list-group-item"><strong>SĐT:</strong> ${room.phonenum}</li>
                                                <li class="list-group-item"><strong>Ngày nhận phòng:</strong> ${room.check_in} (Từ 14:00)</li>
                                                <li class="list-group-item"><strong>Ngày trả phòng:</strong> ${room.check_out} (Trước 12:00)</li>
                                                <li class="list-group-item"><strong>Số đêm:</strong> ${nights}</li>
                                            </ul>
                                            <div class="d-flex justify-content-center mt-4">
                                                <button onclick="window.print()" class="btn btn-primary btn-lg">
                                                    <i class="bi bi-printer"></i> In Xác Nhận
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);
                        } else {
                            $('#room-details').html('<div class="col-12 text-center"><h3 class="text-danger">Không tìm thấy thông tin phòng</h3></div>');
                        }
                    },
                    error: function () {
                        $('#room-details').html('<div class="col-12 text-center"><h3 class="text-danger">Lỗi khi tải dữ liệu phòng</h3></div>');
                    }
                });
            } else {
                $('#room-details').html('<div class="col-12 text-center"><h3>Vui lòng chọn phòng</h3></div>');
            }
        });
    </script>

    <?php require 'shares/footer.php'; ?>
</body>


</html>