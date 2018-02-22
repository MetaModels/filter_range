<?php

/**
 * This file is part of MetaModels/filter_range.
 *
 * (c) 2015-2018 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    MetaModels
 * @subpackage FilterRangeBundle
 * @author     Richard Henkenjohann <richardhenkenjohann@googlemail.com>
 * @copyright  2015-2018 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_fromto/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

// This hack is to load the "old locations" of the classes.

use MetaModels\FilterRangeBundle\FilterSetting\AbstractRange;
use MetaModels\FilterRangeBundle\FilterSetting\Range;
use MetaModels\FilterRangeBundle\FilterSetting\RangeDate;
use MetaModels\FilterRangeBundle\FilterSetting\RangeDateFilterSettingTypeFactory;
use MetaModels\FilterRangeBundle\FilterSetting\RangeFilterSettingTypeFactory;

spl_autoload_register(
    function ($class) {
        static $classes = [
            // FilterSetting
            'MetaModels\Filter\Setting\AbstractRange'                     => AbstractRange::class,
            'MetaModels\Filter\Setting\Range'                             => Range::class,
            'MetaModels\Filter\Setting\RangeDate'                         => RangeDate::class,
            'MetaModels\Filter\Setting\RangeDateFilterSettingTypeFactory' => RangeDateFilterSettingTypeFactory::class,
            'MetaModels\Filter\Setting\RangeFilterSettingTypeFactory'     => RangeFilterSettingTypeFactory::class,
        ];

        if (isset($classes[$class])) {
            // @codingStandardsIgnoreStart Silencing errors is discouraged
            @trigger_error('Class "'.$class.'" has been renamed to "'.$classes[$class].'"', E_USER_DEPRECATED);
            // @codingStandardsIgnoreEnd

            if (!class_exists($classes[$class])) {
                spl_autoload_call($class);
            }

            class_alias($classes[$class], $class);
        }
    }
);
