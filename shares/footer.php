<div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <?php
            $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
            $values = [1];
            $contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
            ?>
            <div class="col-lg-8 col-md-6">
                <h4 class="text-white mb-3">Contact</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i><?php echo $contact_r['address'] ?></p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+<?php echo $contact_r['phone'] ?></p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i><?php echo $contact_r['email'] ?></p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <h4 class="text-white mb-3">Company</h4>
                <a class="btn btn-link" href="index.php">Home</a>
                <a class="btn btn-link" href="rooms.php">Rooms</a>
                <a class="btn btn-link" href="service.php">Services</a>
                <a class="btn btn-link" href="contact.php">Contact</a>
                <a class="btn btn-link" href="about.php">About</a>
            </div>
        </div>
    </div>
</div>


<script>
    // Set the active class on the current page in the navbar
    function closeModal(modalId) {
        var modal = bootstrap.Modal.getInstance(document.getElementById(modalId));
        if (modal) {
            modal.hide(); // Ẩn modal trước
        }
    }

    function alert(type, msg, position = 'body') {
        let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');
        element.innerHTML = `
            <div class="alert ${bs_class} alert-dismissible fade show custom-alert" role="alert">
                <strong class="me-3">${msg}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            `;
        if (position == 'body') {
            document.body.append(element);
        } else {
            document.getElementById(position).appendChild(element);
        }
        setTimeout(remAlert, 2000);
    }

    function remAlert() {
        document.getElementsByClassName('custom-alert')[0].remove();
    }

    // function setActive() {
    //     let navbar = document.getElementById('dashboard-menu');
    //     let a_tags = navbar.getElementsByTagName('a');

    //     for (i = 0; i < a_tags.length; i++) {
    //         let file = a_tags[i].href.split('/').pop();
    //         let file_name = file.split('.')[0];

    //         if (document.location.href.indexOf(file) != -1) {
    //             a_tags[i].classList.add('active');
    //         }
    //     }
    // }

    document.addEventListener("DOMContentLoaded", function() {
        let registerForm = document.getElementById("register_form");

        registerForm.addEventListener("submit", function(e) {
            e.preventDefault(); // Ngăn chặn form gửi đi mặc định


            let xhr = new XMLHttpRequest();

            xhr.open("POST", "ajax/login_regester.php", true);
            xhr.onload = function() {
                let response = this.responseText.trim(); // Lấy phản hồi từ server

                if (response === "pass_mismatch") {
                    alert("Mật khẩu không khớp!");
                } else if (response === "email_already") {
                    alert("Email đã tồn tại!");
                } else if (response === "phonenum_already") {
                    alert("Số điện thoại đã đăng ký!");
                } else if (response === "mail_failed") {
                    alert("Gửi email xác nhận thất bại!");
                } else if (response === "ins_failed") {
                    alert("Lỗi khi đăng ký!");
                } else if (response === "1") {
                    alert("Đăng ký thành công! Vui lòng kiểm tra email để xác nhận.");
                    registerForm.reset(); // Xóa nội dung form sau khi đăng ký thành công
                } else {
                    alert("Lỗi không xác định!");
                }
            };

            xhr.send(formData); // Gửi dữ liệu qua AJAX
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        let loginForm = document.getElementById("login_form");

        loginForm.addEventListener("submit", function(e) {
            e.preventDefault(); // Ngăn chặn form gửi đi mặc định

            let formData = new FormData(loginForm); // Lấy dữ liệu từ form
            formData.append("login", "1"); // Thêm key để xác định đăng ký

            let xhr = new XMLHttpRequest();

            xhr.open("POST", "ajax/login_regester.php", true);
            xhr.onload = function() {
                let response = this.responseText.trim(); // Lấy phản hồi từ server
                if (response == "1") {
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    alert("Lỗi không xác định!");
                }
            };
            xhr.send(formData); // Gửi dữ liệu qua AJAX
        });
    });

    // let register_form = document.getElementById('register_form');

    // register_form.addEventListener('submit', function(e) {
    //     e.preventDefault();
    //     let data = new FormData();



    //     var Model = document.getElementById('registerModal');
    //     var modal = bootstrap.Modal.getInstance(Model);
    //     modal.hide();

    //     let xhr = new XMLHttpRequest();
    //     xhr.open('POST', "ajax/login_regester.php", true);
    //     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    //     xhr.onload = function() {
    //         if (this.responseText == 'pass_mismatch') {
    //             alert('error', 'Password Mismatch!');
    //         } else if (this.responseText == 'email_already') {
    //             alert('error', 'Email Already registered');
    //         } else if (this.responseText == 'phonenum_already') {
    //             alert('error', 'Phone Number Already Exists');
    //         } else if (this.responseText == 'mail_failed') {
    //             alert('error', 'Email Sending Failed');
    //         } else if (this.responseText == 1) {
    //             alert('success', 'Registration Successful. Confirmation link sent to email!');
    //             register_form.reset();
    //         }
    //     }
    //     console.log(data);
    //     xhr.send(data);
    // });

    // document.addEventListener("DOMContentLoaded", function() {
    //     let login_form = document.getElementById("login_form");

    //     login_form.addEventListener("submit", function(e) {
    //         e.preventDefault();

    //         let form = new FormData(login_form);
    //         data.append("login", "1"); // Xác định là login
    //         // data.append("email_mob", login_form.elements["email_mob"].value);
    //         // data.append("pass", login_form.elements["pass"].value);

    //         // Ẩn modal đăng nhập
    //         let Model = document.getElementById("loginModal");
    //         let modal = bootstrap.Modal.getInstance(Model);
    //         modal.hide();

    //         let xhr = new XMLHttpRequest();
    //         xhr.open("POST", "ajax/login_register.php", true);
    //         xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    //         xhr.onload = function() {
    //             let res = this.responseText.trim();

    //             // let msgBox = document.getElementById("login_message");
    //             // if (!msgBox) {
    //             //     msgBox = document.createElement("div");
    //             //     msgBox.id = "login_message";
    //             //     login_form.prepend(msgBox);
    //             // }
    //             // msgBox.style.color = "red";

    //             switch (res) {
    //                 case "inv_email_mob":
    //                     msgBox.innerHTML = "Email hoặc số điện thoại không hợp lệ!";
    //                     break;
    //                 case "invalid_pass":
    //                     msgBox.innerHTML = "Mật khẩu không chính xác!";
    //                     break;
    //                 case "1":
    //                     msgBox.style.color = "green";
    //                     msgBox.innerHTML = "Đăng nhập thành công!";
    //                     setTimeout(() => window.location.reload(), 1000);
    //                     break;
    //                 default:
    //                     msgBox.innerHTML = "Lỗi không xác định!";
    //             }
    //         };

    //         xhr.onerror = function() {
    //             alert("Lỗi kết nối! Vui lòng thử lại sau.");
    //         };
    //         console.log(data.toString());
    //         xhr.send(data);
    //     });
    // });

    document.addEventListener("DOMContentLoaded", function() {
        let forgot_form = document.getElementById("forgotPasswordForm");

        forgot_form.addEventListener("submit", function(e) {
            e.preventDefault(); // Ngăn chặn form gửi đi mặc định

            let formData = new FormData(forgot_form); // Lấy dữ liệu từ form
            formData.append("forgot_pass", ""); // Thêm key để xác định đăng ký

            closeModal('forgotPasswordModal');
            document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
                backdrop.remove();
            });
            let xhr = new XMLHttpRequest();

            xhr.open("POST", "ajax/login_regester.php", true);
            xhr.onload = function() {
                let response = this.responseText.trim(); // Lấy phản hồi từ server
                if (response === "1") {
                    console.log("thành công:", response);
                    sessionStorage.setItem('forgotEmail', forgot_form.elements["email"].value);
                    let newModal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
                    newModal.show(); // Mở modal mới
                } else {
                    console.log(response);
                }
            };

            xhr.send(formData); // Gửi dữ liệu qua AJAX
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        let change_form = document.getElementById("changePasswordForm");


        change_form.addEventListener("submit", function(e) {
            e.preventDefault(); // Ngăn chặn form gửi đi mặc định

            let email = sessionStorage.getItem('forgotEmail');
            let emailField = document.getElementById('resetEmail'); 
            emailField.value = email;
            
            let formData = new FormData(change_form); // Lấy dữ liệu từ form
            formData.append("recovery_user", ""); // Thêm key để xác định đăng ký

            closeModal('changePasswordModal');
            document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
                backdrop.remove();
            });
            let xhr = new XMLHttpRequest();

            xhr.open("POST", "ajax/login_regester.php", true);
            xhr.onload = function() {
                let response = this.responseText.trim(); // Lấy phản hồi từ server
                if (response === "1") {} else {
                    sessionStorage.removeItem('forgotEmail');
                    console.log(response);
                }
            };

            xhr.send(formData); // Gửi dữ liệu qua AJAX
        });
    });

    // let forgot_form = document.getElementById('forgotPasswordModal');
    function checkLoginToBook(isLoggedIn, roomId) {
        if (!isLoggedIn) {
            var loginModal = new bootstrap.Modal(document.getElementById("loginModal"));
            loginModal.show();
            alert('error', 'Please login to booking');
            console.log('chưa login');
        } else {
            window.location.href = `confirm_booking.php?id=${roomId}`;
        }
    }
    // setActive();


    // let forgot_form = document.getElementById('forgot_form');

    // forgot_form.addEventListener('submit', function(e) {
    //     e.preventDefault();
    //     let data = new FormData();
    //     data.append('forgot_pass', '');
    //     data.append('email', forgot_form.elements['email'].value);



    //     var Model = document.getElementById('forgotModal');
    //     var modal = bootstrap.Modal.getInstance(Model);
    //     modal.hide();

    //     let xhr = new XMLHttpRequest();
    //     xhr.open('POST', "ajax/login_regester.php", true);

    //     xhr.onload = function() {
    //         if (this.responseText == 'inv_email') {
    //             alert('error', 'Invalid Email !');
    //         } else {
    //             alert('success', 'Reset link sent to email!');
    //             forgot_form.reset();
    //         }
    //     }

    //     xhr.send(data);
    // });

    //setActive();
</script>