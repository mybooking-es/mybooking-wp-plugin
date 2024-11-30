#!/bin/bash

# Ruta a la carpeta donde están los archivos .po
LANGUAGES_DIR="./languages"

# Patrón a reemplazar (ruta incorrecta)
OLD_PATH="../../../../../../../proyectos/yurak/mybooking-reservation-engine/"

# Nuevo patrón (cadena vacía)
NEW_PATH=""

# Procesar cada archivo .po en la carpeta de idiomas
for PO_FILE in "$LANGUAGES_DIR"/*.po; do
  echo "Corrigiendo rutas en: $PO_FILE"
  # Usar sed compatible con macOS
  sed -i '' "s|$OLD_PATH|$NEW_PATH|g" "$PO_FILE"
done

echo "Rutas corregidas en todos los archivos .po."
