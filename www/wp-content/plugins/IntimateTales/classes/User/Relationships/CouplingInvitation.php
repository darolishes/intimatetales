    <?php

    namespace IntimateTales\User\Relationships;

    class CouplingInvitation
    {
    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';

    private $sender;

    private $recipient;

    private $message;

    private $status;

    public function __construct(string $sender, string $recipient, ?string $message = null)
    {
        $this->validateSender($sender);
        $this->validateRecipient($recipient);
        
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->message = $message;
        
        $this->status = self::STATUS_PENDING;
    }

    public function accept(): void {
        $this->status = self::STATUS_ACCEPTED; 
    }

    public function reject(): void {
        $this->status = self::STATUS_REJECTED;
    }

    public function getSender(): string 
    {
        return $this->sender;
    }

    public function getRecipient(): string  
    {
        return $this->recipient;
    }

    public function getMessage(): ?string
    {
        return $this->message;  
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function isAccepted(): bool {
        return $this->status === self::STATUS_ACCEPTED;
     }
     
    public function isRejected(): bool {
        return $this->status === self::STATUS_REJECTED; 
    }

    private function validateSender(string $sender) {
        if (empty($sender)) {
            throw new \InvalidArgumentException('Sender cannot be empty.');  
        }
     }
     
     private function validateRecipient(string $recipient) {
        if (empty($recipient)) {
            throw new \InvalidArgumentException('Recipient cannot be empty.');
        } 
     }
}