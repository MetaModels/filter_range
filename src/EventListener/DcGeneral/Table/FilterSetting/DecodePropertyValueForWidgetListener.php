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
 * @author     Richard Henkenjohann <richardhenkenjohann@googlemail.com>
 * @copyright  2012-2019 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_range/blob/master/LICENSE LGPL-3.0-or-later
 * @filesource
 */

namespace MetaModels\FilterRangeBundle\EventListener\DcGeneral\Table\FilterSetting;

use ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\DecodePropertyValueForWidgetEvent;

/**
 * This is used to translate attribute ids to attribute names.
 */
class DecodePropertyValueForWidgetListener extends AbstractAbstainingListener
{
    /**
     * Translates an attribute id to a generated alias {@see getAttributeNames()}.
     *
     * @param DecodePropertyValueForWidgetEvent $event The event.
     *
     * @return void
     *
     * @throws \RuntimeException When the MetaModel can not be determined.
     */
    public function handle(DecodePropertyValueForWidgetEvent $event)
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
            $event->setValue($metaModel->getTableName().'_'.$attribute->getColName());
        }
    }
}
