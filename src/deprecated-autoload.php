<?php

/**
 * This file is part of MetaModels/filter_range.
 *
 * (c) 2012-2019 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    MetaModels/filter_range
 * @author     Richard Henkenjohann <richardhenkenjohann@googlemail.com>
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @copyright  2012-2019 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_range/blob/master/LICENSE LGPL-3.0-or-later
 * @filesource
 */

use MetaModels\FilterRangeBundle\FilterSetting\AbstractRange;
use MetaModels\FilterRangeBundle\FilterSetting\Range;
use MetaModels\FilterRangeBundle\FilterSetting\RangeDate;
use MetaModels\FilterRangeBundle\FilterSetting\RangeDateFilterSettingTypeFactory;
use MetaModels\FilterRangeBundle\FilterSetting\RangeFilterSettingTypeFactory;

// This hack is to load the "old locations" of the classes.
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
