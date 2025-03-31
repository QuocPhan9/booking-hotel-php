<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Tourist - Travel Agency HTML Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content name="keywords">
        <meta content name="description">

        <?php require('shares/links.php');?>
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
                    <?php
                        $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
                        $values = [1];
                        $contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
                    ?>
                    <?php
                        $setting_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
                        $values = [1];
                        $setting_r = mysqli_fetch_assoc(select($setting_q, $values, 'i'));
                    ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp"
                        data-wow-delay="0.1s">
                        <h5><?php echo $setting_r['site_title'] ?></h5>
                        <p class="mb-4"><?php echo $setting_r['site_about'] ?></p>
                        <div class="d-flex align-items-center mb-4">
                            <div
                                class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary"
                                style="width: 50px; height: 50px;">
                                <i class="fa fa-map-marker-alt text-white"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="text-primary">Office</h5>
                                <p class="mb-0"><?php echo $contact_r['address'] ?></p>
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
                                <p class="mb-0">+<?php echo $contact_r['phone'] ?></p>
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
                                <p class="mb-0"><?php echo $contact_r['email'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp"
                        data-wow-delay="0.3s">
                        <iframe class="position-relative rounded w-100 h-100"
                            src="<?php echo $contact_r['iframe'] ?>"
                            frameborder="0" style="min-height: 300px; border:0;"
                            allowfullscreen aria-hidden="false"
                            tabindex="0"></iframe>
                    </div>
                    <div class="col-lg-4 col-md-12 wow fadeInUp"
                        data-wow-delay="0.5s">
                        <form method="POST">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control"
                                            name="name" required placeholder="Your Name">
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email"required class="form-control"
                                            name="email" placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" required class="form-control"
                                            name="subject" placeholder="Subject">
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control"
                                            placeholder="Leave a message here"
                                            name="message"
                                            required
                                            style="height: 100px"></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button name="send" class="btn btn-primary w-100 py-3"
                                        type="submit">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->
        <?php
            if(isset($_POST['send'])) {
                $frm_data = filteration($_POST);

                $q = "INSERT INTO `user_queries`(`name`, `email`, `message`, `subject`) VALUES (?,?,?,?)";
                $values = [$frm_data['name'], $frm_data['email'], $frm_data['subject'],$frm_data['message']];

                $res = insert($q, $values, 'ssss');

                if($res == 1){
                    alert('success', 'Mail sent');
                } else {
                    alert('error', 'Sever Down! Try again later.');
                }

            }
        ?>
        <!-- Footer Start -->
        <?php require 'shares/footer.php'; ?>
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i
                class="bi bi-arrow-up"></i></a>

        <!-- JavaScript Libraries -->
        <?php require('shares/script.php'); ?>
    </body>

</html>