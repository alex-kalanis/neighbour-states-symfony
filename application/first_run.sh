#!/bin/sh
# run things inside the php container
# init storage
#chmod -R 777 ./application/storage
# copy .env
#cp ./application/.env.devel ./application/.env
# run migrations
echo "Migrate tables and data"
php bin/console doctrine:migrations:migrate
# test database
php bin/console --env=test doctrine:database:create
php bin/console --env=test doctrine:migrations:migrate
php bin/console --env=test doctrine:fixtures:load
echo "Tables migrated"
# now get the data from remote
php bin/console RemoteDownload
php bin/console ImportDataFile
