    <?php
        $userId = Auth::user()->id;
        $name = Auth::user()->nama;
        $selectedYear = date('Y');
        if (isset($_GET['year'])) {
            $selectedYear = htmlspecialchars($_GET['year']);
        }
        ?>



<?php $__env->startSection('title', 'Edit User'); ?>

<?php $__env->startSection('content'); ?>
    <main>
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container">
                <p class="text-center">
                    <a href="/dashboard" class="d-flex align-items-center justify-content-center">
                        <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                        </svg>
                        Back to homepage
                    </a>
                </p>
                <div class="row justify-content-center form-bg-image">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <div class="text-center text-md-center mb-4">
                                <h1 class="h3">Edit User</h1>
                            </div>
                            <form method="POST" action="<?php echo e(url('/users/update/'.$user->id)); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('POST'); ?>

                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"/>

                                <!-- User ID (Hidden) -->
                                <input type="hidden" name="id" value="<?php echo e($user->id); ?>">

                                <!-- Name -->
                                <div class="form-group mb-4">
                                    <label for="username">Your Name</label>
                                    <input type="text" name="username" class="form-control" id="username" value="<?php echo e(old('username', $user->username)); ?>" required>
                                </div>

                                <!-- Full Name -->
                                <div class="form-group mb-4">
                                    <label for="nama">Full Name</label>
                                    <input type="text" name="nama" class="form-control" id="nama" value="<?php echo e(old('nama', $user->nama)); ?>" required>
                                </div>

                                <!-- Password -->
                                <div class="form-group mb-4">
                                    <label for="password">New Password (leave blank to keep current password)</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                </div>

                                <div class="form-group mb-4">
                                    <label for="department_id">Department</label>
                                    <select name="department_id" id="department_id" class="form-control">
                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($dept->department_id); ?>" <?php echo e($user->department_id == $dept->department_id ? 'selected' : ''); ?>>
                                                <?php echo e($dept->department_name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>


                                <!-- Confirm Password -->
                                <div class="form-group mb-4">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                                </div>

                                <?php if($errors->any()): ?>
                                    <div class="alert alert-danger">
                                        <ul>
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($error); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-gray-800">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ghifa\Documents\admin-dashboard\resources\views/pages/edit-user.blade.php ENDPATH**/ ?>