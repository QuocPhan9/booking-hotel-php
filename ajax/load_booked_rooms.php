<?php
$file_path = __DIR__ . '/../admin/database/db_config.php';
if (!file_exists($file_path)) {
    die("Error: Database configuration file not found!");
}
require_once $file_path;

$file_path1 = __DIR__ . '/../admin/shares/essentials.php';

require_once $file_path1;

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 6;
$offset = ($page - 1) * $limit;

$sql = "
    SELECT b.id, b.order_id, b.amount, b.order_info, b.transaction_no, b.bank_code, b.pay_date, b.status,
           b.customer_name, b.customer_email, b.customer_phone, b.note, b.room_id, b.check_in, b.check_out, b.created_at,
           r.name AS room_name, r.price, r.adult, r.children
    FROM booking b
    INNER JOIN rooms r ON b.room_id = r.id
    WHERE b.status = 'success' 
    LIMIT ? OFFSET ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$res = $stmt->get_result();

$rooms = [];

if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {

        // Fetch room features
        $features_data = "";
        $fea_stmt = $conn->prepare("SELECT f.name FROM features f 
                                    INNER JOIN room_features rf ON f.id = rf.features_id 
                                    WHERE rf.room_id = ?");
        $fea_stmt->bind_param("i", $row['room_id']);
        $fea_stmt->execute();
        $fea_q = $fea_stmt->get_result();

        while ($fea_row = mysqli_fetch_assoc($fea_q)) {
            $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap'>{$fea_row['name']}</span>";
        }

        // Fetch room facilities
        $facilities_data = "";
        $fac_stmt = $conn->prepare("SELECT f.name FROM facilities f 
                                    INNER JOIN room_facilities rf ON f.id = rf.facilities_id 
                                    WHERE rf.room_id = ?");
        $fac_stmt->bind_param("i", $row['room_id']);
        $fac_stmt->execute();
        $fac_q = $fac_stmt->get_result();

        while ($fac_row = mysqli_fetch_assoc($fac_q)) {
            $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap'>{$fac_row['name']}</span>";
        }

        // Fetch room thumbnail
        if (!defined('ROOMS_IMG_PATH')) {
            define('ROOMS_IMG_PATH', 'your/path/to/images/');
        }

        $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
        $thumb_stmt = $conn->prepare("SELECT image FROM room_images WHERE room_id = ? AND thumb = '1'");
        $thumb_stmt->bind_param("i", $row['room_id']);
        $thumb_stmt->execute();
        $thumb_q = $thumb_stmt->get_result();

        if (mysqli_num_rows($thumb_q) > 0) {
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
        }

        // Push room data to rooms array
        $rooms[] = [
            'booking_id' => $row['id'],
            'room_id' => $row['room_id'],
            'room_name' => $row['room_name'],
            'price' => $row['price'],
            'features' => $features_data,
            'facilities' => $facilities_data,
            'adult' => $row['adult'],
            'children' => $row['children'],
            'room_thumb' => $room_thumb
        ];
    }

    // Return the rooms data as JSON
    echo json_encode([
        'success' => true,
        'rooms' => $rooms
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Error retrieving booking data'
    ]);
}
?>