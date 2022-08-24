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
        <div class="container flex p-5 h-screen w-full">
            <?php $__currentLoopData = $lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div 
                style="top:<?php echo e($line->posTop); ?>px; left:<?php echo e($line->posLeft); ?>px;"
                 class="<?php echo e($line->id); ?> w-1/12 h-full flex flex-col items-center justify-center text-center md:text-md sm:text-sm text-white bg-black/40 cursor-move ">
                <h1><?php echo e($line->name); ?></h1>
                <span
                onclick="location.href='/lineInfo/<?php echo e($line->id); ?>'"
                class="bg-black w-full m-1 p-1 rounded-md hover:hover:bg-black/10 cursor-pointer ease-in-out md:text-sm sm:text-2xs"
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
                    // movement axis
                    axis: "x",
                    // container grid
                    grid: [ 6, 6 ],
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
         
            <?php if(isset($cabinets)): ?>
            <?php $__currentLoopData = $cabinets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cabinet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div 
            style="top:<?php echo e($cabinet->posTop); ?>px; left:<?php echo e($cabinet->posLeft); ?>px;"
             class="cabinet<?php echo e($cabinet->id); ?> w-1/12 h-fit flex flex-col items-center justify-center text-center md:text-md sm:text-sm text-white bg-black/40 cursor-move ">
            <h1><?php echo e($cabinet->name); ?></h1>
            <img src="/assets/images/network/switchCabinet.png" alt="cabinet" class="rounded w-full">
            
            <span
            class="bg-black w-full m-1 p-1 rounded-md hover:hover:bg-black/10 cursor-pointer ease-in-out md:text-sm sm:text-2xs"
            data-modal-toggle="cabinet<?php echo e($cabinet->name); ?>"
            >Show details</span>
            
            <div id="cabinet<?php echo e($cabinet->name); ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full cursor-default">
                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Cabinet: <?php echo e($cabinet->name); ?>

                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="cabinet<?php echo e($cabinet->name); ?>">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6 flex content-center">
                            <ul class="rounded overflow-hidden shadow-md text-left w-1/2">         
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.detailsitem','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('detailsitem'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                  <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.detailsspan','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('detailsspan'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                    Cabinet name:
                                   <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                  <?php echo e($cabinet->name); ?>

                                   <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                  
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.detailsitem','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('detailsitem'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                  <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.detailsspan','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('detailsspan'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                    Cabinet description:
                                   <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                  <?php echo e($cabinet->description); ?>

                                   <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            </ul>
                            <div>
                                <?php
                                    $switches = $switch->where('cabName', '=', $cabinet->name);
                                ?>
                                
                                <?php $__currentLoopData = $switches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $switch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-center m-3">
                                    <span class="text-black"><?php echo e($switch->switchNumber); ?></span>
                                    <img src="/assets/images/network/switch.png" alt="switch" class="w-1/2 h-1/2">
                                    <span
                                    class="bg-black w-full h-fit m-1 p-1 rounded-md hover:hover:bg-black/10 cursor-pointer ease-in-out md:text-sm sm:text-2xs"
                                    data-modal-toggle="switch<?php echo e($switch->id .$switch->cabName); ?>"
                                    >show more info</span>
                                </div>
                                
                                <div id="switch<?php echo e($switch->id .$switch->cabName); ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full cursor-default" >
                                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Switch: <?php echo e($switch->cabName . $switch->switchNumber); ?>

                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="switch<?php echo e($switch->id .$switch->cabName); ?>">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-6 space-y-6 flex content-center ">
                                                <ul class="rounded overflow-hidden shadow-md text-left w-1/2">         
                                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.detailsitem','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('detailsitem'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                                      <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.detailsspan','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('detailsspan'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                                        Switch number of ports:
                                                       <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                      <?php echo e($switch->portsNum); ?>

                                                       <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                      
                                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.detailsitem','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('detailsitem'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                                      <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.detailsspan','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('detailsspan'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                                        Switch ip address:
                                                       <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                      <?php echo e($switch->ipAddr); ?>

                                                       <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.detailsitem','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('detailsitem'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                                      <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.detailsspan','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('detailsspan'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                                        Status:
                                                       <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                      <?php
                                                      $ip = $switch->ipAddr;
                                                      $ping = exec('ping -n 1 '.$ip, $output, $status);
                                                      if($status == 1){
                                                          echo  '<i class="fa-solid fa-circle w-2/12 text-xs text-red-600 text-right">offline</i>';
                                                      }elseif ($status == 0) {
                                                          echo  '<i class="fa-solid fa-circle  w-2/12 text-xs text-green-500 text-right">Live</i>';
                                                      }else{
                                                        echo  '<i class="fa-solid fa-circle  w-2/12 text-xs text-orange-500 text-right">Error</i>';
                                                      }
                                                      ?>
                                                       <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                </ul>
                                                <div class="flex-col w-1/2 content-center text-black">
                                                    <span>Available ports</span>
                                                    <?php
                                                    // specifying the collected ports
                                                    $ports = $port->where('switchId','=',$switch->id);
                                                    
                                                    ?>
                                                    <ul class="text-black ">
                                                        <?php $__currentLoopData = $ports->keys(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li
                                                        <?php if($port[$key]->assigned !== null): ?>
                                                        class="flex justify-center text-right border-b last:border-none border-gray-300"
                                                        <?php else: ?>
                                                        class="flex justify-center text-right border-b last:border-none border-gray-300"
                                                        <?php endif; ?>
                                                        >
                                                        <?php echo e($port[$key]->portNum); ?>

                                                        <?php if($port[$key]->assigned !== null): ?>
                                                       <span class="bg-red-300 ml-3  border-gray-200 text-gray-500">used by <?php echo e($port[$key]->assignedTo); ?></span>
                                                       <?php else: ?>
                                                       <span class="bg-green-300 ml-3 border-gray-200 text-gray-500 ">free</span>
                                                        <?php endif; ?>
                                                        </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
            <form action="/cabinetPos" method="POST">
                <?php echo csrf_field(); ?>
                </form>
                <script type="text/javascript">
                    $(document).ready(function(){
                    // making the DOM element with a specific class draggable
                    $('.cabinet<?php echo e($cabinet->id); ?>').draggable({
                    // return to original position
                    <?php if(!session()->get('username')): ?>
                        revert: true,
                    <?php endif; ?>
                    //container aka walls
                    // containment: 'main',
                    // scroll
                    scroll: true, scrollSensitivity: 50,
                    // container grid
                    grid: [ 6, 6 ],
                    // execute a function on stop drag
                    <?php if(session()->get('username')): ?>
                    stop: function(event,ui){
                        // get the position of the selected element
                        dragposition = ui.position;
                        var inputdrag = '<input type="hidden" id="poscabinet<?php echo e($cabinet->id); ?>" value="'+dragposition.left+','+dragposition.top+'"/>'
                        if ($('#poscabinet<?php echo e($cabinet->id); ?>').length){
                            $('#poscabinet<?php echo e($cabinet->id); ?>').remove();
                            $('.cabinet<?php echo e($cabinet->id); ?> form').append(inputdrag);
                            }else{
                            $('.cabinet<?php echo e($cabinet->id); ?> form').append(inputdrag);
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
                            url: `/cabinetPos/<?php echo e($cabinet->id); ?>`,
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
                <?php endif; ?>
        </div>


 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\layout\resources\views/pages/assembly.blade.php ENDPATH**/ ?>