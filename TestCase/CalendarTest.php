<?php

namespace Tests\Unit\Kanagama\Calendarar;

use Carbon\CarbonImmutable;
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

        $this->calendarar = new Calendarar(CarbonImmutable::now(), CarbonImmutable::now());
    }

    /**
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
     * @test
     */
    public function getStartDatetime()
    {
        $objectResponse = $this->calendarar->{__FUNCTION__}();
        $this->assertString($objectResponse);

        // 静的呼び出しができること
        $staticResponse = Calendarar::{__FUNCTION__}();
        $this->assertString($staticResponse);
    }

    /**
     * @test
     */
    public function getEndDatetime()
    {
        $objectResponse = $this->calendarar->{__FUNCTION__}();
        $this->assertString($objectResponse);

        // 静的呼び出しができること
        $staticResponse = Calendarar::{__FUNCTION__}();
        $this->assertString($staticResponse);
    }

    /**
     * @test
     */
    public function set()
    {
        $object = $this->calendarar->{__FUNCTION__}('2022-02-01', '2022-02-28');
        $this->assertInstanceOf(Calendarar::class, $object);

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}('2022-02-01', '2022-02-28');
        $this->assertInstanceOf(Calendarar::class, $static);
    }

    /**
     * @test
     */
    public function thisMonth()
    {
        $object = $this->calendarar->{__FUNCTION__}();
        $this->assertInstanceOf(Calendarar::class, $object);

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}();
        $this->assertInstanceOf(Calendarar::class, $static);
    }

    /**
     * @test
     */
    public function lastMonth()
    {
        $object = $this->calendarar->{__FUNCTION__}();
        $this->assertInstanceOf(Calendarar::class, $object);

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}();
        $this->assertInstanceOf(Calendarar::class, $static);
    }

    /**
     * @test
     */
    public function nextMonth()
    {
        $object = $this->calendarar->{__FUNCTION__}();
        $this->assertInstanceOf(Calendarar::class, $object);

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}();
        $this->assertInstanceOf(Calendarar::class, $static);
    }

    /**
     * @test
     */
    public function oneYear()
    {
        $object = $this->calendarar->{__FUNCTION__}();
        $this->assertInstanceOf(Calendarar::class, $object);

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}();
        $this->assertInstanceOf(Calendarar::class, $static);
    }

    /**
     * @test
     */
    public function startAddYear()
    {
        $object = $this->calendarar->{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $object);

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $static);
    }

    /**
     * @test
     */
    public function endAddYear()
    {
        $object = $this->calendarar->{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $object);

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $static);
    }

    /**
     * @test
     */
    public function startSubYear()
    {
        $object = $this->calendarar->{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $object);

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $static);
    }

    /**
     * @test
     */
    public function endSubYear()
    {
        $object = $this->calendarar->{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $object);

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $static);
    }

    /**
     * @test
     */
    public function startAddMonth()
    {
        $object = $this->calendarar->{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $object);

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $static);
    }

    /**
     * @test
     */
    public function endAddMonth()
    {
        $object = $this->calendarar->{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $object);

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $static);
    }

    /**
     * @test
     */
    public function startSubMonth()
    {
        $object = $this->calendarar->{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $object);

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $static);
    }

    /**
     * @test
     */
    public function endSubMonth()
    {
        $object = $this->calendarar->{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $object);

        // 静的呼び出しができること
        $static = Calendarar::{__FUNCTION__}(1);
        $this->assertInstanceOf(Calendarar::class, $static);
    }
}
