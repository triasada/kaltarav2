<?php $__env->startSection('title'); ?>
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <h4 class="font-weight-bold mt-3"><?php echo e($title); ?></h4>
    <div class="row mt-4">
        <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4">
                <a href="<?php echo e(route('photo-gallery.show', [$content->gallery->id])); ?>">
                    <img src="<?php echo e(asset($content->gallery->cover_path)); ?>" style="object-fit: cover; object-position: center; width: 100%; height: 150px;">
                </a>
                <div class="mt-2">
                    <a href="<?php echo e(route('photo-gallery.show', [$content->gallery->id])); ?>" style="font-size: 22px; color: #000; line-height: 1.8rem; font-weight: 700">
                        <?php echo e($content->gallery->title); ?>

                    </a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/satriaptbtb/Sites/kaltara/resources/views/gallery/index_public.blade.php ENDPATH**/ ?>