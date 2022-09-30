<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class AddType extends Enum
{
    const Slider = 0;
    const Banner = 1;
    const Popup = 2;


    public static function getAllAddType(){
        return [
            'Slider'=>self::Slider,
            'Banner'=>self::Banner,
            'Popup'=>self::Popup,

        ];
    }

}


