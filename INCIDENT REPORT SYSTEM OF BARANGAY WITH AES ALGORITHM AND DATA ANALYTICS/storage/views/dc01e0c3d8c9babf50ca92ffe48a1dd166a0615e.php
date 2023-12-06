<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account | BARRIO</title>
    <link href="../../css/styles.css" rel="stylesheet" />
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

                <div class="row d-flex justify-content-center  p-5">
                    <div class="card p-3 shadow w-75">
                        <form method="post" action="<?php echo e(route('account.edit.store', $user->id)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row p-3">
                                <h3 class="mt-3">Edit Account</b></h3>
                                <hr>

                                <div class="row">
                                    <div class="col">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" placeholder="" class="form-control shadow-none" value="<?php echo e($user->name); ?>" name="name" id="name" required  disabled readonly>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" placeholder="" class="form-control shadow-none" value="<?php echo e($user->email); ?>" name="email" id="email" required disabled readonly>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col">
                                        <label for="user_type" class="form-label">User Type</label>
                                        <select class="form-select shadow-none  <?php $__errorArgs = ['user_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="user_type" id="user_type" required>
                                            <option selected disabled value="">-</option>
                                            <option value="1" <?php echo e($user->user_type_id == "1" ? 'selected' : ''); ?>>Lupon</option>
                                            <option value="2" <?php echo e($user->user_type_id == "2" ? 'selected' : ''); ?>>Sangguniang Barangay</option>
                                        </select>
                                    </div>

                                    <div class="col">
                                        <label for="personnel_position" class="form-label">Personnel Position</label>
                                        <select class="form-select shadow-none  <?php $__errorArgs = ['personnel_position'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="personnel_position" id="personnel_position" required>
                                            <option selected disabled value="">-</option>
                                            <option value="1" <?php echo e($user->position_id == "1" ? 'selected' : ''); ?>>Punong Barangay</option>
                                            <option value="2" <?php echo e($user->position_id == "2" ? 'selected' : ''); ?>>Secretary</option>
                                            <option value="3" <?php echo e($user->position_id == "3" ? 'selected' : ''); ?>>Sangguniang Barangay Member</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mt-3 d-md-block">
                                    <button type="submit" class="btn btn-primary ">Save Changes</button>
                                </div>

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

</html><?php /**PATH D:\xampp\htdocs\barrio\resources\views/account/edit-acc.blade.php ENDPATH**/ ?>