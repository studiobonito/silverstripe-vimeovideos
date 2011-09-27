<?php

/**
 * This is a DataObject that contains all the relevant data for embedding a Vimeo video into a template.
 * It also contains the static method used to insert a shortcode into a HTMLContent field.
 *
 * @version		1.0
 * @license		Simplified BSD License
 * @author      Tom Densham <tom.densham at studiobonito.co.uk>
 * @copyright   Studio Bonito Ltd.
 */

/**
 * VimeoVideo Class
 */
class VimeoVideo extends DataObject {

	public static $singular_name = 'Vimeo Video';
	
	public static $plural_name = 'Vimeo Videos';
	
	public static $db = array(
		'VimeoID' => 'Varchar',
		'Autoplay' => 'Boolean',
		'Caption' => 'Text',
		'Height' => 'Int',
		'Width' => 'Int'
	);
	
	public static $defaults = array(
		'VimeoID' => '',
		'Autoplay' => false,
		'Height' => 320,
		'Width' => 480
	);

	public static $summary_fields = array(
		'VimeoID' => 'Vimeo ID',
		'Caption' => 'Caption'
	);
	
	public static $searchable_fields = array(
		'VimeoID' => array('title' => 'Vimeo ID')
	);
	
	public function forTemplate() {
		return $this->renderWith('Vimeo');
	}

	public function getCMSFieldsForPopup() {
		$fields = new FieldSet();

		$fields->push(new TextField('VimeoID', 'Vimeo ID (e.g. vimeo.com/<strong>29471008</strong>)'));
		$fields->push(new TextareaField('Caption'));
		$fields->push(new TextField('Height'));
		$fields->push(new TextField('Width'));
		$fields->push(new CheckboxField('Autoplay'));
		
		return $fields;
	}
	
	public function SetAutoplay($autoplay = true) {
		$this->Autoplay = $autoplay;
		return $this;
	}
	
	public function SetSize($width = 480, $height = 320) {
		$this->Height = $height;
		$this->Width = $width;
		return $this;
	}

	public static function VimeoShortCodeHandler($arguments, $caption= null, $parser = null) {
		if(empty($arguments['id'])) {
			return;
		}
			
		$customise = array();
		$customise['VimeoID'] = $arguments['id'];
		$customise['Autoplay'] = false;
		$customise['Caption'] = $caption ? Convert::raw2xml($caption) : false;
		$customise['Width'] = 480;
		$customise['Height'] = 320;
			
		$customise = array_merge($customise, $arguments);
			
		$template = new SSViewer(array(
			'Vimeo',
			BASE_PATH.'/vimeovideos/templates/Vimeo.ss'
		));
			
		return $template->process(new ArrayData($customise));
	}

}
