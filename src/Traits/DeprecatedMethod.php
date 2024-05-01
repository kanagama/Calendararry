<?php

namespace Kanagama\Calendarar\Traits;

/**
 * @method static self addStartYear(int $add) 開始日に $add 年分加算する
 * @method static self addEndYear(int $add) 終了日に $add 年分加算する
 * @method static self subStartYear(int $sub) 開始日に $sub 年分減算する
 * @method static self subEndYear(int $sub) 終了日に $sub 年分減算する
 * @method static self addStartMonth(int $add) 開始日に $add ヶ月分加算する
 * @method static self addEndMonth(int $add) 終了日に $add ヶ月分加算する
 * @method static self subStartMonth(int $sub) 開始日に $sub ヶ月分減算する
 * @method static self subEndMonth(int $sub) 終了日に $sub ヶ月分減算する
 *
 * @author kazuma nagama <k.nagama0632@gmail.com>
 */
trait DeprecatedMethod
{
    /**
     * 開始日に $add 年分加算する
     *
     * @test
     * @param  int  $add
     * @return self
     */
    private function startAddYear(int $add): self
    {
        return $this->addStartYear($add);
    }

    /**
     * 終了日に $add 年分加算する
     *
     * @test
     * @param  int  $add
     * @return self
     */
    private function endAddYear(int $add): self
    {
        return $this->addEndYear($add);
    }

    /**
     * 開始日に $sub 年分減算する
     *
     * @test
     * @param  int  $sub
     * @return self
     */
    private function startSubYear(int $sub): self
    {
        return $this->subStartYear($sub);
    }

    /**
     * 終了日に $sub 年分減算する
     *
     * @test
     * @param  int  $sub
     * @return self
     */
    private function endEndYear(int $sub): self
    {
        return $this->subEndYear($sub);
    }

    /**
     * 開始日に $add ヶ月分加算する
     *
     * @test
     * @param  int  $add
     * @return self
     */
    private function startAddMonth(int $add): self
    {
        return $this->addStartMonth($add);
    }

    /**
     * 終了日に $add ヶ月分加算する
     *
     * @test
     * @param  int  $add
     * @return self
     */
    private function endAddMonth(int $add): self
    {
        return $this->addEndMonth($add);
    }

    /**
     * 終了日に $sub ヶ月分減算する
     *
     * @test
     * @param  int  $sub
     * @return self
     */
    private function startSubMonth(int $sub): self
    {
        return $this->subStartMonth($sub);
    }

    /**
     * 終了日に $sub ヶ月分減算する
     *
     * @test
     * @param  int  $sub
     * @return self
     */
    private function endSubMonth(int $sub): self
    {
        return $this->subEndMonth($sub);
    }
}