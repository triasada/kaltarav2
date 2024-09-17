<?php $__env->startSection('title'); ?>
    <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e($title); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header text-right">
        <a href="<?php echo e(route('certification.create')); ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> New Certification</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Registration Start Date</th>
                        <th>Registration End Date</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!$certifications->count()): ?>
                        <tr>
                            <td class="text-center" colspan="7">There is no Certification now</td>
                        </tr>
                    <?php endif; ?>
                    <?php $__currentLoopData = $certifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($certification->title); ?></td>
                            <td><?php echo e($certification->start_date->toDateString()); ?></td>
                            <td><?php echo e($certification->end_date->toDateString()); ?></td>
                            <td><?php echo e($certification->registration_start_date->toDateString()); ?></td>
                            <td><?php echo e($certification->registration_end_date->toDateString()); ?></td>
                            <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Participant Certification')): ?>
                                    <a href="<?php echo e(route('certification.participants', [$certification->id])); ?>" class="btn btn-xs btn-info"><i class="fa fa-user"></i> Participant</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Certification')): ?>
                                    <a href="<?php echo e(route('certification.edit', [$certification->id])); ?>" class="btn btn-xs btn-warning mt-1"><i class="fa fa-edit"></i> Edit</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Certification')): ?>    
                                    <form action="<?php echo e(route('certification.destroy', [$certification->id])); ?>" method="post">
                                        <?php echo method_field('delete'); ?>
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-xs btn-danger mt-1"><i class="fa fa-trash"></i> Delete</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div id="pagination">
                <?php echo e($certifications->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/satriaptbtb/Sites/kaltara/resources/views/certification/index.blade.php ENDPATH**/ ?>