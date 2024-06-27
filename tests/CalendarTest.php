<?php

namespace Tests\Unit\Kanagama\Calendarar;

use Carbon\Carbon;
use DomDocument;
use Kanagama\Calendarar\Calendarar;
use Kanagama\Calendarar\Consts\CalendararConst;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class CalendarTest extends TestCase
{
    /**
     * @var Calendarar
     */
    private Calendarar $calendarar;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow('2023-02-14');

        $this->calendarar = new Calendarar(Carbon::now(), Carbon::now());
    }

    /**
     * @test
     */
    public function createでカレンダー配列が出力される()
    {
        $objectResponse = $this->calendarar->create();
        $this->assertTrue(is_array($objectResponse));
    }

    /**
     * @test
     */
    public function 静的createでもカレンダー配列が出力される()
    {
        $staticResponse = Calendarar::create();
        $this->assertTrue(is_array($staticResponse));
    }

    /**
     * @test
     */
    public function getStartDatetime開始日として月初がデフォルト指定されている()
    {
        $objectResponse = $this->calendarar->getStartDatetime();
        $this->assertIsString($objectResponse);
        $this->assertEquals($objectResponse, '2023-02-01');
    }

    /**
     * @test
     */
    public function 静的getStartDatetimeでも開始日として月初がデフォルト指定されている()
    {
        $staticResponse = Calendarar::getStartDatetime();
        $this->assertIsString($staticResponse);
        $this->assertEquals($staticResponse, '2023-02-01');
    }

    /**
     * @test
     */
    public function setStartMonthで開始月を指定できる()
    {
        $object = $this->calendarar->setStartMonth('2022-01-01');
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2022-01-01');
    }

    /**
     * @test
     */
    public function 静的setStartMonthでも開始月を指定できる()
    {
        $object = Calendarar::setStartMonth('2022-01-01');
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2022-01-01');
    }

    /**
     * @test
     */
    public function setEndMonthで終了月を指定できる()
    {
        $object = $this->calendarar->setEndMonth('2022-01-01');
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getEndDatetime(), '2022-01-31');
    }

    /**
     * @test
     */
    public function 静的setEndMonthでも終了月を指定できる()
    {
        $object = Calendarar::setEndMonth('2022-01-01');
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getEndDatetime(), '2022-01-31');
    }

    /**
     * @test
     */
    public function getEndDatetimeで終了日として月末がデフォルト指定されている()
    {
        $objectResponse = $this->calendarar->getEndDatetime();
        $this->assertIsString($objectResponse);
        $this->assertEquals($objectResponse, '2023-02-28');
    }

    /**
     * @test
     */
    public function 静的getEndDatetimeでも終了日として月末がデフォルト指定されている()
    {
        $staticResponse = Calendarar::getEndDatetime();
        $this->assertIsString($staticResponse);
        $this->assertEquals($staticResponse, '2023-02-28');
    }

    /**
     * @test
     */
    public function setで指定した開始月と終了月が指定できる()
    {
        $object = $this->calendarar->set('2022-02-01', '2022-03-28');
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2022-02-01');
        $this->assertEquals($object->getEndDatetime(), '2022-03-31');
    }

    /**
     * @test
     */
    public function 静的setでも開始付きと終了月が指定できる()
    {
        $static = Calendarar::set('2022-02-01', '2022-03-28');
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2022-02-01');
        $this->assertEquals($static->getEndDatetime(), '2022-03-31');
    }

    /**
     * @test
     */
    public function thisMonthで今月が設定される()
    {
        $object = $this->calendarar->thisMonth();
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-02-01');
        $this->assertEquals($object->getEndDatetime(), '2023-02-28');
    }

    /**
     * @test
     */
    public function 静的thisMonthでも今月が設定される()
    {
        $static = Calendarar::thisMonth();
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2023-02-01');
        $this->assertEquals($static->getEndDatetime(), '2023-02-28');
    }

    /**
     * @test
     */
    public function lastMonthで先月が設定される()
    {
        $object = $this->calendarar->lastMonth();
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-01-01');
        $this->assertEquals($object->getEndDatetime(), '2023-01-31');
    }

    /**
     * @test
     */
    public function 静的lastMonthでも先月が設定される()
    {
        $static = Calendarar::lastMonth();
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2023-01-01');
        $this->assertEquals($static->getEndDatetime(), '2023-01-31');
    }

    /**
     * @test
     */
    public function nextMonthで翌月が設定される()
    {
        $object = $this->calendarar->nextMonth();
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-03-01');
        $this->assertEquals($object->getEndDatetime(), '2023-03-31');
    }

    /**
     * @test
     */
    public function 静的nextMonthでも翌月が設定される()
    {
        $static = Calendarar::nextMonth();
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2023-03-01');
        $this->assertEquals($static->getEndDatetime(), '2023-03-31');
    }

    /**
     * @test
     */
    public function oneYearで今月から1年分のカレンダーが設定される()
    {
        $object = $this->calendarar->oneYear();
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-02-01');
        $this->assertEquals($object->getEndDatetime(), '2024-01-31');
    }

    /**
     * @test
     */
    public function 静的oneYearでも今月から1年分のカレンダーが設定される()
    {
        $static = Calendarar::oneYear();
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2023-02-01');
        $this->assertEquals($static->getEndDatetime(), '2024-01-31');
    }

    /**
     * @test
     */
    public function addStartYearで開始月が1年加算される()
    {
        $object = $this->calendarar->addStartYear(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2024-02-01');
    }

    /**
     * @test
     */
    public function 静的addStartYearでも開始月が1年加算される()
    {
        $static = Calendarar::addStartYear(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2024-02-01');
    }

    /**
     * @test
     */
    public function addEndYearで終了月が1年加算される()
    {
        $object = $this->calendarar->addEndYear(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getEndDatetime(), '2024-02-29');
    }

    /**
     * @test
     */
    public function 静的addEndYearでも終了月が1年加算される()
    {
        $static = Calendarar::addEndYear(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getEndDatetime(), '2024-02-29');
    }

    /**
     * @test
     */
    public function subStartYearで開始月が1年減算される()
    {
        $object = $this->calendarar->subStartYear(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2022-02-01');
    }

    /**
     * @test
     */
    public function 静的subStartYearでも開始月が1年減算される()
    {
        $static = Calendarar::subStartYear(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2022-02-01');
    }

    /**
     * @test
     */
    public function subEndYearで終了年が1年減算される()
    {
        $object = $this->calendarar->subEndYear(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getEndDatetime(), '2022-02-28');
    }

    /**
     * @test
     */
    public function 静的subEndYearでも終了年が1年減算される()
    {
        $static = Calendarar::subEndYear(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getEndDatetime(), '2022-02-28');
    }

    /**
     * @test
     */
    public function addStartMonthで開始月が1ヶ月加算される()
    {
        $object = $this->calendarar->addStartMonth(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-03-01');
    }

    /**
     * @test
     */
    public function 静的addStartMonthでも開始月が1ヶ月加算される()
    {
        $static = Calendarar::addStartMonth(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2023-03-01');
    }

    /**
     * @test
     */
    public function addEndMonthで終了月が1ヶ月加算される()
    {
        $object = $this->calendarar->addEndMonth(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getEndDatetime(), '2023-03-31');
    }

    /**
     * @test
     */
    public function 静的addEndMonthでも終了月が1ヶ月加算される()
    {
        $static = Calendarar::addEndMonth(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getEndDatetime(), '2023-03-31');
    }

    /**
     * @test
     */
    public function subStartMonthで開始月が1ヶ月減算される()
    {
        $object = $this->calendarar->subStartMonth(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-01-01');
    }

    /**
     * @test
     */
    public function 静的subStartMonthでも開始月が1ヶ月減算される()
    {
        $static = Calendarar::subStartMonth(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2023-01-01');
    }

    /**
     * @test
     */
    public function subEndMonthで終了月が1ヶ月減算される()
    {
        $object = $this->calendarar->subEndMonth(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getEndDatetime(), '2023-01-31');
    }

    /**
     * @test
     */
    public function 静的subEndMonthでも終了月が1ヶ月減算される()
    {
        $static = Calendarar::subEndMonth(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getEndDatetime(), '2023-01-31');
    }

    /**
     * @test
     * @dataProvider setEncondingProvider
     * @param  string  $encoding
     * @param  string  $dayOfWeek
     */
    public function setEncodingで指定の言語で表示されていること(
        string $encoding,
        string $dayOfWeek
    ) {
        // 正常に実行されること
        $object = $this->calendarar->setEncoding($encoding);
        $this->assertInstanceOf(Calendarar::class, $object);

        $response = $object->html();
        $targetHtml = mb_convert_encoding($response, 'HTML-ENTITIES', 'auto');

        $dom = new DOMDocument;
        $dom->loadHTML($targetHtml);
        $node = $dom->getElementsByTagName('th')->item(0);
        // 指定の言語で表示されていること
        $this->assertEquals($node->nodeValue, $dayOfWeek);
    }

    /**
     * @return array
     */
    public function setEncondingProvider(): array
    {
        return [
            'encodingを日本語に変換できること' => [
                'encoding' => 'ja',
                'dayOfWeek' => '日',
            ],
            'encodingを英語に変換できること' => [
                'encoding' => 'en',
                'dayOfWeek' => 'sun',
            ],
        ];
    }

    /**
     * @test
     */
    public function startOfMondayで曜日が月曜開始になる()
    {
        // 正常に実行されること
        $object = $this->calendarar->startOfMonday();
        $response = $object->setEncoding('en')->html();
        $this->assertTrue(!empty($response));

        return $response;
    }

    /**
     * @test
     */
    public function 静的startOfMondayでも曜日が月曜開始になる()
    {
        // 静的呼び出しができること
        $static = Calendarar::startOfMonday();
        $this->assertInstanceOf(Calendarar::class, $static);
    }

    /**
     * @test
     * @depends startOfMondayで曜日が月曜開始になる
     * @param  string  $response
     */
    public function 曜日が月曜から開始されていること(string $response)
    {
        $dom = new DOMDocument;
        $dom->loadHTML($response);

        $node = $dom->getElementsByTagName('th')->item(0);
        $this->assertEquals($node->nodeValue, 'mon');
    }

    /**
     * @test
     */
    public function startOfSundayで曜日が日曜開始になる()
    {
        // 正常に実行されること
        $object = $this->calendarar->startOfSunday();
        $response = $object->setEncoding('en')->html();
        $this->assertTrue(!empty($response));

        return $response;
    }

    /**
     * @test
     */
    public function 静的startOfSundayでも曜日が日曜開始になる()
    {
        $static = Calendarar::startOfSunday();
        $this->assertInstanceOf(Calendarar::class, $static);
    }

    /**
     * @test
     * @depends startOfSundayで曜日が日曜開始になる
     * @param string $response
     */
    public function 曜日が日曜から開始されていること(string $response)
    {
        $dom = new DOMDocument;
        $dom->loadHTML($response);

        $node = $dom->getElementsByTagName('th')->item(0);
        $this->assertEquals($node->nodeValue, 'sun');
    }

    /**
     * @test
     */
    public function htmlとして出力される()
    {
        // 正常に実行されること
        $response = $this->calendarar->html();
        $this->assertTrue(!empty($response));
    }

    /**
     * @test
     */
    public function createで開始月が終了月より後の場合は例外が発生する()
    {
        $this->expectException(RuntimeException::class);

        Calendarar::subEndMonth(1)->create();
    }

    /**
     * @test
     */
    public function 週開始が月曜の場合、日曜から始まる月が正しく設定されること()
    {
        $calendar = $this->calendarar
            ->startOfMonDay()
            ->set('2024-09-01', '2024-09-30')
            ->create();

        // 日曜が最初でなく、最後にある
        $this->assertFalse(isset($calendar[2024][9][1][Carbon::SUNDAY]));
        $this->assertTrue(isset($calendar[2024][9][1][CalendararConst::SUNDAY]));
        // 月の初日が日曜であること
        $this->assertSame($calendar[2024][9][1][CalendararConst::SUNDAY]['day'], 1);
        $this->assertSame($calendar[2024][9][1][CalendararConst::SUNDAY]['dayOfWeek'], CalendararConst::SUNDAY);
        // 月の最終日が月曜であること
        $this->assertSame($calendar[2024][9][6][Carbon::MONDAY]['day'], 30);
        $this->assertSame($calendar[2024][9][6][Carbon::MONDAY]['dayOfWeek'], Carbon::MONDAY);
    }

    /**
     * @test
     */
    public function 週開始が日曜の場合、日曜から始まる月が正しく設定されること()
    {
        $calendar = $this->calendarar
            ->startOfSunday()
            ->set('2024-09-01', '2024-09-30')
            ->create();

        // 日曜が最初で、7番目の要素がない
        $this->assertTrue(isset($calendar[2024][9][1][Carbon::SUNDAY]));
        $this->assertFalse(isset($calendar[2024][9][1][CalendararConst::SUNDAY]));
        // 月の初日が日曜であること
        $this->assertSame($calendar[2024][9][1][Carbon::SUNDAY]['day'], 1);
        $this->assertSame($calendar[2024][9][1][Carbon::SUNDAY]['dayOfWeek'], Carbon::SUNDAY);
        // 月の最終日が月曜であること
        $this->assertSame($calendar[2024][9][5][Carbon::MONDAY]['day'], 30);
        $this->assertSame($calendar[2024][9][5][Carbon::MONDAY]['dayOfWeek'], Carbon::MONDAY);
    }

    /**
     * @test
     */
    public function 週開始が月曜の場合、月曜から始まる月が正しく設定されること()
    {
        $calendar = $this->calendarar
            ->startOfMonday()
            ->set('2024-01-01', '2024-01-31')
            ->create();

        $this->assertFalse(isset($calendar[2024][1][1][Carbon::SUNDAY]));
        $this->assertTrue(isset($calendar[2024][1][1][CalendararConst::SUNDAY]));
        // 月の初日が月曜であること
        $this->assertSame($calendar[2024][1][1][Carbon::MONDAY]['day'], 1);
        $this->assertSame($calendar[2024][1][1][Carbon::MONDAY]['dayOfWeek'], Carbon::MONDAY);
        // 月の最終日が水曜であること
        $this->assertSame($calendar[2024][1][5][Carbon::WEDNESDAY]['day'], 31);
        $this->assertSame($calendar[2024][1][5][Carbon::WEDNESDAY]['dayOfWeek'], Carbon::WEDNESDAY);
    }

    /**
     * @test
     */
    public function 週開始が日曜の場合、月曜から始まる月が正しく設定されること()
    {
        $calendar = $this->calendarar
            ->startOfSunday()
            ->set('2024-01-01', '2024-01-31')
            ->create();

        $this->assertTrue(isset($calendar[2024][1][1][Carbon::SUNDAY]));
        $this->assertFalse(isset($calendar[2024][1][1][CalendararConst::SUNDAY]));
        // 月の初日が月曜であること
        $this->assertSame($calendar[2024][1][1][Carbon::MONDAY]['day'], 1);
        $this->assertSame($calendar[2024][1][1][Carbon::MONDAY]['dayOfWeek'], Carbon::MONDAY);
        // 月の最終日が水曜であること
        $this->assertSame($calendar[2024][1][5][Carbon::WEDNESDAY]['day'], 31);
        $this->assertSame($calendar[2024][1][5][Carbon::WEDNESDAY]['dayOfWeek'], Carbon::WEDNESDAY);
    }

    /**
     * @test
     */
    public function 週開始が月曜の場合、火曜から始まる月が正しく設定されること()
    {
        $calendar = $this->calendarar
            ->startOfMonday()
            ->set('2024-10-01', '2024-10-31')
            ->create();

        $this->assertFalse(isset($calendar[2024][10][1][Carbon::SUNDAY]));
        $this->assertTrue(isset($calendar[2024][10][1][CalendararConst::SUNDAY]));
        // 月の初日が火曜であること
        $this->assertSame($calendar[2024][10][1][Carbon::TUESDAY]['day'], 1);
        $this->assertSame($calendar[2024][10][1][Carbon::TUESDAY]['dayOfWeek'], Carbon::TUESDAY);
        // 月の最終日が木曜であること
        $this->assertSame($calendar[2024][10][5][Carbon::THURSDAY]['day'], 31);
        $this->assertSame($calendar[2024][10][5][Carbon::THURSDAY]['dayOfWeek'], Carbon::THURSDAY);
    }

    /**
     * @test
     */
    public function 週開始が日曜の場合、火曜から始まる月が正しく設定されること()
    {
        $calendar = $this->calendarar
            ->startOfSunday()
            ->set('2024-10-01', '2024-10-31')
            ->create();

        $this->assertTrue(isset($calendar[2024][10][1][0]));
        $this->assertFalse(isset($calendar[2024][10][1][7]));
        // 月の初日が火曜であること
        $this->assertSame($calendar[2024][10][1][Carbon::TUESDAY]['day'], 1);
        $this->assertSame($calendar[2024][10][1][Carbon::TUESDAY]['dayOfWeek'], Carbon::TUESDAY);
        // 月の最終日が木曜であること
        $this->assertSame($calendar[2024][10][5][Carbon::THURSDAY]['day'], 31);
        $this->assertSame($calendar[2024][10][5][Carbon::THURSDAY]['dayOfWeek'], Carbon::THURSDAY);
    }

    /**
     * @test
     */
    public function 週開始が月曜の場合、水曜から始まる月が正しく設定されること()
    {
        $calendar = $this->calendarar
            ->startOfMonday()
            ->set('2024-05-01', '2024-05-31')
            ->create();

        $this->assertFalse(isset($calendar[2024][5][1][Carbon::SUNDAY]));
        $this->assertTrue(isset($calendar[2024][5][1][CalendararConst::SUNDAY]));
        // 月の初日が水曜であること
        $this->assertSame($calendar[2024][5][1][Carbon::WEDNESDAY]['day'], 1);
        $this->assertSame($calendar[2024][5][1][Carbon::WEDNESDAY]['dayOfWeek'], Carbon::WEDNESDAY);
        // 月の最終日が金曜であること
        $this->assertSame($calendar[2024][5][5][Carbon::FRIDAY]['day'], 31);
        $this->assertSame($calendar[2024][5][5][Carbon::FRIDAY]['dayOfWeek'], Carbon::FRIDAY);
    }

    /**
     * @test
     */
    public function 週開始が日曜の場合、水曜から始まる月が正しく設定されること()
    {
        $calendar = $this->calendarar
            ->startOfSunday()
            ->set('2024-05-01', '2024-05-31')
            ->create();

        $this->assertTrue(isset($calendar[2024][5][1][0]));
        $this->assertFalse(isset($calendar[2024][5][1][7]));
        // 月の初日が水曜であること
        $this->assertSame($calendar[2024][5][1][Carbon::WEDNESDAY]['day'], 1);
        $this->assertSame($calendar[2024][5][1][Carbon::WEDNESDAY]['dayOfWeek'], Carbon::WEDNESDAY);
        // 月の最終日が金曜であること
        $this->assertSame($calendar[2024][5][5][Carbon::FRIDAY]['day'], 31);
        $this->assertSame($calendar[2024][5][5][Carbon::FRIDAY]['dayOfWeek'], Carbon::FRIDAY);
    }

    /**
     * @test
     */
    public function 週開始が月曜の場合、木曜から始まる月が正しく設定されること()
    {
        $calendar = $this->calendarar
            ->startOfMonday()
            ->set('2024-08-01', '2024-08-31')
            ->create();

        $this->assertFalse(isset($calendar[2024][8][1][Carbon::SUNDAY]));
        $this->assertTrue(isset($calendar[2024][8][1][CalendararConst::SUNDAY]));
        // 月の初日が木曜であること
        $this->assertSame($calendar[2024][8][1][Carbon::THURSDAY]['day'], 1);
        $this->assertSame($calendar[2024][8][1][Carbon::THURSDAY]['dayOfWeek'], Carbon::THURSDAY);
        // 月の最終日が土曜であること
        $this->assertSame($calendar[2024][8][5][Carbon::SATURDAY]['day'], 31);
        $this->assertSame($calendar[2024][8][5][Carbon::SATURDAY]['dayOfWeek'], Carbon::SATURDAY);
    }

    /**
     * @test
     */
    public function 週開始が日曜の場合、木曜から始まる月が正しく設定されること()
    {
        $calendar = $this->calendarar
            ->startOfSunday()
            ->set('2024-08-01', '2024-08-31')
            ->create();

        $this->assertTrue(isset($calendar[2024][8][1][Carbon::SUNDAY]));
        $this->assertFalse(isset($calendar[2024][8][1][CalendararConst::SUNDAY]));
        // 月の初日が木曜であること
        $this->assertSame($calendar[2024][8][1][Carbon::THURSDAY]['day'], 1);
        $this->assertSame($calendar[2024][8][1][Carbon::THURSDAY]['dayOfWeek'], Carbon::THURSDAY);
        // 月の最終日が土曜であること
        $this->assertSame($calendar[2024][8][5][Carbon::SATURDAY]['day'], 31);
        $this->assertSame($calendar[2024][8][5][Carbon::SATURDAY]['dayOfWeek'], Carbon::SATURDAY);
    }

    /**
     * @test
     */
    public function 週開始が月曜の場合、金曜から始まる月が正しく設定されること()
    {
        $calendar = $this->calendarar
            ->startOfMonday()
            ->set('2024-03-01', '2024-03-31')
            ->create();

        $this->assertFalse(isset($calendar[2024][3][1][Carbon::SUNDAY]));
        $this->assertTrue(isset($calendar[2024][3][1][CalendararConst::SUNDAY]));
        // 月の初日が金曜であること
        $this->assertSame($calendar[2024][3][1][Carbon::FRIDAY]['day'], 1);
        $this->assertSame($calendar[2024][3][1][Carbon::FRIDAY]['dayOfWeek'], Carbon::FRIDAY);
        // 月の最終日が土曜であること
        $this->assertSame($calendar[2024][3][5][CalendararConst::SUNDAY]['day'], 31);
        $this->assertSame($calendar[2024][3][5][CalendararConst::SUNDAY]['dayOfWeek'], CalendararConst::SUNDAY);
    }

    /**
     * @test
     */
    public function 週開始が日曜の場合、金曜から始まる月が正しく設定されること()
    {
        $calendar = $this->calendarar
            ->startOfSunday()
            ->set('2024-03-01', '2024-03-31')
            ->create();

        $this->assertTrue(isset($calendar[2024][3][1][Carbon::SUNDAY]));
        $this->assertFalse(isset($calendar[2024][3][1][CalendararConst::SUNDAY]));
        // 月の初日が金曜であること
        $this->assertSame($calendar[2024][3][1][Carbon::FRIDAY]['day'], 1);
        $this->assertSame($calendar[2024][3][1][Carbon::FRIDAY]['dayOfWeek'], Carbon::FRIDAY);
        // 月の最終日が土曜であること
        $this->assertSame($calendar[2024][3][6][Carbon::SUNDAY]['day'], 31);
        $this->assertSame($calendar[2024][3][6][Carbon::SUNDAY]['dayOfWeek'], Carbon::SUNDAY);
    }

    /**
     * @test
     */
    public function 週開始が月曜の場合、土曜日から始まる月が正しく設定されること()
    {
        $calendar = $this->calendarar
            ->startOfMonday()
            ->set('2024-06-01', '2024-06-30')
            ->create();

        $this->assertFalse(isset($calendar[2024][6][1][Carbon::SUNDAY]));
        $this->assertTrue(isset($calendar[2024][6][1][CalendararConst::SUNDAY]));
        // 月の初日が土曜であること
        $this->assertSame($calendar[2024][6][1][Carbon::SATURDAY]['day'], 1);
        $this->assertSame($calendar[2024][6][1][Carbon::SATURDAY]['dayOfWeek'], Carbon::SATURDAY);
        // 月の最終日が日曜であること
        $this->assertSame($calendar[2024][6][5][CalendararConst::SUNDAY]['day'], 30);
        $this->assertSame($calendar[2024][6][5][CalendararConst::SUNDAY]['dayOfWeek'], CalendararConst::SUNDAY);
    }

    /**
     * @test
     */
    public function 週開始が日曜の場合、土曜日から始まる月が正しく設定されること()
    {
        $calendar = $this->calendarar
            ->startOfSunday()
            ->set('2024-06-01', '2024-06-30')
            ->create();

        $this->assertTrue(isset($calendar[2024][6][1][Carbon::SUNDAY]));
        $this->assertFalse(isset($calendar[2024][6][1][CalendararConst::SUNDAY]));
        // 月の初日が土曜であること
        $this->assertSame($calendar[2024][6][1][Carbon::SATURDAY]['day'], 1);
        $this->assertSame($calendar[2024][6][1][Carbon::SATURDAY]['dayOfWeek'], Carbon::SATURDAY);
        // 月の最終日が日曜であること
        $this->assertSame($calendar[2024][6][6][Carbon::SUNDAY]['day'], 30);
        $this->assertSame($calendar[2024][6][6][Carbon::SUNDAY]['dayOfWeek'], Carbon::SUNDAY);
    }

    /**
     * @test
     */
    public function 週開始が月曜の場合、うるう年の2月が正しく設定されること()
    {
        $calendar = $this->calendarar
            ->startOfMonday()
            ->set('2024-02-01', '2024-02-29')
            ->create();

        $this->assertFalse(isset($calendar[2024][2][1][Carbon::SUNDAY]));
        $this->assertTrue(isset($calendar[2024][2][1][CalendararConst::SUNDAY]));
        // 月の初日が木曜であること
        $this->assertSame($calendar[2024][2][1][Carbon::THURSDAY]['day'], 1);
        $this->assertSame($calendar[2024][2][1][Carbon::THURSDAY]['dayOfWeek'], Carbon::THURSDAY);
        // 月の最終日が木曜であること
        $this->assertSame($calendar[2024][2][5][Carbon::THURSDAY]['day'], 29);
        $this->assertSame($calendar[2024][2][5][Carbon::THURSDAY]['dayOfWeek'], Carbon::THURSDAY);
    }

    /**
     * @test
     */
    public function 週開始が日曜の場合、うるう年の2月が正しく設定されること()
    {
        $calendar = $this->calendarar
            ->startOfSunday()
            ->set('2024-02-01', '2024-02-29')
            ->create();

        $this->assertTrue(isset($calendar[2024][2][1][Carbon::SUNDAY]));
        $this->assertFalse(isset($calendar[2024][2][1][CalendararConst::SUNDAY]));
        // 月の初日が木曜であること
        $this->assertSame($calendar[2024][2][1][Carbon::THURSDAY]['day'], 1);
        $this->assertSame($calendar[2024][2][1][Carbon::THURSDAY]['dayOfWeek'], Carbon::THURSDAY);
        // 月の最終日が木曜であること
        $this->assertSame($calendar[2024][2][5][Carbon::THURSDAY]['day'], 29);
        $this->assertSame($calendar[2024][2][5][Carbon::THURSDAY]['dayOfWeek'], Carbon::THURSDAY);
    }

    /**
     * @test
     */
    public function 週開始が月曜の場合、うるう年でない2月が正しく設定されること()
    {
        $calendar = $this->calendarar
            ->startOfMonday()
            ->set('2023-02-01', '2023-02-28')
            ->create();

        $this->assertFalse(isset($calendar[2023][2][1][Carbon::SUNDAY]));
        $this->assertTrue(isset($calendar[2023][2][1][CalendararConst::SUNDAY]));
        // 月の初日が水曜であること
        $this->assertSame($calendar[2023][2][1][Carbon::WEDNESDAY]['day'], 1);
        $this->assertSame($calendar[2023][2][1][Carbon::WEDNESDAY]['dayOfWeek'], Carbon::WEDNESDAY);
        // 月の最終日が火曜であること
        $this->assertSame($calendar[2023][2][5][Carbon::TUESDAY]['day'], 28);
        $this->assertSame($calendar[2023][2][5][Carbon::TUESDAY]['dayOfWeek'], Carbon::TUESDAY);
    }

    /**
     * @test
     */
    public function 週開始が日曜の場合、うるう年でない2月が正しく設定されること()
    {
        $calendar = $this->calendarar
            ->startOfSunday()
            ->set('2023-02-01', '2023-02-28')
            ->create();

        $this->assertTrue(isset($calendar[2023][2][1][Carbon::SUNDAY]));
        $this->assertFalse(isset($calendar[2023][2][1][CalendararConst::SUNDAY]));
        // 月の初日が水曜であること
        $this->assertSame($calendar[2023][2][1][Carbon::WEDNESDAY]['day'], 1);
        $this->assertSame($calendar[2023][2][1][Carbon::WEDNESDAY]['dayOfWeek'], Carbon::WEDNESDAY);
        // 月の最終日が火曜であること
        $this->assertSame($calendar[2023][2][5][Carbon::TUESDAY]['day'], 28);
        $this->assertSame($calendar[2023][2][5][Carbon::TUESDAY]['dayOfWeek'], Carbon::TUESDAY);
    }
}
