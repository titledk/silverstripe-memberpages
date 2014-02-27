<?php
/**
 * Members Only Page
 * The parent for all pages that are only displayed to logged in members
 *
 */
class MembersOnlyPage extends Page {

	private static $icon = "framework/admin/images/menu-icons/16x16/community.png";
	//singular and plural names are uncommented as they would
	//force those names on any pages inheriting this - if they don't have them defined
	//static $singular_name = 'Members Only Page';
	//static $plural_name = 'Members Only Pages';
	static $description = 'A page that is only displayed to logged in members';


	private static $extensions = array(
		'MembersOnlyPageExtension'
	);

	//if only certain groups should be allowed,
	//their group codes should be added here in extending classes
	public $dictatedViewerGroups = array();

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		return $fields;
	}


}

class MembersOnlyPage_Controller extends Page_Controller {

	public function init() {
		parent::init();
	}

}

