# Documentacion del modulo Auth

## Alcance del modulo
Este documento resume lo implementado en el bloque `LOGIN AND REGISTER` del proyecto `go_cart`. Su objetivo es explicar la funcionalidad desarrollada, las responsabilidades de cada capa MVC y el flujo tecnico general del modulo.

## Funcionalidades cubiertas
- inicio de sesion con usuario y contrasena
- registro de nuevos usuarios cliente
- recuperacion de contrasena por correo usando codigo temporal
- acceso como invitado
- lectura y normalizacion de roles

## Responsabilidad por capa
### Controllers
Los controllers reciben datos desde formularios o peticiones `fetch`, validan lo necesario y llaman al model correspondiente.

Archivos:
- `application/controllers/C_Auth.php`
- `application/controllers/C_Register.php`

### Models
Los models concentran toda consulta SQL y operaciones directas en base de datos.

Archivos:
- `application/models/M_Auth.php`
- `application/models/M_Register.php`
- `application/models/M_MailConfig.php`

### Views
Las vistas solo muestran formularios, contenedores y scripts del lado cliente.

Archivos:
- `application/views/Login/index.php`
- `application/views/Register/index.php`
- `application/views/ForgotPassword/index.php`

### JavaScript por vista
Cada vista tiene su propio `index.js` para conectar la interfaz con los endpoints del backend.

Archivos:
- `application/views/Login/js/index.js`
- `application/views/Register/js/index.js`
- `application/views/ForgotPassword/js/index.js`

## Flujo de sesion
Cuando el login es exitoso, el sistema guarda una sesion con esta estructura:

```php
$_SESSION['auth'] = [
    'id' => ...,
    'person_id' => ...,
    'username' => ...,
    'name' => ...,
    'email' => ...,
    'role' => ...,
    'role_label' => ...,
    'source' => ...,
    'is_guest' => false
];
```

Esta sesion permite que otros modulos del proyecto, como `Profile`, puedan reutilizar la informacion del usuario autenticado sin redefinir otro contrato.

## Detalle por funcionalidad
### Login
1. El usuario envia `username` y `password`.
2. `C_Auth::login()` valida que ambos existan.
3. `M_Auth::find_user_by_username()` busca primero en `account`.
4. Si no encuentra, busca en `user`.
5. `M_Auth::verify_password()` valida la contrasena segun la fuente.
6. Si todo es correcto, se crea la sesion.

### Registro
1. El usuario completa sus datos personales.
2. `C_Register::build_payload()` limpia y valida la entrada.
3. `M_Register` verifica correo, usuario, documento y tipo de documento.
4. Se inicia una transaccion.
5. Se inserta primero en `person`.
6. Luego se inserta la cuenta en `account`.
7. Si ocurre un error, se revierte toda la transaccion.

### Recuperacion de contrasena
1. El usuario envia su correo.
2. `C_Auth::sendRecoveryCode()` verifica que exista.
3. Se genera un codigo aleatorio de 6 digitos.
4. El codigo se guarda temporalmente en `$_SESSION['recovery']`.
5. `Mailer::send_recovery_mail()` lo envia por correo.
6. El usuario verifica el codigo.
7. Si el codigo es correcto, se habilita el cambio final de contrasena.

## Manejo de correo
El envio de correo tiene dos fuentes de configuracion:

### Prioridad 1: `.env`
Si existe `.env`, se cargan las variables SMTP definidas alli.

### Prioridad 2: base de datos
Si no existen variables de entorno, `Mailer` consulta la tabla `token` mediante `M_MailConfig`.

## Manejo de roles
El proyecto no usa literalmente todos los nombres de rol leidos desde la base. Por eso `C_Auth::normalize_role()` convierte nombres del origen a roles funcionales del sistema.

Ejemplos:
- `ADMINISTRADOR` -> `ADMIN`
- valores con `SOPORTE`, `SEGURIDAD` o `TECNICO` -> `SOPORTE`
- `CLIENTE` -> `USUARIO`

## Buenas practicas aplicadas
- separacion estricta entre SQL y controllers
- respuestas JSON centralizadas
- transacciones para operaciones compuestas
- comentarios de codigo generales por bloque
- estilos desacoplados de las vistas

## Pendiente para futuras fases
- integrar `Profile` con la sesion ya definida
- restringir vistas segun rol
- migrar modulos restantes al mismo patron MVC
