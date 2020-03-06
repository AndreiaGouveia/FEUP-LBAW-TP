#!/bin/bash

# Stop execution if a step fails
set -e

DOCKER_USERNAME=lbaw2052
IMAGE_NAME=lbaw2052-piu

docker build -t $DOCKER_USERNAME/$IMAGE_NAME .
docker push $DOCKER_USERNAME/$IMAGE_NAME
