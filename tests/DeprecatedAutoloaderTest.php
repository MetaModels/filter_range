<?php

/**
 * This file is part of MetaModels/filter_range.
 *
 * (c) 2012-2022 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    MetaModels/filter_range
 * @author     Richard Henkenjohann <richardhenkenjohann@googlemail.com>
 * @author     Ingolf Steinhardt <info@e-spin.de>
 * @copyright  2012-2022 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_range/blob/master/LICENSE LGPL-3.0-or-later
 * @filesource
 */

namespace MetaModels\FilterRangeBundle\Test;

use MetaModels\FilterRangeBundle\FilterSetting\AbstractRange;
use MetaModels\FilterRangeBundle\FilterSetting\Range;
use MetaModels\FilterRangeBundle\FilterSetting\RangeDate;
use MetaModels\FilterRangeBundle\FilterSetting\RangeDateFilterSettingTypeFactory;
use MetaModels\FilterRangeBundle\FilterSetting\RangeFilterSettingTypeFactory;
use PHPUnit\Framework\TestCase;

/**
 * This class tests if the deprecated autoloader works.
 *
 * @covers \MetaModels\FilterRangeBundle\DeprecatedAutoloader
 */
class DeprecatedAutoloaderTest extends TestCase
{
    /**
     * Mapping of old classes to the new ones.
     *
     * @var array
     */
    private static $classes = [
        // FilterSetting
        'MetaModels\Filter\Setting\AbstractRange'                     => AbstractRange::class,
        'MetaModels\Filter\Setting\Range'                             => Range::class,
        'MetaModels\Filter\Setting\RangeDate'                         => RangeDate::class,
        'MetaModels\Filter\Setting\RangeDateFilterSettingTypeFactory' => RangeDateFilterSettingTypeFactory::class,
        'MetaModels\Filter\Setting\RangeFilterSettingTypeFactory'     => RangeFilterSettingTypeFactory::class,
    ];

    /**
     * Provide the alias class map.
     *
     * @return array
     */
    public function provideAliasClassMap()
    {
        $values = [];

        foreach (static::$classes as $select => $class) {
            $values[] = [
                $select,
                $class,
            ];
        }

        return $values;
    }

    /**
     * Test if the deprecated classes are aliased to the new one.
     *
     * @param string $oldClass Old class name.
     * @param string $newClass New class name.
     *
     * @dataProvider provideAliasClassMap
     */
    public function testDeprecatedClassesAreAliased($oldClass, $newClass)
    {
        $this->assertTrue(class_exists($oldClass), sprintf('Class select "%s" is not found.', $oldClass));

        $oldClassReflection = new \ReflectionClass($oldClass);
        $newClassReflection = new \ReflectionClass($newClass);

        $this->assertSame($newClassReflection->getFileName(), $oldClassReflection->getFileName());
    }
}
