<?php

namespace Kanagama\Calendarar\Consts;

use Carbon\Carbon;

final class CalendararConst
{
    /**
     * @var int
     */
    public const SUNDAY = 7;

    /**
     * @var array<int,string>
     */
    public const WEEKS = [
        Carbon::SUNDAY    => 'sun',
        Carbon::MONDAY    => 'mon',
        Carbon::TUESDAY   => 'tue',
        Carbon::WEDNESDAY => 'wed',
        Carbon::THURSDAY  => 'thu',
        Carbon::FRIDAY    => 'fri',
        Carbon::SATURDAY  => 'sat',
        self::SUNDAY      => 'sun',
    ];

    /**
     * @var array<string,array<int,string>>
     */
    public const HEADER_ENCODING = [
        'ja' => [
            Carbon::SUNDAY    => '日',
            Carbon::MONDAY    => '月',
            Carbon::TUESDAY   => '火',
            Carbon::WEDNESDAY => '水',
            Carbon::THURSDAY  => '木',
            Carbon::FRIDAY    => '金',
            Carbon::SATURDAY  => '土',
            self::SUNDAY      => '日',
        ],
        'en' => self::WEEKS,
    ];

    /**
     * tr テンプレートデフォルト
     *
     * @var string
     */
    public const DAY_OF_WEEK_TEMPLATE = '{{dayOfWeek}}';

    /**
     * td テンプレートデフォルト
     *
     * @var string
     */
    public const DAY_TEMPLATE = '{{day}}';
}