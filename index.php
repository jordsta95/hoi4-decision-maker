<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<?php include 'languages.php'; 
if(empty($_GET['lang'])){
	$lang =  $lang['EN'];
}else{
	if(empty($lang[$_GET['lang']])){
		$lang = $lang['EN'];
	}else{
		$lang = $lang[$_GET['lang']];
	}
}
?>
<title><?php echo $lang['title']; ?></title>
<meta name="description" content="<?php echo $lang['description']; ?>">
<?php include 'php/head.php'; ?>
</head> 
<body>
<div class="page-container">
<div class="popup_container_wrapper">
	<div class="popup_container">
	   	<div id="add-decision" class="popup" data-category="true">	
			<div class="panel" style="left:265px">
				<div class="panel-head">
				<p class="close-button close" for="add-decision">X</p>
					<h3 class="is_category"><?php echo $lang['decision']['add_category']; ?></h3>
					<h3 class="not_category"><?php echo $lang['decision']['add_decision']; ?></h3>
				</div>
				<div class="panel-body">
					<div>
						<p><?php echo $lang['decision']['labels']['name']; ?></p>
						<input id="name" />
					</div>
					<div>
						<button id="open-gfx" class="open" for="gfx-popup" type="button"><?php echo $lang['decision']['labels']['gfx']; ?></button>
						<input id="chosen-gfx" value="decision_unknown" hidden />
						<img src="images/decision_unknown.png" id="display-gfx" />
						<br /><label for="customgfx"><?php echo $lang['decision']['labels']['gfx_choose']; ?></label><br /> <input class="custom_gfx" name="customgfx" id="customgfx" type="file" link="#display-gfx" input="#chosen-gfx" /><br />
						<p><?php echo $lang['decision']['labels']['gfx_size']; ?></p>
					</div>
					<div class="is_category no_border">
						<div>
							<label><p><?php echo $lang['decision']['labels']['has_description']; ?></p>
							<input id="has_description" type="checkbox" value="yes"></label>
						</div>
						<div class="category_has_description no_border" data-description="false">
							<div>
								<button type="button" id="category-gfx" class="open" for="gfx-popup"><?php echo $lang['decision']['labels']['gfx_category_description']; ?></button>
								<input id="category-gfx" value="decision_unknown" hidden />
								<img src="images/decision_unknown.png" id="display-category-gfx" />
								<br /><label for="customcategorygfx"><?php echo $lang['decision']['labels']['gfx_choose']; ?></label><br /> <input class="custom_gfx" name="customcategorygfx" id="customcategorygfx" type="file" link="#display-category-gfx" input="#chosen-gfx" /><br />
								<p><?php echo $lang['decision']['labels']['gfx_category_size']; ?></p>
							</div>
							<div>
								<p><?php echo $lang['decision']['labels']['description']; ?></p>
								<textarea id="category_description"></textarea>
							</div>
						</div>
					</div>
					<div class="not_category no_border">
						<div>
							<p><?php echo $lang['decision']['labels']['description']; ?></p>
							<textarea id="decision_description" class="open"></textarea>
						</div>
						<div>
							<p><?php echo $lang['decision']['labels']['allowed']; ?></p>
							<textarea id="allowed" class="open open_builder" for="builder" builder="allowed"></textarea>
						</div>
						<div>
							<p><?php echo $lang['decision']['labels']['available']; ?></p>
							<textarea id="available" class="open open_builder" for="builder" builder="available"></textarea>
						</div>
						<div>
							<p><?php echo $lang['decision']['labels']['visible']; ?></p>
							<textarea id="visible" class="open open_builder" for="builder" builder="visible"></textarea>
						</div>
						<div>
							<p><?php echo $lang['decision']['labels']['complete_effect']; ?></p>
							<textarea id="complete_effect" class="open open_builder" for="builder" builder="complete_effect"></textarea>
						</div>
						<div>
							<p><?php echo $lang['decision']['labels']['timeout_effect']; ?></p>
							<textarea id="timeout_effect" class="open open_builder" for="builder" builder="timeout_effect"></textarea>
						</div>
						<div>
							<p><?php echo $lang['decision']['labels']['cost']; ?></p>
							<input id="cost" type="number" value="0" step="1" />
						</div>
						<div>
							<p><?php echo $lang['decision']['labels']['days_remove']; ?></p>
							<input id="days_remove" type="number" step="1" value="0" />
							<p><?php echo $lang['decision']['labels']['days_remove_subtext']; ?></p>
						</div>
						<div>
							<label><p><?php echo $lang['decision']['labels']['fire_once']; ?></p>
							<input id="fire_once" type="checkbox" value="yes"></label>
						</div>
						<div id="days_re_enable_wrapper">
							<p><?php echo $lang['decision']['labels']['days_re_enable']; ?></p>
							<input id="days_re_enable" type="number" step="1" value="0" />
						</div>
						<div>
							<p><?php echo $lang['decision']['labels']['ai_will_do']; ?></p>
							<textarea id="ai_will_do" class="open open_builder" for="builder" builder="ai_will_do"></textarea>
						</div>
						<div>
							<p><?php echo $lang['decision']['labels']['modifier']; ?></p>
							<textarea id="modifier" class="open open_builder" for="builder" builder="modifier"></textarea>
						</div>
						<div>
							<p><?php echo $lang['decision']['labels']['remove_trigger']; ?></p>
							<textarea id="remove_trigger" class="open open_builder" for="builder" builder="remove_trigger"></textarea>
						</div>
					</div>
					<div class="no_border">
						<button type="button" id="submit-focus"><?php echo $lang['submit']; ?></button>
					</div>
				</div>
			</div>
		</div>
		<div id="gfx-popup" class="popup" for="default">
			<div class="panel">
				<div class="panel-head">
					<p class="close-button close" for="gfx-popup">X</p>
					<h3><?php echo $lang['decision']['labels']['gfx']; ?></h3>
				</div>
				<div class="panel-body">
					<div id="choosegfx">
						<?php
						$directory = 'images/';
						$scanned_directory = array_diff(scandir($directory, 1), array('..', '.'));
						foreach ($scanned_directory as $value) {
							$file = 'images/' . $value;
							$id = str_replace(".png","",$value);
							echo '<img id="'.$id.'" class="decision_icon" src="'.$file.'" />';
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<div id="export-help-box" class="popup">	
			<div class="panel" style="left:265px">
				<div class="panel-head">
				<p id="export-help-box-close" class="close-button close" for="export-help-box">X</p>
					<h3><?php echo $lang['export']['help_title']; ?></h3>
				</div>
				<div class="panel-body">
					<p><?php echo $lang['export']['local_storage']; ?></p>
					<!--<p>Saving to server will allow you to save your current focus tree to the server, and access it from any location using the password you will be given once the focus tree has saved.</p>-->
					<p><?php echo nl2br($lang['export']['zip']); ?></p>
				</div>
			</div>
		</div>
		<div id="help-box" class="popup">
			<div class="panel" style="left:265px">
				<div class="panel-head">
				<p id="help-box-close" class="close-button close" for="help-box">X</p>
					<h3><?php echo $lang['help']['title']; ?></h3>
				</div>
				<div class="panel-body">
					<h4><?php echo $lang['help']['category']; ?></h4>
					<p><?php echo $lang['help']['category_text']; ?></p>
					<h4><?php echo $lang['help']['decisions']; ?></h4>
					<p><?php echo $lang['help']['decisions_text']; ?></p>
				</div>
			</div>
		</div>
		<div id="builder" class="popup">
			<div class="panel">
				<div class="panel-head">
				<p id="builder-close" class="close-button close" for="builder">X</p>
					<h3><?php echo $lang['builder']; ?></h3>
				</div>
				<div class="panel-body">
					<p><?php echo $lang['search']; ?></p>
					<p><input id="searchjson" /></p>
					<small><?php echo $lang['builder_search']; ?></small>
					<div id="searchoutput">
					</div>
					<div id="build-output" style="margin-top:2rem;">
						<div id="build-preview" class="current-build-add-location">
						</div>
						<button type="button" id="submit-build" build="null"><?php echo $lang['submit']; ?></button>
					</div>
				</div>
			</div>
		</div>
		<div id="tag-box" class="popup">
			<div class="panel">
				<div class="panel-head">
				<p id="tag-box-close" class="close-button close" for="tag-box">X</p>
					<h3>TAG Selector</h3>
				</div>
				<div class="panel-body">
					<p>Search for a country</p>
					<p><input id="searchtags" /></p>
					<div id="tagsearchoutput">
					</div>
				</div>
			</div>
		</div>
		<div id="state-box" class="popup">
			<div class="panel">
				<div class="panel-head">
				<p id="state-box-close" class="close-button close" for="state-box">X</p>
					<h3>State Selector</h3>
				</div>
				<div class="panel-body">
					<p>Search for a state name</p>
					<p><input id="searchstates" /></p>
					<div id="statesearchoutput">
					</div>
				</div>
			</div>
		</div>
		<div id="export-box" class="popup">
			<div class="panel" style="left:265px">
				<div class="panel-head">
				<p id="export-box-close" class="close-button close" for="export-box">X</p>
					<h3><?php echo $lang['export']['export']; ?></h3>
				</div>
				<div class="panel-body">
					<div id="to_export">
						<p><?php echo $lang['export']['unique_id']; ?></p>
						<p><input name="unique-id" id="unique-id" /></p>
						<p><?php echo $lang['export']['language']; ?></p>
						<select id="language" name="language">
							<option id="english"><?php echo $lang['export']['languages']['english']; ?></option>
							<option id="french"><?php echo $lang['export']['languages']['french']; ?></option>
							<option id="german"><?php echo $lang['export']['languages']['german']; ?></option>
							<option id="polish"><?php echo $lang['export']['languages']['polish']; ?></option>
							<option id="russian"><?php echo $lang['export']['languages']['russian']; ?></option>
							<option id="spanish"><?php echo $lang['export']['languages']['spanish']; ?></option>
							<option id="braz_por"><?php echo $lang['export']['languages']['braz_por']; ?></option>
						</select>
					</div>
					<p><button type="button" id="export-files"><?php echo $lang['export']['export']; ?></button></p>
				</div>
			</div>
		</div>
		<div id="help-out-box" class="popup">
			<div class="panel" style="left:265px">
				<div class="panel-head">
					<p class="close-button close" for="help-out-box">X</p>
					<h3><?php echo $lang['help_out']['title']; ?></h3>
				</div>
				<div class="panel-body">
					<h4><?php echo $lang['help_out']['coding']; ?></h4>
					<p><?php echo nl2br($lang['help_out']['coding_text']); ?></p>

					<h4><?php echo $lang['help_out']['translate']; ?></h4>
					<p><?php echo nl2br($lang['help_out']['translate_text']); ?></p>

					<h4><?php echo $lang['help_out']['beg']; ?></h4>
					<p><?php echo nl2br($lang['help_out']['beg_text']); ?></p>
					<p style="text-align:center;margin-top:2.5rem;">
						<?php foreach($lang['help_out']['donations'] as $link): 
							 echo $link;
						 endforeach; ?>
					</p>
				</div>
			</div>
		</div>
		<div id="editing"></div>
	</div>
</div>
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
             <!--header start here-->
				<div class="header-main">
					<h3><?php echo $lang['main_header']; ?></h3>
				</div>
				<form action="zip.php" method="POST" target="_blank" id="export_file_form">
					<div class="working-area">
						<div class="empty"><?php echo $lang['nothing_to_show']; ?></div>
					</div>
					<div class="export_options">
					</div>
				</form>
<!--heder end here-->
			
<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
</div>
</div>
  <!--//content-inner-->
			<!--/sidebar-menu-->
				<div class="sidebar-menu">
					<header class="logo1">
						<span class="sidebar-icon"> <span class="fa fa-bars"></span> </span> 
					</header>
						<div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
                           <div class="menu">
									<ul id="menu" >
										<li class="open" for="add-decision"><p><i class="fa fa-plus"></i> <span><?php echo  $lang['decision']['add_category']; ?></span></p></li>
									 	<li class="sub-menu" ><p><i class="fa fa-download" aria-hidden="true"></i><span> Save/Export</span> <span class="fa fa-angle-right" style="float: right"></span></p>
											<ul class="sub-menu" >
										  		<li id="savetostorage" ><p>Save To Storage</p></li>
												<li class="open" for="export-box"><p>Export Files</p></li>
												<li class="open" for="export-help-box"><p>Save/Export Help</p></li>
										  	</ul>
										</li>
										<li class="open" for="help-box"><p><i class="fa fa-question"></i>  <span>Help</span></p></li>
										<li class="open" for="help-out-box"><p><span>Help Out</span></p></li>
									</ul>
								</div>
							  </div>	
							</div>
						
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$(".panel").css({"left":"70px"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $(".panel").css({"left":"234px"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
								
							</script>
							<div style="display: none;" id="js-lang-data">
								<span id="add_decision"><?php echo  $lang['decision']['add_decision']; ?></span>
								<span id="edit_decision"><?php echo  $lang['decision']['edit_decision']; ?></span>
								<span id="confirm_delete"><?php echo  $lang['confirm_delete']; ?></span>
							</div>
							

</body>
</html>