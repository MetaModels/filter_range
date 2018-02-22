<?php

/**
 * * This file is part of MetaModels/filter_range.
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
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author     Stefan Heimes <stefan_heimes@hotmail.com>
 * @author     Richard Henkenjohann <richardhenkenjohann@googlemail.com>
 * @copyright  2015-2018 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_range/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

namespace MetaModels\FilterRangeBundle\FilterSetting;

use MetaModels\Filter\Setting\AbstractFilterSettingTypeFactory;

/**
 * Attribute type factory for from-to filter settings.
 */
class RangeFilterSettingTypeFactory extends AbstractFilterSettingTypeFactory
{
    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        parent::__construct();

        $this
            ->setTypeName('range')
            ->setTypeIcon('bundles/metamodelsfilterrange/filter_range.png')
            ->setTypeClass(Range::class)
            ->allowAttributeTypes('numeric', 'decimal');
    }
}
