<?php
/**
 * This file is part of MetaModels/filter_range.
 *
 * (c) 2012-2019 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    MetaModels/filter_range
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author     Stefan Heimes <stefan_heimes@hotmail.com>
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2012-2019 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_range/blob/master/LICENSE LGPL-3.0-or-later
 * @filesource
 */

namespace MetaModels\DcGeneral\Events\Filter\Setting\Range;

use ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\DecodePropertyValueForWidgetEvent;
use ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\EncodePropertyValueFromWidgetEvent;
use ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\GetPropertyOptionsEvent;
use ContaoCommunityAlliance\DcGeneral\Data\ModelInterface;
use ContaoCommunityAlliance\DcGeneral\DataDefinition\ContainerInterface;
use MetaModels\DcGeneral\Events\BaseSubscriber;
use MetaModels\IMetaModel;

/**
 * Central event subscriber implementation.
 */
class Subscriber extends BaseSubscriber
{
    /**
     * {@inheritdoc}
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
     * Check if the contect of the event is a allowed one.
     *
     * @param ContainerInterface $dataDefinition The data definition from the environment.
     *
     * @param string             $propertyName   The current property name.
     *
     * @param ModelInterface     $model          The current model.
     *
     * @return bool True => It is a allowed one | False => nope
     */
    protected function isAllowedContext($dataDefinition, $propertyName, $model)
    {
        // Check the name of the data def.
        if ($dataDefinition->getName() !== 'tl_metamodel_filtersetting') {
            return false;
        }

        // Check the name of the property.
        if ($propertyName !== 'attr_id2') {
            return false;
        }

        // Check the type.
        if ($model->getProperty('type') !== 'range' && $model->getProperty('type') !== 'rangedate') {
            return false;
        }

        // At the end, return true.
        return true;
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
        $isAllowed = $this->isAllowedContext(
            $event->getEnvironment()->getDataDefinition(),
            $event->getPropertyName(),
            $event->getModel()
        );

        if (!$isAllowed) {
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
        $isAllowed = $this->isAllowedContext(
            $event->getEnvironment()->getDataDefinition(),
            $event->getProperty(),
            $event->getModel()
        );

        if (!$isAllowed) {
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
        $isAllowed = $this->isAllowedContext(
            $event->getEnvironment()->getDataDefinition(),
            $event->getProperty(),
            $event->getModel()
        );

        if (!$isAllowed) {
            return;
        }

        $model     = $event->getModel();
        $metaModel = $this->getMetaModel($model);
        $value     = $event->getValue();

        if (!($metaModel && $value)) {
            return;
        }

        $value = substr($value, strlen($metaModel->getTableName() . '_'));

        $attribute = $metaModel->getAttribute($value);

        if ($attribute) {
            $event->setValue($attribute->get('id'));
        }
    }
}
