# zabbix_extras
Extras and Addons for zabbix<br>
just drop these files into your zabbix web directory (ie: /usr/share/zabbix)

<b>clean_discovery_status.php</b> - removes stale entries the discovery status page.  Modifies the database.<br>
<code>
   If you are like me then the status of discovery page shows machines that are on longer on your network, but have no way of removing.  The run this program either manually or via cron to clean it up<br>

   Run manually: php clean_discovery_status.php<br>
   Call from cron: <br>
</code>
