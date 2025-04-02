<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách phòng đã đặt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        :root {
            --primary-color: #5e72e4;
            --secondary-color: #f7fafc;
            --accent-color: #11cdef;
            --text-dark: #32325d;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fe;
            color: var(--text-dark);
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            color: white;
            padding: 60px 0;
            border-radius: 0 0 25px 25px;
            margin-bottom: 40px;
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .card-img-container {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .card-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .card:hover .card-img-container img {
            transform: scale(1.05);
        }

        .price-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: rgba(255, 255, 255, 0.9);
            color: var(--primary-color);
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        .room-name {
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        .feature-icon,
        .facility-icon,
        .guest-icon {
            color: var(--primary-color);
            margin-right: 5px;
            width: 20px;
        }

        .feature-item,
        .facility-item {
            display: inline-block;
            margin-right: 10px;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .guest-badge {
            background-color: var(--secondary-color);
            color: var(--text-dark);
            border-radius: 20px;
            padding: 5px 12px;
            margin-right: 10px;
            font-weight: 500;
            font-size: 0.85rem;
        }

        .details-btn {
            background-color: var(--primary-color);
            color: white;
            border-radius: 25px;
            padding: 8px 25px;
            font-weight: 500;
            border: none;
            transition: all 0.3s;
        }

        .details-btn:hover {
            background-color: #4c60c7;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(94, 114, 228, 0.4);
        }

        .details-btn:active {
            transform: translateY(0);
        }

        .load-more-btn {
            background-color: white;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            border-radius: 25px;
            padding: 10px 30px;
            font-weight: 600;
            transition: all 0.3s;
            margin-top: 20px;
            margin-bottom: 50px;
        }

        .load-more-btn:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .section-title {
            font-weight: 600;
            font-size: 0.9rem;
            color: #8898aa;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .feature-section,
        .facility-section,
        .guest-section {
            margin-bottom: 15px;
        }

        /* Responsive adjustments */
        @media (max-width: 767px) {
            .page-header {
                padding: 40px 0;
            }

            .card-img-container {
                height: 180px;
            }
        }
    </style>
</head>

<body>
    <div class="page-header">
        <div class="container">
            <h1 class="text-center fw-bold">Danh sách phòng đã đặt</h1>
            <p class="text-center mb-0 mt-2 text-white-50">Trải nghiệm những căn phòng tuyệt vời của chúng tôi</p>
        </div>
    </div>

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
            let page = 1; // Biến để theo dõi trang số

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
</body>

</html>