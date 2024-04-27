# Calendarar

かれんだらー

## 機能概要

開始日と終了日を設定し、その開始日から終了日までのカレンダー出力用の配列を作成する。

<br>

php7.4 以上

## 使い方

composer でインストール

```bash
composer require kanagama/calendarar
```

### インスタンス化、もしくは静的呼び出しも可能です

#### example
```php
$calendarar = (new Calendarar())->nextMonth();

$calendarar = Calendarar::nextMonth();
```

<br>

### create()

カレンダー開始日とカレンダー終了日を元にしてカレンダー用配列を出力する

#### example
```php
// example
// 今月分のカレンダー用配列を出力する
// ※2023年02月に実行したと想定
Calendarar::thisMonth()->create();
```

<br>

#### 返却値
```
^ array:1 [
  2023 => array:1 [
    2 => array:5 [
      1 => array:7 [
        0 => []
        1 => []
        2 => []
        3 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 1
          "week" => 1
          "dayOfWeek" => 3
          "data" => []
        ]
        4 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 2
          "week" => 1
          "dayOfWeek" => 4
          "data" => []
        ]
        5 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 3
          "week" => 1
          "dayOfWeek" => 5
          "data" => []
        ]
        6 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 4
          "week" => 1
          "dayOfWeek" => 6
          "data" => []
        ]
      ]
      2 => array:7 [
        0 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 5
          "week" => 2
          "dayOfWeek" => 0
          "data" => []
        ]
        1 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 6
          "week" => 2
          "dayOfWeek" => 1
          "data" => []
        ]
        2 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 7
          "week" => 2
          "dayOfWeek" => 2
          "data" => []
        ]
        3 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 8
          "week" => 2
          "dayOfWeek" => 3
          "data" => []
        ]
        4 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 9
          "week" => 2
          "dayOfWeek" => 4
          "data" => []
        ]
        5 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 10
          "week" => 2
          "dayOfWeek" => 5
          "data" => []
        ]
        6 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 11
          "week" => 2
          "dayOfWeek" => 6
          "data" => []
        ]
      ]
      3 => array:7 [
        0 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 12
          "week" => 3
          "dayOfWeek" => 0
          "data" => []
        ]
        1 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 13
          "week" => 3
          "dayOfWeek" => 1
          "data" => []
        ]
        2 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 14
          "week" => 3
          "dayOfWeek" => 2
          "data" => []
        ]
        3 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 15
          "week" => 3
          "dayOfWeek" => 3
          "data" => []
        ]
        4 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 16
          "week" => 3
          "dayOfWeek" => 4
          "data" => []
        ]
        5 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 17
          "week" => 3
          "dayOfWeek" => 5
          "data" => []
        ]
        6 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 18
          "week" => 3
          "dayOfWeek" => 6
          "data" => []
        ]
      ]
      4 => array:7 [
        0 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 19
          "week" => 4
          "dayOfWeek" => 0
          "data" => []
        ]
        1 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 20
          "week" => 4
          "dayOfWeek" => 1
          "data" => []
        ]
        2 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 21
          "week" => 4
          "dayOfWeek" => 2
          "data" => []
        ]
        3 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 22
          "week" => 4
          "dayOfWeek" => 3
          "data" => []
        ]
        4 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 23
          "week" => 4
          "dayOfWeek" => 4
          "data" => []
        ]
        5 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 24
          "week" => 4
          "dayOfWeek" => 5
          "data" => []
        ]
        6 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 25
          "week" => 4
          "dayOfWeek" => 6
          "data" => []
        ]
      ]
      5 => array:7 [
        0 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 26
          "week" => 5
          "dayOfWeek" => 0
          "data" => []
        ]
        1 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 27
          "week" => 5
          "dayOfWeek" => 1
          "data" => []
        ]
        2 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 28
          "week" => 5
          "dayOfWeek" => 2
          "data" => []
        ]
        3 => []
        4 => []
        5 => []
        6 => []
      ]
    ]
  ]
]
```

<br>

### html()

カレンダー開始日とカレンダー終了日を元にしてカレンダー table を html タグで出力する

#### example
```php
Calendarar::thisMonth()->html();
```

#### example 出力される html 2023/02
```html

<table class="calendarar calendarar-202302">
    <thead>
        <tr>
            <th class="sun">日</th>
            <th class="mon">月</th>
            <th class="tue">火</th>
            <th class="wed">水</th>
            <th class="thu">木</th>
            <th class="fri">金</th>
            <th class="sat">土</th>
        </tr>
    </thead>
    <tbody>
        <tr class="week1">
            <td class="sun day-none"></td>
            <td class="mon day-none"></td>
            <td class="tue day-none"></td>
            <td class="wed day-1">1</td>
            <td class="thu day-2">2</td>
            <td class="fri day-3">3</td>
            <td class="sat day-4">4</td>
        </tr>
        <tr class="week2">
            <td class="sun day-5">5</td>
            <td class="mon day-6">6</td>
            <td class="tue day-7">7</td>
            <td class="wed day-8">8</td>
            <td class="thu day-9">9</td>
            <td class="fri day-10">10</td>
            <td class="sat day-11">11</td>
        </tr>
        <tr class="week3">
            <td class="sun day-12">12</td>
            <td class="mon day-13">13</td>
            <td class="tue day-14">14</td>
            <td class="wed day-15">15</td>
            <td class="thu day-16">16</td>
            <td class="fri day-17">17</td>
            <td class="sat day-18">18</td>
        </tr>
        <tr class="week4">
            <td class="sun day-19">19</td>
            <td class="mon day-20">20</td>
            <td class="tue day-21">21</td>
            <td class="wed day-22">22</td>
            <td class="thu day-23">23</td>
            <td class="fri day-24">24</td>
            <td class="sat day-25">25</td>
        </tr>
        <tr class="week5">
            <td class="sun day-26">26</td>
            <td class="mon day-27">27</td>
            <td class="tue day-28">28</td>
            <td class="wed day-none"></td>
            <td class="thu day-none"></td>
            <td class="fri day-none"></td>
            <td class="sat day-none"></td>
        </tr>
    </tbody>
</table>
```

<br>

### startOfMonday()

カレンダーの週の始まりを月曜にする

#### example
```php
Calendarar::thisMonth()
    ->startOfMonday()
    ->html()
```

```html
<table class="calendarar calendarar-202302">
    <thead>
        <tr>
            <th class="mon">月</th>
            <th class="tue">火</th>
            <th class="wed">水</th>
            <th class="thu">木</th>
            <th class="fri">金</th>
            <th class="sat">土</th>
            <th class="sun">日</th>
        </tr>
    </thead>
    <tbody>
        <tr class="week1">
            <td class="mon day-none"></td>
            <td class="tue day-none"></td>
            <td class="wed day-1">1</td>
            <td class="thu day-2">2</td>
            <td class="fri day-3">3</td>
            <td class="sat day-4">4</td>
            <td class="sun day-5">5</td>
        </tr>
```

### startOfSunday()

カレンダーの週の始まりを日曜にする（デフォルト）

#### example
```php
Calendarar::thisMonth()
    ->startOfSunday()
    ->html()
```

```html
<table class="calendarar calendarar-202302">
    <thead>
        <tr>
            <th class="sun">日</th>
            <th class="mon">月</th>
            <th class="tue">火</th>
            <th class="wed">水</th>
            <th class="thu">木</th>
            <th class="fri">金</th>
            <th class="sat">土</th>
        </tr>
    </thead>
    <tbody>
        <tr class="week1">
            <td class="sun day-none"></td>
            <td class="mon day-none"></td>
            <td class="tue day-none"></td>
            <td class="wed day-1">1</td>
            <td class="thu day-2">2</td>
            <td class="fri day-3">3</td>
            <td class="sat day-4">4</td>
        </tr>
```

<br>

### setEncoding

html() で出力する table.thead.tr.th の内容を ja, en で指定する

#### example

```php
// デフォルト値は ja
Calendarar::thisMonth()
    ->setEncoding('en')
    ->html()
```

```html
    <thead>
        <tr>
            <th class="sun">sun</th>
            <th class="mon">mon</th>
            <th class="tue">tue</th>
            <th class="wed">wed</th>
            <th class="thu">thu</th>
            <th class="fri">fri</th>
            <th class="sat">sat</th>
        </tr>
    </thead>
```


### setTrTemplate(string $template)

html() で出力される table.thead.tr.th タグ内のテンプレートを変更します

#### デフォルト値
```
{{dayOfWeek}}
```
{{dayOfWeek}}が曜日の文字列に変換されます

<br>

#### example
```php
Calendarar::thisMonth()
    ->setTrTemplate('<span class="bold">{{dayOfWeek}}</span>')
    ->html()
```

<br>

```html
    <thead>
        <tr>
            <th class="sun"><span class="bold">日</span></th>
            <th class="mon"><span class="bold">月</span></th>
            <th class="tue"><span class="bold">火</span></th>
            <th class="wed"><span class="bold">水</span></th>
            <th class="thu"><span class="bold">木</span></th>
            <th class="fri"><span class="bold">金</span></th>
            <th class="sat"><span class="bold">土</span></th>
        </tr>
    </thead>
```

<br>

### setDay(int $year, int $month, int $day, mixed $data)

指定日に、$data を格納する

#### example

```php
Calendarar::thisMonth()
    ->setDay(2023, 2, 23, [
        'holiday' => true,
        'holiday_name' => '天皇誕生日',
    ])
    ->create()
```

```
^ array:1 [
  2023 => array:1 [
    2 => array:5 [
      1 => array:7 [
        0 => []
        1 => []
        2 => []
        3 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 1
          "week" => 1
          "dayOfWeek" => 3
          "data" => []
        ]
        4 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 2
          "week" => 1
          "dayOfWeek" => 4
          "data" => []
        ]
        5 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 3
          "week" => 1
          "dayOfWeek" => 5
          "data" => []
        ]
        6 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 4
          "week" => 1
          "dayOfWeek" => 6
          "data" => []
        ]
      ]
      2 => array:7 [
        0 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 5
          "week" => 2
          "dayOfWeek" => 0
          "data" => []
        ]
        1 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 6
          "week" => 2
          "dayOfWeek" => 1
          "data" => []
        ]
        2 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 7
          "week" => 2
          "dayOfWeek" => 2
          "data" => []
        ]
        3 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 8
          "week" => 2
          "dayOfWeek" => 3
          "data" => []
        ]
        4 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 9
          "week" => 2
          "dayOfWeek" => 4
          "data" => []
        ]
        5 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 10
          "week" => 2
          "dayOfWeek" => 5
          "data" => []
        ]
        6 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 11
          "week" => 2
          "dayOfWeek" => 6
          "data" => []
        ]
      ]
      3 => array:7 [
        0 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 12
          "week" => 3
          "dayOfWeek" => 0
          "data" => []
        ]
        1 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 13
          "week" => 3
          "dayOfWeek" => 1
          "data" => []
        ]
        2 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 14
          "week" => 3
          "dayOfWeek" => 2
          "data" => []
        ]
        3 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 15
          "week" => 3
          "dayOfWeek" => 3
          "data" => []
        ]
        4 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 16
          "week" => 3
          "dayOfWeek" => 4
          "data" => []
        ]
        5 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 17
          "week" => 3
          "dayOfWeek" => 5
          "data" => []
        ]
        6 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 18
          "week" => 3
          "dayOfWeek" => 6
          "data" => []
        ]
      ]
      4 => array:7 [
        0 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 19
          "week" => 4
          "dayOfWeek" => 0
          "data" => []
        ]
        1 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 20
          "week" => 4
          "dayOfWeek" => 1
          "data" => []
        ]
        2 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 21
          "week" => 4
          "dayOfWeek" => 2
          "data" => []
        ]
        3 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 22
          "week" => 4
          "dayOfWeek" => 3
          "data" => []
        ]
        4 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 23
          "week" => 4
          "dayOfWeek" => 4
          "data" => [
            'holiday' => true,
            'holiday_name' => '天皇誕生日',
          ],
        ]
        5 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 24
          "week" => 4
          "dayOfWeek" => 5
          "data" => []
        ]
        6 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 25
          "week" => 4
          "dayOfWeek" => 6
          "data" => []
        ]
      ]
      5 => array:7 [
        0 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 26
          "week" => 5
          "dayOfWeek" => 0
          "data" => []
        ]
        1 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 27
          "week" => 5
          "dayOfWeek" => 1
          "data" => []
        ]
        2 => array:6 [
          "year" => 2023
          "month" => 2
          "day" => 28
          "week" => 5
          "dayOfWeek" => 2
          "data" => []
        ]
        3 => []
        4 => []
        5 => []
        6 => []
      ]
    ]
  ]
]
```

### setTdTemplate(string $template)

html() で出力される table.tbody.tr.td タグ内のテンプレートを変更します


#### デフォルト値

```
{{day}}
```
{{day}}が数値の日付に変換されます


#### example

```php
Calendarar::thisMonth()
    ->setTdTemplate('<span class="bold">{{day}}</span>')
    ->html()
```

```html
    <tbody>
        <tr class="week1">
            <td class="sun"></td>
            <td class="mon"></td>
            <td class="tue"></td>
            <td class="wed"><span class="bold">1</span></td>
            <td class="thu"><span class="bold">2</span></td>
            <td class="fri"><span class="bold">3</span></td>
            <td class="sat"><span class="bold">4</span></td>
        </tr>
```

<br>

### set(mixed $start, mixed $end)

第一引数にカレンダー開始日、第二引数にカレンダー終了日を設定する

※第一引数は月初に、第二引数は月末に変換されます

<br>

### thisMonth()

今月１ヶ月分のカレンダーを設定

#### example
```php
Calendarar::thisMonth();
```

<br>

### lastMonth()

先月１ヶ月分のカレンダーを設定

#### example
```php
Calendarar::lastMonth();
```

<br>

### nextMonth()

来月１ヶ月分のカレンダーを設定

#### example
```php
Calendarar::nextMonth();
```

<br>

### oneYear()

今月から12ヶ月分のカレンダーを設定

#### example
```php
Calendarar::oneYear();
```

<br>

### getStartDatetime()

設定されたカレンダー開始日を表示する

#### example
```php
Calendarar::thisMonth()->getStartDatetime();
```

<br>

### getEndDatetime()

設定されたカレンダー終了日を表示する

#### example
```php
Calendarar::thisMonth()->getEndDatetime();
```

<br>

### addStartYear(int $add)

カレンダー開始年を $add 年分進める

#### example
```php
Calendarar::addStartYear(1);
```

<br>

### addEndYear(int $add)

カレンダー終了年を $add 年分進める

#### example
```php
Calendarar::addEndYear(1);
```

<br>

### subStartYear(int $sub)

カレンダー開始年を $sub 年分戻す

#### example
```php
Calendarar::subStartYear(1);
```

<br>

### subEndYear(int $sub)

カレンダー終了年を $sub 年分戻す

#### example
```php
Calendarar::subEndYear(1);
```

<br>

### addStartMonth(int $add)

カレンダー開始月を $add 月分進める

```php
Calendarar::addStartMonth(1);
```

<br>

### addEndMonth(int $add)

カレンダー終了月を $add 月分進める

#### example
```php
Calendarar::addEndMonth(1);
```

<br>

### subStartMonth(int $sub)

カレンダー開始月を $sub 月分戻す

#### example
```php
Calendarar::subStartMonth(1);
```

<br>

### subEndMonth(int $sub)

カレンダー終了月を $sub 月分戻す

#### example
```php
Calendarar::subEndMonth(1);
```
