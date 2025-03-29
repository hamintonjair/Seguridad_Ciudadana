<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config['log_threshold'] = 4; // 1=ERROR, 2=DEBUG, 3=INFO, 4=ALL

$config['log_path'] = APPPATH . 'logs/';

$config['log_file_extension'] = '';

$config['log_file_permissions'] = 0644;

$config['log_date_format'] = 'Y-m-d H:i:s';

$config['log_max_files'] = 30;

$config['log_max_size'] = 5242880; // 5MB

$config['log_rotate'] = TRUE;

$config['log_rotate_interval'] = 86400; // 24 horas

$config['log_alert_email'] = getenv('LOG_ALERT_EMAIL') ?: 'admin@example.com';

$config['log_alert_threshold'] = 3; // Nivel de error para enviar alertas

$config['log_alert_subject'] = '[Seguridad Ciudadana] Error en el sistema';

$config['log_alert_message'] = 'Se ha detectado un error crítico en el sistema. Por favor, revise los logs.';
