SHELL := /usr/bin/env bash

docker-build:
	docker-compose build

docker-up:
	docker-compose up -d && docker-compose ps

docker-stop:
	docker-compose stop

docker-down:
	docker-compose down -v

bash:
	docker-compose run php_sender bash

push_jobs:
	docker-compose exec php_sender sh -c 'while true; do php send.php; done;'

push_job:
	docker-compose exec php_sender sh -c 'php send.php;'

docker-clean:
	# docker rm $(docker ps -a -q) || true
	# docker rmi < echo $(docker images -q | tr "\n" " ")

tail:
	docker-compose logs -f

docker-ssh-php-receiver:
	docker exec -it rabbit-php-docker_php_receiver_1 sh

docker-ssh-php-sender:
	docker-compose exec php_sender sh


