<!DOCTYPE html>
<html lang="en">

<!-- header -->
<head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Produk By egsudotnet">
    <meta name="author" content="egsudotnet">

    <title>Transaksi Penjualan</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url().'assets/css/bootstrap.min.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/style.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/font-awesome.css'?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url().'assets/css/4-col-portfolio.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/dataTables.bootstrap.min.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/jquery.dataTables.min.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/dist/css/bootstrap-select.css'?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap-datetimepicker.min.css'?>">
    <link href="<?php echo base_url().'assets/css/select2.css'?>" rel="stylesheet">

    <style>
        th{
            text-align:center !important;
        }
        
    </style>
</head>

<body>

    <!-- Navigation -->
   <?php 
        $this->load->view('admin_v2/menu');
   ?>
<div class="container">
    <div align="center" style="margin-top:0px;color:white;background-color:red" id="info-error"></div>
    <div align="center" style="margin-top:0px;color:black;background-color:yellow" id="info-warning"></div>
    <div align="center" style="margin-top:0px;color:white;background-color:green" id="info-success"></div>
<div>
 