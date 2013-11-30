#!/bin/bash
mkdir log cache test web/uploads
cp config/databases.example.yml config/databases.yml
unzip lib/vendor/symfony.zip -d lib/vendor

./symfony project:permissions
./symfony cc

echo ""
echo "Sozdat' bazu, i nazvanie+user+pass vpisat v config/databases.yml"
echo "Potom zapustit':"
echo "./symfony propel:build-all-load --no-confirmation"
echo ""
