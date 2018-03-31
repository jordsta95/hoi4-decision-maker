$(document).ready(function(){

	$(".decision_icon").click(function(){
		var attr = $('#gfx-popup').attr('for');
		switch(attr){
			case 'main_icon':
				var gfxid = $(this).attr("id");
				var gfxsrc = $(this).attr("src");
				$("#display-gfx").attr("src",gfxsrc);
				$("#gfx-popup").slideUp();
				$("#chosen-gfx").val(gfxid);
			break;
			case 'category_sub_image':
				var gfxid = $(this).attr("id");
				var gfxsrc = $(this).attr("src");
				$("#display-category-gfx").attr("src",gfxsrc);
				$("#gfx-popup").slideUp();
				$("#category-gfx").val(gfxid);
			break;
			case 'quick_edit':
				var gfxid = $(this).attr("id");
				var gfxsrc = $(this).attr("src");
				$($("#gfx-popup").attr('quickedit')).attr("src",gfxsrc);
				$($("#gfx-popup").attr('quickedit')).next().attr("src",gfxid);
				$("#gfx-popup").slideUp();
				$("#category-gfx").val(gfxid);
			break;
		}
			

	});


	$("#submit-focus").click(function(){
		if($('#add-decision').attr('data-editing') !== 'false' || $('#add-decision').attr('data-editing') !== ''){
			var id = $('#add-decision').attr('data-editing');
			$(id).remove();
		}
		if($('#add-decision').attr('data-category') == 'true'){
			createCategory();
		}else{
			addDecision();
		}
		$('#add-decision').slideUp();
		$('#display-gfx').attr('src', 'images/decision_unknown.png');
		$('#display-category-gfx').attr('src', 'images/decision_unknown.png');
	});

	$('.open[for="add-decision"]').on('click', function(){
		$('#add-decision').attr('data-category','true');
		$('#add-decision').attr('data-editing','false');
		$('#add-decision input,#add-decision textarea').each(function(){
			$(this).val('');
		});
		$('#add-decision #display-category-gfx').attr('src', 'images/decision_unknown.png');
		$('#add-decision #display-gfx').attr('src', 'images/decision_unknown.png')
	});

	$('#open-gfx').on('click', function(){
		$('#gfx-popup').attr('for', 'main_icon');
	});

	$('#category-gfx').on('click', function(){
		$('#gfx-popup').attr('for', 'category_sub_image');
	});

	function createCategory(){
		if($('.working-area .empty').length > -1){
			$('.working-area .empty').remove();
		}
		var catTitle = $('#add-decision #name').val();
		var catImage = $('#add-decision #chosen-gfx').val();
			var catImageSrc = $('#add-decision #display-gfx').attr('src');
		var catDescImage = $('#add-decision #category-gfx').val();
			var catDescImageSrc = $('#add-decision #display-category-gfx').attr('src');
		var catDesc = $('#add-decision #category_description').val();
		var catId = generateId(catTitle);

		var inputName = 'category['+catId+']';

		var category = '<div class="category" id="'+catId+'">';
			category += '<div class="category_header">';
				category += '<img src="'+catImageSrc+'" class="category_image quick_edit_img">';
				category += '<input name="'+inputName+'[img]" value="'+catImage+'" class="for_quick_edit" link="chosen-gfx">'
				category += '<span class="category_title quick_edit">'+catTitle+'</span>';
				category += '<input name="'+inputName+'[title]" value="'+catTitle+'" class="for_quick_edit" link="name">';
				category += '<i class="fa fa-trash-o delete" for=".category"></i>';
				if($('#has_description').prop('checked') == true){
					category += '<div class="description"><img src="'+catDescImageSrc+'" class="category_description_image quick_edit_img">';
					category += '<input name="'+inputName+'[catimg]" value="'+catDescImage+'" class="for_quick_edit" link="category-gfx">';
					category += '<div class="category_description quick_edit_textarea">'+catDesc+'</div>';
					category += '<textarea name="'+inputName+'[catdesc]" class="for_quick_edit" link="category_description">'+catDesc+'</textarea></div>';
				}
			category += '</div>';
			category += '<div class="decisions">';
				category += '<button type="button" class="add_decision" for="'+catId+'">'+$('#add_decision').text()+'</button>';
			category += '</div>';
		category += '</div>';
		$('.working-area').append(category);
	}

	function addDecision(){
		var parentCategory = $('#add-decision').attr('data-category');
		var deTitle = $('#add-decision #name').val();
		var deImage = $('#add-decision #chosen-gfx').val();
			var deImageSrc = $('#add-decision #display-gfx').attr('src');
		var deId = generateId(deTitle);
		var deImage = $('#add-decision #chosen-gfx').val();
		var deDesc = $('#add-decision #decision_description').val();


		var deJson = {};

		$('#add-decision .not_category input,#add-decision .not_category textarea').each(function(){
			var thisId = $(this).attr('id');
			var thisVal = $(this).val();
			deJson[thisId] = thisVal;
		});

		var inputName = 'category['+parentCategory+'][decisions]['+deId+']';

	    var decision = '<div class="decision" id="'+deId+'">';
	    	decision += '<div class="decision_visible">';
	    		decision += '<img src="'+deImageSrc+'" class="category_image quick_edit_img">';
				decision += '<input name="'+inputName+'[img]" class="for_quick_edit" value="'+deImage+'" link="chosen-gfx">'
				decision += '<span class="category_title quick_edit">'+deTitle+'</span>';
				decision += '<input name="'+inputName+'[name]" class="for_quick_edit" value="'+deTitle+'" link="name">';
				decision += '<i class="fa fa-trash-o delete" for=".decision"></i>';
	    	decision += '</div>';
	    	decision += '<div class="decision_data">';
	    		decision += '<textarea class="decision_json" name="'+inputName+'[json]">'+JSON.stringify(deJson)+'</textarea>';
	    	decision += '</div>';
	    	decision += '<div class="decision_hover">';
	    		decision += '<div class="decision_description">';
	    			decision += '<div class="decision_desc quick_edit_textarea">'+deDesc+'</div>';
	    			decision += '<textarea name="'+inputName+'[desc]" class="for_quick_edit">'+deDesc+'</textarea>';
	    		decision += '</div>';
	    		decision += '<div class="decision_name">'+deTitle+'</div>';
	    		decision += '<div class="open edit_decision" for="add-decision">'+$('#edit_decision').text()+'</div>';
	    	decision += '</div>';
	    decision += '</div>';

	    $("#"+parentCategory+' .decisions').prepend(decision);
	}


	function generateId(name){
		return name.replace(/\s+/g, '').replace(/[^a-zA-Z_0-9]/g, '').toLowerCase();
	}

	
	/* local storage */
	if(localStorage.getItem('decisions')) {
	  var decisions = localStorage.getItem('decisions');
	  $('.working-area').html(decisions);
	}
	$("#savetostorage").click(function(){
		localStorage.setItem('decisions', $('.working-area').html());
	});
	
	$('.working-area').on('click', '.quick_edit,.quick_edit_textarea', function(){
		if($(this).next().is(':visible')){
			$(this).next().hide();
		}else{
			$(this).next().show();
		}
	});

	$('.working-area').on('click', '.quick_edit_img', function(){
		var parentId = $(this).parent().parent().attr('id');
		var parentClass = $(this).parent().attr('class');
		if($(this).parent().hasClass('description')){
			var parentId = $(this).parent().parent().parent().attr('id');
		}
		var selector = '#'+parentId+' .'+parentClass+' .'+$(this).attr('class').replace(/ /g, '.');
		$("#gfx-popup").attr('for', 'quick_edit');
		$("#gfx-popup").attr('quickedit', selector);
		$("#gfx-popup").slideDown();
	});

	$('.working-area').on('keyup', '.for_quick_edit', function(){
		var text = $(this).val().replace('\n','<br>');
		$(this).prev().html(text);
	});

	$('.working-area').on('click', '.edit_decision', function(){
		var id = '#'+$(this).parent().parent().attr('id');
		var json = $(id+' .decision_json').val();
		var title = $(id+' .category_title').text();
		var img = $(id+' .category_image').next().val();
		var imgSrc = $(id+' .category_image').attr('src');

		$('#add-decision #name').val(title);
		$('#add-decision #chosen-gfx').val(img);
		$('#add-decision #display-gfx').attr('src',imgSrc);

		var json = JSON.parse(json);
		$.each(json, function(id, value){
			console.log(id+': '+value);
			$('#add-decision #'+id).val(value);
		});
		$('#add-decision').attr('data-category',$(this).parent().parent().parent().parent().attr('id'));
		$('#add-decision').attr('data-editing',id);
	});


	$('.errors').on('click', function(){
		if($(this).hasClass('inactive')){
			$(this).removeClass('inactive');
			$(this).addClass('active');
		}else{
			$(this).addClass('inactive');
			$(this).removeClass('active');
			$(this).hide();
		}
	});

	$('#export-files').on('click', function(){
		var id = $('#unique-id').val();
		var lang = $('#language').val();
		var html = '<input name="unique-id" value="'+id+'"><input name="language" value="'+lang+'">';
		$('.export_options').html(html);
		$('#export_file_form').submit();
	});


	//Custom GFX
	File.prototype.convertToBase64 = function(callback){
            var reader = new FileReader();
            reader.onload = function(e) {
                 callback(e.target.result)
            };
            reader.onerror = function(e) {
                 callback(null, e);
            };        
            reader.readAsDataURL(this);
    };

	$(".custom_gfx").on("change",function(){
		var gfxid = $(this).attr("id");
		var linkId = $(this).attr('link');
		var valId = $(this).attr('input');
		var selectedFile = this.files[0];
		selectedFile.convertToBase64(function(base64){
			var b64 = gfxid.replace("image","base64");
			var display = gfxid.replace("image","display");
			if(base64.substring(0,15) == "data:image/png;"){
				$(linkId).attr('src',base64);
				$("#chosen-gfx").val(base64);
			}else{
				alert("The image you have uploaded is not a PNG");	
			}
		  }); 
	});

});