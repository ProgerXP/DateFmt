<?php
/*
  A sample file for DateFmt date/time formatter class | by Proger_XP
  Full formatting reference: http://proger.i-forge.net/DateFmt/cWq
*/

require 'datefmt.php';

$formatString = 'Posted at h##m (AGO[s-d]IF>14[on d#my (D__)]).';
echo DateFmt::Format($formatString, time() - 30), "\n";             // 30 sec ago
echo DateFmt::Format($formatString, time() - 3600), "\n";           // 1 hour ago
echo DateFmt::Format($formatString, time() - 5 * 24*3600), "\n";    // 5 days ago
echo DateFmt::Format($formatString, time() - 20 * 24*3600), "\n";   // 20 days ago - output as date

// the same but in Russian:
$formatString = 'Добавлено h##m (AGO[s-d]IF>14[d#my (D__)]).';
echo DateFmt::Format($formatString, time() - 20 * 24*3600, 'ru'), "\n";
