#!/bin/bash

docker compose exec app ./vendor/bin/openapi --bootstrap ./swagger-constants.php --output public/swagger/project-trinity.json --format json ./swagger/swagger-v1.php app
