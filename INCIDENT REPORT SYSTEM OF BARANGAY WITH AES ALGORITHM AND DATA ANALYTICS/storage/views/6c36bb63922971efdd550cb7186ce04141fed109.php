<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amicable Settlement Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body style=" font-family: 'Times New Roman', serif !important;">
    <!-- Page content-->
    <div class="container-fluid">
        <div class="text-center">
            <img src="<?php echo e(public_path('img/tanyaglogo.png')); ?>" style="width:125px; height:125px" class="rounded img-fluid" alt="Barangay Tanyag"> <br><br>
        </div>
        <div class="row">

            <p class="text-center">Republic of the Philippines <br>
                Province of Metro Manila <br>
                CITY/MUNICIPALITY OF TAGUIG <br>
                Barangay Tanyag <br>
                OFFICE OF THE LUPONG TAGAPAMAYAPA <br><br>
                </p>
                </div>
        
        <div class="col-2">
        Control No. <b><?php echo e($blotter_report->case_no); ?></b> 
        <br></br>
        </div>

        <div class="row">
            <div class="col-2">
                <u><b><?php echo e($complainant->salutation); ?> <?php echo e($complainant->first_name); ?> <?php echo e($complainant->middle_name); ?> <?php echo e($complainant->last_name); ?></b></u><br>
                Complainant <br> <br>

                --- against --- <br><br>

                <u><b><?php echo e($respondent->salutation); ?> <?php echo e($respondent->first_name); ?> <?php echo e($respondent->middle_name); ?> <?php echo e($respondent->last_name); ?></b></u><br>
                Respondent <br><br><br>
            </div>

            <div class="col-2">
                Barangay Case No. <b><?php echo e($kp_case->article_no); ?></b> <br>
                For: <b><?php echo e($kp_case->case_name); ?></b> <br>
            </div>

        </div>

        <div class="row mt-3">
            <p class="h5 text-center fw-bold">AMICABLE SETTLEMENT</p>
        </div>

        <div class="row">
            <p class="lh-lg">We, complainant/s and respondent/s in the above-captioned case, do hearby agree to settle our dispute as follows:
                <br><b><u> <?php echo e($amicable_settlement->agreement_desc); ?>. </u></b>
            </p>
            <p class="lh-lg">and bind ourselves to comply honestly and faithfully with the above terms of settlement.</p>
            <p class="lh-lg">Entered in this <b><?php echo e(date('jS', strtotime($amicable_settlement->date_agreed))); ?></b> day of <b><?php echo e(date('F', strtotime($amicable_settlement->date_agreed))); ?></b>, <b><?php echo e(date('Y', strtotime($amicable_settlement->date_agreed))); ?></b>.</p>

            <div class="row">
                <div class="col-2">
                    Complainant<br>
                    <u><b><?php echo e($complainant->salutation); ?> <?php echo e($complainant->first_name); ?> <?php echo e($complainant->middle_name); ?> <?php echo e($complainant->last_name); ?></b></u>
                </div>

                <div class="col-2">
                    Respondent<br>
                    <u><b><?php echo e($respondent->salutation); ?> <?php echo e($respondent->first_name); ?> <?php echo e($respondent->middle_name); ?> <?php echo e($respondent->last_name); ?></b></u>
                </div>
            </div>

            <div class="row mt-3">
                <p class="text-center text-uppercase">ATTESTATION</p>
                <p class="lh-lg">I hereby certify that the foregoing amicable settlement was entered into by the parties freely and voluntarily, after I had explained to them the nature and consequence of such settlement.</p>
                <p class="lh-lg">__________________________ <br>Punong Barangay/Pangkat Chairman</p>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html><?php /**PATH C:\Users\eplum\Desktop\BRGY TANYAG\resources\views/blotter/pdf/amicable-settlement.blade.php ENDPATH**/ ?>