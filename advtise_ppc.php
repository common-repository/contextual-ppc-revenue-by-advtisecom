<?php
/*
Plugin Name: Contextual Revenue plugin by Advtise
Plugin URI: http://www.Advtise.com
Description: Inserts Advtise Pay Per Click code in to your blog posts. Ad position can be random or pre-defined. To configure this plugin go to "Settings->Advtise PPC" menu.
Version: 1.1
Author: Matthuffy
Author URI: http://www.Advtise.com
*/

/*

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


//add  Advtise menu to the wordpress options menu
function ai_add_options(){
  if(function_exists('add_options_page')){
    add_options_page('Advtise PPC', 'Advtise PPC', 9, basename(__FILE__), 'ai_options_subpanel');
  }
}

//validate options
switch($_POST['action']){
case 'Save/Update Settings':

  update_option('ai_network', $_POST['ai_network']);

  if(isset($_POST['betatest'])) update_option('ai_betatest', "yes");
  else delete_option('ai_betatest');
  if(isset($_POST['notme'])) update_option('ai_notme', "yes");
  else delete_option('ai_notme');
  if(isset($_POST['googtestmode'])) update_option('ai_googtestmode', "yes");
  else delete_option('ai_googtestmode');
  
  if(isset($_POST['dontshowinstr'])) update_option('ai_dontshowinstr', "yes");
  if(isset($_POST['showinstr'])) update_option('ai_dontshowinstr', "no");
  
  update_option('ai_adtype', $_POST['ai_adtype']);
  update_option('ai_before', $_POST['ai_before']);
  update_option('ai_after', $_POST['ai_after']);
  update_option('ai_color_border', $_POST['ai_color_border']);
  update_option('ai_color_link', $_POST['ai_color_link']);
  update_option('ai_color_bg', $_POST['ai_color_bg']);
  update_option('ai_color_text', $_POST['ai_color_text']);
  update_option('ai_color_url', $_POST['ai_color_url']);
  
  update_option('ai_corner_style', $_POST['corner_style']);

  update_option('ai_lra', $_POST['ai_pos']);
  update_option('ai_space', $_POST['ai_space']);
  update_option('ai_nads', $_POST['nads']);
  update_option('ai_nadspp', $_POST['nadspp']);
  update_option('ai_text_only', false);

  update_option('ai_client', $_POST['ai_client']);
  update_option('ai_channel', $_POST['ai_channel']);
  update_option('ai_client_ypn', $_POST['ai_client_ypn']);
  update_option('ai_channel_ypn', $_POST['ai_channel_ypn']);
  
	if(isset($_POST['donation']) && $_POST['donation'] != ''){
	  update_option('ai_donation', $_POST['donation']);
		update_option('ai_dfirst', 0);
	}
	else{
	  update_option('ai_dfirst', 1);
	}  
  
  if($_POST['120x240'] == "on") update_option('ai_120x240', "checked=on");
  else update_option('ai_120x240', "");
  if($_POST['120x600'] == "on") update_option('ai_120x600', "checked=on");
  else update_option('ai_120x600', "");
  if($_POST['160x600'] == "on") update_option('ai_160x600', "checked=on");
  else update_option('ai_160x600', "");
  if($_POST['234x60'] == "on") update_option('ai_234x60', "checked=on");
  else update_option('ai_234x60', "");
  if($_POST['240x240'] == "on") update_option('ai_240x240', "checked=on");
  else update_option('ai_240x240', "");
  if($_POST['250x250'] == "on") update_option('ai_250x250', "checked=on");
  else update_option('ai_250x250', "");
  if($_POST['468x60'] == "on") update_option('ai_468x60', "checked=on");
  else update_option('ai_468x60', "");
  if($_POST['728x90'] == "on") update_option('ai_728x90', "checked=on");
  else update_option('ai_728x90', "");

  if($_POST['home'] == "on") update_option('ai_home', "checked=on");
  else update_option('ai_home', "");
  if($_POST['page'] == "on") update_option('ai_page', "checked=on");
  else update_option('ai_page', "");
  if($_POST['post'] == "on") update_option('ai_post', "checked=on");
  else update_option('ai_post', "");
  if($_POST['cat'] == "on") update_option('ai_cat', "checked=on");
  else update_option('ai_cat', "");
  if($_POST['archive'] == "on") update_option('ai_archive', "checked=on");
  else update_option('ai_archive', "");

  break;
}

//user enter required data here
function ai_options_subpanel(){
  if(get_option("ai_network", "") == "") {
    update_option("ai_network", "Advtise");
	update_option("ai_adtype", "text");
	update_option("ai_corner_style", "square");
  }
  $ad_client = get_option('ai_client');
  $ad_channel = get_option('ai_channel');
  $ad_client_ypn = get_option('ai_client_ypn');
  $ad_channel_ypn = get_option('ai_channel_ypn');
  $adnetwork = get_option("ai_network", "Advtise");
  $ai_adtype = get_option('ai_adtype');
  $ai_corner_style = get_option('ai_corner_style');
  $ai_before = get_option('ai_before');
  $ai_after = get_option('ai_after');
  $ai_space = get_option('ai_space');

  $lra = get_option('ai_lra');
  $nads = get_option('ai_nads');
  $nadspp = get_option('ai_nadspp');
  $text_only = get_option('ai_text_only');

  $ai_color_border = get_option('ai_color_border');
  $ai_color_link = get_option('ai_color_link');
  $ai_color_bg = get_option('ai_color_bg');
  $ai_color_text = get_option('ai_color_text');
  $ai_color_url = get_option('ai_color_url');
	$ai_donation = get_option('ai_donation');  
  
?>

<style type="text/css">
body {font-family: arial
}
}
td{vertial-align:top}
a:link,a:visited,a:active{
text-decoration:none;
color:#000000;
font-weight:normal;}
a:hover{
text-decoration:underline;
color:#FF0000;
}
h1{font-size:16px}
h3{font-size:14px}
label{font-size:12px}
tr.paddings {
padding-bottom: 3px;}
.colors {
position:absolute;
display:none;
left: 150px;
top: 150px;
width: 290px;
height: 137px;
background:#666666;}
.colorhover1 {
width: 20px;
border: 1px solid blue;
cursor: pointer;
height: 20px;}

td.hw{
height:25px;
width:20px;
margin: 0;
cursor:pointer;
border:1px solid blue;
}
td.bolder1{font-size:58px; font-weight:bold}
.style1 {color: #003399}
</style>

<div class="wrap"> 
  <h2><?php _e('Contextual Revenue plugin by Advtise', 'wpai') ?></h2> 
  <form name="form1" method="post">
	<input type="hidden" name="stage" value="process" />
    <a href="http://www.advtise.com"><img src="http://advtise.com/images/advtise.gif" alt="Advtise PPC" border="0" /></a>
<fieldset class="options">
		
<?php if(get_option('ai_dontshowinstr', "no") != "yes"){ ?>
	<b>How to Use</b><br>
	<ul>
	<li>Get an Advtise Partner account <a href="http://www.advtise.com" target="_blank" class="style1">here</a>.</li>
	<li>Ad code for Advtise will be automatically generated for you.</li>
	<li>Your Advtise account ID is the username that you used to register with Advtise Partner network    </li>
	<li>Enter your account/Partner ID in the boxes below.</li>
  <input name=dontshowinstr type=checkbox>Don't show these instructions anymore.
  <?php } 
  else { ?>
    <input name=showinstr type=checkbox>Show instructions again.<br />
  <?php
  	   }
  ?>
		<table width="100%" cellspacing="2" cellpadding="5" class="editform" > 
		  <tr align="left" valign="top">
    <tr valign="top">
			<th width="30%" scope="row" style="text-align: left"><?php _e('Ad Network', 'wpai') ?></th>
      <td>
      <select name='ai_network'>
      <option value="Advtise" <?php if($adnetwork == 'Advtise') echo "SELECTED"; ?> >Advtise
      </select></td> 
      <td align=right colspan=5>
      </td>
    <tr>
			<th width="30%" scope="row" style="text-align: left"><?php _e('Advtise ID', 'wpai') ?></th>
			<td><input type="text" name="ai_client" id="ai_client" style="width: 80%;" cols="50" value="<?php echo $ad_client; ?>"></td></tr>
            
		             
            
		  <tr valign="top">
			<th width="30%" scope="row" style="text-align: left"><?php _e('Ad Formats To Show (choose more than 1 to show random format)', 'wpai') ?></th>

			<td><option>
			<INPUT TYPE=CHECKBOX NAME="120x240" <?php echo get_option('ai_120x240'); ?>>120x240<BR>
			<INPUT TYPE=CHECKBOX NAME="120x600" <?php echo get_option('ai_120x600'); ?>>120x600<BR>
			<INPUT TYPE=CHECKBOX NAME="160x600" <?php echo get_option('ai_160x600'); ?>>160x600<BR>
			<INPUT TYPE=CHECKBOX NAME="234x60" <?php echo get_option('ai_234x60'); ?>>234x60<BR>
			<INPUT TYPE=CHECKBOX NAME="240x240" <?php echo get_option('ai_240x240'); ?>>240x240<BR>
			<INPUT TYPE=CHECKBOX NAME="250x250" <?php echo get_option('ai_250x250'); ?>>250x250<BR>
			<INPUT TYPE=CHECKBOX NAME="468x60" <?php echo get_option('ai_468x60'); ?>>468x60<BR>
            <INPUT TYPE=CHECKBOX NAME="728x90" <?php echo get_option('ai_728x90'); ?>>728x90<BR></option>
      </td>
      </tr>
      
      <tr align="left" valign="top">
        <th width="30%" scope="row" style="text-align: left"><?php _e('Colors (leave blank for default colors)', 'wpai') ?></th>
            <td>
			<table>
			  <!--DWLayoutTable-->
            <tr><td width="169" height="24" valign="top">Color Border:</td>
              <td width="142" valign="top"><input type="text" name="ai_color_border" id="ai_color_border" cols="50" value="<?php echo $ai_color_border; ?>"></td>
              <td width="360">&nbsp;</td>
              <td>&nbsp;</td></tr>
			<tr><td height="24" valign="top">Color Link:</td>
			  <td valign="top"><input type="text" name="ai_color_link" id="ai_color_link" cols="50" value="<?php echo $ai_color_link; ?>"></td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td></tr>
			<tr><td height="24" valign="top">Color Background:</td>
			  <td valign="top"><input type="text" name="ai_color_bg" id="ai_color_bg" cols="50" value="<?php echo $ai_color_bg; ?>"></td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			</tr>
			<tr><td height="24" valign="top">Color Text:</td>
			  <td valign="top"><input type="text" name="ai_color_text" id="ai_color_text" cols="50" value="<?php echo $ai_color_text; ?>"></td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td></tr>
			<tr><td height="24" valign="top">Color URL:</td>
			  <td valign="top"><input type="text" name="ai_color_url" id="ai_color_url" cols="50" value="<?php echo $ai_color_url; ?>"></td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td></tr>
            <?php 
			$httppath = get_option('siteurl') . "/wp-content/plugins/Advtise_PPC/colorpicker.html";
    		?>
			<tr><td height="20" colspan="3">If you don't know the color codes, use the included <a href="<?php echo $httppath; ?>" target=_blank>Advtise Ad Color Picker</a>  (open in a new window).</td>
			  <td>&nbsp;</td>
			</tr>
			</table>
		</td></tr>
	
		<tr valign="top">
			<th width="30%" scope="row" style="text-align: left"><?php _e('Number of Ads to Show Per Page', 'wpai') ?></th>
      <td>
      <select name='nads'>
      <option value="0" <?php if($nads == 0) echo "SELECTED"; ?> >0
      <option value="1" <?php if($nads == 1) echo "SELECTED"; ?> >1
      <option value="2" <?php if($nads == 2) echo "SELECTED"; ?> >2
      <option value="3" <?php if($nads == 3) echo "SELECTED"; ?> >3
      </select>

      </td> 
    </tr>
		<tr valign="top">
			<th width="30%" scope="row" style="text-align: left"><?php _e('Number of Ads to Show Per Post', 'wpai') ?></th>
      <td>
      <select name='nadspp'>
      <option value="0" <?php if($nadspp == 0) echo "SELECTED"; ?> >0
      <option value="1" <?php if($nadspp == 1) echo "SELECTED"; ?> >1
      <option value="2" <?php if($nadspp == 2) echo "SELECTED"; ?> >2
      <option value="3" <?php if($nadspp == 3) echo "SELECTED"; ?> >3
      </select> &nbsp;&nbsp;(This is for multiple ads displayed on single post pages)

      </td> 
    </tr>

    <tr valign="top">
			<th width="30%" scope="row" style="text-align: left"><?php _e('Ad Positioning', 'wpai') ?></th>
      <td>
      <select name='ai_pos'>
      <option value="random" <?php if($lra == 'random') echo "SELECTED"; ?> >random
      <option value="left" <?php if($lra == 'left') echo "SELECTED"; ?> >left
      <option value="right" <?php if($lra == 'right') echo "SELECTED"; ?> >right
      <option value="center" <?php if($lra == 'center') echo "SELECTED"; ?> >center
      <option value="top-left" <?php if($lra == 'top-left') echo "SELECTED"; ?> >top left
      <option value="top-right" <?php if($lra == 'top-right') echo "SELECTED"; ?> >top right
      <option value="top-center" <?php if($lra == 'top-center') echo "SELECTED"; ?> >top center
      <option value="bottom-left" <?php if($lra == 'bottom-left') echo "SELECTED"; ?> >bottom left
      <option value="bottom-right" <?php if($lra == 'bottom-right') echo "SELECTED"; ?> >bottom right
      <option value="bottom-center" <?php if($lra == 'bottom-center') echo "SELECTED"; ?> >bottom center
    </select></td> </tr>
  <tr valign="top">
  		<th width="30%" scope="row" style="text-align: left"><?php _e('Add space between ad and blog text: ', 'wpai') ?></th>
      <td>
      <select name='ai_space'>
      <option value="0" <?php if($ai_space == 0) echo "SELECTED"; ?> >0
      <option value="1" <?php if($ai_space == 1) echo "SELECTED"; ?> >1
      <option value="2" <?php if($ai_space == 2) echo "SELECTED"; ?> >2
      <option value="3" <?php if($ai_space == 3) echo "SELECTED"; ?> >3
      <option value="4" <?php if($ai_space == 4) echo "SELECTED"; ?> >4
      <option value="5" <?php if($ai_space == 5) echo "SELECTED"; ?> >5
      <option value="7" <?php if($ai_space == 7) echo "SELECTED"; ?> >7
      <option value="9" <?php if($ai_space == 9) echo "SELECTED"; ?> >9
      <option value="12" <?php if($ai_space == 12) echo "SELECTED"; ?> >12
      <option value="15" <?php if($ai_space == 15) echo "SELECTED"; ?> >15
    </select> pixels</td> </tr>
  
  <tr valign="top">
    <th width="30%" scope="row" style="text-align: left"><?php _e('Code before the ad (html or text)', 'wpai') ?></th>
    	<td><input type="text" name="ai_before" id="ai_before" style="width: 80%;" cols="50" value="<?php echo stripslashes(htmlspecialchars($ai_before)) ; ?>"> (Optional)</td>
      </tr>
  <tr valign="top">
    <th width="30%" scope="row" style="text-align: left"><?php _e('Code after the ad (html or text)', 'wpai') ?></th>
    	<td><input type="text" name="ai_after" id="ai_after" style="width: 80%;" cols="50" value="<?php echo stripslashes(htmlspecialchars($ai_after)) ; ?>"> (Optional)</td>
      </tr>
      	
		  <tr valign="top">
			<th width="30%" scope="row" style="text-align: left"><?php _e("Don't Show On These Pages", 'wpai') ?></th>

			<td>
			<INPUT TYPE=CHECKBOX NAME="home" <?php echo get_option('ai_home'); ?>>home page (if you have issues with home page display, try checking this option)<BR>
			<INPUT TYPE=CHECKBOX NAME="page" <?php echo get_option('ai_page'); ?>>static pages<BR>
			<INPUT TYPE=CHECKBOX NAME="post" <?php echo get_option('ai_post'); ?>>post pages<BR>
			<INPUT TYPE=CHECKBOX NAME="cat" <?php echo get_option('ai_cat'); ?>>category pages<BR>
			<INPUT TYPE=CHECKBOX NAME="archive" <?php echo get_option('ai_archive'); ?>>archive pages<BR>
      </td>
      </tr>
    <tr>
    <td colspan=5><input name=betatest type=checkbox <?php if(get_option("ai_betatest") == "yes") echo "checked"; ?>>Only let myself see the ads. (useful for testing)</td>
    </tr><tr>
    <td colspan=5><input name=notme type=checkbox <?php if(get_option("ai_notme") == "yes") echo "checked"; ?>>Don't show ads to myself. (For avoiding accidental clicks by yourself)</td>
    </tr>
    <tr>
      <td align=right colspan=5>
      <p class="submit">
      <input type="button" onClick="location.href='http://www.advtise.com'" value="<?php _e('Get Advtise Partner Account', 'wpai') ?>" />
<input type="submit" name="action" value="<?php _e('Save/Update Settings', 'wpai') ?>" /></p>
      </td>
    </tr>
    <tr>
    <td colspan=5>
	<b>Notes</b><br>
	<ul><li>If you don't want to show any ads on a specific post, put &lt;!--noAdvtise--&gt; in the post.</li>
	<li>If you want ads to start below a certain point, put &lt;!--Advtisestart--&gt; at that point.  It's just like the &lt;!--more--&gt; deal except for ads.</li>
	</ul>
    </td>
    </tr>
    
		</table>
	</fieldset>
	
	 
  </form> 
</div>

<?php 


}

add_action('admin_menu', 'ai_add_options');

function ai_install() {

  if(get_option('ai_client') == "") {
    update_option('ai_network', "Advtise");
    update_option('ai_lra', "center");
    update_option('ai_nads', 3);
    update_option('ai_nadspp', 1);
    update_option('ai_text_only', false);
    update_option('ai_space', 3);
	update_option('ai_dfirst', 1);	
  }
}
/*if (isset($_GET['activate']) && $_GET['activate'] == 'true') {
   add_action('init', 'ai_install');
}*/

add_action('Advtise_PPC/advtise_ppc.php', 'ai_install');

//alignment
function ai_pickalign($tag){
	$padspace = get_option('ai_space');
  if($tag == "left")
    return '<div style="float: left;margin: '.$padspace.'px;">';
  if($tag == "right")
    return '<div style="float: right;margin: '.$padspace.'px;">';
  if($tag == "center")
    return '<div style="text-align: left;margin: '.$padspace.'px;">';
  else
    return ai_pickalign(rand(0,10)<5?"left":"right");
}

//pick ad size
function ai_picksize(){
  $sizes = array();
  if(strlen(get_option('ai_120x240'))) $sizes[] = "120x240";
  if(strlen(get_option('ai_120x600'))) $sizes[] = "120x600";
    if(strlen(get_option('ai_160x600'))) $sizes[] = "160x600";
  if(strlen(get_option('ai_234x60')))  $sizes[] = "234x60";  
  if(strlen(get_option('ai_240x240'))) $sizes[] = "240x240"; 
  if(strlen(get_option('ai_250x250'))) $sizes[] = "250x250";
  if(strlen(get_option('ai_468x60')))  $sizes[] = "468x60";
  if(strlen(get_option('ai_728x90'))) $sizes[] = "728x90";

  return $sizes[rand(0, sizeof($sizes)-1)];
}

//you can only show one network at a time.
$ai_loadnetwork = "";

function ai_genadcode(){
  global $user_level, $ai_loadnetwork;
  $size = ai_picksize();
  $width = substr($size, 0, 3);
  $height = substr($size, 4, 3);
    
  $client = get_option('ai_client');
  $randd = mt_rand(1,12);
  $ai_adtype = get_option('ai_adtype');
  $ai_before = stripslashes(get_option('ai_before'));
  $ai_after = stripslashes(get_option('ai_after'));
  if(get_option('ai_corner_style')=="square"){
  	$corners = 'rc:0';
  }
  else if(get_option('ai_corner_style')=="slightly"){
  	$corners = 'rc:6';
  }
  else if(get_option('ai_corner_style')=="very"){
  	$corners = 'rc:10';
  }
  
  $color_border = get_option('ai_color_border');
  $color_link = get_option('ai_color_link');
  $color_bg = get_option('ai_color_bg');
  $color_text = get_option('ai_color_text');
  $color_url = get_option('ai_color_url');
  
  $retstr = "";
  $adnetwork = $ai_loadnetwork;
  if($adnetwork == "")
    $adnetwork = get_option("ai_network", "Advtise");

  $ai_loadnetwork = $adnetwork;
if($adnetwork == "YPN"){
  	$retstr = $ai_before;
    $retstr .= '<script language="JavaScript">
<!--
ctxt_ad_partner = "'.$client_ypn.'";
ctxt_ad_section = "'.$channel_ypn.'";
ctxt_ad_bg = "";
ctxt_ad_width = '.$width.';
ctxt_ad_height = '.$height.';
ctxt_ad_bc = "'.$color_bg.'";
ctxt_ad_cc = "'.$color_border.'";
ctxt_ad_lc = "'.$color_link.'";
ctxt_ad_tc = "'.$color_text.'";
ctxt_ad_uc = "'.$color_url.'";
// -->
</script>
<script language="JavaScript" src="http://ypn-js.overture.com/partner/js/ypn.js">

</script>';
   $retstr .= $ai_after;

  }
  else{
    $retstr = $ai_before.'<script type="text/javascript">
';
  if(strlen(get_option('ai_120x240'))){$colum = 1; $num_res = 2;}
  if(strlen(get_option('ai_120x600'))){$colum = 1; $num_res = 4;}
  if(strlen(get_option('ai_160x600'))){$colum = 1; $num_res = 7;}
  if(strlen(get_option('ai_234x60'))){$colum = 1;  $num_res = 1;}
  if(strlen(get_option('ai_240x240'))){$colum = 1;  $num_res = 2;}
  if(strlen(get_option('ai_250x250'))){$colum =  1; $num_res = 3;}
  if(strlen(get_option('ai_468x60'))){$colum = 3;  $num_res = 3;}
  if(strlen(get_option('ai_728x90'))){$colum = 4;  $num_res = 4;}

  $retstr .= "var options = new Array();
         options['affiliate'] = '".$client."';
         options['width'] = '".$width."';
         options['height'] = '".$height."';
         options['num_col'] = ".$colum.";
         options['num_results'] = ".$num_res.";
         options['border_color'] = '".$color_border."';
         options['body_color'] = '".$color_bg."';
         options['text_color'] = '".$color_text."';
         options['link_color'] = '".$color_link."';
         options['url_color'] = '".$color_url."';
         options['search_terms'] = '';
         options['font_size'] = '';
         options['font'] = '';
</script>
<script language='javascript' src='http://adcenter.advtise.com/include/context.js'></script>".$ai_after;
  }

  return $retstr;
}

$ai_adsused = 0;

function ai_the_content($content){
  global $doing_rss;
  if(is_feed() || $doing_rss)
    return $content;
  if(strpos($content, "<!--noAdvtise-->") !== false) return $content;
  
  if(is_home() && get_option('ai_home') == "checked=on") return $content;
  if(is_page() && get_option('ai_page') == "checked=on") return $content;
  if(is_single() && get_option('ai_post') == "checked=on") return $content;
  if(is_category() && get_option('ai_cat') == "checked=on") return $content;
  if(is_archive() && get_option('ai_archive') == "checked=on") return $content;
  
  global $ai_adsused, $user_level;
  if(get_option('ai_betatest') == "yes" && $user_level < 8)
    return $content;
  if(get_option('ai_notme') == "yes" && $user_level > 8)
    return $content;

  $numads = get_option('ai_nads');
  if(is_single())
    $numads = get_option('ai_nadspp');

  $content_hold = "";
  if(strpos($content, "<!--Advtisestart-->") !== false){
    $content_hold = substr($content, 0, strpos($content, "<!--Advtisestart-->"));
    $content = substr_replace($content, "", 0, strpos($content, "<!--Advtisestart-->"));
  }
  
  $padspace = get_option('ai_space');
  
while($ai_adsused < $numads){
  	if(get_option('ai_lra') == "top-left"){
  	$replacer = $content_hold;
  	$replacer .= '<div style="float: left;margin: '.$padspace.'px;">';
  	$replacer .= ai_genadcode();
  	$replacer .= '</div>';
  	$ai_adsused++;
  	return $replacer.$content;
  }
  if(get_option('ai_lra') == "top-right"){
  	$replacer = $content_hold;
  	$replacer .= '<div style="float: right;margin: '.$padspace.'px;">';
  	$replacer .= ai_genadcode();
  	$replacer .= '</div>';
  	 $ai_adsused++;
  	return $replacer.$content;
  }
  if(get_option('ai_lra') == "top-center"){
  	$replacer = $content_hold;
  	$replacer .= '<div style="text-align: left;margin: '.$padspace.'px;">';
  	$replacer .= ai_genadcode();
  	$replacer .= '</div>';
  	$ai_adsused++;
  	return $replacer.$content;
  }
  if(get_option('ai_lra') == "bottom-left"){
  	$replacer = $content_hold.$content;
  	$replacer .= '<div style="float: left;margin: '.$padspace.'px;">';
  	$replacer .= ai_genadcode();
  	$replacer .= '</div>';
  	$ai_adsused++;
  	return $replacer;
  }
  if(get_option('ai_lra') == "bottom-right"){
  	$replacer = $content_hold.$content;
  	$replacer .= '<div style="float: right;margin: '.$padspace.'px;">';
  	$replacer .= ai_genadcode();
  	$replacer .= '</div>';
  	$ai_adsused++;
  	return $replacer;
  }
  if(get_option('ai_lra') == "bottom-center"){
  	$replacer = $content_hold.$content;
  	$replacer .= '<div style="text-align: left;margin: '.$padspace.'px;">';
  	$replacer .= ai_genadcode();
  	$replacer .= '</div>';
  	$ai_adsused++;
  	return $replacer;
  }

  //while($ai_adsused < $numads){
    $poses = array();
    $lastpos = -1;
    $repchar = "<p";
    if(strpos($content, "<p") === false)
      $repchar = "<br";

    while(strpos($content, $repchar, $lastpos+1) !== false){
      $lastpos = strpos($content, $repchar, $lastpos+1);
      $poses[] = $lastpos;
    }
    
    //cut the doc in half so the ads don't go past the end of the article.  It could still happen, but what the hell
    $half = sizeof($poses);
    $adsperpost = $ai_adsused+1;
    if(!is_single())
      $half = sizeof($poses)/2;

    while(sizeof($poses) > $half)
      array_pop($poses);

    $pickme = $poses[rand(0, sizeof($poses)-1)];
    
    $replacewith = ai_pickalign(get_option('ai_lra'));
    $replacewith .= ai_genadcode()."</div>";
    
    $content = substr_replace($content, $replacewith.$repchar, $pickme, 2);
    $ai_adsused++;
    if(!is_single())
      break;
  }

  return $content_hold.$content;
}

add_filter('the_content', 'ai_the_content');

?>