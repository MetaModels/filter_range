<?php
/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 * @package    MetaModels
 * @subpackage Core
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @copyright  The MetaModels team.
 * @license    LGPL.
 * @filesource
 */

namespace MetaModels\DcGeneral\Events\Filter\Setting\Range;

use ContaoCommunityAlliance\Contao\EventDispatcher\Event\CreateEventDispatcherEvent;
use ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\DecodePropertyValueForWidgetEvent;
use ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\EncodePropertyValueFromWidgetEvent;
use ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\GetPropertyOptionsEvent;
use ContaoCommunityAlliance\DcGeneral\Factory\Event\BuildDataDefinitionEvent;
use MetaModels\DcGeneral\Events\BaseSubscriber;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Central event subscriber implementation.
 *
 * @package MetaModels\DcGeneral\Events\Filter\Setting\Range
 */
class Subscriber extends BaseSubscriber
{
    /**
     * Register all listeners to handle creation of a data container.
     *
     * @param CreateEventDispatcherEvent $event The event.
     *
     * @return void
     */
    public static function registerEvents(CreateEventDispatcherEvent $event)
    {
        $dispatcher = $event->getEventDispatcher();
        // Handlers for build data definition.
        self::registerBuildDataDefinitionFor(
            'tl_metamodel_filtersetting',
            $dispatcher,
            __CLASS__ . '::registerTableMetaModelFilterSettingEvents'
        );
    }

    /**
     * Register the events for table tl_metamodel_filtersetting.
     *
     * @param BuildDataDefinitionEvent $event The event being processed.
     *
     * @return void
     */
    public static function registerTableMetaModelFilterSettingEvents(BuildDataDefinitionEvent $event)
    {
        static $registered;
        if ($registered) {
            return;
        }
        $registered = true;
        $dispatcher = $event->getDispatcher();

        self::registerListeners(
            array(
                GetPropertyOptionsEvent::NAME
                => 'MetaModels\DcGeneral\Events\Table\FilterSetting\PropertyAttributeId::getOptions',
                DecodePropertyValueForWidgetEvent::NAME
                => 'MetaModels\DcGeneral\Events\Table\FilterSetting\PropertyAttributeId::decodeValue',
                EncodePropertyValueFromWidgetEvent::NAME
                => 'MetaModels\DcGeneral\Events\Table\FilterSetting\PropertyAttributeId::encodeValue'
            ),
            $dispatcher,
            array('tl_metamodel_filtersetting', 'attr_id2')
        );
    }
}
