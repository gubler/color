<?php

declare(strict_types=1);

namespace Gubler\Color;

enum ColorType: string
{
    case RGB = 'rgb';
    case RGB_PERCENT = 'rgbPercent';
    case RGBA = 'rgba';
    case RGBA_PERCENT = 'rgbaPercent';
    case HSL = 'hsl';
    case HSLA = 'hsla';
    case HEX = 'hex';
    case SHORT_HEX = 'shortHex';
}
