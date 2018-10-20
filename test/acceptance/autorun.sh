#!/bin/sh
list=$(ls *.phpt)

for file in $list
do
	echo "\nTesting" $file
	pear run-tests $file
done