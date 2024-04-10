<?php
add_action( 'cmb2_admin_init', 'dci_register_custom_fields_additional_cards' );
function dci_register_custom_fields_additional_cards() {
    $prefix = '_dci_areehome_'; // Cambia il prefisso come preferisci

    // Box per la carta aggiuntiva 1
    $cmb_1 = new_cmb2_box( array(
        'id'            => $prefix . '1_metabox',
        'title'         => __( 'Card Settings - Additional 1', 'design_comuni_italia' ),
        'object_types'  => array( 'post' ), // Modifica il tipo di post se necessario
        'context'       => 'normal',
        'priority'      => 'high',
    ) );

    $cmb_1->add_field( array(
        'name'       => __( 'Title', 'design_comuni_italia' ),
        'id'         => $prefix . '1_title',
        'type'       => 'text',
    ) );

    // Aggiungi altri campi per la carta aggiuntiva 1 similmente
    $cmb_1->add_field( array(
        'name'       => __( 'URL Area Tematica', 'design_comuni_italia' ),
        'id'         => $prefix . '1_url',
        'type'       => 'text_url', // Tipo di campo per l'URL
    ) );


	
	// Ripeti lo stesso processo per le altre carte aggiuntive (2-15)
}
