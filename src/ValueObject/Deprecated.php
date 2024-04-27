<?php

namespace Kanagama\Calendarar\ValueObject;

/**
 * 非推奨メソッドと推奨メソッド
 */
class Deprecated
{
    /**
     * @return array<string,string>
     */
    private const DEPRECATED_METHODS = [
        'startAddYear'  => 'addStartYear',
        'endAddYear'    => 'addEndYear',
        'startSubYear'  => 'subStartYear',
        'endSubYear'    => 'subEndYear',
        'startAddMonth' => 'addStartMonth',
        'endAddMonth'   => 'addEndMonth',
        'startSubMonth' => 'subStartMonth',
        'endSubMonth'   => 'subEndMonth',
    ];

    /**
     * 非推奨メッセージを出力
     *
     * @param string $method
     */
    public static function deprecatedMessage(string $method)
    {
        // 非推奨メソッドでなければ終了
        if (!empty(self::DEPRECATED_METHODS[$method]) === true) {
            trigger_error($method . '() メソッドは非推奨です。代わりに ' . self::DEPRECATED_METHODS[$method] . '() メソッドを使用してください', E_USER_DEPRECATED);
        }
    }
}