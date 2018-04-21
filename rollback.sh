NAME=bstm
NAMESPACE=kdunetz

kubectl rollout undo deployment/$NAME -n $NAMESPACE
