<!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- ==== Document Title ==== -->
    <title>Claims Mitra</title>
    <!-- ==== Document Meta ==== -->
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- ==== Favicon ==== -->
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/favicon/favicon.ico" type="image/png">
    <!-- ==== Google Font ==== -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CMontserrat:400,500">
    <!-- Stylesheets -->
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/toast.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/morris.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-jvectormap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/horizontal-timeline.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/weather-icons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dropzone.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ion.rangeSlider.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ion.rangeSlider.skinFlat.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datatables/DataTables-1.13.4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
    <link href='<?php echo base_url(); ?>assets/css/fullcalendar.min.css' rel='stylesheet' />
    <link href='<?php echo base_url(); ?>assets/fullcalendar/css/fullcalendar.print.css' rel='stylesheet' media='print' />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/nandini/style.css"> -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/sweetalert.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/sweetalert-overrides.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/steps.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-multiselect.css" type="text/css">
    

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/summernote-bs4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/summernote-bs4-overrides.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/favcontact.css">
    <!-- C:\xampp\htdocs\claimsmitra\ -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets\css\viewcasedetail.css">

    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/summernote-bs4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/summernote-bs4-overrides.css">
  

    <script src='<?php echo base_url(); ?>assets/fullcalendar/js/fullcalendar.js' type="text/javascript"></script>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/lightgallery.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.12/css/lightgallery.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.3/tagify.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

    <!-- Time Picker -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    
    <!-- Selection with search -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">


    <style>
        #wrap {
            width: 1100px;
            margin: 0 auto;
        }

        #external-events {
            float: left;
            width: 150px;
            padding: 0 10px;
            text-align: left;
        }

        #external-events h4 {
            font-size: 16px;
            margin-top: 0;
            padding-top: 1em;
        }

        .external-event {
            /* try to mimick the look of a real event */
            margin: 10px 0;
            padding: 2px 4px;
            background: #3366CC;
            color: #fff;
            font-size: .85em;
            cursor: pointer;
        }

        #external-events p {
            margin: 1.5em 0;
            font-size: 11px;
            color: #666;
        }

        #external-events p input {
            margin: 0;
            vertical-align: middle;
        }

        #calendar {
            /*      float: right; */
            margin: 0 auto;
            width: 900px;
            background-color: #FFFFFF;
            border-radius: 6px;
            box-shadow: 0 1px 2px #C3C3C3;
        }
    </style>
</head>

<body>