<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, [] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <link rel="stylesheet" href="/css/draggable.css">
    
    <div class="flex place-content-evenly grid grid-cols-2 gap-4 w-full mb-24">

        
    <div class="container w-full h-fit left border-2 border-current mx-auto ml-1 grid gap-6 grid-cols-6 grid-rows-1 p-5 h-screen place-items-center flex ">
        
        
        <?php $__currentLoopData = $stations->skip(0)->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $station): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div onclick="location.href='/stationInfo/<?php echo e($station->name); ?>'" class="<?php echo e($station->name); ?> w-28 h-56 p-3 mx-5 z-0 text-xs flex-col items-center justify-center text-center text-white bg-black/40 hover:bg-black/10 cursor-pointer hover:text-violet-900">
            <div class="flex items-center justify-center">
                <h1><?php echo e($station->name); ?></h1>
                <?php
                    $ip = $station->mainIpAddr;
                    $ping = exec('ping -n 1 '.$ip, $output, $status);
                    if($status == 1){
                        echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-red-600"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }elseif ($status == 0) {
                        echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-green-500"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }else{
                        echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-orange-500"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }
                    ?>
            </div>
            <h1><?php echo e($station->mainIpAddr); ?></h1>
            
            
            <img src="/assets/images/machines/bnb.png" alt="<?php echo e($station->name); ?>" class="m-auto p-0 object-fit ">
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
    <div class="container w-full h-fit right border-2 border-current mx-auto ml-1 grid gap-6 grid-cols-6 grid-rows-1 p-5 h-screen place-items-center flex ">
        <?php $__currentLoopData = $stations->skip(4)->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $station): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div onclick="location.href='/stationInfo/<?php echo e($station->name); ?>'" class="<?php echo e($station->name); ?> w-28 h-56 p-3 mx-5 z-0 text-xs flex-col items-center justify-center text-center text-white bg-black/40 hover:bg-black/10 cursor-pointer hover:text-violet-900">
            <div class="flex items-center justify-center">
                <h1><?php echo e($station->name); ?></h1>
                <?php
                    $ip = $station->mainIpAddr;
                    $ping = exec('ping -n 1 '.$ip, $output, $status);
                    if($status == 1){
                        echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-red-600"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }elseif ($status == 0) {
                        echo  '<i class="fa-solid fa-circle text-green-500"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }else{
                        echo  '<i class="fa-solid fa-circle text-orange-500"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }
                ?>
            </div>
            <h1><?php echo e($station->mainIpAddr); ?></h1>
            
            <img src="/assets/images/machines/bnb.png" alt="<?php echo e($station->name); ?>" class="m-auto p-0 object-fit ">
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

</div>

<div class="flex place-content-evenly grid grid-cols-2 gap-4 w-full mb-24">

        
    <div class="top container w-full h-fit border-2 border-current mx-auto ml-1 grid gap-6 grid-cols-6 grid-rows-1 p-5 h-screen place-items-center flex ">
        
        
        <?php $__currentLoopData = $stations->skip(0)->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $station): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div onclick="location.href='/stationInfo/<?php echo e($station->name); ?>'" class="<?php echo e($station->name); ?> w-28 h-56 p-3 mx-5 z-0 text-xs flex-col items-center justify-center text-center text-white bg-black/40 hover:bg-black/10 cursor-pointer hover:text-violet-900">
            <div class="flex items-center justify-center">
                <h1><?php echo e($station->name); ?></h1>
                <?php
                    $ip = $station->mainIpAddr;
                    $ping = exec('ping -n 1 '.$ip, $output, $status);
                    if($status == 1){
                        echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-red-600"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }elseif ($status == 0) {
                        echo  '<i class="fa-solid fa-circle text-green-500"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }else{
                        echo  '<i class="fa-solid fa-circle text-orange-500"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }
                    ?>
            </div>
            <h1><?php echo e($station->mainIpAddr); ?></h1>
            
            
            <img src="/assets/images/machines/bnb.png" alt="<?php echo e($station->name); ?>" class="m-auto p-0 object-fit ">
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
    <div class="bot container w-full h-fit border-2 border-current mx-auto ml-1 grid gap-6 grid-cols-6 grid-rows-1 p-5 h-screen place-items-center flex ">
        <?php $__currentLoopData = $stations->skip(4)->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $station): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div onclick="location.href='/stationInfo/<?php echo e($station->name); ?>'" class="<?php echo e($station->name); ?> w-28 h-56 p-3 mx-5 z-0 text-xs flex-col items-center justify-center text-center text-white bg-black/40 hover:bg-black/10 cursor-pointer hover:text-violet-900">
            <div class="flex items-center justify-center">
                <h1><?php echo e($station->name); ?></h1>
                <?php
                    $ip = $station->mainIpAddr;
                    $ping = exec('ping -n 1 '.$ip, $output, $status);
                    if($status == 1){
                        echo  '<i class="fa-solid fa-circle w-1/12 text-xs text-red-600"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }elseif ($status == 0) {
                        echo  '<i class="fa-solid fa-circle text-green-500"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }else{
                        echo  '<i class="fa-solid fa-circle text-orange-500"></i>';
                        // echo '<p class="text-xs">'.print_r($ping).'</p>';
                    }
                ?>
            </div>
            <h1><?php echo e($station->mainIpAddr); ?></h1>
            
            <img src="/assets/images/machines/bnb.png" alt="<?php echo e($station->name); ?>" class="m-auto p-0 object-fit ">
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\layout\resources\views/pages/injection.blade.php ENDPATH**/ ?>