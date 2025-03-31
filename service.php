<head>
    <meta charset="utf-8">
    <title>Tourist - Travel Agency HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content name="keywords">
    <meta content name="description">

    <?php require('shares/links.php'); ?>
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
                <h6 class="section-title bg-white text-center text-primary px-3">Facilities</h6>
                <h1 class="mb-5">Our Facilities</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <?php 
                    $res = selectAll('facilities');
                    $path = FACILITIES_IMG_PATH;

                    while($row = mysqli_fetch_assoc($res)) {
                        echo <<<data
                            <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="service-item rounded pt-3 h-100">
                                    <div class="p-4 text-center">
                                        <img src="$path$row[icon]" width="40px"/>
                                        <h5>$row[name]</h5>
                                        <p>$row[description]</p>
                                    </div>
                                </div>
                            </div>
                        data;
                    }
                ?>
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
    <?php require('shares/script.php'); ?>
</body>