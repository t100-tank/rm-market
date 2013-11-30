<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormTextareaTinyMCE represents a Tiny MCE widget.
 *
 * You must include the Tiny MCE JavaScript file by yourself.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfWidgetFormTextareaTinyMCE.class.php 17192 2009-04-10 07:58:29Z fabien $
 */
class sfWidgetFormTextareaTinyMCE extends sfWidgetFormTextarea
{
  /**
   * Constructor.
   *
   * Available options:
   *
   *  * theme:  The Tiny MCE theme
   *  * width:  Width
   *  * height: Height
   *  * config: The javascript configuration
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    $this->addOption('theme', 'advanced');
    $this->addOption('width');
    $this->addOption('height');
    $this->addOption('config', '');
  }

  /**
   * @param  string $name        The element name
   * @param  string $value       The value selected in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $textarea = parent::render($name, $value, $attributes, $errors);
// extended_valid_elements : hr[class|width|size|noshade]",
    $js = sprintf(<<<EOF
<script type="text/javascript">
  tinyMCE.init({
	plugins : "advimage,advlink,media,contextmenu,table",
	theme_advanced_buttons1_add_before : "newdocument,separator",
	theme_advanced_buttons1_add : "fontselect,fontsizeselect",
	theme_advanced_buttons2_add : "separator,forecolor,backcolor,liststyle",
	theme_advanced_buttons2_add_before: "cut,copy,separator,",
	theme_advanced_buttons3_add_before : "",
	theme_advanced_buttons3_add : "media,tablecontrols",
	theme_advanced_toolbar_location : "top",
	extended_valid_elements : "div[id|class|title|style],hr[class|width|size|noshade],iframe[src|width|height|name|align|frameborder|scrolling|marginheight|marginwidth]",
	file_browser_callback : "ajaxfilemanager_%s",
	paste_use_dialog : false,
	theme_advanced_resizing : true,
	theme_advanced_resize_horizontal : true,
	apply_source_formatting : true,
	force_br_newlines : true,
	force_p_newlines : false,
	relative_urls : false,
        convert_urls : false,
        content_css : "/css/main.css,/css/bootstrap.min.css,/css/bootstrap-theme.min.css",
        language: 'ru',
    mode:                              "exact",
    elements:                          "%s",
    theme:                             "%s",
    %s
    %s
    theme_advanced_toolbar_location:   "top",
    theme_advanced_toolbar_align:      "left",
    theme_advanced_statusbar_location: "bottom",
    theme_advanced_resizing:           true
    %s
  });


	function ajaxfilemanager_%s(field_name, url, type, win) {
		var ajaxfilemanagerurl = "../../../../js/tinymce/plugins/ajaxfilemanager/ajaxfilemanager.php";
		switch (type) {
			case "image":
				break;
			case "media":
				break;
			case "flash":
				break;
			case "file":
				break;
			default:
				return false;
		}
		tinyMCE.activeEditor.windowManager.open({
			url: "../../../../js/tinymce/plugins/ajaxfilemanager/ajaxfilemanager.php",
			width: 782,
			height: 440,
			inline : "yes",
			close_previous : "no"
		},{
			window : win,
			input : field_name
		});
	}
</script>
EOF
    ,
      $this->generateId($name),
      $this->generateId($name),
      $this->getOption('theme'),
      $this->getOption('width')  ? sprintf('width:                             "%spx",', $this->getOption('width')) : '',
      $this->getOption('height') ? sprintf('height:                            "%spx",', $this->getOption('height')) : '',
      $this->getOption('config') ? ",\n".$this->getOption('config') : '',
      $this->generateId($name)
    );

    return $textarea.$js;
  }
}
