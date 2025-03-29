# Sistema de Seguridad Ciudadana

Sistema web para la gestión y análisis de incidencias de seguridad ciudadana, desarrollado con CodeIgniter 3 y Python (Flask) para el análisis de datos.

## Descripción

Sistema web para la gestión y reporte de incidentes de seguridad ciudadana, con capacidades de predicción mediante machine learning.

## Características

- Reporte y gestión de incidencias
- Predicción de patrones de incidentes
- Gestión de líneas de emergencia
- Sistema de usuarios con diferentes roles
- Interfaz de usuario intuitiva

## Requisitos del Sistema

### Servidor Web (PHP)

- PHP 7.4 o superior
- MySQL 5.7 o superior
- Apache 2.4 o superior
- XAMPP (recomendado para desarrollo local)

### Servidor de Análisis (Python)

- Python 3.11.5
- Entorno virtual (venv)
- Librerías Python (ver requirements.txt)

## Instalación

### 1. Configuración del Servidor Web (PHP)

1. Clonar el repositorio en la carpeta htdocs de XAMPP:

```bash
cd C:\xampp\htdocs
git clone https://github.com/tu-usuario/Seguridad_Ciudadana.git
```

2. Configurar la base de datos:

   - Crear una base de datos MySQL llamada `seguridad_ciudadana`
   - Importar el archivo `seguridad_ciudadana.sql` en la base de datos

3. Configurar el archivo de conexión:

   - Editar `application/config/database.php` con las credenciales de tu base de datos

4. Configurar el archivo .htaccess:
   - Asegurarse de que el archivo `.htaccess` esté presente en la raíz del proyecto
   - Verificar que el módulo mod_rewrite esté habilitado en Apache

### 2. Configuración del Servidor de Análisis (Python)

1. Crear y activar el entorno virtual:

```bash
cd C:\xampp\htdocs\Seguridad_Ciudadana\ml_scripts
python -m venv venv
.\venv\Scripts\activate
```

2. Instalar las dependencias:

```bash
pip install -r requirements.txt
```

3. Iniciar el servidor Flask:

```bash
python app.py
```

## Configuración de Comunicación entre Servidores

### 1. Configuración del Servidor Flask (Python)

1. El servidor Flask debe estar configurado para escuchar en el puerto 5001:

```python
if __name__ == '__main__':
    app.run(debug=True, port=5001)
```

2. Asegurarse de que CORS esté habilitado:

```python
from flask_cors import CORS
app = Flask(__name__)
CORS(app)
```

### 2. Configuración del Servidor PHP

1. En el controlador `Panel.php`, la URL de la API debe apuntar al servidor Flask:

```php
$apiUrl = 'http://127.0.0.1:5001/entrenar_modelo';
```

2. Si el servidor Flask está en una máquina diferente, actualizar la URL con la IP correspondiente.

## Estructura del Proyecto

```
Seguridad_Ciudadana/
├── application/
│   ├── controllers/
│   ├── models/
│   └── views/
├── ml_scripts/
│   ├── app.py
│   ├── requirements.txt
│   └── venv/
├── static/
│   ├── css/
│   ├── js/
│   └── img/
└── uploads/
```

## Funcionalidades Principales

1. Gestión de Incidencias

   - Registro de incidencias
   - Seguimiento de estado
   - Asignación de operadores

2. Análisis de Datos

   - Generación de reportes estadísticos
   - Predicciones basadas en machine learning
   - Visualización de patrones en PDF
   - Gráficos de incidencias por barrio y tipo

3. Gestión de Usuarios
   - Registro de usuarios
   - Control de acceso
   - Roles y permisos

## Seguridad

1. Protección contra SQL Injection

   - Uso de consultas preparadas
   - Validación de datos de entrada

2. Protección contra XSS

   - Escape de datos HTML
   - Validación de datos de salida

3. Protección de Rutas
   - Autenticación de usuarios
   - Control de acceso basado en roles

## Mantenimiento

1. Backup de Base de Datos

   - Script de backup automático
   - Almacenamiento seguro

2. Logs del Sistema
   - Registro de errores
   - Monitoreo de actividad

## Soporte

Para reportar problemas o solicitar ayuda:

1. Crear un issue en el repositorio
2. Describir el problema detalladamente
3. Incluir logs y capturas de pantalla si es necesario

## Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE](LICENSE) para más detalles.
