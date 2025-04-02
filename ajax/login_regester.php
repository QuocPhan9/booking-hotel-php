<?php
require('../admin/database/db_config.php');
require('../admin/shares/essentials.php');

if (isset($_POST['register'])) {
    $data = filteration($_POST);

    if ($data['pass'] != $data['cpass']) {
        echo 'pass_mismatch';
        exit;
    }

    $u_exists = select("SELECT * FROM `user_cred` WHERE `email` = ? OR `phonenum` = ? LIMIT 1", [$data['email'], $data['phonenum']], "ss");

    if (mysqli_num_rows($u_exists) != 0) {
        $u_exists_fetch = mysqli_fetch_assoc($u_exists);
        echo ($u_exists_fetch['email'] == $data['email']) ? 'email_exists' : 'phonenum_already';
        exit;
    }
    $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);
    $token = bin2hex(random_bytes(16));
    $query = "INSERT INTO `user_cred`(`name`, `email`, `address`, `phonenum`, `dob`, `password`, `token`) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $values = [$data['name'], $data['email'], $data['address'], $data['phonenum'], $data['dob'], $enc_pass, $token];

    if (insert($query, $values, "sssssss")) {
        echo 1;
    } else {
        echo 'ins_failed';
    }
}



if (isset($_POST['login'])) {
    $data = filteration($_POST);
    session_start();
    $u_exist = select("SELECT * FROM `user_cred` WHERE `email` =?  LIMIT 1",
    $data['email_mob'], "s");

    if(mysqli_num_rows($u_exist)==0){
        echo 'inv_email_mob';
    }
    else{
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if(!password_verify($data['pass'],$u_fetch['password'])){
            echo 'inv_pass';
        }
        else{
            $_SESSION['login']=true;
            $_SESSION['name']=$u_fetch['name'];
            echo 1;
        }
    }
}

if (isset($_POST['forgot_pass'])) {
    $data = filteration($_POST);
    $u_exists = select("SELECT * FROM `user_cred` WHERE `email` = ? LIMIT 1", [$data['email']], "s");
    if (mysqli_num_rows($u_exists) == 0) {
        echo 'inv_email';
    } else {
        $u_fetch = mysqli_fetch_assoc($u_exists);
        if ($u_fetch['is_verified'] == 0) {
            echo 'not_verified';
        } else if ($u_fetch['status'] == 0) {
            echo 'inactive';
        } else {
            //send reset link to email
            $token = bin2hex(random_bytes(16)); // Generate a random token
        }
    }
}

if (isset($_POST['recovery_user'])) {
    $data = filteration($_POST);

    $enc_pass = password_hash($data['new_pass'], PASSWORD_BCRYPT); // Hash the new password

    $query = "UPDATE `user_cred` SET `password`=?, `token` =?, `t_expire`=? WHERE `email`=? AND `token`=?";

    $values = [$enc_pass, null, null, $data['email'], $data['token']];

    if (update($query, $values, 'sssss')) {
        echo 1;
    } else {
        echo 'failed';
    }
}
