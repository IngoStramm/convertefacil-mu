jQuery( function( $ ) {

	var cf_masks = function() {
		$( '.number' ).mask( '#####0.00' );
		$( '.money' ).mask( 'R$###.###.##0,00' );
		$( '.percent' ).mask( '##0,00%', { reverse: true } );
	};

	var cf_normalize_list = function() {

		$( '.normalize-ul' ).each( function() {
			var ul = $( this );
			var mirror_ul = ul.attr( 'data-mirror' );
			mirror_ul = $( '.' + mirror_ul );
			if( mirror_ul.length ) {
				ul.find( 'li' ).each( function(i) {
					var li = $( this );
					var mirror_li = mirror_ul.find( 'li' ).eq( i );
					var curr_height =li.height();
					mirror_li.height( curr_height );
					// mirror_li.height( '' );
				});
			}
		});

	};

	var cf_radio_select_input = function() {
		$( '.cf-radio-input' ).change( function(){
			var input = $( this ).attr( 'data-input' );
			$( 'input[name="' + input + '"' ).focus().select();
			cf_atualiza_resultado();
		});
	};

	var cf_radio_list_change_value = function() {
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

	var cf_meta_list_change_value = function() {
		$( '.cf-meta-list-item-input' ).keyup( function(){
			var curr_val = $( this ).val();
			if( curr_val !== '' ) {
				// cf_atualiza_resultado();
			}
			// console.log('curr_val: ' + curr_val);
		}).blur( function(){
			var curr_val = $( this ).val();
			var default_value = $( this ).attr( 'data-default-value' );
			if( curr_val === '' ) {
				$( this ).val( default_value );
				curr_val = default_value;
				// cf_atualiza_resultado();
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
		total = arredonda_casas_decimais( total );
		$( '.cf-total-value-input' ).val( cf_formata_real( total ) );
		// console.log('total: ' + total);
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
					// console.log('response.success: ' + response.success);
					// console.log('response.data: ' + response.data);
					// console.log('message: ' + response.data.message);
					// console.log('blog_id: ' + response.data.blog_id);
					// console.log('message: ' + response.data.message);
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

	var cf_save_metas = function() {
		$( '.cf-save-metas' ).click( function( e ){
			e.preventDefault();

			var valor_medio_por_venda = $( '.cf-valor-medio-por-venda' ).val();
			var custo_medio_produtos = $( '.cf-custo-medio-produtos' ).val();
			var valor_medio_embalagem = $( '.cf-valor-medio-embalagem' ).val();
			var pc_imposto_renda = $( '.cf-porcentagem-imposto-renda' ).val();
			var pc_intermediadores = $( '.cf-porcentagem-intermediadores' ).val();
			var lucro_desejado_mes = $( '.cf-lucro-desejado-mes' ).val();

			var options = {
				option_1 : {
					option: 'valor_medio_por_venda',
					val : valor_medio_por_venda
				},
				option_2 : {
					option: 'custo_medio_produtos',
					val : custo_medio_produtos
				},
				option_3 : {
					option: 'valor_medio_embalagem',
					val : valor_medio_embalagem
				},
				option_4 : {
					option: 'pc_imposto_renda',
					val : pc_imposto_renda
				},
				option_5 : {
					option: 'pc_intermediadores',
					val : pc_intermediadores
				},
				option_6 : {
					option: 'lucro_desejado_mes',
					val : lucro_desejado_mes
				}
			};

			var cf_loading = $( '.cf-loading' );
			var cf_save_return_message = $( '.cf-save-return-message' );


			cf_save_return_message.hide().empty();
			cf_loading.show();
			$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {
					action : 'save_itens_metas',
					options: options
				},
				dataType: 'json',
				success: function( response ) {
					// console.log('response.success: ' + response.success);
					// console.log('response.data: ' + response.data);
					// console.log('message: ' + response.data.message);
					// console.log('blog_id: ' + response.data.blog_id);
					// console.log('message: ' + response.data.message);
					// debug
					// for (var i = response.data.options.length - 1; i >= 0; i--) {
					// 	console.log( 'Updated: ' + response.data.options[i].update );
					// 	console.log( 'Opção: ' + response.data.options[i].option );
					// 	console.log( 'Index: ' + response.data.options[i].data_index );
					// 	console.log( 'Valor: ' + response.data.options[i].value );
					// }
					cf_calc_result_metas();
					cf_save_return_message.text( response.data.message ).show();
				},
				complete: function() {
					cf_loading.fadeOut();
				}
			});
		}); // $(.cf-save-itens-calc).click
	};

	var cf_calc_result_metas = function() {
		var pc_custos_total = 0;

		var total_custo_inicial = parseFloat( $( '.total-custo-inicial' ).val() );
		var total_custo_fixo_mensal = parseFloat( $( '.total-custo-fixo-mensal' ).val() );

		// console.log('total_custo_inicial: ' + total_custo_inicial);
		// console.log('total_custo_fixo_mensal: ' + total_custo_fixo_mensal);

		var valor_medio_embalagem = parseFloat( $( '.cf-valor-medio-embalagem' ).val() );
		var custo_medio_produtos = parseFloat( $( '.cf-custo-medio-produtos' ).val() );
		var valor_medio_por_venda = parseFloat( $( '.cf-valor-medio-por-venda' ).val() );

		// console.log('valor_medio_embalagem : ' + valor_medio_embalagem );
		// console.log('valor_medio_por_venda : ' + valor_medio_por_venda );

		var pc_custo_produtos = custo_medio_produtos / valor_medio_por_venda;
		var pc_custo_embalagem = valor_medio_embalagem / valor_medio_por_venda;
		pc_custo_produtos *= 100;
		// pc_custo_produtos = arredonda_casas_decimais( pc_custo_produtos );
		pc_custo_embalagem *= 100;
		// pc_custo_embalagem = arredonda_casas_decimais( pc_custo_embalagem );

		// console.log('pc_custo_produtos: ' + pc_custo_produtos);

		var pc_imposto_renda = parseFloat( $( '.cf-porcentagem-imposto-renda' ).val() );
		var pc_intermediadores = parseFloat( $( '.cf-porcentagem-intermediadores' ).val() );

		pc_custos_total = pc_intermediadores + pc_imposto_renda + pc_custo_embalagem + pc_custo_produtos;
		// pc_custos_total = arredonda_casas_decimais( pc_custos_total );
		pc_lucro_total = 100 - pc_custos_total;
		// pc_lucro_total =  arredonda_casas_decimais( pc_lucro_total );

		// console.log('pc_custos_total: ' + pc_custos_total);
		// console.log('pc_lucro_total: ' + pc_lucro_total);

		var lucro_desejado_mes = parseFloat( $( '.cf-lucro-desejado-mes' ).val() );

		valor_lucro_total = lucro_desejado_mes + total_custo_fixo_mensal;
		// valor_lucro_total = arredonda_casas_decimais( valor_lucro_total );
		valor_pc_total = valor_lucro_total * 100 / pc_lucro_total;
		// valor_pc_total = arredonda_casas_decimais( valor_pc_total );
		valor_pc_custos_total = valor_pc_total - valor_lucro_total;
		// valor_pc_custos_total = arredonda_casas_decimais( valor_pc_custos_total );

		// console.log('valor_lucro_total: ' + valor_lucro_total);
		// console.log('valor_pc_total: ' + valor_pc_total);
		// console.log('valor_pc_custos_total: ' + valor_pc_custos_total);

		/*
		 *
		 * RESULTADOS
		 *
		 */

		
		// Metas de vendas Desejadas
		var cf_meta_venda = $( '.cf-meta-venda' ); // = valor_pc_total * ( lucro_desejado_mes + total_custo_fixo_mensal ) / ( valor_pc_total - pc_custos_total )
		var resultado_meta_venda =  valor_pc_total * ( lucro_desejado_mes + total_custo_fixo_mensal ) / ( valor_pc_total - valor_pc_custos_total );
		// console.log('resultado_meta_venda: ' + resultado_meta_venda);
		resultado_meta_venda = arredonda_casas_decimais( resultado_meta_venda );
		resultado_meta_venda = isNaN( resultado_meta_venda ) ? 0 : resultado_meta_venda;
		cf_meta_venda.val( cf_formata_real( resultado_meta_venda ) );
		// console.log('lucro_desejado_mes: ' + lucro_desejado_mes);
		// console.log('cf_meta_venda: ' + cf_meta_venda.val());

		
		// Índice de lucratividade
		var cf_indice_lucratividade = $( '.cf-indice-lucratividade' ); // = lucro_desejado_mes / cf_meta_venda
		var resultado_indice_lucratividade = lucro_desejado_mes / resultado_meta_venda;
		resultado_indice_lucratividade *= 100;
		// console.log( 'resultado_indice_lucratividade: ' + resultado_indice_lucratividade );
		resultado_indice_lucratividade = arredonda_casas_decimais( resultado_indice_lucratividade );
		resultado_indice_lucratividade = isNaN( resultado_indice_lucratividade ) ? 0 : resultado_indice_lucratividade;
		cf_indice_lucratividade.val( cf_formata_porcentagem( resultado_indice_lucratividade ) );

		
		// Metas de vendas mínima
		var margem_contribuicao = resultado_meta_venda - valor_pc_custos_total; // resultado_meta_venda - ( resultado_meta_venda * pc_custos_total );
		// console.log('margem_contribuicao: ' + margem_contribuicao);
		var imc = margem_contribuicao / resultado_meta_venda * 100; // margem_contribuicao - cf_meta_venda.val();
		// imc = arredonda_casas_decimais( imc );
		// console.log('imc: ' + imc);
		var cf_meta_minima = $( '.cf-meta-minima' ); // total_custo_fixo_mensal - imc;
		var resultado_meta_minima = total_custo_fixo_mensal / ( imc / 100 );
		resultado_meta_minima = arredonda_casas_decimais( resultado_meta_minima );
		resultado_meta_minima = isNaN( resultado_meta_minima ) ? 0 : resultado_meta_minima;
		cf_meta_minima.val( cf_formata_real( resultado_meta_minima ) );
	};

	var arredonda_casas_decimais = function( valor ) {
		return Math.round( ( valor + 0.00001 ) * 100) / 100;
	};

	var cf_formata_real = function( valor ) {
		valor = valor.toFixed( 2 );
	    valor = valor.toString().replace(/\D/g,'');
	    valor = valor.toString().replace(/(\d)(\d{8})$/,'$1.$2');
	    valor = valor.toString().replace(/(\d)(\d{5})$/,'$1.$2');
	    valor = valor.toString().replace(/(\d)(\d{2})$/,'$1,$2');
	    return 'R$ ' + valor;                  
	};

	var cf_formata_porcentagem = function( valor ) {
		valor = valor.toFixed( 2 );
	    valor = valor.toString().replace(/\D/g,'');
	    valor = valor.toString().replace(/(\d)(\d{2})$/,'$1,$2');
	    return valor + ' %';
	};

	var cf_altera_texto = function() {
		$( '.page-title-action' ).each( function(){
			var curr = $( this );
			// console.log('curr.text(): ' + curr.text());
			if( curr.text() === 'Adicionar existente' ) {
				curr.text( 'Adicionar novo' );
			}
		});
	};

	$(document).ready(function(){

		cf_normalize_list();
		cf_masks();
		cf_radio_select_input();
		cf_radio_list_change_value();
		cf_meta_list_change_value();
		cf_save_itens_calc();
		cf_save_metas();
		cf_calc_result_metas();
		cf_altera_texto();
		
	}); // $(document).ready

	$(window).resize(function(){

		cf_normalize_list();
		
	}); // $(document).resize

});