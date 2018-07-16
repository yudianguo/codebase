<?php
// 获取当前时间
$time = new Time();
$today_time   =$time->getTodayTime();
var_dump($today_time);

class Time
{
    /**
     * 获取当前月份的最后一天
     * @param $date
     * @return false|string
     */
    public static function getCurMonthLastDay($date)
    {
        return date('Y-m-d 23:59:59', strtotime(date('Y-m-01', strtotime($date)) . ' +1 month -1 day'));
    }
    /**
     * 今日
     */
    public static function getTodayTime()
    {
        $start_time = date("Y-m-d 00:00:00");
        $end_time = date("Y-m-d H:i:s");
        return array('start_time' => $start_time, 'end_time' => $end_time);
    }

    /**
     * 昨日
     */
    public static function getYesterdayTime()
    {
        $start_time = date("Y-m-d 00:00:00", strtotime("-1 day"));
        $end_time = date("Y-m-d 00:00:00", time());
        return array('start_time' => $start_time, 'end_time' => $end_time);
    }

    /**
     * 本周
     * @param string $format
     * @return array
     */
    public static function getThisWeekTime($format = '')
    {
        $date=date('Y-m-d');  //当前日期
        $first=1; //$first =1 表示每周星期一为开始日期 0表示每周日为开始日期
        $w=date('w',strtotime($date));  //获取当前周的第几天 周日是 0 周一到周六是 1 - 6
        $start_time = date('Y-m-d 00:00:00', strtotime("$date -" . ($w ? $w - $first : 6) . ' days')); //获取本周开始日期，如果$w是0，则表示周日，减去 6 天
        $end_time = date("Y-m-d H:i:s", time());
        if ($format) {
            $start_time = date($format, strtotime($start_time));
            $end_time = date($format, strtotime($end_time));
        }
        return array('start_time' => $start_time, 'end_time' => $end_time);
    }

    /**
     * 上周
     */
    public static function getLastWeekTime($format=''){
        if (date('l', time()) == 'Monday') {
            $start_time = date('Y-m-d H:i:s', strtotime('last monday'));
        } else {
            $start_time = date('Y-m-d H:i:s', strtotime('-1 week last monday'));
        }
        $end_time = date('Y-m-d 23:59:59', strtotime('last sunday'));
        if ($format) {
            $start_time = date($format, strtotime($start_time));
            $end_time = date($format, strtotime($end_time));
        }
        return array('start_time' => $start_time, 'end_time' => $end_time);
    }

    /**
     * 近七天
     */
    public static function getSevenTime()
    {
        $start_time = date('Y-m-d H:i:s',strtotime("-7 days"));
        $end_time = date("Y-m-d H:i:s");
        return array('start_time' => $start_time, 'end_time' => $end_time);
    }
    /**
     * 上周同期
     */
    public static function getLastWeekSeemTime()
    {
        $start_time = date("Y-m-d 00:00:00",strtotime("-1 week last monday"));
        $end_time = date('Y-m-d H:i:s', time()-60*60*24*7); //当前日期减7七天上周同期
        return array('start_time' => $start_time, 'end_time' => $end_time);
    }

    /**
     * 本月
     */
    public static function getThisMonth($format=''){
        $start_time = date('Y-m-01 00:00:00', time());
        $end_time = date('Y-m-d H:i:s', time());
        if ($format) {
            $start_time = date($format, strtotime($start_time));
            $end_time = date($format, strtotime($end_time));
        }
        return array('start_time' => $start_time, 'end_time' => $end_time);
    }

    /**
     * 注意这条数据 返回的日期是对的 时间少算一天
     * 上月
     */
    public static function getLastMonth($format='')
    {
        $start_time = date('Y-m-d', mktime(0, 0, 0, date('m')-1, 1));
        $end_time = date('Y-m-d', mktime(0, 0, 0,date('m'),1)-1);
        if ($format) {
            $start_time = date($format, strtotime($start_time));
            $end_time = date($format, strtotime($end_time));
        }
        return array('start_time' => $start_time, 'end_time' => $end_time);
    }

    /**
     * 近六个月(到当前时间)
     */
    public static function getSixMonth($format = '')
    {
        $start_time = date('Y-m-d 00:00:00', mktime(0, 0, 0, date('m') - 5, 1));
        $end_time = date('Y-m-d H:i:s', time());
        if ($format) {
            $start_time = date($format, strtotime($start_time));
            $end_time = date($format, strtotime($end_time));
        }
        return array('start_time' => $start_time, 'end_time' => $end_time);
    }

    /**
     * 上月同期
     */
    public static function getLastSeemMonth()
    {
        $time = time();
        $last = strtotime("-1 month", time());
        $start_time = date("Y-m-01 00:00:00", $last);//上个月的第一天
        $last_month_day = date('t', strtotime('last month', $time));
        if (date("j") > $last_month_day) {
            $end_time = date('Y-m-t 00:00:00', strtotime('last month', $time));
        } else {
            $end_time = date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('m') - 1, date("j")));
        }
        return array('start_time' => $start_time, 'end_time' => $end_time);
    }

    /**
     * 近三十天
     */
    public static function getThirtyTime($format='')
    {
        $start_time = date('Y-m-d 00:00:00',strtotime("-29 days"));
        $end_time = date("Y-m-d H:i:s");
        if ($format) {
            $start_time = date($format, strtotime($start_time));
            $end_time = date($format, strtotime($end_time));
        }
        return array('start_time' => $start_time, 'end_time' => $end_time);
    }

    /**
     * 获取当前时间前多少时间
     */
    public static function getIdeaTime($num = 1,$idea = ''){
        $time_start = date("Y-m-d", strtotime("-$num $idea"));//当前时间前3个月时间
        $time_end = date('Y-m-d', time());//当前时间
        return array('start_time' => $time_start, 'end_time' => $time_end);
    }

    /**
     * 获取连字时间
     * 201710
     */
    public static function getMonthContactTime($time)
    {
        $year = substr($time, 0, 4);
        $month = substr($time, -2);
        $start_time = date('Y-m-d 00:00:00', mktime(0, 0, 0, $month, 1, $year));
        $end_time = date('Y-m-d 00:00:00', mktime(0, 0, 0, $month + 1, 1, $year) - 1);
        return array('start_time' => $start_time, 'end_time' => $end_time);
    }
}