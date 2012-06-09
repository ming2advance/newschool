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
?>

<script language="javascript" type="text/javascript">
	function submitbutton(task)
	{
		var form = document.adminForm;

		if (form.venue.value == ""){
			alert( "<?php echo JText::_( 'COM_EVENTLIST_ADD_VENUE' ); ?>" );
			form.venue.focus();
		} else if (form.city.value == "" && form.map.value == "1"){
			alert( "<?php echo JText::_( 'COM_EVENTLIST_ADD_CITY' ); ?>" );
			form.city.focus();
		} else if (form.street.value == "" && form.map.value == "1"){
			alert( "<?php echo JText::_( 'COM_EVENTLIST_ADD_STREET' ); ?>" );
			form.street.focus();
		} else if (form.plz.value == "" && form.map.value == "1"){
			alert( "<?php echo JText::_( 'COM_EVENTLIST_ADD_ZIP' ); ?>" );
			form.plz.focus();
		} else if (form.country.value == "" && form.map.value == "1"){
			alert( "<?php echo JText::_( 'COM_EVENTLIST_ADD_COUNTRY' ); ?>" );
			form.country.focus();
		} else {
			<?php
			echo $this->editor->save( 'locdescription' );
			?>
			submitform( task );
			//window.parent.close();
		}
	}
</script>

<?php
//Set the info image
$infoimage = JHTML::image('components/com_eventlist/assets/images/icon-16-hint.png', JText::_( 'COM_EVENTLIST_NOTES' ) );
?>

<form action="<?php echo $this->request_url; ?>" method="post" name="adminForm" id="adminForm">


<table class="adminform" width="100%">
	<tr>
		<td>
			<div style="float: left;">
				<label for="venue">
					<?php echo JText::_( 'COM_EVENTLIST_VENUE' ).':'; ?>
				</label>
				<input name="venue" value="" size="55" maxlength="50" />
					&nbsp;&nbsp;&nbsp;
			</div>

			<div style="float: right;">
				<button type="button" onclick="submitbutton('addvenue')">
					<?php echo JText::_('COM_EVENTLIST_SAVE') ?>
				</button>
				<button type="button" onclick="window.parent.close()" />
					<?php echo JText::_('COM_EVENTLIST_CANCEL') ?>
				</button>
			</div>
		</td>
	</tr>
</table>

<br />

<fieldset>
<legend><?php echo JText::_('COM_EVENTLIST_VARIOUS'); ?></legend>
<table>
	<tr>
		<td>
			<label for="publish">
				<?php echo JText::_( 'COM_EVENTLIST_PUBLISHED' ).':'; ?>
			</label>
		</td>
		<td>
			<?php
			$html = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $this->published );
			echo $html;
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="locimage">
				<?php echo JText::_( 'COM_EVENTLIST_CHOOSE_IMAGE' ).':'; ?>
			</label>
		</td>
		<td>
			<?php echo $this->imageselect; ?>
		</td>
	</tr>
	<tr>
		<td>
		</td>
		<td>
				<img src="../media/system/images/blank.png" name="imagelib" id="imagelib" width="80" height="80" border="2" alt="Preview" />
				<script language="javascript" type="text/javascript">
				if (document.forms[0].a_imagename.value!=''){
					var imname = document.forms[0].a_imagename.value;
					jsimg='../images/eventlist/venues/' + imname;
					document.getElementById('imagelib').src= jsimg;
				}
				</script>
			<br />
			<br />
		</td>
	</tr>
</table>
</fieldset>

<fieldset>
	<legend><?php echo JText::_('COM_EVENTLIST_ADDRESS'); ?></legend>
	<table class="adminform" width="100%">
		<tr>
  			<td><?php echo JText::_( 'COM_EVENTLIST_STREET' ).':'; ?></td>
			<td><input name="street" value="" size="55" maxlength="50" /></td>
	 	</tr>
  		<tr>
  		  	<td><?php echo JText::_( 'COM_EVENTLIST_ZIP' ).':'; ?></td>
  		  	<td><input name="plz" value="" size="15" maxlength="10" /></td>
	  	</tr>
  		<tr>
  			<td><?php echo JText::_( 'COM_EVENTLIST_CITY' ).':'; ?></td>
  			<td><input name="city" value="" size="55" maxlength="50" />
			</td>
  		</tr>
  		<tr>
  			<td><?php echo JText::_( 'COM_EVENTLIST_STATE' ).':'; ?></td>
  			<td><input name="state" value="" size="55" maxlength="50" />
			</td>
  		</tr>
  		<tr>
  		  	<td><?php echo JText::_( 'COM_EVENTLIST_COUNTRY' ).':'; ?></td>
  		  	<td>
				<input name="country" value="" size="4" maxlength="3" />&nbsp;
				<span class="editlinktip hasTip" title="<?php echo JText::_('COM_EVENTLIST_NOTES'); ?>::<?php echo JText::_( 'COM_EVENTLIST_COUNTRY_HINT' ); ?>">
					<?php echo $infoimage; ?>
				</span>
			</td>
		</tr>
  		<tr>
    		<td><?php echo JText::_( 'COM_EVENTLIST_WEBSITE' ).':'; ?></td>
    		<td>
    			<input name="url" value="" size="55" maxlength="50" />&nbsp;
    			<span class="editlinktip hasTip" title="<?php echo JText::_('COM_EVENTLIST_NOTES'); ?>::<?php echo JText::_( 'COM_EVENTLIST_WEBSITE_HINT' ); ?>">
					<?php echo $infoimage; ?>
				</span>
    		</td>
  		</tr>
  		<?php if ( $this->elsettings->showmapserv != 0 ) { ?>
		<tr>
			<td>
				<label for="map">
					<?php echo JText::_( 'COM_EVENTLIST_ENABLE_MAP' ).':'; ?>
				</label>
			</td>
			<td>
				<?php
          			echo JHTML::_('select.booleanlist', 'map', 'class="inputbox"', 0 );
          		?>
          		&nbsp;
          		<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_NOTES' ); ?>::<?php echo JText::_('COM_EVENTLIST_ADDRESS_NOTICE'); ?>">
					<?php echo $infoimage; ?>
				</span>
			</td>
		</tr>
		<?php } ?>
	</table>
</fieldset>

<fieldset>
	<legend><?php echo JText::_('COM_EVENTLIST_DESCRIPTION'); ?></legend>
		<?php echo $this->editor->display('locdescription', '', '655', '400', '70', '15', false); ?>
</fieldset>

<fieldset>
	<table>
		<tr>
			<td valign="top">
				<label for="metadesc">
					<?php echo JText::_( 'COM_EVENTLIST_META_DESCRIPTION' ); ?>:
				</label>
				<br />
				<textarea class="inputbox" cols="40" rows="5" name="meta_description" id="metadesc" style="width:300px;"></textarea>
			</td>
			<td valign="top">
				<label for="metakey">
					<?php echo JText::_( 'COM_EVENTLIST_META_KEYWORDS' ); ?>:
				</label>
				<br />
				<textarea class="inputbox" cols="40" rows="5" name="meta_keywords" id="metakey" style="width:300px;"></textarea>
				<br />
				<input type="button" class="button" value="<?php echo JText::_( 'COM_EVENTLIST_ADD_VENUE_CITY' ); ?>" onclick="f=document.adminForm;f.metakey.value=f.venue.value+', '+f.city.value+f.metakey.value;" />
			</td>
		</tr>
	</table>
</fieldset>

<?php
if ( $this->elsettings->showmapserv == 0 ) { ?>
	<input type="hidden" name="map" value="0" />
<?php
}
?>
<?php echo JHTML::_( 'form.token' ); ?>
<input type="hidden" name="option" value="com_eventlist" />
<input type="hidden" name="controller" value="venues" />
<input type="hidden" name="id" value="" />
<input type="hidden" name="task" value="" />
</form>

<p class="copyright">
	<?php echo ELAdmin::footer( ); ?>
</p>