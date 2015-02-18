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
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author     Stefan Heimes <stefan_heimes@hotmail.com>
 * @author     Andreas Isaak <info@andreas-isaak.de>
 * @author     Christian de la Haye <service@delahaye.de>
 * @copyright  The MetaModels team.
 * @license    LGPL.
 * @filesource
 */

namespace MetaModels\Filter\Setting;

use MetaModels\Filter\IFilter;
use MetaModels\Filter\Rules\Comparing\GreaterThan;
use MetaModels\Filter\Rules\Comparing\LessThan;
use MetaModels\Filter\Rules\StaticIdList;
use MetaModels\FrontendIntegration\FrontendFilterOptions;

/**
 * Filter "value in range of 2 fields" for FE-filtering, based on filters by the meta models team.
 *
 * @package    MetaModels
 * @subpackage FilterRange
 * @author     Christian de la Haye <service@delahaye.de>
 */
class Range extends Simple
{
    /**
     * {@inheritdoc}
     */
    public function prepareRules(IFilter $objFilter, $arrFilterUrl)
    {
        $objMetaModel  = $this->getMetaModel();
        $objAttribute  = $objMetaModel->getAttributeById($this->get('attr_id'));
        $objAttribute2 = $objMetaModel->getAttributeById($this->get('attr_id2'));

        if (!$objAttribute2) {
            $objAttribute2 = $objAttribute;
        }

        $strParamName  = $this->getParamName();
        $strParamValue = $arrFilterUrl[$strParamName];

        if ($objAttribute && $objAttribute2 && $strParamName && $strParamValue) {
            $objFilter
                ->addFilterRule(new LessThan($objAttribute, $strParamValue, (bool) $this->get('moreequal')))
                ->addFilterRule(new GreaterThan($objAttribute2, $strParamValue, (bool) $this->get('lessequal')));

            return;
        }

        $objFilter->addFilterRule(new StaticIdList(null));
    }

    /**
     * {@inheritdoc}
     */
    protected function getParamName()
    {
        if ($this->get('urlparam')) {
            return $this->get('urlparam');
        }

        $objAttribute = $this->getMetaModel()->getAttributeById($this->get('attr_id'));
        if ($objAttribute) {
            return $objAttribute->getColName();
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getParameterFilterNames()
    {
        $strLabel = ($this->get('label') ?: $this->getMetaModel()->getAttributeById($this->get('attr_id'))->getName());

        return array(
            $this->getParamName() => $strLabel
        );
    }

    /**
     * {@inheritdoc}
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     * @SuppressWarnings(PHPMD.CamelCaseVariableName)
     */
    public function getParameterFilterWidgets(
        $arrIds,
        $arrFilterUrl,
        $arrJumpTo,
        FrontendFilterOptions $objFrontendFilterOptions
    ) {
        $objAttribute = $this->getMetaModel()->getAttributeById($this->get('attr_id'));

        $arrLabel = array(
            ($this->get('label') ? $this->get('label') : $objAttribute->getName()),
            'GET: ' . $this->getParamName()
        );

        $GLOBALS['MM_FILTER_PARAMS'][] = $this->getParamName();

        return array(
            $this->getParamName() => $this->prepareFrontendFilterWidget(
                array
                (
                    'label' => $arrLabel,
                    'inputType' => 'text',
                    'eval' => array
                    (
                        'urlparam' => $this->getParamName(),
                        'template' => $this->get('template')
                    )
                ),
                $arrFilterUrl,
                $arrJumpTo,
                $objFrontendFilterOptions
            )
        );
    }

    /**
     * Retrieve the attributes that are referenced in this filter setting.
     *
     * @return array
     */
    public function getReferencedAttributes()
    {
        $objMetaModel  = $this->getMetaModel();
        $objAttribute  = $objMetaModel->getAttributeById($this->get('attr_id'));
        $objAttribute2 = $objMetaModel->getAttributeById($this->get('attr_id2'));
        $arrResult     = array();

        if ($objAttribute) {
            $arrResult[] = $objAttribute->getColName();
        }

        if ($objAttribute2) {
            $arrResult[] = $objAttribute2->getColName();
        }

        return $arrResult;
    }
}
