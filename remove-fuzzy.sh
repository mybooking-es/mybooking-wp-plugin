#!/bin/bash

# Ruta a la carpeta de archivos .po
LANGUAGES_DIR="./languages"

# Procesar cada archivo .po en la carpeta
for PO_FILE in "$LANGUAGES_DIR"/*.po; do
  echo "Eliminando fuzzy del archivo: $PO_FILE"
  
  # Usar sed para eliminar las líneas que contienen "#, fuzzy"
  sed -i '' '/^#, fuzzy/d' "$PO_FILE"
  
  echo "Fuzzy eliminado en: $PO_FILE"
done

echo "Todos los archivos han sido procesados."
