<?php $__env->startSection('title', 'Layout | New switch'); ?>


<?php $__env->startSection('component'); ?>
<?php if( Session::has('success') ): ?>
        <span id="successTxt" class="text-green-500 flex self-center"><?php echo e(Session::get('success')); ?></span>
<?php endif; ?>
<form class="w-full max-w-lg flex-col self-center" method="POST" action="addSwitch">
    <?php echo csrf_field(); ?>
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Switch location
          </label>
          <select name="cabName"
          onchange="let add = document.querySelector('.add');
          if(this.options[this.selectedIndex] == add){
          window.location = add.value;
          }"
          
          class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password">
            <option value="null" selected disabled hidden >- select a network cabinet -</option>
            
            <?php
                use App\Models\NetworkCabinet;
                $cabinets = NetworkCabinet::get();
            ?>
            <?php $__currentLoopData = $cabinets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cabinet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($cabinet['name']); ?>"> <?php echo e($cabinet['name']); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <option class="add" value="cabinet">&#x2b; Add a new cabinet</option>
          </select>
        </div>
      </div>

      
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Ip Address
          </label>
          <input name="ipAddr" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" minlength="7" maxlength="15" size="15" id="grid-password" type="text" placeholder="Ip format (xxx.xxx.xxx.xxx)" required>
        </div>
    </div>
    
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                Number of ports
            </label>
            <input name="portsNum" min="0" max="99" maxlength="2"  minlength="7" maxlength="15" size="15" id="grid-password" type="number" placeholder="Number of the switch's ports" required class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 appearance-none">
    </div>
  </div>
  <div class="flex justify-center">
    <input class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" type="submit" name="submit">
  </div>
  
  <div class="text-red-500 text-xs italic">
    <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('table'); ?>
<script>
$('#search').on('keyup',function(){
  $value=$(this).val();
  $.ajax({
  type : 'get',
  url : '<?php echo e(URL::to('searchSwitch')); ?>',
  data:{'search':$value},
  success:function(data){
  $('tbody').html(data);
  }
  });
  })
  </script>
  <script type="text/javascript">
  $.ajaxSetup({ headers: { 'csrftoken' : '<?php echo e(csrf_token()); ?>' } });
  </script>  
  
    
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">
                Switch Id
            </th>
            <th scope="col" class="px-6 py-3">
                Ip address
            </th>
            <th scope="col" class="px-6 py-3">
                Number of ports
            </th>
            <th scope="col" class="px-6 py-3">
                Cabinet name
            </th>
            <th scope="col" class="px-6 py-3">
              tools
            </th>
          </tr>
      </thead>
      <tbody>
        <?php
            use App\Models\CabinetSwitch;
            $switchs = CabinetSwitch::get();
        ?>
          <?php $__currentLoopData = $switchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $switch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
              <?php echo e($switch['switchId']); ?>

            </th>
            <td class="px-6 py-4">
              <?php echo e($switch['ipAddr']); ?>

            </td>
            <td class="px-6 py-4">
                <?php echo e($switch['portsNum']); ?>

              </td>
            <td class="px-6 py-4">
                <?php echo e($switch['cabName']); ?>

              </td>
              <td class="px-4 py-4 text-right flex">
                <a data-id="<?php echo e($switch['switchId']); ?>" data-method="get" href="<?php echo e(route('showSwitch', $switch['switchId'])); ?>" id="edit" class="m-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                <a data-id="<?php echo e($switch['switchId']); ?>" data-method="DELETE" href="<?php echo e(route('deleteSwitch', $switch['switchId'])); ?>" id="delete" class="m-2 font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
            </td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          
        </tbody>
      </table>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\layout\resources\views/components/forms/switch.blade.php ENDPATH**/ ?>