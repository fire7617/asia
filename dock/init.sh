#!/bin/bash

read -p 'What is your domain:' domain
read -p 'What is your port:' port
read -p 'Where is your local  path of admin directory:' localAdminPath

# Setting Nginx  Domain
originDomain='kiwi-admin.local.com'
originDomainConf="$originDomain.conf"
nginxFileName="$domain.conf"
cp ./nginx/kiwi-admin.local.com.conf ./nginx/$nginxFileName
#echo  "s/$originDomain/$domain/g"
sed "s/$originDomain/$domain/g" ./nginx/$originDomainConf > ./nginx/$nginxFileName
echo "COPY nginx/$nginxFileName /etc/nginx/conf.d/$nginxFileName" >> nginx/Dockerfile

# Mount Volumn
originAdminPath='/Users/fire7617/www/kiwi/admin'
sed -e "s@$originAdminPath@$localAdminPath@g; s@8888:80@${port}:80@g"  docker-compose.yml > docker-compose-final.yml





