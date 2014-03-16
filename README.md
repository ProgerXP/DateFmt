# DateFmt

**DateFmt** is an easy-to-use (mostly one method) locale-aware date formatting class supporting national date/time formats and relative time (like "1 day ago"). It focuses on easy-to-remember format strings (hello, `date()` and `strftime()`).

[ [Full syntax & API](http://proger.i-forge.net/DateFmt/cWq) ]

**Updated 16 February 2014:** fixed a number of bugs in `AGO[]`, added some comments and reformatted the code. It's also possible to call `PascalCase()` methods as if they were `camelCase()` thanks to magic `__call()`. Upgrade is fully backward-compatible, therefore highly recommended for everyone.

**Features:**

1. Basic formatting: `d#` (day), `d##` (zero-padded), `D_` ("Mon"), `D__` ("Monday"), etc.
1. Relative time: `AGO[*]` = 1 minute, 2 days ago, etc.
1. Relative-exact: `AGO[d.h]` = 1 day 3 hours ago
1. Relative-short: `AGO-SHORT[d.h]` = 1d 3h ago
1. Relative if close to now, otherwise full: `AGO[t]IF-FAR[d##my]` - outputs "3 hours ago" or if the timestamp is past last 24 hours outputs full time string ("03/23/2012")
1. Suppressed "ago/after": `AGO[*]_` = 1 day 3 hours

**Natural language features:**

1. Fractions (e.g. 0.45 hour ago) get translated into "half an hour ago"
1. Indication of time using "at": `[d#.m#.y##]AT h#:m##` - outputs "23.3.2012 at 13:23" in English or "23.3.2012 в 13:23" in Russian. Note that no change was required in the format string if spite of the different language
1. Genetive form (not used in English): Posted on `AT[D__]` = Posted on Wednesday = Добавлено в среду - compare with `Posted on D__` where it would be "Добавлено в среда" (not the correct word form)

## Usage
```PHP
$your_timestamp = 158399691;                // => Wednesday, 08/01/1975
$formatted = DateFmt::Format('D__, d##my', $your_timestamp, 'ru');
// You could also call DateFmt::format().
```

The first argument is the format string, the second - timestamp (`time()` if omitted), the third - language (`en` if omitted).

## Installation

### Composer

Available under `proger/datefmt` at [Packagist](https://packagist.org/packages/proger/datefmt).

### Laravel 3

As usual, use the **Artisan**:

```
php artisan bundle:install datefmt
```

Then put this into your **application/bundles.php**:

```PHP
'datefmt' => array(
  'autoloads' => array(
    'map' => array('DateFmt' => '(:bundle)/datefmt.php')
  )
)
```

Now whenever you refer to `DateFmt` in your code its class will be autoloaded.

## Limitations

* Nested rules are unsupported: `[...]?|AGO[s-d]IF-FAR[[d#my]AT h#m]`
* Multiple **IF**'s are unsupported: `AGO[d]IF>7[..]IF>21[..]IF>...`
* Empty **IF**'s are not allowed: `AGO[h] AGO[h]IF>0[]IF>3[ (AGO[d]_)]` (this would create `11 hours ago` and `74 hours ago (2 days)`)
