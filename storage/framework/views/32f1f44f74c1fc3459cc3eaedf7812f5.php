<?php
    // Definimos qué campos pertenecen a cada pestaña para detectar errores
    $errorGroups = [
        'antecedentes' => ['allergies', 'chronic_conditions', 'surgical_history', 'family_history'],
        'informacion_general' => ['blood_type_id', 'observations'],
        'contacto_emergencia' => ['emergency_contact_name', 'emergency_contact_phone', 'emergency_contact_relationship']
    ];

    // Pestaña por defecto
    $initialTab = 'datos-personales';

    // Si hay errores, buscamos en qué grupo están para abrir esa pestaña automáticamente
    foreach ($errorGroups as $tabName => $fields) {
        if ($errors->hasAny($fields)) {
            $initialTab = str_replace('_', '-', $tabName);
            break;
        }
    }
?>

<?php if (isset($component)) { $__componentOriginal91fdd17964e43374ae18c674f95cdaa3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal91fdd17964e43374ae18c674f95cdaa3 = $attributes; } ?>
<?php $component = App\View\Components\AdminLayout::resolve(['title' => 'Editar Paciente','breadcrumbs' => [
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Pacientes', 'href' => route('admin.patients.index')],
        ['name' => 'Editar'],
    ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdminLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <form action="<?php echo e(route('admin.patients.update', $patient)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <img 
                        src="<?php echo e($patient->user->profile_photo_url); ?>" 
                        alt="<?php echo e($patient->user->name); ?>"
                        class="h-16 w-16 rounded-full object-cover object-center"
                    >
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        <?php echo e($patient->user->name); ?>

                    </h2>
                </div>
                <div class="flex items-center gap-3">
                    <a
                        href="<?php echo e(route('admin.patients.index')); ?>"
                        class="inline-flex items-center justify-center px-5 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-colors dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600"
                    >
                        Volver
                    </a>
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
                    >
                        <i class="fa-solid fa-check mr-2"></i>
                        Guardar cambios
                    </button>
                </div>
            </div>
        </div>

        
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div x-data="{ activeTab: '<?php echo e($initialTab); ?>' }">
                
                <div class="border-b border-gray-200 dark:border-gray-700 mb-6">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                        <li class="me-2">
                            <a 
                                href="#" 
                                @click.prevent="activeTab = 'datos-personales'"
                                :class="activeTab === 'datos-personales' 
                                    ? 'text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500 active' 
                                    : 'text-gray-500 hover:text-blue-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 border-transparent'"
                                class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg transition-colors duration-200"
                            >
                                <i class="fa-solid fa-user mr-2"></i>
                                Datos Personales
                            </a>
                        </li>
                        <li class="me-2">
                            <?php
                                $hasErrorAntecedentes = $errors->hasAny($errorGroups['antecedentes']);
                            ?>
                            <a 
                                href="#" 
                                @click.prevent="activeTab = 'antecedentes'"
                                class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg transition-colors duration-200
                                    <?php echo e($hasErrorAntecedentes && $initialTab !== 'antecedentes' ? 'text-red-600 border-red-600' : ''); ?>

                                    <?php echo e($hasErrorAntecedentes && $initialTab === 'antecedentes' ? 'text-red-600 border-red-600 active' : ''); ?>

                                    <?php echo e(!$hasErrorAntecedentes && $initialTab === 'antecedentes' ? 'text-blue-600 border-blue-600 active' : ''); ?>

                                    <?php echo e(!$hasErrorAntecedentes && $initialTab !== 'antecedentes' ? 'text-gray-500 hover:text-blue-600 hover:border-gray-300 border-transparent' : ''); ?>"
                                :class="activeTab === 'antecedentes' 
                                    ? '<?php echo e($hasErrorAntecedentes ? "text-red-600 border-red-600" : "text-blue-600 border-blue-600"); ?>' 
                                    : '<?php echo e($hasErrorAntecedentes ? "text-red-600 border-red-600" : "text-gray-500 hover:text-blue-600 hover:border-gray-300 border-transparent"); ?>'"
                            >
                                <i class="fa-solid fa-file-lines mr-2"></i>
                                Antecedentes
                                <?php if($hasErrorAntecedentes): ?>
                                    <i class="fa-solid fa-circle-exclamation ms-2 animate-pulse"></i>
                                <?php endif; ?>
                            </a>
                        </li>
                        <li class="me-2">
                            <?php
                                $hasErrorInformacion = $errors->hasAny($errorGroups['informacion_general']);
                            ?>
                            <a 
                                href="#" 
                                @click.prevent="activeTab = 'informacion-general'"
                                class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg transition-colors duration-200
                                    <?php echo e($hasErrorInformacion && $initialTab !== 'informacion-general' ? 'text-red-600 border-red-600' : ''); ?>

                                    <?php echo e($hasErrorInformacion && $initialTab === 'informacion-general' ? 'text-red-600 border-red-600 active' : ''); ?>

                                    <?php echo e(!$hasErrorInformacion && $initialTab === 'informacion-general' ? 'text-blue-600 border-blue-600 active' : ''); ?>

                                    <?php echo e(!$hasErrorInformacion && $initialTab !== 'informacion-general' ? 'text-gray-500 hover:text-blue-600 hover:border-gray-300 border-transparent' : ''); ?>"
                                :class="activeTab === 'informacion-general' 
                                    ? '<?php echo e($hasErrorInformacion ? "text-red-600 border-red-600" : "text-blue-600 border-blue-600"); ?>' 
                                    : '<?php echo e($hasErrorInformacion ? "text-red-600 border-red-600" : "text-gray-500 hover:text-blue-600 hover:border-gray-300 border-transparent"); ?>'"
                            >
                                <i class="fa-solid fa-info mr-2"></i>
                                Información General
                                <?php if($hasErrorInformacion): ?>
                                    <i class="fa-solid fa-circle-exclamation ms-2 animate-pulse"></i>
                                <?php endif; ?>
                            </a>
                        </li>
                        <li class="me-2">
                            <?php
                                $hasErrorContacto = $errors->hasAny($errorGroups['contacto_emergencia']);
                            ?>
                            <a 
                                href="#" 
                                @click.prevent="activeTab = 'contacto-emergencia'"
                                class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg transition-colors duration-200
                                    <?php echo e($hasErrorContacto && $initialTab !== 'contacto-emergencia' ? 'text-red-600 border-red-600' : ''); ?>

                                    <?php echo e($hasErrorContacto && $initialTab === 'contacto-emergencia' ? 'text-red-600 border-red-600 active' : ''); ?>

                                    <?php echo e(!$hasErrorContacto && $initialTab === 'contacto-emergencia' ? 'text-blue-600 border-blue-600 active' : ''); ?>

                                    <?php echo e(!$hasErrorContacto && $initialTab !== 'contacto-emergencia' ? 'text-gray-500 hover:text-blue-600 hover:border-gray-300 border-transparent' : ''); ?>"
                                :class="activeTab === 'contacto-emergencia' 
                                    ? '<?php echo e($hasErrorContacto ? "text-red-600 border-red-600" : "text-blue-600 border-blue-600"); ?>' 
                                    : '<?php echo e($hasErrorContacto ? "text-red-600 border-red-600" : "text-gray-500 hover:text-blue-600 hover:border-gray-300 border-transparent"); ?>'"
                            >
                                <i class="fa-solid fa-heart mr-2"></i>
                                Contacto de Emergencia
                                <?php if($hasErrorContacto): ?>
                                    <i class="fa-solid fa-circle-exclamation ms-2 animate-pulse"></i>
                                <?php endif; ?>
                            </a>
                        </li>
                    </ul>
        </div>

                
                <div>
                    
                    <div x-show="activeTab === 'datos-personales'" x-cloak>
                        
                        <div class="bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-500 p-4 mb-6 flex items-start justify-between gap-4">
                            <div class="flex items-start gap-3">
                                <i class="fa-solid fa-user-edit text-blue-500 text-xl mt-1"></i>
                                <div>
                                    <h3 class="text-blue-700 dark:text-blue-400 font-semibold text-base mb-1">
                                        Edición de cuenta de usuario
                                    </h3>
                                    <p class="text-blue-600 dark:text-blue-300 text-sm">
                                        La información de acceso (Nombre, Email y Contraseña) debe gestionarse desde la cuenta de usuario asociada.
                                    </p>
                                </div>
                            </div>
                            <a 
                                href="<?php echo e(route('admin.users.edit', $patient->user)); ?>" 
                                class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors whitespace-nowrap"
                            >
                                Editar Usuario
                                <i class="fa-solid fa-external-link-alt ml-2"></i>
                            </a>
                        </div>

                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                            <div>
                                <span class="text-gray-700 dark:text-gray-300 font-medium text-sm">
                                    Teléfono:
                                </span>
                                <p class="text-gray-900 dark:text-gray-100 text-base mt-1">
                                    <?php echo e($patient->user->phone ?? '-'); ?>

                                </p>
                            </div>
                            <div>
                                <span class="text-gray-700 dark:text-gray-300 font-medium text-sm">
                                    Email:
                                </span>
                                <p class="text-gray-900 dark:text-gray-100 text-base mt-1">
                                    <?php echo e($patient->user->email); ?>

                                </p>
                            </div>
                        </div>

                        <div>
                            <span class="text-gray-700 dark:text-gray-300 font-medium text-sm">
                                Dirección:
                            </span>
                            <p class="text-gray-900 dark:text-gray-100 text-base mt-1">
                                <?php echo e($patient->user->address ?? '-'); ?>

                            </p>
                        </div>
                    </div>

                    
                    <div x-show="activeTab === 'antecedentes'" x-cloak style="display: none;">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div>
                                <label for="allergies" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Alergias conocidas
                                </label>
                                <textarea
                                    id="allergies"
                                    name="allergies"
                                    rows="4"
                                    placeholder="Ej: Penicilina, mariscos, polen"
                                    class="w-full px-3 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400"
                                ><?php echo e(old('allergies', $patient->allergies)); ?></textarea>
                                <?php $__errorArgs = ['allergies'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div>
                                <label for="chronic_conditions" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Enfermedades crónicas
                                </label>
                                <textarea
                                    id="chronic_conditions"
                                    name="chronic_conditions"
                                    rows="4"
                                    placeholder="Ej: Hipertensión, diabetes"
                                    class="w-full px-3 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400"
                                ><?php echo e(old('chronic_conditions', $patient->chronic_conditions)); ?></textarea>
                                <?php $__errorArgs = ['chronic_conditions'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div>
                                <label for="surgical_history" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Antecedentes quirúrgicos
                                </label>
                                <textarea
                                    id="surgical_history"
                                    name="surgical_history"
                                    rows="4"
                                    placeholder="Ej: Apendicectomía (2019)"
                                    class="w-full px-3 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400"
                                ><?php echo e(old('surgical_history', $patient->surgical_history)); ?></textarea>
                                <?php $__errorArgs = ['surgical_history'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div>
                                <label for="family_history" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Antecedentes familiares
                                </label>
                                <textarea
                                    id="family_history"
                                    name="family_history"
                                    rows="4"
                                    placeholder="Ej: Antecedentes de cardiopatías"
                                    class="w-full px-3 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400"
                                ><?php echo e(old('family_history', $patient->family_history)); ?></textarea>
                                <?php $__errorArgs = ['family_history'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    
                    <div x-show="activeTab === 'informacion-general'" x-cloak style="display: none;">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div>
                                <label for="blood_type_id" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Tipo de sangre
                                </label>
                                <select
                                    id="blood_type_id"
                                    name="blood_type_id"
                                    class="w-full px-3 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                                >
                                    <option value="">Selecciona un tipo de sangre</option>
                                    <?php $__currentLoopData = $bloodTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bloodType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option 
                                            value="<?php echo e($bloodType->id); ?>"
                                            <?php echo e(old('blood_type_id', $patient->blood_type_id) == $bloodType->id ? 'selected' : ''); ?>

                                        >
                                            <?php echo e($bloodType->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['blood_type_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div></div>
                            <div class="lg:col-span-2">
                                <label for="observations" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Observaciones
                                </label>
                                <textarea
                                    id="observations"
                                    name="observations"
                                    rows="6"
                                    placeholder="Escribe observaciones relevantes"
                                    class="w-full px-3 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400"
                                ><?php echo e(old('observations', $patient->observations)); ?></textarea>
                                <?php $__errorArgs = ['observations'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    
                    <div x-show="activeTab === 'contacto-emergencia'" x-cloak style="display: none;">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div>
                                <label for="emergency_contact_name" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Nombre del contacto
                                </label>
                                <input
                                    type="text"
                                    id="emergency_contact_name"
                                    name="emergency_contact_name"
                                    value="<?php echo e(old('emergency_contact_name', $patient->emergency_contact_name)); ?>"
                                    placeholder="Nombre completo"
                                    class="w-full px-3 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400"
                                />
                                <?php $__errorArgs = ['emergency_contact_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div>
                                <?php
                                    $phoneValue = old('emergency_contact_phone', $patient->emergency_contact_phone);
                                    // Format phone if it's stored as 10 digits
                                    if ($phoneValue && strlen($phoneValue) === 10 && ctype_digit($phoneValue)) {
                                        $phoneValue = '(' . substr($phoneValue, 0, 3) . ') ' . substr($phoneValue, 3, 3) . '-' . substr($phoneValue, 6);
                                    }
                                ?>
                                <label for="emergency_contact_phone" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Teléfono de emergencia
                                </label>
                                <input
                                    type="text"
                                    id="emergency_contact_phone"
                                    name="emergency_contact_phone"
                                    value="<?php echo e($phoneValue); ?>"
                                    placeholder="(555) 555-5555"
                                    maxlength="14"
                                    class="w-full px-3 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400"
                                    x-data="{ phone: '<?php echo e($phoneValue); ?>' }"
                                    x-on:input="
                                        let value = $event.target.value.replace(/\D/g, '');
                                        if (value.length <= 10) {
                                            if (value.length >= 6) {
                                                $event.target.value = '(' + value.substring(0, 3) + ') ' + value.substring(3, 6) + '-' + value.substring(6);
                                            } else if (value.length >= 3) {
                                                $event.target.value = '(' + value.substring(0, 3) + ') ' + value.substring(3);
                                            } else {
                                                $event.target.value = value;
                                            }
                                        }
                                    "
                                />
                                <?php $__errorArgs = ['emergency_contact_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="lg:col-span-2">
                                <label for="emergency_contact_relationship" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Relación
                                </label>
                                <input
                                    type="text"
                                    id="emergency_contact_relationship"
                                    name="emergency_contact_relationship"
                                    value="<?php echo e(old('emergency_contact_relationship', $patient->emergency_contact_relationship)); ?>"
                                    placeholder="Ej: Padre, Madre, Cónyuge, etc."
                                    class="w-full px-3 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400"
                                />
                                <?php $__errorArgs = ['emergency_contact_relationship'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php $__env->startPush('styles'); ?>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal91fdd17964e43374ae18c674f95cdaa3)): ?>
<?php $attributes = $__attributesOriginal91fdd17964e43374ae18c674f95cdaa3; ?>
<?php unset($__attributesOriginal91fdd17964e43374ae18c674f95cdaa3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3)): ?>
<?php $component = $__componentOriginal91fdd17964e43374ae18c674f95cdaa3; ?>
<?php unset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3); ?>
<?php endif; ?>
<?php /**PATH C:\Users\esteb\OneDrive\Desktop\doctor-appointment-app-4b\resources\views/admin/patients/edit.blade.php ENDPATH**/ ?>