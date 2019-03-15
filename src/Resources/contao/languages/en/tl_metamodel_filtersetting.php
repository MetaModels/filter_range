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
 * @author     Christian de la Haye <service@delahaye.de>
 * @author     Richard Henkenjohann <richardhenkenjohann@googlemail.com>
 * @copyright  2015-2018 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_range/blob/master/LICENSE LGPL-3.0
 * @filesource
 */


/**
 * filter types
 */
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['typenames']['range']     = 'Value within 2 fields';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['typenames']['rangedate'] = 'Value within 2 fields for date';


/**
 * fields
 */
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['moreequal']                = array('Value 1 included', 'Standard: excluded.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['lessequal']                = array('Value 2 included', 'Standard: excluded.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['fromfield']                = array('Field for value 1', 'Show FE field for value no 1.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['tofield']                  = array('Field for value 2', 'Show FE field for value no 2.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['attr_id2']                 = array('Second attribute', 'Second attribute this setting relates to.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['timetype']                 = array('Schema', 'Here you can select the desired scheme.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['timetypeOptions']['time']  = 'Time';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['timetypeOptions']['date']  = 'Date';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['timetypeOptions']['datim'] = 'Date and time';
