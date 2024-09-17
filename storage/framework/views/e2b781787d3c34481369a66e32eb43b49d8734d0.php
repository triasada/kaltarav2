<?php $__env->startSection('title'); ?>
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
    <style>
        .featured-article-left .title{
            font-weight: 700;
            font-size: 18px;
            line-height: 18px;
        }

        .featured-article-left .info{
            padding: 12px;
        }

        .featured-article-left img{
            object-fit: cover;
            object-position: center;
            width: 100%;
            height: 250px;
        }

        .title{
            color: #fff;
        }

        .title:hover{
            text-decoration: none;
            color: #fff;
        }

        .info-vertical{
            background-color: rgba(1, 1, 1, 0.6);
            z-index: 1;
            color: #FFFFFF;
            height: 100%;
            padding: 4rem 3rem;
            /* border-radius: 0 0 5px 5px; */
            position: absolute;
            width: 40%;
            left: 0;
            bottom: 0;
        }

        .info-horizontal{
            background-color: rgba(1, 1, 1, 0.6);
            z-index: 1;
            color: #FFFFFF;
            min-height: 75px;
            padding: 0.5rem 1rem;
            border-radius: 0 0 5px 5px;
            position: absolute;
            width: 100%;
            bottom: 0;
        }

        .date{
            font-size: 14px;
        }

        .border-carousel{
            border: 1px #414042 solid;
        }

        #article-carousel img{
            object-fit: cover;
            object-position: center;
            width: 100%;
            height: 230px;
        }

        #article-carousel .title{
            color: #000;
            font-weight: 700;
            font-size: 24px;
            line-height: 1.8rem;
        }

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

        .title-announcement{
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            font-weight: 700; 
            font-size: 24px; 
            line-height: 1.8rem; 
            color: #000
        }

        .title-announcement:hover{
            text-decoration: none;
            color: #000;
        }

        .summary-announcement{
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 5;
            -webkit-box-orient: vertical;
            font-size: 14px; 
            color: #000
        }
        
        .mini-announcement, .mini-announcement:hover{
            color: #212529;
            text-decoration: none;
        }

        @media(min-width: 992px){
            .featured-article-left .title{
                font-weight: 700;
                font-size: 28px;
                line-height: 38px;
            }

            .featured-article-left img{
                object-fit: cover;
                object-position: center;
                width: 100%;
                height: 500px;
            }

            .summary-article{
                -webkit-line-clamp: 3;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="row">
        <div class="col-lg-12 featured-article-left">
            <div class="position-relative">
                <div>
                    <a href="<?php echo e(route('post.read', [$latestArticle->first()->post->id, $latestArticle->first()->post->slug])); ?>">
                        <img src="<?php echo e(asset($latestArticle->first()->post->thumbnail)); ?>">
                    </a>
                </div>
                <div class="info-vertical d-none d-lg-block">
                    <a href="<?php echo e(route('post.read', [$latestArticle->first()->post->id, $latestArticle->first()->post->slug])); ?>" class="m-0 title">
                        <?php echo e(str_limit($latestArticle->first()->post->title, 70, '...')); ?>

                    </a>
                    <h6 class="date mt-lg-3 mt-2">
                        <?php echo e($latestArticle->first()->published_at->format('d M Y')); ?>

                    </h6>
                    <p>
                        <?php echo e($latestArticle->first()->post->summary); ?>

                    </p>
                </div>
                <div class="info-horizontal d-lg-none">
                    <a href="#" class="m-0 title">
                        <?php echo e($latestArticle->first()->post->title); ?>

                    </a>
                    <h6 class="date mt-lg-3 mt-2">
                        <?php echo e($latestArticle->first()->published_at->format('d M Y')); ?>

                    </h6>
                    <p class="summary-article">
                        <?php echo e($latestArticle->first()->post->summary); ?>

                    </p>
                </div>
            </div>
        </div>
    </div>
    

    
    <div style="background-color: #dfad32" class="py-3">
        <div class="row">
            <div class="col-md-2 d-flex">
                <strong class="m-auto">Pengumuman :</strong>
            </div>
            <div class="col-md-10 owl-carousel" id="announcement-carousel">
                <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('post.read', [$content->post->id, $content->post->slug])); ?>" class="mini-announcement">
                            <strong><?php echo e($content->post->title); ?></strong>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    
    
    <div style="background-color: #f1f1f1" class="py-5 px-3 my-3">
        <div class="d-none d-md-flex">
            <hr style="width: 40%; border-color: #081f4d; border-width: 2px"><h4 style="font-weight: 700; width: 20%; text-align: center">INDEX BERITA</h4><hr style="width: 40%; border-color: #081f4d; border-width: 2px">
        </div>
        <div class="d-block d-md-none text-center">
            <h4 style="font-weight: 700; width: 20%; text-align: center">INDEX BERITA</h4>
        </div>
    
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel" id="article-carousel">
                    <?php $__currentLoopData = $latestArticle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($loop->iteration > 1): ?>    
                            <div>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <a href="<?php echo e(route('post.read', [$content->post->id, $content->post->slug])); ?>">
                                            <img src="<?php echo e(asset($content->post->thumbnail)); ?>">
                                        </a>
                                    </div>
                                    <div class="col-lg-6">
                                        <a href="<?php echo e(route('post.read', [$content->post->id, $content->post->slug])); ?>" class="title-announcement">
                                            <?php echo e($content->post->title); ?>

                                        </a>
                                        <p class="mt-2 summary-announcement">
                                            <?php echo e($content->post->summary); ?>

                                        </p>
                                        <h6 class="date mt-lg-3 mt-2">
                                            <?php echo e($content->published_at->format('d M Y')); ?>

                                        </h6>
                                    </div>
                                    <div class="col-lg-1 pl-lg-0 d-none d-lg-block">
                                        <div class="w-75 h-100" style="background-color: #081f4d"></div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

    
    <div class="d-none d-md-flex mt-md-2 mb-2">
        <hr style="width: 40%; border-color: #081f4d; border-width: 2px"><h4 style="font-weight: 700; width: 20%; text-align: center">GALLERY</h4><hr style="width: 40%; border-color: #081f4d; border-width: 2px">
    </div>
    <div class="d-block d-md-none text-center">
        <h4 style="font-weight: 700; width: 20%; text-align: center">GALLERY</h4>
    </div>

    <div class="row">
        <div class="col-lg-8 pr-lg-1">
            <div>
                <a href="<?php echo e(route('photo-gallery.show', [$galleries[0]->gallery->id])); ?>">
                    <img src="<?php echo e(asset($galleries[0]->gallery->cover_path)); ?>" style="object-fit: cover; object-position: center; width: 100%; height: 400px;">
                </a>
            </div>
            <div class="mt-2">
                <a href="<?php echo e(route('photo-gallery.show', [$galleries[0]->gallery->id])); ?>" style="font-size: 24px; color: #000; line-height: 1.8rem; font-weight: 700">
                    <?php echo e($galleries[0]->gallery->title); ?>

                </a>
            </div>
        </div>
        <div class="col-lg-4 pl-lg-1">
            <div class="row h-100">
                <div class="col-12 h-50">
                    <div>
                        <a href="<?php echo e(route('photo-gallery.show', [$galleries[1]->gallery->id])); ?>">
                            <img src="<?php echo e(asset($galleries[1]->gallery->cover_path)); ?>" style="object-fit: cover; object-position: center; width: 100%; height: 150px;">
                        </a>
                    </div>
                    <div class="mt-2">
                        <a href="<?php echo e(route('photo-gallery.show', [$galleries[1]->gallery->id])); ?>" style="font-size: 22px; color: #000; line-height: 1.8rem; font-weight: 700">
                            <?php echo e($galleries[1]->gallery->title); ?>

                        </a>
                    </div>
                </div>
                <div class="col-12 h-50">
                    <div>
                        <a href="<?php echo e(route('photo-gallery.show', [$galleries[2]->gallery->id])); ?>">
                            <img src="<?php echo e(asset($galleries[2]->gallery->cover_path)); ?>" style="object-fit: cover; object-position: center; width: 100%; height: 150px;">
                        </a>
                    </div>
                    <div class="mt-2">
                        <a href="<?php echo e(route('photo-gallery.show', [$galleries[2]->gallery->id])); ?>" style="font-size: 22px; color: #000; line-height: 1.8rem; font-weight: 700">
                            <?php echo e($galleries[2]->gallery->title); ?>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $('#article-carousel').owlCarousel({
            loop: true,
            nav: false,
            dots: false,
            autoplay:true,
            autoplayTimeout:4000,
            autoplayHoverPause:false,
            responsive: {
                0: {
                    stagePadding: 30,
                    items: 1,
                    margin: 15,
                },
                600: {
                    stagePadding: 50,
                    items: 2,
                    margin: 30,
                }
            }
        });
        $('#announcement-carousel').owlCarousel({
            loop: true,
            nav: false,
            dots: false,
            items: 1,
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/satriaptbtb/Sites/kaltara/resources/views/landing.blade.php ENDPATH**/ ?>