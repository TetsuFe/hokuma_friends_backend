#!/bin/sh

while IFS="" read -r p || [ -n "$p" ]
do
  if printf '%s' "$p" | grep -Eq '^APP_KEY'; then
    key=$(php artisan key:generate --show)
    echo "APP_KEY=$key" >> .envv
    printf '%s\n' "APP_KEY generated and set"
  else
    echo "\n$p" >> .envv
  fi

done < .env

cat .envv >> .env
rm .envv
