<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, [] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('title', 'Layout | Injection layout'); ?>
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
            <?php
                $index = $type->where('name', '=', $station->type)->keys()[0];
                $stType = $type->where('name', '=', $station->type)[$index];
            ?>
            <img src="/assets/images/machines/<?php echo e($stType->icon); ?>" alt="<?php echo e($station->name); ?>" class="m-auto p-0 object-fit ">
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

</div>

<div class="flex place-content-evenly w-full mb-24">

        
    <div class="top-container w-full h-fit border-2 border-current mx-auto mx-1 grid gap-6 grid-cols-12 grid-rows-1 p-5 h-screen place-items-center flex ">
        
        <?php $__currentLoopData = $stations->skip(4)->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $station): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div 
            style="<?php echo e($station->posTop); ?>px; left:<?php echo e($station->posLeft); ?>px;"
             class="<?php echo e($station->SN); ?> w-28 h-56 p-3 mx-5 z-0 text-xs flex-col items-center justify-center text-center text-white bg-black/40 hover:bg-black/10 cursor-pointer hover:text-violet-900">
            <div
            onclick="location.href='/stationInfo/<?php echo e($station->name); ?>'"
             class="flex items-center justify-center">
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
            
            <img src="/assets/images/machines/<?php echo e($stType->icon); ?>" alt="<?php echo e($station->name); ?>" class="m-auto p-0 object-fit ">
        </div>
<form action="/stationPos" method="POST">
<?php echo csrf_field(); ?>
</form>
<script type="text/javascript">
$(document).ready(function(){
// making the DOM element with a specific class draggable
$('.<?php echo e($station->SN); ?>').draggable({
// return to original position
// revert: true,
//container aka walls
containment: '.top-container',
// container grid
grid: [ 70, 80 ],
// execute a function on stop drag
stop: function(event,ui){
// get the position of the selected element
dragposition = ui.position;
var inputdrag = '<input type="hidden" id="pos<?php echo e($station->SN); ?>" value="'+dragposition.left+','+dragposition.top+'"/>'
    if ($('#pos<?php echo e($station->SN); ?>').length){
    $('#pos<?php echo e($station->SN); ?>').remove();
    $('.<?php echo e($station->SN); ?> form').append(inputdrag);
    }else{
    $('.<?php echo e($station->SN); ?> form').append(inputdrag);
    }
// ajax send data from the hidden input
// create an array -> split input values into 3 array indexes
let data = [];
data.push(dragposition.top);
data.push(dragposition.left);
let token = "<?php echo e(csrf_token()); ?>";
$.ajax({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},
url: `stationPos/<?php echo e($station->SN); ?>`,
type: 'post',
data: {
    // _token:token,
    posTop:data[0],
    posLeft:data[1],
},
})
// stop function end
}});

})
</script>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>


</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\layout\resources\views/pages/injection.blade.php ENDPATH**/ ?>