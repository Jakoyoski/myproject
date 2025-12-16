<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title ?? 'My Website') ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= base_url('scss/main.css') ?>">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url()?>favicon-32x32.png">
 <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url()?>favicon-16x16.png">
 <link rel="manifest" href="<?=base_url()?>site.webmanifest">
  <style>
        .dropdown-menu {
            width: 800px;
        }
        /* Custom styles */
        .hero {
            background-color: #f0f8ff; /* Light Blue background */
            padding: 100px 0;
            text-align: center;
        }
        .section-padding {
            padding: 80px 0;
        }
        .footer {
            background-color: #343a40; /* Dark background */
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
  <header>
    <h1>Melvin Jones Lions Academy</h1>
  </header>

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top sticky-top py-2">
        <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo base_url();?>"> <img src="<?php echo base_url();?>images/melvin.png" alt="Melvin Jones Lions Academy Logo" width="70" height="64" class="d-inline-block align-top"/></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= base_url('/') ?>">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('contact') ?>">Contact</a>
                    </li>
                    <!-- Mega Menu Button -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="megaMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            School Services
                        </a>
                        <div class="dropdown-menu p-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Academics</h6>
                                    <ul class="list-unstyled">
                                        <li><a class="dropdown-item" href="<?= base_url('courses') ?>">Courses</a></li>
                                        <li><a class="dropdown-item" href="<?= base_url('timetable') ?>">Timetable</a></li>
                                        <li><a class="dropdown-item" href="<?= base_url('results') ?>">Results</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6>Student Services</h6>
                                    <ul class="list-unstyled">
                                        <li><a class="dropdown-item" href="<?= base_url('registration') ?>">Registration</a></li>
                                        <li><a class="dropdown-item" href="<?= base_url('fees') ?>">Fees Payment</a></li>
                                        <li><a class="dropdown-item" href="<?= base_url('hostel') ?>">Hostel Management</a></li>
                                    </ul>
                                </div>
                        
                            </div>
                        </div>
                    </li>
                </ul>
                <a class="navbar-brand" href="#"><img src="<?php echo base_url();?>images/lionsclub.png" alt="Lions Club of Nakuru Logo" width="70" height="64" class="d-inline-block align-top"> </a>
            </div>
        </div>
    </nav>

   