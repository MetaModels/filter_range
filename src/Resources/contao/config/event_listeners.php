<?php
/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * @package    MetaModels
 * @subpackage FilterRange
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author     Stefan Heimes <stefan_heimes@hotmail.com>
 * @copyright  2015 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_range/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

use MetaModels\DcGeneral\Events\Filter\Setting\Range\Subscriber;
use MetaModels\Events\MetaModelsBootEvent;
use MetaModels\Filter\Setting\Events\CreateFilterSettingFactoryEvent;
use MetaModels\Filter\Setting\RangeFilterSettingTypeFactory;
use MetaModels\Filter\Setting\RangeDateFilterSettingTypeFactory;
use MetaModels\MetaModelsEvents;

return array
(
    MetaModelsEvents::SUBSYSTEM_BOOT_BACKEND => array(
        function (MetaModelsBootEvent $event) {
            new Subscriber($event->getServiceContainer());
        }
    ),
    MetaModelsEvents::FILTER_SETTING_FACTORY_CREATE => array(
        function (CreateFilterSettingFactoryEvent $event) {
            $event->getFactory()->addTypeFactory(new RangeFilterSettingTypeFactory());
            $event->getFactory()->addTypeFactory(new RangeDateFilterSettingTypeFactory());
        }
    )
);
