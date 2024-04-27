<?php

namespace Kanagama\Calendarar;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Kanagama\Calendarar\Consts\CalendararConst;
use Kanagama\Calendarar\Traits\CalendarPrivateFunctionTrait;
use Kanagama\Calendarar\Traits\DeprecatedMethod;
use Kanagama\Calendarar\ValueObject\Deprecated;
use RuntimeException;

/**
 * カレンダー配列を生成する
 *
 * @method self startOfMonday() 週の始めを月曜日に設定
 * @method self startOfSunday() 週の始めを日曜日に設定
 * @method self setStartMonth(mixed $start) 開始月を設定する
 * @method self setEndMonth(mixed $end) 終了月を設定する
 * @method array create() カレンダー配列を作成する
 * @method string getStartDatetime() 開始日を取得する
 * @method string getEndDatetime() 終了日を取得する
 * @method self set(mixed $start, mixed $end) 開始日と終了日を設定する
 * @method self thisMonth() 今月分に設定
 * @method self lastMonth() 先月分に設定
 * @method self nextMonth() 来月分に設定
 * @method self oneYear() 今月から1年分の配列を作成する
 * @method self addStartYear(int $add) 開始日に $add 年分加算する
 * @method self addEndYear(int $add) 終了日に $add 年分加算する
 * @method self subStartYear(int $sub) 開始日に $sub 年分減算する
 * @method self subEndYear(int $sub) 終了日に $sub 年分減算する
 * @method self addStartMonth(int $add) 開始日に $add ヶ月分加算する
 * @method self addEndMonth(int $add) 終了日に $add ヶ月分加算する
 * @method self subStartMonth(int $sub) 開始日に $sub ヶ月分減算する
 * @method self subEndMonth(int $sub) 終了日に $sub ヶ月分減算する
 *
 * @method static self startOfMonday() 週の始めを月曜日に設定
 * @method static self startOfSunday() 週の始めを日曜日に設定
 * @method static self setStartMonth(mixed $start) 開始月を設定する
 * @method static self setEndMonth(mixed $end) 終了月を設定する
 * @method static array create() カレンダー配列を作成する
 * @method static string getStartDatetime() 開始日を取得する
 * @method static string getEndDatetime() 終了日を取得する
 * @method static self set(mixed $start, mixed $end) 開始日と終了日を設定する
 * @method static self thisMonth() 今月分に設定
 * @method static self lastMonth() 先月分に設定
 * @method static self nextMonth() 来月分に設定
 * @method static self oneYear() 今月から1年分の配列を作成する
 * @method static self addStartYear(int $add) 開始日に $add 年分加算する
 * @method static self addEndYear(int $add) 終了日に $add 年分加算する
 * @method static self subStartYear(int $sub) 開始日に $sub 年分減算する
 * @method static self subEndYear(int $sub) 終了日に $sub 年分減算する
 * @method static self addStartMonth(int $add) 開始日に $add ヶ月分加算する
 * @method static self addEndMonth(int $add) 終了日に $add ヶ月分加算する
 * @method static self subStartMonth(int $sub) 開始日に $sub ヶ月分減算する
 * @method static self subEndMonth(int $sub) 終了日に $sub ヶ月分減算する
 *
 * @author k-nagama <k.nagama0632@gmail.com>
 * @throws RuntimeException 開始月が終了月よりも後になっている場合
 */
final class Calendarar
{
    use CalendarPrivateFunctionTrait;
    use DeprecatedMethod;

    /**
     * 開始日
     *
     * @var Carbon|null
     */
    private ?Carbon $startDatetime = null;

    /**
     * 終了日
     *
     * @var Carbon|null
     */
    private ?Carbon $endDatetime = null;

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
     * @test
     * @param  Carbon|CarbonImmutable|string|null  $start
     * @param  Carbon|CarbonImmutable|string|null  $end
     */
    public function __construct($start = null, $end = null)
    {
        if ($start !== null) {
            $this->setStartMonth($start);
        }
        if ($end !== null) {
            $this->setEndMonth($end);
        }

        $this->reset();
    }

    /**
     * 動的呼び出し
     *
     * @test
     * @param  string  $name
     * @param  array  $args
     * @return mixed
     */
    public function __call($name, $args)
    {
        Deprecated::deprecatedMessage($name);

        $callMethod = '_' . $name;
        if (method_exists($this, $callMethod)) {
            return call_user_func_array(array($this, $callMethod), $args);
        }
    }

    /**
     * 静的呼び出し
     *
     * @test
     * @param  string  $name
     * @param  array  $args
     * @return mixed
     */
    public static function __callStatic($name, $args)
    {
        Deprecated::deprecatedMessage($name);

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
     * @test
     * @return array
     */
    public function __invoke(): array
    {
        $this->reset();

        return $this->create();
    }

    /**
     * 開始月を設定する
     *
     * @param  mixed  $start
     * @return self
     */
    private function _setStartMonth($start): self
    {
        $carbon = new Carbon();
        if (empty($start) === false) {
            $carbon = new Carbon($start);
        }

        $this->startDatetime = $carbon->startOfMonth();

        return $this;
    }

    /**
     * 終了月を設定
     *
     * @param  mixed  $end
     * @return self
     */
    private function _setEndMonth($end): self
    {
        $carbon = new Carbon();
        if (empty($end) === false) {
            $carbon = new Carbon($end);
        }

        $this->endDatetime = $carbon->endOfMonth();

        return $this;

    }

    /**
     * 開始月と終了月を設定する
     *
     * @test
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
     * @test
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
     * @test
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
     * @test
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
     * @test
     * @return self
     */
    private function _lastMonth(): self
    {
        $this->startDatetime = Carbon::now()->subMonth()->startOfMonth();
        $this->endDatetime = Carbon::now()->subMonth()->endOfMonth();

        return $this;
    }

    /**
     * 来月分に設定
     *
     * @test
     * @return self
     */
    private function _nextMonth(): self
    {
        $this->startDatetime = Carbon::now()->addMonth()->startOfMonth();
        $this->endDatetime = Carbon::now()->addMonth()->endOfMonth();

        return $this;
    }

    /**
     * 今月から1年分の配列を作成する
     *
     * @test
     * @return self
     */
    private function _oneYear(): self
    {
        $this->startDatetime = Carbon::now()->startOfMonth();
        $this->endDatetime = Carbon::now()->addMonths(11)->endOfMonth();

        return $this;
    }

    /**
     * 開始日に $add 年分加算する
     *
     * @test
     * @param  int  $add
     * @return self
     */
    private function _addStartYear(int $add): self
    {
        $this->reset();

        $this->startDatetime->addYears($add)->startOfMonth();

        return $this;
    }

    /**
     * 終了日に $add 年分加算する
     *
     * @test
     * @param  int  $add
     * @return self
     */
    private function _addEndYear(int $add): self
    {
        $this->reset();

        $this->endDatetime->addYears($add)->endOfMonth();

        return $this;
    }

    /**
     * 開始日に $sub 年分減算する
     *
     * @test
     * @param  int  $sub
     * @return self
     */
    private function _subStartYear(int $sub): self
    {
        $this->reset();

        $this->startDatetime->subYears($sub)->startOfMonth();

        return $this;
    }

    /**
     * 終了日に $sub 年分減算する
     *
     * @test
     * @param  int  $sub
     * @return self
     */
    private function _subEndYear(int $sub): self
    {
        $this->reset();

        $this->endDatetime->subYears($sub)->endOfMonth();

        return $this;
    }

    /**
     * 開始日に $add ヶ月分加算する
     *
     * @test
     * @param  int  $add
     * @return self
     */
    private function _addStartMonth(int $add): self
    {
        $this->reset();

        $this->startDatetime->addMonths($add)->startOfMonth();

        return $this;
    }

    /**
     * 終了日に $add ヶ月分加算する
     *
     * @test
     * @param  int  $add
     * @return self
     */
    private function _addEndMonth(int $add): self
    {
        $this->reset();

        $this->endDatetime->addMonths($add)->endOfMonth();

        return $this;
    }

    /**
     * 終了日に $sub ヶ月分減算する
     *
     * @test
     * @param  int  $sub
     * @return self
     */
    private function _subStartMonth(int $sub): self
    {
        $this->reset();

        $this->startDatetime->subMonths($sub)->startOfMonth();

        return $this;
    }

    /**
     * 終了日に $sub ヶ月分減算する
     *
     * @test
     * @param  int  $sub
     * @return self
     */
    private function _subEndMonth(int $sub): self
    {
        $this->reset();

        $this->endDatetime->subMonths($sub)->endOfMonth();

        return $this;
    }

    /**
     * @test
     * @return string
     */
    private function _getStartDatetime(): string
    {
        $this->reset();

        return $this->startDatetime->format('Y-m-d');
    }

    /**
     * @test
     * @return string
     */
    private function _getEndDatetime(): string
    {
        $this->reset();

        return $this->endDatetime->format('Y-m-d');
    }

    /**
     * @test
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
     * @test
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
     * @test
     * @return array
     * @throws RuntimeException
     */
    private function _create(): array
    {
        $this->reset();

        if ((int) $this->startDatetime->format('Ymd') > (int) $this->endDatetime->format('Ymd')) {
            throw new RuntimeException('開始日が終了日よりも後になっています。');
        }

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
                        $weeks[1][$dayOfWeek] = [];
                    }

                    if (!checkdate(sprintf('%02d', $month), $weeks[5][$dayOfWeek]['day'], $year)) {
                        $weeks[5][$dayOfWeek] = [];
                    }

                    if (!empty($weeks[6]) && !checkdate(sprintf('%02d', $month), $weeks[6][$dayOfWeek]['day'], $year)) {
                        $weeks[6][$dayOfWeek] = [];
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
     * @test
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
                        $html .=  '<td class="' . CalendararConst::WEEKS[$dayOfWeek] . ' ' . $this->setDayClass($day) . '">';
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
     * @test
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
     * @test
     * @param  string  $template
     * @return self
     */
    private function _setTdTemplate(string $template): self
    {
        $this->tdTemplate = $template;

        return $this;
    }
}
