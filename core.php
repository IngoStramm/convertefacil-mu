<?php

// debug
function cf_debug( $debug ) {
	echo '<pre>';
	var_dump( $debug );
	echo '</pre>';
}

// Tipos de Pessoa (array)
function cf_tipos_pessoa() {
	$tipos = [];
	$tipos['pessoa_fisica'] = __( 'Pessoa Física', 'cf' );
	$tipos['pessoa_juridica'] = __( 'Pessoa Jurídica', 'cf' );
	return $tipos;
}

// HTML select tipos de pessoa
function cf_select_tipos_pessoa( $user ) {
	$tipos_arr = cf_tipos_pessoa();
	?>
	<div class="select-wrapper">
		<select name="tipo_pessoa" id="tipo_pessoa_selector" onchange="toggle_tipo_pessoa(this.value);">
			<?php foreach ( $tipos_arr as $k => $v ) : ?>
				 <option <?php echo esc_attr( get_user_meta( $user->ID, 'tipo_pessoa', true ) ) == $k ? 'selected' : '' ?> value="<?php echo $k ?>" data-tipo-pessoa="<?php echo $k ?>"><?php echo $v ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<!-- /.select-wrapper -->	<script>
		var toggle_tipo_pessoa = function( tipo_pessoa ) {
			tipo_pessoa = tipo_pessoa.replace( '_', '-' );
			jQuery( '.tipo-pessoa' ).hide();
			jQuery( '.tipo-' + tipo_pessoa ).show();
			// console.log( 'tipo: ' + tipo_pessoa ); // debug
		}
		jQuery(document).ready(function(){
			var tipo_pessoa = jQuery( '#tipo_pessoa_selector' ).val();
			toggle_tipo_pessoa( tipo_pessoa );
		}); // jQuery(document).ready
	</script>
	<?php
}

// Estados BR
function cf_estados_br() {
	$estados = [];
	$estados['AC'] = 'Acre';
	$estados['AL'] = 'Alagoas';
	$estados['AP'] = 'Amapá';
	$estados['AM'] = 'Amazonas';
	$estados['BA'] = 'Bahia';
	$estados['CE'] = 'Ceará';
	$estados['DF'] = 'Distrito Federal';
	$estados['ES'] = 'Espírito Santo';
	$estados['GO'] = 'Goiás';
	$estados['MA'] = 'Maranhão';
	$estados['MT'] = 'Mato Grosso';
	$estados['MG'] = 'Minas Gerais';
	$estados['PA'] = 'Pará';
	$estados['PB'] = 'Paraíba';
	$estados['PR'] = 'Paraná';
	$estados['PE'] = 'Pernambuco';
	$estados['PI'] = 'Piauí';
	$estados['RJ'] = 'Rio de Janeiro';
	$estados['RN'] = 'Rio Grande do Norte';
	$estados['RS'] = 'Rio Grande do Sul';
	$estados['RO'] = 'Rondônia';
	$estados['RR'] = 'Roraima';
	$estados['SC'] = 'Santa Catarina';
	$estados['SP'] = 'São Paulo';
	$estados['SE'] = 'Sergipe';
	$estados['TO'] = 'Tocantins';
	return $estados;
}

// HTML select Estados BR
function cf_select_estados_br( $selected = false ) {
	$estados = cf_estados_br(); ?>
	<div class="select-wrapper">
		<select name="uf" id="uf" class="uf">
			<option value=""><?php _e( 'Selecione uma opção…', 'cf' ); ?></option>
			<?php foreach ( $estados as $k => $v) : ?>
				<option value="<?php echo $k; ?>" <?php echo ( $selected == $k ) ? 'selected="selected"' : '' ?>><?php echo $v; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<!-- /.select-wrapper -->
	<?php
}