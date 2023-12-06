<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KP Cases | BARRIO</title>
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
                <div class="row d-flex justify-content-center mt-5 p-5">

                    <?php if(session()->has('kp_updated')): ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'KP Case Updated',
                            footer: '<a href="/home">Return to home</a>'
                        })
                    </script>
                    <?php else: ?>
                    <?php endif; ?>

                    <?php if(session()->has('kp_added')): ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'KP Case Added',
                            footer: '<a href="/home">Return to home</a>'
                        })
                    </script>
                    <?php else: ?>
                    <?php endif; ?>

                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Blotter</li>
                                <li class="breadcrumb-item active" aria-current="page">KP Cases</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col text-right mb-3">
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#create">Add a KP Case</button>
                    </div>
                    <div class="card p-3 shadow">

                        <div class="table-responsive">
                            <table class="table table-bordered  yajra-datatable">
                                <thead>
                                    <tr>
                                        <th>Article No.</th>
                                        <th>Case Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $kp_cases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($kp->article_no); ?></td>
                                        <td><?php echo e($kp->case_name); ?></td>
                                        <td>
                                            <a href="" data-bs-toggle="modal" data-bs-target="#edit<?php echo e($kp->article_no); ?>"><i class="bi bi-pen-fill"></i> Edit</a>
                                        </td>
                                    </tr>

                                    <!-- Modal for create-->
                                    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Create KP Case</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="<?php echo e(route('blotter.addKP')); ?>" enctype="multipart/form-data">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="mb-3">
                                                            <label for="article_no" class="form-label">Article No</label>
                                                            <input type="number" class="form-control  <?php $__errorArgs = ['article_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="article_no" name="article_no" required placeholder="ex. 150">
                                                            <?php $__errorArgs = ['article_no'];
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
                                                            <label for="case_name" class="form-label">Case Name</label>
                                                            <input type="text" class="form-control  <?php $__errorArgs = ['case_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="case_name" name="case_name" required placeholder="ex. Vandalism">
                                                            <?php $__errorArgs = ['case_name'];
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
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Add</a>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal for edit -->
                                    <div class="modal fade" id="edit<?php echo e($kp->article_no); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit <b>Article No. <?php echo e($kp->article_no); ?></b></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="<?php echo e(route('blotter.editKP', $kp->article_no)); ?>" enctype="multipart/form-data">
                                                        <?php echo csrf_field(); ?>
                                                        <!--
                                                        <div class="mb-3">
                                                            <label for="article_no" class="form-label">Article No</label>
                                                            <input type="number" class="form-control  <?php $__errorArgs = ['article_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="article_no" name="article_no" value="<?php echo e($kp->article_no); ?>" required>
                                                            <?php $__errorArgs = ['article_no'];
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
                                                         -->
                                                        <div class="mb-3">
                                                            <label for="case_name" class="form-label">Case Name</label>
                                                            <input type="text" class="form-control  <?php $__errorArgs = ['case_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="case_name" name="case_name" value="<?php echo e($kp->case_name); ?>" required>
                                                            <?php $__errorArgs = ['case_name'];
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
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</a>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>

                            </table>
                            <?php echo e($kp_cases->links()); ?>

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

</html><?php /**PATH D:\xampp\htdocs\barrio\resources\views/blotter/kp_case.blade.php ENDPATH**/ ?>