<?php
    $userId = Auth::user()->id;
    $name = Auth::user()->nama;
    $date = Auth::user()->created_at;
    $selectedYear = date('Y');
    if (isset($_GET['year'])) {
        $selectedYear = htmlspecialchars($_GET['year']);
    }
    ?>


<?php $__env->startSection('title', 'Profile'); ?>

        <main class="content">
            <?php $__env->startSection('content'); ?>
<br>
<div class="row">
    <div class="col-12 col-xl-8">
        <div class="card card-body border-0 shadow mb-4">
            <br>
            <h2 class="h5 mb-4">General information</h2>
            <form>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div>
                            <label for="first_name">Name</label>
                            <input class="form-control" id="first_name" type="text" placeholder=<?php echo $name ?> disabled>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div>
                            <label for="id">ID</label>
                            <input class="form-control" id="id" type="text" placeholder=<?php echo $userId ?> disabled>
                        </div>
                    </div>
                </div><br>
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3">
                        <label for="birthday">Created At</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                            </span>
                            <input data-datepicker="" class="form-control" id="birthday" type="text" placeholder=<?php echo $date ?> disabled>
                         </div>
                    </div>
                </div>
                <div class="mt-3">
                    <a class="btn btn-gray-800 mt-2 animate-up-2" href="/dashboard">Back to Dashboard</a>
                </div>
            </form>
        </div>
    </div>
    <div class="col-12 col-xl-4">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card shadow border-0 text-center p-0">
                    <div class="profile-cover rounded-top" data-background="../assets/img/profile-cover.jpg"></div>
                    <div class="card-body pb-5">
                        <img src="../../assets/img/team/profile-picture-3.png" class="avatar-xl rounded-circle mx-auto mt-n7 mb-4" alt="Neil Portrait">
                        <h4 class="h3"><?php echo $name ?></h4>
                        <h5 class="fw-normal"><?php echo $userId ?></h5>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ghifa\Documents\admin-dashboard\resources\views\pages\profile.blade.php ENDPATH**/ ?>