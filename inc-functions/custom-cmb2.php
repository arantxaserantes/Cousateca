<?php
function bm_register_demo_metabox(){
	$prefix = 'bm_cousaform_';
	$prefix_2 = 'bm_';
	$prefix_3 = 'bm_inicio_';

	$bm_cousa = new_cmb2_box( array(
		'id'            => $prefix_2 . 'metabox',
		'title'         => esc_html__( 'Campos cousa', 'cmb2' ),
		'object_types'  => array( 'cousa' ), // Post type
	) );

	$bm_cousa->add_field( array(
		'name'     	=> esc_html__( 'Localizacion', 'cmb2' ),
		'id'    	=> $prefix . 'localizacion',
		'type'		=> 'pw_map',
	) );

	$bm_cousa->add_field( array(
		'name'    => esc_html__( 'Tempo', 'cmb2' ),
		'id'      => $prefix . 'tempo',
		'type'    => 'radio_inline',
		'options' => array(
			'maximo_de' => esc_html__( 'Tempo máximo de', 'cmb2' ),
			'despois_de_usar' => esc_html__( 'Devolver despois de usar', 'cmb2' ),
			'cando_o_pida' => esc_html__( 'Devolver cando o pida', 'cmb2' ),
		),
	) );

	$bm_cousa->add_field( array(
		'name' => esc_html__( 'Ata', 'cmb2' ),
		'id'   => $prefix . 'ata',
		'type' => 'text_date',
		// 'date_format' => 'Y-m-d',
	) );

	$bm_cousa->add_field( array(
		'name'    => esc_html__( 'Propósitos', 'cmb2' ),
		'id'      => $prefix . 'propositos',
		'type'    => 'radio_inline',
		'options' => array(
			'respaldados_por_min' => esc_html__( 'Respaldados por min', 'cmb2' ),
			'beneficos' => esc_html__( 'Benéficos', 'cmb2' ),
			'calquera_proposito' => esc_html__( 'Calquera propósito', 'cmb2' ),
		),
	) );

	$bm_cousa->add_field( array(
		'name'    => esc_html__( 'Destinatari@s', 'cmb2' ),
		'id'      => $prefix . 'destinatarios',
		'type'    => 'radio_inline',
		'options' => array(
			'membro_de' => esc_html__( 'Membro de', 'cmb2' ),
			'calquera_persoa' => esc_html__( 'Calquera persoa', 'cmb2' ),
		),
	) );

	$bm_cousa->add_field( array(
		'name'    => esc_html__( 'Aportación', 'cmb2' ),
		'id'      => $prefix . 'aportacion',
		'type'    => 'radio_inline',
		'options' => array(
			'aval' => esc_html__( 'Aval', 'cmb2' ),
			'comentario' => esc_html__( 'Comentario', 'cmb2' ),
			'contribucion' => esc_html__( 'Contribución', 'cmb2' ),
		),
	) );

	$bm_cousa->add_field( array(
        'name'    => esc_html__( 'Licenza', 'cmb2' ),
		'id'    	=> $prefix . 'licenza_escollida',
        'type'    => 'text',
    ) );

	$bm_cousa->add_field( array(
		'name'       => esc_html__( 'Nome', 'cmb2' ),
		'id'         => $prefix . 'nome',
		'type'       => 'text',
	) );

	$bm_cousa->add_field( array(
		'name' => esc_html__( 'Email', 'cmb2' ),
		'id'   => $prefix . 'email',
		'type' => 'text_email',
	) );

	$bm_inicio = new_cmb2_box( array(
		'id'            => $prefix_3 . 'metabox',
		'title'         => esc_html__( 'Campos inicio', 'cmb2' ),
		'object_types'  => array( 'page' ),
		'show_on'      	=> array( 'key' => 'id', 'value' => array( 7 ) ),
	) );

	$bm_inicio->add_field( array(
		'name'       => esc_html__( 'Titulo slide', 'cmb2' ),
		'id'         => $prefix_3 . 'titulo_slide',
		'type'       => 'text',
	) );

	$bm_inicio->add_field( array(
		'name'       => esc_html__( 'Subtitulo slide', 'cmb2' ),
		'id'         => $prefix_3 . 'subtitulo_slide',
		'type'       => 'text',
	) );

	$bm_inicio->add_field( array(
		'name'       => esc_html__( 'Texto botón', 'cmb2' ),
		'id'         => $prefix_3 . 'texto_boton',
		'type'       => 'text',
	) );

	$bm_inicio->add_field( array(
		'name'       => esc_html__( 'Url botón', 'cmb2' ),
		'id'         => $prefix_3 . 'url_boton',
		'type'       => 'text',
	) );

	$bm_inicio->add_field( array(
		'name' => esc_html__( 'Imaxe cabeceira', 'cmb2' ),
		'desc' => esc_html__( 'Sube a imaxe que funciona como slide', 'cmb2' ),
		'id'   => $prefix_3 . 'image',
		'type' => 'file',
	) );

}
add_action( 'cmb2_admin_init', 'bm_register_demo_metabox' );

/**
 * Formulario de engadir unha cousa
 */
function bm_engade_cousa_form() {
	$prefix = 'bm_cousaform_';
    $bm_cousa_form = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
        'object_types' => array( 'cousa' ),
        'hookup'       => false,
        'save_fields'  => false,
    ) );

	// Qué cousa é
    $bm_cousa_form->add_field( array(
        'name'    => __( 'Que cousa é?', 'cmb2' ),
		'desc' => esc_html__( 'Podes publicar cousas que vaias a vender ou alugar e non estén en uso', 'cmb2' ),
		'id'    	=> $prefix . 'titulo',
        'type'    => 'text',
    ) );

	// Tipo de cousa
	$bm_cousa_form->add_field( array(
		'name'     	=> esc_html__( 'Tipo de cousa', 'cmb2' ),
		'id'    	=> $prefix . 'selecciona_tipo',
		'type'		=> 'taxonomy_select',
		'taxonomy' 	=> 'tipo', // Taxonomy Slug
	) );

	// Imaxe
	$bm_cousa_form->add_field( array(
        'name'     		=> __( 'Imaxe', 'cmb2' ),
		'id'   			=> $prefix . 'imaxe',
        'type'      	=> 'text',
        'attributes' 	=> array(
            'type' => 'file', // Let's use a standard file upload field
        ),
    ) );

	// Como a comparto?
	$bm_cousa_form->add_field( array(
		'name'     	=> esc_html__( 'Como o comparto?', 'cmb2' ),
		'id'    	=> $prefix . 'selecciona_uso',
		'type'		=> 'taxonomy_select',
		'show_option_none' => false,
		'taxonomy' 	=> 'uso', // Taxonomy Slug
		'after_row'   => '<div class="contido_condicional" id="selectores_licenza">', // callback.
	) );

	$bm_cousa_form->add_field( array(
		'name'    => __('Devolución<button type="button" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="Por canto tempo vas deixala. Podes elexir unha data de devolución, que o faga cando remate de usala ou cando poida."><i class="material-icons">info_outline</i></button>', 'cmb2' ),
		'id'      => $prefix . 'tempo',
		'type'    => 'radio_inline',
		'classes' => 'condicional ver-en-prestar', // Extra cmb2-wrap classes
		'options' => array(
			'maximo_de' => __( 'Úsaa onde está<button type="button" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="A cousa non se pode mover do sitio no que está ou o prestatario demanda que non se mova. CASOS: \'Lavadora: non podes levala\' ou \'eu presto as miñas cousas de casa pero soamente dentro da miña casa\'."><i class="material-icons">info_outline</i></button>', 'cmb2' ),
			'despois_de_usar' => __( 'Devolver despois de usar<button type="button" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="Antes de levala hai que acordar o tempo máximo de devolución da cousa unha vez acabado o uso. CASO: «Lévaa a última hora e devólvea mañá pola mañá a primeira hora cando volva a abrir a tenda»"><i class="material-icons">info_outline</i></button>', 'cmb2' ),
			'cando_o_pida' => __( 'Devolver cando o pida<button type="button" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="Pódese levar e non se establece un tempo limite de uso a priori. Quen a leve comprométese a almacenala e devolvela para cando se lle pida. CASO: «Tenda de campaña: Mantena e gárdaa ti ben, xa me porei en contacto contigo se a preciso»"><i class="material-icons">info_outline</i></button>', 'cmb2' ),
		),
	) );
/*
	$bm_cousa_form->add_field( array(
		'id'   => $prefix . 'ata',

//		'desc' => esc_html__( 'Soamente poñemos a data na que deixa de estar disponíbel a cousa', 'cmb2' ),
		'classes' => 'condicional ver-en-prestar', // Extra cmb2-wrap classes
		'type' => 'text_date',
		// 'date_format' => 'Y-m-d',
	) );
*/
	$bm_cousa_form->add_field( array(
		'name'    => __( 'Propósitos<button type="button" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="Para que. Podes querer respaldar o seu uso, simplemente aceptalo ou que che sexa indeferente."><i class="material-icons">info_outline</i></button>', 'cmb2' ),
		'id'      => $prefix . 'propositos',
		'type'    => 'radio_inline',
		'classes' => 'condicional ver-en-regalar ver-en-prestar ver-en-intercambio', // Extra cmb2-wrap classes
		'options' => array(
			'respaldados_por_min' => __( 'Respaldados por min<button type="button" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="@ solicitante ten que convencer a@ prestatario de que respalde activamente o propósito de uso que lle vai dar á cousa. CASO: «A Xoan, o prestatario, parécelle que o que estou conseguindo con esta cousa que me prestou está ben»"><i class="material-icons">info_outline</i></button>', 'cmb2' ),
			'beneficos' => __( 'Benéficos<button type="button" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="@ prestatario acepta o uso que se lle vai dar á cousa mais tampouco ten porqué respaldalo. CASO: «Vou usalo con fumadores, ainda que a ti che caian mal»"><i class="material-icons">info_outline</i></button>', 'cmb2' ),
			'calquera_proposito' => __( 'Calquera propósito<button type="button" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="En principio, non fai falta que @ solicitante lle diga o propósito do seu uso a@ prestatario."><i class="material-icons">info_outline</i></button>', 'cmb2' ),
		),
	) );

	$bm_cousa_form->add_field( array(
		'name'    => __( 'Destinatari@s<button type="button" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="Para quen. Pode ser un membro dunha comunidade, cooperativa, asociación etc... para usuari@s rexistrad@s, ou para calquera persoa."><i class="material-icons">info_outline</i></button>', 'cmb2' ),
		'id'      => $prefix . 'destinatarios',
		'type'    => 'radio_inline',
		'classes' => 'condicional ver-en-regalar ver-en-prestar ver-en-intercambio', // Extra cmb2-wrap classes
		'options' => array(
			'membro_de' => __( 'Membro de<button type="button" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="A cousa só pode usala un certo grupo de persoas que coñezan ou sexan expertas nun tema en concreto, sexan dun lugar ou unha cultura ou teñan certas características comúns ou actúen o se comporten dun certo modo concreto. CASO: «Só para… Asociacion formal: cooperativa, comunidade de veciños, centro social, clientes bar, etc. Ou Asociacion informal: amigos, primos, hobbistas, etc.»"><i class="material-icons">info_outline</i></button>', 'cmb2' ),
			'usuarios' => __( 'Usuari@s<button type="button" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="As persoas solicitantes deben estar dadas de alta na web, e contactar a través dela. Implica ter que ser un pouco embaixadora se re-prestas a cousa a xente nova que non está rexistrada na web."><i class="material-icons">info_outline</i></button>', 'cmb2' ),
			'calquera_persoa' => __( 'Calquera persoa<button type="button" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="Todas as persoas interesadas estan invitadas a contactar."><i class="material-icons">info_outline</i></button>', 'cmb2' ),
		),
	) );

	$bm_cousa_form->add_field( array(
		'name'    => __( 'Aportación<button type="button" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="Que requires a cambio, un aval, un comentario ou algún tipo de contribución?"><i class="material-icons">info_outline</i></button>', 'cmb2' ),
		'id'      => $prefix . 'aportacion',
		'type'    => 'radio_inline',
		'classes' => 'condicional ver-en-regalar ver-en-prestar', // Extra cmb2-wrap classes
		'options' => array(
			'contribucion' => __( 'Contribución<button type="button" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="@ ofertante está pidindo unha aportación material como condición. Pode ser aportación simbólica, funcional ou patrimonial. CASO: «Debes traer algo especial para usar la cosa» ou «Debes ofertarme algo prestado o regalado para usarla o en un futuro; ó debes ofertar algo a un tercero, etc.»"><i class="material-icons">info_outline</i></button>', 'cmb2' ),
			'aval' => __( 'Aval<button type="button" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="A solicitante debe dispor dunha autenticación especial dos seus datos e/ou unha protección contra posíbeis accidentes dada de parte de terceiras persoas cara ela. CASO:  «Necesito ver o teu DNI e saber a túa dirección de residencia» ou «Necesito que teñas comentarios positivos de 5 persoas ou un amigo en común» ou «Necesito que se cubran posíbeis danos accidentais coa seguinte formalidade no aval: simbólico, parcial, solidario, formal, notarial»"><i class="material-icons">info_outline</i></button>', 'cmb2' ),
			'comentario' => __( 'Comentario<button type="button" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="O solicitante debe dar a información sobre o uso que @ ofertante requira, incluído a necesidade de comentario público previo ou posterior ao uso. CASO: «ser amable, dalas grazas, comentar propósito, comentar ao devolver, comentar en web, comentar en web con foto en redes sociais, etc.»"><i class="material-icons">info_outline</i></button>', 'cmb2' ),
		),
	) );

	$bm_cousa_form->add_field( array(
        'name'    => esc_html__( 'Licenza', 'cmb2' ),
		'id'    	=> $prefix . 'licenza_escollida',
        'type'    => 'text',
    ) );

	$bm_cousa_form->add_field( array(
		'name' => esc_html__( 'Desexos', 'cmb2' ),
		'id'   => $prefix . 'descripcion',
		'desc' => esc_html__( 'Info adicional e desexos (instrucciones de uso, tempo máximo, contribución funcional, descripción, historias e desexos para a cousa)', 'cmb2' ),
		'type' => 'textarea',
		'before_row'   => '</div><div id="contenedor_licenza_form"><h3>Licenza seleccionada</h3><div class="dentro_licenza"><span class="uso">Préstamo.</span><span class="seleccions"></span><p class="info_xeral">@ prestatari@ pode cancelar calquera condición cando queira comunicándollo @ usuari@. En principio, a non ser que @ prestatari@ diga o contrario, deixa a cousa tal e como a atopaches.</p></div></div>', // callback.
	) );

	$bm_cousa_form->add_field( array(
		'name'     	=> esc_html__( 'Localizacion', 'cmb2' ),
		'id'    	=> $prefix . 'localizacion',
		'type'		=> 'pw_map',
	) );

/*	Campos de nome e email que xa non se empregan
	porque agora requírese estar rexistrados para publicar
	$bm_cousa_form->add_field( array(
		'name'       => esc_html__( 'Nome', 'cmb2' ),
		'id'         => $prefix . 'nome',
		'type'       => 'text',
	) );

	$bm_cousa_form->add_field( array(
		'name' => esc_html__( 'Email', 'cmb2' ),
		'id'   => $prefix . 'email',
		'type' => 'text_email',
	) );
*/
}
add_action( 'cmb2_init', 'bm_engade_cousa_form' );

/**
 * Sets the front-end-post-form field values if form has already been submitted.
 *
 * @return string
 */
function bm_maybe_set_default_from_posted_values( $args, $field ) {
	if ( ! empty( $_POST[ $field->id() ] ) ) {
		return $_POST[ $field->id() ];
	}
	return '';
}

/**
 * Gets the front-end-post-form cmb instance
 *
 * @return CMB2 object
 */
function bm_engade_cousa_metabox_get() {
	// Use ID of metabox in yourprefix_frontend_form_register
	$metabox_id = 'bm_cousaform_metabox';
	// Post/object ID is not applicable since we're using this form for submission
	$object_id  = 'fake-oject-id';
	// Get CMB2 metabox object
	return cmb2_get_metabox( $metabox_id, $object_id );
}

/**
 * Handle the cmb_frontend_form shortcode
 *
 * @param  array  $atts Array of shortcode attributes
 * @return string       Form html
 */
function bm_do_engade_cousa_submission_shortcode( $atts = array() ) {
	// Get CMB2 metabox object
	$cmb = bm_engade_cousa_metabox_get();
	// Get $cmb object_types
	$post_types = $cmb->prop( 'object_types' );
	// Current user
	$user_id = get_current_user_id();
	// Parse attributes
	$atts = shortcode_atts( array(
		'post_author' => $user_id ? $user_id : 1, // Current user, or admin
		'post_status' => 'publish',
		'post_type'   => reset( $post_types ), // Only use first object_type in array
	), $atts, 'cmb_frontend_form' );
	/*
	 * Let's add these attributes as hidden fields to our cmb form
	 * so that they will be passed through to our form submission
	 */
	foreach ( $atts as $key => $value ) {
		$cmb->add_hidden_field( array(
			'field_args'  => array(
				'id'    => "atts[$key]",
				'type'  => 'hidden',
				'default' => $value,
			),
		) );
	}
	// Initiate our output variable
	$output = '';
	// Get any submission errors
	if ( ( $error = $cmb->prop( 'submission_error' ) ) && is_wp_error( $error ) ) {
		// If there was an error with the submission, add it to our ouput.
		$output .= '<h3>' . sprintf( __( 'There was an error in the submission: %s', 'cousateca' ), '<strong>'. $error->get_error_message() .'</strong>' ) . '</h3>';
	}
	// If the post was submitted successfully, notify the user.
	if ( isset( $_GET['post_submitted'] ) && ( $post = get_post( absint( $_GET['post_submitted'] ) ) ) ) {
		// Get submitter's name
		$name = get_post_meta( $post->ID, 'submitted_author_name', 1 );
		$name = $name ? ' '. $name : '';
		// Add notice of submission to our output
		$output .= '<h3>' . sprintf( __( 'Thank you%s, your new post has been submitted and is pending review by a site administrator.', 'cousateca' ), esc_html( $name ) ) . '</h3>';
	}
	// Get our form
	$output .= cmb2_get_metabox_form( $cmb, 'fake-oject-id', array( 'save_button' => __( 'Enviar cousa', 'cousateca' ) ) );

	$output_no_logged = '<p>Tes que iniciar sesión para poder publicar unha cousa. Se non tes conta aínda podes crear unha: <a href="/rexistrate">rexístrate</a></p>';
	$output_no_logged .= '<p>Se perdiches o teu contrasinal podes crear un novo <a href="' . wp_lostpassword_url() . '">aquí</a>.</p>';
	$output_no_logged .= wp_login_form(array('echo' => false, 'label_username' => 'Nome ou e-mail'));

	if(is_user_logged_in()){
		return $output;
	}else{
		return $output_no_logged;
	}
}
add_shortcode( 'bm_engade_cousa', 'bm_do_engade_cousa_submission_shortcode' );

/**
 * Handles form submission on save. Redirects if save is successful, otherwise sets an error message as a cmb property
 *
 * @return void
 */
function bm_handle_engadir_cousa_form_submission() {
	// If no form submission, bail
	if ( empty( $_POST ) || ! isset( $_POST['submit-cmb'], $_POST['object_id'] ) ) {
		return false;
	}
	// Get CMB2 metabox object
	$cmb = bm_engade_cousa_metabox_get();
	$post_data = array();
	// Get our shortcode attributes and set them as our initial post_data args
	if ( isset( $_POST['atts'] ) ) {
		foreach ( (array) $_POST['atts'] as $key => $value ) {
			$post_data[ $key ] = sanitize_text_field( $value );
		}
		unset( $_POST['atts'] );
	}
	// Check security nonce
	if ( ! isset( $_POST[ $cmb->nonce() ] ) || ! wp_verify_nonce( $_POST[ $cmb->nonce() ], $cmb->nonce() ) ) {
		return $cmb->prop( 'submission_error', new WP_Error( 'security_fail', __( 'Security check failed.' ) ) );
	}
	// Check title submitted
	if ( empty( $_POST['bm_cousaform_titulo'] ) ) {
		return $cmb->prop( 'submission_error', new WP_Error( 'post_data_missing', __( 'New post requires a title.' ) ) );
	}
	// And that the title is not the default title
	if ( $cmb->get_field( 'bm_cousaform_titulo' )->default() == $_POST['bm_cousaform_titulo'] ) {
		return $cmb->prop( 'submission_error', new WP_Error( 'post_data_missing', __( 'Please enter a new title.' ) ) );
	}
	/**
	 * Fetch sanitized values
	 */
	$sanitized_values = $cmb->get_sanitized_values( $_POST );
	// Set our post data arguments
	$post_data['post_title']   = $sanitized_values['bm_cousaform_titulo'];
	unset( $sanitized_values['bm_cousaform_titulo'] );
	if($sanitized_values['bm_cousaform_descripcion']){
		$post_data['post_content'] = $sanitized_values['bm_cousaform_descripcion'];
	}else{
		$post_data['post_content'] = '';
	}
	unset( $sanitized_values['bm_cousaform_descripcion'] );

	$new_submission_id = wp_insert_post( $post_data, true );
	// If we hit a snag, update the user
	if ( is_wp_error( $new_submission_id ) ) {
		return $cmb->prop( 'submission_error', $new_submission_id );
	}
	$cmb->save_fields( $new_submission_id, 'post', $sanitized_values );

	unset( $post_data['post_type'] );
	unset( $post_data['post_status'] );

	// Engadimos a imaxe
	$img_id = bm_engade_cousa_form_photo_upload( $new_submission_id, $post_data );

	if ( $img_id && ! is_wp_error( $img_id ) ) {
		set_post_thumbnail( $new_submission_id, $img_id );
	}else{
		// poñemos a imaxe con ID 300 se non se subiu ningunha
		set_post_thumbnail( $new_submission_id, 300 );
	}

	// Actualizamos a infromacion adicional
	wp_set_post_terms( $new_submission_id, array(15), 'estado' );

	// Enviamos un email á persoa que publicou a cousa
	$usuario_logeado = wp_get_current_user();
	$email = $usuario_logeado->user_email;
	$subject = '[Cousateca] A tua cousa foi publicada';
	$url_codigo = 'https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl=' . esc_url(get_permalink($new_submission_id)) . '&choe=UTF-8';
	$mensaxe = 'Ola ' . $usuario_logeado->user_login . '!';
	$mensaxe .= '<br /><br />A túa cousa foi publicada. Podes vela no seguinte enderezo:' . get_permalink( $new_submission_id );
	$mensaxe .= '<br /><br />Podes descargar o código de barras referente á cousa do seguinte enderezo: ' . $url_codigo;
	$headers = array('Content-Type: text/html; charset=UTF-8');

	wp_mail($email, $subject, $mensaxe, $headers);


	/*
	 * Redirect back to the form page with a query variable with the new post ID.
	 * This will help double-submissions with browser refreshes
	 */
//	wp_redirect( esc_url_raw( add_query_arg( 'post_submitted', $new_submission_id ) ) );
	wp_redirect( esc_url_raw( add_query_arg( 'post_submitted', $new_submission_id, get_permalink($new_submission_id) ) ) );
	exit;
}
add_action( 'cmb2_after_init', 'bm_handle_engadir_cousa_form_submission' );

/**
 * Handles uploading a file to a WordPress post
 *
 * @param  int   $post_id              Post ID to upload the photo to
 * @param  array $attachment_post_data Attachement post-data array
 */
function bm_engade_cousa_form_photo_upload( $post_id, $attachment_post_data = array() ) {
	// Make sure the right files were submitted
	if (
		empty( $_FILES )
		|| ! isset( $_FILES['bm_cousaform_imaxe'] )
		|| isset( $_FILES['bm_cousaform_imaxe']['error'] ) && 0 !== $_FILES['bm_cousaform_imaxe']['error']
	) {
		return;
	}
	// Filter out empty array values
	$files = array_filter( $_FILES['bm_cousaform_imaxe'] );
	// Make sure files were submitted at all
	if ( empty( $files ) ) {
		return;
	}
	// Make sure to include the WordPress media uploader API if it's not (front-end)
	if ( ! function_exists( 'media_handle_upload' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );
	}
	// Upload the file and send back the attachment post ID
	return media_handle_upload( 'bm_cousaform_imaxe', $post_id, $attachment_post_data );
}
