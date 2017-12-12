<?php

/*
	Shortcode Listar Cousas
*/
function bm_do_list_cousas_shortcode( $atts = array() ) {
	// Parse attributes
	$atts = shortcode_atts( array(
		'limit' 	=> 10, // Current user, or admin
		'term'		=> '',
		'author'	=> ''
	), $atts, 'cmb_frontend_form' );

	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

	$args = array(
		'post_type' 		=> 'cousa',
		'posts_per_page'	=> $atts['limit'],
		'paged' 			=> $paged
	);
	if($atts['term'] != ''){
		$term = get_term($atts['term']);

		$args['tax_query'] = array(
			array(
				'taxonomy' 	=> $term->taxonomy,
				'field' 	=> 'term_id',
				'terms'		=> $atts['term']
			)
		);
	}
	if($atts['author'] != ''){
		$args['author'] = $atts['author'];
	}

	$the_query = new WP_Query( $args );

	// gardamos a query anterior
	global $wp_query;
	$tmp_query = $wp_query;
	$wp_query = null;
	$wp_query = $the_query;

	$output = '';

	if ( $the_query->have_posts() ) {
		$output .= '<div id="list_cousas">';
		$output .= '<div class="row">';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$lat = get_post_meta( get_the_ID(), 'bm_cousaform_localizacion', true );
//			print_r($lat['latitude']);

			$output .= '<article class="col-md-3 col-sm-6 col-6 cousa-list" data-lat="' . $lat['latitude'] . '" data-lng="' . $lat['longitude'] . '" data-id="' . get_the_ID() . '">';
			$output .= '<a href="'.esc_url( get_permalink(get_the_ID())).'">';
			$output .= '<h3>' . get_the_title() . '</h3>';
			$output .= get_the_post_thumbnail(get_the_ID(), 'cousa-image-list', array('class' => 'img-fluid'));
			$output .= '</a>';
			$output .= '<div class="periodo">';
			$usos = wp_get_post_terms(get_the_ID(), 'uso');
			foreach($usos as $uso) {
			   $output .= 'Para <span><a href="'.get_term_link($uso->term_id).'">' . $uso->name . '</a></span>'; //do something here
			}
			$output .= '</div>';
			$output .= '<i class="material-icons">arrow_forward</i>';
			$output .= '</article>';
		}

		$output .= '</div>';

		$output .= '<div class="navegacion row">';
		$output .= '<div class="col-md-6 exq">';
		$output .= get_previous_posts_link('<i class="material-icons">chevron_left</i><i class="material-icons">chevron_left</i>');
		$output .= '</div>';
		$output .= '<div class="col-md-6 der">';
		$output .= get_next_posts_link('<i class="material-icons">chevron_right</i><i class="material-icons">chevron_right</i>');
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		/* Restore original Post Data */
		wp_reset_postdata();
	} else {
		if($atts['author'] != ''){
			$output .= '<p>Aínda non tes ningunha cousa publicada. Se queres facelo diríxete ao formulario de <a href="/engadir-unha-cousa/">engadir unha cousa</a>.</p>';
			$output .= '<p>Se queres ver o que xa hai publicado diríxete ao <a href="/cousas">arquivo de cousas</a>.</p>';
		}
		// no posts found
	}

	// retomamos a query anterior
	$wp_query = null;
	$wp_query = $tmp_query;

	return $output;
}
add_shortcode( 'bm_list_cousas', 'bm_do_list_cousas_shortcode' );


/*
	Shortcode Buscar Cousas
*/
function bm_do_buscar_shortcode( $atts = array() ) {

	$usos = get_terms( array(
    	'taxonomy' => 'uso',
    	'hide_empty' => false,
	) );

	$tipos = get_terms( array(
    	'taxonomy' => 'tipo',
    	'hide_empty' => false,
	) );

	// Parse attributes
	$atts = shortcode_atts( array(
		'limit' => 10, // Current user, or admin
		'term'	=> ''
	), $atts, 'cmb_frontend_form' );

	$output = '';
	$output .= '<div class="caja_buscar">';
	$output .= '<h1>Buscar</h1>';
	$output .= '<div class="row"><div class="col-md-6">';
	$output .= '<form id="buscar">';
	$output .= '<div class="input_container">';
	$output .= '<input type="text" />';
	$output .= '<button type="submit" class="dispara_ler">Buscar</button>';
	$output .= '</div>';
	$output .= '</form>';
	$output .= '<div class="resultado_busqueda">Últimas cousas publicadas:</div>';
	$output .= '</div>';
	$output .= '<div class="col-md-6">';
	$output .= '<div class="listado_tax_buscar">';
	$output .= '<span class>Uso:</span>';
	$output .= '<ul>';
	foreach($usos as $uso) {
	   $output .= '<li><a href="'.get_term_link($uso->term_id).'"> ' . $uso->name . ' </a> </li>'; //do something here
	}
	$output .= '</ul>';
	$output .= '</div>';
	$output .= '<div class="listado_tax_buscar">';
	$output .= '<span class>Tipo:</span>';
	$output .= '<ul>';
	foreach($tipos as $tipo) {
	   $output .= '<li><a href="'.get_term_link($tipo->term_id).'"> ' . $tipo->name . ' </a> </li>'; //do something here
	}
	$output .= '</ul>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}
add_shortcode( 'bm_buscar', 'bm_do_buscar_shortcode' );

function bm_mapa_cousas_shortcode( $atts = array() ) {
	$output = '';
	$output .= '<div id="map_cousas"></div>';
	$output .= '   <script>
	var roadAtlasStyles = [
	{
	"featureType": "road.highway",
	"elementType": "geometry",
	"stylers": [
	{ "saturation": -100 },
	{ "lightness": -8 },
	{ "gamma": 1.18 }
	]
	}, {
	"featureType": "road.arterial",
	"elementType": "geometry",
	"stylers": [
	{ "saturation": -100 },
	{ "gamma": 1 },
	{ "lightness": -24 }
	]
	}, {
	"featureType": "poi",
	"elementType": "geometry",
	"stylers": [
	{ "saturation": -100 }
	]
	}, {
	"featureType": "administrative",
	"stylers": [
	{ "saturation": -100 }
	]
	}, {
	"featureType": "transit",
	"stylers": [
	{ "saturation": -100 }
	]
	}, {
	"featureType": "water",
	"elementType": "geometry.fill",
	"stylers": [
	{ "saturation": -100 }
	]
	}, {
	"featureType": "road",
	"stylers": [
	{ "saturation": -100 }
	]
	}, {
	"featureType": "administrative",
	"stylers": [
	{ "saturation": -100 }
	]
	}, {
	"featureType": "landscape",
	"stylers": [
	{ "saturation": -100 }
	]
	}, {
	"featureType": "poi",
	"stylers": [
	{ "saturation": -100 }
	]
	}, {
	}
	]
      var map;
	  var markersArray = [];
	  var iconUrl = "'.get_template_directory_uri().'/imx/marker.png";
      function initMap() {
        map = new google.maps.Map(document.getElementById("map_cousas"), {
          center: {lat: 43.371045, lng: -8.396409},
          zoom: 12,
		  mapTypeControlOptions: {
			  mapTypeIds: [google.maps.MapTypeId.ROADMAP, "usroadatlas"]
		  }
        });

		var usRoadMapType = new google.maps.StyledMapType(roadAtlasStyles);
		map.mapTypes.set("usroadatlas", usRoadMapType);
		map.setMapTypeId("usroadatlas");

		loadMarkers();
      }
	  function removeMarkers(){
		  for (var i = 0; i < markersArray.length; i++ ) {
		    markersArray[i].setMap(null);
		  }
		  markersArray.length = 0;
	  }
	  function loadMarkers(){
		  $("#list_cousas article").each(function(){
			  var mlat = $(this).data("lat");
			  var mlng = $(this).data("lng");
			  var latLng = {lat: mlat, lng: mlng};
			  var titulo = $("h3", this).text();
			  var url = $("a", this).attr("href");
			  var imaxe = $("img", this).attr("src");
			  var marker = new google.maps.Marker({
			      position: latLng,
			      map: map,
				  icon: iconUrl,
			  });
			  markersArray.push(marker);
			  var infowindow = new google.maps.InfoWindow({
			  	content: "<div class=\"container_window\"><h3>"+titulo+"</h3><img src="+imaxe+" /><i class=\"material-icons\">arrow_forward</i></div>",
			  });
			marker.addListener("mouseover", function() {
				infowindow.open(marker.get("map"), marker);
			});
			marker.addListener("mouseout", function() {
				infowindow.close(marker.get("map"), marker);
			});
			google.maps.event.addListener(marker, "click", function() {
			    window.location.href = url;
			});
		  });
	  }
    </script>';

	$output .= '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYyuykujHNOba4Egoo-QlL4qAAyPQgdeY&callback=initMap" async defer></script>';

	return $output;
}

add_shortcode( 'bm_mapa_cousas', 'bm_mapa_cousas_shortcode' );
