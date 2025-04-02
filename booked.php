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
    <style>
        :root {
            --primary: #1a4568;
            --primary-light: #2a5a82;
            --secondary: #e8952f;
            --secondary-light: #f6b45d;
            --accent: #5ba0d0;
            --text-dark: #2c3e50;
            --text-light: #7f8c8d;
            --light-bg: #f5f7fa;
            --success: #2ecc71;
            --danger: #e74c3c;
            --border-radius: 12px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-dark);
            background-color: var(--light-bg);
            line-height: 1.6;
        }

        /* Header */
        .booking-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            padding: 2rem 0;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            height: 200px;
        }

        .booking-header::before {

            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1618773928121-c32242e63f39?ixlib=rb-4.0.3&auto=format&fit=crop&w=1500&q=80') center/cover no-repeat;
            opacity: 0.15;
            z-index: 0;
        }

        .booking-header .container {
            position: relative;
            z-index: 1;
        }

        .booking-header h1 {
            font-weight: 700;
            font-size: 2.2rem;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .hotel-logo {
            height: 60px;
            margin-left: 20px;
        }

        /* Room detail container */
        .room-detail-container {
            margin-top: -60px;
            position: relative;
            z-index: 10;
            padding: 0 15px;
        }

        .room-card {
            background-color: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
            border: none;
        }

        /* Room image gallery */
        .room-gallery {
            position: relative;
            height: 400px;
            overflow: hidden;
        }

        .room-gallery img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .room-gallery:hover img {
            transform: scale(1.05);
        }

        .price-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: var(--secondary);
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: 700;
            box-shadow: 0 5px 15px rgba(232, 149, 47, 0.3);
            z-index: 2;
        }

        .room-status {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: var(--success);
            color: white;
            padding: 8px 16px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.3);
            z-index: 2;
        }

        /* Room details */
        .room-details-section {
            padding: 30px;
        }

        .room-name {
            color: var(--primary);
            font-weight: 800;
            font-size: 2.2rem;
            margin-bottom: 5px;
        }

        .room-description {
            color: var(--text-light);
            font-size: 1.1rem;
            margin-bottom: 25px;
            line-height: 1.7;
        }

        .booking-id {
            background-color: rgba(26, 69, 104, 0.1);
            padding: 10px 20px;
            border-radius: var(--border-radius);
            display: inline-block;
            margin-bottom: 25px;
            font-weight: 600;
            color: var(--primary);
        }

        .booking-dates {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            padding: 20px;
            background-color: var(--light-bg);
            border-radius: var(--border-radius);
        }

        .date-item {
            flex: 1;
            padding: 0 15px;
            text-align: center;
            position: relative;
        }

        .date-item:not(:last-child)::after {
            content: "";
            position: absolute;
            right: 0;
            top: 10%;
            height: 80%;
            width: 1px;
            background-color: #ddd;
        }

        .date-label {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 5px;
        }

        .date-value {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
        }

        .date-time {
            font-size: 0.85rem;
            color: var(--text-light);
            margin-top: 5px;
        }

        /* Features Section */
        .features-section {
            margin-top: 30px;
        }

        .section-title {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .section-title::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--secondary);
            border-radius: 3px;
        }

        .features-grid,
        .facilities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .feature-item,
        .facility-item {
            background-color: var(--light-bg);
            border-radius: var(--border-radius);
            padding: 15px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .feature-item:hover,
        .facility-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .feature-icon,
        .facility-icon {
            color: var(--accent);
            font-size: 1.2rem;
            margin-right: 10px;
            width: 25px;
            text-align: center;
        }

        /* Guests Section */
        .guests-section {
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .guest-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .guest-badge {
            background-color: var(--light-bg);
            border-radius: 30px;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            font-weight: 600;
        }

        .guest-icon {
            color: var(--accent);
            margin-right: 10px;
        }

        /* Actions Section */
        .actions-section {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .details-btn {
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 30px;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .details-btn:hover {
            background-color: var(--primary-light);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(26, 69, 104, 0.3);
            color: white;
        }

        .print-btn {
            background-color: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 30px;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .print-btn:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(26, 69, 104, 0.3);
        }

        .btn-icon {
            margin-right: 10px;
        }

        /* Additional Information */
        .additional-info {
            background-color: var(--light-bg);
            border-radius: var(--border-radius);
            padding: 20px;
            margin-top: 30px;
        }

        .info-title {
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .info-icon {
            color: var(--secondary);
            margin-right: 10px;
            margin-top: 3px;
        }

        /* Error states */
        .error-message {
            text-align: center;
            padding: 50px 20px;
            color: var(--text-light);
        }

        .error-icon {
            font-size: 3rem;
            color: var(--text-light);
            margin-bottom: 20px;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .room-gallery {
                height: 350px;
            }

            .booking-dates {
                flex-direction: column;
                padding: 15px;
            }

            .date-item {
                padding: 15px 0;
            }

            .date-item:not(:last-child)::after {
                width: 80%;
                height: 1px;
                top: unset;
                bottom: 0;
                right: 10%;
            }
        }

        @media (max-width: 768px) {
            .booking-header h1 {
                font-size: 1.8rem;
            }

            .hotel-logo {
                height: 50px;
            }

            .room-gallery {
                height: 250px;
            }

            .room-name {
                font-size: 1.8rem;
            }

            .room-details-section {
                padding: 20px;
            }

            .features-grid,
            .facilities-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }

            .actions-section {
                flex-direction: column;
            }

            .details-btn,
            .print-btn {
                width: 100%;
            }
        }

        /* Loading animation */
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 300px;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            border-left-color: var(--primary);
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Print styles */
        @media print {
            .booking-header {
                background: none !important;
                color: black;
                box-shadow: none;
                padding: 20px 0;
            }

            .booking-header::before {
                display: none;
            }

            .room-status,
            .price-badge {
                box-shadow: none;
            }

            .details-btn,
            .print-btn,
            .no-print {
                display: none !important;
            }

            .room-card {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }
    </style>
</head>

<body>
    <header class="booking-header py-10">
        <div class="container">
            <div class="row align-items-center p-8">
                <div class="col-md-8 p-8">
                    <h1><i class="bi bi-check-circle-fill text-success me-2"></i> Chi tiết phòng đã đặt</h1>
                </div>
                <div class="col-md-4 text-md-end">
                    <img src="https://via.placeholder.com/180x60?text=LUXURY+HOTEL" alt="Luxury Hotel Logo"
                        class="hotel-logo">
                </div>
            </div>
        </div>
    </header>

    <main class="container room-detail-container">
        <div id="room-details" class="row">
            <!-- Room details will be loaded here -->
            <div class="loading">
                <div class="spinner"></div>
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
                        console.log(response); // Để kiểm tra dữ liệu trả về
                        $('.loading').hide();

                        if (response.success && response.room) {
                            const room = response.room;

                            // Generate features and facilities HTML
                            let featuresHTML = room.features || '';
                            let facilitiesHTML = room.facilities || '';

                            // Chuyển đổi ngày nhận và trả phòng
                            const checkInDate = new Date(room.check_in);
                            const checkOutDate = new Date(room.check_out);

                            // Tính số đêm
                            const soDem = Math.ceil((checkOutDate - checkInDate) / (1000 * 60 * 60 * 24));

                            $('#room-details').html(`
                            <div class="col-12">
                                <div class="room-card">
                                    <div class="room-gallery">
                                        <img src="${room.room_thumb || 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?ixlib=rb-4.0.3&auto=format&fit=crop&w=1500&q=80'}" alt="${room.room_name || 'Room Name'}">
                                        <div class="price-badge">${room.price || '2,500,000 VNĐ'}/đêm</div>
                                        <div class="room-status">ĐÃ XÁC NHẬN</div>
                                    </div>
                                    
                                    <div class="room-details-section">
                                        <h2 class="room-name">${room.room_name || 'Deluxe Room'}</h2>
                                        <p class="room-description">${room.description || ''}</p>
                                        
                                        <div class="booking-id">
                                            <i class="bi bi-bookmark-check me-2"></i> Mã đặt phòng: LUX-2023-${room.room_id || '10456'}
                                        </div>
                                        
                                        <div class="booking-dates">
                                            <div class="date-item">
                                                <div class="date-label">Ngày nhận phòng</div>
                                                <div class="date-value">${room.check_in || ''}</div>
                                                <div class="date-time">Từ 14:00</div>
                                            </div>
                                            
                                            <div class="date-item">
                                                <div class="date-label">Ngày trả phòng</div>
                                                <div class="date-value">${room.check_out || ''}</div>
                                                <div class="date-time">Trước 12:00</div>
                                            </div>
                                            
                                            <div class="date-item">
                                                <div class="date-label">Số đêm</div>
                                                <div class="date-value">${soDem}</div>
                                            </div >
                                        </div >
                                        
                                        <div class="d-flex justify-content-around">
                                            <div class="features-section">
                                                <h3 class="section-title">Tiện nghi phòng</h3>
                                                <div class="features-grid">
                                                    ${featuresHTML || `
                                                        <div class="feature-item">Kitchen</div>
                                                        <div class="feature-item">Bedroom</div>
                                                    `}
                                                </div>
                                            </div>
                                            
                                            <div class="features-section">
                                                <h3 class="section-title">Dịch vụ & Tiện ích</h3>
                                                <div class="facilities-grid">
                                                    ${facilitiesHTML || `
                                                        <div class="facility-item">Wifi</div>
                                                        <div class="facility-item">Television</div>
                                                        <div class="facility-item">Air Conditioner</div>
                                                    `}
                                                </div>
                                            </div>
                                            
                                            <div class="guests-section">
                                                <h3 class="section-title">Số lượng khách</h3>
                                                <div class="guest-badges">
                                                    <div class="guest-badge">
                                                        <i class="bi bi-person-fill guest-icon"></i>
                                                        <span>${room.adult || '2'} người lớn</span>
                                                    </div>
                                                    <div class="guest-badge">
                                                        <i class="bi bi-person-arms-up guest-icon"></i>
                                                        <span>${room.children || '1'} trẻ em</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="additional-info">
                                            <h4 class="info-title">Thông tin quan trọng</h4>
                                            <div class="info-item">
                                                <i class="bi bi-info-circle info-icon"></i>
                                                <div>Vui lòng xuất trình CMND/CCCD/Hộ chiếu và mã đặt phòng khi nhận phòng.</div>
                                            </div>
                                            <div class="info-item">
                                                <i class="bi bi-currency-exchange info-icon"></i>
                                                <div>Miễn phí hủy trước 3 ngày so với ngày đến.</div>
                                            </div>
                                            <div class="info-item">
                                                <i class="bi bi-clock info-icon"></i>
                                                <div>Quý khách vui lòng báo trước nếu check-in muộn sau 18:00.</div>
                                            </div>
                                        </div>
                                        
                                        <div class="actions-section">
                                            <a href="room_details.php?id=${room.room_id || '1'}" class="details-btn">
                                                <i class="bi bi-info-circle btn-icon"></i> Xem thêm chi tiết
                                            </a>
                                            <button onclick="window.print()" class="print-btn no-print">
                                                <i class="bi bi-printer btn-icon"></i> In xác nhận
                                            </button>
                                        </div>
                                    </div >
                                </div >
                            </div >
                            `);
                        } else {
                            $('#room-details').html(`
                            < div class="col-12" >
                                <div class="room-card">
                                    <div class="error-message">
                                        <i class="bi bi-exclamation-diamond-fill error-icon d-block"></i>
                                        <h3>Không tìm thấy thông tin phòng</h3>
                                        <p>Rất tiếc, chúng tôi không thể tìm thấy thông tin phòng bạn yêu cầu.</p>
                                        <a href="index.php" class="details-btn mt-3">
                                            <i class="bi bi-house-door btn-icon"></i> Quay lại trang chủ
                                        </a>
                                    </div>
                                </div>
                            </div >
                            `);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Lỗi AJAX: " + status + " - " + error);
                        $('.loading').hide();
                        $('#room-details').html(`
                            < div class="col-12" >
                                <div class="room-card">
                                    <div class="error-message">
                                        <i class="bi bi-x-octagon-fill error-icon d-block"></i>
                                        <h3>Đã xảy ra lỗi</h3>
                                        <p>Rất tiếc, đã xảy ra lỗi khi tải dữ liệu phòng. Vui lòng thử lại sau.</p>
                                        <a href="index.php" class="details-btn mt-3">
                                            <i class="bi bi-house-door btn-icon"></i> Quay lại trang chủ
                                        </a>
                                    </div>
                                </div>
                        </div >
                            `);
                    }
                });
            } else {
                $('.loading').hide();
                $('#room-details').html(`
                            < div class="col-12" >
                                <div class="room-card">
                                    <div class="error-message">
                                        <i class="bi bi-question-diamond-fill error-icon d-block"></i>
                                        <h3>Vui lòng chọn phòng</h3>
                                        <p>Vui lòng chọn một phòng để xem chi tiết.</p>
                                        <a href="index.php" class="details-btn mt-3">
                                            <i class="bi bi-house-door btn-icon"></i> Quay lại trang chủ
                                        </a>
                                    </div>
                                </div>
                </div >
            `);
            }
        });
    </script>

</body>

</html>