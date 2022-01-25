<?php

session_start();

class base_sec {

    public function validate_data($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}

class _base extends base_sec {

    protected $con;
    public $ins_id;

    public function __construct($con) {
        $this->con = $con;
    }

    function exc_q(string $query, int $ret = 0) {
        switch ($ret) {
            case 1:
                return mysqli_fetch_assoc(mysqli_query($this->con, $query));
            case 2:
                $data = [];
                $result = mysqli_query($this->con, $query);
                while ($row = mysqli_fetch_array($result)) {
                    foreach ($row as $key => $value) {
                        $data[] = $value;
                    }
                }
                return $data;
            default:
                $result = mysqli_query($this->con, $query);
                $this->ins_id = mysqli_insert_id($this->con);
                return $result;
        }
    }

    public function ins_data(string $table, array $data) {
        $sql = "INSERT INTO `" . $table . "` ( ";
        $last_key = array_key_last($data);
        foreach ($data as $key => $value) {
            $sql .= "`" . $this->validate_data($key) . "`";
            if ($last_key != $key) {
                $sql .= ",";
            }
        }
        $sql .= " ) VALUES ( ";
        foreach ($data as $key => $value) {
            $sql .= "\"" . $this->validate_data($value) . "\"";
            if ($last_key != $key) {
                $sql .= ",";
            }
        }
        $sql .= " );";
        return $this->exc_q($sql);
    }

    public function sel_data(string $table, string $con = null, int $ret = 0) {
        if ($con != null) {
            $sql = "SELECT * FROM `" . $table . "` WHERE " . $con;
        } else {
            $sql = "SELECT * FROM `" . $table . "`";
        }
        return $this->exc_q($sql, $ret);
    }

    public function find_avg_max_exp($year, $this_mon = 13, $cat = 0, $table = "debits") {
        $total = $max = 0;
        for ($i = 1; $i < $this_mon; $i++) {
            $max_query = "SELECT MAX(amount) FROM `" . $table . "` WHERE `date` LIKE '%$year" . "-" . sprintf("%02s", $i) . "%'";
            $tot_query = "SELECT SUM(amount) FROM `" . $table . "` WHERE `date` LIKE '%$year" . "-" . sprintf("%02s", $i) . "%'";
            if ($cat > 0) {
                $max_query .= (" AND `cat`=" . $cat);
                $tot_query .= (" AND `cat`=" . $cat);
            }
            $c_max = floatval($this->exc_q($max_query, 1)["MAX(amount)"]);
            $total += $this->exc_q($tot_query, 1)["SUM(amount)"];
            if ($c_max > $max) {
                $max = $c_max;
            }
        }
        return [($total / $i), $max, $total];
    }

    function build_calendar($month, $year) {

        // Create array containing abbreviations of days of week.
        $daysOfWeek = array('S', 'M', 'T', 'W', 'T', 'F', 'S');

        // What is the first day of the month in question?
        $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

        // How many days does this month contain?
        $numberDays = date('t', $firstDayOfMonth);

        // Retrieve some information about the first day of the
        // month in question.
        $dateComponents = getdate($firstDayOfMonth);

        // What is the name of the month in question?
        $monthName = $dateComponents['month'];

        // What is the index value (0-6) of the first day of the
        // month in question.
        $dayOfWeek = $dateComponents['wday'];

        // Create the table tag opener and day headers

        $calendar = "<table class='calendar'>";
        $calendar .= "<caption>$monthName $year</caption>";
        $calendar .= "<tr>";

        // Create the calendar headers

        foreach ($daysOfWeek as $day) {
            $calendar .= "<th class='header'>$day</th>";
        }

        // Create the rest of the calendar
        // Initiate the day counter, starting with the 1st.

        $currentDay = 1;

        $calendar .= "</tr><tr>";

        // The variable $dayOfWeek is used to
        // ensure that the calendar
        // display consists of exactly 7 columns.

        if ($dayOfWeek > 0) {
            $calendar .= "<td colspan='$dayOfWeek'>&nbsp;</td>";
        }

        $month = str_pad($month, 2, "0", STR_PAD_LEFT);

        while ($currentDay <= $numberDays) {

            // Seventh column (Saturday) reached. Start a new row.

            if ($dayOfWeek == 7) {

                $dayOfWeek = 0;
                $calendar .= "</tr><tr>";
            }

            $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);

            $date = "$year-$month-$currentDayRel";

            $day_tot = floatval($this->exc_q("SELECT SUM(amount) FROM `debits` WHERE `date` LIKE '%$date%'", 1)["SUM(amount)"]);
            $avg = floatval($this->exc_q("SELECT AVG(amount) FROM `debits` WHERE `date` LIKE '%$year-$month%'", 1)["AVG(amount)"]);
            $mon_max = $this->exc_q("SELECT date,SUM(amount) FROM `debits` WHERE `date` LIKE '%$year-$month%' GROUP BY `date` ORDER BY SUM(amount) DESC LIMIT 1", 1);
            if ($mon_max != null) {
                $mon_max = floatval($mon_max["SUM(amount)"]);
            } else {
                $mon_max = 0;
            }

            $in_class = "";
            if ($day_tot == $mon_max) {
                $in_class = "bg-danger text-white";
            } elseif ($day_tot > $avg) {
                $in_class = "bg-warning";
            } elseif ($day_tot > 0) {
                $in_class = "bg-info text-white";
            }
            if ($day_tot > 0) {
                $calendar .= "<td class='one_day' data-id='$date'><span class='$in_class p-1 day_sm_box' data-bs-toggle='tooltip' data-bs-placement='right' title='" . number_format($day_tot, 2, ".", ",") . "'>$currentDay</span></td>";
            } else {
                $calendar .= "<td data-id='$date'><span class='p-1'>$currentDay</span></td>";
            }
            // Increment counters

            $currentDay++;
            $dayOfWeek++;
        }



        // Complete the row of the last week in month, if necessary

        if ($dayOfWeek != 7) {

            $remainingDays = 7 - $dayOfWeek;
            $calendar .= "<td colspan='$remainingDays'>&nbsp;</td>";
        }

        $calendar .= "</tr>";

        $calendar .= "</table>";

        return $calendar;
    }

}

$con = mysqli_connect("localhost", "root", "", "acc_handler");
$db = new _base($con);

if (!isset($_SESSION["c_user_login"])) {
    if (file_exists("../index.php")) {
        header("location:../");
    } else {
        header("location:index.php");
    }
} else {
    $_SESSION["using_time"] = date("Y-m-d H:i:s");
}