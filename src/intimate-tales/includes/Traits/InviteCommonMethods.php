<?php

namespace IntimateTales\Traits;

trait InviteCommonMethods {


	private function generateUrl() {
		return home_url( '/' . $this->token );
	}

	public function getToken(): string {
		return $this->token;
	}

	public function getRecipientId(): int {
		return $this->recipientId;
	}

	public function getUrl(): string {
		return $this->url;
	}

	public function getEmail(): string {
		return $this->email;
	}

	protected function insertData( $tableName, $data ) {
		$defaultData = $this->getDefaultData();
		$data        = array_merge( $defaultData, $data );

		$this->databaseService->insert( $tableName, $data );
	}

	protected function getDefaultData() {
		return array(
			'created_at' => current_time( 'mysql' ),
			'updated_at' => current_time( 'mysql' ),
		);
	}
}
