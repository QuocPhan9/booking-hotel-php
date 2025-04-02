<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tourist - Travel Agency</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content name="keywords">
    <meta content name="description">

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
    <?php

    if (!isset($_GET['id'])) {
        redirect('rooms.php');
    }

    $data = filteration($_GET);

    $room_res = select("SELECT * FROM `rooms` WHERE `id` =? AND `status` =? AND `removed` =?", [$data['id'], 1, 0], 'iii');
    if (mysqli_num_rows($room_res) == 0) {
        redirect('rooms.php');
    }
    $room_data = mysqli_fetch_assoc($room_res);
    ?>

    <!-- Spinner placeholder - would be connected to your existing spinner code -->
    <div id="spinner" class="d-none">
        <!-- Spinner content -->
    </div>

    


    <!-- Room Details Start -->
    <div class="container py-5">
        <div class="row g-4">
            <!-- Room Gallery -->
            <div class="col-lg-8">
                <div id="roomCarousel" class="carousel slide room-gallery" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#roomCarousel" data-bs-slide-to="0"
                            class="active"></button>
                        <button type="button" data-bs-target="#roomCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#roomCarousel" data-bs-slide-to="2"></button>
                    </div>
                    <div class="carousel-inner">
                        <?php
                        $room_img = ROOMS_IMG_PATH . "thumbnail.jpg";
                        $img_q = mysqli_query(
                            $conn,
                            "SELECT * FROM `room_images` WHERE `room_id` = '$room_data[id]'"
                        );
                        if (mysqli_num_rows($img_q) > 0) {
                            $active_class = 'active';
                            while ($img_res = mysqli_fetch_assoc($img_q)) {
                                echo "
                                        <div class='carousel-item $active_class'>
                                            <img src='" . ROOMS_IMG_PATH . $img_res['image'] . "' class='d-block w-100' alt='...'>
                                        </div>
                                    ";
                                $active_class = '';
                            }
                        } else {
                            echo "
                                    <div class='carousel-item active'>
                                        <img src='$room_img' class='d-block w-100' alt='...'>
                                    </div>
                                ";
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!-- Room Description -->
                <div class="bg-white rounded-3 p-4 mt-4 shadow-sm">
                    <h3>Description</h3>
                    <p class="text-muted"><?php echo $room_data['description'] ?></p>
                </div>

                <!-- Reviews Section -->
                <div class="reviews-section mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="mb-0">Reviews & Ratings</h3>
                        <button class="btn btn-outline-primary">Write a Review</button>
                    </div>

                    <!-- Review Item -->
                    <div class="review-item">
                        <div class="d-flex">
                            <img src="img/testimonial-2.jpg" class="review-avatar me-3" alt="User">
                            <div>
                                <h5 class="mb-1">John Smith</h5>
                                <div class="mb-2">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <span class="ms-2 text-muted">June 15, 2024</span>
                                </div>
                                <p>Absolutely stunning room with incredible ocean views! The service was impeccable, and
                                    the amenities were top-notch. Would definitely recommend to anyone looking for a
                                    luxury experience.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Review Item -->
                    <div class="review-item">
                        <div class="d-flex">
                            <img src="img/team-1.jpg" class="review-avatar me-3" alt="User">
                            <div>
                                <h5 class="mb-1">Sarah Johnson</h5>
                                <div class="mb-2">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star text-warning"></i>
                                    <span class="ms-2 text-muted">May 23, 2024</span>
                                </div>
                                <p>My family and I had a wonderful stay in the Deluxe Ocean Suite. The room was spacious
                                    and clean, and the view was breathtaking. The only reason I didn't give 5 stars is
                                    because the Wi-Fi was a bit slow at times.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Load More Button -->
                    <button class="btn btn-light w-100 mt-3">Load More Reviews</button>
                </div>
            </div>

            <!-- Room Booking Sidebar -->
            <div class="col-lg-4">
                <!-- Room Info Card -->
                <div class="room-info-card bg-white">
                    <div class="p-4 border-bottom">
                        <h1 class="text-success "><?php echo $room_data['name'] ?></h1>
                        <h5 class="text-warning">id:<?php echo $room_data['id'] ?></h5>
                    </div>
                    <div class="p-4 border-bottom">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="price-tag"><?php echo $room_data['price'] ?><small>/night</small></div>
                            <div>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                                <span class="ms-1">4.8</span>
                            </div>
                        </div>
                    </div>

                    <!-- Room Features Card -->
                    <div class="room-info-card bg-white mt-4">
                        <div class="p-4">
                            <h5 class="mb-3 text-primary fs-3">Room Details</h5>
                            <ul class="list-unstyled">
                                <li class="d-flex mb-3">
                                    <i class="bi bi-rulers me-3 text-primary"></i>
                                    <span><?php echo $room_data['area']; ?> square meters</span>
                                </li>
                                <li class="d-flex mb-3">
                                    <i class="bi bi-people me-3 text-primary"></i>
                                    <span>Max <?php echo $room_data['adult']; ?> Adults,
                                        <?php echo $room_data['children']; ?> Children</span>
                                </li>
                                <li class="d-flex mb-3">
                                    <i class="bi bi-eye me-3 text-primary"></i>
                                    <span>Ocean View</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <?php
                        $book_btn = "";
                        $login = 0;
                        if (!isset($setting_r['shutdown']) || !$setting_r['shutdown']) {
                            $login = isset($_SESSION["login"]) && $_SESSION["login"] == true ? 1:0;
                            $book_btn = "<button class='btn btn-primary py-3 rounded-pill fw-bold' onClick='checkLoginToBook($login, {$room_data['id']})'><i class='fas fa-check-circle me-2'></i>Xác nhận đặt phòng</button>";
                        }
                        echo $book_btn;
                        ?>

                        <button class="btn btn-outline-primary rounded-pill">
                            <i class="far fa-heart me-2"></i>Lưu vào yêu thích
                        </button>
                    </div>

                    <!-- Room Amenities Card -->
                    <?php

                    // Fetch facilities
                    $fac_q = mysqli_query(
                        $conn,
                        "SELECT f.icon, f.name FROM `facilities` f 
                    INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id 
                    WHERE rfac.room_id = '$room_data[id]'"
                    );

                    $facilities_data = "";
                    while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                        $facilities_data .= "
                        <span class='badge bg-light text-dark feature-badge d-flex align-items-center px-3 py-2 me-2 mb-2'>
                            <i class='bi {$fac_row['icon']} me-2 fs-5'></i> {$fac_row['name']}
                        </span>";
                    }

                    // Render HTML
                    echo <<<HTML
                        <div class="facilities-section mt-3">
                            <h6 class="mb-3 text-primary fs-3 px-4"><i class="bi bi-tools me-2"></i>Facilities</h6>
                            <div class="d-flex flex-wrap">
                                $facilities_data
                            </div>
                        </div>

                        <a href="#" class="btn btn-lg w-100 text-white bg-gradient-primary shadow mt-3 py-2">
                            <i class="bi bi-calendar-check me-2"></i> Book Now
                        </a>
                    HTML;
                    ?>

                    <!-- Need Help Card -->
                    <div class="room-info-card bg-white mt-4">
                        <div class="p-4">
                            <h5 class="mb-3 text-primary fs-3">Need Help?</h5>
                            <p class="text-muted mb-3">Have questions about this room or need special arrangements?
                                Contact
                                us directly.</p>
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-telephone-fill fs-5 text-primary me-2"></i>
                                <a href="tel:+1234567890" class="text-dark">+1 (234) 567-890</a>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-envelope-fill fs-5 text-primary me-2"></i>
                                <a href="mailto:info@example.com" class="text-dark">booking@tourist.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Room Details End -->


        <!-- Process Section -->
        <div class="container py-5">
            <div class="text-center mb-5">
                <h6 class="section-title bg-white text-primary px-3">Process</h6>
                <h2 class="mb-0">3 Easy Steps to Your Perfect Vacation</h2>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="process-box text-center">
                        <div class="process-icon">
                            <i class="fas fa-calendar-check fa-2x"></i>
                        </div>
                        <h4 class="mt-4">Choose Your Dates</h4>
                        <div class="divider my-3">
                            <div class="d-flex justify-content-center">
                                <div class="bg-primary" style="width: 40px; height: 3px;"></div>
                            </div>
                        </div>
                        <p class="text-muted">Select your check-in and check-out dates using our easy booking calendar.
                            View
                            real-time availability and secure the best rates.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="process-box text-center">
                        <div class="process-icon">
                            <i class="fas fa-credit-card fa-2x"></i>
                        </div>
                        <h4 class="mt-4">Secure Payment</h4>
                        <div class="divider my-3">
                            <div class="d-flex justify-content-center">
                                <div class="bg-primary" style="width: 40px; height: 3px;"></div>
                            </div>
                        </div>
                        <p class="text-muted">Complete your booking with our secure payment system. We accept all major
                            credit cards and provide instant confirmation.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="process-box text-center">
                        <div class="process-icon">
                            <i class="fas fa-suitcase fa-2x"></i>
                        </div>
                        <h4 class="mt-4">Pack & Enjoy</h4>
                        <div class="divider my-3">
                            <div class="d-flex justify-content-center">
                                <div class="bg-primary" style="width: 40px; height: 3px;"></div>
                            </div>
                        </div>
                        <p class="text-muted">Pack your bags and get ready for an unforgettable stay. Our staff will
                            handle
                            everything else to ensure your complete comfort.</p>
                    </div>
                </div>
            </div>
        </div>
        <?php require'shares/footer.php'?>