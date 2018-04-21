<?php include("header.php"); ?>

<!-- First Pane Begin -->
						<div id="leftcolumn">
<!-- Begin Box 1 -->
															<div class="module_menu">
			<div>
				<div>
					<div>
													<h3>Resources</h3>
											<ul class="menu"><li class="item11"><a href="index.php?view=list_of_coupon_sites"><span>List of Coupon Sites</span></a></li></ul>					</div>
				</div>
			</div>
		</div>
<!-- End Box 1 -->
<!-- Begin Box 2 -->
<?php
  if (!tep_session_is_registered('user_id')) 
  {
     include("login_box.php");
  }
  else
  {
     include("logoff_box.php");
  }
?>
<!-- End Box 2 -->
<!-- Begin Box 3 -->
<!--
			<div class="module">
			<div>
				<div>
					<div>
													<h3>Jumi</h3>
											<div style="color:#FF0000;background:#FFFF00;">Jumi is working but there is <b>nothing to be shown</b>.<br />Write the code and/or specify the nonempty source of the code.</div>					
                                        </div>
				</div>
			</div>
		        </div>
-->
<!-- End Box 3 -->
<!-- Begin Box 4  -->
<!--
			<div class="module">
			<div>
				<div>
					<div>
													<h3>Jumi Copy</h3>
											<div style="color:#FF0000;background:#FFFF00;">Jumi is working but there is <b>nothing to be shown</b>.<br />Write the code and/or specify the nonempty source of the code.</div>					
                                        </div>
				</div>
			</div>
		        </div>
-->
<!-- End Box 4  -->
												</div>
<!-- End Left Pane -->

<!-- Being Middle Pane -->
												<div id="maincolumn">
													
							<table class="nopad">
								<tr valign="top">
									<td>
<?php
  if (isset($_GET['view']) && ($_GET['view'] == 'forgot_password'))
  {
     include("forgot_password.php");
  }
  else
  if (isset($_GET['view']) && ($_GET['view'] == 'login'))
  {
     include("login.php");
  }
  else
  if (isset($_GET['view']) && ($_GET['view'] == 'user'))
  {
     include("user.php");
  }
  else
  if (isset($_GET['view']) && ($_GET['view'] == 'register'))
  {
     include("register.php");
  }
  else
  if (isset($_GET['view']) && ($_GET['view'] == 'contact'))
  {
     include("contact.php");
  }
  else
  if (isset($_GET['view']) && ($_GET['view'] == 'search'))
  {
     include("search.php");
  }
  else
  if (isset($_GET['view']) && ($_GET['view'] == 'about'))
  {
     include("home_page_content.php");
  }
  else if (isset($_GET['view']) && ($_GET['view'] == 'coupon'))
  {
     include("coupon.php");
  }
  else if (isset($_GET['view']) && ($_GET['view'] == 'sale'))
  {
     include("sale.php");
  }
  else if (isset($_GET['view']) && ($_GET['view'] == 'deal'))
  {
     include("deal.php");
  }
  else if (isset($_GET['view']) && ($_GET['view'] == 'my_savings'))
  {
     include("my_savings.php");
  }
  else if (isset($_GET['view']) && ($_GET['view'] == 'shopping_list'))
  {
     include("shopping_list.php");
  }
  else if (isset($_GET['view']) && ($_GET['view'] == 'list_of_coupon_sites'))
  {
     include("list_of_coupon_sites.php");
  }
  else
  if (!tep_session_is_registered('user_id')) 
  {
     include("home_page_content.php");
  }
  else
  {
     include("main_app.php");
  }
?>
<!--
												<div class="moduletable">
					<div>Copyright &#169; 2010 Bring Savings To Me. All Rights Reserved.</div>
<div></div>		</div> -->
	
									</td>
<!-- Divider Line -->
																			<td class="greyline">&nbsp;</td>
<!-- Left Pane Begin -->
										<td width="170">
<!-- Box 1 Begin -->
<?php include("tips.php"); ?>
<!-- Box 1 End -->
<!-- Box 2 Begin -->
			<div class="moduletable">
					<h3>Polls</h3>
					<form action="index.php" method="post" name="form2">

<table width="95%" border="0" cellspacing="0" cellpadding="1" align="center" class="poll">
<thead>
	<tr>
		<td style="font-weight: bold;">
			What Store Has the Cheapest Prices		</td>
	</tr>
</thead>
	<tr>
		<td align="center">
			<table class="pollstableborder" cellspacing="0" cellpadding="0" border="0">
							<tr>
					<td class="sectiontableentry2" valign="top">
						<input type="radio" name="voteid" id="voteid1" value="1" alt="1" />
					</td>
					<td class="sectiontableentry2" valign="top">
						<label for="voteid1">
							Giant/Stop and Shop						</label>
					</td>
				</tr>
											<tr>
					<td class="sectiontableentry1" valign="top">
						<input type="radio" name="voteid" id="voteid2" value="2" alt="2" />
					</td>
					<td class="sectiontableentry1" valign="top">
						<label for="voteid2">
							Best Buy						</label>
					</td>
				</tr>
											<tr>
					<td class="sectiontableentry2" valign="top">
						<input type="radio" name="voteid" id="voteid3" value="3" alt="3" />
					</td>
					<td class="sectiontableentry2" valign="top">
						<label for="voteid3">
							Costco						</label>
					</td>
				</tr>
											<tr>
					<td class="sectiontableentry1" valign="top">
						<input type="radio" name="voteid" id="voteid4" value="4" alt="4" />
					</td>
					<td class="sectiontableentry1" valign="top">
						<label for="voteid4">
							Walmart						</label>
					</td>
				</tr>
											<tr>
					<td class="sectiontableentry2" valign="top">
						<input type="radio" name="voteid" id="voteid5" value="5" alt="5" />
					</td>
					<td class="sectiontableentry2" valign="top">
						<label for="voteid5">
							Target						</label>
					</td>
				</tr>
											<tr>
					<td class="sectiontableentry1" valign="top">
						<input type="radio" name="voteid" id="voteid6" value="6" alt="6" />
					</td>
					<td class="sectiontableentry1" valign="top">
						<label for="voteid6">
							Wegmans						</label>
					</td>
				</tr>
											<tr>
					<td class="sectiontableentry2" valign="top">
						<input type="radio" name="voteid" id="voteid7" value="7" alt="7" />
					</td>
					<td class="sectiontableentry2" valign="top">
						<label for="voteid7">
							Safeway						</label>
					</td>
				</tr>
											<tr>
					<td class="sectiontableentry1" valign="top">
						<input type="radio" name="voteid" id="voteid8" value="8" alt="8" />
					</td>
					<td class="sectiontableentry1" valign="top">
						<label for="voteid8">
							Bloom						</label>
					</td>
				</tr>
											<tr>
					<td class="sectiontableentry2" valign="top">
						<input type="radio" name="voteid" id="voteid9" value="9" alt="9" />
					</td>
					<td class="sectiontableentry2" valign="top">
						<label for="voteid9">
							Harris Teeter						</label>
					</td>
				</tr>
											<tr>
					<td class="sectiontableentry1" valign="top">
						<input type="radio" name="voteid" id="voteid10" value="10" alt="10" />
					</td>
					<td class="sectiontableentry1" valign="top">
						<label for="voteid10">
							Kmart						</label>
					</td>
				</tr>
										</table>
		</td>
	</tr>
	<tr>
		<td>
			<div align="center">
				<input type="submit" name="task_button" class="button" value="Vote" />
				&nbsp;
				<input type="button" name="option" class="button" value="Results" onclick="document.location.href='/bstm_joomla/index.php?option=com_poll&amp;id=14:who-is-cheapest'" />
			</div>
		</td>
	</tr>
</table>

	</form>		</div>
<!-- Box 2 End -->
<!-- Box 3 Begin -->
<!--
			<div class="moduletable">
					<h3>Who's Online</h3>
					 We have&nbsp;2 guests&nbsp;online		</div>
-->
<!-- Box 3 End -->
<!-- Box 4 Begin -->
<!--
			<div class="moduletable_text">
					<h3>Advertisement</h3>
					<div class="bannergroup_text">

	<div class="bannerheader">Featured Links:</div>

	<div class="bannerfooter_text">
		 <a href="http://www.joomla.org">Ads by Joomla!</a>	</div>
</div>		</div>
-->
<!-- Box 4 End -->
	
										</td>
																	</tr>
							</table> <!-- table with 1 tr and X tds -->

						</div>
						<div class="clr"></div>
					</div>
					<div class="clr"></div>
<!-- Footer Begin -->
<?php include("footer.php"); ?>
<!--
				</div>

				<div id="whitebox_b">
					<div id="whitebox_bl">
						<div id="whitebox_br"></div>
					</div>
				</div>
			</div>

			<div id="footerspacer"></div>
		</div>

		<div id="footer">
			<div id="footer_l">
				<div id="footer_r">
					<p id="syndicate">
						<a href="/bstm_joomla/index.php?format=feed&amp;type=rss">
	<img src="/bstm_joomla/images/M_images/livemarks.png" alt="feed-image"  /> <span>Feed Entries</span></a>
					</p>
					<p id="power_by">
	 				 	<!--Powered by <a href="http://www.joomla.org">Joomla!</a>.
						valid <a href="http://validator.w3.org/check/referer">XHTML</a> and <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>.-->
					</p>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>
-->
