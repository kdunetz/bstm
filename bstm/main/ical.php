<?php
echo "BEGIN:VCALENDAR\n";
echo "CALSCALE:GREGORIAN\n";
echo "X-WR-TIMEZONE;VALUE=TEXT:US/Pacific\n";
echo "METHOD:PUBLISH\n";
echo "PRODID:-//Apple Computer\, Inc//iCal 1.0//EN\n";
echo "X-WR-CALNAME;VALUE=TEXT:Sale at Giant\n";
echo "VERSION:2.0\n";
echo "BEGIN:VEVENT\n";
echo "SEQUENCE:5\n";
echo "DTSTART;TZID=US/Pacific:20110906T140000\n";
echo "DTSTAMP:20110906T011706Z\n";
echo "SUMMARY:Sale at Giant Food\n";
echo "DESCRIPTION:buy this too\\nand this\n";
echo "UID:EC9439B1-FF65-11D6-9973-003065F99D04\n";
echo "DTEND;TZID=US/Pacific:20110909T150000\n";
echo "BEGIN:VALARM\n";
echo "TRIGGER;VALUE=DURATION:-P1D\n";
echo "ACTION:DISPLAY\n";
echo "DESCRIPTION:Cant I put more data in here\n";
echo "END:VALARM\n";
echo "END:VEVENT\n";
echo "END:VCALENDAR\n";
?>
