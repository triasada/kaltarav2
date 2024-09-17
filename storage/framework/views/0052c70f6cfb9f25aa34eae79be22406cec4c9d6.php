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
        <a href="<?php echo e(route('page.create')); ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Create Page</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Summary</th>
                        <th>Created At</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!$pages->count()): ?>
                        <tr>
                            <td class="text-center" colspan="7">There is no page now</td>
                        </tr>
                    <?php endif; ?>
                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($page->title); ?></td>
                            <td><?php echo e($page->summary); ?></td>
                            <td><?php echo e($page->created_at->toDateTimeString()); ?></td>
                            <td>
                                <a href="<?php echo e(route('page.edit', [$page->id])); ?>" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                <form action="<?php echo e(route('page.destroy', [$page->id])); ?>" method="post">
                                    <?php echo method_field('delete'); ?>
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-xs btn-danger mt-1"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div id="pagination">
                <?php echo e($pages->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/satriaptbtb/Sites/kaltara/resources/views/pages/index.blade.php ENDPATH**/ ?>