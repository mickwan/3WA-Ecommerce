$(function(){
	// Gestion du clic sur le bouton pour ouvrir le menu
	$('.nav-menu-burger').click(function(){
		$(".menu-burger", this).slideToggle(200);
		if ($(".open-menu-burger", this).hasClass('open-burger'))
			$(".open-menu-burger", this).removeClass("open-burger");
		else
			$(".open-menu-burger", this).addClass("open-burger");
	});
});