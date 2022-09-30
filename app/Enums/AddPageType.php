<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class AddPageType extends Enum
{
    const Home = 0;
    const Navigation = 1;
    const Other = 2;


    public static function getAllAddPageType(){
        return [
            'Home'=>self::Home,
            'Navigation'=>self::Navigation,
            'Other'=>self::Other,

        ];
    }
}
