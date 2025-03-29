#!/bin/bash

# Configuración
BACKUP_DIR="/backups"
DB_NAME="db_seguridadciudadana"
DB_USER="root"
DB_PASS=""
RETENTION_DAYS=7

# Crear directorio de respaldo si no existe
mkdir -p $BACKUP_DIR

# Obtener fecha actual
DATE=$(date +%Y%m%d_%H%M%S)

# Respaldo de la base de datos
mysqldump -u$DB_USER -p$DB_PASS $DB_NAME > $BACKUP_DIR/db_backup_$DATE.sql

# Comprimir respaldo
gzip $BACKUP_DIR/db_backup_$DATE.sql

# Respaldo de archivos importantes
tar -czf $BACKUP_DIR/files_backup_$DATE.tar.gz \
    application/ \
    system/ \
    static/ \
    uploads/ \
    ml_scripts/ \
    .env

# Eliminar respaldos antiguos
find $BACKUP_DIR -type f -mtime +$RETENTION_DAYS -delete

# Registrar log
echo "Backup realizado el $(date)" >> $BACKUP_DIR/backup.log 
