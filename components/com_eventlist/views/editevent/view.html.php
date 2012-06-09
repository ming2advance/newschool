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
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the EditeventView
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListViewEditevent extends JView
{
	/**
	 * Creates the output for event submissions
	 *
	 * @since 0.4
	 *
	 */
	function display( $tpl=null )
	{
		global $app;

		//only registered user can add events
		$user   = & JFactory::getUser();
		if (!$user->id) {
			$app->redirect(JRoute::_('index.php?option=com_users&view=login'), JText::_('Please login to be able to submit events') );
		}
    
		if($this->getLayout() == 'choosevenue') {
			$this->_displaychoosevenue($tpl);
			return;
		}

		// Initialize variables
		$editor 	= & JFactory::getEditor();
		$doc 		= & JFactory::getDocument();
		$elsettings = & ELHelper::config();
		
		//Get Data from the model
		$row 		= $this->Get('Event');
		$categories	= $this->Get('Categories');

		//Get requests
		$id					= JRequest::getInt('id');

		//Clean output
		JFilterOutput::objectHTMLSafe( $row, ENT_QUOTES, 'datdescription' );

		JHTML::_('behavior.formvalidation');
		JHTML::_('behavior.tooltip');
		JHTML::_('behavior.modal', 'a.modal');

		//add css file
		$doc->addStyleSheet($this->baseurl.'/components/com_eventlist/assets/css/eventlist.css');
		$doc->addCustomTag('<!--[if IE]><style type="text/css">.floattext{zoom:1;}, * html #eventlist dd { height: 1%; }</style><![endif]-->');

		//Set page title
		$id ? $title = JText::_( 'COM_EVENTLIST_EDIT_EVENT' ) : $title = JText::_( 'COM_EVENTLIST_ADD_EVENT' );

		$doc->setTitle($title);

		// Get the menu object of the active menu item
		$menu		= & JSite::getMenu();
		$item    	= $menu->getActive();
		$params 	= & $app->getParams('com_eventlist');

		//pathway
		$pathway 	= & $app->getPathWay();
		if (!$item){
            $pathway->setItemName(1, 'Event');
        }
        else{
            $pathway->setItemName(1, $item->title);
        }
		$pathway->addItem($title, '');

		//Has the user access to the editor and the add venue screen
		$editoruser = ELUser::editoruser();
		$delloclink = ELUser::validate_user( $elsettings->locdelrec, $elsettings->deliverlocsyes );
		
		//transform <br /> and <br> back to \r\n for non editorusers
		if (!$editoruser) {
			$row->datdescription = ELHelper::br2break($row->datdescription);
		}

		//Get image information
		$dimage = ELImage::flyercreator($row->datimage, 'event');

		//Set the info image
		$infoimage = JHTML::_('image', 'components/com_eventlist/assets/images/icon-16-hint.png', JText::_( 'COM_EVENTLIST_NOTES' ) );

		//Create the stuff required for the venueselect functionality
		$url	= $app->isAdmin() ? $app->getSiteURL() : JURI::base();

		$js = "
		function elSelectVenue(id, venue) {
			document.getElementById('a_id').value = id;
			document.getElementById('a_name').value = venue;
			var btn = window.parent.document.getElementById('sbox-btn-close');
            btn.fireEvent('click');
		}";

		$doc->addScriptDeclaration($js);
		// include the recurrence script
		$doc->addScript($url.'components/com_eventlist/assets/js/recurrence.js');
		// include the unlimited script
		$doc->addScript($url.'components/com_eventlist/assets/js/unlimited.js');

		$this->assignRef('row' , 					$row);
		$this->assignRef('categories' , 			$categories);
		$this->assignRef('editor' , 				$editor);
		$this->assignRef('dimage' , 				$dimage);
		$this->assignRef('infoimage' , 				$infoimage);
		$this->assignRef('delloclink' , 			$delloclink);
		$this->assignRef('editoruser' , 			$editoruser);
		$this->assignRef('elsettings' , 			$elsettings);
		$this->assignRef('item' , 					$item);
		$this->assignRef('params' , 				$params);

		parent::display($tpl);

	}

	/**
	 * Creates the output for the venue select listing
	 *
	 * @since 0.9
	 *
	 */
	function _displaychoosevenue($tpl)
	{
		global $app;

		$document	= & JFactory::getDocument();
		$params 	= & $app->getParams();

		$limitstart			= JRequest::getVar('limitstart', 0, '', 'int');
		$limit				= $app->getUserStateFromRequest('com_eventlist.selectvenue.limit', 'limit', $params->def('display_num', 0), 'int');
		$filter_order		= JRequest::getCmd('filter_order', 'l.venue');
		$filter_order_Dir	= JRequest::getWord('filter_order_Dir', 'ASC');;
		$filter				= JRequest::getString('filter');
		$filter_type		= JRequest::getInt('filter_type');

		// Get/Create the model
		$rows 	= $this->get('Venues');
		$total 	= $this->get('Countitems');
		
		JHTML::_('behavior.modal', 'a.modal');

		// Create the pagination object
		jimport('joomla.html.pagination');
		$pageNav = new JPagination($total, $limitstart, $limit);

		// table ordering
		$lists['order_Dir'] 	= $filter_order_Dir;
		$lists['order'] 		= $filter_order;

		$document->setTitle(JText::_( 'COM_EVENTLIST_SELECTVENUE' ));
		$document->addStyleSheet($this->baseurl.'/components/com_eventlist/assets/css/eventlist.css');

		$filters = array();
		$filters[] = JHTML::_('select.option', '1', JText::_( 'COM_EVENTLIST_VENUE' ) );
		$filters[] = JHTML::_('select.option', '2', JText::_( 'COM_EVENTLIST_CITY' ) );
		$searchfilter = JHTML::_('select.genericlist', $filters, 'filter_type', 'size="1" class="inputbox"', 'value', 'text', $filter_type );

		$this->assignRef('rows' , 				$rows);
		$this->assignRef('searchfilter' , 		$searchfilter);
		$this->assignRef('pageNav' , 			$pageNav);
		$this->assignRef('lists' , 				$lists);
		$this->assignRef('filter' , 			$filter);


		parent::display($tpl);
	}
}
?>