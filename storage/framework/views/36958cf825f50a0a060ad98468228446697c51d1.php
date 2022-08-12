<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, [] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('title', 'Layout | Assembly lines layout'); ?>
    <link rel="stylesheet" href="/css/draggable.css">
    <div class="flex">
        <div class="container mx-auto grid gap-4 col-start-1 row-start-1 grid-cols-8 grid-rows-1 p-5 h-screen">
            <?php $__currentLoopData = $lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div 
                style="top:<?php echo e($line->posTop); ?>px; left:<?php echo e($line->posLeft); ?>px;"
                 class="<?php echo e($line->id); ?> w-2/3 h-full mx-5 z-0 flex items-center justify-center text-center text-white bg-black/40 cursor-move">
                <h1><?php echo e($line->name); ?></h1>
                <span
                onclick="location.href='/lineInfo/<?php echo e($line->id); ?>'"
                class="bg-black w-full m-2 p-1 rounded-md hover:hover:bg-black/10 cursor-pointer ease-in-out"
                >Go to details</span>
                <form action="/linePos" method="POST">
                    <?php echo csrf_field(); ?>
                    </form>
                    <script type="text/javascript">
$(document).ready(function(){
// making the DOM element with a specific class draggable
$('.<?php echo e($line->id); ?>').draggable({
// return to original position
<?php if(!session()->get('username')): ?>
    revert: true,
<?php endif; ?>
//container aka walls
containment: '.container',
// container grid
grid: [ 10, 10 ],
// execute a function on stop drag
<?php if(session()->get('username')): ?>
stop: function(event,ui){
    // get the position of the selected element
    dragposition = ui.position;
    var inputdrag = '<input type="hidden" id="pos<?php echo e($line->id); ?>" value="'+dragposition.left+','+dragposition.top+'"/>'
    if ($('#pos<?php echo e($line->id); ?>').length){
        $('#pos<?php echo e($line->id); ?>').remove();
        $('.<?php echo e($line->id); ?> form').append(inputdrag);
        }else{
        $('.<?php echo e($line->id); ?> form').append(inputdrag);
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
        url: `/linePos/<?php echo e($line->id); ?>`,
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
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

</div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\layout\resources\views/pages/assembly.blade.php ENDPATH**/ ?>