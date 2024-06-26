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
    public function カレンダー配列が出力される()
    {
        $objectResponse = $this->calendarar->create();
        $this->assertTrue(is_array($objectResponse));
    }

    /**
     * @test
     */
    public function 静的でもカレンダー配列が出力される()
    {
        $staticResponse = Calendarar::create();
        $this->assertTrue(is_array($staticResponse));
    }

    /**
     * @test
     */
    public function 開始日として月初がデフォルト指定されている()
    {
        $objectResponse = $this->calendarar->getStartDatetime();
        $this->assertIsString($objectResponse);
        $this->assertEquals($objectResponse, '2023-02-01');
    }

    /**
     * @test
     */
    public function 静的でも開始日として月初がデフォルト指定されている()
    {
        $staticResponse = Calendarar::getStartDatetime();
        $this->assertIsString($staticResponse);
        $this->assertEquals($staticResponse, '2023-02-01');
    }

    /**
     * @test
     */
    public function 開始月を指定できる()
    {
        $object = $this->calendarar->setStartMonth('2022-01-01');
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2022-01-01');
    }

    /**
     * @test
     */
    public function 静的でも開始月を指定できる()
    {
        $object = Calendarar::setStartMonth('2022-01-01');
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2022-01-01');
    }

    /**
     * @test
     */
    public function 終了月を指定できる()
    {
        $object = $this->calendarar->setEndMonth('2022-01-01');
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getEndDatetime(), '2022-01-31');
    }

    /**
     * @test
     */
    public function 静的でも終了月を指定できる()
    {
        $object = Calendarar::setEndMonth('2022-01-01');
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getEndDatetime(), '2022-01-31');
    }

    /**
     * @test
     */
    public function 終了日として月末がデフォルト指定されている()
    {
        $objectResponse = $this->calendarar->getEndDatetime();
        $this->assertIsString($objectResponse);
        $this->assertEquals($objectResponse, '2023-02-28');
    }

    /**
     * @test
     */
    public function 静的でも終了日として月末がデフォルト指定されている()
    {
        $staticResponse = Calendarar::getEndDatetime();
        $this->assertIsString($staticResponse);
        $this->assertEquals($staticResponse, '2023-02-28');
    }

    /**
     * @test
     */
    public function 指定した開始月と終了月が指定できる()
    {
        $object = $this->calendarar->set('2022-02-01', '2022-03-28');
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2022-02-01');
        $this->assertEquals($object->getEndDatetime(), '2022-03-31');
    }

    /**
     * @test
     */
    public function 静的でも開始付きと終了月が指定できる()
    {
        $static = Calendarar::set('2022-02-01', '2022-03-28');
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2022-02-01');
        $this->assertEquals($static->getEndDatetime(), '2022-03-31');
    }

    /**
     * @test
     */
    public function 今月が設定される()
    {
        $object = $this->calendarar->thisMonth();
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-02-01');
        $this->assertEquals($object->getEndDatetime(), '2023-02-28');
    }

    /**
     * @test
     */
    public function 静的でも今月が設定される()
    {
        $static = Calendarar::thisMonth();
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2023-02-01');
        $this->assertEquals($static->getEndDatetime(), '2023-02-28');
    }

    /**
     * @test
     */
    public function 先月が設定される()
    {
        $object = $this->calendarar->lastMonth();
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-01-01');
        $this->assertEquals($object->getEndDatetime(), '2023-01-31');
    }

    /**
     * @test
     */
    public function 静的でも先月が設定される()
    {
        $static = Calendarar::lastMonth();
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2023-01-01');
        $this->assertEquals($static->getEndDatetime(), '2023-01-31');
    }

    /**
     * @test
     */
    public function 翌月が設定される()
    {
        $object = $this->calendarar->nextMonth();
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-03-01');
        $this->assertEquals($object->getEndDatetime(), '2023-03-31');
    }

    /**
     * @test
     */
    public function 静的でも翌月が設定される()
    {
        $static = Calendarar::nextMonth();
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2023-03-01');
        $this->assertEquals($static->getEndDatetime(), '2023-03-31');
    }

    /**
     * @test
     */
    public function 今月から1年分のカレンダーが設定される()
    {
        $object = $this->calendarar->oneYear();
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-02-01');
        $this->assertEquals($object->getEndDatetime(), '2024-01-31');
    }

    /**
     * @test
     */
    public function 静的でも今月から1年分のカレンダーが設定される()
    {
        $static = Calendarar::oneYear();
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2023-02-01');
        $this->assertEquals($static->getEndDatetime(), '2024-01-31');
    }

    /**
     * @test
     */
    public function 開始月が1年加算される()
    {
        $object = $this->calendarar->addStartYear(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2024-02-01');
    }

    /**
     * @test
     */
    public function 静的でも開始月が1年加算される()
    {
        $static = Calendarar::addStartYear(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2024-02-01');
    }

    /**
     * @test
     */
    public function 終了月が1年加算される()
    {
        $object = $this->calendarar->addEndYear(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getEndDatetime(), '2024-02-29');
    }

    /**
     * @test
     */
    public function 静的でも終了月が1年加算される()
    {
        $static = Calendarar::addEndYear(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getEndDatetime(), '2024-02-29');
    }

    /**
     * @test
     */
    public function 開始月が1年減算される()
    {
        $object = $this->calendarar->subStartYear(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2022-02-01');
    }

    /**
     * @test
     */
    public function 静的でも開始月が1年減算される()
    {
        $static = Calendarar::subStartYear(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2022-02-01');
    }

    /**
     * @test
     */
    public function 終了年が1年減算される()
    {
        $object = $this->calendarar->subEndYear(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getEndDatetime(), '2022-02-28');
    }

    /**
     * @test
     */
    public function 静的でも終了年が1年減算される()
    {
        $static = Calendarar::subEndYear(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getEndDatetime(), '2022-02-28');
    }

    /**
     * @test
     */
    public function 開始月が1ヶ月加算される()
    {
        $object = $this->calendarar->addStartMonth(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-03-01');
    }

    /**
     * @test
     */
    public function 静的でも開始月が1ヶ月加算される()
    {
        $static = Calendarar::addStartMonth(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2023-03-01');
    }

    /**
     * @test
     */
    public function 終了月が1ヶ月加算される()
    {
        $object = $this->calendarar->addEndMonth(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getEndDatetime(), '2023-03-31');
    }

    /**
     * @test
     */
    public function 静的でも終了月が1ヶ月加算される()
    {
        $static = Calendarar::addEndMonth(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getEndDatetime(), '2023-03-31');
    }

    /**
     * @test
     */
    public function 開始月が1ヶ月減算される()
    {
        $object = $this->calendarar->subStartMonth(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-01-01');
    }

    /**
     * @test
     */
    public function 静的でも開始月が1ヶ月減算される()
    {
        $static = Calendarar::subStartMonth(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2023-01-01');
    }

    /**
     * @test
     */
    public function 終了月が1ヶ月減算される()
    {
        $object = $this->calendarar->subEndMonth(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getEndDatetime(), '2023-01-31');
    }

    /**
     * @test
     */
    public function 静的でも終了月が1ヶ月減算される()
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
    public function 指定の言語で表示されていること(
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
    public function 曜日が月曜開始になる()
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
    public function 静的でも曜日が月曜開始になる()
    {
        // 静的呼び出しができること
        $static = Calendarar::startOfMonday();
        $this->assertInstanceOf(Calendarar::class, $static);
    }

    /**
     * @test
     * @depends 曜日が月曜開始になる
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
    public function 曜日が日曜開始になる()
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
    public function 静的でも曜日が日曜開始になる()
    {
        $static = Calendarar::startOfSunday();
        $this->assertInstanceOf(Calendarar::class, $static);
    }

    /**
     * @test
     * @depends 曜日が日曜開始になる
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
    public function 開始月が終了月より後の場合は例外が発生する()
    {
        $this->expectException(RuntimeException::class);

        Calendarar::subEndMonth(1)->create();
    }

    /**
     * @test
     */
    public function 週開始が月曜の場合、日曜から始まる月が正しく設定されること()
    {
        $object = $this->calendarar
            ->startOfMonDay()
            ->set('2024-09-01', '2024-09-30');

        $calendar = $object->create();

        // 月の初日が日曜であること
        $this->assertSame($calendar[2024][9][1][7]['day'], 1);
        $this->assertSame($calendar[2024][9][1][7]['dayOfWeek'], CalendararConst::SUNDAY);
        // 月の最終日が月曜であること
        $this->assertSame($calendar[2024][9][6][1]['day'], 30);
        $this->assertSame($calendar[2024][9][6][1]['dayOfWeek'], Carbon::MONDAY);
    }

    /**
     * @test
     */
    public function 週開始が日曜の場合、日曜から始まる月が正しく設定されること()
    {
        $object = $this->calendarar
            ->startOfSunday()
            ->set('2024-09-01', '2024-09-30');

        $calendar = $object->create();

        // 月の初日が日曜であること
        $this->assertSame($calendar[2024][9][1][0]['day'], 1);
        $this->assertSame($calendar[2024][9][1][0]['dayOfWeek'], Carbon::SUNDAY);
        // 月の最終日が月曜であること
        $this->assertSame($calendar[2024][9][5][1]['day'], 30);
        $this->assertSame($calendar[2024][9][5][1]['dayOfWeek'], Carbon::MONDAY);
    }

    /**
     * @test
     */
    public function 週開始が月曜の場合、月曜から始まる月が正しく設定されること()
    {
        $object = $this->calendarar
            ->startOfMonday()
            ->set('2024-01-01', '2024-01-30');

        $calendar = $object->create();

        // 月の初日が月曜であること
        $this->assertSame($calendar[2024][1][1][1]['day'], 1);
        $this->assertSame($calendar[2024][1][1][1]['dayOfWeek'], Carbon::MONDAY);
        // 月の最終日が水曜であること
        $this->assertSame($calendar[2024][1][5][3]['day'], 31);
        $this->assertSame($calendar[2024][1][5][3]['dayOfWeek'], Carbon::WEDNESDAY);
    }

    /**
     * @test
     * @group fix
     */
    public function 週開始が日曜の場合、月曜から始まる月が正しく設定されること()
    {
        $object = $this->calendarar
            ->startOfSunday()
            ->set('2024-01-01', '2024-01-30');

        $calendar = $object->create();

        // 月の初日が月曜であること
        $this->assertSame($calendar[2024][1][1][1]['day'], 1);
        $this->assertSame($calendar[2024][1][1][1]['dayOfWeek'], Carbon::MONDAY);
        // 月の最終日が水曜であること
        $this->assertSame($calendar[2024][1][5][3]['day'], 31);
        $this->assertSame($calendar[2024][1][5][3]['dayOfWeek'], Carbon::WEDNESDAY);
    }
}
