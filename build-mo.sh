for PO_FILE in ./languages/*.po; do
  MO_FILE="${PO_FILE%.po}.mo"
  msgfmt "$PO_FILE" -o "$MO_FILE"
  echo "Archivo .mo generado: $MO_FILE"
done
