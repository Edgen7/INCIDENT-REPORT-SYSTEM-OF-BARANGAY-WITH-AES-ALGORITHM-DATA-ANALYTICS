<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mediation Settlement | BARRIO</title>
    <link href="../../css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="<?php echo e(asset('/img/385-logo.png')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>

    </style>

</head>

<body>

    <div class="d-flex " id="wrapper">
        <?php echo $__env->make('admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <?php echo $__env->make('admin.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- Page content-->
            <div class="container-fluid">

                <div class="row d-flex justify-content-center  p-5">
                    <?php if(session()->has('success')): ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Amicable Settlement has been created.',
                            footer: '<a href="/settlement/show-mediation">Return to list of mediations</a>'
                        })
                    </script>
                    <?php endif; ?>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Settlement</li>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('settlement.show.mediation')); ?>">Mediations</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>

                    <div class="card p-3 shadow">
                        <div class="row">
                            <div class="col">

                                <p class="fs-4 fw-bold">MEDIATION Hearing Record for Case <u><b>#<?php echo e($blotter_report->case_no); ?></b></u></p>
                                <p class="fst-italic"><?php echo e($blotter_report->case_title); ?></p>

                            </div>
                            <div class="col text-right">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                    <a class="btn btn-primary proceed_conciliation" href="<?php echo e(route('settlement.proceed.conciliation', $blotter_report->case_no)); ?>">Proceed to CONCILIATION</a>
                                    <script>
                                        $('.proceed_conciliation').on('click', function(e) {
                                            e.preventDefault();
                                            var self = $(this);
                                            console.log(self.data('title'));
                                            Swal.fire({
                                                title: 'Do you want to proceed the case?',
                                                showDenyButton: true,
                                                showCancelButton: true,
                                                confirmButtonText: 'Yes, proceed.',
                                                denyButtonText: `No`,
                                            }).then((result) => {
                                                /* Read more about isConfirmed, isDenied below */
                                                if (result.isConfirmed) {
                                                    Swal.fire('Proceeded to Conciliation!', '', 'success')
                                                    location.href = self.attr('href');
                                                } else if (result.isDenied) {
                                                    Swal.fire('Changes are not saved', '', 'info')
                                                }
                                            })
                                        })
                                    </script>
                                    <a class="btn btn-primary proceed_arbitration" href="<?php echo e(route('settlement.proceed.arbitration', $blotter_report->case_no)); ?>">Proceed to ARBITRATION</a>
                                    <script>
                                        $('.proceed_arbitration').on('click', function(e) {
                                            e.preventDefault();
                                            var self = $(this);
                                            console.log(self.data('title'));
                                            Swal.fire({
                                                title: 'Do you want to proceed the case?',
                                                showDenyButton: true,
                                                showCancelButton: true,
                                                confirmButtonText: 'Yes, proceed.',
                                                denyButtonText: `No`,
                                            }).then((result) => {
                                                /* Read more about isConfirmed, isDenied below */
                                                if (result.isConfirmed) {
                                                    Swal.fire('Proceeded to Arbitration!', '', 'success')
                                                    location.href = self.attr('href');
                                                } else if (result.isDenied) {
                                                    Swal.fire('Changes are not saved', '', 'info')
                                                }
                                            })
                                        })
                                    </script>
                                    <a href="<?php echo e(route('settlement.file-court-action', $blotter_report->case_no)); ?>" class="btn btn-danger">File Court Action</a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="card shadow-sm p-2" style="height: 12rem;">
                                    <p class="fw-bold text-primary">Complainant</p>
                                    <p class="fw-normal"><span class="text-uppercase">&nbsp;&nbsp;&nbsp;&nbsp; <?php echo e($complainant->last_name); ?></span>, <?php echo e($complainant->first_name); ?> <?php echo e($complainant->middle_name); ?></p>
                                </div>

                            </div>
                            <div class="col">
                                <div class="card shadow-sm p-2" style="height: 12rem;">
                                    <p class="fw-bold text-primary">Respondent</p>
                                    <p class="fw-normal"><span class="text-uppercase">&nbsp;&nbsp;&nbsp;&nbsp; <?php echo e($respondent->last_name); ?></span>, <?php echo e($respondent->first_name); ?> <?php echo e($respondent->middle_name); ?></p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card shadow-sm p-2" style="height: 12rem;">
                                    <p class="fw-bold text-primary">Witness</p>
                                    <?php $__empty_1 = true; $__currentLoopData = $persons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <ul style="border-bottom: 1px solid;">
                                        <li>
                                            <span class="text-uppercase"> <?php echo e($person->last_name); ?></span>, <?php echo e($person->first_name); ?> <?php echo e($person->middle_name); ?>

                                        </li>
                                    </ul>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p class="fw-bold">No Witnesses...</b></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <form method="post" action="<?php echo e(route('settlement.mediation.store', $blotter_report->case_no)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="p-3">
                                    <p class="fw-bold text-primary">Amicable Settlement Agreement</p>
                                    <textarea class="form-control" id="" placeholder="Agreement description" rows="5" name="agreement_desc" value="asdasda"><?php echo e(old('agreement_desc')); ?></textarea>
                                    <?php $__errorArgs = ['agreement_desc'];
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

                            <div class="row">
                                <div class="col-md-auto mb-3">
                                    <p class="fw-bold text-primary">Complainant's Signature</p>
                                    <!--
                                    <input type="file" class="form-control shadow-none  <?php $__errorArgs = ['complainant_sign'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" onchange="previewFile(this)" name="complainant_sign" value="<?php echo e(old('complainant_sign')); ?>">
                                    <?php $__errorArgs = ['complainant_sign'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small id="helpId" class="form-text text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    -->
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="complainant_sign_check" required>
                                            <label class="form-check-label" for="complainant_sign_check">Signed by Complainant</label>
                                        </div>
                                    </div>
                                    
                                    <br>
                                    <p class="fw-bold text-primary">Respondent's Signature</p>
                                    <input type="file" class="form-control shadow-none  <?php $__errorArgs = ['respondent_sign'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" onchange="previewFile(this)" name="respondent_sign" value="<?php echo e(old('respondent_sign')); ?>">
                                    <?php $__errorArgs = ['respondent_sign'];
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

                            <div class="mb-3 mt-3">
                                <button type="submit" class="btn btn-primary">Create Settlement</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html><?php /**PATH D:\xampp\htdocs\barrio\resources\views/settlement/mediation.blade.php ENDPATH**/ ?>