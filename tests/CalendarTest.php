<?php

namespace Tests\Unit\Kanagama\Calendarar;

use Carbon\Carbon;
use DomDocument;
use Kanagama\Calendarar\Calendarar;
use PHPUnit\Framework\TestCase;

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
     * カレンダー配列が出力されること
     *
     * @test
     */
    public function create()
    {
        $objectResponse = $this->calendarar->create();
        $this->assertTrue(is_array($objectResponse));
    }

    /**
     * カレンダー配列が出力されること
     *
     * @test
     */
    public function staticCreate()
    {
        $staticResponse = Calendarar::create();
        $this->assertTrue(is_array($staticResponse));
    }

    /**
     * 開始日が設定されること
     *
     * @test
     */
    public function getStartDatetime()
    {
        $objectResponse = $this->calendarar->getStartDatetime();
        $this->assertIsString($objectResponse);
        $this->assertEquals($objectResponse, '2023-02-01');
    }

    /**
     * 開始日が設定されること
     *
     * @test
     */
    public function staticGetStartDatetime()
    {
        $staticResponse = Calendarar::getStartDatetime();
        $this->assertIsString($staticResponse);
        $this->assertEquals($staticResponse, '2023-02-01');
    }

    /**
     * 終了日が出力されること
     *
     * @test
     */
    public function getEndDatetime()
    {
        $objectResponse = $this->calendarar->getEndDatetime();
        $this->assertIsString($objectResponse);
        $this->assertEquals($objectResponse, '2023-02-28');
    }

    /**
     * 終了日が出力されること
     *
     * @test
     */
    public function staticGetEndDatetime()
    {
        $staticResponse = Calendarar::getEndDatetime();
        $this->assertIsString($staticResponse);
        $this->assertEquals($staticResponse, '2023-02-28');
    }

    /**
     * 指定した月が設定されること
     *
     * @test
     */
    public function set()
    {
        $object = $this->calendarar->set('2022-02-01', '2022-03-28');
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2022-02-01');
        $this->assertEquals($object->getEndDatetime(), '2022-03-31');
    }

    /**
     * 指定した月が設定されること
     *
     * @test
     */
    public function staticSet()
    {
        $static = Calendarar::set('2022-02-01', '2022-03-28');
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2022-02-01');
        $this->assertEquals($static->getEndDatetime(), '2022-03-31');
    }

    /**
     * 今月が設定されていること
     *
     * @test
     */
    public function thisMonth()
    {
        $object = $this->calendarar->thisMonth();
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-02-01');
        $this->assertEquals($object->getEndDatetime(), '2023-02-28');
    }

    /**
     * 今月が設定されていること
     *
     * @test
     */
    public function staticThisMonth()
    {
        $static = Calendarar::thisMonth();
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2023-02-01');
        $this->assertEquals($static->getEndDatetime(), '2023-02-28');
    }

    /**
     * 先月が設定されること
     *
     * @test
     */
    public function lastMonth()
    {
        $object = $this->calendarar->lastMonth();
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-01-01');
        $this->assertEquals($object->getEndDatetime(), '2023-01-31');
    }

    /**
     * 先月が設定されること
     *
     * @test
     */
    public function staticLastMonth()
    {
        $static = Calendarar::lastMonth();
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2023-01-01');
        $this->assertEquals($static->getEndDatetime(), '2023-01-31');
    }

    /**
     * 来月が設定されること
     *
     * @test
     */
    public function nextMonth()
    {
        $object = $this->calendarar->nextMonth();
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-03-01');
        $this->assertEquals($object->getEndDatetime(), '2023-03-31');
    }

    /**
     * 来月が設定されること
     *
     * @test
     */
    public function staticNextMonth()
    {
        $static = Calendarar::nextMonth();
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2023-03-01');
        $this->assertEquals($static->getEndDatetime(), '2023-03-31');
    }

    /**
     * 1年分のカレンダーが設定されること
     *
     * @test
     */
    public function oneYear()
    {
        $object = $this->calendarar->oneYear();
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-02-01');
        $this->assertEquals($object->getEndDatetime(), '2024-01-31');
    }

    /**
     * 1年分のカレンダーが設定されること
     *
     * @test
     */
    public function staticOneYear()
    {
        $static = Calendarar::oneYear();
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2023-02-01');
        $this->assertEquals($static->getEndDatetime(), '2024-01-31');
    }

    /**
     * 開始年が1年加算されていること
     *
     * @test
     */
    public function startAddYear()
    {
        $object = $this->calendarar->startAddYear(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2024-02-01');
    }

    /**
     * 開始年が1年加算されていること
     *
     * @test
     */
    public function staticStartAddYear()
    {
        $static = Calendarar::startAddYear(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2024-02-01');
    }

    /**
     * 終了月が1年加算されていること
     *
     * @test
     */
    public function endAddYear()
    {
        $object = $this->calendarar->endAddYear(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getEndDatetime(), '2024-02-29');
    }

    /**
     * 終了月が1年加算されていること
     *
     * @test
     */
    public function staticEndAddYear()
    {
        $static = Calendarar::endAddYear(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getEndDatetime(), '2024-02-29');
    }

    /**
     * 開始年が1年減算されていること
     *
     * @test
     */
    public function startSubYear()
    {
        $object = $this->calendarar->startSubYear(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2022-02-01');
    }

    /**
     * 開始年が1年減算されていること
     *
     * @test
     */
    public function staticStartSubYear()
    {
        $static = Calendarar::startSubYear(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2022-02-01');
    }

    /**
     * 終了年が1年減算されていること
     *
     * @test
     */
    public function endSubYear()
    {
        $object = $this->calendarar->endSubYear(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getEndDatetime(), '2022-02-28');
    }

    /**
     * 終了年が1年減算されていること
     *
     * @test
     */
    public function staticEndSubYear()
    {
        $static = Calendarar::endSubYear(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getEndDatetime(), '2022-02-28');
    }

    /**
     * 開始月が1ヶ月加算されていること
     *
     * @test
     */
    public function startAddMonth()
    {
        $object = $this->calendarar->startAddMonth(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-03-01');
    }

    /**
     * 開始月が1ヶ月加算されていること
     *
     * @test
     */
    public function staticStartAddMonth()
    {
        $static = Calendarar::startAddMonth(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2023-03-01');
    }

    /**
     * 終了月が1ヶ月加算されていること
     *
     * @test
     */
    public function endAddMonth()
    {
        $object = $this->calendarar->endAddMonth(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getEndDatetime(), '2023-03-31');
    }

    /**
     * 終了月が1ヶ月加算されていること
     *
     * @test
     */
    public function staticEndAddMonth()
    {
        $static = Calendarar::endAddMonth(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getEndDatetime(), '2023-03-31');
    }

    /**
     * 開始月が1ヶ月減算されていること
     *
     * @test
     */
    public function startSubMonth()
    {
        $object = $this->calendarar->startSubMonth(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-01-01');
    }

    /**
     * 開始月が1ヶ月減算されていること
     *
     * @test
     */
    public function staticStartSubMonth()
    {
        $static = Calendarar::startSubMonth(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getStartDatetime(), '2023-01-01');
    }

    /**
     * 終了月が1ヶ月減算されていること
     *
     * @test
     */
    public function endSubMonth()
    {
        $object = $this->calendarar->endSubMonth(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getEndDatetime(), '2023-01-31');
    }

    /**
     * 終了月が1ヶ月減算されていること
     *
     * @test
     */
    public function staticEndSubMonth()
    {
        $static = Calendarar::endSubMonth(1);
        $this->assertInstanceOf(Calendarar::class, $static);
        $this->assertEquals($static->getEndDatetime(), '2023-01-31');
    }

    /**
     * @param  string  $encoding
     * @param  string  $dayOfWeek
     *
     * @test
     *
     * @dataProvider setEncondingProvider
     */
    public function setEncoding(
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
     * 曜日が月曜スタートとなること
     *
     * @test
     */
    public function startOfMonday()
    {
        // 正常に実行されること
        $object = $this->calendarar->startOfMonday();
        $response = $object->setEncoding('en')->html();
        $this->assertTrue(!empty($response));

        return $response;
    }

    /**
     * 曜日が月曜スタートとなること
     *
     * @test
     */
    public function staticStartOfMonday()
    {
        // 静的呼び出しができること
        $static = Calendarar::startOfMonday();
        $this->assertInstanceOf(Calendarar::class, $static);
    }

    /**
     * @param  string  $response
     *
     * @test
     *
     * @depends startOfMonday
     */
    public function 曜日が月曜から開始されていること(string $response)
    {
        $dom = new DOMDocument;
        $dom->loadHTML($response);

        $node = $dom->getElementsByTagName('th')->item(0);
        $this->assertEquals($node->nodeValue, 'mon');
    }

    /**
     * 曜日が日曜スタートとなること
     *
     * @test
     */
    public function startOfSunday()
    {
        // 正常に実行されること
        $object = $this->calendarar->startOfSunday();
        $response = $object->setEncoding('en')->html();
        $this->assertTrue(!empty($response));

        return $response;
    }

    /**
     * 曜日が日曜スタートとなること
     *
     * @test
     */
    public function staticStartOfSunday()
    {
        $static = Calendarar::startOfSunday();
        $this->assertInstanceOf(Calendarar::class, $static);
    }

    /**
     * @param string $response
     *
     * @test
     *
     * @depends startOfSunday
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
    public function html()
    {
        // 正常に実行されること
        $response = $this->calendarar->html();
        $this->assertTrue(!empty($response));
    }
}
