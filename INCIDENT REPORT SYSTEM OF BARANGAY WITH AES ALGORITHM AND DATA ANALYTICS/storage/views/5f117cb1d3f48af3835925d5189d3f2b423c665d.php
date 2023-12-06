<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search | BARRIO</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="<?php echo e(asset('/img/385-logo.png')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <style>
        
        .navbar-nav>.active>a {
            color: blue !important;
        }


        .navbar-nav .nav-item:hover .nav-link
        {
            color: blue !important;
        }
    </style>
</head>

<body>

    <div class="d-flex " id="wrapper">
        <?php echo $__env->make('admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-warning" id="sidebarToggle"><span class="navbar-toggler-icon"></span></button>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item"><a class="nav-a nav-link text-dark fw-bold" href="<?php echo e(route('blotter.settled')); ?>">Settled Cases</a></li>
                            <li class="nav-item active"><a class="nav-a nav-link text-dark fw-bold" href="<?php echo e(route('blotter.summary')); ?>">Search Case</a></li>

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
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Page content-->
            <div class="container-fluid">
                <div class="row d-flex justify-content-center mt-5 px-5">
                    <?php if(session()->has('none')): ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'No Record Found. Please check the case no.',
                            footer: '<a href="/blotter/summary">Return to case summary</a>'
                        })
                    </script>
                    <?php endif; ?>

                    <?php if(session()->has('no_hearing')): ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'No Hearing Yet',
                            footer: '<a href="/blotter/summary">Return to case summary</a>'
                        })
                    </script>
                    <?php endif; ?>

                    <?php if(session()->has('no_settlement')): ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Case doesnt have settlement.',
                            footer: '<a href="/blotter/summary">Return to case summary</a>'
                        })
                    </script>
                    <?php endif; ?>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Blotter</li>
                            <li class="breadcrumb-item active" aria-current="page">Search</li>
                        </ol>
                    </nav>

                    <h5 class="text-primary">Search for an blotter case report</h5>

                    <div class="p-2">
                        <form action="<?php echo e(route('blotter.summary')); ?>" method="get">
                            <?php echo csrf_field(); ?>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control shadow-none" name="search" id="caseNo" placeholder="Case No." value="<?php echo e(request()->query('search')); ?>" data-bs-toggle="collapse" data-bs-target="#collapseExample">
                                <label for="caseNo" class="p-3">Case No.</label>
                            </div>
                        </form>
                    </div>

                    <!-- card -->
                    <div class="row mt-2 mb-5 collapse show" id="collapseExample">

                        <?php $__empty_1 = true; $__currentLoopData = $blotter_report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blotter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>


                        <div class="card card-body">

                            <div class="row">
                                <div class="col">
                                    <h5 class="text-primary">

                                        <p class="fw-bold">Case Report Summary of Case #<?php echo e($blotter->case_no); ?></p>
                                    </h5>
                                    <p class="fst-italic text-primary"><?php echo e($blotter->case_title); ?></p>
                                </div>
                                <div class="col text-right">

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-primary " data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-file-earmark-pdf-fill"></i> Generate PDF Forms</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Select PDF to Generate</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-left">
                                                    <div class="row">
                                                        <div class="col">
                                                            <p class="fw-bold text-primary">Complainant's Form (KP #7) </p>
                                                        </div>
                                                        <div class="col text-right">
                                                            <a href="<?php echo e(route('complaint.pdf', $blotter->case_no)); ?>" class="btn btn-success">Generate | <span><i class="bi bi-printer-fill"></i></span></a>
                                                        </div>

                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col">
                                                            <p class="fw-bold text-primary">Amicable Settlement Form (KP #16)</p>
                                                        </div>
                                                        <div class="col text-right">
                                                            <a href="<?php echo e(route('amicable.pdf', $blotter->case_no)); ?>" class="btn btn-warning " id="amicableBtn">Generate | <span><i class="bi bi-printer-fill"></i></span></a>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col">
                                                            <p class="fw-bold text-primary">Arbitration Award Form (KP #16)</p>
                                                        </div>
                                                        <div class="col text-right">
                                                            <a href="<?php echo e(route('arbitration.pdf', $blotter->case_no)); ?>" class="btn btn-danger " id="arbitrationBtn">Generate | <span><i class="bi bi-printer-fill"></i></span></a>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <?php if($hearing->settlement_id): ?>
                                                    <script>
                                                        var element = document.getElementById("arbitrationBtn");
                                                        element.classList.add("disabled");
                                                    </script>
                                                    <?php elseif($hearing->award_id): ?>
                                                    <script>
                                                        var element = document.getElementById("amicableBtn");
                                                        element.classList.add("disabled");
                                                    </script>
                                                    <?php endif; ?>
                                                    <!--
                                                    <div class="row">
                                                        <div class="col">
                                                            <p class="fw-bold text-primary">Certication to File Action (KP #20)</p>
                                                        </div>
                                                        <div class="col text-right">
                                                            <a href="" class="btn btn-primary">Generate | <span><i class="bi bi-printer-fill"></i></span></a>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    -->
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <p class="fw-bold">Complainant(s)</p>
                                    <input class="form-control" type="text" value="<?php echo e($complainant->first_name); ?> <?php echo e($complainant->middle_name); ?> <?php echo e($complainant->last_name); ?>" aria-label="Disabled input example" disabled readonly>
                                </div>
                                <div class="col">
                                    <p class="fw-bold">Respondent(s)</p>
                                    <input class="form-control" type="text" value="<?php echo e($respondent->first_name); ?> <?php echo e($respondent->middle_name); ?> <?php echo e($respondent->last_name); ?>" aria-label="Disabled input example" disabled readonly>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col">
                                    <p class="fw-bold text-primary">Incident Description</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="fw-bold">Date of Incident: <?php echo e(date('F d, Y', strtotime($blotter->date_of_incident))); ?></p>
                                    <p class="fw-bold">Date Reported: <?php echo e(date('F d, Y', strtotime($blotter->date_reported))); ?></p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="lh-base"><?php echo e($blotter->complaint_desc); ?></p>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col">
                                    <p class="fw-bold text-primary">Hearing Information</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="fw-bold">Hearing/Action: </p>
                                    <p class="fw-bold">Date of Hearing: </p>
                                    <p class="fw-bold">Date of Settlement: </p>
                                    <p class="fw-bold">Final Agreement: </p>
                                </div>
                                <div class="col-sm-9">
                                    <?php if($hearing_type->type_name == "Mediation"): ?>
                                    <p><span class="badge bg-primary text-uppercase"><?php echo e($hearing_type->type_name); ?></span></p>
                                    <?php elseif($hearing_type->type_name == "Conciliation"): ?>
                                    <p><span class="badge bg-warning text-uppercase"><?php echo e($hearing_type->type_name); ?></span></p>
                                    <?php elseif($hearing_type->type_name == "Arbitration"): ?>
                                    <p><span class="badge bg-danger text-uppercase"><?php echo e($hearing_type->type_name); ?></span></p>
                                    <?php endif; ?>
                                    <p class="font-weight-normal"><?php echo e(date('F d, Y', strtotime($hearing->date_of_meeting))); ?></p>
                                    <p class="font-weight-normal"><?php echo e(date('F d, Y', strtotime($agreement->date_agreed))); ?></p>
                                    <?php if($hearing->settlement_id): ?>
                                    <p class="lh-base"><?php echo e($agreement->agreement_desc); ?></p>
                                    <?php elseif($hearing->award_id): ?>
                                    <p class="lh-base"><?php echo e($agreement->award_desc); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <form method="post" action="<?php echo e(route('editBlotter', $blotter->case_no)); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col">
                                        <hr>
                                        <h5 class="text-primary">
                                            <p class="fw-bold">Execution of Agreement</p>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p class="fw-bold">Date of Agreement Execution</p>
                                    </div>
                                    <div class="col">
                                        <p class="fw-bold">Compliance Status</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input class="form-control" type="date" name="executionDate" required>
                                        <?php $__errorArgs = ['executionDate'];
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
                                    <div class="col">
                                        <select class="form-select" aria-label="Default select example" name="compliance" required>
                                            <option selected disabled>---</option>
                                            <option value="1">COMPLIANCE</option>
                                            <option value="0">NON-COMPLIANCE</option>
                                        </select>
                                        <?php $__errorArgs = ['compliance'];
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
                                </div>

                                <div class="row mt-3">
                                    <p class="fw-bold">Remarks</p>
                                    <div class="form-floating p-2">
                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="remarks" required></textarea>
                                        <label for="floatingTextarea2">Comments</label>
                                        <?php $__errorArgs = ['remarks'];
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
                                </div>

                                <button type="submit" class="btn btn-dark float-end">Update</button>
                            </form>
                        </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <div class="card card-body mb-2 ">
                            <p class="fst-italic text-danger">Enter the case number to search a case.</p>
                        </div>

                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html><?php /**PATH C:\Users\eplum\Desktop\Thesis\BARRIO FILE\barrio\resources\views/blotter/summary.blade.php ENDPATH**/ ?>