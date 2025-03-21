<?php

/**
 * This file is part of MetaModels/filter_range.
 *
 * (c) 2012-2024 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    MetaModels/filter_range
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author     Stefan Heimes <stefan_heimes@hotmail.com>
 * @author     Richard Henkenjohann <richardhenkenjohann@googlemail.com>
 * @author     Ingolf Steinhardt <info@e-spin.de>
 * @copyright  2012-2024 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_range/blob/master/LICENSE LGPL-3.0-or-later
 * @filesource
 */

namespace MetaModels\FilterRangeBundle\FilterSetting;

/**
 * Filter "value in range of 2 fields" for FE-filtering, based on filters by the meta models team.
 */
class RangeDate extends AbstractRange
{
    /**
     * {@inheritDoc}
     */
    protected function formatValue($value)
    {
        // Try to make a date from a string.
        $date = \DateTime::createFromFormat($this->get('dateformat'), $value);

        // Check if we have a date, if not return a empty string.
        if (false === $date) {
            return '';
        }

        // Make a unix timestamp from the string.
        return (string) $date->getTimestamp();
    }
}
