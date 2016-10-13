#!/bin/bash

# Variables:
#   serviceIP
#   domain
#
# Examples:
#       ./link.sh 172.17.0.5 selenium.sp.local

ETC_HOSTS=/etc/hosts
SERVICEIP=$1
HOSTNAME=$2

if [ -z "$(grep $HOSTNAME /etc/hosts)" ]
then
#    echo "$HOSTNAME Found in your $ETC_HOSTS, Removing now...";
#    sed -i".bak" "/$HOSTNAME/d" $ETC_HOSTS

    HOSTS_LINE="$SERVICEIP $HOSTNAME"

    echo "Adding $HOSTNAME to your $ETC_HOSTS";
    echo $HOSTS_LINE >> $ETC_HOSTS
fi