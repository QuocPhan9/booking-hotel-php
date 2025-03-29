<head>
    <meta charset="utf-8">
    <title>Tourist - Travel Agency HTML Template</title>
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
    <?php require 'shares/header.php'; ?>
    <!-- Navbar & Hero End -->

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

    <!-- Footer Start -->
    <?php require 'shares/footer.php'; ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script
        src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>