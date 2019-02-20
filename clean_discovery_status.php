<?php
/*
** Clean up Zabbix Database
** Copyright (C) 2019  William Ritchie
**
** This program is free software; you can redistribute it and/or modify
** it under the terms of the GNU General Public License as published by
** the Free Software Foundation; either version 2 of the License, or
** (at your option) any later version.
**
** This program is distributed in the hope that it will be useful,
** but WITHOUT ANY WARRANTY; without even the implied warranty of
** MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
** GNU General Public License for more details.
**
** You should have received a copy of the GNU General Public License
** along with this program; if not, write to the Free Software
** Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
**/

require_once dirname(__FILE__).'/include/config.inc.php';
//echo "The DBname is : ".$DB['DATABASE']."\n";

// julian day (60s * 60m * 24h)
$jdays = 86400;
$removeAge = 604800;	// (86400s * 7) = 7 days

$now = time();
//echo "Timestamp is : ".$now."\n";

$hosts = DBfetchArray(DBSelect('SELECT h.* FROM dhosts h WHERE h.status=1'));
//print_r($hosts);

foreach ($hosts as $host) {
//   echo "Host ".$host['dhostid'];
//   echo " Last seen on ".$host['lastdown'];

   $ago = abs($host['lastdown'] - $now);
   $days = intdiv($ago,$jdays);
//   echo " and $ago which is $days days ago";
//   echo "\n";

   // if older than the remove Age, delete this entry from the database
   if ($ago >= $removeAge) {
      echo "removing hostid ".$host['dhostid']." due to age\n";
      $result = DBexecute('DELETE FROM dhosts WHERE dhostid='.$host['dhostid']);

      // also remove the information from the dservices table
      // this may/should already be done via the foreign key constraint
      // but just in case do it here as well
      $result2 = DBexecute('DELETE from dservcies WHERE dhostid='.$host['dhostid'].' AND status=1');
   }
}

?>
