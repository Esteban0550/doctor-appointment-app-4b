<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

// Usar la función para refrescar la base de datos (esto reinicia la BD en cada test)
uses(RefreshDatabase::class);

test('un usuario no puede eliminar a si mismo', function () {
    // 1. Crear un usuario de prueba en la base de datos
    $user = User::factory()->create();

    // 2. Autenticar (loguear) como este usuario
    $this->actingAs($user, 'web');

    // 3. Enviar una petición DELETE a la ruta de eliminación con el ID del propio usuario
    $response = $this->delete(route('admin.users.destroy', $user->id));

    // 4. Verificar que la respuesta sea un estado 403 (Forbidden / Prohibido)
    $response->assertStatus(403);

    // 5. Verificar que el usuario todavía existe en la tabla 'users'
    $this->assertDatabaseHas('users', [
        'id' => $user->id,
    ]);
});