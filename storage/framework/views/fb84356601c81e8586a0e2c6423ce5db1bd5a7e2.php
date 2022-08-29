//index.blade.php

<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8">
    <title>Laravel Scout Search Tutorial</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">    
    </head>

   <body>
    <div class="container">
        <h1>Laravel Scout Search Tutorial</h1>
      <form method="GET" action="<?php echo e(url('index')); ?>">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Search">
                </div>
                <div class="col-md-6">
                    <button class="btn btn-info">Search</button>
                </div>
            </div>
        </form>
   <br/>
      <table class="table table-bordered">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            <?php if(count($users) > 0): ?>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($user->id); ?></td>
                    <td><?php echo e($user->name); ?></td>
                    <td><?php echo e($user->email); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <tr>
                <td colspan="3" class="text-danger">Result not found.</td>
            </tr>
            <?php endif; ?>
        </table>
   </div>
</body>
</html> <?php /**PATH C:\xampp\htdocs\layout\resources\views/index.blade.php ENDPATH**/ ?>