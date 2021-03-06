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

defined('_JEXEC') or die('Restricted access');

// Load tooltips behavior
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.switcher');
JHtml::_('behavior.tooltip');

// Load submenu template, using element id 'submenu' as needed by behavior.switcher
$this->document->setBuffer($this->loadTemplate('navigation'), 'modules', 'submenu');
?>

<form action="index.php" method="post" name="adminForm">

    	<div id="config-document">
			<div id="page-basic" class="tab">
				<?php echo $this->loadTemplate('basic'); ?>
			</div>

			<div id="page-usercontrol" class="tab">
				<?php echo $this->loadTemplate('usercontrol'); ?>
			</div>

			<div id="page-details" class="tab">
				<?php echo $this->loadTemplate('detailspage'); ?>
			</div>

            <div id="page-layout" class="tab">
				<?php echo $this->loadTemplate('layout'); ?>
			</div>

            <div id="page-parameters" class="tab">
               <?php echo $this->loadTemplate('parameters'); ?>
            </div>

		</div>
		<div class="clr"></div>

		<?php echo JHTML::_( 'form.token' ); ?>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="id" value="1">
		<input type="hidden" name="lastupdate" value="<?php echo $this->elsettings->lastupdate; ?>">
		<input type="hidden" name="option" value="com_eventlist">
		<input type="hidden" name="controller" value="settings">
		</form>

		<p class="copyright">
			<?php echo ELAdmin::footer( ); ?>
		</p>