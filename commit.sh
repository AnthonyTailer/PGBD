#!/bin/bash

str="$*"

git status

echo -e "\n|----> Do you want COMMIT your changes?(YES/NO or Y/N), followed by [ENTER]:"

read answer

if (( (( "$answer" == "y" )) || (( "$answer" == "yes" )) )); then
	git pull
	git add *
	git commit -a -m "$str"
	git push origin master
elif (( (( "$answer" == "n" )) || (( "$answer" == "no" )) )); then
	echo -e "\n|----> Nothing was COMMITED!!."
else
	echo -e "\n|----> Invalid Input!!."
fi

