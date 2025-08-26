#!/bin/bash

docker build --rm -f "Dockerfile" -t iworqproject:latest "."  

docker run -d \
  -p 80:80 \
  -v $PWD/src/:/var/www/html/ \
  --name iworqproject iworqproject 
