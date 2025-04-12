<?php
// Koneksi Database
$con = mysqli_connect("localhost", "root", "S098765l", "book_store");

// membuat fungsi query dalam bentuk array
function query($query)
{
    // Koneksi database
    global $con;

    $result = mysqli_query($con, $query);

    // membuat varibale array
    $rows = [];

    // mengambil semua data dalam bentuk array
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function query2($query)
{
    global $con;
    $result = mysqli_query($con, $query);
    
    // Tambahkan pengecekan error
    if (!$result) {
        die("Query Error: " . mysqli_error($con));
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}





function delete($delete) {
    global $con;
    $result = mysqli_query($con, $delete);

    return mysqli_affected_rows($con);
}

function seleksi_id($seleksi_id) {
    global $con;

    mysqli_query($con, $seleksi_id);

    return mysqli_affected_rows($con);
}