<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="bg-gray-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <link rel="icon" href="/assets/images/Logo-white.png" type="image/x-icon">
        <title><?php echo $__env->yieldContent('title', 'Layout | Unknown'); ?></title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="/assets/fontawesome/css/all.css">

        <!-- Custom style -->
        <link rel="stylesheet" href="/css/tips.css">
        <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
        <link rel="stylesheet" href="/css/draggable.css">
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.1/dist/flowbite.min.css" />

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
        <script src="/js/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js" integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen max-h-full bg-gray-100">
            <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- Page Content -->
            <main>
                <?php echo e($slot); ?>

            </main>
        </div>
        <!-- Scripts -->
        <script src="/js/delete.js"></script>
        <script src="/js/hideStuff.js"></script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\layout\resources\views/layouts/app.blade.php ENDPATH**/ ?>