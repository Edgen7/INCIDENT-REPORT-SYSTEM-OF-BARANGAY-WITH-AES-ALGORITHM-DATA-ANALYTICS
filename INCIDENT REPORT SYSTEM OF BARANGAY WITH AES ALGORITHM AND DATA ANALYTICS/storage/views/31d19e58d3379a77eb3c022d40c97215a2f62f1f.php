<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Notice | TANYAG</title>
    <link href="../../css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="<?php echo e(asset('/img/taguiglogo.png')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            var maxField = 10;
            var addButton = $('.add_button');
            var wrapper = $('.field_wrapper');
            var fieldHTML = '<div class="row justify-content-center"><div class="col form-floating mb-3 px-2"><input type="text" id="lastName" class="form-control" name="lastName[]" required><label for="lastName">Last Name</label></div><div class="col form-floating mb-3 px-2"><input type="text" id="firstName" class="form-control" name="firstName[]" required><label for="firstName">First Name</label></div><div class="col form-floating mb-3 px-2"><input type="text" id="middleName" class="form-control" name="middleName[]" required><label for="middleName">Middle Name</label></div><div class="col-auto"><a href="javascript:void(0);" class="remove_button btn btn-danger" title="Remove field"><i class="bi bi-dash-circle"></i> REMOVE</a></div></div>';

            var x = 1;

            //Once add button is clicked
            $(addButton).click(function() {
                if (x < maxField) {
                    x++;
                    $(wrapper).append(fieldHTML);
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e) {
                e.preventDefault();
                $(this).parent('div').parent('div').remove(); //Remove fields html
                x--; //Decrement field counter
            });
        });
    </script>

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
                            title: 'Notice created successfully',
                        })
                    </script>
                    <?php endif; ?>
                    <?php if(session()->has('added')): ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Witness added successfully',
                        })
                    </script>
                    <?php endif; ?>
                    <?php if(session()->has('deleted')): ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Witness removed successfully',
                        })
                    </script>
                    <?php endif; ?>
                    <?php if(session()->has('fail_to_notify')): ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to notify. Not yet in conciliation process.',
                        })
                    </script>
                    <?php endif; ?>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Notice</li>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('notice.show')); ?>">Set Schedule & Create Notices</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>

                    <div class="card p-3 shadow">
                        <p class="fw-bolder text-primary fs-5">Notice of Case <u><i><?php echo e($notice->case_no); ?></i></u> </p>
                        <p class="fst-italic text-primary"><?php echo e($blotter_report->case_title); ?></p>

                        <div class="row justify-content-center">
                            <div class="col-auto align-self-center">
                                <b>Hearing Schedule</b>
                            </div>
                            <div class="col-9 align-self-center">
                                <?php
                                $strSched = date('F d, Y, h:iA', strtotime($notice->date_of_meeting));
                                ?>
                                <input type="text" class="form-control" readonly value="<?php echo e($strSched); ?>">
                            </div>
                        </div>
                        <div class="row text-right">
                            <a href="<?php echo e(route('notice.schedule', $notice->case_no)); ?>">Change schedule?</a>
                        </div>


                        <div class="row mt-5">
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>Type of Notice</th>
                                            <th>Resident Name(s)</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Hearing Notice</th>
                                            <td><?php echo e($complainant->salutation); ?> <?php echo e($complainant->first_name); ?> <?php echo e($complainant->middle_name); ?> <?php echo e($complainant->last_name); ?></td>
                                            <td>
                                                <?php if($hearing): ?>
                                                <?php if($hearing->notified == 1): ?>
                                                <b class="text-success">NOTIFIED</b>
                                                <?php else: ?>
                                                <b class="text-danger">TO NOTIFY</b>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                            </td>

                                            <?php if($hearing): ?>
                                            <div class="btn-group" role="group">
                                                <td><a href="<?php echo e(route('notice.notify', $hearing->notice_id)); ?>" class="btn btn-success">NOTIFY</a><a href="<?php echo e(route('hearing.pdf', $hearing->notice_id)); ?>" class="btn btn-dark">DOWNLOAD</a></td>
                                            </div>
                                            <?php else: ?>
                                            <td><a href="<?php echo e(route('notice.hearing', $notice->case_no)); ?>" class="btn btn-primary">Create Hearing Record</a></td>
                                            <?php endif; ?>

                                        </tr>
                                        <tr>
                                            <th scope="row">Summon Notice</th>
                                            <td><?php echo e($respondent->salutation); ?> <?php echo e($respondent->first_name); ?> <?php echo e($respondent->middle_name); ?> <?php echo e($respondent->last_name); ?></td>
                                            <td class="text-danger">
                                                <?php if($summon): ?>
                                                <?php if($summon->notified == 1): ?>
                                                <b class="text-success">NOTIFIED</b>
                                                <?php else: ?>
                                                <b class="text-danger">TO NOTIFY</b>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                            <?php if($summon): ?>
                                            <div class="btn-group" role="group">
                                                <td><a href="<?php echo e(route('notice.notify', $summon->notice_id)); ?>" class="btn btn-success">NOTIFY</a><a href="<?php echo e(route('summon.pdf', $summon->notice_id)); ?>" class="btn btn-dark">DOWNLOAD</a></td>
                                            </div>
                                            <?php else: ?>
                                            <td><a href="<?php echo e(route('notice.summon', $notice->case_no)); ?>" class="btn btn-primary">Create Summon Record</a></td>
                                            <?php endif; ?>
                                        </tr>
                                        <tr>
                                            <th scope="row">Pangkat Notice</th>
                                            <td>-</td>
                                            <td class="text-danger">
                                                <?php if($constitution): ?>
                                                <?php if($constitution->notified == 1): ?>
                                                <b class="text-success">NOTIFIED</b>
                                                <?php else: ?>
                                                <b class="text-danger">TO NOTIFY</b>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                            <?php if($constitution): ?>
                                            <div class="btn-group" role="group">
                                                <td><a href="<?php echo e(route('notice.notify', $constitution->notice_id)); ?>" class="btn btn-success">NOTIFY</a><a href="<?php echo e(route('pangkat.pdf', $constitution->notice_id)); ?>" class="btn btn-dark">DOWNLOAD</a></td>
                                            </div>
                                            <?php else: ?>
                                            <td><a href="<?php echo e(route('notice.constitution', $notice->case_no)); ?>" class="btn btn-primary">Create Pangkat Constitution Notice</a></td>
                                            <?php endif; ?>
                                        </tr>
                                        <tr>
                                            <th scope="row">Subpoena Notice</th>
                                            <td>-</td>
                                            <td class="text-danger"><?php if($subpoena): ?>
                                                <?php if($subpoena->notified == 1): ?>
                                                <b class="text-success">NOTIFIED</b>
                                                <?php else: ?>
                                                <b class="text-danger">TO NOTIFY</b>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#collapseExample">Create Witness Record <i class="bi bi-caret-down-fill"></i></button></td>
                                        </tr>
                                    </tbody>

                                </table>

                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        Subpoena Notice
                                        <hr>
                                        <p class="fw-bold">WITNESSES</p>

                                        <?php $__empty_1 = true; $__currentLoopData = $persons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <p class="font-monospace lh-1"><?php echo e($loop->index+1); ?>.) <?php echo e($person->last_name); ?>, <?php echo e($person->first_name); ?> <?php echo e($person->middle_name); ?> | <a href="<?php echo e(route('notice.removeWitness', $person->person_id)); ?>">Remove this witness</a></p>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <p class="font-monospace fw-bold">No Witnesses...</b></p>

                                        <?php endif; ?>
                                        <hr>
                                        <form action="<?php echo e(route('notice.addWitness', $notice->case_no)); ?>" method="POST" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <div class="field_wrapper">
                                                <div class="row justify-content-center">
                                                    <div class="col form-floating mb-3 px-2">
                                                        <input type="text" id="lastName" class="form-control" name="lastName[]" required>
                                                        <label for="lastName">Last Name</label>
                                                    </div>
                                                    <div class="col form-floating mb-3 px-2">
                                                        <input type="text" id="firstName" class="form-control" name="firstName[]" required>
                                                        <label for="firstName">First Name</label>
                                                    </div>
                                                    <div class="col form-floating mb-3 px-2">
                                                        <input type="text" id="middleName" class="form-control" name="middleName[]" required>
                                                        <label for="middleName">Middle Name</label>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="javascript:void(0);" class="add_button btn btn-success" title="Add field"><i class="bi bi-plus-circle"></i> ADD</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row text-right">
                                                <div class="col">
                                                    <div class="btn-grou" role="group">
                                                        <input type="submit" name="submit" class="btn btn-warning" value="Add to Witnesses" />
                                                        <?php if($subpoena): ?>
                                                        <a href="<?php echo e(route('subpoena.pdf', $subpoena->notice_id)); ?>" class="btn btn-dark">Download Subpoena Notice</a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
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
</body>

</html><?php /**PATH C:\Users\eplum\Desktop\BRGY TANYAG\resources\views/notice/create.blade.php ENDPATH**/ ?>