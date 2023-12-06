<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arbitration Agreement | TANYAG</title>
    <link href="../../css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="<?php echo e(asset('/img/taguiglogo.png')); ?>">
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

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Settlement</li>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('settlement.show.arbitration')); ?>">Arbitrations</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Agreement</li>
                        </ol>
                    </nav>

                    <div class="card p-3 shadow">
                        <div class="row">
                            <div class="col">

                                <p class="fs-4 fw-bold">Agreement for Arbitration</p>
                                <p class="fst-italic"><?php echo e($blotter_report->case_no); ?>, <?php echo e($blotter_report->case_title); ?></p>

                            </div>
                            <div class="col text-right">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
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

                        <form method="post" action="<?php echo e(route('settlement.arbitration_agreement.store', $blotter_report->case_no)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="p-3">
                                    <p class="fw-bold text-primary">Arbitration Agreement</p>
                                    <p class="">We hereby agree to submit our dispute for arbitration to the Punong Barangay/Pangkat ng Tagapagsundo and bind ourselves to comply with the award that may be rendered thereon. We have made this agreement freely with a fully understanding of its nature and consequences.</p>
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

                            <div class="row mt-3">
                                <p class="fw-bold text-primary">Attestation</p>
                                <p class="">I hereby certify that the foregoing Agreement for Arbitration was entered into by the parties freely and voluntarily, after I had explained to them nature and the consequences of such agreement.</p>
                            </div>

                            <!--
                            <div class="row">
                                <div class="col-md-auto mb-3">
                                    <p class="fw-bold text-primary">Lupon's Signature</p>
                                    <input type="file" class="form-control shadow-none  <?php $__errorArgs = ['lupon_sign'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" onchange="previewFile(this)" name="lupon_sign" value="<?php echo e(old('lupon_sign')); ?>">
                                    <?php $__errorArgs = ['lupon_sign'];
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
                            -->

                            <div class="mb-3 mt-3">
                                <button type="submit" class="btn btn-primary">Create Arbitration Agreement</button>
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

</html><?php /**PATH C:\Users\eplum\Desktop\BRGY TANYAG\resources\views/settlement/arbitration_agreement.blade.php ENDPATH**/ ?>