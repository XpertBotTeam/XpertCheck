<!-- resources/views/projects/create.blade.php -->



<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Project</div>
                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('projects.store')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label for="project_name">Project Name</label>
                                <input type="text" id="project_name" name="project_name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" id="end_date" name="end_date" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-control" required>
                                    <option value="active">Active</option>
                                    <option value="completed">Completed</option>
                                    <option value="on_hold">On Hold</option>
                                </select>
                            </div>

                            <!-- Add more fields as needed -->

                            <button type="submit" class="btn btn-primary">Create Project</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\danid\Development\project-3\p4\resources\views//user/Client/createProject.blade.php ENDPATH**/ ?>