$(document).ready(function(){

	$(document).on('click', '.open', function(){
		var id = '#'+$(this).attr('for');
		$(id).slideDown();
	});
	$('.close').on('click', function(){
		var id = '#'+$(this).attr('for');
		$(id).slideUp();
	});

	$('.open_builder').on('focus', function(){
		var id = '#'+$(this).attr('for');
		$(id).slideDown();
		$('#submit-build').attr('build', $(this).attr('builder'));
	});

	$('.working-area').on('click', '.add_decision', function(){
		$('#add-decision').attr('data-category', $(this).attr('for'));
		$('#add-decision input,#add-decision textarea').each(function(){
			$(this).val('');
		});
		$('#add-decision').slideDown();
	});

	$('#has_description').on('change', function(){
		if($(this).prop('checked') == true){
			$('.category_has_description').attr('data-description', 'true');
		}else{
			$('.category_has_description').attr('data-description', 'false');
		}
	});

	$('#fire_once').on('change', function(){
		if($(this).prop('checked') == true){
			$('#days_re_enable_wrapper').hide();
		}else{
			$('#days_re_enable_wrapper').show();
		}
	});


	$('.working-area').on('click', '.delete', function(){
		var toDelete = $(this).attr('for');
		var confirm = window.confirm($('#confirm_delete').text());
		if(confirm == true){
			$(this).closest(toDelete).remove();
		}
	});

	$('#searchjson').keyup(function(){
		var searchField = $('#searchjson').val();
		var regex = new RegExp(searchField, "i");
		var count = 1;
		var output = "";
		$.getJSON("output.json", function(data) {
			$.each(data, function(key, val){
				if ((val.description.search(regex) != -1)) {
			 		output += '<p class="build-description" id="'+val.id+'" tag="'+val.uses_tag+'" state="'+val.uses_state+'" >'+val.description+'</p>';
					output += '<div class="default-outcome" id="'+val.id+'_defaultoutcome">'+val.default_outcome+'</div>';
					output += '<div class="build-hover" id="'+val.id+'_hover">'+val.example+'</div>';
				}
			});
			$('#searchoutput').html(output);
		}); 
	});
	
	$(document).on('click', ".build-description", function() {
		var buildid = $(this).attr("id");
		$("#"+buildid+"_hover").toggle();
	});
	
	$(document).on('click', ".build-hover", function() {
		var id = $(this).attr("id").replace("_hover","");
		if($("#"+id).attr("tag") == "yes"){
				$("#tag-box").show();
		}
		if($("#"+id).attr("state") == "yes"){
				$("#state-box").show();
		}
		if($("#"+id+"_defaultoutcome").attr("iscustom") !== "yes"){
			if($("#"+id+"_defaultoutcome").text() == "new-level"){
				$(".current-build-add-location").removeClass("current-build-add-location").append(id+' = {<br><div class="current-build-add-location"></div><br>}');
			}else{
				$(".current-build-add-location").append(id+'<textarea id="add-build">'+$("#"+id+"_defaultoutcome").text()+'</textarea>');
			}
		}else{
			$(".current-build-add-location").append('<textarea id="add-build">'+$("#"+id+"_defaultoutcome").text()+'</textarea>');
		}
		$("#submit-build").show();
	});
	
	//TAG search
	$('#searchtags').keyup(function(){
		var searchField = $('#searchtags').val();
		var regex = new RegExp(searchField, "i");
		var count = 1;
		var output = "";
		$.getJSON("tags.json", function(data) {
			$.each(data, function(key, val){
				if ((val.country.search(regex) != -1) || (val.tag.search(regex) != -1)) {
			 		output += '<p id="'+val.tag+'" class="searched_tags">'+val.country+'</p>';
				}
			});
			$('#tagsearchoutput').html(output);
		}); 
	});
	
	$(document).on('click', ".searched_tags", function() {
		var tagid = $(this).attr("id");
		$("#build-preview").html($("#build-preview").html().replace("TAG",tagid));
		if ( $( "#add-build" ).length ) {
			$("#add-build").val($("#add-build").val().replace("TAG",tagid));
		}
		$("#tag-box").hide();
	});
	
	//State search
	$('#searchstates').keyup(function(){
		var searchField = $('#searchstates').val();
		var regex = new RegExp(searchField, "i");
		var count = 1;
		var output = "";
		$.getJSON("states.json", function(data) {
			$.each(data, function(key, val){
				if ((val.id.search(regex) != -1) || (val.name.search(regex) != -1)) {
			 		output += '<p id="state_'+val.id+'" class="searched_states">'+val.name+'</p>';
				}
			});
			$('#statesearchoutput').html(output);
		}); 
	});
	
	$(document).on('click', ".searched_states", function() {
		var tagid = $(this).attr("id").replace("state_","");
		$("#build-preview").html($("#build-preview").html().replace("STATEID",tagid));
		$("#build-preview").html($("#build-preview").html().replace("state_id",tagid));
		if ( $( "#add-build" ).length ) {
			$("#add-build").val($("#add-build").val().replace("STATEID",tagid));
			$("#add-build").val($("#add-build").val().replace("state_id",tagid));
		}
		$("#state-box").hide();
	});
	
	
	//Submit
	$("#submit-build").click(function(){
		//#build-preview
		var buildvalue = $("#add-build").val();
		$("#add-build").after(buildvalue);
		$("#add-build").remove();
		$("#"+$(this).attr("build")).val($("#"+$(this).attr("build")).val()+$("#build-preview").text());
		$("#build-preview").empty();
		$("#build-preview").addClass("current-build-add-location");
		$(this).attr("build","null");
		$("#builder").hide();
		$(this).hide();
	});

});