#!/bin/bash

# This script performs a few steps to get kalite working on RACHEL

if !(whoami | grep "root" -q)
then
    echo "You need to be root"
    exit 1
fi

PATH=/bin:/usr/bin:/sbin:/usr/sbin

echo This module only works with versions of rachelpiOS greater than v20160319
echo and versions of kalite greater than 0.16.0. 
echo 
echo Using it with other versions will cause problems.
echo
read -p "Press [Enter] key to run commands [ctrl-c] to abort..."

echo Saving previous database...
mv /root/.kalite/database/content_khan_en.sqlite /root/.kalite/database/content_khan_en.orig
echo Symlinking new database...
ln -s /var/www/modules/en-kalite-ess/content_khan_en.sqlite /root/.kalite/database/
echo Saving previous content...
mv /root/.kalite/content /root/.kalite/content.orig
echo Symlinking new content... 
ln -s /var/www/modules/en-kalite-ess/content /root/.kalite/
echo Restarting kalite...
/usr/local/bin/kalite restart
echo All done.

echo Assuming the above commands show no errors, you should be all set.
echo There is no need to "analyze video folder" to see new videos. This
echo has already been done in the newly installed database.
