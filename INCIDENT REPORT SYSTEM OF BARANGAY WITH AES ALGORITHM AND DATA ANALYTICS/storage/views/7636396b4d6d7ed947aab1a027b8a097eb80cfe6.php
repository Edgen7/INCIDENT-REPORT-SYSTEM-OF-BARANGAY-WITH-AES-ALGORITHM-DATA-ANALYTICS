<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Notices | BARRIO</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="<?php echo e(asset('/img/385-logo.png')); ?>">
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
                    <?php if(session()->has('success')): ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Notice notified',
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
                            <li class="breadcrumb-item active" aria-current="page">Lists of Notices</li>
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


                    <div class="card p-3 shadow">
                        <?php $__currentLoopData = $blotter_report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blotter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card-body bg-light mb-3">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title"><b><u>Case #<?php echo e($blotter->case_no); ?></u></b></h5>
                                    <p class="card-text fw-bold text-primary"><i><?php echo e($blotter->case_title); ?></i></p>
                                </div>
                                <div class="col">
                                    <!--
                                    <p class="card-text text-end"><b>Hearing Type</b></p>
                                    <p class="card-text text-end"><b>Hearing Schedule</b></p>
                                    -->
                                </div>
                            </div>

                            <div class="row mt-3">

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Type of Notice</th>
                                                <th>Resident Name(s)</th>
                                                <th>Status</th>
                                                <th>Date Notified</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <th scope="row">Hearing Notice</th>
                                                <td><?php echo e($complainant[$loop->index]->salutation); ?> <?php echo e($complainant[$loop->index]->first_name); ?> <?php echo e($complainant[$loop->index]->middle_name); ?> <?php echo e($complainant[$loop->index]->last_name); ?></td>
                                                <td>
                                                    <?php $__empty_1 = true; $__currentLoopData = $notices[$loop->index]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <?php if($notice->notice_type_id == 1): ?>
                                                    <?php if($notice->notified == 1): ?>
                                                    <b class="text-success">NOTIFIED</b>
                                                    <?php else: ?>
                                                    <b class="text-danger">TO NOTIFY</b>
                                                    <?php endif; ?>
                                                    <?php else: ?>

                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <b class="text-danger">Notice not yet created</b>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php $__empty_1 = true; $__currentLoopData = $notices[$loop->index]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <?php if($notice->notice_type_id == 1): ?>
                                                    <?php if($notice->notified == 1): ?>
                                                    <i><?php echo e($notice->date_notified); ?></i>
                                                    <?php else: ?>

                                                    <?php endif; ?>
                                                    <?php else: ?>

                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <b class="text-danger">---</b>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php $__empty_1 = true; $__currentLoopData = $notices[$loop->index]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <?php if($notice->notice_type_id == 1): ?>
                                                    <?php if($notice->notified == 1): ?>

                                                    <?php else: ?>
                                                    <a href="<?php echo e(route('notice.notify', $notice->notice_id)); ?>" class="btn btn-outline-success ">Set to Notified</a>
                                                    <?php endif; ?>
                                                    <?php else: ?>

                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <b class="text-danger">---</b>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Summon Notice</th>
                                                <td><?php echo e($respondent[$loop->index]->salutation); ?> <?php echo e($respondent[$loop->index]->first_name); ?> <?php echo e($complainant[$loop->index]->middle_name); ?> <?php echo e($respondent[$loop->index]->last_name); ?></td>
                                                <td>
                                                    <?php $__empty_1 = true; $__currentLoopData = $notices[$loop->index]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <?php if($notice->notice_type_id == 2): ?>
                                                    <?php if($notice->notified == 1): ?>
                                                    <b class="text-success">NOTIFIED</b>
                                                    <?php else: ?>
                                                    <b class="text-danger">TO NOTIFY</b>
                                                    <?php endif; ?>
                                                    <?php else: ?>

                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <b class="text-danger">Notice not yet created</b>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php $__empty_1 = true; $__currentLoopData = $notices[$loop->index]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <?php if($notice->notice_type_id == 2): ?>
                                                    <?php if($notice->notified == 1): ?>
                                                    <i><?php echo e($notice->date_notified); ?></i>
                                                    <?php else: ?>

                                                    <?php endif; ?>
                                                    <?php else: ?>

                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <b class="text-danger">---</b>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php $__empty_1 = true; $__currentLoopData = $notices[$loop->index]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <?php if($notice->notice_type_id == 2): ?>
                                                    <?php if($notice->notified == 1): ?>

                                                    <?php else: ?>
                                                    <a href="<?php echo e(route('notice.notify', $notice->notice_id)); ?>" class="btn btn-outline-success ">Set to Notified</a>
                                                    <?php endif; ?>
                                                    <?php else: ?>

                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <b class="text-danger">---</b>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Pangkat Constitution Notice</th>
                                                <td></td>
                                                <td>
                                                    <?php $__empty_1 = true; $__currentLoopData = $notices[$loop->index]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <?php if($notice->notice_type_id == 4): ?>
                                                    <?php if($notice->notified == 1): ?>
                                                    <b class="text-success">NOTIFIED</b>
                                                    <?php else: ?>
                                                    <b class="text-danger">TO NOTIFY</b>
                                                    <?php endif; ?>
                                                    <?php else: ?>

                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <b class="text-danger">Notice not yet created</b>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php $__empty_1 = true; $__currentLoopData = $notices[$loop->index]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <?php if($notice->notice_type_id == 4): ?>
                                                    <?php if($notice->notified == 1): ?>
                                                    <i><?php echo e($notice->date_notified); ?></i>
                                                    <?php else: ?>

                                                    <?php endif; ?>
                                                    <?php else: ?>

                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <b class="text-danger">---</b>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php $__empty_1 = true; $__currentLoopData = $notices[$loop->index]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <?php if($notice->notice_type_id == 4): ?>
                                                    <?php if($notice->notified == 1): ?>

                                                    <?php else: ?>
                                                    <a href="<?php echo e(route('notice.notify', $notice->notice_id)); ?>" class="btn btn-outline-success ">Set to Notified</a>
                                                    <?php endif; ?>
                                                    <?php else: ?>

                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <b class="text-danger">---</b>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Subpoena Notice</th>
                                                <td></td>
                                                <td>
                                                    <?php $__empty_1 = true; $__currentLoopData = $notices[$loop->index]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <?php if($notice->notice_type_id == 3): ?>
                                                    <?php if($notice->notified == 1): ?>
                                                    <b class="text-success">NOTIFIED</b>
                                                    <?php else: ?>
                                                    <b class="text-danger">TO NOTIFY</b>
                                                    <?php endif; ?>
                                                    <?php else: ?>

                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <b class="text-danger">Notice not yet created</b>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php $__empty_1 = true; $__currentLoopData = $notices[$loop->index]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <?php if($notice->notice_type_id == 3): ?>
                                                    <?php if($notice->notified == 1): ?>
                                                    <i><?php echo e($notice->date_notified); ?></i>
                                                    <?php else: ?>

                                                    <?php endif; ?>
                                                    <?php else: ?>

                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <b class="text-danger">---</b>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php $__empty_1 = true; $__currentLoopData = $notices[$loop->index]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <?php if($notice->notice_type_id == 3): ?>
                                                    <?php if($notice->notified == 1): ?>

                                                    <?php else: ?>
                                                    <a href="<?php echo e(route('notice.notify', $notice->notice_id)); ?>" class="btn btn-outline-success ">Set to Notified</a>
                                                    <?php endif; ?>
                                                    <?php else: ?>

                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <b class="text-danger">---</b>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <?php $__empty_1 = true; $__currentLoopData = $notices[$loop->index]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <?php if($notice->notice_id): ?>
                                                <td class="text-right" colspan="5"><a href="<?php echo e(route('notice.create', $notice->case_no)); ?>" class="btn btn-sm btn-primary text-right">Manage Notice</a></td>
                                                <?php endif; ?>
                                                <?php break; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <td class="text-right" colspan="5"><a href="<?php echo e(route('notice.schedule', $blotter->case_no)); ?>" class="btn btn-sm btn-danger text-right">No schedule yet</a></td>
                                                <?php endif; ?>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="justify-content-end p-3"><?php echo e($blotter_report->appends(['search'=>request()->query('search')])->links()); ?> </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html><?php /**PATH D:\xampp\htdocs\barrio\resources\views/notice/summary.blade.php ENDPATH**/ ?>