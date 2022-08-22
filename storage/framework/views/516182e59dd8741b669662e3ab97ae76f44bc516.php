<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, [] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php $__env->startSection('title', 'Layout | Line Info'); ?>
    <!-- component -->


    <?php if(isset($index[0])): ?>
    <div class="container w-full h-screen right mx-auto grid gap-3 grid-cols-2 grid-rows-1 p-5 h-screen place-items-center flex ">
        <div>
            <?php $__currentLoopData = $stations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $station): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div 
            style="top:<?php echo e($station->posTop); ?>px; left:<?php echo e($station->posLeft); ?>px;"
            class="<?php echo e($station->SN); ?> bg-white  shadow-md m-1 border border-gray-200 rounded-lg max-w-sm dark:bg-gray-800 dark:border-gray-700 cursor-move">
                <div class="p-10 ">
                    <?php
                    $url = urlencode($station->SN);   
                    ?>
                    <a href="/stationInfo/<?php echo e($url); ?>">
                    <h5 class="text-gray-900 hover:bg-gray-300 rounded text-center font-bold text-xl tracking-tight mb-2 dark:text-white"><?php echo e($station->name); ?></h5>
                    </a>
                </div>
            </div>
            <form action="/stationPos" method="POST">
                <?php echo csrf_field(); ?>
                </form>
                <script type="text/javascript">
                $(document).ready(function(){
                // making the DOM element with a specific class draggable
                $('.<?php echo e($station->SN); ?>').draggable({
                // return to original position
                <?php if(!session()->get('username')): ?>
                revert: true,
                <?php endif; ?>
                //container aka walls
                containment: '.container',  
                // container grid
                grid: [ 10 , 10 ],
                scroll: true,
                scrollSensitivity: 100,
                // execute a function on stop drag
                <?php if(session()->get('username')): ?>
                stop: function(event,ui){
                    console.log('hello');
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
                url: `/stationPos/<?php echo e($station->SN); ?>`,
                type: 'post',
                data: {
                    // _token:token,
                    posTop:data[0],
                    posLeft:data[1],
                },
                })
                // stop function end
                }
                <?php endif; ?>
            });
                
                })
                </script>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php else: ?>
<div class="flex flex-col h-32 justify-center items-center">
    <h1 class="text-center text-2xl text-bold"><?php echo e($status); ?></h1>
    <a href="/assembly" class="text-center text-cyan-400 underline text-md">go back <i class="fa-solid fa-arrow-right"></i></a>
</div>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\layout\resources\views/pages/lineInfo.blade.php ENDPATH**/ ?>