<?php

namespace yjrj;

class Solar
{
    private int $year;
    private int $month;
    private int $day;
    private int $hour;

    public function __construct($year, $month, $day, $hour = 0)
    {
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
        $this->hour = $hour;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getMonth()
    {
        return $this->month;
    }

    public function getDay()
    {
        return $this->day;
    }

    public function getJulianDay()
    {
        $y = $this->year;
        $m = $this->month;
        $d = $this->day + $this->hour / 24;
        $n = 0;
        if ($m <= 2) {
            $m += 12;
            $y--;
        }
        if ($y * 372 + $m * 31 + (int)$d >= 588829) {
            $n = (int)($y / 100);
            $n = 2 - $n + (int)($n / 4);
        }
        return (int)(365.25 * ($y + 4716)) + (int)(30.6001 * ($m + 1)) + $d + $n - 1524.5;
    }

    public function getLunar()
    {
        return new Lunar($this);
    }

    public function subtract($solar)
    {
        return $this->getDaysBetween(
            $solar->getYear(),
            $solar->getMonth(),
            $solar->getDay(),
            $this->year,
            $this->month,
            $this->day
        );
    }

    public function isAfter($solar)
    {
        if ($this->year > $solar->getYear()) {
            return true;
        }
        if ($this->year < $solar->getYear()) {
            return false;
        }
        if ($this->month > $solar->getMonth()) {
            return true;
        }
        if ($this->month < $solar->getMonth()) {
            return false;
        }
        if ($this->day > $solar->getDay()) {
            return true;
        }
        return false;
    }

    public function isBefore($solar)
    {
        if ($this->year > $solar->getYear()) {
            return false;
        }
        if ($this->year < $solar->getYear()) {
            return true;
        }
        if ($this->month > $solar->getMonth()) {
            return false;
        }
        if ($this->month < $solar->getMonth()) {
            return true;
        }
        if ($this->day > $solar->getDay()) {
            return false;
        }
        if ($this->day < $solar->getDay()) {
            return true;
        }
        return false;
    }

    public function next($days)
    {
        $y = $this->year;
        $m = $this->month;
        $d = $this->day;
        if (1582 == $y && 10 == $m) {
            if ($d > 4) {
                $d -= 10;
            }
        }
        if ($days > 0) {
            $d += $days;
            $daysInMonth = $this->getDaysOfMonth($y, $m);
            while ($d > $daysInMonth) {
                $d -= $daysInMonth;
                $m++;
                if ($m > 12) {
                    $m = 1;
                    $y++;
                }
                $daysInMonth = $this->getDaysOfMonth($y, $m);
            }
        } elseif ($days < 0) {
            while ($d + $days <= 0) {
                $m--;
                if ($m < 1) {
                    $m = 12;
                    $y--;
                }
                $d += $this->getDaysOfMonth($y, $m);
            }
            $d += $days;
        }
        if (1582 == $y && 10 == $m) {
            if ($d > 4) {
                $d += 10;
            }
        }
        return new Solar($y, $m, $d);
    }

    private function getDaysOfMonth($year, $month)
    {
        if (1582 === $year && 10 === $month) {
            return 21;
        }
        $d = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][$month - 1];
        if ($month === 2 && $this->isLeapYear($year)) {
            $d++;
        }
        return $d;
    }

    private function getDaysInYear($year, $month, $day)
    {
        $days = 0;
        for ($i = 1; $i < $month; $i++) {
            $days += $this->getDaysOfMonth($year, $i);
        }
        $d = $day;
        if (1582 === $year && 10 === $month) {
            if ($day >= 15) {
                $d -= 10;
            }
        }
        $days += $d;
        return $days;
    }

    private function getDaysBetween($ay, $am, $ad, $by, $bm, $bd)
    {
        if ($ay == $by) {
            $n = $this->getDaysInYear($by, $bm, $bd) - $this->getDaysInYear($ay, $am, $ad);
        } elseif ($ay > $by) {
            $days = $this->getDaysOfYear($by) - $this->getDaysInYear($by, $bm, $bd);
            for ($i = $by + 1; $i < $ay; $i++) {
                $days += $this->getDaysOfYear($i);
            }
            $days += $this->getDaysInYear($ay, $am, $ad);
            $n = -$days;
        } else {
            $days = $this->getDaysOfYear($ay) - $this->getDaysInYear($ay, $am, $ad);
            for ($i = $ay + 1; $i < $by; $i++) {
                $days += $this->getDaysOfYear($i);
            }
            $days += $this->getDaysInYear($by, $bm, $bd);
            $n = $days;
        }
        return $n;
    }

    private function isLeapYear($year)
    {
        return ($year % 4 === 0 && $year % 100 != 0) || ($year % 400 === 0);
    }

    private function getDaysOfYear($year)
    {
        if (1582 == $year) {
            return 355;
        }
        return $this->isLeapYear($year) ? 366 : 365;
    }
}
