<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions">
    <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
  </a>
</p>

---

# 📌 Proyecto Laravel – Configuración Inicial

Este documento describe los pasos de configuración aplicados en el proyecto, incluyendo idioma, zona horaria, conexión a base de datos y carga de foto de perfil.

---

## 🔤 1. Configuración de idioma

- Se instaló el paquete de localización **laravel-lang/common** mediante Composer.  
- Se agregó el idioma **español** al sistema de traducciones de Laravel.  
- Se estableció el idioma predeterminado (`locale`) en **es** dentro de `.env` y `config/app.php`.  
- Todos los textos y mensajes del sistema ahora aparecen en español.  

✅ **Verificación:** Inicia la aplicación y revisa que los formularios y mensajes de error se muestren en **español**.

---

## 🕒 2. Configuración de zona horaria

- Se ajustó el parámetro `timezone` en `config/app.php` a **America/Merida**.  
- Esto asegura que los registros y `timestamps` se almacenen con la hora local del **Sureste de México**.  

✅ **Verificación:** Registra un usuario o evento y revisa en la base de datos que la **fecha/hora** corresponda a la zona configurada.

---

## 🗄️ 3. Integración de MySQL

Se configuró la conexión en el archivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=appointment_db_4b
DB_USERNAME=usuario
DB_PASSWORD=contraseña
