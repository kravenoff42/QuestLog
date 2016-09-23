var main = function() {
//	var count=2;
//	var currentItem='';
//	var checkbox= "<a class='done noselect'><i class='material-icons'>&#xE876;</i></a>";
//	var deleteBtn= "<a class='delete noselect'><i class='material-icons'>&#xE872;</i></a>";
//edit button to come
//	var editBtn= '<a class='edit'><i class='material-icons'>&#xE150;</i></a>';
/*
	$('form').submit(function(event) {

		var $input = $(event.target).find('input');
		var comment = $input.val();

		if (comment != '') {
			var html = $('<li>').html(checkbox + "<span class='list'>"+ comment +"</span>" + deleteBtn).attr('id', 'item'+count).attr('class','items');

			html.appendTo('#list');
			$input.val('');
			count++;
		}
		return false;
	});

	$(document).on('click', '.delete', function(currentItem) {
		currentItem= $(this).parent();
		$(currentItem).remove();
	});

	$(document).on('click', '.done', function(currentItem) {
		currentItem= $(this).next();
		$(this).toggleClass('checked');
		$(currentItem).toggleClass('complete');
	});
/* Edit Function to come
	$(document).on('click', '.edit', function(currentItem) {
		currentItem= $(this).prev();

		var text=$(currentItem).text();
		var newInput = $('<input>').attr()
		$().insertAfter('.done')
	});
	*/
};

$(document).ready(main);
