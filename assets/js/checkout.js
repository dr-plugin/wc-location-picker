(function ($) {

	// $('body').on('updated_checkout', function () {
	// 	var courierShipping = $('.woocommerce-shipping-methods [id*="courier_shipping"]');

	// 	if (courierShipping.length && courierShipping.prop('checked')) {
	// 		$('#location_field').show();
	// 	} else {
	// 		$('#location_field').hide();
	// 	}
	// });

	$('#location').click(function () {
		$('#mapWrap').addClass('show');

		var iframe = $('#mapWrap iframe');
		if (iframe.attr('src') === '') {
			iframe.attr('src', iframe.attr('data-src'));
		}
	});

	$('#mapWrap').click(function () {
		$(this).removeClass('show');
	});

})(jQuery)

window.addEventListener('message', function (event) {
	if (event.data.lat !== undefined) {

		var coordinate = {
			lat: event.data.lat,
			lng: event.data.lng
		};

		var locVal = JSON.stringify(coordinate);
		var locationInput = document.getElementById('location');
		locationInput.setAttribute('value', locVal);
		locationInput.setAttribute('placeholder', 'مختصات ذخیره شد');

		var map = document.getElementById('mapWrap');
		map.classList.remove('show');
	}
});


