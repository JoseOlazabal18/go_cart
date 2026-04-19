# Go Cart - Reestructuracion MVC

## Descripcion general
`go_cart` es un proyecto web reordenado bajo el patron MVC para separar correctamente la capa de datos, la capa de control y la capa visual. En esta fase se implemento el modulo de autenticacion y registro, dejando la base lista para seguir migrando el resto de funcionalidades del proyecto.

## Objetivo de esta fase
El objetivo principal de esta entrega fue dejar operativo el bloque `LOGIN AND REGISTER` solicitado para el proyecto:
- iniciar sesion con usuario y contrasena
- registrar usuarios nuevos
- recuperar contrasena con envio de codigo por correo
- continuar como invitado
- manejar roles base del sistema (`ADMIN`, `SOPORTE`, `VENDEDOR`, `USUARIO`)

## Estructura MVC aplicada
- `application/models/`: contiene consultas SQL, lectura y escritura en base de datos.
- `application/controllers/`: contiene endpoints, validaciones y orquestacion del flujo.
- `application/views/<Modulo>/`: contiene `index.php` y `js/index.js` por modulo.
- `application/core/`: contiene clases base reutilizables del proyecto.
- `public/css/pages/`: contiene estilos por pagina importados desde `public/css/main.css`.

## Modulo desarrollado
### Login
Ruta de vista:
- `BASE_URL + Login`

Endpoints:
- `Auth/login`
- `Auth/guest`
- `Auth/logout`

### Register
Ruta de vista:
- `BASE_URL + Register`

Endpoint:
- `Register/store`

### Recuperacion de contrasena
Ruta de vista:
- `BASE_URL + ForgotPassword`

Endpoints:
- `Auth/sendRecoveryCode`
- `Auth/verifyRecoveryCode`
- `Auth/resetPassword`

## Flujo funcional implementado
### 1. Inicio de sesion
- el usuario ingresa `username` y `password`
- el controller `C_Auth` valida campos obligatorios
- el model `M_Auth` busca primero en `account` y, si no encuentra, revisa `user`
- si la autenticacion es correcta, se crea `$_SESSION['auth']`

### 2. Registro
- el usuario completa los datos del formulario
- el controller `C_Register` valida campos, formato de correo y longitud minima de contrasena
- el model `M_Register` verifica duplicados y tipo de documento valido
- el registro se guarda en dos tablas: `person` y `account`

### 3. Recuperacion de contrasena
- el usuario ingresa su correo
- el sistema genera un codigo temporal
- el codigo se envia por correo con `PHPMailer`
- el codigo se valida en sesion
- si el codigo es correcto, se permite registrar una nueva contrasena

### 4. Invitado
- se crea una sesion minima sin consultar base de datos
- el usuario puede navegar sin iniciar sesion completa

### 5. Roles
- el sistema normaliza el rol leido desde base de datos
- los roles funcionales usados por el proyecto quedan reducidos a:
  - `ADMIN`
  - `SOPORTE`
  - `VENDEDOR`
  - `USUARIO`
  - `INVITADO`

## Archivos principales del modulo
- `application/controllers/C_Auth.php`
- `application/controllers/C_Register.php`
- `application/models/M_Auth.php`
- `application/models/M_Register.php`
- `application/models/M_MailConfig.php`
- `application/Utils/Mailer.php`
- `application/views/Login/`
- `application/views/Register/`
- `application/views/ForgotPassword/`
- `application/core/Response.php`

## Tablas utilizadas
Segun la base `db_gliese`, el modulo usa principalmente estas tablas:
- `account`: cuentas del cliente e-commerce
- `person`: datos personales asociados a la cuenta
- `roleperson`: rol funcional de la persona cliente
- `user`: usuarios internos heredados del sistema base
- `role`: roles de usuarios internos
- `document_type`: tipos de documento permitidos
- `token`: configuracion de correo usada como fallback

## Decisiones tecnicas tomadas
- los controllers no contienen SQL
- el acceso a datos vive en los models
- se agrego `Response` para respuestas JSON consistentes
- se uso transaccion en registro para evitar inserciones incompletas
- `Mailer` puede tomar configuracion desde `.env` o desde la tabla `token`
- se dejo compatibilidad con contrasenas de `account` y con el formato legado de `user`

## Configuracion de correo
El sistema puede obtener la configuracion SMTP de dos formas:

### Opcion 1: archivo `.env`
Variables soportadas:
- `GO_CART_MAIL_HOST`
- `GO_CART_MAIL_PORT`
- `GO_CART_MAIL_USERNAME`
- `GO_CART_MAIL_PASSWORD`
- `GO_CART_MAIL_ENCRYPTION`
- `GO_CART_MAIL_FROM`
- `GO_CART_MAIL_FROM_NAME`

### Opcion 2: tabla `token`
Si las variables de entorno no existen, el proyecto intenta leer:
- `host`
- `email`
- `password`
desde la tabla `token` de la base de datos.

## Documentacion complementaria
- [Modulo Auth](./docs/auth-module.md)

## Observaciones de esta fase
- la documentacion de codigo se realizo con comentarios generales por bloque
- el CSS del modulo fue movido a `public/css/pages/` e importado desde `main.css`
- la fase actual deja listo solo el alcance del modulo de autenticacion y registro

