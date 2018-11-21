(function() {
  
  // Get URL and hash
  var url = window.location.href;
  var hash = window.location.hash;
  var hashCleaned = window.location.hash.replace("#", "");
  
  // Get elements to show/hide and button wrapper
	var $circles = $('#Map g[id^="c-"]');
	var $buttons = $('#buttons');
  
  // set up tag array
	var tagged = {}; 

  // loop through circles
	$circles.each(function() {
		var img = this;
		var tags = $(this).data('tags');
    
    // Get the tags of the circles
		if (tags) {
			tags.split(',').forEach(function(tagName) {
				if(tagged[tagName] == null) {
					tagged[tagName] = [];
				}
				tagged[tagName].push(img); 
			});
		}
    
	});
  
  // On load: show circles matching URL hash
	if(hashCleaned.length >= 2){
		if($('#Map g[id^="c-"]').data('tags') == hashCleaned){

			// Show circles where URL hash matches
			$circles
				.hide()
				.filter(tagged[hashCleaned])
				.show();

		}
		// If URL hash == All / If URL hash is empty; show all circles
		else if(hashCleaned == 'All' || hashCleaned === '') {

			$circles
				.show();
		}
		// All other cases; show circles matching URL hash (necessary as bug fix; otherwise only the value 'Wreck' works)
		else {

			 // Show circles where URL hash matches
			$circles
				.hide()
				.filter(tagged[hashCleaned])
				.show();

		}
	}

  // Set up the 'Show All' button
	$('<button/>', {
		text: 'Show All', 
		class: 'active showAll',
    // On click; show all and set active button class
		click: function() {
			$(this) 
			.addClass('active')
			.siblings()
			.removeClass('active');
      
      // Show all circles
      $circles.show();
      
      // Set hash value to show all
      window.location.hash = '#All';
		}
	}).appendTo($buttons);

  // Set up the other buttons with relevant tag names
	$.each(tagged, function(tagName) {
		$('<button/>', {
			text: tagName + ' (' + tagged[tagName].length + ')',
			class: tagName,
      // On click; hide all circles, show circles with corresponding tags and set active button class
			click: function() {
				$(this)
				.addClass('active')
				.siblings()
				.removeClass('active');
        
          // Show relevant circles
          $circles
          .hide()
          .filter(tagged[tagName])
          .show();
        
        // Set hash value to current tag
        window.location.hash = '#' + tagName;
			}
		}).appendTo($buttons);
	});

}());