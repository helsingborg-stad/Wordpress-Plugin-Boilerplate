#!/bin/bash
# Script to change plugin name occurances

echo "Enter the name of your plugin (readable): "
read plugin_name
find ./ -type f ! -name "Init.sh" -exec sed -i '' -e "s/(#plugin_name#)/$plugin_name/g" {} >/dev/null 2>&1 \;

echo "Enter plugin slug: "
read plugin_slug
find ./ -type f ! -name "Init.sh" -exec sed -i '' -e "s/(#plugin_slug#)/$plugin_slug/g" {} >/dev/null 2>&1 \;

echo "Enter plugin namespace: "
read plugin_namespace
find ./ -type f ! -name "Init.sh" -exec sed -i '' -e "s/(#plugin_namespace#)/$plugin_namespace/g" {} >/dev/null 2>&1 \;

# Rename plugin-name.* to plugin_slug
mv ./plugin-name.php ${plugin_slug}.php
mv ./source/js/plugin-name.js ./source/js/${plugin_slug}.js
mv ./source/sass/plugin-name.scss ./source/sass/${plugin_slug}.scss

npm install

echo "All done!"
