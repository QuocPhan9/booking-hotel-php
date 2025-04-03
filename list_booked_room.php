<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách phòng đã đặt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="vnpay_php/assets/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <?php require('shares/header.php'); ?>

    <div class="container">
        <div id="rooms-list" class="row g-4">
            <!-- Dữ liệu phòng sẽ được tải ở đây -->
        </div>

        <div class="text-center mt-4 mb-5">
            <button id="loadMore" class="load-more-btn">
                <i class="fas fa-sync-alt me-2"></i>Xem thêm
            </button>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            let page = 1;

            function loadBookedRooms(page) {
                $.ajax({
                    url: 'ajax/load_booked_rooms.php',
                    type: 'GET',
                    data: { page: page },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);  // In ra phản hồi từ server để kiểm tra
                        if (response.success && response.rooms.length > 0) {
                            response.rooms.forEach(room => {
                                // Xử lý dữ liệu features để hiển thị với icons
                                let featuresArray = room.features.split(',').map(feature => feature.trim());
                                let featuresHTML = featuresArray.map(feature =>
                                    `<div class="feature-item">
                                        <i class="fas fa-check-circle feature-icon"></i>
                                        ${feature}
                                    </div>`
                                ).join('');

                                // Xử lý dữ liệu facilities để hiển thị với icons
                                let facilitiesArray = room.facilities.split(',').map(facility => facility.trim());
                                let facilitiesHTML = facilitiesArray.map(facility =>
                                    `<div class="facility-item">
                                        <i class="fas fa-spa facility-icon"></i>
                                        ${facility}
                                    </div>`
                                ).join('');

                                $('#rooms-list').append(`
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="card shadow">
                                            <div class="card-img-container">
                                                <img src="${room.room_thumb}" alt="${room.room_name}">
                                                <div class="price-badge">${room.price}/đêm</div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="room-name">${room.room_name}</h5>
                                                
                                                <div class="feature-section">
                                                    <div class="section-title">Tiện nghi</div>
                                                    ${featuresHTML}
                                                </div>
                                                
                                                <div class="facility-section">
                                                    <div class="section-title">Dịch vụ</div>
                                                    ${facilitiesHTML}
                                                </div>
                                                
                                                <div class="guest-section">
                                                    <div class="section-title">Số lượng khách</div>
                                                    <span class="guest-badge">
                                                        <i class="fas fa-user guest-icon"></i> ${room.adult} người lớn
                                                    </span>
                                                    <span class="guest-badge">
                                                        <i class="fas fa-child guest-icon"></i> ${room.children} trẻ em
                                                    </span>
                                                </div>
                                                
                                                <div class="d-grid gap-2 mt-4">
                                                    <a href="booked.php?id=${room.booking_id}" class="details-btn btn">
                                                        Xem chi tiết <i class="fas fa-arrow-right ms-2"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `);
                            });
                        } else {
                            $('#loadMore').prop('disabled', true).html('<i class="fas fa-exclamation-circle me-2"></i>Không còn phòng nào');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Lỗi AJAX: " + status + " - " + error);
                        $('#loadMore').html('<i class="fas fa-exclamation-triangle me-2"></i>Đã xảy ra lỗi');
                    }
                });
            }

            // Tải dữ liệu khi trang load
            loadBookedRooms(page);

            // Khi người dùng bấm "Xem thêm"
            $('#loadMore').click(function () {
                $(this).html('<i class="fas fa-spinner fa-spin me-2"></i>Đang tải...');
                page++;
                setTimeout(function () {
                    loadBookedRooms(page);
                    $('#loadMore').html('<i class="fas fa-sync-alt me-2"></i>Xem thêm');
                }, 600);
            });
        });
    </script>
    <?php require 'shares/footer.php' ?>
</body>

</html>