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
 * @author     Andreas Isaak <info@andreas-isaak.de>
 * @author     Christian de la Haye <service@delahaye.de>
 * @author     Ingolf Steinhardt <info@e-spin.de>
 * @author     Richard Henkenjohann <richardhenkenjohann@googlemail.com>
 * @author     Sven Baumann <baumann.sv@gmail.com>
 * @copyright  2012-2024 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_range/blob/master/LICENSE LGPL-3.0-or-later
 * @filesource
 */

use Contao\Config;

// Range normal.
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['range extends _attribute_']['+config'][]   =
    'attr_id2';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['range extends _attribute_']['+fefilter'][] =
    'urlparam';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['range extends _attribute_']['+fefilter'][] =
    'label';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['range extends _attribute_']['+fefilter'][] =
    'hide_label';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['range extends _attribute_']['+fefilter'][] =
    'template';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['range extends _attribute_']['+fefilter'][] =
    'placeholder';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['range extends _attribute_']['+fefilter'][] =
    'filterrange_type';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['range extends _attribute_']['+fefilter'][] =
    'moreequal';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['range extends _attribute_']['+fefilter'][] =
    'lessequal';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['range extends _attribute_']['+fefilter'][] =
    'fromfield';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['range extends _attribute_']['+fefilter'][] =
    'tofield';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['range extends _attribute_']['+fefilter'][] =
    'cssID';

// From/To for date.
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['rangedate extends _attribute_']['+config'][]   =
    'attr_id2';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['rangedate extends _attribute_']['+fefilter'][] =
    'urlparam';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['rangedate extends _attribute_']['+fefilter'][] =
    'dateformat';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['rangedate extends _attribute_']['+fefilter'][] =
    'timetype';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['rangedate extends _attribute_']['+fefilter'][] =
    'label';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['rangedate extends _attribute_']['+fefilter'][] =
    'hide_label';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['rangedate extends _attribute_']['+fefilter'][] =
    'template';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['rangedate extends _attribute_']['+fefilter'][] =
    'placeholder';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['rangedate extends _attribute_']['+fefilter'][] =
    'filterrange_type';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['rangedate extends _attribute_']['+fefilter'][] =
    'moreequal';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['rangedate extends _attribute_']['+fefilter'][] =
    'lessequal';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['rangedate extends _attribute_']['+fefilter'][] =
    'fromfield';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['rangedate extends _attribute_']['+fefilter'][] =
    'tofield';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['rangedate extends _attribute_']['+fefilter'][] =
    'cssID';

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['moreequal'] = [
    'label'       => 'moreequal.label',
    'description' => 'moreequal.description',
    'exclude'     => true,
    'default'     => '1',
    'inputType'   => 'checkbox',
    'eval'        => [
        'tl_class' => 'clr w50 cbx m12',
    ],
    'sql'         => 'char(1) NOT NULL default \'1\'',
];

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['lessequal'] = [
    'label'       => 'lessequal.label',
    'description' => 'lessequal.description',
    'exclude'     => true,
    'default'     => '1',
    'inputType'   => 'checkbox',
    'eval'        => [
        'tl_class' => 'w50 cbx m12',
    ],
    'sql'         => 'char(1) NOT NULL default \'1\'',
];

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['fromfield'] = [
    'label'       => 'fromfield.label',
    'description' => 'fromfield.description',
    'exclude'     => true,
    'default'     => '1',
    'inputType'   => 'checkbox',
    'eval'        => [
        'tl_class' => 'clr w50 cbx m12',
    ],
    'sql'         => 'char(1) NOT NULL default \'1\'',
];

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['tofield'] = [
    'label'       => 'tofield.label',
    'description' => 'tofield.description',
    'exclude'     => true,
    'default'     => '1',
    'inputType'   => 'checkbox',
    'eval'        => [
        'tl_class' => 'w50 cbx m12',
    ],
    'sql'         => 'char(1) NOT NULL default \'1\'',
];

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['dateformat'] = [
    'label'       => 'dateformat.label',
    'description' => 'dateformat.description',
    'exclude'     => true,
    'inputType'   => 'text',
    'default'     => Config::get('dateFormat'),
    'eval'        => [
        'mandatory' => true,
        'tl_class'  => 'w50',
    ],
    'sql'         => 'char(32) NOT NULL default \'\'',
];

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['timetype'] = [
    'label'       => 'timetype.label',
    'description' => 'timetype.description',
    'exclude'     => true,
    'inputType'   => 'select',
    'options'     => [
        'date',
        'datim',
        'time',
    ],
    'reference'   => [
        'date'  => 'timetypeOptions.date',
        'datim' => 'timetypeOptions.datim',
        'time'  => 'timetypeOptions.time',
    ],
    'eval'        => [
        'doNotSaveEmpty' => true,
        'tl_class'       => 'w50',
    ],
    'sql'         => 'varchar(64) NOT NULL default \'\'',
];

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['attr_id2'] = [
    'label'       => 'attr_id2.label',
    'description' => 'attr_id2.description',
    'exclude'     => true,
    'inputType'   => 'select',
    'eval'        => [
        'doNotSaveEmpty'     => true,
        'alwaysSave'         => true,
        'submitOnChange'     => true,
        'includeBlankOption' => true,
        'mandatory'          => true,
        'tl_class'           => 'w50',
        'chosen'             => true,
    ],
    'sql'         => 'int(10) unsigned NOT NULL default \'0\'',
];

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['placeholder'] = [
    'label'       => 'placeholder.label',
    'description' => 'placeholder.description',
    'exclude'     => true,
    'inputType'   => 'text',
    'eval'        => ['tl_class' => 'clr w50'],
    'sql'         => ['type' => 'string', 'length' => 255, 'default' => ''],
];

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['filterrange_type'] = [
    'label'       => 'filterrange_type.label',
    'description' => 'filterrange_type.description',
    'exclude'     => true,
    'inputType'   => 'select',
    'options'     => ['s1', 's2', 's3', 's4', 's5'],
    'reference'   => [
        's1' => 'filterrangetypeOptions.s1',
        's2' => 'filterrangetypeOptions.s2',
        's3' => 'filterrangetypeOptions.s3',
        's4' => 'filterrangetypeOptions.s4',
        's5' => 'filterrangetypeOptions.s5',
    ],
    'default'     => 's4',
    'eval'        => [
        'includeBlankOption' => true,
        'mandatory'          => true,
        'tl_class'           => 'clr w50',
        'chosen'             => true,
        'helpwizard'         => true,
    ],
    'explanation' => 'filterrangetypeOptions',
    'sql'         => ['type' => 'string', 'length' => 3, 'default' => 's4'],
];
