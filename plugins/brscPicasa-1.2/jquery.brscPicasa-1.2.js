// brscPicasa v1.2 - jQuery plugin for displaying photos from Google Picasa Web Albums.
// c) 2010-2012 Maciej 'barszcz' Marczewski - www.barszcz.info - maciej@marczewski.net.pl
// Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
(function($) {

	$.fn.brscPicasa = function(options) {

		var name = 'brscPicasa',
			settings = {
				user: '',
				photo_id: '',
				authkey: '',
				// thumbsizes: 32, 48, 64, 72, 104, 144, 150, 160 with 'u' or 'c' suffix (for uncropped (default if no suffix added) or cropped version)
				// sizes: 94, 110, 128, 200, 220, 288, 320, 400, 512, 576, 640, 720, 800, 912, 1024, 1152, 1280, 1440, 1600
				// othersizes: d - original uploaded photo including all original Exif data, 'none' - photo will not be linked to bigger size
				albums_thumbsize: '32c', // values from thumbsizes and sizes
				albums_titles: true,
				photos_thumbsize: '32c', // values from thumbsizes and sizes
				photos_linkedsize: '800', // values from thumbsizes, sizes and othersizes
				photos_titles: false,
				photo_displaysize: '640', // values from thumbsizes and sizes
				photo_linkedsize: 'd', // values from thumbsizes, sizes, othersizes
				photo_title: false,
				classes: {
					link_replacer: '', // added to <div> that will be inserted in place of <a> element in link replacing mode
					container: '', // added to <div> that contains all generated code
					album_list: '', // added to <ul> element that contains list of albums
					photos_list: '', // added to <ul> element that contains list of photos
					list_item: '', // added to <li> element that contains album or photo on list
					thumbnail: '', // added to <img> element that contains thumbnail of album or photo on list
					single_item: '', // added to <div> element that contains single photo (not on lists)
					link_with_image: '', // added to <a> element that contains <img> element inside
					photo: '', // added to <img> element on single photo mode
					title: '' // added to <span> element that contains title of album or photo
				},
				callback: false
			},
			opts = $.extend(true, {}, settings, $.fn.brscPicasa.defaults, options),

			feed_base_url = 'http://picasaweb.google.com/data/feed/base/user/',
			entry_base_url = 'http://picasaweb.google.com/data/entry/base/user/',

			to_load_counter = 0; // this one is increased before every request to Picasa and decreased after reqest is finished

		return this.each(function() {

			var elem = this;W
			function _start() {
				from_link.apply(elem, [opts]);
				if ($.isFunction(opts.callback)) {
					var interval_id;
					interval_id = setInterval(function() {
						if (to_load_counter <= 0) {
							clearInterval(interval_id);
							opts.callback.call(elem);
						}
					}, 100);
				}
			}

			var from_link = function(o) {
					var $this = $(this),
						$links;

					if ($this.is('a[href^="http://picasaweb.google."]') || $this.is('a[href^="https://picasaweb.google."]')) {
						$links = $this;
					} else {
						$links = $this.find('a[href^="http://picasaweb.google."], a[href^="https://picasaweb.google."]');
					}

					$links.each(function() {

						o.authkey = '';
						if (this.search) {
							var params = this.search.replace('?', '').split('&');
							for(var i = 0; i < params.length; i++) {
								param = params[i].split('=');
								if (param[0] === 'authkey') {
									o.authkey = param[1];
									break;
								}
							}
						}

						var pathname = this.pathname;
						// remove first slash
						if (pathname.substr(0, 1) === '/') {
							pathname = pathname.substr(1, pathname.length);
						}
						var path_split = pathname.split('/');
						if (path_split.length == 0 || path_split[0] == '') { // nothing usefull in link
							return;

						} else { // link to normal version of Picasa
							if (path_split.length == 2) { // there is user and albumname in path
								o.user = path_split[0];
								o.album_name = path_split[1];
								if (this.hash) { // there is photoid in path
									o.photo_id = this.hash.replace('#', '');
									o.mode = 'photo';
								} else {
									o.mode = 'photos';
								}
							} else { // there is only username in path
								o.user = path_split[0];
								o.mode = 'albums';
							}
						}

						if (!o.from_link_target) {
							$target = $('<div class="' + name + 'LinkReplacer ' + o.classes.link_replacer + '"></div>');
							$(this).replaceWith($target);
						} else {
							$target = $(o.from_link_target);
						}
						return methods[o.mode].apply($target, [o]);
					});
				}
			}
			_start();

		});

	}

	$.fn.brscPicasa.defaults = {};

})(jQuery);
