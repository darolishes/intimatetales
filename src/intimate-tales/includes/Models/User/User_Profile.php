<?php

namespace IntimateTales\Models\User;

defined( 'ABSPATH' ) || exit;

use IntimateTales\Models\User\Profile_Repository;
use IntimateTales\Models\User\User_Model;

class User_Profile {

	private User_Model $user;
	private array $profile_data;
	private Profile_Repository $profile_repository;

	public function __construct( User_Model $user, Profile_Repository $profile_repository ) {
		$this->user               = $user;
		$this->profile_repository = $profile_repository;
		$this->hydrate();
	}

	private function hydrate(): void {
		$profile = $this->profile_repository->get( $this->user->get_id() );

		if ( $profile ) {
			$this->profile_data = array(
				'user_meta'  => $profile['user_meta'],
				'acf_fields' => $profile['acf_fields'],
			);
		}
	}

	public function get_field( string $key ) {
		return $this->profile_data['acf_fields'][ $key ] ?? null;
	}

	public function fetch_acf_fields(): array {
		$data = array();
		foreach ( $this->profile_data['acf_fields'] as $field ) {
			$data[ $field['key'] ] = array(
				'label' => $field['label'],
				'value' => $this->get_field( $field['key'] ),
			);
		}
		return $data;
	}

	/**
	 * Display ACF fields for this user profile.
	 *
	 * @return void
	 */
	public function display_acf_user_profile() {
		$fields = get_field_objects( "user_{$this->user->get_id()}" );

		if ( $fields ) {
			foreach ( $fields as $field_name => $field ) {
				echo '<div>';
				echo '<strong>' . esc_html( $field['label'] ) . ':</strong> ';
				echo esc_html( $field['value'] );
				echo '</div>';
			}
		}
	}
}
