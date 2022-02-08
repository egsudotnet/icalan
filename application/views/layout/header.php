<!DOCTYPE html>
<html lang="en">

<!-- header -->
<head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Produk By egsudotnet">
    <meta name="author" content="egsudotnet">

    <!-- <title>Transaksi Penjualan</title> -->

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
        .d-none{
           display:none !important;
        }
        .w-100{
           width:100% !important;
        }

        .m-10{
            margin:10px !important;
        }

        .mt-10{
            margin-top:10px;
        }
        .mt-20{
            margin-top:20px;
        }
        .mt-30{
            margin-top:30px;
        }
        .mt-40{
            margin-top:40px;
        }

        
        .mb-10{
            margin-bottom:10px;
        }
        .mb-20{
            margin-bottom:20px;
        }
        .mb-30{
            margin-bottom:30px;
        }
        .mb-40{
            margin-bottom:40px;
        }

        .mr-10{
            margin-right:10px;
        }
        .mr-20{
            margin-right:20px;
        }
        .mr-30{
            margin-right:30px;
        }
        .mr-40{
            margin-right:40px;
        }
        .ml-10{
            margin-left:10px;
        }
        .ml-20{
            margin-left:20px;
        }
        .ml-30{
            margin-left:30px;
        }
        .ml-40{
            margin-left:40px;
        }

        table.filter td{
            padding-right:8px !important; 
        }
    </style>
    
    <style>
            #loading {
                background-color: transparent !important;
                border: none;
                box-shadow: none;
                clear: both;
            }

            .spinner {
                background: transparent url('<?php echo base_url('/assets/img/Spinner-0.gif'); ?>') 0 0 no-repeat;
                text-align: center;
                position: absolute;
                top: 40%;
                left: 45%;
                width: 127px;
                height: 127px;
                opacity:50%
            }
            .div-notif { 
                text-align: center;
                position: absolute;
                top: 45%;
                left: 45%;
                width: 127px;
                height: 127px; 
                color:black !important
            }

            .modal-backdrop {
                position: fixed;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                z-index: 1040;
                background-color: white !important;
            }
/* 
            #loader {
                position: fixed;
                width: 100%;
                height: 100vh;
                z-index: 1;
                overflow: visible;
                background: #fff url('<?php echo base_url('/assets/img/lab.gif'); ?>') no-repeat center center;
            } */

        
            .panel-loading {
                background: transparent url('<?php echo base_url('assets/img/Spinner-1.gif') ?>') center center no-repeat;
                min-height:50px !important;
            }
        </style>

    <title><?php echo $title ?></title>
</head>

<body>

    <!-- Navigation -->
   <?php 
        $this->load->view('layout/menu');
   ?>
<div class="container">
    <div class="alert-danger info-error text-center"> 
    </div>
    <div class="alert-warning info-warning text-center"> 
    </div>
    <div class="alert-success info-success text-center"> 
    </div> 

<div id="loading" class="modal active" role="dialog" aria-hidden="false" data-backdrop="static" data-keyboard="false">
	<div class="spinner"></div>
	<!-- <div class="div-notif">
		<span id="notif" class="label label-important">Data sedang diproses. Mohon tunggu..</span> 
	</div> -->
</div>

 