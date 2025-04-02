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
    $u_exist = select("SELECT * FROM `user_cred` WHERE `email` = ?  LIMIT 1",
    [$data['email_mob']], "s");

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
            $_SESSION["uId"] = $u_fetch['id'];
            $_SESSION['name']=$u_fetch['name'];
            $_SESSION['email']=$u_fetch['email'];
            $_SESSION['address']=$u_fetch['address'];
            $_SESSION['phonenum']=$u_fetch['phonenum'];
            $_SESSION['dob']=$u_fetch['dob'];
            echo 1;
        }
    }
}

if (isset($_POST['forgot_pass'])) {
    $data = filteration($_POST);
    $u_exists = select("SELECT * FROM `user_cred` WHERE `email` = ? LIMIT 1", [$data['email']], "s");
    if (mysqli_num_rows($u_exists) == 0) {
        echo 'inv_email';
    }
    else
    {
        echo 1;
    }
}

if (isset($_POST['recovery_user'])) {
    $data = filteration($_POST);

    if ($data['new_pass'] != $data['cpass']) {
        echo 'pass_mismatch';
        exit;
    }

    $enc_pass = password_hash($data['new_pass'], PASSWORD_BCRYPT); // Hash the new password

    $query = "UPDATE `user_cred` SET `password`=?  WHERE `email`=? ";

    $values = [$enc_pass, $data['email']];

    if (update($query, $values, 'ss')) {
        echo 1;
    } else {
        echo 'failed';
    }
}
