<?php
/**
 * Mahara: Electronic portfolio, weblog, resume builder and social networking
 * Copyright (C) 2006-2009 Catalyst IT Ltd and others; see:
 *                         http://wiki.mahara.org/Contributors
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    mahara
 * @subpackage blocktype-plusone
 * @author     Emanuel Garcês
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 2011 Emanuel Garcês
 *
 */

defined('INTERNAL') || die();

class PluginBlocktypePlusone extends SystemBlocktype {

    public static function single_only() {
        return true;
    }

    public static function get_title() {
        return get_string('title', 'blocktype.plusone');
    }

    public static function get_description() {
        return get_string('description', 'blocktype.plusone');
    }

    public static function get_categories() {
        return array('general');
    }
    public static function render_instance(BlockInstance $instance, $editing=false) {
        $configdata = $instance->get('configdata');
        $size  = (!empty($configdata['size'])) ? hsc($configdata['size']) : 'standard';
        $count = (!empty($configdata['count'])) ? hsc($configdata['count']) : '0';
        $align  = (!empty($configdata['align'])) ? hsc($configdata['align']) : 'left';
        		
		if ($count=='1') {
			$counter='true';
		} else {
			$counter='false';
		}

		$page = (!strpos(get_script_path(), 'blocks.php') ? 'view' : 'edit');
		
        $smarty = smarty_core();
        $smarty->assign('lang', self::get_locale_code(get_config('lang')));
        $smarty->assign('size', $size);
        $smarty->assign('counter', $counter);
		$smarty->assign('align', $align);
        $smarty->assign('page', $page);

        return $smarty->fetch('blocktype:plusone:plusone.tpl');
    }

    public static function has_instance_config() {
        return true;
    }

    public static function instance_config_form($instance) {
        $configdata = $instance->get('configdata');

        return array(
            'showtitle' => array(
                'type'  => 'checkbox',
                'title' => get_string('showtitle','blocktype.plusone'),
                'defaultvalue' => (!empty($configdata['showtitle']) ? $configdata['showtitle'] : 0),
            ),
            'size' => array(
                'type' => 'radio',
                'title' => get_string('size','blocktype.plusone'),
				'description' => get_string('sizedesc','blocktype.plusone'),
                'defaultvalue' => (!empty($configdata['size'])) ? $configdata['size'] : 'standard',
				'options' => array(
					'small' => get_string('sizeesmall','blocktype.plusone'),
					'medium' => get_string('sizemedium','blocktype.plusone'),
					'standard' => get_string('sizestandard','blocktype.plusone'),
					'tall' => get_string('sizetall','blocktype.plusone'),
				),
				'separator' => '&nbsp;&nbsp;',
			),
			'count' => array(
                'type'  => 'checkbox',
                'title' => get_string('count','blocktype.plusone'),
                'defaultvalue' => (!empty($configdata['count']) ? $configdata['count'] : 0),
				'description' => get_string('countdesc','blocktype.plusone')
            ),
			'align' => array(
                'type' => 'radio',
                'title' => get_string('align','blocktype.plusone'),
                'defaultvalue' => (!empty($configdata['align'])) ? $configdata['align'] : 'left',
				'options' => array(
					'left' => get_string('alignleft','blocktype.plusone'),
					'center' => get_string('aligncenter','blocktype.plusone'),
					'right' => get_string('alignright','blocktype.plusone'),
				),
				'separator' => '&nbsp;&nbsp;&nbsp;',
			),
        );
    }

    public static function instance_config_save($values) {
        if (empty($values['showtitle'])) {
			$values['title'] = null;
		}
		return $values;
	}
	
    public static function get_locale_code($code) {
		switch ($code) {
			case 'pt.utf8': $locale = 'pt-PT'; break;
			case 'ca.utf8': $locale = 'es-CA'; break;
			case 'cs.utf8': $locale = 'cs-CZ'; break;
			case 'da.utf8': $locale = 'da-DK'; break;
			case 'de.utf8': $locale = 'de-DE'; break;
			case 'en.utf8': $locale = 'en-GB'; break;
			case 'es.utf8': $locale = 'es-ES'; break;
			case 'fr.utf8': $locale = 'fr-FR'; break;
			case 'it.utf8': $locale = 'it-IT'; break;
			case 'jp.utf8': $locale = 'jp-JA'; break;
			case 'hu.utf8': $locale = 'hu-HU'; break;
			case 'sl.utf8': $locale = 'sl-SI'; break;
			default: $locale = 'en-US'; break;
		}
		return $locale;
	}
	
    public static function default_copy_type() {
        return 'full';
    }

}

?>
