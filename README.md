# El MUS CULITO
Este sistema es una solución integral para la gestión de gimnasios, diseñada bajo el patrón de arquitectura MVC (Modelo-Vista-Controlador). Su objetivo es automatizar desde el registro de atletas y empleados hasta el control estricto de accesos y finanzas.

## Estructura del Proyecto

```
El_mus_culito/
│
├── config/                 # Configuración del sistema
│   └── Database.php        # Clase de conexión PDO a MySQL
│
├── core/                   # Archivos base del sistema
│   └── Router.php          # (Opcional) Manejador de rutas
│
├── public/                 # Única carpeta accesible desde la web (Seguridad)
│   ├── css/                # Estilos (.css)│ 
│   ├── img/                # Imágenes y logos
│   └── index.php           # Punto de entrada de la aplicación
│
├── src/                    # Código fuente principal (Lógica POO)
│   ├── Controllers/        # Reciben las peticiones y deciden qué hacer
│   │   ├── UserController.php
│   │   ├── MembershipController.php
│   │   └── PaymentController.php
│   │
│   ├── Models/             # Clases que representan tus tablas (Tus "Objetos")
│   │   ├── Person.php
│   │   ├── User.php
│   │   ├── Membership.php
│   │   └── Payment.php
│   │
│   └── Services/           # Lógica de negocio (Cálculos complejos)
│       ├── MembershipService.php # (Aquí vive el isAccessAllowed)
│       └── ReportService.php
│
├── views/                  # Archivos HTML y PHP de interfaz
│   ├── layout/             # Partes comunes (header.php, footer.php)
│   ├── user/               # Vistas para gestión de usuarios
│   ├── dashboard/          # Panel principal
│   └── errors/             # Páginas de 404 o acceso denegado
│
├── .env                    # Variables sensibles (DB_USER, DB_PASS)
└── .htaccess               # Configuración del servidor Apache
```

## Comando para encender Apache
sudo systemctl enable --now apache2 