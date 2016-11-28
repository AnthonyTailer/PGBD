#!/bin/bash

str="$*"

git status
git add *
git commit -a -m "$str"
git push origin master
