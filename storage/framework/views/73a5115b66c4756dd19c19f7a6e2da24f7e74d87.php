<?php $__env->startSection('title'); ?>
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <style>
        .summary-article{
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .title-article{
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            font-weight: 700;
            font-size: 24px;
            line-height: 1.8rem;
            color: #000
        }
        @media(min-width: 992px){
            .summary-article{
                -webkit-line-clamp: 3;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <h4 class="font-weight-bold mt-3"><?php echo e($title); ?></h4>
    <?php if($videos->count()): ?>
        <div class="row">
            <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 col-lg-4 announcement mt-3">
                    <div>
                        <a href="<?php echo e(route('gallery-video-show', [$video->id])); ?>">
                            <img src="<?php echo e($video->youtubeThumbMq); ?>" style="object-fit: cover; object-position: center; height: 200px; width: 100%">
                        </a>
                    </div>
                    <div class="mt-2">
                        <a href="<?php echo e(route('gallery-video-show', [$video->id])); ?>" class="title-article">
                            <?php echo e($video->title); ?>

                        </a>
                        <span style="font-size: 13px;"><?php echo e($video->created_at->format('d M Y')); ?></span>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-12 text-center mt-4">
                <?php echo $videos->links('vendor.pagination.bootstrap-4'); ?>

            </div>
        </div>
    <?php else: ?>
        <h5 class="text-center font-weight bold">
            There is no video now
        </h5>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/satriaptbtb/Sites/kaltara/resources/views/video/index_public.blade.php ENDPATH**/ ?>