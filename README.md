# zabbix_extras
extras and addons for zabbix

just drop these files into your zabbix web directory (ie: /usr/share/zabbix)

clean_discovery_status.php - removes stale entries the discovery status page.  Modifies the database.
   Run manually: php clean_discovery_status.php
   Call from cron: 

   If you are like me then the status of discovery page shows machines that are on longer on your network, but have noway of removing.  The run this program either manually or via cron to clean it up
