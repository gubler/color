# Gubler/Color

Color is a CSS color object library. It allows you to create a `Color` object and get multiple CSS color styles from it.

## Installation

Install the library with composer:

```bash
composer require gulber/color
```

## Usage

Create a new `Color` object with a valid CSS color value:

```php
// with hex value
$color = new Color('#F4E204');
// with short hex value
$color = new Color('#ccc');
// with RGB
$color = new Color('rgb(10, 20, 30)');
// with RGBA
$color = new Color('rgba(10, 20, 30, 0.5)');
// with HSL
$color = new Color('hsl(30.5, 100%, 50%)');
// with HSLA
$color = new Color('hsla(30.5, 100%, 50%, 1.0)');
```

Once you have created a color, you can export it in another format:

```php
$color = new Color('#F4E204');
$color->rgba();
$color->hsla();
$color->hex();
```

You can also update the color:

```php
$color->setHex('#fff000');
$color->setRgba(120, 0, 75, 0.9);
$color->setHsla(50.5, 70, 60, 1);
```

### Contrast Color Text

You can call `contrastTextColor` to get a new `Color` object, either black or white, whichever has better contrast with
the parent `Color`.

```php
$textColor = $color->contractTextColor();
$textColor->rgba() // either rgba(0, 0, 0, 1) or rgba(255, 255, 255, 1) 
```

## Thanks

This library was heavily inspired by [spatie/color](https://github.com/spatie/color).
