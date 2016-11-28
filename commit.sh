#!/bin/bash

str="'$*'"
echo "$str"

git status
git add *
git commit -a -m "$str"
git push origin master
