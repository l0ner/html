$('document').ready(function(){
	$('.picasaPhoto').each(function(){
		$(this).brscPicasa({
			photos_thumbsize: '64c',
			photo_displaysize: '600',
			photo_title: true,
			classes: {
				link_with_image: 'loaded-link'
			},
			callback: function() {
				$('a.loaded-link img', this).parent().click(function() {
					alert('some lightbox clone could be opening now');
					return false;
				});
			}
		})
	});
});