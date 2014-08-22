add this to the cron jobs and specify how often

/usr/bin/php -q  /home/yourusername/public_html/cron_jobs/removeusers.php


/////////////////////////////////////////////////

added db_conx.php to the scripts folder 

edit it, change the username, password and database name


//////////////////////
Benji you may want to test removeusers.php by changing 7 DAY to 1 MINUTE. create an account and dont activate and check after a 
minute if it's still there 
