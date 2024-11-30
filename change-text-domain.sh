#!/bin/bash

# Configuración inicial
OLD_TEXT_DOMAIN="mybooking-wp-plugin"
NEW_TEXT_DOMAIN="mybooking-reservation-engine"
LANGUAGES_DIR="./languages"  # Ruta donde están los archivos .po y .mo
BACKUP_DIR="./backup"        # Carpeta para respaldos

# Crear respaldo de los archivos actuales
mkdir -p "$BACKUP_DIR"
cp "$LANGUAGES_DIR"/*.po "$BACKUP_DIR"
cp "$LANGUAGES_DIR"/*.mo "$BACKUP_DIR"

echo "Respaldo creado en $BACKUP_DIR"

# Cambiar el text domain en cada archivo .po
for PO_FILE in "$LANGUAGES_DIR"/*.po; do
  # Nombre del archivo .mo correspondiente
  MO_FILE="${PO_FILE%.po}.mo"

  # Crear un nuevo archivo .po con el text domain actualizado
  NEW_PO_FILE="${PO_FILE%.po}-new.po"
  
  echo "Procesando archivo: $PO_FILE"

  # 1. Modificar el archivo .po (cambiando el text domain)
  msgattrib --set-fuzzy --output-file="$NEW_PO_FILE" "$PO_FILE"
  sed -i '' "s/$OLD_TEXT_DOMAIN/$NEW_TEXT_DOMAIN/g" "$NEW_PO_FILE"

  # 2. Compilar el nuevo archivo .mo
  msgfmt "$NEW_PO_FILE" -o "$MO_FILE"

  # 3. Reemplazar el archivo original .po por el nuevo
  mv "$NEW_PO_FILE" "$PO_FILE"

  echo "Text domain actualizado en: $PO_FILE"
  echo "Archivo .mo generado: $MO_FILE"
done

echo "Proceso completado. Todos los archivos han sido actualizados."

