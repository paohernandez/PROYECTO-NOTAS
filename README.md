# PROYECTO-NOTAS
Aplicación web para el control de notas de un centro educativo.
## Bienvenido
  <summary>Tabla de contenido</summary>
  <ol>
    <li>
      <a href="#acerca-del-proyecto">Acerca del proyecto</a>
      <ul>
        <li><a href="#construido-con">Construido Con</a></li>
      </ul>
    </li>
    <li>
      <a href="#empezando">Empezando (Getting Started)</a>
      <ul>
        <li><a href="#requisitos-previos">Requisitos Previos</a></li>
        <li><a href="#instalación">Instalación</a></li>
      </ul>
    </li>
    <li><a href="#contacto">Contacto</a></li>
  </ol>

## Acerca Del Proyecto

El proyecto se trata de gestionar las notas de los alumnos. Se crean los usuarios de los profesores, de los alumnos y los directores para gestionar todo, los directores pueden agregar usuarios, agregar profesores, asignar clases y agregar alumnos. De esta manera los profesores pueden ingresar las notas a las clases que se le han asignado y los alumnos pueden ver las notas de las clases que llevan.

<p align="right">(<a href="#bienvenido">Volver al inicio</a>)</p>

### Construido Con

El FrontEnd del proyecto (la vista del usuario), se ha creado con HTML, CSS y un poco de JavaScript, se han usado librerías para agilizar el desarrollo y se ha utilizado PHP 8.1 como lenguaje del Backend. A continuación se enlista los lenguajes que se han utilizado y algunas librerías utilizadas en el proceso de desarrollo:

* HTML
* CSS
* JavaScript
* Select2 Js
* MDBootstrap
* HTML2PDF

<p align="right">(<a href="#bienvenido">Volver al inicio</a>)</p>

## Empezando

A continuación se detallan las instrucciones de como iniciar el proyecto.

### Requisitos Previos

Se puede usar una aplicación para crear un servidor local como:
* [Xampp (Utilizado para desarrollar el proyecto)](https://www.apachefriends.org/es/index.html)
* [WampServer](https://www.wampserver.com/en/)

**** OBLIGATORIO ****
Es obligatorio que se use PHP 8.1 o una versión posterior ya que se han utilizado funciones que solo funcionan a partir de esta versión del lenguaje.

### Instalación

(Instrucciones de uso para un servidor local con Xampp).

1. Instalar Xampp con PHP 8.1 o posterior [https://www.apachefriends.org/es/index.html](https://www.apachefriends.org/es/index.html)
2. Clonar el repositorio en la carpeta htdocs de xampp
   ```sh
   git clone https://github.com/paohernandez/PROYECTO-NOTAS.git
   ```
3. Iniciar el servidor Apache y MySQL
4. Entrar a [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/)
5. Crear una base de datos llamada: `bd_ineb`; con el formato: `utf8mb4_general_ci`
6. Una vez creada la base de datos se importa desde el menú de arriba en la opción "Importar".
7. Selecciona el archivo `bd_ineb.sql` que viene junto con el repositorio en la carpeta raíz.
8. ¡LISTO! Ya está listo el proyecto para funcionar.

Hay usuarios de prueba integrados con la base de datos:

|  Usario  | Contraseña |
| -------- | ---------- |
| director | prueba1    |
| maestro  | prueba2    |
| alumno   | prueba3    |

<p align="right">(<a href="#bienvenido">Volver al inicio</a>)</p>

## Contacto

Paola Hernández - 1890-18-1389 - phernandezh4@miumg.edu.gt

Enlace del proyecto: [https://github.com/paohernandez/PROYECTO-NOTAS.git](https://github.com/paohernandez/PROYECTO-NOTAS.git)

<p align="right">(<a href="#bienvenido">Volver al inicio</a>)</p>
