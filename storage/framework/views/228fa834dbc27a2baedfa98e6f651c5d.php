<?php

// Arreglo de menú mejorado
$links = [
    [
        'name' => 'Inicio',
        'icon' => 'fa-solid fa-house',
        'href' => route('admin.dashboard'),
        'active' => request()->routeIs('admin.dashboard'),
    ],
    [
        'header' => 'GESTIÓN',
    ],
    [
        'name' => 'Roles y Permisos',
        'icon' => 'fa-solid fa-user-shield',
        'href' => route('admin.roles.index'),
        'active' => request()->routeIs('admin.roles.*'),
    ],
    [
        'name' => 'Usuarios',
        'icon' => 'fa-solid fa-users',
        'href' => route('admin.users.index'),
        'active' => request()->routeIs('admin.users.*'),
    ],
    [
        'name' => 'Doctores',
        'icon' => 'fa-solid fa-user-doctor',
        'href' => '#',
        'active' => false,
    ],
    [
        'name' => 'Pacientes',
        'icon' => 'fa-solid fa-hospital-user',
        'href' => route('admin.patients.index'),
        'active' => request()->routeIs('admin.patients.*'),
    ],
    [
        'header' => 'CITAS Y CONSULTAS',
    ],
    [
        'name' => 'Agenda',
        'icon' => 'fa-solid fa-calendar-days',
        'href' => '#',
        'active' => false,
    ],
    [
        'name' => 'Citas Médicas',
        'icon' => 'fa-solid fa-calendar-check',
        'href' => '#',
        'active' => false,
    ],
    [
        'header' => 'CONFIGURACIÓN',
    ],
    [
        'name' => 'Ajustes',
        'icon' => 'fa-solid fa-gear',
        'href' => '#',
        'active' => false,
    ],
];
?>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-gradient-to-b from-gray-50 to-gray-100 border-r border-gray-200 sm:translate-x-0 dark:bg-gradient-to-b dark:from-gray-800 dark:to-gray-900 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto">
        <ul class="space-y-2 font-medium">
            <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <?php if(isset($link['header'])): ?>
                    <div class="px-3 py-3 mt-4 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-300 dark:border-gray-600 dark:text-gray-400">
                        <?php echo e($link['header']); ?>

                    </div>
                <?php else: ?>
                    <?php if(isset($link['submenu'])): ?>
                        <button type="button" class="flex items-center w-full p-3 text-base text-gray-700 transition duration-200 rounded-lg group hover:bg-blue-50 hover:text-blue-600 dark:text-gray-200 dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <span class="w-6 h-6 inline-flex justify-center items-center text-gray-500 group-hover:text-blue-600 transition duration-200">
                                <i class="<?php echo e($link['icon']); ?>"></i>
                            </span>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap"><?php echo e($link['name']); ?></span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <ul id="dropdown-example" class="hidden py-2 space-y-2">
                            <?php $__currentLoopData = $link['submenu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e($item['href']); ?>" 
                                class="flex items-center w-full p-2 text-gray-700 transition duration-200 rounded-lg pl-11 group hover:bg-blue-50 hover:text-blue-600 dark:text-gray-200 dark:hover:bg-gray-700">
                                    <?php echo e($item['name']); ?>

                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php else: ?>
                        <a href="<?php echo e($link['href']); ?>" 
                           class="flex items-center p-3 text-gray-700 rounded-lg transition duration-200 group hover:bg-blue-50 hover:text-blue-600 hover:shadow-sm dark:text-gray-200 dark:hover:bg-gray-700 <?php echo e($link['active'] ? 'bg-blue-100 text-blue-700 shadow-sm dark:bg-blue-900 dark:text-blue-200' : ''); ?>">
                            <span class="w-6 h-6 inline-flex justify-center items-center <?php echo e($link['active'] ? 'text-blue-600' : 'text-gray-500 group-hover:text-blue-600'); ?> transition duration-200">
                                <i class="<?php echo e($link['icon']); ?>"></i>
                            </span>
                            <span class="ms-3 font-medium"><?php echo e($link['name']); ?></span>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</aside><?php /**PATH C:\Users\esteb\OneDrive\Desktop\doctor-appointment-app-4b\resources\views/layouts/includes/admin/sidebar.blade.php ENDPATH**/ ?>