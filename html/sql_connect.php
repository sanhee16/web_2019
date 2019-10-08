<?php
    $conn = mysqli_connect(
      'localhost',
      'sinhioa20',
      'mysql0322*',
      'sinhioa20'
    );
    mysqli_query($conn,"set session character_set_connection=utf8");
    mysqli_query($conn,"set session character_set_results=utf8;");
    mysqli_query($conn,"set session character_set_client=utf8;");
?>
