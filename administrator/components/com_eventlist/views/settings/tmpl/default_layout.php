	<table class="noshow">
      <tr>
        <td width="50%">
			<fieldset class="adminform">
			<legend><?php echo JText::_( 'COM_EVENTLIST_GENERAL_LAYOUT_SETTINGS'); ?></legend>
				<table class="admintable" cellspacing="1">
				<tbody>
					<tr>
	          			<td width="300" class="key">
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_DISPLAY_TIME' ); ?>::<?php echo JText::_('COM_EVENTLIST_DISPLAY_TIME_FRONT_TIP'); ?>">
								<?php echo JText::_( 'COM_EVENTLIST_DISPLAY_TIME' ); ?>
							</span>
						</td>
       					<td valign="top">
							<?php
          						echo JHTML::_('select.booleanlist', 'showtime', 'class="inputbox"', $this->elsettings->showtime );
							?>
						</td>
      				</tr>
					<tr>
	          			<td width="300" class="key">
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_FRONT_TABLE_WIDTH' ); ?>::<?php echo JText::_('COM_EVENTLIST_FRONT_TABLE_WIDTH_TIP'); ?>">
								<?php echo JText::_( 'COM_EVENTLIST_FRONT_TABLE_WIDTH' ); ?>
							</span>
						</td>
       					<td valign="top">
							<input type="text" name="tablewidth" value="<?php echo $this->elsettings->tablewidth; ?>" size="5" maxlength="4" />
       	 				</td>
      				</tr>
				</tbody>
				</table>
			  </fieldset>
			  <fieldset class="adminform">
			<legend><?php echo JText::_( 'COM_EVENTLIST_DATE_COLUMN'); ?></legend>
				<table class="admintable" cellspacing="1">
				<tbody>
					<tr>
	          			<td width="300" class="key">
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_WIDTH_DATE_COLUMN' ); ?>::<?php echo JText::_('COM_EVENTLIST_WIDTH_DATE_COLUMN_TIP'); ?>">
								<?php echo JText::_( 'COM_EVENTLIST_WIDTH_DATE_COLUMN' ); ?>
							</span>
						</td>
       					<td valign="top">
          					<input type="text" name="datewidth" value="<?php echo $this->elsettings->datewidth; ?>" size="5" maxlength="4" />
       	 				</td>
      				</tr>
					<tr>
	          			<td width="300" class="key">
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_COLUMN_NAME' ); ?>::<?php echo JText::_('COM_EVENTLIST_COLUMN_NAME_TIP'); ?>">
								<?php echo JText::_( 'COM_EVENTLIST_COLUMN_NAME' ); ?>
							</span>
						</td>
       					<td valign="top">
							<input type="text" name="datename" value="<?php echo $this->elsettings->datename; ?>" size="30" maxlength="25" />
       	 				</td>
      				</tr>
				</tbody>
				</table>
			</fieldset>

			<fieldset class="adminform">
			<legend><?php echo JText::_( 'COM_EVENTLIST_CITY_COLUMN' ); ?></legend>
				<table class="admintable" cellspacing="1">
				<tbody>
					<tr>
	          			<td width="300" class="key">
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_DISPLAY_CITY_FRONT' ); ?>::<?php echo JText::_('COM_EVENTLIST_DISPLAY_CITY_FRONT_TIP'); ?>">
								<?php echo JText::_( 'COM_EVENTLIST_DISPLAY_CITY_FRONT' ); ?>
							</span>
						</td>
       					<td valign="top">
          					<?php
							$mode = 0;
							if ($this->elsettings->showcity == 1) {
							$mode = 1;
							} // if
							?>
							<input type="radio" id="showcity0" class="inputbox" name="showcity" value="0" onclick="changecityMode(0)"<?php if (!$mode) echo ' checked="checked"'; ?>/><?php echo JText::_( 'COM_EVENTLIST_NO' ); ?>
							<input type="radio" id="showcity1" class="inputbox" name="showcity" value="1" onclick="changecityMode(1)"<?php if ($mode) echo ' checked="checked"'; ?>/><?php echo JText::_( 'COM_EVENTLIST_YES' ); ?>
       	 				</td>
      				</tr>
					<tr id="city1"<?php if (!$mode) echo ' style="display:none"'; ?>>
	          			<td width="300" class="key">
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_WIDTH_CITY_COLUMN' ); ?>::<?php echo JText::_('COM_EVENTLIST_WIDTH_CITY_COLUMN_TIP'); ?>">
								<?php echo JText::_( 'COM_EVENTLIST_WIDTH_CITY_COLUMN' ); ?>
							</span>
						</td>
       					<td valign="top">
							<input type="text" name="citywidth" value="<?php echo $this->elsettings->citywidth; ?>" size="5" maxlength="4" />
       	 				</td>
      				</tr>
					<tr id="city2"<?php if (!$mode) echo ' style="display:none"'; ?>>
	          			<td width="300" class="key">
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_COLUMN_NAME' ); ?>::<?php echo JText::_('COM_EVENTLIST_COLUMN_NAME_TIP'); ?>">
								<?php echo JText::_( 'COM_EVENTLIST_COLUMN_NAME' ); ?>
							</span>
						</td>
       					<td valign="top">
							<input type="text" name="cityname" value="<?php echo $this->elsettings->cityname; ?>" size="30" maxlength="25" />
       	 				</td>
      				</tr>
				</tbody>
				</table>
			</fieldset>

			<fieldset class="adminform">
			<legend><?php echo JText::_( 'COM_EVENTLIST_TITLE_COLUMN' ); ?></legend>
				<table class="admintable" cellspacing="1">
				<tbody>
	  				<tr>
	          			<td width="300" class="key">
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_DISPLAY_TITLE_FRONT' ); ?>::<?php echo JText::_('COM_EVENTLIST_DISPLAY_TITLE_FRONT_TIP'); ?>">
								<?php echo JText::_( 'COM_EVENTLIST_DISPLAY_TITLE_FRONT' ); ?>
							</span>
						</td>
       					<td valign="top">
							<?php
							$mode = 0;
							if ($this->elsettings->showtitle == 1) {
								$mode = 1;
							} // if
							?>
        					<input type="radio" id="showtitle0" class="inputbox" name="showtitle" value="0" onclick="changetitleMode(0)"<?php if (!$mode) echo ' checked="checked"'; ?>/><?php echo JText::_( 'COM_EVENTLIST_NO' ); ?>
							<input type="radio" id="showtitle1" class="inputbox" name="showtitle" value="1" onclick="changetitleMode(1)"<?php if ($mode) echo ' checked="checked"'; ?>/><?php echo JText::_( 'COM_EVENTLIST_YES' ); ?>
       	 				</td>
      				</tr>
					<tr id="title1"<?php if (!$mode) echo ' style="display:none"'; ?>>
	          			<td width="300" class="key">
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_WIDTH_TITLE_COLUMN' ); ?>::<?php echo JText::_('COM_EVENTLIST_WIDTH_TITLE_COLUMN_TIP'); ?>">
								<?php echo JText::_( 'COM_EVENTLIST_WIDTH_TITLE_COLUMN' ); ?>
							</span>
						</td>
       					<td valign="top">
							<input type="text" name="titlewidth" value="<?php echo $this->elsettings->titlewidth; ?>" size="5" maxlength="4" />
       	 				</td>
      				</tr>
					<tr id="title2"<?php if (!$mode) echo ' style="display:none"'; ?>>
	          			<td width="300" class="key">
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_COLUMN_NAME' ); ?>::<?php echo JText::_('COM_EVENTLIST_COLUMN_NAME_TIP'); ?>">
								<?php echo JText::_( 'COM_EVENTLIST_COLUMN_NAME' ); ?>
							</span>
						</td>
       					<td valign="top">
							<input type="text" name="titlename" value="<?php echo $this->elsettings->titlename; ?>" size="30" maxlength="25" />
       	 				</td>
      				</tr>
				</tbody>
				</table>
			</fieldset>
		</td>


        <td width="50%">
			<fieldset class="adminform">
			<legend><?php echo JText::_( 'COM_EVENTLIST_WIDTH_VENUE_COLUMN' ); ?></legend>
				<table class="admintable" cellspacing="1">
				<tbody>
	  				<tr>
	          			<td width="300" class="key">
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_DISPLAY_VENUE_FRONT' ); ?>::<?php echo JText::_('COM_EVENTLIST_DISPLAY_VENUE_FRONT_TIP'); ?>">
								<?php echo JText::_( 'COM_EVENTLIST_DISPLAY_VENUE_FRONT' ); ?>
							</span>
						</td>
       					<td valign="top">
							<?php
							$mode = 0;
							if ($this->elsettings->showlocate == 1) {
								$mode = 1;
							} // if
							?>
     						<input type="radio" id="showlocate0" class="inputbox" name="showlocate" value="0" onclick="changelocateMode(0)"<?php if (!$mode) echo ' checked="checked"'; ?>/><?php echo JText::_( 'COM_EVENTLIST_NO' ); ?>
							<input type="radio" id="showlocate1" class="inputbox" name="showlocate" value="1" onclick="changelocateMode(1)"<?php if ($mode) echo ' checked="checked"'; ?>/><?php echo JText::_( 'COM_EVENTLIST_YES' ); ?>
       	 				</td>
      				</tr>
					<tr id="locate1"<?php if (!$mode) echo ' style="display:none"'; ?>>
	          			<td width="300" class="key">
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_WIDTH_VENUE_COLUMN' ); ?>::<?php echo JText::_('COM_EVENTLIST_WIDTH_VENUE_COLUMN_TIP'); ?>">
								<?php echo JText::_( 'COM_EVENTLIST_WIDTH_VENUE_COLUMN' ); ?>
							</span>
						</td>
       					<td valign="top">
							<input type="text" name="locationwidth" value="<?php echo $this->elsettings->locationwidth; ?>" size="5" maxlength="4" />
       	 				</td>
      				</tr>
					<tr id="locate2"<?php if (!$mode) echo ' style="display:none"'; ?>>
	          			<td width="300" class="key">
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_COLUMN_NAME' ); ?>::<?php echo JText::_('COM_EVENTLIST_COLUMN_NAME_TIP'); ?>">
								<?php echo JText::_( 'COM_EVENTLIST_COLUMN_NAME' ); ?>
							</span>
						</td>
       					<td valign="top">
							<input type="text" name="locationname" value="<?php echo $this->elsettings->locationname; ?>" size="30" maxlength="25" />
       	 				</td>
      				</tr>
					<tr id="locate3"<?php if (!$mode) echo ' style="display:none"'; ?>>
	          			<td width="300" class="key">
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_DISPLAY_LINK_TO_VENUE_VIEW' ); ?>::<?php echo JText::_('COM_EVENTLIST_DISPLAY_LINK_TO_VENUE_VIEW_TIP'); ?>">
								<?php echo JText::_( 'COM_EVENTLIST_DISPLAY_LINK_TO_VENUE_VIEW' ); ?>
							</span>
						</td>
       					<td valign="top">
							<?php
          					echo JHTML::_('select.booleanlist', 'showlinkvenue', 'class="inputbox"', $this->elsettings->showlinkvenue );
        					?>
       	 				</td>
      				</tr>
				</tbody>
				</table>
			</fieldset>

			<fieldset class="adminform">
			<legend><?php echo JText::_( 'COM_EVENTLIST_WIDTH_STATE_COLUMN' ); ?></legend>
				<table class="admintable" cellspacing="1">
				<tbody>
					<tr>
	          			<td width="300" class="key">
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_DISPLAY_STATE_FRONT' ); ?>::<?php echo JText::_('COM_EVENTLIST_DISPLAY_STATE_FRONT_TIP'); ?>">
								<?php echo JText::_( 'COM_EVENTLIST_DISPLAY_STATE_FRONT' ); ?>
							</span>
						</td>
       					<td valign="top">
          					<?php
							$mode = 0;
							if ($this->elsettings->showstate == 1) {
							$mode = 1;
							} // if
							?>
							<input type="radio" id="showstate0" class="inputbox" name="showstate" value="0" onclick="changestateMode(0)"<?php if (!$mode) echo ' checked="checked"'; ?>/><?php echo JText::_( 'COM_EVENTLIST_NO' ); ?>
							<input type="radio" id="showstate1" class="inputbox" name="showstate" value="1" onclick="changestateMode(1)"<?php if ($mode) echo ' checked="checked"'; ?>/><?php echo JText::_( 'COM_EVENTLIST_YES' ); ?>
       	 				</td>
      				</tr>
					<tr id="state1"<?php if (!$mode) echo ' style="display:none"'; ?>>
	          			<td width="300" class="key">
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_WIDTH_STATE_COLUMN' ); ?>::<?php echo JText::_('COM_EVENTLIST_WIDTH_STATE_COLUMN_TIP'); ?>">
								<?php echo JText::_( 'COM_EVENTLIST_WIDTH_STATE_COLUMN' ); ?>
							</span>
						</td>
       					<td valign="top">
							<input type="text" name="statewidth" value="<?php echo $this->elsettings->statewidth; ?>" size="5" maxlength="4" />
       	 				</td>
      				</tr>
					<tr id="state2"<?php if (!$mode) echo ' style="display:none"'; ?>>
	          			<td width="300" class="key">
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_COLUMN_NAME' ); ?>::<?php echo JText::_('COM_EVENTLIST_COLUMN_NAME_TIP'); ?>">
								<?php echo JText::_( 'COM_EVENTLIST_COLUMN_NAME' ); ?>
							</span>
						</td>
       					<td valign="top">
							<input type="text" name="statename" value="<?php echo $this->elsettings->statename; ?>" size="30" maxlength="25" />
       	 				</td>
      				</tr>
				</tbody>
				</table>
			</fieldset>

			<fieldset class="adminform">
			<legend><?php echo JText::_( 'COM_EVENTLIST_CATEGORY_COLUMN'); ?></legend>
				<table class="admintable" cellspacing="1">
				<tbody>
	  				<tr>
	          			<td width="300" class="key">
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_DISPLAY_CATEGORY_FRONT' ); ?>::<?php echo JText::_('COM_EVENTLIST_DISPLAY_CATEGORY_FRONT_TIP'); ?>">
								<?php echo JText::_( 'COM_EVENTLIST_DISPLAY_CATEGORY_FRONT' ); ?>
							</span>
						</td>
       					<td valign="top">
							<?php
							$mode = 0;
							if ($this->elsettings->showcat == 1) {
								$mode = 1;
							} // if
							?>
							<input type="radio" id="showcat0" class="inputbox" name="showcat" value="0" onclick="changecatMode(0)"<?php if (!$mode) echo ' checked="checked"'; ?>/><?php echo JText::_( 'COM_EVENTLIST_NO' ); ?>
							<input type="radio" id="showcat1" class="inputbox" name="showcat" value="1" onclick="changecatMode(1)"<?php if ($mode) echo ' checked="checked"'; ?>/><?php echo JText::_( 'COM_EVENTLIST_YES' ); ?>
       	 				</td>
      				</tr>
					<tr id="cat1"<?php if (!$mode) echo ' style="display:none"'; ?>>
	          			<td width="300" class="key">
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_WIDTH_CATEGORY_COLUMN' ); ?>::<?php echo JText::_('COM_EVENTLIST_WIDTH_CATEGORY_COLUMN_TIP'); ?>">
								<?php echo JText::_( 'COM_EVENTLIST_WIDTH_CATEGORY_COLUMN' ); ?>
							</span>
						</td>
       					<td valign="top">
							<input type="text" name="catfrowidth" value="<?php echo $this->elsettings->catfrowidth; ?>" size="5" maxlength="4" />
       	 				</td>
      				</tr>
					<tr id="cat2"<?php if (!$mode) echo ' style="display:none"'; ?>>
	          			<td width="300" class="key">
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_COLUMN_NAME' ); ?>::<?php echo JText::_('COM_EVENTLIST_COLUMN_NAME_TIP'); ?>">
								<?php echo JText::_( 'COM_EVENTLIST_COLUMN_NAME' ); ?>
							</span>
						</td>
       					<td valign="top">
							<input type="text" name="catfroname" value="<?php echo $this->elsettings->catfroname; ?>" size="30" maxlength="25" />
       	 				</td>
      				</tr>
					<tr id="cat3"<?php if (!$mode) echo ' style="display:none"'; ?>>
	          			<td width="300" class="key">
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_EVENTLIST_DISPLAY_LINK_TO_CATEGORY_VIEW' ); ?>::<?php echo JText::_('COM_EVENTLIST_DISPLAY_LINK_TO_CATEGORY_VIEW_TIP'); ?>">
								<?php echo JText::_( 'COM_EVENTLIST_DISPLAY_LINK_TO_CATEGORY_VIEW' ); ?>
							</span>
						</td>
       					<td valign="top">
							<?php
        						echo JHTML::_('select.booleanlist', 'catlinklist', 'class="inputbox"', $this->elsettings->catlinklist );
        					?>
       	 				</td>
      				</tr>
				</tbody>
				</table>
			  </fieldset>
		</td>
      </tr>
    </table>