<?php

declare(strict_types=1);

namespace Gubler\Color;

final class ColorValues
{
    public const RGB_CHANNEL_MIN = 0;
    public const RGB_CHANNEL_MAX = 255;
    public const ALPHA_CHANNEL_MIN = 0;
    public const ALPHA_CHANNEL_MAX = 1;
    public const HEX_CHANNEL_REGEX = '/^[0-9a-f]{2}$/i';
    public const SHORT_HEX_REGEX = '/^#?([0-9a-f])([0-9a-f])([0-9a-f])$/i';
    public const LONG_HEX_REGEX = '/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i';
    public const RGB_REGEX = '/^rgb\(\s*(\d*)\s*,\s*(\d*)\s*,\s*(\d*)\s*\)$/';
    public const RGBA_REGEX = '/^rgba\(\s*(\d*)\s*,\s*(\d*)\s*,\s*(\d*)\s*,\s*(.*)\s*\)$/';
    public const RGB_PERCENT_REGEX = '/^rgb\(\s*(\d*%)\s*,\s*(\d*%)\s*,\s*(\d*%)\s*\)$/';
    public const RGBA_PERCENT_REGEX = '/^rgba\(\s*(\d*%)\s*,\s*(\d*%)\s*,\s*(\d*%)\s*,\s*(.*)\s*\)$/';
    public const HSL_REGEX = '/^hsl\(\s*(.*)\s*,\s*(.*%)\s*,\s*(.*%)\s*\)$/';
    public const HSLA_REGEX = '/^hsla\(\s*(.*)\s*,\s*(.*%)\s*,\s*(.*%)\s*,\s*(.*)\s*\)$/';
}
