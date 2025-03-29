<?php 
    $hname = 'localhost';
    $uname = 'root';
    $pass = '';
    $db = 'db_booking';

    $conn = mysqli_connect($hname, $uname, $pass, $db);


    if(!$conn){
        die("Connection Failed".mysqli_connect_error());
    }

    function filteration($data) {
        foreach($data as $key => $value) {
            $data[$key] = trim($value);
            $data[$key] = htmlspecialchars($value);
        }

        return $data;
    }

    function select($sql, $values, $datatypes) 
    {
        $conn = $GLOBALS['conn'];
        if($stmt = mysqli_prepare($conn, $sql))
        {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if(mysqli_stmt_execute($stmt))
            {
                $res = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }
            else
            {
                mysqli_stmt_close($stmt);
                die ("Query cannot be executed - Select");
            }
        }
        else
        {
            die ("Query cannot be prepared - Select");
        }
    }

    function update($sql, $values, $datatypes)
    {
        $conn = $GLOBALS['conn'];
        if($stmt = mysqli_prepare($conn, $sql))
        {
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if(mysqli_stmt_execute($stmt))
            {
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }
            else
            {
                mysqli_stmt_close($stmt);
                die ("Query cannot be executed - Update");
            }
        }
        else
        {
            die ("Query cannot be prepared - Update");
        }
    }
?>  