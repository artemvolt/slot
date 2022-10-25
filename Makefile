init:
	docker-compose up -d
	docker exec -it slotegrator_php /bin/bash -c "composer install"