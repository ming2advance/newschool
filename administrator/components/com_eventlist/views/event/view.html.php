<?php
/**
 * @version 1.0.2 Stable $Id$
 * @package Joomla
 * @subpackage EventList
 * @copyright (C) 2005 - 2009 Christoph Lukes
 * @license GNU/GPL, see LICENSE.php
 * EventList is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.

 * EventList is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with EventList; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * View class for the EventList event screen
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListViewEvent extends JView {

	function display($tpl = null)
	{
		global $app;

		if($this->getLayout() == 'addvenue') {
			$this->_displayaddvenue($tpl);
			return;
		}

		//Load behavior
		jimport('joomla.html.pane');
		JHTML::_('behavior.tooltip');

		//initialise variables
		$editor 	= & JFactory::getEditor();
		$document	= & JFactory::getDocument();
		$pane 		= & JPane::getInstance('sliders');
		$user 		= & JFactory::getUser();
		$elsettings = ELAdmin::config();

		//get vars
		$cid		= JRequest::getVar( 'cid' );
		$task		= JRequest::getVar('task');
		$url 		= JURI::root();

		//add the custom stylesheet and the seo javascript
		$document->addStyleSheet('components/com_eventlist/assets/css/eventlistbackend.css');
		$document->addScript($url.'administrator/components/com_eventlist/assets/js/seo.js');
		$document->addScript($url.'components/com_eventlist/assets/js/recurrence.js');
		// include the unlimited script
		$document->addScript($url.'components/com_eventlist/assets/js/unlimited.js');

		//build toolbar
		
		if ($task == 'copy') {
		  	JToolBarHelper::title( JText::_( 'COM_EVENTLIST_COPY_EVENT'), 'eventedit');		
		} elseif ( $cid ) {
			JToolBarHelper::title( JText::_( 'COM_EVENTLIST_EDIT_EVENT' ), 'eventedit' );
		} else {
			JToolBarHelper::title( JText::_( 'COM_EVENTLIST_ADD_EVENT' ), 'eventedit' );

			//set the submenu
			JSubMenuHelper::addEntry( JText::_( 'COM_EVENTLIST_EVENTLIST' ), 'index.php?option=com_eventlist');
			JSubMenuHelper::addEntry( JText::_( 'COM_EVENTLIST_EVENTS' ), 'index.php?option=com_eventlist&view=events');
			JSubMenuHelper::addEntry( JText::_( 'COM_EVENTLIST_VENUES' ), 'index.php?option=com_eventlist&view=venues');
			JSubMenuHelper::addEntry( JText::_( 'COM_EVENTLIST_CATEGORIES' ), 'index.php?option=com_eventlist&view=categories');
			JSubMenuHelper::addEntry( JText::_( 'COM_EVENTLIST_ARCHIVESCREEN' ), 'index.php?option=com_eventlist&view=archive');
			JSubMenuHelper::addEntry( JText::_( 'COM_EVENTLIST_GROUPS' ), 'index.php?option=com_eventlist&view=groups');
			JSubMenuHelper::addEntry( JText::_( 'COM_EVENTLIST_HELP' ), 'index.php?option=com_eventlist&view=help');
			if ($user->get('gid') > 24) {
				JSubMenuHelper::addEntry( JText::_( 'COM_EVENTLIST_SETTINGS' ), 'index.php?option=com_eventlist&controller=settings&task=edit');
			}
		}
		JToolBarHelper::apply();
		JToolBarHelper::spacer();
		JToolBarHelper::save();
		JToolBarHelper::spacer();
		JToolBarHelper::cancel();
		JToolBarHelper::spacer();
		JToolBarHelper::help( 'el.editevents', true );

		//get data from model
		$model		= & $this->getModel();
		$row     	= & $this->get( 'Data');

		// fail if checked out not by 'me'
		if ($row->id) {
			if ($model->isCheckedOut( $user->get('id') )) {
				JError::raiseWarning( 'SOME_ERROR_CODE', $row->titel.' '.JText::_( 'COM_EVENTLIST_EDITED_BY_ANOTHER_ADMIN' ));
				$app->redirect( 'index.php?option=com_eventlist&view=events' );
			}
		}

		//make data safe
		JFilterOutput::objectHTMLSafe( $row, ENT_QUOTES, 'datdescription' );

		//Create category list
		$categories = & $this->get( 'Categories');

		$catlist 	= array();
		$catlist[] 	= JHTML::_('select.option', '0', JText::_( 'COM_EVENTLIST_SELECT_CATEGORY' ) );
		$catlist 	= array_merge( $catlist, $categories );

		$Lists = array();
		$Lists['category'] = JHTML::_('select.genericlist', $catlist, 'catsid', 'size="1" class="inputbox"', 'value', 'text', $row->catsid );

		//build venue select js and load the view
		$js = "
		function elSelectVenue(id, venue) {
			document.getElementById('a_id').value = id;
			document.getElementById('a_name').value = venue;
			var btn = window.parent.document.getElementById('sbox-btn-close');
            btn.fireEvent('click');
		}";

		$linkvsel = 'index.php?option=com_eventlist&amp;view=venueelement&amp;tmpl=component';
		$linkvadd = 'index.php?option=com_eventlist&amp;task=addvenue&amp;tmpl=component';
		$document->addScriptDeclaration($js);

		JHTML::_('behavior.modal', 'a.modal');

		$venueselect = "\n<div style=\"float: left;\"><input style=\"background: #ffffff;\" type=\"text\" id=\"a_name\" value=\"$row->venue\" disabled=\"disabled\" /></div>";
		$venueselect .= "<div class=\"button2-left\"><div class=\"blank\"><a class=\"modal\" title=\"".JText::_('COM_EVENTLIST_SELECT')."\" href=\"$linkvsel\" rel=\"{handler: 'iframe', size: {x: 650, y: 375}}\">".JText::_('COM_EVENTLIST_SELECT')."</a></div></div>\n";
		$venueselect .= "\n<input type=\"hidden\" id=\"a_id\" name=\"locid\" value=\"$row->locid\" />";
		$venueselect .= "\n&nbsp;<input class=\"inputbox\" type=\"button\" onclick=\"window.open('$linkvadd', 'popup', 'width=750,height=400,scrollbars=yes,toolbar=no,status=no,resizable=yes,menubar=no,location=no,directories=no,top=10,left=10')\" value=\"".JText::_('ADD')."\" />";
		$venueselect .= "\n&nbsp;<input class=\"inputbox\" type=\"button\" onclick=\"elSelectVenue(0, '".JText::_('COM_EVENTLIST_NO_VENUE')."' );\" value=\"".JText::_('COM_EVENTLIST_NO_VENUE')."\" onblur=\"seo_switch()\" />";

		//build image select js and load the view
		$js = "
		function elSelectImage(image, imagename) {
			document.getElementById('a_image').value = image;
			document.getElementById('a_imagename').value = imagename;
			document.getElementById('imagelib').src = '../images/eventlist/events/' + image;
			var btn = window.parent.document.getElementById('sbox-btn-close');
            btn.fireEvent('click');
		}";

		$link = 'index.php?option=com_eventlist&amp;view=imagehandler&amp;layout=uploadimage&amp;task=eventimg&amp;tmpl=component';
		$link2 = 'index.php?option=com_eventlist&amp;view=imagehandler&amp;task=selecteventimg&amp;tmpl=component';
		$document->addScriptDeclaration($js);
		$imageselect = "\n<input style=\"background: #ffffff;\" type=\"text\" id=\"a_imagename\" value=\"$row->datimage\" disabled=\"disabled\" onchange=\"javascript:if (document.forms[0].a_imagename.value!='') {document.imagelib.src='../images/eventlist/events/' + document.forms[0].a_imagename.value} else {document.imagelib.src='../images/blank.png'}\"; /><br />";

		$imageselect .= "<div class=\"button2-left\"><div class=\"blank\"><a class=\"modal\" title=\"".JText::_('Upload')."\" href=\"$link\" rel=\"{handler: 'iframe', size: {x: 650, y: 375}}\">".JText::_('Upload')."</a></div></div>\n";
		$imageselect .= "<div class=\"button2-left\"><div class=\"blank\"><a class=\"modal\" title=\"".JText::_('COM_EVENTLIST_SELECTIMAGE')."\" href=\"$link2\" rel=\"{handler: 'iframe', size: {x: 650, y: 375}}\">".JText::_('COM_EVENTLIST_SELECTIMAGE')."</a></div></div>\n";

		$imageselect .= "\n&nbsp;<input class=\"inputbox\" type=\"button\" onclick=\"elSelectImage('', '".JText::_('COM_EVENTLIST_SELECTIMAGE')."' );\" value=\"".JText::_('Reset')."\" />";
		$imageselect .= "\n<input type=\"hidden\" id=\"a_image\" name=\"datimage\" value=\"$row->datimage\" />";

		//assign vars to the template
		$this->assignRef('Lists'      	, $Lists);
		$this->assignRef('row'      	, $row);
		$this->assignRef('imageselect'	, $imageselect);
		$this->assignRef('venueselect'	, $venueselect);
		$this->assignRef('editor'		, $editor);
		$this->assignRef('pane'			, $pane);
		$this->assignRef('task'			, $task);
		$this->assignRef('elsettings'	, $elsettings);

		parent::display($tpl);
	}

	/**
	 * Creates the output for the add venue screen
	 *
	 * @since 0.9
	 *
	 */
	function _displayaddvenue($tpl)
	{
		global $app;

		//initialise variables
		$editor 	= & JFactory::getEditor();
		$document	= & JFactory::getDocument();
		$uri 		= & JFactory::getURI();
		$elsettings = ELAdmin::config();

		//add css and js to document
		JHTML::_('behavior.modal', 'a.modal');
		JHTML::_('behavior.tooltip');

		//Build the image select functionality
		$js = "
		function elSelectImage(image, imagename) {
			document.getElementById('a_image').value = image;
			document.getElementById('a_imagename').value = imagename;
			var btn = window.parent.document.getElementById('sbox-btn-close');
            btn.fireEvent('click');
		}";

		$link = 'index.php?option=com_eventlist&amp;view=imagehandler&amp;layout=uploadimage&amp;task=venueimg&amp;tmpl=component';
		$link2 = 'index.php?option=com_eventlist&amp;view=imagehandler&amp;task=selectvenueimg&amp;tmpl=component';
		$document->addScriptDeclaration($js);
		$imageselect = "\n<input style=\"background: #ffffff;\" type=\"text\" id=\"a_imagename\" value=\"".JText::_('COM_EVENTLIST_SELECTIMAGE')."\" disabled=\"disabled\" onchange=\"javascript:if (document.forms[0].a_imagename.value!='') {document.imagelib.src='../images/eventlist/events/' + document.forms[0].a_imagename.value} else {document.imagelib.src='../images/blank.png'}\"; /><br />";

		$imageselect .= "<div class=\"button2-left\"><div class=\"blank\"><a class=\"modal\" title=\"".JText::_('Upload')."\" href=\"$link\" rel=\"{handler: 'iframe', size: {x: 650, y: 375}}\">".JText::_('Upload')."</a></div></div>\n";
		$imageselect .= "<div class=\"button2-left\"><div class=\"blank\"><a class=\"modal\" title=\"".JText::_('COM_EVENTLIST_SELECTIMAGE')."\" href=\"$link2\" rel=\"{handler: 'iframe', size: {x: 650, y: 375}}\">".JText::_('COM_EVENTLIST_SELECTIMAGE')."</a></div></div>\n";

		$imageselect .= "\n&nbsp;<input class=\"inputbox\" type=\"button\" onclick=\"elSelectImage('', '".JText::_('COM_EVENTLIST_SELECTIMAGE')."' );\" value=\"".JText::_('Reset')."\" />";
		$imageselect .= "\n<input type=\"hidden\" id=\"a_image\" name=\"locimage\" value=\"".JText::_('COM_EVENTLIST_SELECTIMAGE')."\" />";

		//set published
		$published = 1;

		//assign to template
		$this->assignRef('editor'      	, $editor);
		$this->assignRef('imageselect' 	, $imageselect);
		$this->assignRef('published' 	, $published);
		$this->assignRef('request_url'	, $uri->toString());
		$this->assignRef('elsettings'	, $elsettings);

		parent::display($tpl);
	}
}
?>