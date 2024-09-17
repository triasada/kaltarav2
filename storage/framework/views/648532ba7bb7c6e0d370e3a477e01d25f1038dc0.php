
<?php if($message = Session::get('success')): ?>
<div class="alert alert-success alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button> 
    <strong><?php echo e($message); ?></strong>
</div>
<?php endif; ?>

<?php if($message = Session::get('error')): ?>
<div class="alert alert-danger alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button> 
  <strong><?php echo e($message); ?></strong>
</div>
<?php endif; ?>

<?php if($message = Session::get('warning')): ?>
<div class="alert alert-warning alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button> 
  <strong><?php echo e($message); ?></strong>
</div>
<?php endif; ?>

<?php if($message = Session::get('info')): ?>
<div class="alert alert-info alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button> 
  <strong><?php echo e($message); ?></strong>
</div>
<?php endif; ?>

<?php if($errors->any()): ?>
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button> 
    <ul class="m-0">
        <?php if($errors instanceof Illuminate\Support\ViewErrorBag): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <li><?php echo e($errors); ?></li>
        <?php endif; ?>
    </ul>
</div>
<?php endif; ?><?php /**PATH /Users/satriaptbtb/Sites/kaltara/resources/views/flashalert.blade.php ENDPATH**/ ?>