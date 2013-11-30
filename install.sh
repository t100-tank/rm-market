#!/bin/bash
mkdir log cache test web/uploads
cp config/databases.example.yml config/databases.yml

echo "Run the following:"
echo "./symfony cc"
echo "./symfony project:permissions"