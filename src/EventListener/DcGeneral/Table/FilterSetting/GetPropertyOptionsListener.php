<?php

/**
 * * This file is part of MetaModels/filter_range.
 *
 * (c) 2015-2018 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    MetaModels
 * @subpackage FilterRangeBundle
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author     Stefan Heimes <stefan_heimes@hotmail.com>
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @author     Richard Henkenjohann <richardhenkenjohann@googlemail.com>
 * @copyright  2015-2018 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_range/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

namespace MetaModels\FilterRangeBundle\EventListener\DcGeneral\Table\FilterSetting;


use ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\GetPropertyOptionsEvent;

class GetPropertyOptionsListener extends AbstractAbstainingListener
{

    /**
     * Prepares a option list with alias => name connection for all attributes.
     *
     * This is used in the attr_id select box.
     *
     * @param GetPropertyOptionsEvent $event The event.
     *
     * @return void
     *
     * @throws \RuntimeException When the MetaModel can not be determined.
     */
    public function handle(GetPropertyOptionsEvent $event)
    {
        $isAllowed = $this->isAllowedContext(
            $event->getEnvironment()->getDataDefinition(),
            $event->getPropertyName(),
            $event->getModel()
        );

        if (!$isAllowed) {
            return;
        }

        $result = [];
        $model  = $event->getModel();

        $metaModel   = $this->getMetaModel($model);
        $typeFactory = $this->filterSettingFactory->getTypeFactory($model->getProperty('type'));

        $typeFilter = null;
        if ($typeFactory) {
            $typeFilter = $typeFactory->getKnownAttributeTypes();
        }

        foreach ($metaModel->getAttributes() as $attribute) {
            $typeName = $attribute->get('type');

            if ($typeFilter && (!\in_array($typeName, $typeFilter, true))) {
                continue;
            }

            $strSelectVal          = $metaModel->getTableName().'_'.$attribute->getColName();
            $result[$strSelectVal] = $attribute->getName().' ['.$typeName.']';
        }

        $event->setOptions($result);
    }
}
