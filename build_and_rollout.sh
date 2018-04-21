#!/bin/bash

IMAGE=kdunetz/bstm:2.0
NAMESPACE=kdunetz
NAME=bstm

if [ -z "$IMAGE" ]
then
   echo "Please set environment variables with . ./setenv.sh"  
   exit
fi

docker build -t $IMAGE .
docker push $IMAGE 

kubectl set image deployment/$NAME $NAME=$IMAGE -n $NAMESPACE

