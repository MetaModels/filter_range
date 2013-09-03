<?php

/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 * @package    MetaModels
 * @subpackage FilterRange
 * @author     Christian de la Haye <service@delahaye.de>
 * @copyright  The MetaModels team.
 * @license    LGPL.
 * @filesource
 */

/**
 * Frontend filter
 */
$GLOBALS['METAMODELS']['filters']['range']['class'] = 'MetaModels\Filter\Setting\Range';
$GLOBALS['METAMODELS']['filters']['range']['image'] = 'system/modules/metamodelsfilter_range/html/filter_range.png';
$GLOBALS['METAMODELS']['filters']['range']['info_callback'] = array('MetaModels\Dca\Filter', 'infoCallback');
$GLOBALS['METAMODELS']['filters']['range']['attr_filter'][] = 'numeric';
$GLOBALS['METAMODELS']['filters']['range']['attr_filter'][] = 'decimal';

// non composerized Contao 2.X autoload support.
$GLOBALS['MM_AUTOLOAD'][] = dirname(__DIR__);
$GLOBALS['MM_AUTOLOAD'][] = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'deprecated';
