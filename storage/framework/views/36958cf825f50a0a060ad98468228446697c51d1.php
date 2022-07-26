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
    <div class="flex">
        <div class="container left mx-auto grid gap-4 grid-cols-8 grid-rows-1 p-5 h-screen">
            <div class="p1mt w-full h-full mx-5 z-0 flex items-center justify-center text-center text-white bg-teal-800">
                <h1>1</h1>
            </div>
            <div class="p2x w-full h-full mx-5 z-1 flex items-center justify-center text-center text-white bg-teal-600">
                <h1>2</h1>
            </div>
            <div class="xji w-full h-full mx-5 z-2 flex items-center justify-center text-center text-white bg-red-800">
                <h1>3</h1>
            </div>
            <div class="xjk w-full h-full mx-5 z-3 flex items-center justify-center text-center text-white bg-orange-600">
                <h1>4</h1>
            </div>
        </div>
        <div class="container right  mx-auto grid gap-4 grid-cols-8 grid-rows-1 p-5 h-screen">
            <div class="p1mt w-full h-full mx-5 z-0 flex items-center justify-center text-center text-white bg-teal-800">
        <h1>P1MT</h1>
    </div>
    <div class="p2x w-full h-full mx-5 z-1 flex items-center justify-center text-center text-white bg-teal-600">
        <h1>P2X</h1>
    </div>
    <div class="xji w-full h-full mx-5 z-2 flex items-center justify-center text-center text-white bg-red-800">
        <h1>XJI</h1>
    </div>
    <div class="xjk w-full h-full mx-5 z-3 flex items-center justify-center text-center text-white bg-orange-600">
        <h1>XJK</h1>
    </div>
</div>

</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\layout\resources\views/pages/assembly.blade.php ENDPATH**/ ?>