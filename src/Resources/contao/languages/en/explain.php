<?php

/**
 * * This file is part of MetaModels/filter_range.
 *
 * (c) 2015-2021 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    MetaModels
 * @subpackage FilterRangeBundle
 * @author     Ingolf Steinhardt <info@e-spin.de>
 * @copyright  2015-2021 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_range/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

/* Type filter options */
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions'][0][0] = 'Type of filter range options';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions'][0][1] =
    'The filter range has several options on how to handle the comparison between the containment values and the filter values.<br />
As an example, the following values in the database:<br />
the data of attribute 1 (=15) and 2 (=20) and an example at every option to find an hit.
<pre>DB: ---------15---------20-----</pre>
';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions'][1][0] = 'S1<br />Both values must be in the range.';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions'][1][1] = '<pre>S1: -----------16-----18-------</pre>';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions'][2][0] = 'S2<br />The second value must be in the range.';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions'][2][1] =
    'The first value must be smaller than the right limit of the range, but can also be smaller than the left limit - the second value must be in the range.
<pre>S2: ------13----------18-------</pre>';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions'][3][0] = 'S3<br />The first value must be in the range.';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions'][3][1] =
    'The second value must be greater than the left limit of the range, but can also be greater than the right limit - the first value must be in the range.
<pre>S3: -----------16----------22--<pre>';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions'][4][0] =
    'S4<br />The first or the second value must be in the range.';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions'][4][1] =
    'At least one value must be within the range - this is a combination of option "S2" and "S3".
<pre>S2: ------13----------18-------</pre>
<pre>S3: -----------16----------22--<pre>';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions'][5][0] =
    'S5<br />The range must be between the first and second value.';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions'][5][1] =
    'The first value must be smaller and the second value must be larger than the range - this is option "S1" inverted.
<pre>S5: ------13---------------22--<pre>';
