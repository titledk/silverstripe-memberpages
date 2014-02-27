# SilverStripe Memberpages

_Programmatically make your pages accessible only to members and/or cetain member groups_


This module helps you when working with page types that should be
restricted from members that have not been logged in, and/or restricted 
to a certain group.    
While that behavior can easily be achieved via the CMS, sometimes
you just want this to be the default, and not changeable by any users
of the CMS.    
This could especially be the case for sites with several languages, where
the Sitetree can easily get cluttered up, but also just to keep things streamlined
while working on a project with several developers, test servers etc.

Beyond that, we just sometimes like it better to define page permissions via code.

## Features

* Pages extending `MembersOnlyPage` are only accessible by members
* Modules like blogs, forums etc can be extended with the `MembersOnlyPageExtension`
* Per default a page is shown to all logged in members. You can change that default by
setting the `$dictatedViewerGroups` array in your page


## Usage

Either extend `MembersOnlyPage`, or (if that's not possible), use the `MembersOnlyPageExtension`.

In order to only allow certain groups, add the following to your page:

	public $dictatedViewerGroups = array(
		'allowedgroupcode1',
		'allowedgroupcode2'
	);




## Example

In the frontend you'll only notice that pages are only available to the members you define,
in the backend you'll notice that the section where you can change permissions is no longer
editable by the user, and instead looks something like this:

![memberpages admin example](https://raw.github.com/titledk/silverstripe-memberpages/master/docs/images/admin.png)


