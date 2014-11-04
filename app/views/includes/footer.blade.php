<!-- jQuery -->


    {{ HTML::script('js/modernizr.custom.js') }}
    {{ HTML::script('js/html5shiv.js') }}

    {{ HTML::script('js/jquery-1.10.2.min.js') }}
    {{ HTML::script('js/jquery-migrate-1.2.1.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('fancybox/jquery.fancybox.pack-v=2.1.5.js') }}

    {{ HTML::script('js/jquery.easing.1.3.js') }}


    {{HTML::script('http://maps.google.com/maps/api/js?sensor=true') }}
    {{HTML::script('/js/gmaps.js') }}
    {{ HTML::script('js/script.js') }}

<script>
	$(document).ready(function(e) {
		var lis = $('.nav > li');
		menu_focus( lis[0], 1 );

		$(".fancybox").fancybox({
			padding: 10,
			helpers: {
				overlay: {
					locked: false
				}
			}
		});

	});
	</script>
