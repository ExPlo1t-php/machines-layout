<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, [] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('title', 'Layout | Home'); ?>
    <div class="container mx-auto flex-col items-center justify-center text-center px-2">
        <h2 class="text-center py-8 text-4xl">welcome to the layout</h2>
        <p class="w-auto m-auto">A quick and easy way to check the company's layout, <br> machines/stations placement or status, connected ports, switch cabinet placement .... etc</p>
    </div>
    <style>
.inj{
    background: url(/assets/images/injection2.jpg);
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
.assm{
    background: url(/assets/images/assembly2.jpg);
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.bg-text {
  background-color: rgba(0,0,0, 0.7); /* Black w/opacity/see-through */
  color: white;
  font-weight: bold;
  border: 3px solid #f1f1f1;
  z-index: 0;
  padding: 20px;
  text-align: center;
}

.bg-text:hover{
    background-color: rgba(0,0,0, 0.25); 
    cursor: pointer;
}
    </style>
    <div class="flex justify-around my-10 items-center overflow-hidden">
        <div onclick="location.href='/injection'" class="inj bg-cover m-10 w-1/2 h-full text-white py-24 px-10 object-fill rounded-lg text-center flex justify-center">
                <span class="bg-text font-bold text-lg uppercase text-black">Injection Layout</span>
         </div>
        <div onclick="location.href='/assembly'" class="assm bg-cover m-10 w-1/2 h-full text-white py-24 px-10 object-fill rounded-lg text-center flex justify-center">
             <span class="bg-text font-bold text-lg uppercase text-black text-center">Assembly Lines Layout</span>
         </div>
    </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\layout\resources\views/pages/home.blade.php ENDPATH**/ ?>