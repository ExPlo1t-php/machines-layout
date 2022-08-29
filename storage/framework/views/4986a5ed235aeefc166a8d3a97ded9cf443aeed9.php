<?php $__env->startSection('title', 'Layout | New station'); ?>


<?php $__env->startSection('component'); ?>

<?php if( Session::has('success') ): ?>
        <span id="successTxt" class="text-green-500 flex self-center m-5"><?php echo e(Session::get('success')); ?></span>
<?php endif; ?>
<?php if( Session::has('error') ): ?>
        <span id="successTxt" class="text-red-500 flex self-center m-5"><?php echo e(Session::get('error')); ?></span>
<?php endif; ?>


<form class="w-full max-w-2xl flex-col self-center" method="POST" action="/addStation" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>

    <div class="flex justify-between">
      <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.formInput','data' => ['class' => 'w-full mr-3']] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('formInput'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-full mr-3']); ?>
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
          Station name
        </label>
        <input name="name" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="station name">
       <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>


    <div class="flex flex-wrap mb-6 w-full">
      <div class="w-full">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
          Station type
        </label>

        <select name="type" id="type"
        onchange="let add = document.querySelector('.add');
        if(this.options[this.selectedIndex] == add){
        window.location = add.value;
        }"
        
        class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password">
          <option value="null" selected disabled hidden >- select a station type -</option>
          
          <?php
              use App\Models\StationType;
              $types = StationType::get();
              ?>
          <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($type['name']); ?>"> <?php echo e($type['name']); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          <option class="add" value="station-type">&#x2b; Add a new station type</option>
        </select>
      </div>
    </div>
  </div>

  <div class="flex justify-between">
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.formInput','data' => ['class' => 'w-full mr-3']] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('formInput'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-full mr-3']); ?>
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
      Station's serial number
    </label>
    <input name="SN" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="serial number">
   <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

  <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.formInput','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('formInput'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
      Supplier
    </label>
    <input name="supplier" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Supplier's name">
   <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
</div>

      <script>
      // adding 3 inputs of ip if type == bmb
      $('#type').on('change', function() {
    if(this.value.toLowerCase().trim() == 'bmb'){
      var i = 3;
      for (i; i >= 1 ; i--) {
          var elem =  "<div id='ipAddr"+[i]+"' class='flex flex-wrap  mb-6'><div class='w-full'><label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-password'>ip address "+[i]+"</label><input name='ipAddr"+[i]+"' class='appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500' id='grid-password' type='text' placeholder='ip address "+[i]+"'></div></div>";
          // console.log(i);
         $(elem).insertAfter( "#ip" );
        }
    }else{
    for (let j= 3; j >= 1 ; j--) {
      $(`#ipAddr${[j]}`).remove();
      console.log(j);
    }
  }
});
    </script>
  <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.formInput','data' => ['id' => 'ip']] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('formInput'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'ip']); ?>
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
      main ip address
    </label>
    <input name="mainIpAddr" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Main ip address format(xxx.xxx.xxx.xxx)">
   <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>


  <div class="flex flex-wrap w-full">
    <div class="w-full">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        switch name
      </label>
    <select name="switch" id="switch"
    onchange="let add = document.querySelector('.add2');
    if(this.options[this.selectedIndex] == add){
    window.location = add.value;
    }"
    
    class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password">
      <option value="null" selected disabled hidden >- select a the switch connected to this station -</option>
      
      <?php
          use App\Models\CabinetSwitch;
          $switches = CabinetSwitch::get();
      ?>
      <?php $__currentLoopData = $switches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $switch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($switch['id']); ?>"> <?php echo e($switch['cabName']); ?> - <?php echo e($switch['switchName']); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      <option class="add2" value="/switch">&#x2b; Add a new switch</option>
    </select>
  </div>


  <div class="flex flex-wrap mb-6 w-full">
    <div class="w-full">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        port
      </label>
      <select name="port" id="port"
      class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password">
        <option value="null" selected disabled hidden >- select the station's port number -</option>
      </select>
      <script>
        // using the select:switch value to fetch unused ports
        $('#switch').on('change',function(){
          $value=$(this).val();
          $.ajax({
            type : 'get',
            url : '<?php echo e(URL::to('fetchFreePorts')); ?>',
            data:{'switch':$value},
            success:function(data){
              console.log(data);
              $('#port').html(data);
            }
          });
          })
          $.ajaxSetup({ headers: { 'csrftoken' : '<?php echo e(csrf_token()); ?>' } });
          </script>
    </div>
    </div>
</div>

<div class="flex flex-wrap  mb-6 w-full">
    <div class="w-full">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        Assembly line name
      </label>
      <select name="line"
      onchange="let add = document.querySelector('.add1');
      if(this.options[this.selectedIndex] == add){
      window.location = add.value;
      }"
      
      class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password">
        <option value="null" selected disabled hidden >- select a the line where this station exist -</option>
        
        <?php
            use App\Models\Line;
            $lines = Line::get();
        ?>
        <?php $__currentLoopData = $lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($line['name']); ?>"> <?php echo e($line['name']); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <option value>No station (Injection)</option>
        <option class="add1" value="/lines">&#x2b; Add a new assembly line</option>
      </select>
      
      <div class="bg-orange-100 border-l-4 border-orange-400 text-orange-700 p-2" role="alert">
        <p class="font-bold">Notice</p>
        <p>for injection stations leave this blank.</p>
      </div>
    </div>
  </div>

    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.formInput','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('formInput'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        Description
      </label>
      <textarea name="description"  cols="53" rows="10" placeholder="Write a description of this Type of this equipment (optional)" style="resize: none" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.formInput','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('formInput'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        disable ip pinging for this station
      </label>
      <input name="state" type="checkbox" class="appearance-none block text-gray-700 border border-gray-300 rounded py-2 px-2 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
      <script>
   $('input[type="checkbox"]').change(function(){
     this.value = (Number(this.checked));
   });
   </script>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

  <div class="flex justify-center">
    <input class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" type="submit" name="submit">
  </div>

  
  <?php if(!$errors->isEmpty()): ?>
        <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
          <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
          <span class="sr-only">Danger</span>
          <div>
            <ul class="mt-1.5 ml-4 text-red-700 list-disc list-inside">
              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        </div>
        <?php endif; ?>
    
    </form>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('table'); ?>
    
    <script type="text/javascript">
  $('#search').on('keyup',function(){
  $value=$(this).val();
  $.ajax({
  type : 'get',
  url : '<?php echo e(URL::to('searchStation')); ?>',
  data:{'search':$value},
  success:function(data){
  $('tbody').html(data);
  }
  });
  })

  $.ajaxSetup({ headers: { 'csrftoken' : '<?php echo e(csrf_token()); ?>' } });
  // adding 3 inputs of ip if type == bmb
  if($('#type').value=='bmb'){
    var i = 3;
    for (i; i >= 1 ; i--) {
        var elem =  "<div id='ipAddr"+[i]+"' class='flex flex-wrap  mb-6'><div class='w-full'><label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-password'>ip address "+[i]+"</label><input name='ipAddr"+[i]+"' class='appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500' id='grid-password' type='text' placeholder='ip address "+[i]+"'></div></div>";
        // console.log(i);
       $(elem).insertAfter( "#ip" );
      }
  }
  </script>
  
      <script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '<?php echo e(csrf_token()); ?>' } });
    </script>
  <script src="/js/sort.js"></script>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50  dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-6 py-3 cursor-pointer hover:bg-gray-400">
                Station name
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer ">
                Station serial number
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
                Station supplier
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
                Station's main ip address
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
              Station's occupied switch
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
                Station's occupied port
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
                Station line
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
                Station type
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
                Station description
            </th>
            <th scope="col" class="px-6 py-3 cursor-pointer">
              tools
            </th>
          </tr>
      </thead>
      <tbody>
        <?php
            use App\Models\Station;
            $stations = Station::paginate(7);
        ?>
          <?php $__currentLoopData = $stations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $station): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
              <?php echo e($station['name']); ?>

            </td>
            <td class="px-6 py-4">
              <?php echo e($station['SN']); ?>

            </td>
            <td class="px-6 py-4">
                <?php echo e($station['supplier']); ?>

              </td>
            <td class="px-6 py-4">
                <?php echo e($station['mainIpAddr']); ?>

              </td>
              <td class="px-6 py-4">
                <?php if(!$switches->where('id','=',$station['switch'])->isEmpty()): ?>
                <?php
                $switch = $switches->where('id', '=', $station['switch']);
               ?>
               <?php if(!$switch->isEmpty()): ?>
               <?php echo e($switch[$switch->keys()[0]]->cabName); ?> - <?php echo e($switch[$switch->keys()[0]]->switchName); ?>

               <?php endif; ?>
                <?php else: ?>
                missing switch
                <?php endif; ?>
              </td>
              <td class="px-6 py-4">
                  <?php echo e($station['port']); ?>

                </td>
            <td class="px-6 py-4">
                <?php echo e($station['line']); ?>

              </td>
            <td class="px-6 py-4">
                <?php echo e($station['type']); ?>

              </td>
            <td class="px-6 py-4">
                <?php echo e($station['description']); ?>

              </td>

              <td class="px-4 py-4 text-right flex">
                <?php
                 $url = rawurlencode($station['SN']);
                ?>
                <a data-id="<?php echo e($station['SN']); ?>" data-method="get" href="<?php echo e(route('showStation', $url)); ?>" id="edit" class="m-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                <a data-id="<?php echo e($station['SN']); ?>" data-method="DELETE" href="<?php echo e(route('deleteStation', $url)); ?>" id="delete" class="m-2 font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
            </td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
      <?php echo e($stations->links('vendor/pagination/tailwind')); ?>

</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('searchBar'); ?>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.searchBar','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('searchBar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\layout\resources\views/components/forms/station.blade.php ENDPATH**/ ?>