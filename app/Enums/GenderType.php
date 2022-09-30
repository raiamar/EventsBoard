<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class GenderType extends Enum
{
    const Male = 0;
    const Female = 1;
    const Others = 2;


    public static function getGenderType(){
        return [
            'Male'=>self::Male,
            'Female'=>self::Female,
            'Others'=>self::Others,
        ];
    }

}
