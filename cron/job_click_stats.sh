#!/bin/bash 
yesterday=`date -d "yesterday" +%Y-%m-%d`
month=`date -d "yesterday" +%Y-%m`
semdir=/opt/data/wwwroot/yy.51yx.com
sqlDir=$semdir/data/sql/$month
logDir=$semdir/log/$month

host="192.168.1.80"
name="root"
password="123456"
db="webgame"

if [ ! -d "$sqlDir" ]
then
        mkdir -p "$sqlDir"
fi

logfile=$logDir/'tg_click_'$yesterday.txt
if [ -f $logfile ]
then
        awk '{print $3,$4}' $logfile |sort -u|uniq|awk '{a[$1]++}END{for(i in a)print "INSERT INTO stat_click_daily(from_id,game_id,sub_code,click_ips,log_date) VALUES ("i","a[i]",'\'''$yesterday''\'');"}' > $sqlDir/ips_$yesterday.sql
        awk '{a[$3]++}END{for(i in a)print i","a[i]}' $logfile  > $sqlDir/click_count
        awk -F',' '{print "update stat_click_daily set click_count ="$4"  where from_id ="$1" and game_id="$2" and sub_code="$3" and log_date= '\'''$yesterday''\'';"}' $sqlDir/click_count > $sqlDir/clicks_$yesterday.sql
        echo "start..."
        echo "delete..."
    mysql -h $host -u$name -p$password $db -e "delete from stat_click_daily where log_date = '"$yesterday"'"
        echo $semdir/data/sql/ips_$yesterday.sql
        mysql  -h $host -u$name -p$password $db < $sqlDir/ips_$yesterday.sql
        echo $semdir/data/sql/clicks_$yesterday.sql
        mysql  -h $host -u$name -p$password $db < $sqlDir/clicks_$yesterday.sql
        echo "end"
else
  echo "${yesterday}  not exist"
fi
