

<?php $__env->startSection('component'); ?>
<form class="w-full max-w-lg flex-col self-center" method="POST" action="/updateSwitch/<?php echo e($switch[$index]->switchId); ?>">
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
            
            <option value="<?php echo e($switch[$index]->cabName); ?>" selected hidden><?php echo e($switch[$index]->cabName); ?></option>
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
          <input value="<?php echo e($switch[$index]->ipAddr); ?>" name="ipAddr" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" minlength="7" maxlength="15" size="15" id="grid-password" type="text" placeholder="Ip format (xxx.xxx.xxx.xxx)" required>
        </div>
    </div>
    
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                Number of ports
            </label>
            <input value="<?php echo e($switch[$index]->portsNum); ?>" name="portsNum" min="0" max="99" maxlength="2"  minlength="7" maxlength="15" size="15" id="grid-password" type="number" placeholder="Number of the switch's ports" required class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 appearance-none">
    </div>
  </div>
  <div class="flex justify-center">
    <input class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" type="submit" value="update">
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
<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\layout\resources\views/components/forms/switchUpdate.blade.php ENDPATH**/ ?>