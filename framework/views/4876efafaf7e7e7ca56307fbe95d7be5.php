<?php $__env->startSection('content'); ?>
<style>
    body {
        background-color: #f8f9fa; /* Dark background color */
        font-family: 'Arial', sans-serif;
        color: #000000; /* Black text color */
    }

    .card {
        background-color: #ffffff; /* Dark card background color */
        color: #000000; /* Black text color */
        border-radius: 8px; /* Rounded corners for the card */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow effect */
        max-width: 400px; /* Set the maximum width of the card */
    }

    .card-header {
        background-color: #2c3e50; /* Facebook blue for the header */
        border-bottom: none; /* No border at the bottom of the header */
        border-top-left-radius: 8px; /* Rounded corners for the top-left of the header */
        border-top-right-radius: 8px; /* Rounded corners for the top-right of the header */
        color: #000000; /* Black text color for the header */
    }

    .btn-primary {
        background-color: #2c3e50; /* Facebook blue for the primary button */
        border-color: #3b5998; /* Matching border color */
        transition: background-color 0.3s ease; /* Smooth transition on hover */
        border-radius: 8px; /* Rounded corners for the button */
    }

    .btn-primary:hover {
        background-color: #1c2833; /* Darker blue on hover */
    }

    .form-label {
        font-weight: bold;
        color: #000000; /* Black text color for the labels */
    }

    .invalid-feedback {
        color: #dc3545; /* Red error message color */
    }
        /* Center the button */
    .btn-container {
        text-align: center;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
            <div class="card-header bg-primary text-white text-center h4"><?php echo e(__('Register')); ?></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label for="name" class="form-label"><?php echo e(__('Name')); ?></label>
                            <input id="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name')); ?>" required autocomplete="name" autofocus>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label"><?php echo e(__('Email Address')); ?></label>
                            <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email">
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label"><?php echo e(__('Password')); ?></label>
                            <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="new-password">
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label"><?php echo e(__('Confirm Password')); ?></label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="btn-container"> <!-- Center the button -->
                            <button type="submit" class="btn bg-primary text-white btn-block"><?php echo e(__('Register')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\danid\Development\project-3\p4\resources\views/auth/register.blade.php ENDPATH**/ ?>