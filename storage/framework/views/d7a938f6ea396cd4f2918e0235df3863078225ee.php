<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, [] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="container mx-auto flex-col items-center justify-center text-center px-2">
        <h2 class="text-center py-8 text-4xl">welcome to the layout</h2>
        <p class="w-auto m-auto">A quick and easy way to check the company's layout, <br> machines/stations placement or status, connected ports, switch cabinet placement .... etc</p>
    </div>
    <div class="flex justify-around my-10 items-center">
        <div onclick="location.href='/injection'" class="bg-cover backdrop-blur-sm w-1/2 h-full text-white py-24 px-10 object-fill" style="background-image: url(/assets/images/injection.png)">
            <div class="md:w-1/2">
             <p class="font-bold text-sm uppercase">Injection Layout</p>
             </div>  
         </div>
        <div onclick="location.href='/assembly'" class="bg-cover backdrop-blur-sm  w-1/3 h-full text-white py-24 px-10 object-fill hover:backdrop:brightness-0 hover:text-red-800" style="background-image: url(/assets/images/assembly.png);">
            <div class="md:w-1/2">
             <p class="font-bold text-sm uppercase">Assembly Lines Layout</p>
             </div>  
         </div>
    </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\layout\resources\views/pages/home.blade.php ENDPATH**/ ?>