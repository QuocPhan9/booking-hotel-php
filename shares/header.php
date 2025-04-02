<?php
require "admin/database/db_config.php";
require "admin/shares/essentials.php";
session_start();
?>

<!-- Bootstrap JavaScript & Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<div class="container-fluid position-relative p-0">
    <nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <h1 class="text-success m-0">
                    <i class="fa fa-map-marker-alt me-2"></i>LETMECOOK
                </h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavSupportedContent">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="rooms.php">Rooms</a></li>
                    <li class="nav-item"><a class="nav-link" href="service.php">Facilities</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                </ul>
                <div class="ms-3">
                    <?php
                    if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
                        echo <<<data
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                                $_SESSION[name]
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                                <li><a class="dropdown-item" href="booking.php">Booking</a></li>
                                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                            </ul>
                                        </div>
                                    data;
                    } else {
                        echo <<<data
                            <button class="btn btn-primary rounded-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                            <button class="btn btn-primary rounded-3" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
                        data;
                    }
                    ?>

                </div>
            </div>
        </div>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="login_form">
                    <div class="modal-header">
                        <h1 class="modal-title d-flex align-items-center fs-5" id="staticBackdropLabel">
                            <i class="bi bi-person-circle fs-3 me-2"></i>User Login
                        </h1>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input name="email_mob" type="email" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input name="pass" type="password" class="form-control shadow-none">
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <button type="submit" class="btn btn-primary rounded-3">Login</button>
                            <a href="javascript:void(0)"
                                class="text-secondary text-decoration-none"
                                data-bs-toggle="modal"
                                data-bs-target="#forgotPasswordModal"
                                onclick="closeModal('loginModal')">
                                Forgot Password?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="register_form">
                    <div class="modal-header">
                        <h1 class="modal-title d-flex align-items-center fs-5" id="staticBackdropLabel">
                            <i class="bi bi-person-lines-fill fs-3 me-2"></i>User Registration
                        </h1>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                            Note: Your details must match with ID (card, passport, driving license, etc.) that will be required during check-in.
                        </span>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Name</label>
                                    <input name="name" type="text" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input name="phonenum" type="number" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Date of birth</label>
                                    <input name="dob" type="date" class="form-control shadow-none">
                                </div>
                                <div class="ps-0 mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea name="address" rows="1" class="form-control shadow-none"></textarea>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Password</label>
                                    <input name="pass" type="password" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input name="cpass" type="password" class="form-control shadow-none">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary shadow-none rounded-3">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Forgot Password -->
    <div class="modal fade" id="forgotPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">        <div class="modal-dialog">
            <div class="modal-content">
                <form id="forgotPasswordForm">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="forgotPasswordLabel">
                            <i class="bi bi-envelope-fill me-2"></i>Forgot Password
                        </h1>
                        <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted">Enter your email address to reset your password.</p>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Check Email</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Change Password -->
    <div class="modal fade" id="changePasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="changePasswordForm">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="changePasswordLabel">
                            <i class="bi bi-key-fill me-2"></i>Change Password
                        </h1>
                        <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="email" id="resetEmail">
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="new_pass" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="cpass" class="form-control" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Update Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- Reach us -->

<div class="container-fluid bg-primary py-5 mb-2 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1
                    class="display-3 text-white mb-3 animated slideInDown">Enjoy
                    Your Vacation With Us</h1>
                <div
                    class="position-relative w-75 mx-auto animated slideInDown">
                    <input
                        class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5"
                        type="text" placeholder="Eg: Thailand">
                    <button type="button"
                        class="btn btn-primary rounded-pill py-2 px-4 position-absolute top-0 end-0 me-2"
                        style="margin-top: 7px;">Search</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>