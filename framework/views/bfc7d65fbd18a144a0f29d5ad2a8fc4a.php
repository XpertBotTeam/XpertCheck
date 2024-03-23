<?php $__env->startSection('content'); ?>
<style>
    body {
        background-color: #f8f9fa; /* Light background color */
        font-family: 'Arial', sans-serif;
        color: #000000; /* Black text color */
    }

    .card {
        background-color: #ffffff; /* Darker card background color */
        color: #000000;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #2c3e50; /* Darker header color */
        border-bottom: none;
    }

    .btn-primary {
        background-color: #2c3e50; /* Custom dark button color */
        border-color: #2c3e50;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #1c2833; /* Darker hover state color */
    }

    .form-label {
        font-weight: bold;
        color: #000000; /* Black label text color */
    }

    .invalid-feedback {
        color: #e74c3c; /* Red error message color */
    }

    .btn-link {
        color: #2c3e50; /* Custom dark link color */
    }

    .btn-link:hover {
        text-decoration: underline;
    }

    /* Center the button */
    .btn-container {
        text-align: center;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0">
                <div class="card-header bg-primary text-white text-center h4"><?php echo e(__('Login')); ?></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('login')); ?>" class="needs-validation" novalidate>
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label for="email" class="form-label"><?php echo e(__('Email Address')); ?></label>
                            <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
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
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password">
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="remember"><?php echo e(__('Remember Me')); ?></label>
                        </div>

                        <div class="btn-container"> <!-- Center the button -->
                            <button type="submit" class="btn bg-primary text-white btn-block"><?php echo e(__('Login')); ?></button>
                        </div>

                        <div class="text-center">
                            <?php if(Route::has('password.request')): ?>
                                <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>"><?php echo e(__('Forgot Your Password?')); ?></a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\danid\Development\project-3\p4\resources\views//auth/login.blade.php ENDPATH**/ ?>