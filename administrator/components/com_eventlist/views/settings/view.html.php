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
 * View class for the EventList Settings screen
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListViewSettings extends JView {
    
	function display($tpl = null) {

		global $app;

		//initialise variables
		$document 	= & JFactory::getDocument();
		$acl		= & JFactory::getACL();
		$uri 		= & JFactory::getURI();
		$user 		= & JFactory::getUser();

		//get data from model
		$model		= & $this->getModel();
		$elsettings = & $this->get( 'Data');

		//only admins have access to this view
		if (!JFactory::getUser()->authorise('core.manage')) {
			JError::raiseWarning( 'SOME_ERROR_CODE', JText::_( 'ALERTNOTAUTH'));
			$app->redirect( 'index.php?option=com_eventlist&view=eventlist' );
		}

		// fail if checked out not by 'me'
		if ($model->isCheckedOut( $user->get('id') )) {
			JError::raiseWarning( 'SOME_ERROR_CODE', JText::_( 'COM_EVENTLIST_EDITED_BY_ANOTHER_ADMIN' ));
			$app->redirect( 'index.php?option=com_eventlist&view=eventlist' );
		}

		JHTML::_('behavior.tooltip');
		JHTML::_('behavior.switcher');
		
	
		//add css, js and submenu to document
		$document->addScript( JURI::base().'components/com_eventlist/assets/js/settings.js' );
		$document->addStyleSheet('components/com_eventlist/assets/css/eventlistbackend.css');

		//create the toolbar
		JToolBarHelper::title( JText::_( 'COM_EVENTLIST_SETTINGS' ), 'settings' );
		JToolBarHelper::apply();
		JToolBarHelper::spacer();
		JToolBarHelper::save('save');
		JToolBarHelper::spacer();
		JToolBarHelper::cancel();
		JToolBarHelper::spacer();
		JToolBarHelper::help( 'el.settings', true );

		$accessLists = array();

 	  	//Create custom group levels to include into the public group selectList
 	  	$access   = array();
 	  	$access[] = JHTML::_('select.option', -2, '- disabled, only Admins -' );
 	  	//$access[] = JHTML::_('select.option', 0 , '- Everybody -' );
 	  	$access[] = JHTML::_('select.option', -1, '- All Registered Users -' );
 	  	//$pub_groups = array_merge( $pub_groups, $acl->get_group_children_tree( null, 'Registered', true ) );
		//$access = array_merge( $access, $acl->get_group_children_tree( null, 'USERS', false ) );

		//Create the access control list
		$accessLists['evdel_access']	= JHTML::_('select.genericlist', $access, 'delivereventsyes', 'class="inputbox" size="4"', 'value', 'text', $elsettings->delivereventsyes );
		$accessLists['locdel_access']	= JHTML::_('select.genericlist', $access, 'deliverlocsyes', 'class="inputbox" size="4"', 'value', 'text', $elsettings->deliverlocsyes );
		$accessLists['evpub_access']	= JHTML::_('select.genericlist', $access, 'autopubl', 'class="inputbox" size="4"', 'value', 'text', $elsettings->autopubl );
		$accessLists['locpub_access']	= JHTML::_('select.genericlist', $access, 'autopublocate', 'class="inputbox" size="4"', 'value', 'text', $elsettings->autopublocate );
		$accessLists['ev_edit']			= JHTML::_('select.genericlist', $access, 'eventedit', 'class="inputbox" size="4"', 'value', 'text', $elsettings->eventedit );
		$accessLists['venue_edit']		= JHTML::_('select.genericlist', $access, 'venueedit', 'class="inputbox" size="4"', 'value', 'text', $elsettings->venueedit );

		//Get global parameters
		$table =& JTable::getInstance('extension');
        $db = &$table->getDBO();
        $query = 'SELECT extension_id' .
                        ' FROM #__extensions' .
                        ' WHERE ' . $db->nameQuote( 'element' ) . '=' . $db->Quote( 'com_eventlist' ) ;
        $db->setQuery( $query, 0, 1 );
        $id = $db->loadResult();
		if ($id == !null)
        {
		$table->load($id);
		$globalparams = new JParameter( $table->params, JPATH_ADMINISTRATOR.DS.'components'.DS.'com_eventlist'.DS.'config.xml' );
		} else
        {
        JError::raiseWarning( 'SOME_ERROR_CODE', JText::_( 'SETTINGS NOT LOADED' ));
        }

		//assign data to template
		$this->assignRef('accessLists'	, $accessLists);
		$this->assignRef('elsettings'	, $elsettings);
		$this->assignRef('WarningIcon'	, $this->WarningIcon());
		$this->assignRef('request_url'	, $uri->toString());
		$this->assignRef('globalparams'	, $globalparams);

		parent::display($tpl);

	}

	function WarningIcon()
	{
		global $app;

		$url = JURI::root();
		$tip = '<img src="'.$url.'media/system/images/tooltip.png" border="0"  alt="" />';

		return $tip;
	}
}