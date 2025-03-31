<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tourist - Travel Agency</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content name="keywords">
    <meta content name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
        rel="stylesheet">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
        rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css"
        rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css"
        rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

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
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary"
            style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar & Hero Start -->
    <?php require('shares/header.php'); ?>
    <!-- Navbar & Hero End -->

    <!-- Check Availability Form Start -->
    <div class="container availability-form">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded">
                <h5 class="mb-4">Check Booking Availability</h5>
                <form action="">
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight:500;">Check-in</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight:500;">Check-out</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight:500;">Adult</label>
                            <select class="form-select shadow-none" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label class="form-label" style="font-weight:500;">Children</label>
                            <select class="form-select shadow-none" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="col-lg-1 mb-lg-3 mt-2">
                            <button type="submit" class="btn text-white rounded-3 shadow-none custom-bg">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Check Availability Form End -->

    <!-- Our Rooms Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Rooms</h6>
                <h1 class="mb-5">Our Rooms</h1>
            </div>
            <div class="container">
                <div class="row">
                    <?php
                        include 'admin/database/db_config.php';
                        include 'admin/shares/essentials.php';

                        $room_res = select( "SELECT * FROM `rooms` WHERE `status` =? AND `removed` =? LIMIT 3", [1, 0], 'ii');
                        while($room_data = mysqli_fetch_assoc($room_res)) {

                            $fea_q = mysqli_query($conn,
                            "SELECT f.name FROM `features` f INNER JOIN `room_features` rfea 
                                    ON f.id = rfea.features_id WHERE rfea.room_id = '$room_data[id]'");
                            $features_data = "";
                            while($fea_row = mysqli_fetch_assoc($fea_q)) {
                                $features_data .= "
                                <span class='badge rounded-pill bg-light text-dark text-wrap'>
                                    $fea_row[name]
                                </span>";
                            }

                            $fac_q = mysqli_query($conn,
                            "SELECT f.name FROM `facilities` f INNER JOIN `room_facilities` rfac
                                    ON f.id = rfac.facilities_id WHERE rfac.room_id = '$room_data[id]'");
                            $facilities_data = "";
                            while($fac_row = mysqli_fetch_assoc($fac_q)) {
                                $facilities_data .= "
                                <span class='badge rounded-pill bg-light text-dark text-wrap'>
                                    $fac_row[name]
                                </span>";
                            }

                            $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
                            $thumb_q = mysqli_query($conn,
                                "SELECT * FROM `room_images` WHERE `room_id` = '$room_data[id]' AND `thumb` = '1'");
                            if(mysqli_num_rows($thumb_q) > 0) {
                                $thumb_res = mysqli_fetch_assoc($thumb_q);
                                $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
                            }

                            echo<<<data
                                <div class="card border-0 shadow" style="max-width: 300px; margin: auto;">
                                    <img src="$room_thumb" class="img-fluid rounded" alt="...">
                                    <div class="card-body">
                                        <h5>$room_data[name]</h5>
                                        <h6 class="mb-4">$$room_data[price] per night</h6>
                                        <div class="features mb-4">
                                            <h6 class="mb-1">Features</h6>
                                            $features_data
                                        </div>
                                        <div class="facilities mb-3">
                                            <h6 class="mb-3">Facilities</h6>
                                            $facilities_data
                                        </div>
                                        <div class="guests mb-4">
                                            <h6 class="mb-1">Guests</h6>
                                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                                $room_data[adult] Adults
                                            </span>
                                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                                $room_data[children] Children
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-evenly mb-2">
                                        <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book now</a>
                                        <a href="room_details.php?id=$room_data[id]" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
                                    </div>
                                </div>
                            data;
                        }
                    ?>
                </div>
                <div class="col-lg-12 text-center mt-5">
                    <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms >>></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Rooms End -->

    <!-- Our Services Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Services</h6>
                <h1 class="mb-5">Our Services</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded pt-3 h-100">
                        <div class="p-4 text-center">
                            <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                            <h5>Worldwide Tours</h5>
                            <p>Discover unforgettable adventures with our expertly curated global tours.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded pt-3 h-100">
                        <div class="p-4 text-center">
                            <i class="fa fa-3x fa-hotel text-primary mb-4"></i>
                            <h5>Hotel Reservation</h5>
                            <p>Secure the best accommodations with our hassle-free booking service.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded pt-3 h-100">
                        <div class="p-4 text-center">
                            <i class="fa fa-3x fa-user text-primary mb-4"></i>
                            <h5>Travel Guides</h5>
                            <p>Navigate your journey with insights from our seasoned travel experts.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item rounded pt-3 h-100">
                        <div class="p-4 text-center">
                            <i class="fa fa-3x fa-cog text-primary mb-4"></i>
                            <h5>Event Management</h5>
                            <p>Create memorable experiences with our professional event planning.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Services End -->

    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Travel Guide</h6>
                <h1 class="mb-5">Meet Our Guide</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-2 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/team-1.jpg" alt="Guide 1">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -19px;">
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">John Doe</h5>
                            <small>Senior Guide</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/team-2.jpg" alt="Guide 2">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -19px;">
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Jane Smith</h5>
                            <small>Tour Expert</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/team-3.jpg" alt="Guide 3">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -19px;">
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Mike Johnson</h5>
                            <small>Adventure Specialist</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/team-4.jpg" alt="Guide 4">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -19px;">
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Emily Brown</h5>
                            <small>Cultural Guide</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0.9s">
                    <div class="team-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/team-4.jpg" alt="Guide 5">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -19px;">
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Alex Taylor</h5>
                            <small>Local Expert</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->

    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6
                    class="section-title bg-white text-center text-primary px-3">Testimonial</h6>
                <h1 class="mb-5">Our Clients Say!!!</h1>
            </div>
            <div
                class="owl-carousel testimonial-carousel position-relative">
                <div
                    class="testimonial-item bg-white text-center border p-4">
                    <img
                        class="bg-white rounded-circle shadow p-1 mx-auto mb-3"
                        src="img/testimonial-1.jpg"
                        style="width: 80px; height: 80px;">
                    <h5 class="mb-0">John Doe</h5>
                    <p>New York, USA</p>
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam
                        dolor diam ipsum sit diam amet diam et eos. Clita
                        erat ipsum et lorem et sit.</p>
                </div>
                <div
                    class="testimonial-item bg-white text-center border p-4">
                    <img
                        class="bg-white rounded-circle shadow p-1 mx-auto mb-3"
                        src="img/testimonial-2.jpg"
                        style="width: 80px; height: 80px;">
                    <h5 class="mb-0">John Doe</h5>
                    <p>New York, USA</p>
                    <p class="mt-2 mb-0">Tempor erat elitr rebum at clita.
                        Diam dolor diam ipsum sit diam amet diam et eos.
                        Clita erat ipsum et lorem et sit.</p>
                </div>
                <div
                    class="testimonial-item bg-white text-center border p-4">
                    <img
                        class="bg-white rounded-circle shadow p-1 mx-auto mb-3"
                        src="img/testimonial-3.jpg"
                        style="width: 80px; height: 80px;">
                    <h5 class="mb-0">John Doe</h5>
                    <p>New York, USA</p>
                    <p class="mt-2 mb-0">Tempor erat elitr rebum at clita.
                        Diam dolor diam ipsum sit diam amet diam et eos.
                        Clita erat ipsum et lorem et sit.</p>
                </div>
                <div
                    class="testimonial-item bg-white text-center border p-4">
                    <img
                        class="bg-white rounded-circle shadow p-1 mx-auto mb-3"
                        src="img/testimonial-4.jpg"
                        style="width: 80px; height: 80px;">
                    <h5 class="mb-0">John Doe</h5>
                    <p>New York, USA</p>
                    <p class="mt-2 mb-0">Tempor erat elitr rebum at clita.
                        Diam dolor diam ipsum sit diam amet diam et eos.
                        Clita erat ipsum et lorem et sit.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6
                    class="section-title bg-white text-center text-primary px-3">Contact
                    Us</h6>
                <h1 class="mb-5">Contact For Any Query</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp"
                    data-wow-delay="0.1s">
                    <h5>Get In Touch</h5>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam
                        dolor diam ipsum sit. Aliqu diam amet diam et
                        eos</p>
                    <div class="d-flex align-items-center mb-4">
                        <div
                            class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary"
                            style="width: 50px; height: 50px;">
                            <i class="fa fa-map-marker-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Office</h5>
                            <p class="mb-0">123 Street, New York, USA</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <div
                            class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary"
                            style="width: 50px; height: 50px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Mobile</h5>
                            <p class="mb-0">+012 345 67890</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div
                            class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary"
                            style="width: 50px; height: 50px;">
                            <i class="fa fa-envelope-open text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Email</h5>
                            <p class="mb-0">info@example.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp"
                    data-wow-delay="0.3s">
                    <iframe class="position-relative rounded w-100 h-100"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                        frameborder="0" style="min-height: 300px; border:0;"
                        allowfullscreen aria-hidden="false"
                        tabindex="0"></iframe>
                </div>
                <div class="col-lg-4 col-md-12 wow fadeInUp"
                    data-wow-delay="0.5s">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control"
                                        id="name" placeholder="Your Name">
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control"
                                        id="email" placeholder="Your Email">
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control"
                                        id="subject" placeholder="Subject">
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control"
                                        placeholder="Leave a message here"
                                        id="message"
                                        style="height: 100px"></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3"
                                    type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <!-- Footer Start -->
    <?php require('shares/footer.php'); ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        const progressCircle = document.querySelector(".autoplay-progress svg");
        const progressContent = document.querySelector(".autoplay-progress span");
        var swiper = new Swiper(".swiper-testimonials", {
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            on: {
                autoplayTimeLeft(s, time, progress) {
                    progressCircle.style.setProperty("--progress", 1 - progress);
                    progressContent.textContent = `${Math.ceil(time / 1000)}s`;
                }
            }
        });
    </script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>