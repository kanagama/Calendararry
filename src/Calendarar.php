<?php

namespace Kanagama\Calendarar;

use Carbon\Carbon;
use Kanagama\Calendarar\Consts\CalendararConst;
use Kanagama\Calendarar\Traits\CalendarPrivateFunctionTrait;

/**
 * @method array create()
 * @method string getStartDatetime()
 * @method string getEndDatetime()
 * @method self set(mixed $start, mixed $end)
 * @method self thisMonth()
 * @method self lastMonth()
 * @method self nextMonth()
 * @method self oneYear()
 * @method self startAddYear(int $add)
 * @method self endAddYear(int $add)
 * @method self startSubYear(int $sub)
 * @method self endSubYear(int $sub)
 * @method self startAddMonth(int $add)
 * @method self endAddMonth(int $add)
 * @method self startSubMonth(int $sub)
 * @method self endSubMonth(int $sub)
 *
 * @method static array create()
 * @method static string getStartDatetime()
 * @method static string getEndDatetime()
 * @method static self set(mixed $start, mixed $end)
 * @method static self thisMonth()
 * @method static self lastMonth()
 * @method static self nextMonth()
 * @method static self oneYear()
 * @method static self startAddYear(int $add)
 * @method static self endAddYear(int $add)
 * @method static self startSubYear(int $sub)
 * @method static self endSubYear(int $sub)
 * @method static self startAddMonth(int $add)
 * @method static self endAddMonth(int $add)
 * @method static self startSubMonth(int $sub)
 * @method static self endSubMonth(int $sub)
 *
 * @author k-nagama <k.nagama0632@gmail.com>
 */
final class Calendarar
{
    use CalendarPrivateFunctionTrait;

    /**
     * 開始日
     *
     * @var Carbon|null
     */
    private Carbon $startDatetime;

    /**
     * 終了日
     *
     * @var Carbon|null
     */
    private Carbon $endDatetime;

    /**
     * 言語設定
     *
     * @var string
     */
    private string $encoding = 'ja';

    /**
     * tr テンプレート
     *
     * @var string
     */
    private string $trTemplate = CalendararConst::DAY_OF_WEEK_TEMPLATE;

    /**
     * td テンプレート
     *
     * @var string
     */
    private string $tdTemplate = CalendararConst::DAY_TEMPLATE;

    /**
     * 週始めを月曜日にするか
     *
     * @var bool
     */
    private bool $mondayStart = false;

    /**
     * @var array
     */
    private array $dayData = [];

    /**
     * @param  Carbon|CarbonImmutable|string|null  $start
     * @param  Carbon|CarbonImmutable|string|null  $end
     */
    public function __construct($start = null, $end = null)
    {
        if (!is_null($start)) {
            $this->startDatetime = (new Carbon($start))->startOfMonth();
        }
        if (!is_null($end)) {
            $this->endDatetime = (new Carbon($end))->endOfMonth();
        }

        $this->reset();
    }

    /**
     * 動的呼び出し
     *
     * @param  string  $name
     * @param  array  $args
     * @return mixed
     */
    public function __call($name, $args)
    {
        $callMethod = '_' . $name;
        if (method_exists($this, $callMethod)) {
            return call_user_func_array(array($this, $callMethod), $args);
        }
    }

    /**
     * 静的呼び出し
     *
     * @param  string  $name
     * @param  array  $args
     * @return mixed
     */
    public static function __callStatic($name, $args)
    {
        $instance = new self(Carbon::now(), Carbon::now());
        call_user_func_array(array($instance, 'reset'), []);

        $callMethod = '_' . $name;
        if (method_exists($instance, $callMethod)) {
            return call_user_func_array(array($instance, $callMethod), $args);
        }
    }

    /**
     * 関数として呼び出された場合
     *
     * @return array
     */
    public function __invoke(): array
    {
        $this->reset();

        return $this->create();
    }

    /**
     * 開始月と終了月を設定する
     *
     * @param  mixed  $start
     * @param  mixed  $end
     * @return self
     */
    private function _set($start, $end): self
    {
        $this->__construct($start, $end);

        return $this;
    }

    /**
     * 週の始めを月曜日に設定
     *
     * @return self
     */
    private function _startOfMonday(): self
    {
        $this->mondayStart = true;

        return $this;
    }

    /**
     * 週の始めを日曜日に設定
     *
     * @return self
     */
    private function _startOfSunday(): self
    {
        $this->mondayStart = false;

        return $this;
    }

    /**
     * 今月分に設定
     *
     * @return self
     */
    private function _thisMonth(): self
    {
        $this->resetStartDatetime();
        $this->resetEndDatetime();

        return $this;
    }

    /**
     * 先月分に設定
     *
     * @return self
     */
    private function _lastMonth(): self
    {
        $this->startDatetime = Carbon::now()->subMonth(1)->startOfMonth();
        $this->endDatetime = Carbon::now()->subMonth(1)->endOfMonth();

        return $this;
    }

    /**
     * 来月分に設定
     *
     * @return self
     */
    private function _nextMonth(): self
    {
        $this->startDatetime = Carbon::now()->addMonth(1)->startOfMonth();
        $this->endDatetime = Carbon::now()->addMonth(1)->endOfMonth();

        return $this;
    }

    /**
     * 今月から1年分の配列を作成する
     *
     * @return self
     */
    private function _oneYear(): self
    {
        $this->startDatetime = Carbon::now()->startOfMonth();
        $this->endDatetime = Carbon::now()->addMonth(11)->endOfMonth();

        return $this;
    }

    /**
     * 開始日に $add 年分加算する
     *
     * @param  int  $add
     * @return self
     */
    private function _startAddYear(int $add): self
    {
        $this->reset();

        $this->startDatetime->addYear($add)->startOfMonth();

        return $this;
    }

    /**
     * 終了日に $add 年分加算する
     *
     * @param  int  $add
     * @return self
     */
    private function _endAddYear(int $add): self
    {
        $this->reset();

        $this->endDatetime->addYear($add)->endOfMonth();

        return $this;
    }

    /**
     * 開始日に $sub 年分減算する
     *
     * @param  int  $sub
     * @return self
     */
    private function _startSubYear(int $sub): self
    {
        $this->reset();

        $this->startDatetime->subYear($sub)->startOfMonth();

        return $this;
    }

    /**
     * 終了日に $sub 年分減算する
     *
     * @param  int  $sub
     * @return self
     */
    private function _endSubYear(int $sub): self
    {
        $this->reset();

        $this->endDatetime->subYear($sub)->endOfMonth();

        return $this;
    }

    /**
     * 開始日に $add ヶ月分加算する
     *
     * @param  int  $add
     * @return self
     */
    private function _startAddMonth(int $add): self
    {
        $this->reset();

        $this->startDatetime->addMonth($add)->startOfMonth();

        return $this;
    }

    /**
     * 終了日に $add ヶ月分加算する
     *
     * @param  int  $add
     * @return self
     */
    private function _endAddMonth(int $add): self
    {
        $this->reset();

        $this->endDatetime->addMonth($add)->endOfMonth();

        return $this;
    }

    /**
     * 終了日に $sub ヶ月分減算する
     *
     * @param  int  $sub
     * @return self
     */
    private function _startSubMonth(int $sub): self
    {
        $this->reset();

        $this->startDatetime->subMonth($sub)->startOfMonth();

        return $this;
    }

    /**
     * 終了日に $sub ヶ月分減算する
     *
     * @param  int  $sub
     * @return self
     */
    private function _endSubMonth(int $sub): self
    {
        $this->reset();

        $this->endDatetime->subMonth($sub)->endOfMonth();

        return $this;
    }

    /**
     * @return string
     */
    private function _getStartDatetime(): string
    {
        $this->reset();

        return $this->startDatetime->format('Y-m-d');
    }

    /**
     * @return string
     */
    private function _getEndDatetime(): string
    {
        $this->reset();

        return $this->endDatetime->format('Y-m-d');
    }

    /**
     * @param  int  $year
     * @param  int  $month
     * @param  int  $day
     * @param  mixed  $data
     * @return self
     */
    private function _setDay(int $year, int $month, int $day, mixed $data): self
    {
        $this->dayData[$year][$month][$day] = $data;

        return $this;
    }

    /**
     * @param string $encoding
     * @return self
     */
    private function _setEncoding(string $encoding)
    {
        if (in_array($encoding, array_keys(CalendararConst::HEADER_ENCODING), true)) {
            $this->encoding = $encoding;
        }

        return $this;
    }

    /**
     * 配列を作成する
     *
     * @return array
     */
    private function _create(): array
    {
        $this->reset();

        $startYear = (int) $this->startDatetime->format('Y');
        $endYear   = (int) $this->endDatetime->format('Y');

        $calendars = [];
        // 年ループ
        for ($year = $startYear; $year <= $endYear; $year++) {
            // 開始月を設定
            $startMonth = Carbon::JANUARY;
            if ($year === $startYear) {
                $startMonth = (int) $this->startDatetime->format('m');
            }

            // 終了月を設定
            $endMonth = Carbon::DECEMBER;
            if ($year === $endYear) {
                $endMonth = (int) $this->endDatetime->format('m');
            }

            // 月ループ
            for ($month = $startMonth; $month <= $endMonth; $month++) {
                // 該当月の1日の曜日番号を取得
                $firstWeekNo = (int) date('w', mktime(0, 0, 0, sprintf('%02d', $month), 1, $year));
                if ($firstWeekNo === Carbon::SUNDAY) {
                    $firstWeekNo = $this->firstDayOfWeekNo();
                }

                $weeks = [];
                for ($week = 1; $week <= 6; $week++) {
                    $weeks[$week] = [];
                }

                $day = 0;
                for ($week = 1; $week <= 6; $week++) {
                    // 前の週の最後の日を取得する
                    if (!empty($weeks[$week - 1][$this->lastDayOfWeekNo()]['day'])) {
                        $day = $weeks[$week - 1][$this->lastDayOfWeekNo()]['day'];
                    }
                    if ($day < 31) {
                        for ($dayOfWeek = $firstWeekNo; $dayOfWeek <= $this->lastDayOfWeekNo(); $dayOfWeek++) {
                            $day++;
                            $weeks[$week][$dayOfWeek] = [
                                'year'      => $year,
                                'month'     => $month,
                                'day'       => $day,
                                'week'      => $week,
                                'dayOfWeek' => $dayOfWeek,
                                'data'      => $this->dayData[$year][$month][$day] ?? [],
                            ];
                        }
                    }
                    $firstWeekNo = $this->firstDayOfWeekNo();
                }

                // 第1,5,6週について日付の正当性をチェック
                // 存在しない日付は空にする
                for ($dayOfWeek = $this->firstDayOfWeekNo(); $dayOfWeek <= $this->lastDayOfWeekNo(); $dayOfWeek++) {
                    if (!array_key_exists($dayOfWeek, $weeks[1])) {
                        $weeks[1][$dayOfWeek] = "";
                    }

                    if (!checkdate(sprintf('%02d', $month), $weeks[5][$dayOfWeek]['day'], $year)) {
                        $weeks[5][$dayOfWeek] = "";
                    }

                    if (!empty($weeks[6]) && !checkdate(sprintf('%02d', $month), $weeks[6][$dayOfWeek]['day'], $year)) {
                        $weeks[6][$dayOfWeek] = "";
                    }
                }

                // 第5,6週が存在するかチェックする
                for ($week = 5; $week <= 6; $week++) {
                    // 存在しなければ削除
                    if (empty($weeks[$week][$this->firstDayOfWeekNo()])) {
                        unset($weeks[$week]);
                    }
                }

                // 週毎に曜日番号で並び替え直す
                foreach (array_keys($weeks) as $week) {
                    ksort($weeks[$week]);
                }

                $calendars[$year][$month] = $weeks;
            }
        }

        return $calendars;
    }

    /**
     * @return string
     */
    private function _html(): string
    {
        $html = '';
        foreach ($this->create() as $year => $years) {
            foreach ($years as $month => $months) {
                $html .= '<table class="calendarar calendarar-' . $year .  sprintf('%02d', $month) . '">';
                $html .=   '<thead>';
                $html .=     '<tr>';

                // 月曜スタートでなければ日曜スタート
                if (!$this->mondayStart) {
                    $html .=   '<th class="sun">' . $this->trTemplate(Carbon::SUNDAY) . '</th>';
                }

                $html .=       '<th class="mon">' . $this->trTemplate(Carbon::MONDAY) . '</th>';
                $html .=       '<th class="tue">' . $this->trTemplate(Carbon::TUESDAY) . '</th>';
                $html .=       '<th class="wed">' . $this->trTemplate(Carbon::WEDNESDAY) . '</th>';
                $html .=       '<th class="thu">' . $this->trTemplate(Carbon::THURSDAY) . '</th>';
                $html .=       '<th class="fri">' . $this->trTemplate(Carbon::FRIDAY) . '</th>';
                $html .=       '<th class="sat">' . $this->trTemplate(Carbon::SATURDAY) . '</th>';

                // 月曜スタートであれば日曜ラスト
                if ($this->mondayStart) {
                    $html .=   '<th class="sun">' . $this->trTemplate(Carbon::SUNDAY) . '</th>';
                }

                $html .=     '</tr>';
                $html .=   '</thead>';
                $html .= '<tbody>';

                foreach ($months as $week => $weeks) {
                    $html .=  '<tr class="week' . $week . '">';
                    foreach ($weeks as $dayOfWeek => $day) {
                        $html .=  '<td class="' . CalendararConst::WEEKS[$dayOfWeek] . '">';
                        $html .= !empty($day['day'])
                            ? $this->tdTemplate($day['day'])
                            : '';
                        $html .= '</td>';
                    }
                    $html .= '</tr>';
                }
                $html .=   '</tbody>';
                $html .= '</table>';
            }
        }

        return $html;
    }

    /**
     * th のテンプレートセット
     *
     * @param  string  $template
     * @return self
     */
    private function _setTrTemplate(string $template): self
    {
        $this->trTemplate = $template;

        return $this;
    }

    /**
     * td のテンプレートセット
     *
     * @param  string  $template
     * @return self
     */
    private function _setTdTemplate(string $template): self
    {
        $this->tdTemplate = $template;

        return $this;
    }
}
