# Módulo de Edición de Pacientes

## Objetivo
Implementar la funcionalidad de edición de pacientes dentro del sistema, diseñando una interfaz de usuario organizada mediante pestañas (tabs) para mejorar la experiencia de usuario, e integrando validaciones robustas y máscaras de entrada (input masks) para asegurar la integridad de los datos clínicos y de contacto.

## Descripción General
Esta implementación completó el flujo de trabajo del Módulo de Pacientes, enfocándose específicamente en la vista de edición y la lógica de actualización. Se estructuró la información compleja en secciones lógicas y se implementaron componentes de interfaz avanzados.

---

## 📁 Estructura de Archivos y Ubicaciones

### 1. Controlador y Lógica de Negocio

#### **PatientController**
📍 **Ubicación:** `app/Http/Controllers/PatientController.php`

**Métodos implementados:**
- `edit()` - Retorna la vista de edición con la instancia del paciente y catálogos necesarios
- `update()` - Procesa el formulario PUT, valida y persiste los cambios en la base de datos

**Funcionalidades clave:**
- Route Model Binding para obtener la instancia del paciente
- Validación de datos mediante Request Validation
- Sanitización de datos (limpieza de teléfonos)
- Persistencia de cambios en la base de datos

```php
// Ejemplo de estructura
public function edit(Patient $patient)
{
    return view('admin.patients.edit', [
        'patient' => $patient,
        'blood_types' => BloodType::all()
    ]);
}

public function update(Request $request, Patient $patient)
{
    // Validación y actualización
}
```

---

### 2. Vistas y Frontend

#### **Vista Principal de Edición**
📍 **Ubicación:** `resources/views/admin/patients/edit.blade.php`

**Secciones implementadas:**

##### a) **Encabezado con foto y acciones**
- Foto de perfil del paciente (h-16 w-16 rounded-full)
- Nombre del paciente
- Botones de acción: "Volver" y "Guardar cambios"

##### b) **Sistema de Pestañas (Tabs)**
Implementado con Alpine.js usando `x-data` y `x-show`

**Las 4 pestañas son:**
1. **Datos Personales** - Vista de resumen (solo lectura)
2. **Antecedentes** - Información médica histórica
3. **Información General** - Tipo de sangre y observaciones
4. **Contacto de Emergencia** - Datos del contacto de emergencia

```blade
<div x-data="{ activeTab: '{{ $errorTab }}' }">
    <!-- Navegación de tabs -->
    <!-- Contenido de tabs -->
</div>
```

##### c) **Recuadro Informativo**
- Diseño con `bg-blue-50` y `border-l-4 border-blue-500`
- Mensaje explicativo sobre edición de cuenta de usuario
- Botón "Editar Usuario" con enlace externo

##### d) **Grid de Información**
- Layout responsivo con `grid grid-cols-1 lg:grid-cols-2`
- Campos: Teléfono, Email, Dirección

---

### 3. Modelo de Datos

#### **Modelo Patient**
📍 **Ubicación:** `app/Models/Patient.php`

**Atributos fillable:**
```php
protected $fillable = [
    'user_id',
    'blood_type_id',
    'allergies',
    'chronic_conditions',
    'surgical_history',
    'family_history',
    'observations',
    'emergency_contact_name',
    'emergency_contact_phone',
    'emergency_contact_relationship',
];
```

**Relaciones:**
- `belongsTo(User::class)` - Usuario asociado
- `belongsTo(BloodType::class)` - Tipo de sangre

---

### 4. Componentes WireUI

#### **Componentes utilizados:**
📍 **Paquete:** WireUI (vendor/wireui)

**Componentes integrados:**
- `<x-wire-card>` - Para separar encabezado del contenido
- `<x-wire-inputs.phone>` - Campo de teléfono con máscara
- `<x-wire-select>` - Select para tipo de sangre
- `<x-wire-textarea>` - Áreas de texto para antecedentes

**Configuración de máscaras:**
```blade
<x-wire-inputs.phone 
    mask="(###) ###-####"
    placeholder="(555) 123-4567"
/>
```

---

### 5. Rutas

#### **Archivo de Rutas Admin**
📍 **Ubicación:** `routes/admin.php`

```php
Route::resource('patients', PatientController::class)
    ->names('admin.patients');

// Rutas generadas:
// GET    /patients/{patient}/edit - admin.patients.edit
// PUT    /patients/{patient}      - admin.patients.update
```

---

### 6. Validación

#### **Reglas de Validación**
📍 **Ubicación:** `app/Http/Controllers/PatientController.php` (método `update`)

**Campos validados:**
```php
$validated = $request->validate([
    'blood_type_id' => 'nullable|exists:blood_types,id',
    'allergies' => 'nullable|string|max:500',
    'chronic_conditions' => 'nullable|string|max:500',
    'surgical_history' => 'nullable|string|max:500',
    'family_history' => 'nullable|string|max:500',
    'observations' => 'nullable|string|max:1000',
    'emergency_contact_name' => 'nullable|string|max:255',
    'emergency_contact_phone' => 'nullable|digits:10',
    'emergency_contact_relationship' => 'nullable|string|max:100',
]);
```

#### **Traducción de Atributos**
📍 **Ubicación:** `lang/es/validation.php`

```php
'attributes' => [
    'blood_type_id' => 'tipo de sangre',
    'allergies' => 'alergias',
    'chronic_conditions' => 'enfermedades crónicas',
    'surgical_history' => 'antecedentes quirúrgicos',
    'family_history' => 'antecedentes familiares',
    'observations' => 'observaciones',
    'emergency_contact_name' => 'nombre del contacto de emergencia',
    'emergency_contact_phone' => 'teléfono de emergencia',
    'emergency_contact_relationship' => 'relación del contacto',
],
```

---

### 7. Sanitización de Datos

#### **Preparación de Datos antes de Validación**
📍 **Ubicación:** `app/Http/Controllers/PatientController.php`

**Implementación:**
```php
// Limpieza de teléfono de emergencia
if ($request->has('emergency_contact_phone')) {
    $phone = preg_replace('/[^0-9]/', '', $request->emergency_contact_phone);
    $request->merge(['emergency_contact_phone' => $phone]);
}
```

**Proceso:**
1. Elimina paréntesis, guiones y espacios
2. Almacena únicamente los 10 dígitos numéricos
3. Aplica validación `digits:10`

---

### 8. Migraciones

#### **Tabla de Pacientes**
📍 **Ubicación:** `database/migrations/YYYY_MM_DD_HHMMSS_create_patients_table.php`

**Campos relacionados con la edición:**
```php
$table->foreignId('blood_type_id')->nullable()->constrained();
$table->text('allergies')->nullable();
$table->text('chronic_conditions')->nullable();
$table->text('surgical_history')->nullable();
$table->text('family_history')->nullable();
$table->text('observations')->nullable();
$table->string('emergency_contact_name')->nullable();
$table->string('emergency_contact_phone', 10)->nullable();
$table->string('emergency_contact_relationship')->nullable();
```

---

### 9. Assets y Estilos

#### **Tailwind CSS**
📍 **Ubicación:** `tailwind.config.js`

**Clases utilizadas:**
- Layout: `flex`, `grid`, `gap-4`, `lg:grid-cols-2`
- Espaciado: `mb-6`, `mt-4`, `p-6`
- Colores: `bg-blue-50`, `text-blue-600`, `border-blue-500`
- Interactividad: `hover:bg-gray-50`, `focus:ring-2`

#### **Alpine.js**
📍 **Incluido en:** Layout principal

**Funcionalidades:**
- Manejo de estado de tabs activos
- Toggle de visibilidad con `x-show`
- Aplicación dinámica de clases con `:class`

---

### 10. Sistema de Pestañas - Detalle por Sección

#### **Tab 1: Datos Personales**
- Recuadro informativo con botón "Editar Usuario"
- Grid con Teléfono y Email (solo lectura)
- Dirección (solo lectura)

#### **Tab 2: Antecedentes**
- Campo: Alergias (`<x-wire-textarea>`)
- Campo: Enfermedades crónicas (`<x-wire-textarea>`)
- Campo: Antecedentes quirúrgicos (`<x-wire-textarea>`)
- Campo: Antecedentes familiares (`<x-wire-textarea>`)

#### **Tab 3: Información General**
- Select: Tipo de sangre (`<x-wire-select>`)
- Textarea: Observaciones generales

#### **Tab 4: Contacto de Emergencia**
- Input: Nombre del contacto
- Input: Teléfono con máscara `(###) ###-####`
- Input: Relación con el paciente

---

## 🎨 Características de UX/UI Implementadas

### Validación Visual
- **Auto-focus:** El tab con errores se activa automáticamente
- **Tabs rojos:** Los tabs con errores de validación se resaltan en rojo
- **Mensajes de error:** Se muestran debajo de cada campo con error

### Estados de Tabs
```blade
:class="activeTab === 'datos-personales' 
    ? 'text-blue-600 border-blue-600' 
    : 'text-gray-500 hover:text-blue-600 border-transparent'"
```

### Responsividad
- Mobile-first design
- Grid responsivo: `grid-cols-1 lg:grid-cols-2`
- Flex column en móvil: `flex-col lg:flex-row`

---

## 🔧 Configuración Adicional

### BloodType Seeder
📍 **Ubicación:** `database/seeders/BloodTypeSeeder.php`

```php
BloodType::insert([
    ['name' => 'A+'],
    ['name' => 'A-'],
    ['name' => 'B+'],
    ['name' => 'B-'],
    ['name' => 'AB+'],
    ['name' => 'AB-'],
    ['name' => 'O+'],
    ['name' => 'O-'],
]);
```

---

## 📝 Mensaje de Commit

```
feat(patients): complete edit flow with tabs, validation UX and translations

- Implemented tabbed interface using Alpine.js for organized data editing
- Added blood_type_id to Patient model and fixed select persistence
- Enhanced validation UX: auto-focus and visual feedback (red tabs) on errors
- Translated validation attributes to Spanish in validation.php
- Improved UX/UI for tab navigation with active and hover states
```

---

## 🚀 Uso

### Para editar un paciente:
1. Navegar a la lista de pacientes: `/admin/patients`
2. Hacer clic en el botón de editar de un paciente
3. Completar/modificar los campos en las diferentes pestañas
4. Hacer clic en "Guardar cambios"

### Navegación entre tabs:
- Clic en las pestañas superiores
- Los tabs con errores se resaltan automáticamente
- El sistema guarda el estado del tab activo

---

## 📚 Dependencias

- **Laravel 11.x**
- **Livewire 3.x**
- **WireUI 2.x**
- **Alpine.js 3.x**
- **Tailwind CSS 3.x**
- **Font Awesome 6.x** (para iconos)

---

## 🔍 Archivos Clave - Resumen Rápido

| Componente | Archivo | Descripción |
|-----------|---------|-------------|
| Controlador | `app/Http/Controllers/PatientController.php` | Lógica edit/update |
| Vista | `resources/views/admin/patients/edit.blade.php` | Interfaz de edición |
| Modelo | `app/Models/Patient.php` | Modelo de datos |
| Rutas | `routes/admin.php` | Definición de rutas |
| Validación | `lang/es/validation.php` | Traducciones |
| Seeder | `database/seeders/BloodTypeSeeder.php` | Tipos de sangre |
| Config Tailwind | `tailwind.config.js` | Configuración CSS |

---

## ✨ Mejoras Futuras Sugeridas

1. Implementar auto-save con Livewire
2. Añadir confirmación antes de salir con cambios sin guardar
3. Implementar historial de cambios
4. Añadir carga de archivos médicos
5. Implementar búsqueda de contactos de emergencia existentes

---

**Fecha de implementación:** Febrero 2026  
**Desarrollador:** [Tu Nombre]  
**Versión:** 1.0.0
