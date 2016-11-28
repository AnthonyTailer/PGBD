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
else
	echo "Nothing was COMIITED!!."
fi

