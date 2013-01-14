<?php
/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 * @package    MetaModels
 * @subpackage FrontendFilter
 * @author     Christian de la Haye <service@delahaye.de>
 * @copyright  The MetaModels team.
 * @license    LGPL.
 * @filesource
 */
if (!defined('TL_ROOT'))
{
	die('You cannot access this file directly!');
}


/**
 * Filter "value in range of 2 fields" for FE-filtering, based on filters by the meta models team.
 *
 * @package	   MetaModels
 * @subpackage FrontendFilter
 * @author     Christian de la Haye <service@delahaye.de>
 */
class MetaModelFilterSettingRange extends MetaModelFilterSetting
{
	/**
	 * {@inheritdoc}
	 */
	protected function getParamName()
	{
		if ($this->get('urlparam'))
		{
			return $this->get('urlparam');
		}

		$objAttribute = $this->getMetaModel()->getAttributeById($this->get('attr_id'));
		if ($objAttribute)
		{
			return $objAttribute->getColName();
		}
	}


	/**
	 * {@inheritdoc}
	 */
	public function prepareRules(IMetaModelFilter $objFilter, $arrFilterUrl)
	{
		$objMetaModel = $this->getMetaModel();
		$objAttribute = $objMetaModel->getAttributeById($this->get('attr_id'));
		$objAttribute2 = $objMetaModel->getAttributeById($this->get('attr_id2'));

		$strParamName = $this->getParamName();
		$strParamValue = $arrFilterUrl[$strParamName];
		$strMore = $this->get('moreequal') ? '>=' : '>';
		$strLess = $this->get('lessequal') ? '<=' : '<';

		if ($objAttribute && $objAttribute2 && $strParamName && $strParamValue)
		{
			$objQuery = Database::getInstance()->prepare(sprintf(
				'SELECT id FROM %s WHERE (?%s%s AND ?%s%s)',
				$this->getMetaModel()->getTableName(),
				$strLess,
				$objAttribute2->getColName(),
				$strMore,
				$objAttribute->getColName()
				))
				->execute($strParamValue, $strParamValue);

			$arrIds = $objQuery->fetchEach('id');

			$objFilter->addFilterRule(new MetaModelFilterRuleStaticIdList($arrIds));
			return;
		}

		$objFilter->addFilterRule(new MetaModelFilterRuleStaticIdList(NULL));
	}


	/**
	 * {@inheritdoc}
	 */
	public function getParameters()
	{
		return ($strParamName = $this->getParamName()) ? array($strParamName) : array();
	}


	/**
	 * {@inheritdoc}
	 */
	public function getParameterDCA()
	{
		$objAttribute = $this->getMetaModel()->getAttributeById($this->get('attr_id'));

		$objAttribute2 = $this->getMetaModel()->getAttributeById($this->get('attr_id2'));

		$arrOptions = $objAttribute->getFilterOptions();

		$arrLabel = array(
			($this->get('label') ? $this->get('label') : $objAttribute->getName()),
			'GET: '.$this->get('urlparam')
		):

		return array(
			$this->getParamName() => array
			(
				'label'     => $arrLabel,
				'inputType' => 'text',
				'eval'      => array(
					'urlparam'     => $this->get('urlparam'),
					'template'     => $this->get('template')
					)
			)
		);
	}
}

?>