<?php
class FlexibleContent {
	function FlexibleContent( $id ) {
		//id wpisu
		$this->id = $id;
	}

	/**
	 * generowanie treści na bazie flexible content
	 */
	function get_content() {
		if ( have_rows( 'strona', $this->id ) ) {
			// loop through the rows of data
			while ( have_rows( 'strona', $this->id ) ) {
				the_row();

				//czyścimy array
				$tpl_args = [];

				if ( 'jedna_kolumna' == get_row_layout() ) {
					$tpl_args['rodzaj'] = get_sub_field( 'rodzaj' );
					$tpl_core = 'templates/flexible';
					$tpl = 'one-column';

					if ( 'obrazek' == $tpl_args['rodzaj'] ) {
						$tpl_args['obrazek'] = wp_get_attachment_image_src( get_sub_field( 'obrazek' ) , '770x346' )[0];
					} else {
						$tpl_args['tresc'] = get_sub_field( 'tresc' );
					}
				} elseif ( 'dwie_kolumny' == get_row_layout() ) {
					$tpl_core = 'templates/flexible';
					$tpl = 'two-columns';

					//lewa kolumna
					$tpl_args['rodzaj_lewo'] = get_sub_field( 'rodzaj_lewo' );

					if ( 'obrazek' == $tpl_args['rodzaj_lewo'] ) {
						$tpl_args['obrazek_lewo'] = wp_get_attachment_image_src( get_sub_field( 'obrazek_lewo' ) , '770x346' )[0];
					} else {
						$tpl_args['tresc_lewo'] = get_sub_field( 'tresc_lewo' );
					}

					//prawa kolumna
					$tpl_args['rodzaj_prawo'] = get_sub_field( 'rodzaj_prawo' );

					if ( 'obrazek' == $tpl_args['rodzaj_prawo'] ) {
						$tpl_args['obrazek_prawo'] = wp_get_attachment_image_src( get_sub_field( 'obrazek_prawo' ) , '770x346' )[0];
					} else {
						$tpl_args['tresc_prawo'] = get_sub_field( 'tresc_prawo' );
					}
				}

				set_query_var( 'tpl_args', $tpl_args );
				get_template_part( $tpl_core, $tpl );

				unset( $tpl_args );
			}
		}
	}
	/**
	 * zapisanie treści jako zmienna
	 * return string	kod html
	 */
	function convert_to_var() {
		ob_start();
		self::get_content();
		$output = ob_get_clean();

		return $output;
	}

	/**
	 * podmiana the_content podczas zapisu
	 */
	function content_on_save() {
		if ( ! wp_is_post_revision( $this->id ) ) {
			// unhook this function so it doesn't loop infinitely
			remove_action( 'acf/save_post', [ $this, 'content_on_save' ], 99 );
		}

		if ( 'page' == get_post_type( $this->id ) ) {
			$content = self::convert_to_var();
			$my_post['ID'] = $this->id;
            $my_post['post_content'] = $content;

            $test = wp_update_post( $my_post );
		}

	}
}
