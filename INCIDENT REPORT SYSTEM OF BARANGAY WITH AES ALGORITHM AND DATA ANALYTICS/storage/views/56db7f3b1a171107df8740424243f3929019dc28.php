<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

                <div class="row d-flex justify-content-center mt-4">
                    <div class="col-sm">

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Blotter</li>
                                <li class="breadcrumb-item active" aria-current="page">Create</li>
                            </ol>
                        </nav>

                        <img src="<?php echo e(asset('/img/385-logo.png')); ?>" class="img-fluid rounded mx-auto d-block" alt="..." width="300" height="300">

                        <div class="text-center mt-5">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="bi bi-plus-square-fill"></i> New Blotter Record
                            </button>
                        </div>


                        <?php if(session()->has('success')): ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Blotter created successfully',
                                footer: '<a href="/home">Return to home</a>'
                            })
                        </script>
                        <?php else: ?>
                        <?php endif; ?>


                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Create a Blotter Record</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">


                                        <!-- card -->
                                        <div class="card p-3">
                                            <h2 class="mt-3">Blotter Record</h2>

                                            <p class="card-text mb-3">Please fill out all the fields below and click on the "Submit" button to save the blotter record to the database.</p>
                                            <hr>

                                            <!-- form -->
                                            <form method="POST" action="<?php echo e(route('blotter.store')); ?>" enctype="multipart/form-data" id="form">
                                                <?php echo csrf_field(); ?>
                                                <div class="mb-3" id="textboxDiv">
                                                    <label for="complainant" class="form-label">Complainant(s)</label>
                                                    <!-- <button type="button" class="btn btn-light btn-sm" id="addComplainant">Add another complainant</button>
                                                    <button type="button" class="btn btn-light btn-sm" id="Remove">Remove</button> -->
                                                    <div class="row">
                                                        <div class="col-sm-1 mb-1">
                                                            <select class="form-select shadow-none  <?php $__errorArgs = ['salutation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="salutation" id="salutation" required>

                                                                <option selected disabled>Salutation</option>
                                                                <option value="Mr." <?php echo e(old('salutation') == "Mr." ? 'selected' : ''); ?>>Mr.</option>
                                                                <option value="Ms." <?php echo e(old('salutation') == "Ms." ? 'selected' : ''); ?>>Ms.</option>
                                                                <option value="Mrs." <?php echo e(old('salutation') == "Mrs." ? 'selected' : ''); ?>>Mrs.</option>
                                                                <option value="">--prefer not to say--</option>
                                                            </select>
                                                        </div>

                                                        <div class="col">
                                                            <input type="text" placeholder="Last name" class="form-control shadow-none  <?php $__errorArgs = ['lastname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('lastname')); ?>" name="lastname" id="lastname" required>
                                                            <?php $__errorArgs = ['lastname'];
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
                                                            <input type="text" placeholder="First name" class="form-control shadow-none  <?php $__errorArgs = ['firstname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('firstname')); ?>" name="firstname" id="firstname" required>
                                                            <?php $__errorArgs = ['firstname'];
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
                                                            <input type="text" placeholder="Middle name" class="form-control shadow-none  <?php $__errorArgs = ['middlename'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('middlename')); ?>" name="middlename" id="middlename" required>
                                                            <?php $__errorArgs = ['middlename'];
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
                                                </div>


                                                <div class="mb-3">
                                                    <label for="case" class="form-label">Incident Case</label>
                                                    <select class="form-select shadow-none  <?php $__errorArgs = ['case'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="case" id="case" required>
                                                        <option selected disabled>Verify the incident report case</option>
                                                        <?php $__currentLoopData = $kp_cases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($case->article_no); ?>" <?php echo e(old('case') == $case->article_no ? 'selected' : ''); ?>><?php echo e($case->article_no); ?> - <?php echo e($case->case_name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>

                                                </div>

                                                <div class="mb-3">
                                                    <label for="complaint_desc" class="form-label">Description of Violation</label>
                                                    <textarea class="form-control shadow-none  <?php $__errorArgs = ['complaint_desc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('complaint_desc')); ?>" name="complaint_desc" id="complaint_desc" required><?php echo e(old('complaint_desc')); ?></textarea>
                                                    <?php $__errorArgs = ['complaint_desc'];
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
                                                    <label for="relief_desc" class="form-label">Relief/s Asked</label>
                                                    <textarea class="form-control shadow-none  <?php $__errorArgs = ['relief_desc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('relief_desc')); ?>" name="relief_desc" id="relief_desc" required><?php echo e(old('relief_desc')); ?></textarea>
                                                    <?php $__errorArgs = ['relief_desc'];
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

                                                <div class="mb-3" id="textboxDiv">
                                                    <label for="respondent" class="form-label">Respondent(s)</label>
                                                    <!--<button type="button" class="btn btn-light btn-sm" id="addComplainant">Add another respondent</button>
                                                     <button type="button" class="btn btn-light btn-sm" id="Remove">Remove</button> -->
                                                    <div class="row">
                                                        <div class="col-sm-1 mb-1">
                                                            <select class="form-select shadow-none  <?php $__errorArgs = ['salutation_res'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="salutation_res" id="salutation_res" required>
                                                                <option selected disabled>Salutation</option>
                                                                <option value="Mr." <?php echo e(old('salutation') == "Mr." ? 'selected' : ''); ?>>Mr.</option>
                                                                <option value="Ms." <?php echo e(old('salutation') == "Ms." ? 'selected' : ''); ?>>Ms.</option>
                                                                <option value="Mrs." <?php echo e(old('salutation') == "Mrs." ? 'selected' : ''); ?>>Mrs.</option>
                                                                <option value="">--prefer not to say--</option>
                                                            </select>
                                                        </div>
                                                        <div class="col">
                                                            <input type="text" placeholder="Last name" class="form-control shadow-none  <?php $__errorArgs = ['lastname_res'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('lastname_res')); ?>" name="lastname_res" id="lastname_res" required>
                                                            <?php $__errorArgs = ['lastname_res'];
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
                                                            <input type="text" placeholder="First name" class="form-control shadow-none  <?php $__errorArgs = ['firstname_res'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('firstname_res')); ?>" name="firstname_res" id="firstname_res" required>
                                                            <?php $__errorArgs = ['firstname_res'];
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
                                                            <input type="text" placeholder="Middle name" class="form-control shadow-none  <?php $__errorArgs = ['middlename_res'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('middlename_res')); ?>" name="middlename_res" id="middlename_res" required>
                                                            <?php $__errorArgs = ['middlename_res'];
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
                                                </div>

                                                <div class="mb-3">
                                                    <label for="date_of_incident" class="form-label">Date of Incident</label>
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
                                                    <label for="file" class="form-label">Complainant(s) Digital Signature</label>
                                                    <input type="file" class="form-control shadow-none  <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" onchange="loadFile(event)" name="file" required>
                                                    <img id="previewImg" alt="digital signature" style="max-width:15rem; margin-top:2rem;">
                                                    <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <small id="helpId" class="form-text text-danger"><?php echo e($message); ?></small>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    <script>
                                                        var loadFile = function(event) {
                                                            var previewImg = document.getElementById('previewImg');
                                                            previewImg.src = URL.createObjectURL(event.target.files[0]);
                                                            previewImg.onload = function() {
                                                                URL.revokeObjectURL(previewImg.src) // free memory
                                                            }
                                                        };
                                                    </script>
                                                </div>
                                                <!--
                                                <div class="mb-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault">Signed by the Punong Barangay</label>
                                                    </div>
                                                </div>
                                                -->
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-warning ">Create Blotter Report</button>
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DYNAMICALLY ADD ANOTHER COMPLAINANT
    <script>
        $(document).ready(function() {
            $("#addComplainant").on("click", function() {
                newRowAdd = '<div class="row mt-2"> <div class="col"> <input type="text" placeholder="Last name" class="form-control shadow-none name="lastname" id="lastname"> </div> <div class="col"> <input type="text" placeholder="First name" class="form-control shadow-none name="firstname" id="firstname"> </div> <div class="col"> <input type="text" placeholder="Middle name" class="form-control shadow-none name="middlename" id="middlename"> </div> </div>';


                $("#textboxDiv").append(newRowAdd);
            });
            $("#Remove").on("click", function() {
                $("#textboxDiv").children().last().remove();
            });
        });
    </script>
    -->

</body>

</html><?php /**PATH D:\xampp\htdocs\barrio\resources\views/blotter/create.blade.php ENDPATH**/ ?>