<?php

$plugin['name'] = 'yab_remember_categories';
$plugin['allow_html_help'] = 0;
$plugin['version'] = '0.2';
$plugin['author'] = 'Tommy Schmucker';
$plugin['author_uri'] = 'http://www.yablo.de/';
$plugin['description'] = 'Remembers the selected categories in write tab.';
$plugin['order'] = '5';
$plugin['type'] = '3';

if (!defined('PLUGIN_HAS_PREFS')) define('PLUGIN_HAS_PREFS', 0x0001);
if (!defined('PLUGIN_LIFECYCLE_NOTIFY')) define('PLUGIN_LIFECYCLE_NOTIFY', 0x0002);

$plugin['flags'] = '0';

if (!defined('txpinterface'))
{
	@include_once('zem_tpl.php');
}

# --- BEGIN PLUGIN CODE ---
/**
 * yab_remember_categories
 *
 * A Textpattern CMS plugin.
 * Remembers the selected categories in write tab
 *
 * @author Tommy Schmucker
 * @link   http://www.yablo.de/
 * @link   http://tommyschmucker.de/
 * @date   2014-02-06
 *
 * This plugin is released under the GNU General Public License Version 2 and above
 * Version 2: http://www.gnu.org/licenses/gpl-2.0.html
 * Version 3: http://www.gnu.org/licenses/gpl-3.0.html
 */

if (@txpinterface == 'admin')
{
	register_callback(
		'yab_remember_categories',
		'admin_side',
		'body_end'
	);
}

/**
 * Echo the plugin JavaScript on article write tab, when article is created.
 *
 * @return void Echos the JavaScript
 */
function yab_remember_categories()
{
	global $event, $step;

	$js        = <<<EOF
<script>
(function() {
	var cat1 = localStorage.getItem('category-1');
	var cat2 = localStorage.getItem('category-2');
	$('option[value="' + cat1 + '"]', '#category-1').prop('selected', true);
	$('option[value="' + cat2 + '"]', '#category-2').prop('selected', true);

	$('select', '#categories_group').change(function() {
		var val = $(this).val();
		localStorage.setItem(this.id, val);
	});
})();
</script>
EOF;

	if ($event == 'article' and $step == 'create')
	{
		echo $js;
	}
	return;
}
# --- END PLUGIN CODE ---
if (0) {
?>
<!--
# --- BEGIN PLUGIN HELP ---
h1. yab_remember_categories

p. Remembers the selected categories in write tab.
Does only work while creating articles not on editing existing articles.

p. *Version:* 0.2

h2. Table of contents

# "Plugin requirements":#help-section02
# "Configuration":#help-config03
# "Changelog":#help-section10
# "License":#help-section11
# "Author contact":#help-section12

h2(#help-section02). Plugin requirements

p. yab_remember_categories's  minimum requirements:

* Textpattern 4.x

h2(#help-config03). Configuration

Install and activate the plugin. The Plugin remembers the selected category 1 and category 2 in write tab while creating an article by saving with HTML5 localStorage.


h2(#help-section10). Changelog

* v0.1: 2014-02-04
** initial release
* v0.2: 2014-02-06
** bugfix: does now only work on while in article create step

h2(#help-section11). Licence

This plugin is released under the GNU General Public License Version 2 and above
* Version 2: "http://www.gnu.org/licenses/gpl-2.0.html":http://www.gnu.org/licenses/gpl-2.0.html
* Version 3: "http://www.gnu.org/licenses/gpl-3.0.html":http://www.gnu.org/licenses/gpl-3.0.html

h2(#help-section12). Author contact

* "Plugin on author's site":http://www.yablo.de/article/478/yab_remember_categories-remembers-the-selected-categories-in-write-tab
* "Plugin on GitHub":https://github.com/trenc/yab_remember_categories
* "Plugin on textpattern forum":http://forum.textpattern.com/viewtopic.php?pid=278664
* "Plugin on textpattern.org":http://textpattern.org/plugins/1288/yab_remember_categories
# --- END PLUGIN HELP ---
-->
<?php
}
?>