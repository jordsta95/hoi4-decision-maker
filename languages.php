<?php
$lang = array(
	"EN" => array(
		"title" => "HOI4 Decision Tool",
		"description" => "Tool for creating decisions for your mod in Hearts of Iron IV",
		"main_header" => 'Your Decisions',
		"nothing_to_show" => "Nothing to show",
		"confirm_delete" => "Are you sure you want to delete this? This action cannot be undone.",
		"done" => "Done",
		"builder" => "Builder",
		"search" => "Search",
		"submit" => "Submit",
		"builder_search" => "After searching, click the output to see the example, click the example to add it to the builder\nAll items in the builder are only available in English for now.",
		"decision" => array(
			"add_category" => "Add Category",
			"add_decision" => "Add Decision",
			"edit_decision" => "Edit Decision",
			"labels" => array(
				"name" => "Name",
				"gfx" => "Choose GFX",
				"gfx_choose" => "Or choose your own",
				"gfx_size" => "Custom decision GFX needs to be in a PNG format with a recommended Width: 50px Height: 50px",
				'gfx_category_description' => "Choose description GFX",
				"gfx_category_size" => "Custom decision GFX needs to be in a PNG format with a recommended Width: 150px Height: 150px",
				"description" => "Description",
				"allowed" => "Allowed",
				"available" => "Available",
				"complete_effect" => "Complete Effect",
				"timeout_effect" => "Timeout Effect",
				"cost" => "Political Power Cost",
				"fire_once" => "Decision can only be done once?",
				"days_remove" => "Days decision is active for",
				"days_remove_subtext" => "Set to -1 to always be active",
				"days_re_enable" => "Days until decision can be activated again",
				"ai_will_do" => "AI Will Do Factor",
				"visible" => "What nation(s) can see this decision?",
				"modifier" => "Effects when decision active",
				"remove_trigger" => "When will decision be removed",
				"has_description" => "This category has a description",
			)
		),
		"export" => array(
			"export" => "Export",
			"help_title" => "Export Help",
			"local_storage" => "Saving to local storage will allow you to leave this page, and return with your focus tree exactly how you left it.",
			"zip" => "Exporting to file will export a zip file.\nYou will have 1 folder inside the zip file, and 4 sub-folders.\nThose 4 sub-folders will need to be dragged into your mod's main directory.\n If you have uploaded a custom icon, you may need to re-save the .tga file with a different encoding format if it doesn't appear in game.",
			"unique_id" => "ASCII character only ID for all files.\nThis wants to be unique to ensure your files don't conflict with other mods.",
			"language" => "Language",
			"languages" => array(
				"english" => "English",
				"braz_por" => "Portuguese",
				"german" => "German",
				"polish" => "Polish",
				"russian" => "Russian",
				"spanish" => "Spanish",
				"french" => "French",
			),
		),
		"help" => array(
			"title" => "How to use this tool",
			"category" => "Categories",
			"category_text" => "Categories contain many decisions, and can be minimized in game to hide the decisions. E.g. Economic Policy.\nYou can add a category from the menu using the button labeled Add Category.",
			"decisions" => "Decisions",
			"decisions_text" => "Once you have added a category, you will be able to add decisions to the category using the Add Decision button which shows at the bottom of the category's box.",
		),
		"help_out" => array(
			"title" => "Help Out",
			"coding" => "Help out with coding",
			"coding_text" => "Helping with coding could make the tool grow and evolve much faster, if you understand Javascript/jQuery and/or PHP, as well as basic CSS and HTML you may be able help out.\nThe code behind this tool is available <a href=\"https://github.com/jordsta95/hoi4-decison-maker/\">on GitHub</a>",
			"translate" => "Know another language?",
			"translate_text" => "Help by expanding this tool's reach, by localising it for people who do not understand English", // Note for translators, feel free to put a shoutout to yourself here, e.g. "... like MyNameHere did, who is awesome. Follow them on Twitter: @MyNameHere"
			"beg" => "Help keep the site running",
			"beg_text" => "Being web-based, this tool requires a server to run on. And when it comes to websites, I will never put anything on it which I wouldn't want to see myself, which means no adverts.\n$10 a month is all it costs to keep this tool online. I am more than happy to pay this myself, though any donations towards the upkeep are greatly appreciated, and I will find a way to honour anyone who donates.",
			"donations" => array(
				'<a class="donate" href="https://www.paypal.me/hoi4modding" target="_blank">Donate</a>',
				//Note to translators, feel free to add your own link here, just change the button text to "Donate to Translator", or something similar
			),
		),
	)
);
?>