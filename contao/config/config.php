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
$GLOBALS['METAMODELS']['filters']['range']['class']         = 'MetaModels\Filter\Setting\Range';
$GLOBALS['METAMODELS']['filters']['range']['image']         =
    'system/modules/metamodelsfilter_range/html/filter_range.png';
$GLOBALS['METAMODELS']['filters']['range']['info_callback'] = array(
    'MetaModels\DcGeneral\Events\Table\FilterSetting\DrawSetting',
    'modelToLabelWithAttributeAndUrlParam'
);
$GLOBALS['METAMODELS']['filters']['range']['attr_filter'][] = 'numeric';
$GLOBALS['METAMODELS']['filters']['range']['attr_filter'][] = 'decimal';

$GLOBALS['TL_EVENTS'][\ContaoCommunityAlliance\Contao\EventDispatcher\Event\CreateEventDispatcherEvent::NAME][] =
    'MetaModels\DcGeneral\Events\Filter\Setting\Range\Subscriber::registerEvents';
