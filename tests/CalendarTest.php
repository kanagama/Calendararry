<?php

namespace Tests\Unit\Kanagama\Calendarar;

use Carbon\CarbonImmutable;
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

        CarbonImmutable::setTestNow('2023-02-14');

        $this->calendarar = new Calendarar(CarbonImmutable::now(), CarbonImmutable::now());
    }

    /**
     * カレンダー配列が出力されること
     *
     * @test
     */
    public function create()
    {
        $objectResponse = $this->calendarar->{__FUNCTION__}();
        $this->assertTrue(is_array($objectResponse));

        // 静的呼び出しができること
        $staticResponse = Calendarar::{__FUNCTION__}();
        $this->assertTrue(is_array($staticResponse));
    }

    /**
     * 開始日が設定されること
     *
     * @test
     */
    public function getStartDatetime()
    {
        $objectResponse = $this->calendarar->{__FUNCTION__}();
        $this->assertIsString($objectResponse);
        $this->assertEquals($objectResponse, '2023-02-01');

        // 静的呼び出しができること
        $staticResponse = Calendarar::{__FUNCTION__}();
        $this->assertIsString($staticResponse);
        $this->assertEquals($objectResponse, $staticResponse);
    }

    /**
     * 終了日が出力されること
     *
     * @test
     */
    public function getEndDatetime()
    {
        $objectResponse = $this->calendarar->{__FUNCTION__}();
        $this->assertIsString($objectResponse);
        $this->assertEquals($objectResponse, '2023-02-28');

        // 静的呼び出しができること
        $staticResponse = Calendarar::{__FUNCTION__}();
        $this->assertIsString($staticResponse);
        $this->assertEquals($objectResponse, $staticResponse);
    }

    /**
     * 指定した月が設定されること
     *
     * @test
     */
    public function set()
    {
        $object = $this->calendarar->{__FUNCTION__}('2022-02-01', '2022-03-28');
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2022-02-01');
        $this->assertEquals($object->getEndDatetime(), '2022-03-31');

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}('2022-02-01', '2022-03-28');
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
        $object = $this->calendarar->{__FUNCTION__}();
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-02-01');
        $this->assertEquals($object->getEndDatetime(), '2023-02-28');

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}();
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
        $object = $this->calendarar->{__FUNCTION__}();
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-01-01');
        $this->assertEquals($object->getEndDatetime(), '2023-01-31');

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}();
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
        $object = $this->calendarar->{__FUNCTION__}();
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-03-01');
        $this->assertEquals($object->getEndDatetime(), '2023-03-31');

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}();
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
        $object = $this->calendarar->{__FUNCTION__}();
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-02-01');
        $this->assertEquals($object->getEndDatetime(), '2024-01-31');

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}();
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
        $object = $this->calendarar->{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2024-02-01');

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}(1);
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
        $object = $this->calendarar->{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getEndDatetime(), '2024-02-29');

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}(1);
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
        $object = $this->calendarar->{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2022-02-01');

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}(1);
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
        $object = $this->calendarar->{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getEndDatetime(), '2022-02-28');

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}(1);
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
        $object = $this->calendarar->{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-03-01');

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}(1);
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
        $object = $this->calendarar->{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getEndDatetime(), '2023-03-31');

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}(1);
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
        $object = $this->calendarar->{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getStartDatetime(), '2023-01-01');

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}(1);
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
        $object = $this->calendarar->{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $object);
        $this->assertEquals($object->getEndDatetime(), '2023-01-31');

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}(1);
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
        $object = $this->calendarar->{__FUNCTION__}($encoding);
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
        $object = $this->calendarar->{__FUNCTION__}();
        $response = $object->setEncoding('en')->html();
        $this->assertTrue(!empty($response));

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}();
        $this->assertInstanceOf(Calendarar::class, $static);

        return $response;
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
        $object = $this->calendarar->{__FUNCTION__}();
        $response = $object->setEncoding('en')->html();
        $this->assertTrue(!empty($response));

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}();
        $this->assertInstanceOf(Calendarar::class, $static);

        return $response;
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
        $response = $this->calendarar->{__FUNCTION__}();
        $this->assertTrue(!empty($response));
    }
}
