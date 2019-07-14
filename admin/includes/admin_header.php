
<?php ob_start(); ?>
<?php session_start(); ?>
<?php include '../includes/dbcon.php';?>
<?php include 'functions.php'; ?>
 
<?php 

    if(!isset($_SESSION['userrole'])){
            header("Location:../index.php");
    }
    //it will be used for to block users after logout.
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="/cms/admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/cms/admin/css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->

    <link href="/cms/admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- FAFA 5 VERSION -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- Respond.js doesn't work if we view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    <link href="/cms/admin/css/styles.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>

</head>
<body>
  <!-- <div id='load-screen'>
    <div id='loading'></div>
  </div> -->