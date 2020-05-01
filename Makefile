SHELL := /usr/bin/env bash
up:
	export UID && docker-compose up -d

down:
	docker-compose down -v

bash:
	export UID && docker-compose run php_sender bash

push_jobs:
	docker-compose exec php_sender sh -c 'while true; do php send.php; done;'

push_job:
	docker-compose exec php_sender sh -c 'php send.php;'

docker_clean:
	# docker rm $(docker ps -a -q) || true
	# docker rmi < echo $(docker images -q | tr "\n" " ")

tail:
	docker-compose logs -f

docker-ssh-php-receiver:
	docker exec -it rabbit-php-docker_php_receiver_1 bash


docker-ssh-php-sender:
	docker-compose exec php_sender sh


