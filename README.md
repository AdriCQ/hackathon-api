# Ultra Media Secure Service API

Esta API está diseñada para proporcionar servicios seguros para el manejo de imágenes y videos de ultrasonidos en aplicaciones médicas

## Requisitos

- PHP >= 8.2
- Laravel >= 11.0
- Base de datos Relacional (MySQL, MariaDB, Postgres, SQLite)
- Composer (para instalar dependencias)

## Instalación

1. Clona el repositorio e Instala dependencias:

```bash
git clone https://github.com/tuusuario/ultra-media-secure-service.git

cd ultra-media-secure-service

composer install
```

2. Copia el archivo .env.example a .env y configura tus variables de entorno, como la conexión a la base de datos.

3. Genera la clave de la aplicación:

```bash
php artisan key:generate
```

4. Genera la estructura en la Base de Datos y rellena los datos necesarios:

```bash
php artisan migrate
php artisan db:seed
```

5. Inicia el servicio:

```bash
php artisan serve
```
## Documentación

Puedes ver la documentación accediendo a http://localhost:8000/docs
