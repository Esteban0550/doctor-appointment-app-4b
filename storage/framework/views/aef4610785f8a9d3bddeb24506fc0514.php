<div class="border border-gray-200 rounded-lg bg-white shadow-sm">
    <div class="flex flex-col gap-4 p-4 md:flex-row md:items-center md:justify-between border-b border-gray-200">
        <div class="relative w-full md:w-80">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 1 0 0-15 7.5 7.5 0 0 0 0 15z" />
                </svg>
            </span>
            <input
                wire:model.live.debounce.500ms="search"
                type="search"
                placeholder="Buscar por nombre o correo..."
                class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition"
            >
        </div>
        <div class="text-sm text-gray-500">
            <!--[if BLOCK]><![endif]--><?php if($users->total()): ?>
                Mostrando <?php echo e($users->firstItem()); ?>–<?php echo e($users->lastItem()); ?> de <?php echo e($users->total()); ?> usuarios
            <?php else: ?>
                No hay usuarios para mostrar
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        ID
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        NOMBRE
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        EMAIL
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        NÚMERO DE ID
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        TELÉFONO
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        ROL
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        ACCION
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <?php echo e($user->id); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <?php echo e($user->name); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <?php echo e($user->email); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <?php echo e($user->id_number ?? '-'); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <?php echo e($user->phone ?? '-'); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <?php echo e($user->roles->first()?->name ?? 'Sin rol'); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="<?php echo e(route('admin.users.edit', $user)); ?>"
                                   class="inline-flex items-center justify-center w-8 h-8 text-white bg-gray-500 hover:bg-gray-600 rounded-md shadow-sm hover:shadow transition-all duration-150"
                                   title="Editar usuario">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>

                                <button
                                    type="button"
                                    onclick="confirmDelete(<?php echo e($user->id); ?>)"
                                    class="inline-flex items-center justify-center w-8 h-8 text-white bg-gray-500 hover:bg-gray-600 rounded-md shadow-sm hover:shadow transition-all duration-150"
                                    title="Eliminar usuario"
                                >
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                            No se encontraron usuarios para los criterios de búsqueda.
                        </td>
                    </tr>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>

    <div class="px-4 py-3">
        <?php echo e($users->links()); ?>

    </div>
</div>

<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminar!",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                window.Livewire.find('<?php echo e($_instance->getId()); ?>').delete(userId);
            }
        });
    }

    // Escuchar el evento de Livewire para mostrar SweetAlert
    Livewire.on('swal', (event) => {
        Swal.fire(event[0]);
    });
</script>

<?php /**PATH C:\Users\esteb\OneDrive\Desktop\doctor-appointment-app-4b\resources\views/livewire/admin/datatables/user-table.blade.php ENDPATH**/ ?>