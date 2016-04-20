#!/bin/bash +x

# Description: Query the size of the file system in Bytes

if [ $2 == "--available" ];
	then
		df $1 | awk '{ if (NR > 1)  printf("%d",$4); }'
	else
		df $1 | awk '{ if (NR > 1)  printf("%d",$3); }'
fi
exit 0;
