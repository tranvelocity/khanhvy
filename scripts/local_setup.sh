#!/usr/bin/env bash

cp .env.local .env

docker stop $(docker ps -aq)
docker-compose up -d

MYSQL_PWD='password' /usr/bin/mysql -uroot khanhvy_db < /databases/khanhvy_db.sql
echo "===> Created khanhvy_db tables"
