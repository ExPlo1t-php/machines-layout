<?php $__env->startSection('title', 'Layout | Update equipment type'); ?>


<?php $__env->startSection('component'); ?>
<form class="w-full max-w-lg flex-col self-center" method="POST" action="/updateEquipmentType/<?php echo e($type[$index]->name); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Equipment type name
          </label>
          <input value="<?php echo e($type[$index]->name); ?>" name="name" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" placeholder="Equipment type">
        </div>
      </div>

  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        Description
      </label>
      <textarea name="description"  cols="53" rows="10" placeholder="Write a description of this Type of equipment (optional)" style="resize: none" class="appearance-none block w-full  text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
<?php echo e($type[$index]->description); ?></textarea>
    </div>
  </div>



<div class="flex flex-col flex-grow max-w-xl mb-6">
    <div x-data="{ files: null }" id="FileUpload" class="block w-full py-2 px-3 relative bg-white appearance-none border-2 border-gray-300 border-dashed rounded-md cursor-pointer hover:border-gray-400 focus:outline-none">
        <input type="file" multiple accept="image/*" name="icon"
               class="absolute inset-0 z-50 m-0 p-0 w-full h-full outline-none opacity-0"
               x-on:change="files = $event.target.files; console.log($event.target.files);"
               x-on:dragover="$el.classList.add('active')" x-on:dragleave="$el.classList.remove('active')" x-on:drop="$el.classList.remove('active')"
        >
        <template x-if="files !== null">
            <div class="flex flex-col space-y-1">
                <template x-for="(_,index) in Array.from({ length: files.length })">
                    <div class="flex flex-row items-center space-x-2">
                        <template x-if="files[index].type.includes('image/')"><i class="far fa-file-image fa-fw"></i></template>
                        <span class="font-medium text-gray-900" x-text="files[index].name">Uploading</span>
                        <span class="text-xs self-end text-gray-500" x-text="filesize(files[index].size)">...</span>
                    </div>
                </template>
            </div>
        </template>
        <template x-if="files === null">
            <div class="flex flex-col space-y-2 items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
            </svg>
            <span class="font-medium text-gray-600">
                Drop Images to Attach, or
                <span class="text-blue-600 underline">browse</span>
            </span>
            </div>
        </template>
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
<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\layout\resources\views/components/forms/equipmentTypeUpdate.blade.php ENDPATH**/ ?>