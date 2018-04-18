jQuery( function( $ ) {

	var verifica_formato_cep = function(val) {
		var verifica = /^[0-9]{5}-[0-9]{3}$/;
		val = $.trim(val);
		if(verifica.test( val )) {
			return true;
		} else {
			return false;
		}
	};


	var autocompletar_endereco = function( cep ) {

		var correios = $.ajax({
			type: 'GET',
			url: '//viacep.com.br/ws/' + cep + '/json/',
			dataType: 'jsonp',
			crossDomain: true,
			contentType: 'application/json'
		});

		// Gets the address.
		correios.done( function ( address ) {

			if( $('.cep-notice').length ) {
				$('.cep-notice').remove();
			}

			if( address.erro ) {
				var msg = $( '<div class="cep-notice"><strong>CEP</strong> não encontrado. Digite outro CEP ou preencha manualmente o restante das informações do endereço.</div>' );

				$( '#cep' ).focus();
				$( '#cep' ).closest( 'div' ).append(msg);

				return;		
			}

			// Address.
			$( '#rua' ).val( address.logradouro ).change();

			// Neighborhood.
			$( '#bairro' ).val( address.bairro ).change();

			// City.
			$( '#cidade' ).val( address.localidade ).change();

			// State.
			$( '#uf option:selected' ).attr( 'selected', false ).change();
			$( '#uf option[value="' + address.uf + '"]' ).attr( 'selected', 'selected' ).change();
			$( '#uf' ).val( address.uf ).change();

			$('#numero').focus();

		}).fail( function( jqXHR, textStatus, errorThrown ){

			console.log( 'jqXHR: ' + jqXHR );
			console.log( 'textStatus: ' + textStatus );
			console.log( 'errorThrown: ' + errorThrown );

		});

	};

	var cep_onchange = function() {
		$( '#cep' ).keyup( function(){
			var cep = $( this ).val();
			if( cep.length === 9 )
			{
				autocompletar_endereco( cep );
			}
		});
	};

	var wrap_pro_sites_checkout_select = function() {
		$( '#prosites-checkout-table ul.pricing-column.psts-level-0 .summary .period-selector .chosen' ).wrap( '<div class="pro-sites-selector-wrapper"></div>' );
	};

	var cf_troca_precos_de_lugar = function() {
		if( $( '#prosites-checkout-table' ).length ) {
			var table = $( '#prosites-checkout-table' );

			table.find( '.pricing-column' ).each( function() {
				var column = $( this );
				var preco_total_3 = column.find( '.price.price_3 .plan-price' );
				var preco_total_3_html = column.find( '.price.price_3 .plan-price' ).html();
				var preco_mensal_3 = column.find( '.level-summary.price_3 .monthly-price' );
				var preco_mensal_3_html = column.find( '.level-summary.price_3 .monthly-price' ).html();
				var preco_total_12 = column.find( '.price.price_12 .plan-price' );
				var preco_total_12_html = column.find( '.price.price_12 .plan-price' ).html();
				var preco_mensal_12 = column.find( '.level-summary.price_12 .monthly-price' );
				var preco_mensal_12_html = column.find( '.level-summary.price_12 .monthly-price' ).html();
				preco_total_3.html( preco_mensal_3_html );
				preco_mensal_3.html( preco_total_3_html );
				preco_total_12.html( preco_mensal_12_html );
				preco_mensal_12.html( preco_total_12_html );
			});
		}
	};

	$(document).ready(function(){
		// Máscaras
		$( '.cpf' ).mask( '000.000.000-00', {clearIfNotMatch: true} );
		$( '.cnpj' ).mask( '00.000.000/0000-00', {clearIfNotMatch: true} );
		$( '.fone' ).mask( '(00) 00009-0000', {clearIfNotMatch: true} );
		$( '.cep' ).mask( '00000-000', {clearIfNotMatch: true} );

		cep_onchange();
		cf_troca_precos_de_lugar();
		wrap_pro_sites_checkout_select();
	}); // $(document).ready
});