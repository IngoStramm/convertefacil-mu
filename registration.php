<?php
add_action( 'signup_blogform', 'cf_register_form' );
add_action( 'register_form', 'cf_register_form' );

// Exibe campos no formulário de registro
function cf_register_form() {

	$user_id = get_current_user_id();
	$tipo_pessoa = ( ! empty( $_POST['tipo_pessoa'] ) ) ? sanitize_text_field( $_POST['tipo_pessoa'] ) : '';
	if( empty( $tipo_pessoa ) )
		$tipo_pessoa = get_user_meta( $user_id, 'tipo_pessoa', true );
	?>

	<h2><?php _e( 'Dados Pessoais', 'cf' ); ?></h2>

	<div class="tipo-pessoa-selector">
		<label for="tipo_pessoa"><?php _e( 'Tipo de pessoa', 'cf' ); ?></label>
		<?php cf_select_tipos_pessoa( $tipo_pessoa ); ?>
	</div>
	<!-- /.tipo-pessoa -->
	<?php
		$cpf = ( ! empty( $_POST['cpf'] ) ) ? sanitize_text_field( $_POST['cpf'] ) : '';
		if( empty( $cpf ) )
			$cpf = get_user_meta( $user_id, 'cpf', true );
		$cnpj = ( ! empty( $_POST['cnpj'] ) ) ? sanitize_text_field( $_POST['cnpj'] ) : '';
		if( empty( $cnpj ) )
			$cnpj = get_user_meta( $user_id, 'cnpj', true );
	?>

	<div class="tipo-pessoa tipo-pessoa-fisica">
		<label for="cpf"><?php _e( 'CPF', 'cf' ); ?></label>
		<input type="text" name="cpf" id="cpf" class="cpf" value="<?php echo $cpf; ?>" />
	</div>
	<!-- /.cpf -->

	<div class="tipo-pessoa tipo-pessoa-juridica">
		<label for="cnpj"><?php _e( 'CNPJ', 'cf' ); ?></label>
		<input type="text" name="cnpj" id="cnpj" class="cnpj" value="<?php echo $cnpj; ?>" />
	</div>
	<!-- /.cnpj -->

	<?php
		$fone = ( ! empty( $_POST['fone'] ) ) ? sanitize_text_field( $_POST['fone'] ) : '';
		if( empty( $fone ) )
			$fone = get_user_meta( $user_id, 'fone', true );
	?>

	<div>
		<label for="fone"><?php _e( 'Telefone (com DDD)', 'cf' ); ?></label>
		<input type="text" name="fone" id="fone" class="fone" value="<?php echo $fone; ?>" />
	</div>

	<?php
		$cep = ( ! empty( $_POST['cep'] ) ) ? sanitize_text_field( $_POST['cep'] ) : '';
		if( empty( $cep ) )
			$cep = get_user_meta( $user_id, 'cep', true );
	?>

	<div>
		<label for="cep"><?php _e( 'Cep', 'cf' ); ?></label>
		<input type="text" name="cep" id="cep" class="cep" value="<?php echo $cep; ?>" />
	</div>

	<?php
		$rua = ( ! empty( $_POST['rua'] ) ) ? sanitize_text_field( $_POST['rua'] ) : '';
		if( empty( $rua ) )
			$rua = get_user_meta( $user_id, 'rua', true );
	?>

	<div>
		<label for="rua"><?php _e( 'Rua', 'cf' ); ?></label>
		<input type="text" name="rua" id="rua" class="rua" value="<?php echo $rua; ?>" />
	</div>

	<?php
		$numero = ( ! empty( $_POST['numero'] ) ) ? sanitize_text_field( $_POST['numero'] ) : '';
		if( empty( $numero ) )
			$numero = get_user_meta( $user_id, 'numero', true );
	?>

	<div>
		<label for="numero"><?php _e( 'Número', 'cf' ); ?></label>
		<input type="text" name="numero" id="numero" class="numero" value="<?php echo $numero; ?>" />
	</div>

	<?php
		$bairro = ( ! empty( $_POST['bairro'] ) ) ? sanitize_text_field( $_POST['bairro'] ) : '';
		if( empty( $bairro ) )
			$bairro = get_user_meta( $user_id, 'bairro', true );
	?>

	<div>
		<label for="bairro"><?php _e( 'Bairro', 'cf' ); ?></label>
		<input type="text" name="bairro" id="bairro" class="bairro" value="<?php echo $bairro; ?>" />
	</div>

	<?php
		$cidade = ( ! empty( $_POST['cidade'] ) ) ? sanitize_text_field( $_POST['cidade'] ) : '';
		if( empty( $cidade ) )
			$cidade = get_user_meta( $user_id, 'cidade', true );
	?>

	<div>
		<label for="cidade"><?php _e( 'Cidade', 'cf' ); ?></label>
		<input type="text" name="cidade" id="cidade" class="cidade" value="<?php echo $cidade; ?>" />
	</div>

	<?php
		$uf = ( ! empty( $_POST['uf'] ) ) ? sanitize_text_field( $_POST['uf'] ) : '';
		if( empty( $uf ) )
			$uf = get_user_meta( $user_id, 'uf', true );
	?>

	<div>
		<label for="uf"><?php _e( 'Estado', 'cf' ); ?></label>
		<?php echo cf_select_estados_br( $uf ); ?>
	</div>

	<br />

	<?php
}

add_filter( 'registration_errors', 'cf_registration_errors', 10, 3 );

// Valida os campos
function cf_registration_errors( $errors, $sanitized_user_login, $user_email ) {

	if ( empty( $_POST['tipo_pessoa'] ) || ! empty( $_POST['tipo_pessoa'] ) && trim( $_POST['tipo_pessoa'] ) == '' ) :
		$errors->add( 'tipo_pessoa_error', sprintf('<strong>%s</strong>: %s',__( 'ERROR', 'cf' ),__( 'Você precisa selecionar um tipo de pessoa.', 'cf' ) ) );
	else :
		$tipo_pessoa = $_POST['tipo_pessoa'];
		if( $tipo_pessoa == 'cpf' && empty( $_POST['cpf'] ) || ! empty( $_POST['cpf'] ) && trim( $_POST['cpf'] ) ) :
			$errors->add( 'cpf_error', sprintf('<strong>%s</strong>: %s',__( 'ERROR', 'cf' ),__( 'Digite um CPF válido.', 'cf' ) ) );
		elseif( $tipo_pessoa == 'cnpj' && empty( $_POST['cnpj'] ) || ! empty( $_POST['cnpj'] ) && trim( $_POST['cnpj'] ) ) :
			$errors->add( 'cnpj_error', sprintf('<strong>%s</strong>: %s',__( 'ERROR', 'cf' ),__( 'Digite um CNPJ válido.', 'cf' ) ) );
		endif;
	endif;

	if ( empty( $_POST['fone'] ) || ! empty( $_POST['fone'] ) && trim( $_POST['fone'] ) == '' ) :
		$errors->add( 'fone_error', sprintf('<strong>%s</strong>: %s',__( 'ERROR', 'cf' ),__( 'Digite um número de telefone válido.', 'cf' ) ) );
	endif;

	if ( empty( $_POST['cep'] ) || ! empty( $_POST['cep'] ) && trim( $_POST['cep'] ) == '' ) :
		$errors->add( 'cep_error', sprintf('<strong>%s</strong>: %s',__( 'ERROR', 'cf' ),__( 'Digite um CEP válido.', 'cf' ) ) );
	endif;

	if ( empty( $_POST['rua'] ) || ! empty( $_POST['rua'] ) && trim( $_POST['rua'] ) == '' ) :
		$errors->add( 'rua_error', sprintf('<strong>%s</strong>: %s',__( 'ERROR', 'cf' ),__( 'Digite o nome da sua rua.', 'cf' ) ) );
	endif;

	if ( empty( $_POST['numero'] ) || ! empty( $_POST['numero'] ) && trim( $_POST['numero'] ) == '' ) :
		$errors->add( 'numero_error', sprintf('<strong>%s</strong>: %s',__( 'ERROR', 'cf' ),__( 'Digite o número da sua rua.', 'cf' ) ) );
	endif;

	if ( empty( $_POST['bairro'] ) || ! empty( $_POST['bairro'] ) && trim( $_POST['bairro'] ) == '' ) :
		$errors->add( 'bairro_error', sprintf('<strong>%s</strong>: %s',__( 'ERROR', 'cf' ),__( 'Digite o nome do seu bairro.', 'cf' ) ) );
	endif;

	if ( empty( $_POST['cidade'] ) || ! empty( $_POST['cidade'] ) && trim( $_POST['cidade'] ) == '' ) :
		$errors->add( 'cidade_error', sprintf('<strong>%s</strong>: %s',__( 'ERROR', 'cf' ),__( 'Digite o nome da sua cidade.', 'cf' ) ) );
	endif;

	if ( empty( $_POST['uf'] ) || ! empty( $_POST['uf'] ) && trim( $_POST['uf'] ) == '' ) :
		$errors->add( 'uf_error', sprintf('<strong>%s</strong>: %s',__( 'ERROR', 'cf' ),__( 'Selecione o seu Estado.', 'cf' ) ) );
	endif;

	cf_debug( $errors );

	return $errors;
}

add_action( 'user_register', 'cf_user_register' );

// Salva os dados dos campos no registro
function cf_user_register( $user_id ) {
	if ( ! empty( $_POST['tipo_pessoa'] ) ) :
		update_user_meta( $user_id, 'tipo_pessoa', sanitize_text_field( $_POST['tipo_pessoa'] ) );
	endif;
	if ( ! empty( $_POST['cpf'] ) ) :
		update_user_meta( $user_id, 'cpf', sanitize_text_field( $_POST['cpf'] ) );
	endif;
	if ( ! empty( $_POST['cnpj'] ) ) :
		update_user_meta( $user_id, 'cnpj', sanitize_text_field( $_POST['cnpj'] ) );
	endif;
	if ( ! empty( $_POST['fone'] ) ) :
		update_user_meta( $user_id, 'fone', sanitize_text_field( $_POST['fone'] ) );
	endif;
	if ( ! empty( $_POST['cep'] ) ) :
		update_user_meta( $user_id, 'cep', sanitize_text_field( $_POST['cep'] ) );
	endif;
	if ( ! empty( $_POST['rua'] ) ) :
		update_user_meta( $user_id, 'rua', sanitize_text_field( $_POST['rua'] ) );
	endif;
	if ( ! empty( $_POST['numero'] ) ) :
		update_user_meta( $user_id, 'numero', sanitize_text_field( $_POST['numero'] ) );
	endif;
	if ( ! empty( $_POST['bairro'] ) ) :
		update_user_meta( $user_id, 'bairro', sanitize_text_field( $_POST['bairro'] ) );
	endif;
	if ( ! empty( $_POST['cidade'] ) ) :
		update_user_meta( $user_id, 'cidade', sanitize_text_field( $_POST['cidade'] ) );
	endif;
	if ( ! empty( $_POST['uf'] ) ) :
		update_user_meta( $user_id, 'uf', sanitize_text_field( $_POST['uf'] ) );
	endif;
}

add_action( 'show_user_profile', 'cf_extra_fields' );
add_action( 'edit_user_profile', 'cf_extra_fields' );
add_action( 'personal_options_update', 'cf_save_fields' );
add_action( 'edit_user_profile_update', 'cf_save_fields' );

// Exibe os campos na tela de perfil
function cf_extra_fields( $user ) {
?>
<h3><?php _e( 'Informações Pessoais', 'cf' ); /*DOMAIN = Lang domain for l10n (optional)*/ ?></h3>
<table class="form-table">
	<tbody>
		<tr>
			<th><?php _e( 'Tipo de Pessoa', 'cf' ); /*DOMAIN = Lang domain for l10n (optional)*/ ?></th>
			<td>
				<?php cf_select_tipos_pessoa( $user ); ?>
			</td>
		</tr>
		<?php
		$cpf = get_user_meta( $user->ID, 'cpf', true );
		$cnpj = get_user_meta( $user->ID, 'cnpj', true );
		?>
		<tr class="tipo-pessoa tipo-pessoa-fisica">
			<th><?php _e( 'CPF', 'cf' ); ?></th>
			<td><input name="cpf" type="text" value="<?php echo $cpf; ?>" class="cpf regular-text" /></td>
		</tr>
		<tr class="tipo-pessoa tipo-pessoa-juridica">
			<th><?php _e( 'CNPJ', 'cf' ); ?></th>
			<td><input name="cnpj" type="text" value="<?php echo $cnpj; ?>" class="cnpj regular-text" /></td>
		</tr>
		<?php $fone = get_user_meta( $user->ID, 'fone', true ); ?>
		<tr>
			<th><?php _e( 'Telefone', 'cf' ); ?></th>
			<td><input name="fone" type="text" value="<?php echo $fone; ?>" class="fone regular-text" /></td>
		</tr>
		<?php $cep = get_user_meta( $user->ID, 'cep', true ); ?>
		<tr>
			<th><?php _e( 'CEP', 'cf' ); ?></th>
			<td><input name="cep" type="text" value="<?php echo $cep; ?>" class="cep regular-text" id="cep" /></td>
		</tr>
		<?php $rua = get_user_meta( $user->ID, 'rua', true ); ?>
		<tr>
			<th><?php _e( 'Rua', 'cf' ); ?></th>
			<td><input name="rua" type="text" value="<?php echo $rua; ?>" class="rua regular-text" id="rua" /></td>
		</tr>
		<?php $numero = get_user_meta( $user->ID, 'numero', true ); ?>
		<tr>
			<th><?php _e( 'Número', 'cf' ); ?></th>
			<td><input name="numero" type="text" value="<?php echo $numero; ?>" class="numero regular-text" id="numero" /></td>
		</tr>
		<?php $bairro = get_user_meta( $user->ID, 'bairro', true ); ?>
		<tr>
			<th><?php _e( 'Bairro', 'cf' ); ?></th>
			<td><input name="bairro" type="text" value="<?php echo $bairro; ?>" class="bairro regular-text" id="bairro" /></td>
		</tr>
		<?php $cidade = get_user_meta( $user->ID, 'cidade', true ); ?>
		<tr>
			<th><?php _e( 'Cidade', 'cf' ); ?></th>
			<td><input name="cidade" type="text" value="<?php echo $cidade; ?>" class="cidade regular-text" id="cidade" /></td>
		</tr>
		<?php $uf = get_user_meta( $user->ID, 'uf', true ); ?>
		<tr>
			<th><?php _e( 'Estado', 'cf' ); ?></th>
			<td><?php echo cf_select_estados_br( $uf ); ?></td>
		</tr>
	</tbody>
</table>
<?php }

// Atualiza os campos
function cf_save_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { return false; } //Checking if the current user has ability to edit the user profile information
    update_user_meta( $user_id, 'tipo_pessoa', $_POST['tipo_pessoa'] );
    update_user_meta( $user_id, 'cpf', $_POST['cpf'] );
    update_user_meta( $user_id, 'cnpj', $_POST['cnpj'] );
    update_user_meta( $user_id, 'fone', $_POST['fone'] );
    update_user_meta( $user_id, 'cep', $_POST['cep'] );
    update_user_meta( $user_id, 'rua', $_POST['rua'] );
    update_user_meta( $user_id, 'numero', $_POST['numero'] );
    update_user_meta( $user_id, 'bairro', $_POST['bairro'] );
    update_user_meta( $user_id, 'cidade', $_POST['cidade'] );
    update_user_meta( $user_id, 'uf', $_POST['uf'] );
}
