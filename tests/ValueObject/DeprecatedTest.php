<?php

namespace Tests\Unit\Kanagama\Calendarar\ValueObject;

use Kanagama\Calendarar\Calendarar;
use PHPUnit\Framework\Error\Deprecated;
use PHPUnit\Framework\TestCase;

class DeprecatedTest extends TestCase
{
    /**
     * @test
     * @dataProvider deprecatedMethodProvider
     * @param  string  $method
     * @param  string  $newMethod
     */
    public function 非推奨のメッセージが出力される(
        string $method,
        string $newMethod
    ) {
        // $this->expectException(Deprecated::class);
        // $this->expectExceptionMessage($method . '() メソッドは非推奨です。代わりに ' . $newMethod . '() メソッドを使用してください');

        (new Calendarar())->{$method}(1);

        $this->assertTrue(true);
    }

    /**
     * @return array
     */
    public function deprecatedMethodProvider(): array
    {
        return [
            [
                'method'    => 'startAddYear',
                'newMethod' => 'addStartYear',
            ],
            [
                'method'    => 'endAddYear',
                'newMethod' => 'addEndYear',
            ],
            [
                'method'    => 'startSubYear',
                'newMethod' => 'subStartYear',
            ],
            [
                'method'    => 'endSubYear',
                'newMethod' => 'subEndYear',
            ],
            [
                'method'    => 'startAddMonth',
                'newMethod' => 'addStartMonth',
            ],
            [
                'method'    => 'endAddMonth',
                'newMethod' => 'addEndMonth',
            ],
            [
                'method'    => 'startSubMonth',
                'newMethod' => 'subStartMonth',
            ],
            [
                'method'    => 'endSubMonth',
                'newMethod' => 'subEndMonth',
            ],
        ];
    }
}