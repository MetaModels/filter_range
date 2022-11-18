<?php

/**
 * * This file is part of MetaModels/filter_range.
 *
 * (c) 2015-2021 The MetaModels team.
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
 * @author     Ingolf Steinhardt <info@e-spin.de>
 * @copyright  2015-2021 The MetaModels team.
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
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['moreequal']                    =
    ['Value 1 included', 'Standard: excluded.'];
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['lessequal']                    =
    ['Value 2 included', 'Standard: excluded.'];
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['fromfield']                    =
    ['Field for value 1', 'Show FE field for value no 1.'];
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['tofield']                      =
    ['Field for value 2', 'Show FE field for value no 2.'];
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['attr_id2']                     =
    ['Second attribute', 'Second attribute this setting relates to.'];
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['timetype']                     =
    ['Schema', 'Here you can select the desired scheme.'];
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['timetypeOptions']['time']      = 'Time';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['timetypeOptions']['date']      = 'Date';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['timetypeOptions']['datim']     = 'Date and time';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['placeholder'][0]               = 'Placeholder';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['placeholder'][1]               =
    'Show this text as long as the field is empty.';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['filterrange_type']             =
    ['Type of filtering', 'Here you can select the type of filtering.'];
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['filterrangetypeOptions']['s1'] =
    'Both values must be in the range. (S1)';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['filterrangetypeOptions']['s2'] =
    'The second value must be in the range. (S2)';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['filterrangetypeOptions']['s3'] =
    'The first value must be in the range. (S3)';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['filterrangetypeOptions']['s4'] =
    'The first or the second value must be in the range. (S4)';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['filterrangetypeOptions']['s5'] =
    'The range must be between the first and second value. (S5)';
