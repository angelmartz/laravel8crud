# Laravel 8 CRUD
Ejemplo básico de CRUD API Rest con Laravel 8.x usando Resources, Route Binding, Route ApiResource.
Al ser los requerimientos muy básicos y sin especificar las reglas de negocio, no cuenta con Autenticación y Autorización, 
Cuenta únicamente con los modelos Article y Comments, también Test para CRUD
En la rama DDD se hace la refactorización a Domain-Driven Design como un ejemplo para proyectos escalables


## Requirements
	Laravel >= 8.x
    PHP >= 7.3
    PDO
    SQLite, PostgreSQL o MySQL
  
  ## Installation
```
$ composer install
$ cp env-example .env
$ php artisan key:generate
$ php artisan migrate
```
  ## POSTman
Incluye el archivo [Laravel8Crud.postman_collection.json](https://github.com/angelmartz/laravel8crud/blob/main/Laravel8Crud.postman_collection.json "Laravel8Crud.postman_collection.json") para cargar la colección y realizar pruebas

  ## Author

[Angel Martínez](https://github.com/angelmartz/) :email: [Email Me](mailto:angel.martz24+github@gmail.com)
  