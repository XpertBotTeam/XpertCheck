<!-- resources/views/employees/index.blade.php -->



<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body bg-light">
                        <a href="<?php echo e(route('createEmployee')); ?>" class="btn btn-primary mt-3">Add Employee</a>
                        <a href="<?php echo e(route('createProject')); ?>" class="btn btn-primary mt-3">Add Project</a>
                    </div>
                    <div class="card-header bg-primary text-white">Employee List</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(auth()->guard()->check()): ?>
                                        <?php if($employee->client_id == auth()->id()): ?>
                                            <tr>
                                                <td><?php echo e($employee->name); ?></td>
                                                <td><?php echo e($employee->email); ?></td>
                                                <td><?php echo e($employee->salary); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-header bg-success text-white">Project List</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Project Name</th>
                                    <th>Description</th>
                                    <th>Start Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(auth()->guard()->check()): ?>
                                        <?php if($project->client_id == auth()->id()): ?>
                                            <tr>
                                                <td><a href="<?php echo e(route('projectDetails', ['id' => $project->id])); ?>"><?php echo e($project->project_name); ?></a></td>
                                                <td><?php echo e($project->description); ?></td>
                                                <td><?php echo e($project->start_date); ?></td>
                                                <td><?php echo e($project->status); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\danid\Development\project-3\p4\resources\views//user/Client/index.blade.php ENDPATH**/ ?>