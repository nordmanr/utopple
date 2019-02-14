counter=1
while [ $counter -le 60 ]
do
	find /var/www/net/glasscloud/visual/pythonCreated/*.passcode -mmin +2.04 -delete
	sleep 1
	counter=$(($counter+1))
done
