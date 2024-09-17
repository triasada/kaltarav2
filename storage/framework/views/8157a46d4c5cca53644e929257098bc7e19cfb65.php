<!doctype html>
<html lang="en">
	<head>
		<title><?php echo $__env->yieldContent('title'); ?> - SIMJAKIDA</title>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('css/kaltara.css')); ?>">
		<link rel="icon" type="image/x-icon" href="<?php echo e(asset('img/favicon.png')); ?>">

		
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@400;700;900&display=swap" rel="stylesheet">

		
		<script src="https://kit.fontawesome.com/37c5adffc7.js" crossorigin="anonymous"></script>

		
		<?php echo $__env->yieldPushContent('css'); ?>
	</head>
	<body>
		<div class="container-fluid">
			<header>
				
				<?php echo $__env->make('layouts.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				
			</header>

			
			<div class="row">
				<div class="col-md-10 offset-md-1 pl-lg-4">
					<?php echo $__env->make('flashalert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<?php echo $__env->yieldContent('content'); ?>
				</div>
			</div>

			
			<?php echo $__env->make('layouts.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
		
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="<?php echo e(asset('js/jquery-3.3.1.min.js')); ?>"></script>
		<script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
		<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
		
		
		<script type="text/javascript">
			var baseURL = <?php echo json_encode(url('/')); ?>;	//getting base url
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		</script>

		
		<script src="<?php echo e(asset('js/front.js')); ?>"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/collect.js/4.34.3/collect.min.js"></script>
		<?php echo $__env->yieldPushContent('js'); ?>
	</body>
</html><?php /**PATH /Users/satriaptbtb/Sites/kaltara/resources/views/layouts/front.blade.php ENDPATH**/ ?>