//https://wordpress.stackexchange.com/questions/342148/list-of-js-events-in-the-woocommerce-frontend


//$('.account-content').on('click', '.edit-tab_head button', function () {

(function ($) {


	  $('body').on('updated_checkout', function () {
        var courierShipping = $('.woocommerce-shipping-methods [id*="courier_shipping"]');

        if ( courierShipping.length && courierShipping.prop('checked') ) {
            //var bilingState = $('#billing_state option:selected').text();//get text selected option
            //console.log('city is ' + bilingState);

            $('#location_field').show();
        } else {
            $('#location_field').hide();
        }
    });


	$('#location').click(function () {
		//console.log('map open');
		$('#mapWrap').addClass('show');

		var iframe = $('#mapWrap iframe');
		if (iframe.attr('src') === '') {
			iframe.attr('src', iframe.attr('data-src'));
		}
	});

	$('#mapWrap').click(function () {
		$(this).removeClass('show');
	});

	//var iframe = $('#mapWrap iframe');
	//iframe.contentWindow.postMessage('hello world', '*');

	// var selectLat = $('#selectLat');
	// selectLat.click(function () {
	//     console.log('select lat');
	// });

})(jQuery)

window.addEventListener('message', function (event) {
	if (event.data.lat !== undefined) {
		//console.log(event.data.lat);
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
	//console.log("Message received from the child: " + event.data); // Message received from child
});


