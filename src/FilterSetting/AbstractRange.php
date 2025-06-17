<?php

/**
 * This file is part of MetaModels/filter_range.
 *
 * (c) 2012-2025 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    MetaModels/filter_range
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author     Stefan Heimes <stefan_heimes@hotmail.com>
 * @author     Richard Henkenjohann <richardhenkenjohann@googlemail.com>
 * @author     Ingolf Steinhardt <info@e-spin.de>
 * @copyright  2012-2025 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_range/blob/master/LICENSE LGPL-3.0-or-later
 * @filesource
 */

namespace MetaModels\FilterRangeBundle\FilterSetting;

use Contao\StringUtil;
use MetaModels\Attribute\IAttribute;
use MetaModels\Filter\IFilter;
use MetaModels\Filter\Rules\Comparing\GreaterThan;
use MetaModels\Filter\Rules\Comparing\LessThan;
use MetaModels\Filter\Rules\StaticIdList;
use MetaModels\Filter\Setting\Simple;
use MetaModels\FrontendIntegration\FrontendFilterOptions;

/**
 * Filter "value in range of 2 fields" for FE-filtering.
 *
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
abstract class AbstractRange extends Simple
{
    /**
     * Format the value for use in SQL.
     *
     * @param mixed $value The value to format.
     *
     * @return string
     */
    abstract protected function formatValue($value);

    /**
     * {@inheritdoc}
     */
    public function getParameters()
    {
        $strParamName = $this->getParamName();
        assert(\is_string($strParamName));

        return $strParamName ? [$strParamName] : [];
    }

    /**
     * {@inheritdoc}
     */
    public function getParameterFilterNames()
    {
        $strParamName = $this->getParamName();
        assert(\is_string($strParamName));

        if ($this->get('label')) {
            return [$strParamName => $this->get('label')];
        }

        return [
            $strParamName => \sprintf(
                '%s / %s',
                $this->getMetaModel()->getAttributeById((int) $this->get('attr_id'))?->getName() ?? '',
                $this->getMetaModel()->getAttributeById((int) $this->get('attr_id2'))?->getName() ?? ''
            )
        ];
    }

    /**
     * Retrieve the parameter value from the filter url.
     *
     * @param array $filterUrl The filter url from which to extract the parameter.
     *
     * @return null|string|array
     */
    protected function getParameterValue($filterUrl)
    {
        $parameterName = $this->getParamName();
        assert(\is_string($parameterName));

        if (isset($filterUrl[$parameterName]) && !empty($filterUrl[$parameterName])) {
            if (\is_array($filterUrl[$parameterName])) {
                return \array_values(\array_filter($filterUrl[$parameterName]));
            }

            return \array_values(\array_filter(\explode(',', $filterUrl[$parameterName])));
        }

        return null;
    }

    /**
     * Retrieve the attributes that are referenced in this filter setting.
     *
     * @return list<string>
     */
    public function getReferencedAttributes()
    {
        $objMetaModel  = $this->getMetaModel();
        $objAttribute  = $objMetaModel->getAttributeById((int) $this->get('attr_id'));
        $objAttribute2 = $objMetaModel->getAttributeById((int) $this->get('attr_id2'));
        $arrResult     = [];

        if ($objAttribute) {
            $arrResult[] = $objAttribute->getColName();
        }

        if ($objAttribute2) {
            $arrResult[] = $objAttribute2->getColName();
        }

        return $arrResult;
    }

    /**
     * Retrieve the filter parameter name to react on.
     *
     * @return string|null
     */
    protected function getParamName()
    {
        if ($this->get('urlparam')) {
            return $this->get('urlparam');
        }

        $objAttribute = $this->getMetaModel()->getAttributeById((int) $this->get('attr_id'));
        if ($objAttribute) {
            return $objAttribute->getColName();
        }

        return null;
    }

    /**
     * Add param filter to global list.
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     * @SuppressWarnings(PHPMD.CamelCaseVariableName)
     */
    protected function registerFilterParameter()
    {
        $GLOBALS['MM_FILTER_PARAMS'][] = $this->getParamName();
    }


    /**
     * Prepare the widget label.
     *
     * @param IAttribute $objAttribute The metamodel attribute.
     *
     * @return array
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     * @SuppressWarnings(PHPMD.CamelCaseVariableName)
     */
    protected function prepareWidgetLabel($objAttribute)
    {
        $parameterName = $this->getParamName();
        assert(\is_string($parameterName));

        $arrLabel = [
            $this->get('label') ?: $objAttribute->getName(),
            'GET: ' . $parameterName
        ];

        $fromField = (bool) $this->get('fromfield');
        $toField   = (bool) $this->get('tofield');

        if ($fromField && $toField) {
            $arrLabel[0] .= ' ' . $GLOBALS['TL_LANG']['metamodels_frontendfilter']['range_fromto'];
            return $arrLabel;
        }
        if (!$toField) {
            $arrLabel[0] .= ' ' . $GLOBALS['TL_LANG']['metamodels_frontendfilter']['range_from'];
            return $arrLabel;
        }

        $arrLabel[0] .= ' ' . $GLOBALS['TL_LANG']['metamodels_frontendfilter']['range_to'];

        return $arrLabel;
    }

    /**
     * Prepare options for the widget.
     *
     * @param list<string>|null $arrIds       List of ids.
     * @param IAttribute        $objAttribute The metamodel attribute.
     *
     * @return array
     */
    protected function prepareWidgetOptions($arrIds, $objAttribute)
    {
        $arrOptions = $objAttribute->getFilterOptions(
            ($this->get('onlypossible') ? $arrIds : null),
            (bool) $this->get('onlyused')
        );

        // Remove empty values from list.
        foreach ($arrOptions as $mixKeyOption => $mixOption) {
            // Remove html/php tags.
            $mixOption = \trim(\strip_tags($mixOption));

            if ('' === $mixOption) {
                unset($arrOptions[$mixKeyOption]);
            }
        }

        return $arrOptions;
    }

    /**
     * Prepare the widget Param and filter url.
     *
     * @param array $arrFilterUrl The filter url.
     *
     * @return array
     */
    protected function prepareWidgetParamAndFilterUrl($arrFilterUrl)
    {
        // Split up our param so the widgets can use it again.
        $parameterName = $this->getParamName();
        assert(\is_string($parameterName));
        $privateFilterUrl = $arrFilterUrl;
        $parameterValue   = null;

        // If we have a value, we have to explode it by double underscore to have a valid value which the active checks
        // may cope with.
        if (\array_key_exists($parameterName, $arrFilterUrl) && !empty($arrFilterUrl[$parameterName])) {
            if (\is_array($arrFilterUrl[$parameterName])) {
                $parameterValue = $arrFilterUrl[$parameterName];
            } else {
                $parameterValue = \explode(',', $arrFilterUrl[$parameterName], 2);
            }

            if ($parameterValue && ($parameterValue[0] || $parameterValue[1])) {
                $privateFilterUrl[$parameterName] = $parameterValue;

                return [$privateFilterUrl, $parameterValue];
            }

            // No values given, clear the array.
            $parameterValue = null;

            return [$privateFilterUrl, $parameterValue];
        }

        return [$privateFilterUrl, $parameterValue];
    }

    /**
     * Get the parameter array for configuring the widget.
     *
     * @param IAttribute        $attribute    The attribute.
     * @param array             $currentValue The current value.
     * @param list<string>|null $ids          The list of ids.
     *
     * @return array
     */
    protected function getFilterWidgetParameters(IAttribute $attribute, $currentValue, $ids)
    {
        $cssID = StringUtil::deserialize($this->get('cssID'), true);

        return [
            'label'      => $this->prepareWidgetLabel($attribute),
            'inputType'  => 'multitext',
            'options'    => $this->prepareWidgetOptions($ids, $attribute),
            'timetype'   => $this->get('timetype'),
            'dateformat' => $this->get('dateformat'),
            'eval'       => [
                'multiple'    => true,
                'size'        => $this->get('fromfield') && $this->get('tofield') ? 2 : 1,
                'urlparam'    => $this->getParamName(),
                'template'    => $this->get('template'),
                'colname'     => $attribute->getColName(),
                'placeholder' => $this->get('placeholder'),
                'hide_label'  => $this->get('hide_label'),
                'cssID'       => !empty($cssID[0]) ? ' id="' . $cssID[0] . '"' : '',
                'class'       => !empty($cssID[1]) ? ' ' . $cssID[1] : '',
            ],
            // We need to implode to have it transported correctly in the frontend filter.
            'urlvalue'   => !empty($currentValue) ? implode(',', $currentValue) : ''
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @SuppressWarnings(PHPMD.LongVariable)
     */
    public function getParameterFilterWidgets(
        $arrIds,
        $arrFilterUrl,
        $arrJumpTo,
        FrontendFilterOptions $objFrontendFilterOptions
    ) {
        $objAttribute = $this->getMetaModel()->getAttributeById((int) $this->get('attr_id'));
        if (!$objAttribute) {
            return [];
        }

        [$privateFilterUrl, $currentValue] = $this->prepareWidgetParamAndFilterUrl($arrFilterUrl);

        $this->registerFilterParameter();

        $parameterName = $this->getParamName();
        assert(\is_string($parameterName));

        return [
            $parameterName => $this->prepareFrontendFilterWidget(
                $this->getFilterWidgetParameters($objAttribute, $currentValue, $arrIds),
                $privateFilterUrl,
                $arrJumpTo,
                $objFrontendFilterOptions
            )
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function prepareRules(IFilter $objFilter, $arrFilterUrl)
    {
        // Check if we can filter on anything.
        if (!$this->get('fromfield') && !$this->get('tofield')) {
            $objFilter->addFilterRule(new StaticIdList(null));

            return;
        }

        // Get the attributes.
        $attribute  = $this->getMetaModel()->getAttributeById((int) $this->get('attr_id'));
        $attribute2 = $this->getMetaModel()->getAttributeById((int) $this->get('attr_id2'));

        // Check if we have a valid value.
        if (!$attribute) {
            $objFilter->addFilterRule(new StaticIdList(null));

            return;
        }

        // Set the second attribute with the first one if the second one is empty.
        if (!$attribute2) {
            $attribute2 = $attribute;
        }

        $value = $this->getParameterValue($arrFilterUrl);

        // No filter values, get out.
        if (!\is_array($value) || [] === $value) {
            $objFilter->addFilterRule(new StaticIdList(null));

            return;
        }

        $filterOne = $this->getMetaModel()->getEmptyFilter();
        $filterTwo = $this->getMetaModel()->getEmptyFilter();
        $moreEqual = (bool) $this->get('moreequal');
        $lessEqual = (bool) $this->get('lessequal');

        /*
         * Get type of filtering.
         * DB: ---------15---------20----- The data of attribute 1 (=15) and 2 (=20)
         * we search with two values, e.g. ...
         * S1: -----------16-----18------- Both values must be in the range.
         * S2: ------13----------18------- The second value must be in the range.
         * S3: -----------16----------22-- The first value must be in the range.
         * S4: S1 OR S2 OR S3              The first or the second value must be in the range.
         * S5: ------13---------------22-- The range must be between the first and second value.
         */

        $filterType = $this->get('filterrange_type');

        switch ($filterType) {
            case 's1':
                $filterOne
                    ->addFilterRule(new LessThan($attribute, $this->formatValue($value[0]), $moreEqual))
                    ->addFilterRule(new GreaterThan($attribute2, $this->formatValue($value[0]), $lessEqual));

                $filterTwo
                    ->addFilterRule(new LessThan($attribute, $this->formatValue($value[1]), $moreEqual))
                    ->addFilterRule(new GreaterThan($attribute2, $this->formatValue($value[1]), $lessEqual));

                $upperMatches = $filterOne->getMatchingIds() ?? [];
                $lowerMatches = $filterTwo->getMatchingIds() ?? [];

                $result = \array_values(\array_unique(\array_intersect($upperMatches, $lowerMatches)));

                break;
            case 's2':
                $filterOne
                    ->addFilterRule(new GreaterThan($attribute2, $this->formatValue($value[0]), $lessEqual));

                $filterTwo
                    ->addFilterRule(new LessThan($attribute, $this->formatValue($value[1]), $moreEqual))
                    ->addFilterRule(new GreaterThan($attribute2, $this->formatValue($value[1]), $lessEqual));

                $upperMatches = $filterOne->getMatchingIds() ?? [];
                $lowerMatches = $filterTwo->getMatchingIds() ?? [];

                $result = \array_values(\array_unique(\array_intersect($upperMatches, $lowerMatches)));

                break;
            case 's3':
                $filterOne
                    ->addFilterRule(new LessThan($attribute, $this->formatValue($value[0]), $moreEqual))
                    ->addFilterRule(new GreaterThan($attribute2, $this->formatValue($value[0]), $lessEqual));

                $filterTwo
                    ->addFilterRule(new LessThan($attribute, $this->formatValue($value[1]), $moreEqual));

                $upperMatches = $filterOne->getMatchingIds() ?? [];
                $lowerMatches = $filterTwo->getMatchingIds() ?? [];

                $result = \array_values(\array_unique(\array_intersect($upperMatches, $lowerMatches)));

                break;
            case 's4':
            default:
                $filterOne
                    ->addFilterRule(new LessThan($attribute, $this->formatValue($value[0]), $moreEqual))
                    ->addFilterRule(new GreaterThan($attribute2, $this->formatValue($value[0]), $lessEqual));

                $filterTwo
                    ->addFilterRule(new LessThan($attribute, $this->formatValue($value[1]), $moreEqual))
                    ->addFilterRule(new GreaterThan($attribute2, $this->formatValue($value[1]), $lessEqual));

                $upperMatches = $filterOne->getMatchingIds() ?? [];
                $lowerMatches = $filterTwo->getMatchingIds() ?? [];

                $result = \array_values(\array_unique(\array_merge($upperMatches, $lowerMatches)));

                break;
            case 's5':
                $filterOne
                    ->addFilterRule(new GreaterThan($attribute, $this->formatValue($value[0]), $moreEqual))
                    ->addFilterRule(new GreaterThan($attribute2, $this->formatValue($value[0]), $lessEqual));

                $filterTwo
                    ->addFilterRule(new LessThan($attribute, $this->formatValue($value[1]), $moreEqual))
                    ->addFilterRule(new LessThan($attribute2, $this->formatValue($value[1]), $lessEqual));

                $upperMatches = $filterOne->getMatchingIds() ?? [];
                $lowerMatches = $filterTwo->getMatchingIds() ?? [];

                $result = \array_values(\array_unique(\array_intersect($upperMatches, $lowerMatches)));

                break;
        }

        $objFilter->addFilterRule(new StaticIdList($result));
    }
}
