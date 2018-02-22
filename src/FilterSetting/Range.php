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
 * @author     Andreas Isaak <info@andreas-isaak.de>
 * @author     Christian de la Haye <service@delahaye.de>
 * @author     Richard Henkenjohann <richardhenkenjohann@googlemail.com>
 * @copyright  2015-2018 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_range/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

namespace MetaModels\FilterRangeBundle\FilterSetting;

/**
 * Filter "value in range of 2 fields" for FE-filtering, based on filters by the meta models team.
 *
 * @package    MetaModels
 * @subpackage FilterRange
 * @author     Christian de la Haye <service@delahaye.de>
 */
class Range extends AbstractRange
{
    /**
     * {@inheritDoc}
     */
    protected function formatValue($value)
    {
        return $value;
    }
}
