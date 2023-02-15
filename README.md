# Calendarar

## 機能概要

php7.4 以上

<br>

## 使い方

composer でインストール

```bash
composer require kanagama/calendarar
```

<br>

### set(mixed $start, mixed $end)

第一引数にカレンダー開始日、第二引数にカレンダー終了日を設定する

※第一引数は月初に、第二引数は月末に変換されます

<br>

### thisMonth()

今月１ヶ月分のカレンダーを設定

```php
Calendarar::thisMonth();
```

<br>

### lastMonth()

先月１ヶ月分のカレンダーを設定

```php
Calendarar::lastMonth();
```

<br>

### nextMonth()

来月１ヶ月分のカレンダーを設定

```php
Calendarar::nextMonth();
```

<br>

### oneYear()

今月から12ヶ月分のカレンダーを設定

```php
Calendarar::oneYear();
```

<br>

### getStartDatetime()

設定されたカレンダー開始日を表示する

```php
Calendarar::thisMonth()->getStartDatetime();
```

<br>

### getEndDatetime()

設定されたカレンダー終了日を表示する

```php
Calendarar::thisMonth()->getEndDatetime();
```

<br>

### startAddYear(int $add)

カレンダー開始年を $add 年分進める

```php
Calendarar::startAddYear(1);
```

<br>

### endAddYear(int $add)

カレンダー終了年を $add 年分進める

```php
Calendarar::endAddYear(1);
```

<br>

### startSubYear(int $sub)

カレンダー開始年を $sub 年分戻す

```php
Calendarar::startSubYear(1);
```

<br>

### endSubYear(int $sub)

カレンダー終了年を $sub 年分戻す

```php
Calendarar::endSubYear(1);
```

<br>

### startAddMonth(int $add)

カレンダー開始月を $add 月分進める

```php
Calendarar::startAddMonth(1);
```

<br>

### endAddMonth(int $add)

カレンダー終了月を $add 月分進める

```php
Calendarar::endAddMonth(1);
```

<br>

### startSubMonth(int $sub)

カレンダー開始月を $sub 月分戻す

```php
Calendarar::startSubMonth(1);
```

<br>

### endSubMonth(int $sub)

カレンダー終了月を $sub 月分戻す

```php
Calendarar::endSubMonth(1);
```

<br>

### create()

カレンダー開始日とカレンダー終了日を元にしてカレンダー用配列を出力する

```php
// example
// 今月分のカレンダー用配列を出力する
Calendarar::thisMonth()->create();
```

<br>
