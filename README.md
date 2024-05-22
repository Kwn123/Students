
# Guía de Instalación de la Aplicación

#Paso 1: Instalar Laragon, version php 8.1.10.
#Paso 2: Instalar NODEjs.
#Paso 3: Descargar el archivo zip desde Github o clonar el repositorio.
#Paso 4: Abrir la terminal de Laragon, dentro de la terminal ubicarse dentro de la carpeta de la aplicacion, por ejemplo "C:\laragon\www\Students", una vez ahi instalar Composer con el comando "composer install".
#Paso 5: Instalar  los paquetes de VITE, en la terminal de Laragon, ubicados sobre la aplicacion poner el comando "npm install".
#Paso 6: Dentro de la carpeta "students" tenemos el archivo ".env.example" hacemos una copia y la pegamos en el mismo lugar, renombramos la copia a ".env".
#Paso 7: Iniciamos los host desde la terminal de Laragon con los comandos "php artisan serve" y "npm run dev".

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
Tienen dos opciones para obtener el código de la aplicación:
1. **Opción 1: Descargar el archivo ZIP desde GitHub**
   - Ir al repositorio de GitHub.
   - Descarga el archivo ZIP y extrae su contenido en `C:\laragon\www\Students`.
   
2. **Opción 2: Clonar el repositorio**
   - Abre una terminal y ejecuta el siguiente comando:
     git clone <URL_DEL_REPOSITORIO> C:\laragon\www\Students
     
### Paso 4: Instalar Dependencias con Composer.
1. Abrir la terminal de Laragon.
2. Navega hasta la carpeta de la aplicación:
   cd C:\laragon\www\Students (Un ejemplo, esto seria donde se descomprimio o clono)
3. Colocar el siguiente comando:
   composer install

### Paso 5: Instalar los paquetes de dependencia de VITE.
1. Abrir la terminar de Laragon.
2. Nabegar hasta la carpeta de la aplicacion:
   cd C:\laragon\www\Students (Un ejemplo, esto seria donde se descomprimio o clono)
