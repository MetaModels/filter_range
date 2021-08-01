<?php

/**
 * This file is part of MetaModels/filter_range.
 *
 * (c) 2012-2021 The MetaModels team.
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
 * @author     Ingolf Steinhardt <info@e-spin.de>
 * @copyright  2012-2021 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_range/blob/master/LICENSE LGPL-3.0-or-later
 * @filesource
 */

namespace MetaModels\FilterRangeBundle\EventListener\DcGeneral\Table\FilterSetting;

use ContaoCommunityAlliance\DcGeneral\Data\ModelInterface;
use ContaoCommunityAlliance\DcGeneral\DataDefinition\ContainerInterface;
use MetaModels\Filter\Setting\IFilterSettingFactory;
use MetaModels\IMetaModel;

/**
 * The abstract base for the listeners.
 */
abstract class AbstractAbstainingListener
{
    /**
     * The filter setting factory.
     *
     * @var IFilterSettingFactory
     */
    protected $filterSettingFactory;

    /**
     * AbstractAbstainingListener constructor.
     *
     * @param IFilterSettingFactory $filterSettingFactory The filter setting factory.
     */
    public function __construct(IFilterSettingFactory $filterSettingFactory)
    {
        $this->filterSettingFactory = $filterSettingFactory;
    }

    /**
     * Check if the context of the event is a allowed one.
     *
     * @param ContainerInterface $dataDefinition The data definition from the environment.
     *
     * @param string             $propertyName   The current property name.
     *
     * @param ModelInterface     $model          The current model.
     *
     * @return bool True => It is a allowed one | False => nope
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function isAllowedContext($dataDefinition, $propertyName, $model)
    {
        // Check the name of the data def.
        if ('tl_metamodel_filtersetting' !== $dataDefinition->getName()) {
            return false;
        }

        // Check the name of the property.
        return ('attr_id2' === $propertyName);
    }

    /**
     * Retrieve the MetaModel attached to the model filter setting.
     *
     * @param ModelInterface $model The model for which to retrieve the MetaModel.
     *
     * @return IMetaModel
     *
     * @throws \RuntimeException When the MetaModel can not be determined.
     */
    protected function getMetaModel(ModelInterface $model)
    {
        $filterSetting = $this->filterSettingFactory->createCollection($model->getProperty('fid'));

        return $filterSetting->getMetaModel();
    }
}
