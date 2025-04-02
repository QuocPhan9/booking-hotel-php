<?php 
    require('../database/db_config.php');
    require('../shares/essentials.php');
    adminLogin();

    if(isset($_POST['get_users'])) {
        $res = selectAll("user_cred");

        $i = 0;
        $data = "";
        

        while($row = mysqli_fetch_assoc($res)) {
            $data.="
              <tr class='align-middle'>
                <td>$i</td>
                <td>$row[name]</td>
                <td>$row[email]</td>
                <td>$row[phonenum]</td>
                <td>$row[address]</td>
                <td>$row[dob]</td>
                <td>
                    <button type='button' onclick='remove_user($row[id])' class='btn btn-danger shadow-none btn-sm'>
                        <i class='bi bi-trash'></i>
                    </button>
                </td>
              </tr>
            ";
            $i++;
        }   
        echo $data;
    }

    if (isset($_POST['remove_user'])) {
        $frm_data = filteration($_POST);
        
        $res = delete("DELETE FROM `user_cred` WHERE `id` = ?",[$frm_data['user_id'],0],'i');

        if($res){
            echo 1;
        }else{
            echo 0;
        }

    }
?>