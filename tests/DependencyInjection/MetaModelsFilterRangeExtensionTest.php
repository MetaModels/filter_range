<?php

/**
 * This file is part of MetaModels/filter_range.
 *
 * (c) 2012-2023 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    MetaModels/filter_range
 * @author     Richard Henkenjohann <richardhenkenjohann@googlemail.com>
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author     Ingolf Steinhardt <info@e-spin.de>
 * @copyright  2012-2023 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_range/blob/master/LICENSE LGPL-3.0-or-later
 * @filesource
 */

namespace MetaModels\FilterRangeBundle\Test\DependencyInjection;

use MetaModels\FilterRangeBundle\DependencyInjection\MetaModelsFilterRangeExtension;
use MetaModels\FilterRangeBundle\FilterSetting\RangeDateFilterSettingTypeFactory;
use MetaModels\FilterRangeBundle\FilterSetting\RangeFilterSettingTypeFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

/**
 * This test case test the extension.
 *
 * @covers \MetaModels\FilterRangeBundle\DependencyInjection\MetaModelsFilterRangeExtension
 */
class MetaModelsFilterRangeExtensionTest extends TestCase
{
    public function testInstantiation(): void
    {
        $extension = new MetaModelsFilterRangeExtension();

        $this->assertInstanceOf(MetaModelsFilterRangeExtension::class, $extension);
        $this->assertInstanceOf(ExtensionInterface::class, $extension);
    }

    public function testFactoryIsRegistered(): void
    {
        $container = new ContainerBuilder();

        $extension = new MetaModelsFilterRangeExtension();
        $extension->load([], $container);

        self::assertTrue($container->hasDefinition('metamodels.filter_range.factory'));
        $definition = $container->getDefinition('metamodels.filter_range.factory');
        self::assertCount(1, $definition->getTag('metamodels.filter_factory'));

        self::assertTrue($container->hasDefinition('metamodels.filter_range.date_factory'));
        $definition = $container->getDefinition('metamodels.filter_range.date_factory');
        self::assertCount(1, $definition->getTag('metamodels.filter_factory'));
    }
}
