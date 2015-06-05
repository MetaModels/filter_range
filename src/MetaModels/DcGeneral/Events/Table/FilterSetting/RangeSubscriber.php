<?php
/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 *
 * @package    MetaModels
 * @subpackage Core
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author     Christopher Boelter <christopher@boelter.eu>
 * @copyright  The MetaModels team.
 * @license    LGPL.
 * @filesource
 */

namespace MetaModels\DcGeneral\Events\Table\FilterSetting;

use ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\DecodePropertyValueForWidgetEvent;
use ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\EncodePropertyValueFromWidgetEvent;
use ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\GetPropertyOptionsEvent;
use ContaoCommunityAlliance\DcGeneral\Data\ModelInterface;
use MetaModels\DcGeneral\Events\BaseSubscriber;
use MetaModels\IMetaModel;

/**
 * Handles event operations on tl_metamodel_filtersetting.
 */
class RangeSubscriber extends BaseSubscriber
{
    /**
     * Register all listeners to handle creation of a data container.
     *
     * @return void
     */
    protected function registerEventsInDispatcher()
    {
        $this
            ->addListener(
                GetPropertyOptionsEvent::NAME,
                array($this, 'getAttributeIdOptions')
            )
            ->addListener(
                DecodePropertyValueForWidgetEvent::NAME,
                array($this, 'decodeAttributeIdValue')
            )
            ->addListener(
                EncodePropertyValueFromWidgetEvent::NAME,
                array($this, 'encodeAttributeIdValue')
            );
    }

    /**
     * Retrieve the MetaModel attached to the model filter setting.
     *
     * @param ModelInterface $model The model for which to retrieve the MetaModel.
     *
     * @return IMetaModel
     */
    public function getMetaModel(ModelInterface $model)
    {
        $filterSetting = $this->getServiceContainer()->getFilterFactory()->createCollection($model->getProperty('fid'));

        return $filterSetting->getMetaModel();
    }

    /**
     * Prepares a option list with alias => name connection for all attributes.
     *
     * This is used in the attr_id select box.
     *
     * @param GetPropertyOptionsEvent $event The event.
     *
     * @return void
     */
    public function getAttributeIdOptions(GetPropertyOptionsEvent $event)
    {
        if (($event->getEnvironment()->getDataDefinition()->getName() !== 'tl_metamodel_filtersetting')
            || ($event->getPropertyName() !== 'attr_id2')) {
            return;
        }

        $result = array();
        $model  = $event->getModel();

        $metaModel   = $this->getMetaModel($model);
        $typeFactory = $this
            ->getServiceContainer()
            ->getFilterFactory()
            ->getTypeFactory($model->getProperty('type'));

        $typeFilter = null;
        if ($typeFactory) {
            $typeFilter = $typeFactory->getKnownAttributeTypes();
        }

        foreach ($metaModel->getAttributes() as $attribute) {
            $typeName = $attribute->get('type');

            if ($typeFilter && (!in_array($typeName, $typeFilter))) {
                continue;
            }

            $strSelectVal          = $metaModel->getTableName() .'_' . $attribute->getColName();
            $result[$strSelectVal] = $attribute->getName() . ' [' . $typeName . ']';
        }

        $event->setOptions($result);
    }

    /**
     * Translates an attribute id to a generated alias {@see getAttributeNames()}.
     *
     * @param DecodePropertyValueForWidgetEvent $event The event.
     *
     * @return void
     */
    public function decodeAttributeIdValue(DecodePropertyValueForWidgetEvent $event)
    {
        if (($event->getEnvironment()->getDataDefinition()->getName() !== 'tl_metamodel_filtersetting')
            || ($event->getProperty() !== 'attr_id2')) {
            return;
        }

        $model     = $event->getModel();
        $metaModel = $this->getMetaModel($model);
        $value     = $event->getValue();

        if (!($metaModel && $value)) {
            return;
        }

        $attribute = $metaModel->getAttributeById($value);
        if ($attribute) {
            $event->setValue($metaModel->getTableName() .'_' . $attribute->getColName());
        }
    }

    /**
     * Translates an generated alias {@see getAttributeNames()} to the corresponding attribute id.
     *
     * @param EncodePropertyValueFromWidgetEvent $event The event.
     *
     * @return void
     */
    public function encodeAttributeIdValue(EncodePropertyValueFromWidgetEvent $event)
    {
        if (($event->getEnvironment()->getDataDefinition()->getName() !== 'tl_metamodel_filtersetting')
            || ($event->getProperty() !== 'attr_id2')) {
            return;
        }

        $model     = $event->getModel();
        $metaModel = $this->getMetaModel($model);
        $value     = $event->getValue();

        if (!($metaModel && $value)) {
            return;
        }

        $value = str_replace($metaModel->getTableName() . '_', '', $value);

        $attribute = $metaModel->getAttribute($value);

        if ($attribute) {
            $event->setValue($attribute->get('id'));
        }
    }
}
