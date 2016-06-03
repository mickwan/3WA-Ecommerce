$(document).ready(function(){
	$('.valid-button').click(function {
		$('#ajax').load('apps/contents/add_edit_cat.phtml');
	});
});

/*$.get('index.php', ["page":"add_edit_cat","ajax":true], function(data)
	{
		$('#ajax').html(data);
	});*/