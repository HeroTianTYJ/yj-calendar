<?php

namespace yjrj;

class Calendar
{
    private int $year;
    private $minYear = 1891;
    private $lunarInfo = [[0,2,9,21936],[6,1,30,9656],[0,2,17,9584],[0,2,6,21168],[5,1,26,43344],[0,2,13,59728],
        [0,2,2,27296],[3,1,22,44368],[0,2,10,43856],[8,1,30,19304],[0,2,19,19168],[0,2,8,42352],[5,1,29,21096],
        [0,2,16,53856],[0,2,4,55632],[4,1,25,27304],[0,2,13,22176],[0,2,2,39632],[2,1,22,19176],[0,2,10,19168],
        [6,1,30,42200],[0,2,18,42192],[0,2,6,53840],[5,1,26,54568],[0,2,14,46400],[0,2,3,54944],[2,1,23,38608],
        [0,2,11,38320],[7,2,1,18872],[0,2,20,18800],[0,2,8,42160],[5,1,28,45656],[0,2,16,27216],[0,2,5,27968],
        [4,1,24,44456],[0,2,13,11104],[0,2,2,38256],[2,1,23,18808],[0,2,10,18800],[6,1,30,25776],[0,2,17,54432],
        [0,2,6,59984],[5,1,26,27976],[0,2,14,23248],[0,2,4,11104],[3,1,24,37744],[0,2,11,37600],[7,1,31,51560],
        [0,2,19,51536],[0,2,8,54432],[6,1,27,55888],[0,2,15,46416],[0,2,5,22176],[4,1,25,43736],[0,2,13,9680],
        [0,2,2,37584],[2,1,22,51544],[0,2,10,43344],[7,1,29,46248],[0,2,17,27808],[0,2,6,46416],[5,1,27,21928],
        [0,2,14,19872],[0,2,3,42416],[3,1,24,21176],[0,2,12,21168],[8,1,31,43344],[0,2,18,59728],[0,2,8,27296],
        [6,1,28,44368],[0,2,15,43856],[0,2,5,19296],[4,1,25,42352],[0,2,13,42352],[0,2,2,21088],[3,1,21,59696],
        [0,2,9,55632],[7,1,30,23208],[0,2,17,22176],[0,2,6,38608],[5,1,27,19176],[0,2,15,19152],[0,2,3,42192],
        [4,1,23,53864],[0,2,11,53840],[8,1,31,54568],[0,2,18,46400],[0,2,7,46752],[6,1,28,38608],[0,2,16,38320],
        [0,2,5,18864],[4,1,25,42168],[0,2,13,42160],[10,2,2,45656],[0,2,20,27216],[0,2,9,27968],[6,1,29,44448],
        [0,2,17,43872],[0,2,6,38256],[5,1,27,18808],[0,2,15,18800],[0,2,4,25776],[3,1,23,27216],[0,2,10,59984],
        [8,1,31,27432],[0,2,19,23232],[0,2,7,43872],[5,1,28,37736],[0,2,16,37600],[0,2,5,51552],[4,1,24,54440],
        [0,2,12,54432],[0,2,1,55888],[2,1,22,23208],[0,2,9,22176],[7,1,29,43736],[0,2,18,9680],[0,2,7,37584],
        [5,1,26,51544],[0,2,14,43344],[0,2,3,46240],[4,1,23,46416],[0,2,10,44368],[9,1,31,21928],[0,2,19,19360],
        [0,2,8,42416],[6,1,28,21176],[0,2,16,21168],[0,2,5,43312],[4,1,25,29864],[0,2,12,27296],[0,2,1,44368],
        [2,1,22,19880],[0,2,10,19296],[6,1,29,42352],[0,2,17,42208],[0,2,6,53856],[5,1,26,59696],[0,2,13,54576],
        [0,2,3,23200],[3,1,23,27472],[0,2,11,38608],[11,1,31,19176],[0,2,19,19152],[0,2,8,42192],[6,1,28,53848],
        [0,2,15,53840],[0,2,4,54560],[5,1,24,55968],[0,2,12,46496],[0,2,1,22224],[2,1,22,19160],[0,2,10,18864],
        [7,1,30,42168],[0,2,17,42160],[0,2,6,43600],[5,1,26,46376],[0,2,14,27936],[0,2,2,44448],[3,1,23,21936],
        [0,2,11,37744],[8,2,1,18808],[0,2,19,18800],[0,2,8,25776],[6,1,28,27216],[0,2,15,59984],[0,2,4,27424],
        [4,1,24,43872],[0,2,12,43744],[0,2,2,37600],[3,1,21,51568],[0,2,9,51552],[7,1,29,54440],[0,2,17,54432],
        [0,2,5,55888],[5,1,26,23208],[0,2,14,22176],[0,2,3,42704],[4,1,23,21224],[0,2,11,21200],[8,1,31,43352],
        [0,2,19,43344],[0,2,7,46240],[6,1,27,46416],[0,2,15,44368],[0,2,5,21920],[4,1,24,42448],[0,2,12,42416],
        [0,2,2,21168],[3,1,22,43320],[0,2,9,26928],[7,1,29,29336],[0,2,17,27296],[0,2,6,44368],[5,1,26,19880],
        [0,2,14,19296],[0,2,3,42352],[4,1,24,21104],[0,2,10,53856],[8,1,30,59696],[0,2,18,54560],[0,2,7,55968],
        [6,1,27,27472],[0,2,15,22224],[0,2,5,19168],[4,1,25,42216],[0,2,12,42192],[0,2,1,53584],[2,1,21,55592],
        [0,2,9,54560]];

    public function html()
    {
        $year = $_GET['year'] ?? '';
        $this->year = in_array($year, range(1892, 2100)) ? $year : date('Y');
        $html = $this->head() . '<div class="print">';
        foreach (range(1, 12) as $value) {
            $html .= $this->month($value);
        }
        if (strstr($html, '除夕2')) {
            $html = str_replace(['/除夕1', '除夕1', '除夕2'], ['', '廿九', '除夕'], $html);
        } elseif (strstr($html, '除夕1')) {
            $html = str_replace('除夕1', '除夕', $html);
        }
        return $html . '</div>';
    }

    private function head()
    {
        $html = '<form method="get" action="" class="layui-form"><p style="text-align:center;"><a href="' .
            $this->prevYearUrl() . '">&lt;&lt;</a> ' . $this->year . '年 <a href="' . $this->nextYearUrl() .
            '">&gt;&gt;</a> <select lay-filter="year">';
        foreach (range(1892, 2100) as $value) {
            $html .= '<option value="' . $value . '" ' . ($value == $this->year ? 'selected' : '') . '>' . $value .
                '年</option>';
        }
        $html .= '</select> <input type="button" value="打印" class="button print"></p></form>';
        return $html;
    }

    private function month($month)
    {
        $firstDay = strtotime($this->year . '-' . $month . '-01');
        $week = date('w', $firstDay);
        $monthDayCount = date('t', $firstDay);

        $type = ($week == 6 && $monthDayCount >= 30) || ($week == 5 && $monthDayCount == 31) ? '0' : '1';

        $html = '<table class="type' . $type . '"><tr class="month"><th colspan="7">' . $this->year() . $month  .
            '月</th></tr><tr class="week"><th class="red">星期日</th><th>星期一</th><th>星期二</th><th>星期三</th><th>星期四</th>' .
            '<th>星期五</th><th class="red">星期六</th></tr><tr class="day">';
        $i = 0;
        for (; $i < $week; $i++) {
            $html .= '<td></td>';
        }
        for ($j = 1; $j <= $monthDayCount; $j++) {
            $i++;

            $lunar = $this->lunar($this->year, $month, $j);
            $solarTerm = $this->solarTerm($this->year, $month, $j);
            $festival = $this->festival($month . '-' . $j, $lunar[0] . $lunar[1]);
            $shuJiuAndFu = $this->shuJiuAndFu($month, $j);

            $note = [];
            if ($lunar[1] == '初一') {
                $note[] = $lunar[0];
            }
            if ($solarTerm) {
                $note[] = $solarTerm;
            }
            if ($festival) {
                $note[] = $festival;
            }
            if ($shuJiuAndFu) {
                $note[] = $shuJiuAndFu;
            }
            $fontsize = 35;
            $noteStr = $note ? implode('/', $note) : $lunar[1];
            if (!strstr($noteStr, '除夕')) {
                switch (mb_strlen($noteStr)) {
                    case 5:
                        $fontsize = 30;
                        break;
                    case 6:
                        $fontsize = 25;
                        break;
                    case 7:
                        $fontsize = 24;
                        break;
                    case 8:
                    case 9:
                    case 10:
                        $fontsize = 21;
                        break;
                }
            }

            $html .= '<td' . ($i % 7 == 0 || $i % 7 == 1 ? ' class=" red"' : '') . '>' . $j .
                '<br><span style="font-size:' . $fontsize . 'px;">' . $noteStr . '</span></td>';
            if ($i % 7 == 0) {
                $html .= '</tr><tr class="day">';
            }
        }
        $html .= '</tr></table><div style="page-break-after:always;"></div>';
        return $html;
    }

    private function prevYearUrl()
    {
        return '?year=' . ($this->year <= 1892 ? 1892 : $this->year - 1);
    }

    private function nextYearUrl()
    {
        return '?year=' . ($this->year >= 2100 ? 2100 : $this->year + 1);
    }

    private function lunarMonths($year = 0)
    {
        $result = [];
        $lunarInfo = $this->lunarInfo[$year - $this->minYear];
        $bit = decbin($lunarInfo[3]);
        for ($i = 0; $i < strlen($bit); $i++) {
            $result[$i] = substr($bit, $i, 1);
        }
        for ($i = 0; $i < 16 - count($result); $i++) {
            array_unshift($result, '0');
        }
        $result = array_slice($result, 0, ($lunarInfo[0] == 0 ? 12 : 13));
        for ($i = 0; $i < count($result); $i++) {
            $result[$i] = $result[$i] + 29;
        }
        return $result;
    }

    private function lunarYearMonths($year = 0)
    {
        $lunarMonths = $this->lunarMonths($year);
        $result = [];
        for ($i = 0; $i < ($this->lunarInfo[$year - $this->minYear][0] == 0 ? 12 : 13); $i++) {
            $temp = 0;
            for ($j = 0; $j <= $i; $j++) {
                $temp += $lunarMonths[$j];
            }
            $result[] = $temp;
        }
        return $result;
    }

    private function lunar($year = 0, $month = 0, $day = 0)
    {
        if ($year == $this->minYear && $month <= 2 && $day <= 9) {
            return ['正月', '初一'];
        }
        $lunarInfo = $this->lunarInfo[$year - $this->minYear];
        $between = ceil((mktime(0, 0, 0, $month, $day, $year) - mktime(0, 0, 0, $lunarInfo[1], $lunarInfo[2], $year)) /
            24 / 3600);
        if ($between == 0) {
            return ['正月', '初一'];
        } else {
            $year = $between > 0 ? $year : ($year - 1);
            $lunarYearMonths = $this->lunarYearMonths($year);
            $lunarYearMonthsCount = count($lunarYearMonths);
            $between = $between > 0 ? $between : (($lunarYearMonths[$lunarYearMonthsCount - 1] == 0 ?
                    $lunarYearMonths[$lunarYearMonthsCount - 2] :
                    $lunarYearMonths[$lunarYearMonthsCount - 1]) + $between);
            $t = $e = 0;
            for ($i = 0; $i < 13; $i++) {
                if ($between == $lunarYearMonths[$i]) {
                    $t = $i + 2;
                    $e = 1;
                    break;
                } elseif ($between < $lunarYearMonths[$i]) {
                    $t = $i + 1;
                    $e = $between - (empty($lunarYearMonths[$i - 1]) ? 0 : $lunarYearMonths[$i - 1]) + 1;
                    break;
                }
            }
            $leapMonth = $this->lunarInfo[$year - $this->minYear][0];
            return [($leapMonth != 0 && $t == $leapMonth + 1) ? '闰' . $this->lunarMonth($t - 1) :
                $this->lunarMonth($leapMonth != 0 && $leapMonth + 1 < $t ? $t - 1 : $t), $this->lunarDay($e)];
        }
    }

    private function lunarDay($day = 0)
    {
        return ['','初一','初二','初三','初四','初五','初六','初七','初八','初九','初十','十一','十二','十三','十四','十五','十六','十七','十八','十九','二十',
            '廿一','廿二','廿三','廿四','廿五','廿六','廿七','廿八','廿九','三十'][$day] ?? '';
    }

    private function lunarMonth($month = 0)
    {
        return  ['','正月','二月','三月','四月','五月','六月','七月','八月','九月','十月','冬月','腊月'][$month] ?? '';
    }

    private function solarTerm($year = 0, $month = 0, $day = 0)
    {
        $coefficient = [[5.4055,2019,-1],[20.12,2082,1],[3.87],[18.74,2026,-1],[5.63],[20.646,2084,1],[4.81],[20.1],
            [5.52,1911,1],[21.04,2008,1],[5.678,1902,1],[21.37,1928,1],[7.108,2016,1],[22.83,1922,1],[7.5,2002,1],
            [23.13],[7.646,1927,1],[23.042,1942,1],[8.318],[23.438,2089,1],[7.438,2089,1],[22.36,1978,1],[7.18,1954,1],
            [21.94,2021,-1]];
        $solarTerm = ['小寒','大寒','立春','雨水','惊蛰','春分','清明节','谷雨','立夏','小满','芒种','夏至','小暑','大暑','立秋','处暑', '白露','秋分','寒露',
            '霜降','立冬','小雪','大雪','冬至'];
        $yearLastTwo = substr($year, -2);
        $idx = $month * 2 - 2;
        $leap = floor(($yearLastTwo - 1) / 4);
        $day1 = floor($yearLastTwo * 0.2422 + $coefficient[$idx][0]) - $leap;
        if (isset($coefficient[$idx][1]) && $coefficient[$idx][1] == $year) {
            $day1 += $coefficient[$idx][2];
        }
        $day2 = floor($yearLastTwo * 0.2422 + $coefficient[$idx + 1][0]) - $leap;
        if (isset($coefficient[$idx + 1][1]) && $coefficient[$idx + 1][1] == $year) {
            $day1 += $coefficient[$idx + 1][2];
        }
        $result = '';
        if ($day == $day1) {
            $result = $solarTerm[$idx];
        } elseif ($day == $day2) {
            $result = $solarTerm[$idx + 1];
        }
        return $result;
    }

    private function festival($solarDate = '', $lunarDate = '')
    {
        $festival = [];
        $solarFestival = $this->solarFestival($solarDate);
        if ($solarFestival) {
            $festival[] = $solarFestival;
        }
        $lunarFestival = $this->lunarFestival($lunarDate);
        if ($lunarFestival) {
            $festival[] = $lunarFestival;
        }
        $specialFestival = $this->specialFestival($solarDate);
        if ($specialFestival) {
            $festival[] = $specialFestival;
        }
        return implode('/', $festival);
    }

    private function solarFestival($solarDate = '')
    {
        return ['1-1' => '元旦', '1-10' => '人民警察节', '2-2' => '湿地日', '2-14' => '情人节', '3-7' => '女生节', '3-8' => '妇女节',
            '3-12' => '植树节', '3-15' => '消费者权益日', '4-1' => '愚人节', '5-1' => '劳动节', '5-4' => '青年节', '5-12' => '防灾减灾日',
            '6-1' => '儿童节', '7-1' => '建党节', '7-7' => '七七事变', '8-1' => '建军节', '9-10' => '教师节', '9-18' => '九一八事变',
            '10-1' => '国庆节', '10-24' => '程序员节', '10-31' => '万圣夜', '11-1' => '万圣节', '11-9' => '全国消防日', '12-4' => '国家宪法日',
            '12-13' => '国家公祭日', '12-24' => '平安夜', '12-25' => '圣诞节'][$solarDate] ?? '';
    }

    private function lunarFestival($lunarDate = '')
    {
        return ['正月初一' => '春节', '正月十五' => '元宵节', '二月初二' => '龙头节', '三月初三' => '上巳节', '五月初五' => '端午节', '七月初七' => '七夕节',
            '七月十五' => '中元节', '八月十五' => '中秋节', '九月初九' => '重阳节', '十月初一' => '寒衣节', '十月十五' => '下元节', '腊月初八' => '腊八节',
            '腊月廿三' => '北方小年', '腊月廿四' => '南方小年', '腊月廿九' => '除夕1', '腊月三十' => '除夕2'][$lunarDate] ?? '';
    }

    private function specialFestival($date = '')
    {
        $result = '';
        $timestamp = strtotime($this->year . '-' . $date);
        $month = date('m', $timestamp);
        $week = date('w', $timestamp);
        $day = date('d', $timestamp);
        if ($week == 0) {
            if ($month == 5 && $day >= 8 && $day <= 14) {
                $result = '母亲节';
            } elseif ($month == 6 && $day >= 15 && $day <= 21) {
                $result = '父亲节';
            }
        } elseif ($month == 11 && $week == 4 && $day >= 22 && $day <= 28) {
            $result = '感恩节';
        }
        return $result;
    }

    private function shuJiuAndFu($month, $day)
    {
        if (isset($GLOBALS['config'][$this->year])) {
            $config = $GLOBALS['config'][$this->year];
            $shuJiu = $fu = '';
            if (isset($config[$month . '-' . $day])) {
                $temp = $config[$month . '-' . $day];
                if (substr($temp, 0, 1) == '9') {
                    $shuJiu = ['入', '二', '三', '四', '五', '六', '七', '八', '九'][substr($temp, 1)] . '九';
                }
                if (substr($temp, 0, 1) == '3') {
                    $fu = ['入', '中', '末'][substr($temp, 1)] . '伏';
                }
            }
            return $shuJiu . $fu;
        } else {
            $lunar = (new Solar($this->year, $month, $day))->getLunar();
            return $lunar->getShuJiu() . $lunar->getFu();
        }
    }

    private function year()
    {
        return $this->year . '年（' . ['甲', '乙', '丙', '丁', '戊', '己', '庚', '辛', '壬', '癸'][($this->year - 4) % 10] .
            ['子鼠', '丑牛', '寅虎', '卯兔', '辰龙', '巳蛇', '午马', '未羊', '申猴', '酉鸡', '戌狗', '亥猪'][($this->year - 4) % 12] . '年）';
    }
}
