<?php

/**
 * This file is part of MetaModels/filter_range.
 *
 * (c) 2012-2018 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    MetaModels
 * @subpackage FilterRange
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author     Stefan Heimes <stefan_heimes@hotmail.com>
 * @author     Andreas Isaak <info@andreas-isaak.de>
 * @author     Christian de la Haye <service@delahaye.de>
 * @author     Ingolf Steinhardt <info@e-spin.de>
 * @copyright  2012-2018 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_range/blob/master/LICENSE LGPL-3.0-or-later
 * @filesource
 */

// Range normal.
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['range extends _attribute_']['+config'][]   =
    'attr_id2';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['range extends _attribute_']['+fefilter'][] =
    'urlparam';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['range extends _attribute_']['+fefilter'][] =
    'label';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['range extends _attribute_']['+fefilter'][] =
    'template';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['range extends _attribute_']['+fefilter'][] =
    'moreequal';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['range extends _attribute_']['+fefilter'][] =
    'lessequal';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['range extends _attribute_']['+fefilter'][] =
    'fromfield';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['range extends _attribute_']['+fefilter'][] =
    'tofield';

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
    'template';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['rangedate extends _attribute_']['+fefilter'][] =
    'moreequal';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['rangedate extends _attribute_']['+fefilter'][] =
    'lessequal';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['rangedate extends _attribute_']['+fefilter'][] =
    'fromfield';
$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['metapalettes']['rangedate extends _attribute_']['+fefilter'][] =
    'tofield';


$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['moreequal'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['moreequal'],
    'exclude'   => true,
    'default'   => true,
    'inputType' => 'checkbox',
    'sql'       => 'char(1) NOT NULL default \'1\'',
    'eval'      => array
    (
        'tl_class' => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['lessequal'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['lessequal'],
    'exclude'   => true,
    'default'   => true,
    'inputType' => 'checkbox',
    'sql'       => 'char(1) NOT NULL default \'1\'',
    'eval'      => array
    (
        'tl_class' => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['fromfield'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['fromfield'],
    'exclude'   => true,
    'default'   => true,
    'inputType' => 'checkbox',
    'sql'       => 'char(1) NOT NULL default \'1\'',
    'eval'      => array
    (
        'tl_class' => 'w50',
    ),
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['tofield'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['tofield'],
    'exclude'   => true,
    'default'   => true,
    'inputType' => 'checkbox',
    'sql'       => 'char(1) NOT NULL default \'1\'',
    'eval'      => array
    (
        'tl_class' => 'w50',
    ),
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['dateformat'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['dateformat'],
    'exclude'   => true,
    'inputType' => 'text',
    'sql'       => 'char(32) NOT NULL default \'\'',
    'eval'      => array
    (
        'tl_class' => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['timetype'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['timetype'],
    'exclude'   => true,
    'inputType' => 'select',
    'reference' => &$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['timetypeOptions'],
    'options'   => array
    (
        'time',
        'date',
        'datim'
    ),
    'sql'       => 'varchar(64) NOT NULL default \'\'',
    'eval'      => array
    (
        'doNotSaveEmpty' => true,
        'tl_class'       => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_metamodel_filtersetting']['fields']['attr_id2'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['attr_id2'],
    'exclude'   => true,
    'inputType' => 'select',
    'sql'       => 'int(10) unsigned NOT NULL default \'0\'',
    'eval'      => array
    (
        'doNotSaveEmpty'     => true,
        'alwaysSave'         => true,
        'submitOnChange'     => true,
        'includeBlankOption' => true,
        'mandatory'          => true,
        'tl_class'           => 'w50',
        'chosen'             => true
    ),
);
