
<?php if(count($breadcrumbs)): ?>
    
    <nav class="mb-2 block">
        <ol class="flex flex-wrap text-slate-700 text-sm">
            <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="flex items-center">
                    <?php if (! ($loop->first)): ?>
                        
                        <span class="px-2 text-gray-400">/</span>
                    <?php endif; ?>

                    <?php if(isset($item['href'])): ?>
                        
                        <a href="<?php echo e($item['href']); ?>"
                           class="opacity-60 hover:opacity-100 transition">
                            <?php echo e($item['name']); ?>

                        </a>
                    
                    <?php else: ?>
                        <?php echo e($item['name']); ?>

                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>

        <?php if(count($breadcrumbs) > 1): ?>
            <h6 class="font-bold mt-2">
                <?php echo e(end($breadcrumbs)['name']); ?>

            </h6>
        <?php endif; ?>
    </nav>
<?php endif; ?><?php /**PATH C:\Users\esteb\OneDrive\Desktop\doctor-appointment-app-4b\resources\views/layouts/includes/admin/breadcrumb.blade.php ENDPATH**/ ?>