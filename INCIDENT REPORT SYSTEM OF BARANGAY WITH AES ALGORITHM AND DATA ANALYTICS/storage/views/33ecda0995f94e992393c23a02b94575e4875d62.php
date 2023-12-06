<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAGUIG - TANYAG</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/png" href="<?php echo e(asset('/img/taguiglogo.png')); ?>">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
       /* Overlay styles */
.overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(5px);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 999;
}

/* Pop-up styles */
.termsPopup {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    text-align: justify;
    animation: slideUp 0.5s ease-out;
    /* max-width: 400px; Adjust the max-width as needed */
    width: 500px;
    max-height: 80vh; /* Set the maximum height for the scroll */
    overflow-y: auto;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

/* Close button styles */
.closeButton {
    cursor: pointer;
    color: #555;
    font-size: 20px;
    position: absolute;
    top: 10px;
    right: 10px;
}

@keyframes slideUp {
    from {
        transform: translateY(100%);
    }

    to {
        transform: translateY(0);
    }
}

/* Additional styling for the content */
.termsPopup h2 {
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
}

.termsPopup p {
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 15px;
    color: #555;
}

.btn-agree {
    background-color: #ffc107;
    color: #333;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-agree:hover {
    background-color: #ffcd39;
}

        h1 {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-weight: bolder;
        }

        h2 {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        #matrixChartPurok1,
        #matrixChartPurok2,
        #matrixChartPurok3,
        #matrixChartPurok4,
        #matrixChartPurok5,
        #matrixChartDimson,
        #matrixChartPurok7,
        #matrixChartPurok8,
        #matrixChartPurok9,
        #matrixChartSta,
        #matrixChartCaldozo,
        #matrixChartPerpetual {
            width: 100% !important;
        }

        #map {
            height: 100vh;
            width: 100%;
        }

        .info {
            padding: 6px 8px;
            font: 14px/16px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .info h4 {
            margin: 0 0 5px;
            color: #777;
        }

        .legend {
            line-height: 18px;
            color: #555;
        }

        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }
    </style>

</head>

<body>
    <?php if(session()->has('success')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Query submitted successfully',
            footer: '<a href="/">Return to home</a>'
        })
    </script>
    <?php else: ?>
    <?php endif; ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="">
                <img src="<?php echo e(asset('/img/tanyaglogo.png')); ?>" width="40" height="40" alt="">
            </a>
            <a class="navbar-brand" href=""><span class="text-danger">TAN</span>YAG</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <?php if(Route::has('login')): ?>
                        <?php if(auth()->guard()->check()): ?>
                        <?php if(Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2): ?>
                        <a class="nav-link" href="<?php echo e(route('home')); ?>">Dashboard</a>
                        <?php endif; ?>

                        <?php else: ?>
                        <a class="nav-link" href="">Home</a>
                        <?php endif; ?>
                        <?php endif; ?>


                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#portfolio">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#team">Officials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('report')); ?>">Report</a>
                    </li>


                    <?php if(Route::has('login')): ?>
                    <?php if(auth()->guard()->check()): ?>
                    <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>

                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger ml-lg-3" href="<?php echo e(route('login')); ?>">Login</a>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>
                </ul>

            </div>
        </div>
    </nav>

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../img/street-2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <h5>Blotter Cases Repository</h5>
                    <p> Secure Cases Repository with Incident Reporting and Analytics Generation</p>

                </div>
            </div>
            <div class="carousel-item">
                <img src="../img/street-1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <h5>Incident Reporting</h5>
                    <p>Secure Cases Repository with Incident Reporting and Analytics Generation</p>

                </div>
            </div>
            <div class="carousel-item">
                <img src="../img/street-3.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <h5>Analytics</h5>
                    <p>Secure Cases Repository with Incident Reporting and Analytics Generation</p>

                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- services section -->
    <section id="services" class="services section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-2">
                        <h1>Services</h1>
                        <p class="lead">These various services are what this system offers.</p>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card text-white text-center bg-dark pb-2">
                        <div class="card-body">
                            <i class="bi bi-pen"></i>
                            <h2 class="card-title">Blotter</h2>
                            <p class=" fs-6">This is a record of daily events/cases occurring within the territory/jurisdiction of the barangay. It provides important information on reported or discovered violations of laws, rules, and ordinances as well as requests for barangay assistance on any issue calling for legal or additional action. This barangay blotter is a record of information that can be used as evidence or as a reference.</p>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card text-white text-center bg-dark pb-2 h-100">
                        <div class="card-body">
                            <i class="bi bi-bell"></i>
                            <h2 class="card-title">Notices</h2>
                            <p class="fs-6">Before an incident report case will be subjected to hearing process of determine agreement, notice records must first be created. </p>

                        </div>
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card text-white text-center bg-dark pb-2">
                        <div class="card-body">
                            <i class="bi bi-alarm"></i>
                            <h2 class="card-title">Hearings</h2>
                            <p class="fs-6">The goal of the hearing process to allow the complainant and respondent to find all possible ways to amicably settle their dispute. Dispute that is caused the respondent towards the complaint where its rights have been violated.</p>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card text-white text-center bg-dark pb-2">
                        <div class="card-body">
                            <i class="bi bi-inboxes"></i>
                            <h2 class="card-title">Incidents</h2>
                            <p class="fs-6">Incident reporting is a component of the katarungang pambarangay, or barangay justice system, which amicably resolves conflicts within the community to promote peace, justice, and harmonious relationships. </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio section -->
    <section id="portfolio" class="portfolio section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-2">
                        <h1>Features</h1>
                        <p class="lead">Analytics • Encryption • Audit Trail</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-12 col-lg-4 mb-3 mb-xxl-0">
                    <div class="card text-center bg-white pb-2 h-100">
                        <div class="card-body text-dark">
                            <div class="img-area mb-4">
                                <img src="../img/analysis.png" alt="" class="img-fluid mx-auto d-block" style="max-width: 250px;">
                            </div>
                            <h2 class="card-title">Analytics</h2>
                            <p class="lead">Refers to the procedure of gathering data from the system, processing it, and then analyzing it to identify patterns and make inferences about the data it collects.
                            </p>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-4 mb-3 mb-xxl-0">
                    <div class="card text-center bg-white pb-2 h-100">
                        <div class="card-body text-dark">
                            <div class="img-area mb-4">
                                <img src="../img/encryption.png" alt="" class="img-fluid mx-auto d-block" style="max-width: 250px;">
                            </div>
                            <h2 class="card-title">Encryption</h2>
                            <p class="lead">Data privacy can be protected in this way as it is saved on computers and transmitted over the internet. This can validate the data's origin and make sure that it hasn't changed since it was received, while also protecting its confidentiality.
                            </p>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-4 mb-3 mb-xxl-0">
                    <div class="card text-center bg-white pb-2 h-100">
                        <div class="card-body text-dark">
                            <div class="img-area mb-4">
                                <img src="../img/audit.png" alt="" class="img-fluid mx-auto d-block" style="max-width: 250px;">
                            </div>
                            <h2 class="card-title">Audit Trail</h2>
                            <p class="lead">Every transaction a user makes in this system will be recorded by the audit trail feature. This allows for easier monitoring and investigation of any fraudulent activity and has the ability to list the recorded trails.
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- about section -->
    <section id="about" class="about section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="about-img">
                        <img src="../img/map.png" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-12 ps-lg-5 ">
                    <div class="about-text">
                    <h1>About Barangay Tanyag, Taguig City District II</h1>
                        <h5 class="fw-bold">MISSION</h5>
                        <p class="lead">•Provide programs that empowered our people to rise up the better living;</p>
                        <p class="lead">•Promote a safe and united community;</p>
                        <p class="lead">•Protect, serve people with fairness and confidence to attain peace, unity and progress.</p>
                        <h5 class="fw-bold">VISION</h5>
                        <p class="lead">We envision Barangay Tanyag as CARING BARANGAY, with WELL-INFORMED, EMPOWERED and UNITED COMMUNITY, living PEACEFUL, SAFE and RESILIENT with Faster economic growth under a respectable transparent and firm leadership.</p>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- maps section -->
    <section id="maps" class="contact section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center">
                        <h1>Barangay Tanyag Areas</h1>
                        <p class="lead">Find different area in Barangay Tanyag, Taguig City.
                    </div>

                    <div class="card-group">
                        <div class="card">
                            <img class="card-img-top" src="../img/Purok 1.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title" style="font-weight: bold; text-align:center;">Purok 1</h5>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-img-top" src="../img/Purok 2.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title" style="font-weight: bold; text-align:center;">Purok 2</h5>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-img-top" src="../img/Purok 3.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title" style="font-weight: bold; text-align:center;">Purok 3
                                </h5>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-img-top" src="../img/Purok 4.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title" style="font-weight: bold; text-align:center;">Purok 4</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-group mt-3">
                        <div class="card">
                            <img class="card-img-top" src="../img/Purok 5.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title" style="font-weight: bold; text-align:center;">Purok 5</h5>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-img-top" src="../img/Dimson Comp.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title" style="font-weight: bold; text-align:center;">Dimson Compound</h5>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-img-top" src="../img/Purok 7.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title" style="font-weight: bold; text-align:center;">Purok 7
                                </h5>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-img-top" src="../img/Purok 8.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title" style="font-weight: bold; text-align:center;">Purok 8</h5>
                            </div>
                        </div>
                        <div class="card-group mt-2">
                        <div class="card">
                            <img class="card-img-top" src="../img/Purok 9.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title" style="font-weight: bold; text-align:center;">Purok 9</h5>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-img-top" src="../img/Sta Teresa.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title" style="font-weight: bold; text-align:center;">Sta Teresa</h5>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-img-top" src="../img/Caldozo Comp.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title" style="font-weight: bold; text-align:center;">Caldozo Compound
                                </h5>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-img-top" src="../img/Perpetual.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title" style="font-weight: bold; text-align:center;">Perpetual Village</h5>
                            </div>
                    </div>
                </div>

            </div>

            </div>
    </section>

    <!-- team section -->
    <section id="team" class="team seaction-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-3 fw-bold">
                        <h1>Barangay Tanyag Public Servants</h1>
                    </div>
                </div>
            </div>

            <!-- part 1 officials -->
            <div class="row mb-3">
                <div class="col mb-3 mb-xxl-0">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <img src="../img/captain.png" alt="" class="rounded-circle mx-auto d-block" width="150px">
                            <h3 class="card-title py-2 fs-4 mt-2">Cecillia "Cecille" Teodoro</h3>
                            <p class="card-text fw-bold">Barangay Chairperson (Captain)</p>
                        </div>
                    </div>
                </div>

                <div class="col mb-3 mb-xxl-0">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <img src="../img/1kag.png" alt="" class="rounded-circle mx-auto d-block" width="150px">
                            <h3 class="card-title py-2 fs-4 mt-2">Pedro M. Garcia</h3>
                            <p class="card-text fw-bold">Kagawad (Councilor)</p>

                        </div>
                    </div>
                </div>

                <div class="col mb-3 mb-xxl-0">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <img src="../img/2kag.png" alt="" class="rounded-circle mx-auto d-block" width="150px">
                            <h3 class="card-title py-2 fs-4 mt-2">Evelyn C. Fontanilla</h3>
                            <p class="card-text fw-bold">Kagawad (Councilor)</p>

                        </div>
                    </div>
                </div>

                <div class="col mb-3 mb-xxl-0">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <img src="../img/3kag.png" alt="" class="rounded-circle mx-auto d-block" width="150px">
                            <h3 class="card-title py-2 fs-4 mt-2">Menardo D. Quizon</h3>
                            <p class="card-text fw-bold">Kagawad (Councilor)</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">

                <div class="col mb-3 mb-xxl-0">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <img src="../img/4kag.png" alt="" class="rounded-circle mx-auto d-block" width="150px">
                            <h3 class="card-title py-2 fs-4 mt-2">Ma. Isabel L. Pabualan</h3>
                            <p class="card-text fw-bold">Kagawad (Councilor)</p>

                        </div>
                    </div>
                </div>


                <div class="col mb-3 mb-xxl-0">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <img src="../img/5kag.png" alt="" class="rounded-circle mx-auto d-block" width="150px">
                            <h3 class="card-title py-2 fs-4 mt-2">Anabelle P. De Guzman</h3>
                            <p class="card-text fw-bold">Kagawad (Councilor)</p>

                        </div>
                    </div>
                </div>

                <div class="col mb-3 mb-xxl-0">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <img src="../img/6kag.png" alt="" class="rounded-circle mx-auto d-block" width="150px">
                            <h3 class="card-title py-2 fs-4 mt-2">Sebastian D. Balacanao</h3>
                            <p class="card-text fw-bold">Kagawad (Councilor)</p>

                        </div>
                    </div>
                </div>

                <div class="col mb-3 mb-xxl-0">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <img src="../img/7kag.png" alt="" class="rounded-circle mx-auto d-block" width="150px">
                            <h3 class="card-title py-2 fs-4 mt-2">Desiree Jane D. Katigbak</h3>
                            <p class="card-text fw-bold">Kagawad (Councilor)</p>

                        </div>
                    </div>
                </div>


            </div>
            <!-- part 2 officials-->
            <div class="row justify-content-center">

                <div class="col col-lg-3">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <img src="../img/sec.png" alt="" class="rounded-circle mx-auto d-block" width="150px">
                            <h3 class="card-title py-2 fs-4 mt-2">Fedis B. Giray</h3>
                            <p class="card-text fw-bold">Barangay Secretary</p>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-3">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <img src="../img/tres.png" alt="" class="rounded-circle mx-auto d-block" width="150px">
                            <h3 class="card-title py-2 fs-4 mt-2">Debbie M. Suarez</h3>
                            <p class="card-text fw-bold">Barangay Treasurer</p>
                        </div>
                    </div>
                </div>

                <div class="col col-lg-3">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <img src="../img/skchair.png" alt="" class="rounded-circle mx-auto d-block" width="150px">
                            <h3 class="card-title py-2 fs-4 mt-2">Jean Marie R. De Guzman</h3>
                            <p class="card-text fw-bold">SK Chairperson</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQs section -->
        <section id="faqs" class="services section-padding">
            <div class="container">
            <div class="row mb-3">
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card text-dark text-center pb-2" style="background-color: #FFC107;">
                        <div class="card-body">
                            <i class="bi bi-question-circle-fill"></i>
                            <h2 class="card-title">Frequently Asked Questions (FAQs)</h2>
                            <hr>
                            <p class=" fs-6">How can we help you? Below you'll find answers to the questions we get
                                asked most about the Barangay.</p>
                            <div class="about-img">
                                <img src="../img/brgyhall.jpg" alt="" class="img-fluid">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card text-dark text-center pb-2 h-100" style="background-color: #141413;">
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingEight">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">
                                            What is TANYAG Portal?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseEight" class="accordion-collapse collapse" aria-labelledby="flush-headingEight" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body text-dark" style="text-align: justify;">TANYAG
                                            website is a portal where you can see information about Barangay Tanyag. You
                                            can submit your concerns using the forms provided. Moreover, you can file an
                                            incident report that was held at the barangay’s jurisdiction.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            How many residents are there in Barangay Tanyag?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body text-dark" style="text-align: justify;">As of
                                            November 2023, there are 23,719 residents
                                            residing in different areas of the Barangay.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                            How can we submit an Incident Report?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body text-dark" style="text-align: justify;">To submit
                                            an Incident Report, click the REPORT
                                            button at the upper right corner of your screen then click NEW INCIDENT
                                            REPORT. Fill out the necessary details of the incident.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                            Can I file a blotter report on your website?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body text-dark" style="text-align: justify;">No, filing
                                            a blotter report requires the actual presence of complainant to the
                                            Barangay. You are advised to physically file the blotter report and you will
                                            be assisted by the staff/s.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                            What is the schedule of Barangay’s office?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body text-dark" style="text-align: justify;">The
                                            Barangay is open Mondays to Fridays from 8:00 AM to 5:00 PM. </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingFive">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                            Can I request documents using the contact us form?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body text-dark" style="text-align: justify;">The
                                            Unfortunately, no, since requesting of documents require your presence in
                                            the Barangay. You are required to fill in the necessary request forms.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingSix">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                            How can I contact the Barangay?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body text-dark" style="text-align: justify;">The
                                            You can send your concern using the Contact Us form provided here on the
                                            website. Click the CONTACT button and send your query.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingSeven">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                                            What are the events of the Barangay and how can I receive announcements?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body text-dark" style="text-align: justify;">
                                            The Barangay are currently focusing on outreach programs. Other activities
                                            are posted on the barangay board. To get updated, visit this website and you
                                            can see upcoming events and programs.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingNine">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseNine" aria-expanded="false" aria-controls="flush-collapseNine">
                                            Where can I submit suggestions regarding the site?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseNine" class="accordion-collapse collapse" aria-labelledby="flush-headingNine" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body text-dark" style="text-align: justify;">The
                                            Suggestions and comments can be submitted to the contact us section.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- contact section -->
    <section id="contact" class="contact section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center">
                    <div class="col mb-3 mb-xxl-0">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <img src="../img/emergency.png" alt="" class="mx-auto d-block" width="300px">  
                    <h2>HOTLINES NUMBERS</h2>
                        <h5><b> PNP STATION 8 </b></h5>
                        <p> 09693449030 </p>
                        <h5><b> PNP WOMENS & CHILDREN </b></h5>
                        <p> #398-6682 </p>
                        <h5><b> TAGUIG FIRE STATION </b></h5>
                        <p> #837-0740 </p>
                        <h5><b> BARANGAY TANYAG AMBULANCE </b></h5>
                        <p> 8371-73-43 </p>
                        <h5><b> MERALCO </b></h5>
                        <p> #16211 </p>
                        
                        </div>
                        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center">
                        <h1>Your voice matters</h1>
                        <p class="lead">You may reach us if you have any concern regarding the barangay services. Rest assured that your concerns will be receive.
                    </div>
                </div>
            </div>

            <div class="row m-0">
                <div class="col-md-12 p-0 pt-4 pb-4">
                    <form action="<?php echo e(url('contactForm')); ?>" class="bg-light p-4 m-auto" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="name" id="name" required placeholder="Your Full Name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="tel" class="form-control" name="phone" id="phone" required placeholder="Phone">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="email" class="form-control" name="email" id="email" required placeholder="Your Email Here">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <textarea rows="3" required class="form-control" name="message" id="message" placeholder="Your Query Here"></textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning btn-lg btn-block mt-3">Send Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <footer class="bg-dark p-2 text-center">
        <div class="container">
            <p class="text-white pt-2"><i class="bi bi-c-circle"></i> All Rights Reserved TANYAG 2023</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <div class="overlay" id="overlay">
    <div class="termsPopup">
        <span class="closeButton" onclick="closePopup()">&times;</span>
        <h2 class="mt-3">TERMS AND CONDITIONS</h2>
        <div class="mb-3">
            <p>Accuracy of Information: Users agree to provide accurate and truthful information in incident reports.</p>

            <p>Privacy: Users commit to respecting the privacy of individuals involved in incidents and not disclosing personal information without consent.</p>

            <p>User Responsibility: Users are responsible for maintaining the confidentiality of their account credentials and reporting unauthorized use promptly.</p>

            <p>Prohibited Activities: Users must not engage in unlawful or malicious activities on the website.<p>

            <p>Content Moderation: The Barangay reserves the right to moderate, edit, or remove any content violating these terms.</p>

            <p>Privacy Policy: Users' personal information will be handled in accordance with our Privacy Policy.</p>

            <p>Limitation of Liability: The Barangay is not liable for any damages resulting from the use of the website.</p>

            <p>Changes to Terms: The Barangay may update these terms without prior notice; users are encouraged to review them regularly.</p>

            <p>By using the system, you agree to these terms and conditions.</p>
            <button class="btn btn-agree" onclick="agreeAndClosePopup()">I Agree</button>
    
        </div>
    </div>

    <?php if(session()->has('success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Query submitted successfully',
                footer: '<a href="/">Return to home</a>'
            })
        </script>
    <?php endif; ?>

    <!-- JavaScript to show the pop-up only if not agreed during this session -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (!sessionStorage.getItem("agreedToTerms")) {
                showPopup();
            }
        });

        // Function to show the pop-up
        function showPopup() {
            document.querySelector(".overlay").style.display = "flex";
        }

        // Function to close the pop-up
        function closePopup() {
            document.querySelector(".overlay").style.display = "none";
        }

        // Function to handle agreement and close the pop-up
        function agreeAndClosePopup() {
            sessionStorage.setItem("agreedToTerms", "true");
            closePopup();
        }
        
    </script>
</body>

</html><?php /**PATH C:\Users\eplum\Desktop\BRGY TANYAG\resources\views/user/home.blade.php ENDPATH**/ ?>