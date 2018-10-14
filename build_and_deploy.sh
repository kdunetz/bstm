#!/bin/bash

IMAGE=kdunetz/bstm:1.0
NAMESPACE=default
NAME=bstm

if [ -z "$IMAGE" ]
then
   echo "Please set environment variables with . ./setenv.sh"  
   exit
fi

docker build -t $IMAGE .
docker push $IMAGE 

kubectl delete -f deploy_and_service.yml
kubectl create -f deploy_and_service.yml

