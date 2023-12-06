<?php

use Maize\Encryptable\Encryption;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Schedule | TANYAG</title>
    <link href="../../css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="<?php echo e(asset('/img/taguiglogo.png')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
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
                            <li class="breadcrumb-item">Notice</li>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('notice.show')); ?>">Set Schedule & Create Notices</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Select</li>
                        </ol>
                    </nav>

                    <div class="card p-3 shadow">
                        <form method="post" action="<?php echo e(route('editHearingSched', $blotter_report->case_no)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row p-3">
                                <h3 class="mt-3">Schedule Selection for <b>#<?php echo e($blotter_report->case_no); ?></b></h3>
                                <p class="card-text fst-italic text-primary mb-3"><?php echo e($blotter_report->case_title); ?></p>
                                <hr>

                                <div class="col">
                                    <div class="mb-3">
                                        <label for="complainant" class="form-label">Complainant</label>
                                        <input type="text" class="form-control" id="complainant" aria-describedby="emailHelp" disabled placeholder="<?php echo e($complainant->salutation); ?> <?php echo e($complainant->first_name); ?> <?php echo e($complainant->middle_name); ?> <?php echo e($complainant->last_name); ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="respondent" class="form-label">Respondent</label>
                                        <input type="text" class="form-control" id="respondent" aria-describedby="emailHelp" disabled placeholder="<?php echo e($respondent->salutation); ?> <?php echo e($respondent->first_name); ?> <?php echo e($respondent->middle_name); ?> <?php echo e($respondent->last_name); ?>">
                                    </div>
                                </div>

                                <div class="col">
                                    <p class="fw-bold text-primary">Select Hearing Schedule</p>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="date" class="form-control" name="hearing_date" id="hearing_date">
                                            <label for="hearing_date" class="form-label">Hearing Date</label>
                                            <?php $__errorArgs = ['hearing_date'];
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

                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="time" class="form-control" name="hearing_time" id="hearing_time">
                                            <label for="hearing_time">Hearing Time</label>
                                            <?php $__errorArgs = ['hearing_time'];
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

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary float-end">Submit Schedule</button>
                                    </div>

                                    <div class="mb-3">
                                        <br><br>
                                        <p class="fw-bold fst-italic text-primary">Present Hearing Schedule(s)</p>
                                        <?php $__empty_1 = true; $__currentLoopData = $present_sched; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sched): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <?php
                                        $case_title = Encryption::php()->decrypt($sched->case_title);

                                        $strSched = date('F d, Y @ h:iA', strtotime($sched->date_of_meeting));
                                        $today = date("Y-m-d H:i:s");
                                        ?>

                                        <?php if($today > $sched->date_of_meeting): ?>
                                        <p class="fw-normal text-danger"><?php echo e($strSched); ?> <b><i><?php echo e($case_title); ?> <?php echo e($sched->case_no); ?></i></b></p>
                                        <hr>
                                        <?php else: ?>
                                        <p class="fw-normal"><?php echo e($strSched); ?> <b><i><?php echo e($case_title); ?> <?php echo e($sched->case_no); ?></i></b></p>
                                        <hr>
                                        <?php endif; ?>



                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <p class="fw-normal">No Present Hearing Schedule</b></p>
                                        <hr>
                                        <?php endif; ?>
                                        <?php echo e($present_sched->onEachSide(2)->links()); ?>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Pang disable ng past dates -->
    <script language="javascript">
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        $('#hearing_date').attr('min', today);
    </script>


    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html><?php /**PATH C:\Users\eplum\Desktop\BRGY TANYAG\resources\views/notice/schedule.blade.php ENDPATH**/ ?>