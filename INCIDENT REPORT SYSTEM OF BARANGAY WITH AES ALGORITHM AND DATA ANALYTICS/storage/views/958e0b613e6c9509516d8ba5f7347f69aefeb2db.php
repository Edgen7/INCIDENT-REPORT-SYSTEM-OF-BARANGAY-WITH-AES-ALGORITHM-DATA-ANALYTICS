<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Incident | TANYAG</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/png" href="<?php echo e(asset('/img/taguiglogo.png')); ?>">
    <link href="../css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js" integrity="sha512-Tfw6etYMUhL4RTki37niav99C6OHwMDB2iBT5S5piyHO+ltK2YX8Hjy9TXxhE1Gm/TmAV0uaykSpnHKFIAif/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

    <style>
        h1 {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-weight: bolder;
        }

        h2 {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        #barChartPurok1,
        #barChartPurok2,
        #barChartPurok3,
        #barChartPurok4,
        #barChartPurok5,
        #barChartDimson,
        #barChartPurok7,
        #barChartPurok8,
        #barChartPurok9,
        #barChartSta,
        #barChartCaldozo,
        #barChartPerpetual {
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="<?php echo e(asset('/img/tanyaglogo.png')); ?>" width="40" height="40" alt="">
            </a>
            <a class="navbar-brand" href="/"><span class="text-danger">TAN</span>YAG</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Go back to Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo e(route('report')); ?>">Report</a>
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


    <div class="d-flex " id="wrapper">

        <!-- Page content wrapper-->
        <div id="page-content-wrapper">

            <!-- Page content-->
            <div class="container-fluid" style="margin: top 150px;">

                <div class="row d-flex justify-content-center mt-4">
                    <div class="col-3 mt-5">

                        <img src="<?php echo e(asset('/img/taguiglogo.png')); ?>" class="img-fluid rounded mx-auto d-block mt-5" alt="..." width="300" height="300">

                        <div class="text-center mt-5">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="bi bi-plus-square-fill"></i> New Incident Report
                            </button>
                        </div>


                        <?php if(session()->has('success')): ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Incident Report submitted successfully',
                                footer: '<a href="/">Return to home</a>'
                            })
                        </script>
                        <?php else: ?>
                        <?php endif; ?>


                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Create an Incident Report</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">


                                        <!-- card -->
                                        <div class="card p-3">
                                            <h2 class="mt-3">Incident Report</h2>
                                            <p class="card-text mb-3">Please fill out all the fields below and click on
                                                the "Submit" button to save the Incident Report to the database.</p>
                                            <hr>

                                            <!-- form -->
                                            <form method="POST" enctype="multipart/form-data" id="form" action="<?php echo e(route('report.store')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <div class="mb-3" id="textboxDiv">

                                                    <div class="mb-3">
                                                        <label for="type" class="form-label">Description of Incident</label>
                                                        <select class="form-select shadow-none  <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="type" id="type" required>
                                                            <option selected disabled value="">-</option>
                                                            <option value="disorderly conduct" <?php echo e(old('type') == "cursing" ? 'selected' : ''); ?>>cursing</option>
                                                            <option value="disorderly conduct" <?php echo e(old('type') == "wolf-whistling" ? 'selected' : ''); ?>>wolf-whistling</option>
                                                            <option value="disorderly conduct" <?php echo e(old('type') == "catcalling" ? 'selected' : ''); ?>>catcalling</option>
                                                            <option value="disorderly conduct" <?php echo e(old('type') == "leering and intrusive gazing" ? 'selected' : ''); ?>>leering and intrusive gazing</option>
                                                            <option value="disorderly conduct" <?php echo e(old('type') == "taunting" ? 'selected' : ''); ?>>taunting</option>
                                                            <option value="disorderly conduct" <?php echo e(old('type') == "disorderly conduct" ? 'selected' : ''); ?>>disorderly conduct</option>
                                                            <option value="public scandal" <?php echo e(old('type') == "public scandal" ? 'selected' : ''); ?>>public scandal</option>
                                                            <option value="harassment" <?php echo e(old('type') == "harassment" ? 'selected' : ''); ?>>harassment</option>
                                                            <option value="drunkenness" <?php echo e(old('type') == "drunkenness" ? 'selected' : ''); ?>>drunkenness</option>
                                                            <option value="public intoxication" <?php echo e(old('type') == "public intoxication" ? 'selected' : ''); ?>>public intoxication</option>
                                                            <option value="criminal nuisance" <?php echo e(old('type') == "criminal nuisance" ? 'selected' : ''); ?>>criminal nuisance</option>
                                                            <option value="vandalism" <?php echo e(old('type') == "vandalism" ? 'selected' : ''); ?>>vandalism</option>
                                                            <option value="gambling" <?php echo e(old('type') == "gambling" ? 'selected' : ''); ?>>gambling</option>
                                                            <option value="mendicancy" <?php echo e(old('type') == "mendicancy" ? 'selected' : ''); ?>>mendicancy</option>
                                                            <option value="littering" <?php echo e(old('type') == "littering" ? 'selected' : ''); ?>>littering</option>
                                                            <option value="public urination" <?php echo e(old('type') == "public urination" ? 'selected' : ''); ?>>public urination</option>
                                                            <option value="trespassing" <?php echo e(old('type') == "trespassing" ? 'selected' : ''); ?>>trespassing</option>
                                                            <option value="curfew violations" <?php echo e(old('type') == "curfew violations" ? 'selected' : ''); ?>>curfew violations</option>
                                                            <option value="truancy" <?php echo e(old('type') == "truancy" ? 'selected' : ''); ?>>truancy</option>
                                                            <option value="parental disobedience" <?php echo e(old('type') == "parental disobedience" ? 'selected' : ''); ?>>parental disobedience</option>
                                                            <option value="anti-smoking ordinances" <?php echo e(old('type') == "anti-smoking ordinances" ? 'selected' : ''); ?>>anti-smoking ordinances</option>
                                                            <option value="anti-drinking ordinances" <?php echo e(old('type') == "anti-drinking ordinances" ? 'selected' : ''); ?>>anti-drinking ordinances</option>
                                                            <option value="others" <?php echo e(old('type') == "others" ? 'selected' : ''); ?>>others</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="date_of_incident" class="form-label">Inclusive
                                                            Date of the Incident</label>
                                                        <input type="date" class="form-control shadow-none  <?php $__errorArgs = ['date_of_incident'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('date_of_incident')); ?>" name="date_of_incident" id="date_of_incident" required>
                                                        <?php $__errorArgs = ['date_of_incident'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <small id="helpId" class="form-text text-danger"><?php echo e($message); ?></small>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="street" class="form-label">Areas</label>
                                                        <select class="form-select shadow-none  <?php $__errorArgs = ['street'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="street" id="street" required>
                                                            <option selected disabled value="">-</option>
                                                            <option value="Purok 1" <?php echo e(old('street') == "Purok 1" ? 'selected' : ''); ?>>Purok 1</option>
                                                            <option value="Purok 2" <?php echo e(old('street') == "Purok 2" ? 'selected' : ''); ?>>Purok 2</option>
                                                            <option value="Purok 3" <?php echo e(old('street') == "Purok 3" ? 'selected' : ''); ?>>Purok 3</option>
                                                            <option value="Purok 4" <?php echo e(old('street') == "Purok 4" ? 'selected' : ''); ?>>Purok 4</option>
                                                            <option value="Purok 5" <?php echo e(old('street') == "Purok 5" ? 'selected' : ''); ?>>Purok 5</option>
                                                            <option value="Dimson Compound" <?php echo e(old('street') == "Dimson Compound" ? 'selected' : ''); ?>>Dimson Compound</option>
                                                            <option value="Purok 7" <?php echo e(old('street') == "Purok 7" ? 'selected' : ''); ?>>Purok 7</option>
                                                            <option value="Purok 8" <?php echo e(old('street') == "Purok 8" ? 'selected' : ''); ?>>Purok 8</option>
                                                            <option value="Purok 9" <?php echo e(old('street') == "Purok 9" ? 'selected' : ''); ?>>Purok 9</option>
                                                            <option value="Sta Teresa" <?php echo e(old('street') == "Sta Teresa" ? 'selected' : ''); ?>>Sta Teresa</option>
                                                            <option value="Caldozo Compound" <?php echo e(old('street') == "Caldozo Compound" ? 'selected' : ''); ?>>Caldozo Compound</option>
                                                            <option value="Perpetual Village" <?php echo e(old('street') == "Perpetual Village" ? 'selected' : ''); ?>>Perpetual Village</option>

                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="location" class="form-label">Exact Location
                                                            of the Incident</label>
                                                        <textarea class="form-control shadow-none  <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('location')); ?>" name="location" id="location" placeholder="(room, building, area, school, street, sitio, barangay, municipality, etc.)" required><?php echo e(old('location')); ?></textarea>
                                                        <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <small id="helpId" class="form-text text-danger"><?php echo e($message); ?></small>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="persons" class="form-label">Involved
                                                            Person/s & Specific Participation</label>
                                                        <textarea class="form-control shadow-none  <?php $__errorArgs = ['persons'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('persons')); ?>" name="persons" id="persons" required><?php echo e(old('persons')); ?></textarea>
                                                        <?php $__errorArgs = ['persons'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <small id="helpId" class="form-text text-danger"><?php echo e($message); ?></small>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="narrative" class="form-label">Narrative
                                                            Details of the Incident</label>
                                                        <textarea class="form-control shadow-none  <?php $__errorArgs = ['narrative'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('narrative')); ?>" name="narrative" id="narrative" required><?php echo e(old('narrative')); ?></textarea>
                                                        <?php $__errorArgs = ['narrative'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <small id="helpId" class="form-text text-danger"><?php echo e($message); ?></small>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>

                                                    <div class="mb-3">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="data_privacy" required>
                                                            <label class="form-check-label" for="data_privacy">
                                                                PRIVACY CONSENT. I understand and agree that by filling out this report, I am allowing the Barangay Tanyag
                                                                to collect, process, use, share, and disclose the information I provided and also to store it as long as necessary for the
                                                                fulfillment of Incident Reporting stated purpose and in accordance with applicable laws,
                                                                including the Data Privacy Act of 2012 and its Implementing Rules and Regulations, and the Barangay Tanyag Privacy Policy.
                                                                The purpose and extent of the collection, use, sharing, disclosure, and storage of the information were cleared to me.
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-warning ">Submit Incident
                                                Report</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row  d-flex justify-content-center">
                    <div class="col">
                        <!-- analytics section -->
                        <section id="analytics" class="analytics section-padding">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="section-header text-center pb-2">
                                            <h1>Analytics</h1>
                                            <p class="lead">Incident Reports</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    <div class="col">
                                    <div class="row pb-3">
                                    <div class="col">
                                        <div class="card">
                                            <h5 class="card-header"><i class="bi bi-bar-chart-line-fill"></i> Purok 1</h5>
                                            <div class="card-body">
                                                <canvas id="barChartPurok1"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div class="col">
                                        <div class="card">
                                            <h5 class="card-header"><i class="bi bi-bar-chart-line-fill"></i> Purok 2</h5>
                                            <div class="card-body">
                                                <canvas id="barChartPurok2"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="card">
                                            <h5 class="card-header"><i class="bi bi-bar-chart-line-fill"></i> Purok 3</h5>
                                            <div class="card-body">
                                                <canvas id="barChartPurok3"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row pb-3">
                                    <div class="col">
                                        <div class="card">
                                            <h5 class="card-header"><i class="bi bi-bar-chart-line-fill"></i> Purok 4</h5>
                                            <div class="card-body">
                                                <canvas id="barChartPurok4"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="card">
                                            <h5 class="card-header"><i class="bi bi-bar-chart-line-fill"></i> Purok 5</h5>
                                            <div class="card-body">
                                                <canvas id="barChartPurok5"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col ">
                                        <div class="card">
                                            <h5 class="card-header"><i class="bi bi-bar-chart-line-fill"></i> Dimson Compound</h5>
                                            <div class="card-body">
                                                <canvas id="barChartDimson"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row pb-3">
                                    <div class="col">
                                        <div class="card">
                                            <h5 class="card-header"><i class="bi bi-bar-chart-line-fill"></i> Purok 7</h5>
                                            <div class="card-body">
                                                <canvas id="barChartPurok7"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="card">
                                            <h5 class="card-header"><i class="bi bi-bar-chart-line-fill"></i> Purok 8</h5>
                                            <div class="card-body">
                                                <canvas id="barChartPurok8"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col ">
                                        <div class="card">
                                            <h5 class="card-header"><i class="bi bi-bar-chart-line-fill"></i> Purok 9</h5>
                                            <div class="card-body">
                                                <canvas id="barChartPurok9"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row pb-3">
                                    <div class="col">
                                        <div class="card">
                                            <h5 class="card-header"><i class="bi bi-bar-chart-line-fill"></i> Sta Teresa</h5>
                                            <div class="card-body">
                                                <canvas id="barChartSta"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="card">
                                            <h5 class="card-header"><i class="bi bi-bar-chart-line-fill"></i> Caldozo Compound</h5>
                                            <div class="card-body">
                                                <canvas id="barChartCaldozo"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col ">
                                        <div class="card">
                                            <h5 class="card-header"><i class="bi bi-bar-chart-line-fill"></i> Perpetual Village</h5>
                                            <div class="card-body">
                                                <canvas id="barChartPerpetual"></canvas>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                        </section>
                    </div>

                </div>

                <div class="row p-5">
                    <div class="col">
                        <div class="card">
                            <h5 class="card-header"><i class="bi bi-geo-alt-fill"></i> Street Map Incidents</h5>
                            <div class="card-body">
                                <div class="row g-0">
                                    <div class="col">
                                        <div id="map" style="max-height: 560px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

<script type="text/javascript">
        var type_PRK1 = JSON.parse('<?php echo json_encode($type_PRK1); ?>');
        var type_count_PRK1 = JSON.parse('<?php echo json_encode($type_count_PRK1); ?>');

        var type_PRK2 = JSON.parse('<?php echo json_encode($type_PRK2); ?>');
        var type_count_PRK2 = JSON.parse('<?php echo json_encode($type_count_PRK2); ?>');

        var type_PRK3 = JSON.parse('<?php echo json_encode($type_PRK3); ?>');
        var type_count_PRK3 = JSON.parse('<?php echo json_encode($type_count_PRK3); ?>');

        var type_PRK4 = JSON.parse('<?php echo json_encode($type_PRK4); ?>');
        var type_count_PRK4 = JSON.parse('<?php echo json_encode($type_count_PRK4); ?>');

        var type_PRK5 = JSON.parse('<?php echo json_encode($type_PRK5); ?>');
        var type_count_PRK5 = JSON.parse('<?php echo json_encode($type_count_PRK5); ?>');

        var type_DIMSON = JSON.parse('<?php echo json_encode($type_DIMSON); ?>');
        var type_count_DIMSON = JSON.parse('<?php echo json_encode($type_count_DIMSON); ?>');

        var type_PRK7 = JSON.parse('<?php echo json_encode($type_PRK7); ?>');
        var type_count_PRK7 = JSON.parse('<?php echo json_encode($type_count_PRK7); ?>');

        var type_PRK8 = JSON.parse('<?php echo json_encode($type_PRK8); ?>');
        var type_count_PRK8 = JSON.parse('<?php echo json_encode($type_count_PRK8); ?>');

        var type_PRK9 = JSON.parse('<?php echo json_encode($type_PRK9); ?>');
        var type_count_PRK9 = JSON.parse('<?php echo json_encode($type_count_PRK9); ?>');

        var type_STA = JSON.parse('<?php echo json_encode($type_STA); ?>');
        var type_count_STA = JSON.parse('<?php echo json_encode($type_count_STA); ?>');

        var type_CALDOZO = JSON.parse('<?php echo json_encode($type_CALDOZO); ?>');
        var type_count_CALDOZO = JSON.parse('<?php echo json_encode($type_count_CALDOZO); ?>');

        var type_PERPETUAL = JSON.parse('<?php echo json_encode($type_PERPETUAL); ?>');
        var type_count_PERPETUAL = JSON.parse('<?php echo json_encode($type_count_PERPETUAL); ?>');

        var _total_incident_street = JSON.parse('<?php echo json_encode($total_incident_street); ?>');
    </script>


    <script src="<?php echo e(asset('assets/resident_charts/purok1_bar.js')); ?> "></script>
    <script src="<?php echo e(asset('assets/resident_charts/purok2_bar.js')); ?> "></script>
    <script src="<?php echo e(asset('assets/resident_charts/purok3_bar.js')); ?> "></script>
    <script src="<?php echo e(asset('assets/resident_charts/purok4_bar.js')); ?> "></script>
    <script src="<?php echo e(asset('assets/resident_charts/purok5_bar.js')); ?> "></script>
    <script src="<?php echo e(asset('assets/resident_charts/dimson_bar.js')); ?> "></script>
    <script src="<?php echo e(asset('assets/resident_charts/purok7_bar.js')); ?> "></script>
    <script src="<?php echo e(asset('assets/resident_charts/purok8_bar.js')); ?> "></script>
    <script src="<?php echo e(asset('assets/resident_charts/purok9_bar.js')); ?> "></script>
    <script src="<?php echo e(asset('assets/resident_charts/stateresa_bar.js')); ?> "></script>
    <script src="<?php echo e(asset('assets/resident_charts/caldozo_bar.js')); ?> "></script>
    <script src="<?php echo e(asset('assets/resident_charts/perpetual_bar.js')); ?> "></script>
</body>

<!-- Charts.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</html>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="<?php echo e(asset('assets/leaflet-geochart/data/line.js')); ?>"></script>
<script src="<?php echo e(asset('assets/leaflet-geochart/data/point.js')); ?>"></script>
<script src="<?php echo e(asset('assets/leaflet-geochart//data/polygon.js')); ?>"></script>
<script src="<?php echo e(asset('assets/leaflet-geochart/data/nepaldata.js')); ?>"></script>

<!-- Choropleth -->
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script src="<?php echo e(asset('assets/leaflet-geochart/data/brgytanyag.js')); ?>"></script>
<script>
    /*===================================================
                      OSM  LAYER               
===================================================*/

    var map = L.map('map').setView([14.47849, 121.04972], 18);
    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });
    osm.addTo(map);

    /*===================================================
                          MARKER               
    ===================================================*/

    var singleMarker = L.marker([14.478169563917245, 121.04944248348396]);
    singleMarker.addTo(map);
    var popup = singleMarker.bindPopup('This is a popup')
    popup.addTo(map);


    /*===================================================
                         TILE LAYER               
    ===================================================*/

    var CartoDB_DarkMatter = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        subdomains: 'abcd',
        maxZoom: 19
    });
    CartoDB_DarkMatter.addTo(map);

    // Google Map Layer

    googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });
    googleStreets.addTo(map);

    // Satelite Layer
    googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });
    googleSat.addTo(map);

    var Stamen_Watercolor = L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/watercolor/{z}/{x}/{y}.{ext}', {
        attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        subdomains: 'abcd',
        minZoom: 1,
        maxZoom: 16,
        ext: 'jpg'
    });
    Stamen_Watercolor.addTo(map);


    /*===================================================
                          GEOJSON               
    ===================================================*/

    var linedata = L.geoJSON(lineJSON).addTo(map);
    var pointdata = L.geoJSON(pointJSON).addTo(map);
    var nepalData = L.geoJSON(nepaldataa).addTo(map);
    var polygondata = L.geoJSON(polygonJSON, {
        onEachFeature: function(feature, layer) {
            layer.bindPopup('<b>This is a </b>' + feature.properties.name)
        },
        style: {
            fillColor: 'red',
            fillOpacity: 1,
            color: 'green'
        }
    }).addTo(map);

    /*===================================================
                          LAYER CONTROL               
    ===================================================*/

    var baseLayers = {
        "Satellite": googleSat,
        "Google Map": googleStreets,
        "Water Color": Stamen_Watercolor,
        "OpenStreetMap": osm,
    };

    var overlays = {
        "Marker": singleMarker,
        "PointData": pointdata,
        "LineData": linedata,
        "PolygonData": polygondata
    };

    L.control.layers(baseLayers, overlays).addTo(map);


    /*===================================================
                          SEARCH BUTTON               
    ===================================================*/

    L.Control.geocoder().addTo(map);


    /*===================================================
                          Choropleth Map               
    ===================================================*/

    L.geoJSON(brgytanyagData).addTo(map);


    function getColor(d) {
        return d > 1000 ? '#800026' :
            d > 500 ? '#BD0026' :
            d > 200 ? '#E31A1C' :
            d > 100 ? '#FC4E2A' :
            d > 50 ? '#FD8D3C' :
            d > 20 ? '#FEB24C' :
            d > 10 ? '#FED976' :
            '#FFEDA0';
    }

    function style(feature) {
        return {
            fillColor: getColor(feature.properties.density),
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.7
        };
    }

    L.geoJson(brgytanyagData, {
        style: style
    }).addTo(map);

    function highlightFeature(e) {
        var layer = e.target;

        layer.setStyle({
            weight: 5,
            color: '#666',
            dashArray: '',
            fillOpacity: 0.7
        });

        if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
            layer.bringToFront();
        }

        info.update(layer.feature.properties);
        //console.log(layer.feature.properties);
        //console.log(_total_incident_street);
    }

    function resetHighlight(e) {
        geojson.resetStyle(e.target);
        info.update();
    }

    var geojson;
    // ... our listeners
    geojson = L.geoJson(brgytanyagData);

    function zoomToFeature(e) {
        map.fitBounds(e.target.getBounds());
    }

    function onEachFeature(feature, layer) {
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
            click: zoomToFeature
        });
    }

    geojson = L.geoJson(brgytanyagData, {
        style: style,
        onEachFeature: onEachFeature
    }).addTo(map);

    var info = L.control();

    info.onAdd = function(map) {
        this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
        this.update();
        return this._div;
    };

    // method that we will use to update the control based on feature properties passed
    info.update = function(props) {
        this._div.innerHTML = '<h4>Barangay Tanyag Incident Density</h4>' + (props ?
            '<b>' + props.name + '</b><br />' + props.density + ' incident reports' :
            'Hover over a street');
    };

    info.addTo(map);

    var legend = L.control({
        position: 'bottomright'
    });

    legend.onAdd = function(map) {

        var div = L.DomUtil.create('div', 'info legend'),
            grades = [0, 10, 20, 50, 100, 200, 500, 1000],
            labels = [];

        // loop through our density intervals and generate a label with a colored square for each interval
        for (var i = 0; i < grades.length; i++) {
            div.innerHTML +=
                '<i style="background:' + getColor(grades[i] + 1) + '"></i> ' +
                grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
        }

        return div;
    };

    legend.addTo(map);
</script><?php /**PATH C:\Users\eplum\Desktop\BRGY TANYAG\resources\views/user/report.blade.php ENDPATH**/ ?>