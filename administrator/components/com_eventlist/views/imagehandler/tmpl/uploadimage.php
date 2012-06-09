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
?>

<form method="post" action="<?php echo $this->request_url; ?>" enctype="multipart/form-data" name="adminForm">

<table class="noshow">
  	<tr>
		<td width="50%" valign="top">
		
				<?php if($this->ftp): ?>
				<fieldset class="adminform">
					<legend><?php echo JText::_('COM_EVENTLIST_FTP_TITLE'); ?></legend>

					<?php echo JText::_('COM_EVENTLIST_FTP_DESC'); ?>
					
					<?php if(JError::isError($this->ftp)): ?>
						<p><?php echo JText::_($this->ftp->message); ?></p>
					<?php endif; ?>

					<table class="adminform nospace">
						<tbody>
							<tr>
								<td width="120">
									<label for="username"><?php echo JText::_('COM_EVENTLIST_USERNAME'); ?>:</label>
								</td>
								<td>
									<input type="text" id="username" name="username" class="input_box" size="70" value="" />
								</td>
							</tr>
							<tr>
								<td width="120">
									<label for="password"><?php echo JText::_('COM_EVENTLIST_PASSWORD'); ?>:</label>
								</td>
								<td>
									<input type="password" id="password" name="password" class="input_box" size="70" value="" />
								</td>
							</tr>
						</tbody>
					</table>
				</fieldset>
			<?php endif; ?>

			<fieldset class="adminform">
			<legend><?php echo JText::_( 'COM_EVENTLIST_SELECT_IMAGE_UPLOAD' ); ?></legend>
			<table class="admintable" cellspacing="1">
				<tbody>
					<tr>
	          			<td>
 							<input class="inputbox" name="userfile" id="userfile" type="file" />
							<br /><br />
							<input class="button" type="submit" value="<?php echo JText::_('UPLOAD') ?>" name="adminForm" />
    			       	</td>
      				</tr>
				</tbody>
			</table>
			</fieldset>

		</td>
        <td width="50%" valign="top">

			<fieldset class="adminform">
			<legend><?php echo JText::_( 'COM_EVENTLIST_ATTENTION' ); ?></legend>
			<table class="admintable" cellspacing="1">
				<tbody>
					<tr>
	          			<td>
 							<b><?php
 							echo JText::_( 'COM_EVENTLIST_TARGET_DIRECTORY' ).':'; ?></b>
							<?php
							if ($this->task == 'venueimg') {
								echo "/images/eventlist/venues/";
								$this->task = 'venueimgup';
							} else {
								echo "/images/eventlist/events/";
								$this->task = 'eventimgup';
							}

							?><br />
							<b><?php echo JText::_( 'COM_EVENTLIST_IMAGE_FILESIZE' ).':'; ?></b> <?php echo $this->elsettings->sizelimit; ?> kb<br />

							<?php
							if ( $this->elsettings->gddisabled ) {

								if (imagetypes() & IMG_PNG) {
									echo "<br /><font color='green'>".JText::_( 'COM_EVENTLIST_PNG_SUPPORT' )."</font>";
								} else {
									echo "<br /><font color='red'>".JText::_( 'COM_EVENTLIST_NO_PNG_SUPPORT' )."</font>";
								}
								if (imagetypes() & IMG_JPEG) {
									echo "<br /><font color='green'>".JText::_( 'COM_EVENTLIST_JPG_SUPPORT' )."</font>";
								} else {
									echo "<br /><font color='red'>".JText::_( 'COM_EVENTLIST_NO_JPG_SUPPORT' )."</font>";
								}
								if (imagetypes() & IMG_GIF) {
									echo "<br /><font color='green'>".JText::_( 'COM_EVENTLIST_GIF_SUPPORT' )."</font>";
								} else {
									echo "<br /><font color='red'>".JText::_( 'COM_EVENTLIST_NO_GIF_SUPPORT' )."</font>";
								}
							} else {
								echo "<br /><font color='green'>".JText::_( 'COM_EVENTLIST_PNG_SUPPORT' )."</font>";
								echo "<br /><font color='green'>".JText::_( 'COM_EVENTLIST_JPG_SUPPORT' )."</font>";
								echo "<br /><font color='green'>".JText::_( 'COM_EVENTLIST_GIF_SUPPORT' )."</font>";
							}
							?>
    			       	</td>
      				</tr>
				</tbody>
			</table>
			</fieldset>

		</td>
	</tr>
</table>

<?php if ( $this->elsettings->gddisabled ) { ?>

<table class="noshow">
	<tr>
		<td>

			<fieldset class="adminform">
			<legend><?php echo JText::_( 'COM_EVENTLIST_ATTENTION' ); ?></legend>
			<table class="admintable" cellspacing="1">
				<tbody>
					<tr>
	          			<td align="center">
							<?php echo JText::_( 'COM_EVENTLIST_GD_WARNING' ); ?>
    			     	 </td>
      				</tr>
				</tbody>
			</table>
			</fieldset>

		</td>
	</tr>
</table>

<?php } ?>

<?php echo JHTML::_( 'form.token' ); ?>
<input type="hidden" name="option" value="com_eventlist" />
<input type="hidden" name="controller" value="imagehandler" />
<input type="hidden" name="task" value="<?php echo $this->task;?>" />
</form>

<p class="copyright">
	<?php echo ELAdmin::footer( ); ?>
</p>