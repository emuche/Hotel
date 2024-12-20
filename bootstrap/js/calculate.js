$(document).ready(function() {
	$('.date').datepicker({ dateFormat: 'dd/M/yy' });

	function full_pix(){
		window_height = $(document).height();
		window_width = $(document).width();

		$('.carousel-inner').css({
			'width': window_width,
			'height': window_height - 55
		});

		
		$('.blockquote-reverse').css({
			'position': 'absolute',
			'bottom': 0,
			'right': 0
		});
	}

	full_pix();

	$(window).resize(function(event) {
		full_pix();
	});



	var grand_total = 0;
	$('.total').each(function() {
		
		grand_total += Number($(this).html()) ;

		$('.grand_total').html(grand_total);
	});

	var room_rate_total = 0;
	$('.room_rate').each(function() {
		
		room_rate_total += Number($(this).html()) ;

		$('.room_rate_total').html(room_rate_total);
	});

	$('#unit_price, #quantity').keyup(function() {
		var unit_price = $('#unit_price').val();
	 	var quantity = $('#quantity').val();
	 	total = unit_price * quantity;
	 	$('#total').val(total);
	});

	$('#room_rate, #no_of_days').keyup(function() {
		var room_rate = $('#room_rate').val();
	 	var no_of_days = $('#no_of_days').val();
	 	total = room_rate * no_of_days;
	 	$('#total').val(total);
	});

	$('#printCheckOut').click(function() {
		$('#CheckOut').printThis({title: '', importCSS: true, importStyle: true });
	});



	$('.drink_sales_category').change(function(event) {
		var category = $(this).val();


		$.post('feedback.php', {category: category}, function(data) {
			$('.drink_sales_bar_product').html(data);
		});

		$('.drink_sales_bar_product').removeAttr('readonly');
		
	});


	$('.drink_sales_bar_product').change(function(event) {
		var drink_name = $(this).val();

		$.post('feedback.php', {drink_name: drink_name}, function(data) {
			$('.drink_sales_description').val(data);
		});
	});



	$('.drink_sales_bar_product').change(function(event) {
		var drink_name = $(this).val();

		$.get('feedback.php', {drink_name: drink_name}, function(data) {
			$('.drink_sales_unit_price').val(data);
		});
	});


























	$('.room_type').change(function(event) {
		var category = $(this).val();


		$.post('feedback.php', {category: category}, function(data) {
			$('.room_number').html(data);
		});

		$('.room_number').removeAttr('readonly');
		
	});


	$('.room_number').change(function(event) {
		var room_number = $(this).val();

		$.post('feedback.php', {room_number: room_number}, function(data) {
			$('.room_description').val(data);
		});
	});



	$('.room_number').change(function(event) {
		var room_number = $(this).val();

		$.get('feedback.php', {room_number: room_number}, function(data) {
			$('.room_rate').val(data);
		});
	});





















































});