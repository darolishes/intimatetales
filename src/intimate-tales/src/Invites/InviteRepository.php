<?php

namespace IntimateTales\Invites;

/**
 * Interface for managing invites.
 */
interface InviteRepository
{

  /**
   * Create a new invite. 
   * 
   * @param int $recipientId
   * @return void
   */
  public function createInvite(int $recipientId);

  /**
   * Get invite URL.
   * 
   * @param int $recipientId
   * @param int $senderId
   * @return string
   */
  public function getInviteUrl(int $recipientId, int $senderId);

  /**
   * Get invites.
   * 
   * @param int $limit
   * @param int $offset
   * @return Invite[]
   */
  public function getInvites(int $limit, int $offset);
}
