<?php
session_start();

$db = @new mysqli("localhost", "root", "","motodb");
$db->set_charset("utf8");

if($db->connect_errno !=0){
    echo "Error ".$db->connect_errno;
}
else {
    $pojazd = $_POST['model2'];
    $post_rating = $_POST['oceny'];

    $find_data = "select * from rates WHERE model2='$pojazd'";
    $result = @$db->query($find_data);
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $current_rating = $row['oceny'];
        $current_hits = $row['hits'];
        $suma = $row['suma'];

    }
    $new_hits = $current_hits + 1;
    $update_hits = "UPDATE rates SET hits = '$new_hits' where id='$id'";
    if ($db->query($update_hits)) {
        echo "jest git";

    } else {
        echo "jest chujnia";
    }

    $new_suma = $suma + $post_rating;

    $update_suma = "UPDATE rates SET suma = '$new_suma' where id = '$id'";
    if ($db->query($update_suma)) {
        echo "jest git";

    } else {
        echo "jest słabo";
    }
    $new_rating = $new_suma / $new_hits;

    $update_rating = "UPDATE rates SET oceny = '$new_rating' WHERE id='$id'";
    if ($db->query($update_rating)) {
        echo "jest git";

    } else {
        echo "jest chujnia";
    }

    header("location: turystyczny.php");
}
?>