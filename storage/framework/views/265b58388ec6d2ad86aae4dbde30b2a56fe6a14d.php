<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, [] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
  <?php $__env->startSection('title', 'Layout | Station Info'); ?>
    <!-- component -->

<section class="relative pt-13 bg-blueGray-50 max-h-screen overflow-hidden">
<div class="container mx-4"> 
  <div class="flex flex-wrap w-screen content-between items-center">
    <div class="w-10/12 md:w-6/12 mb-32 lg:w-4/12 px-12 md:px-4 mr-auto ml-auto -mt-78">
      <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg bg-gray-300">
        <?php if(is_null($station->line)): ?>
        <?php
        $typereq = $stType->where('name', '=', $station->type);
        $index = $typereq->keys()[0];
        $sttype = $typereq[$index];
        ?>
        <img alt="..." src="/assets/images/machines/<?php echo e($sttype->icon); ?>" class="w-1/4 align-middle rounded-t-lg rotate-90 align-center self-center">
        <?php endif; ?>
        <h1 class="text-center font-semibold text-md">Station Details</h1>
        <ul class="border border-gray-200 rounded overflow-hidden shadow-md text-left">
            
            
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Station name: </span><?php echo e($station->name); ?></li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Station type: </span> <?php echo e($station->type); ?></li>
            <?php if($station->line!==null): ?>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Station line: </span> <?php echo e($station->line); ?></li>
            <?php endif; ?>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Serial number: </span> <?php echo e($station->SN); ?></li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Station supplier: </span> <?php echo e($station->supplier); ?></li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Main Ip Address: </span> <?php echo e($station->mainIpAddr); ?> 
              <?php
                $ip = $station->mainIpAddr;
                $ping = exec('ping -n 1 '.$ip, $output, $status);
                if($status == 1){
                    echo  '<i class="fa-solid fa-circle w-2/12 text-xs text-red-600 text-right">offline</i>';
                }elseif ($status == 0) {
                    echo  '<i class="fa-solid fa-circle  w-2/12 text-xs text-green-500 text-right">Live</i>';
                }else{
                  echo  '<i class="fa-solid fa-circle  w-2/12 text-xs text-orange-500 text-right">Error</i>';
                }
                ?>
            </li>
            <?php if(!is_null($station->switch)): ?>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Switch: </span> <?php echo e($station->switch); ?> 
            <?php endif; ?>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Port: </span> <?php if(!$station->port): ?>there's no port <?php endif; ?><?php echo e($station->port); ?></li>
            <li class="px-4 py-3 bg-white border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Description: </span> <?php if(!$station->description): ?>there's no description <?php endif; ?><?php echo e($station->description); ?></li>
        </ul>
      </div>
    </div>

    <div class="w-screen h-screen md:w-6/12">
      <div class="flex flex-wrap h-fit">
        <div class="w-full md:w-6/12 px-4">
          <div class="relative flex flex-col mt-4 ">
            <div class="px-4 py-5 flex-auto">
              <h6 class="text-xl mb-1 font-semibold">About connected switch</h6>
              <ul class="border border-gray-200 rounded overflow-hidden shadow-md text-left">         
                <?php if(isset($switch) && isset($cabinet)): ?>
                <li class="px-4 py-3 border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Cabinet name: </span> <?php echo e($cabinet->name); ?></li>
                <li class="px-4 py-3 border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Cabinet zone: </span> <?php echo e($cabinet->zone); ?></li>
                <li class="px-4 py-3 border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Switch ip address: </span> <?php echo e($switch->ipAddr); ?></li>
                <li class="px-4 py-3 border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">Switch number of ports: </span> <?php echo e($switch->portsNum); ?></li>
                <?php else: ?>
                <li class="px-4 py-3 border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out"><span class="text-md text-black pr-6 ">There's no switch / cabinet </span></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="relative flex flex-col min-w-full w-auto h-fit">
      <div class="py-5 flex-auto ">
              <div class="text-blueGray-500 p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-white">
                <i class="fas fa-sitemap"></i>
              </div>
            <h6 class="text-xl mb-1 font-semibold">
              Connected Equipments
            </h6> 
            <div class="relative flex flex-col mt-4  h-56 overflow-auto">
              <div class="px-4 py-5 flex-auto">
                <ul class="border border-gray-200 rounded shadow-md text-left">         
                  <?php if($equipments == []): ?>
                  <li>there are no equipments</li>
                  <?php else: ?>
                  <?php $__currentLoopData = $equipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                  $type = $eqtype->where('name', '=', $equipment->type);
                  ?>
                  <li class="flex px-4 py-3 border-b last:border-none border-gray-200 text-gray-500 transition-all duration-300 ease-in-out">
                    <img class="w-14 h-14 rounded-full" src="/assets/images/equipments/<?php echo e($type[$type->keys()[0]]->icon); ?>">
                    <div class="block">
                    <?php echo e($equipment->name); ?>

                    <div class="flex items-center text-gray-400">
                          <?php echo e($equipment->type); ?>

                          <?php echo e($equipment->IpAddr); ?>

                          <?php
                      $ip = $equipment->IpAddr;
                      $ping = exec('ping -n 1 '.$ip, $output, $status);
                      if($status == 1){
                        echo  '<i class="fa-solid fa-circle w-1/12 m-5 text-xs text-red-600"></i>';
                      }elseif ($status == 0) {
                        echo  '<i class="fa-solid fa-circle w-1/12 m-5 text-xs text-green-500"></i>';
                      }else{
                          echo  '<i class="fa-solid fa-circle  w-1/12 m-5 text-xs text-orange-500"></i>';
                        }
                        ?>
                        </div>
                      </div>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(session()->get('username')): ?>
                    <li onclick="location.href='/equipment/<?php echo e($station->SN); ?>'" class="flex px-4 py-3 border-b last:border-none border-gray-200 hover:bg-gray-200 text-gray-500 transition-all duration-300 ease-in-out cursor-pointer">
                      &#x2b; Add a new equipment 
                    </li>
                  <?php endif; ?>
                  <?php endif; ?>
                </ul>
              </div>
            </div>
            
            
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</section>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\layout\resources\views/pages/stationInfo.blade.php ENDPATH**/ ?>