<?php
class MembersOnlyPageExtension extends SiteTreeExtension {

	public function updateCMSFields(FieldList $fields) {
	}

	public function updateSettingsFields(FieldList $fields) {
		//removing view settings
		$fields->removeByName("CanViewType");
		$fields->removeByName("ViewerGroups");

		//adding view settings displaying the custom hard coded view settings
		$groups = $this->owner->DictatedViewerGroups();
		$groupsStr = '';
		if ($groups) {
			foreach ($groups as $g) {
				$groupsStr .= "$g->Title, ";
			}
			$groupsStr = rtrim($groupsStr, ', ');
		} else {
			$groupsStr =_t('SiteTree.ACCESSLOGGEDIN', "Logged-in users");
		}
		$fields->addFieldToTab('Root',
			LiteralField::create('CanViewTypeExpl', '
<div class="field fieldgroup fieldgroup">
	<label class="left">' .
				_t('SiteTree.ACCESSHEADER', "Who can view this page?") .
				'</label>
	<div class="middleColumn fieldgroup ">
		<p>
			<em>'
			 . $groupsStr .
			'</em>
		</p>

	</div>
</div>
			'),
			'CanEditType');

	}


	/**
	 * This page can only be seen by logged in users
	 * This feature could be enhanced (e.g. only allowing for certain groups)
	 * by subclassing this page
	 * @param Member
	 * @return boolean
	 */
	public function canView($member = null) {
		$o = $this->owner;

		//strangely it seems that the member is passed as int sometimes?
		//these lines should fix that
		if (is_int($member)) {
			$member = Member::get()
				->filter('ID', $member)
				->first();
		}

		if (!$member) {
			$member = Member::currentUser();
		}
		if ($member) {
			if ($groups = $o->DictatedViewerGroups()) {
				//if specific viewer groups have been defined, we'll
				//only give access to thos groups
				return $member->inGroups($groups);
			} else {
				//if no specific viewer groups ahve been defined,
				//we'll give access to all logged in users
				return true;
			}


		} else {
			return false;
		}
	}

	/**
	 * Dictated Viewer Groups
	 * If any viewer groups have been dictated via public $dictatedViewerGroups = array()
	 * on the object, those viewer groups are returned here
	 * Else nothing is returned
	 */
	public function DictatedViewerGroups(){
		$gArr = $this->owner->dictatedViewerGroups;
		if (is_array($gArr) && (!empty($gArr))) {
			$groups = Group::get()
				->filter('Code', $gArr);
			return $groups;
		}
	}

}