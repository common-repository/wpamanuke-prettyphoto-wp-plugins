jQuery(document).ready(function(){
	// Load Standard
	if (Amanuke_PP.autoplay=="true")
		Amanuke_PP.autoplay = true;
	else	
		Amanuke_PP.autoplay = false;
	if (Amanuke_PP.autoplay_slideshow=="true")
		Amanuke_PP.autoplay_slideshow = true;
	else	
		Amanuke_PP.autoplay_slideshow = false;
	if (Amanuke_PP.theme=="")
		Amanuke_PP.theme = "facebook";
	if (Amanuke_PP.opacity=="")
		Amanuke_PP.opacity = "0.8";
	if (Amanuke_PP.slideshow=="")
		Amanuke_PP.slideshow = "5000";
    jQuery("a[class^='amanuke_prettyPhoto']").prettyPhoto({hook: 'class',theme: Amanuke_PP.theme,autoplay:Amanuke_PP.autoplay,autoplay_slideshow:Amanuke_PP.autoplay_slideshow,opacity:parseFloat(Amanuke_PP.opacity),slideshow:parseFloat(Amanuke_PP.slideshow)});
});
