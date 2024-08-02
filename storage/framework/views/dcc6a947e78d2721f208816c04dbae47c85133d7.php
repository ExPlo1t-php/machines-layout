<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['active']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['active']); ?>
<?php foreach (array_filter((['active']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$classes = ($active ?? false)
            // ? 'inline-flex items-center px-1 pt-1 font-medium leading-5 text-gray-500 hover:text-purple-900 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
            ?'text-indigo-500 cursor-pointer p-3 m-2 rounded  inline-flex items-center border border-indigo-700 text-base font-medium leading-5  focus:outline-none hover:border-indigo-700 transition duration-150 ease-in-out'
            :'text-slate-900 cursor-pointer p-3 m-2 rounded  inline-flex items-center border border-grey-700 text-base font-medium leading-5 text-gray-900 focus:outline-none hover:border-indigo-700 transition duration-150 ease-in-out'; 
?>

<a <?php echo e($attributes->merge(['class' => $classes])); ?>>
    <?php echo e($slot); ?>

</a>
<?php /**PATH C:\Users\youne\Desktop\Apps\layout\resources\views/components/dashboard-buttons.blade.php ENDPATH**/ ?>