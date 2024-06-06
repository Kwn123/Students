# Guía de Instalación de la Aplicación

## Requisitos Previos
1. Laragon con PHP 8.1.10
2. Node.js

## Pasos para la Instalación

### Paso 1: Instalar Laragon
1. Descarga e instala Laragon desde [aquí](https://laragon.org/download/index.html).
2. Asegúrate de tener la versión de PHP 8.1.10 instalada.

### Paso 2: Instalar Node.js
1. Descarga e instala Node.js desde [aquí](https://nodejs.org/).

### Paso 3: Descargar la Aplicación
Tienes dos opciones para obtener el código de la aplicación:
1. **Opción 1: Descargar el archivo ZIP desde GitHub**
   - Ir al repositorio de GitHub.
   - Descargar el archivo ZIP y extraer su contenido en `C:\laragon\www\Students`.
   
2. **Opción 2: Clonar el repositorio**
   - Abre una terminal y ejecuta el siguiente comando:
     ``git clone <URL_DEL_REPOSITORIO> C:\laragon\www\Students``

     
### Paso 4: Instalar Dependencias con Composer
1. Abre la terminal de Laragon.
2. Navega hasta la carpeta de la aplicación:
   `cd C:\laragon\www\Students`
3. Ejecuta el siguiente comando:
   `composer install`

### Paso 5: Instalar los paquetes de dependencia de VITE
1. Abre la terminal de Laragon.
2. Navega hasta la carpeta de la aplicación:
   ``cd C:\laragon\www\Students``

3. Ejecuta el siguiente comando:
   ``npm install``


### Paso 6: Configurar el archivo ENV
1. Dentro de la carpeta `Students` copia el archivo `.env.example` y pégalo en el mismo lugar.
2. Renombra la copia a `.env`.

**Opcional: Cambiar el nombre de la base de datos**
   - En el archivo `.env`, en la línea que dice `DB_DATABASE=`, puedes poner el nombre que desees para la base de datos.

### Paso 7: Iniciar los Servidores
1. En tu terminal de preferencia, navega hasta la carpeta de la aplicación:
   `cd C:\laragon\www\Students`

2. Ejecuta los siguientes comandos para iniciar los servidores:
   ``php artisan serve``
   ``npm run dev``


### Paso 8: Acceder a la Aplicación
1. Abre tu navegador web y ve a `http://localhost:8000` para acceder a la aplicación.
