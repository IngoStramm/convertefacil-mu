jQuery( function( $ ) {

	var cf_radio_select_input = function() {
		$( '.cf-radio-input' ).change( function(){
			var input = $( this ).attr( 'data-input' );
			$( 'input[name="' + input + '"' ).focus().select();
			cf_atualiza_resultado();
		});
	};

	var cf_change_value = function() {
		$( '.cf-radio-list-item-input' ).keyup( function(){
			var curr_val = $( this ).val();
			if( curr_val !== '' ) {
				cf_atualiza_resultado();
			}
			// console.log('curr_val: ' + curr_val);
		}).blur( function(){
			var curr_val = $( this ).val();
			var default_value = $( this ).attr( 'data-default-value' );
			if( curr_val === '' ) {
				$( this ).val( default_value );
				curr_val = default_value;
				cf_atualiza_resultado();
			}
			// console.log('curr_val: ' + curr_val);
		});
	};

	var cf_atualiza_resultado = function() {
		var total = 0;
		$( '.cf-radio-input:checked' ).each( function() {
			var data_input = $( this ).attr( 'data-input' );
			var val = parseFloat( $( 'input[name="' + data_input + '"' ).val() );
			total += val;
		});
		$( '.cf-total-value-input' ).val( total );
		console.log('total: ' + total);
	};

	var cf_save_itens_calc = function() {
		$( '.cf-save-itens-calc' ).click( function( e ){
			e.preventDefault();
			var options = [];
			var cf_loading = $( '.cf-loading' );
			var cf_save_return_message = $( '.cf-save-return-message' );
			cf_save_return_message.hide().empty();
			cf_loading.show();
			$( '.cf-box' ).each( function() {
				var cf_box = $( this );
				var option = cf_box.attr( 'data-option' );
				var checked = cf_box.find( '.cf-radio-input:checked' );
				// console.log('option: ' + option);
				if( checked.length > 0 ) {
					var data_index = checked.attr( 'data-index' );
					var data_input = checked.attr( 'data-input' );
					var val = parseFloat( $( 'input[name="' + data_input + '"' ).val() );
					options.push({
						option: option,
						data_index: data_index,
						val: val
					});
				}
			});
			$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {
					teste : 'Opa',
					action : 'save_itens_calc',
					options: options
				},
				dataType: 'json',
				success: function( response ) {
					console.log('response.success: ' + response.success);
					// console.log('response.data: ' + response.data);
					// console.log('message: ' + response.data.message);
					console.log('blog_id: ' + response.data.blog_id);
					console.log('message: ' + response.data.message);
					// debug
					// for (var i = response.data.options.length - 1; i >= 0; i--) {
					// 	console.log( 'Updated: ' + response.data.options[i].update );
					// 	console.log( 'Opção: ' + response.data.options[i].option );
					// 	console.log( 'Index: ' + response.data.options[i].data_index );
					// 	console.log( 'Valor: ' + response.data.options[i].value );
					// }
					cf_save_return_message.text( response.data.message ).show();
				},
				complete: function() {
					cf_loading.fadeOut();
				}
			});
		}); // $(.cf-save-itens-calc).click
	};

	$(document).ready(function(){

		cf_radio_select_input();
		cf_change_value();
		cf_save_itens_calc();
		
	}); // $(document).ready

});