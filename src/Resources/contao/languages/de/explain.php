<?php
/**
 * This file is part of MetaModels/filter_range.
 *
 * (c) 2012-2022 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * Translations are managed automatically using Transifex. To create a new translation
 * or to help to maintain an existing one, please register at transifex.com.
 *
 * Last-updated: 2022-11-20T13:47:29+01:00
 *
 * @copyright 2012-2022 The MetaModels team.
 * @license   https://github.com/MetaModels/filter_range/blob/master/LICENSE LGPL-3.0-or-later
 * @link      https://www.transifex.com/metamodels/public/
 * @link      https://www.transifex.com/signup/?join_project=metamodels
 */


$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions']['0']['0'] = 'Typ der Filterbereichs-Option';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions']['0']['1'] = 'Für den Filterbereich gibt es mehrere Optionen, wie der Vergleich zwischen den Eingrenzungswerten und den Filterwerten gehandhabt werden soll.<br />
Als Beispiel sind folgende Werte in der Datenbank:<br />
die Daten der Attribute 1 (=15) und 2 (=20) und ein Beispiel bei jeder Option, um einen Treffer zu finden.
<pre>DB: ---------15---------20-----</pre>
';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions']['1']['0'] = 'S1<br />Beide Werte müssen in dem Bereich sein.';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions']['1']['1'] = '<pre>S1: -----------16-----18-------</pre>';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions']['2']['0'] = 'S2<br />Der zweite Wert muss in dem Bereich sein.';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions']['2']['1'] = 'Der erste Wert muss kleiner als die rechte Grenze des Bereichs sein, kann aber auch kleiner als die linke Grenze sein - der zweite Wert muss innerhalb des Bereichs liegen.
<pre>S2: ------13----------18-------</pre>';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions']['3']['0'] = 'S3<br />Der erste Wert muss in dem Bereich sein.';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions']['3']['1'] = 'Der zweite Wert muss größer sein als die linke Grenze des Bereichs, kann aber auch größer sein als die rechte Grenze - der erste Wert muss innerhalb des Bereichs liegen.
<pre>S3: -----------16----------22--<pre>';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions']['4']['0'] = 'S4<br />Der erste oder der zweite Wert muss in dem Bereich sein.';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions']['4']['1'] = 'Mindestens ein Wert muss innerhalb des Bereichs liegen - dies ist eine Kombination der Optionen "S2" und "S3".
<pre>S2: ------13----------18-------</pre>
<pre>S3: -----------16----------22--<pre>';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions']['5']['0'] = 'S5<br />Der Bereich muss zwischen dem ersten und dem zweiten Wert liegen.';
$GLOBALS['TL_LANG']['XPL']['filterrangetypeOptions']['5']['1'] = 'Der erste Wert muss kleiner und der zweite Wert muss größer als der Bereich sein - dies ist die umgekehrte Option "S1".
<pre>S5: ------13---------------22--<pre>';

