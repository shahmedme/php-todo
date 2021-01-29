<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'todo');

$results = mysqli_query($db, "SELECT * FROM todo");

if (isset($_POST['save'])) {
    $title = $_POST['title'];

    mysqli_query($db, "INSERT INTO todo (title) VALUES ('$title')");
    header('location: index.php');
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];

    mysqli_query($db, "UPDATE todo SET title='$title' WHERE id=$id");
    header('location: index.php');
}

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($db, "DELETE FROM todo WHERE id=$id");
    header('location: index.php');
}
