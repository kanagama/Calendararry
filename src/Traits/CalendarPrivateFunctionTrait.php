<?php

namespace Kanagama\Calendarar\Traits;

use Carbon\Carbon;
use Kanagama\Calendarar\Consts\CalendararConst;

/**
 * @author kazuma nagama <k.nagama0632@gmail.com>
 */
trait CalendarPrivateFunctionTrait
{
    /**
     * 初期化
     */
    private function reset()
    {
        // 開始日を初期化
        if (!$this->startDatetime instanceof Carbon) {
            $this->resetStartDatetime();
        }
        // 終了日を初期化
        if (!$this->endDatetime instanceof Carbon) {
            $this->resetEndDatetime();
        }
    }

    /**
     * 開始日を初期化
     *
     * @return void
     */
    private function resetStartDatetime()
    {
        $this->startDatetime = Carbon::now()->startOfMonth();
    }

    /**
     * 終了日を初期化
     *
     * @return void
     */
    private function resetEndDatetime()
    {
        $this->endDatetime = Carbon::now()->endOfMonth();
    }

    /**
     * 週の最初の曜日
     *
     * @return int
     */
    private function firstDayOfWeekNo(): int
    {
        return ($this->mondayStart)
            ? Carbon::MONDAY
            : Carbon::SUNDAY;
    }

    /**
     * 週の最後の曜日
     *
     * @return int
     */
    private function lastDayOfWeekNo(): int
    {
        return ($this->mondayStart)
            ? CalendararConst::SUNDAY
            : Carbon::SATURDAY;
    }

    /**
     * th テンプレート変換
     *
     * @param  int  $dayOfWeek
     * @return string
     */
    private function trTemplate(int $dayOfWeek)
    {
        return str_replace(
            CalendararConst::DAY_OF_WEEK_TEMPLATE,
            CalendararConst::HEADER_ENCODING[$this->encoding][$dayOfWeek],
            $this->trTemplate
        );
    }

    /**
     * td テンプレート変換
     *
     * @param  int  $day
     * @return string
     */
    private function tdTemplate(int $day)
    {
        return str_replace(
            CalendararConst::DAY_TEMPLATE,
            $day,
            $this->tdTemplate
        );
    }
}
