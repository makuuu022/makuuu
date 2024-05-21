<!DOCTYPE html>
<html>
<head>
    <title>Full Calendar</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .current-day {
            background-color: #f9c6c9;
        }
    </style>
</head>
<body>
    <?php
    function build_calendar($month, $year) {
        // Create an array containing names of all days in a week.
        $daysOfWeek = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

        // What is the first day of the month in question?
        $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

        // How many days does this month contain?
        $numberDays = date('t', $firstDayOfMonth);

        // Retrieve some information about the first day of the month.
        $dateComponents = getdate($firstDayOfMonth);

        // What is the name of the month in question?
        $monthName = $dateComponents['month'];

        // What is the index value (0-6) of the first day of the month in question.
        $dayOfWeek = $dateComponents['wday'];

        // Create the table tag opener and day headers
        $calendar = "<table>";
        $calendar .= "<caption>$monthName $year</caption>";
        $calendar .= "<tr>";

        // Create the calendar headers
        foreach($daysOfWeek as $day) {
            $calendar .= "<th>$day</th>";
        }

        // Create the rest of the calendar
        $calendar .= "</tr><tr>";

        // The variable $dayOfWeek will make sure that there must be only 7 columns on our table
        if ($dayOfWeek > 0) { 
            $calendar .= str_repeat("<td></td>", $dayOfWeek); 
        }

        $currentDay = 1;

        // Get the current day for styling
        $todayDate = date("Y-m-d");

        // While there are still days in the month...
        while ($currentDay <= $numberDays) {
            // If we've reached the end of a week (7 columns), start a new row
            if ($dayOfWeek == 7) {
                $dayOfWeek = 0;
                $calendar .= "</tr><tr>";
            }

            $currentDate = "$year-$month-$currentDay";

            if ($todayDate == $currentDate) {
                $calendar .= "<td class='current-day'>$currentDay</td>";
            } else {
                $calendar .= "<td>$currentDay</td>";
            }

            $currentDay++;
            $dayOfWeek++;
        }

        // Complete the row of the last week in month, if necessary
        if ($dayOfWeek != 7) { 
            $remainingDays = 7 - $dayOfWeek;
            $calendar .= str_repeat("<td></td>", $remainingDays);
        }

        $calendar .= "</tr>";
        $calendar .= "</table>";

        return $calendar;
    }

    // Get the current month and year
    $dateComponents = getdate();
    $month = $dateComponents['mon'];
    $year = $dateComponents['year'];

    // Display the calendar
    echo build_calendar($month, $year);
    ?>
</body>
</html>
