<!-- jQuery -->


    {{ HTML::script('assets/js/modernizr.custom.js') }}
    {{ HTML::script('assets/js/html5shiv.js') }}

    {{ HTML::script('assets/js/jquery-1.10.2.min.js') }}
    {{ HTML::script('assets/js/jquery-migrate-1.2.1.min.js') }}
    {{ HTML::script('assets/js/bootstrap.min.js') }}
    {{ HTML::script('assets/fancybox/jquery.fancybox.pack-v=2.1.5.js') }}

    {{ HTML::script('assets/js/jquery.easing.1.3.js') }}


    {{HTML::script('http://maps.google.com/maps/api/js?sensor=true') }}
    {{HTML::script('assets/js/gmaps.js') }}
    {{ HTML::script('assets/js/script.js') }}

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
