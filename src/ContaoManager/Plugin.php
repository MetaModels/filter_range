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
 * @author     Richard Henkenjohann <richardhenkenjohann@googlemail.com>
 * @copyright  2015-2018 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_range/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

namespace MetaModels\FilterRangeBundle\ContaoManager;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Config\ConfigInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use MetaModels\CoreBundle\MetaModelsCoreBundle;
use MetaModels\FilterFromToBundle\MetaModelsFilterRangeBundle;


/**
 * Plugin for the Contao Manager.
 */
class Plugin implements BundlePluginInterface
{

    /**
     * Gets a list of autoload configurations for this bundle.
     *
     * @param ParserInterface $parser
     *
     * @return ConfigInterface[]
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(MetaModelsFilterRangeBundle::class)
                ->setLoadAfter(
                    [
                        MetaModelsCoreBundle::class
                    ]
                )
                ->setReplace(['metamodelsfilter_range'])
        ];
    }
}
