up:
	docker-compose -f docker-compose.yml up -d

down:
	docker-compose -f docker-compose.yml down

ps:
	docker-compose -f docker-compose.yml ps

app-bash:
	docker exec -it ptt-app bash

mysql-bash:
	docker exec -it ptt-pgsql bash

build:
	docker-compose -f docker-compose.yml up -d --build

recreate:
	docker-compose -f docker-compose.yml up -d --build --force-recreate

check-config:
	docker-compose -f docker-compose.yml config
