
<div
    class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn"
    data-wow-delay="0.1s">
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
                <p class="mb-2"><i
                        class="fa fa-phone-alt me-3"></i>+<?php echo $contact_r['phone'] ?></p>
                <p class="mb-2"><i
                        class="fa fa-envelope me-3"></i><?php echo $contact_r['email'] ?></p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social"
                        href="#"><i
                            class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social"
                        href="#"><i
                            class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social"
                        href="#"><i
                            class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-light btn-social"
                        href="#"><i
                            class="fab fa-linkedin-in"></i></a>
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
    function setActive() {
        let navbar = document.getElementById('nav-bar');
        let a_tags = navbar.getElementsByTagName('a');

        for(i=0; i<a_tags.length;i++){
            let file = a_tags[i].href.split('/').pop();
            let file_name = file.split('.')[0];

            if(document.location.href.indexOf(file_name) >= 0){
                a_tags[i].classList.add('active');
            }
        }
    }

    setActive();
</script>