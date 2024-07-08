<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Symfony\Component\Notifier\Message;

use Symfony\Component\Notifier\Notification\Notification;

/**
 * @author Ahmed Ghanem <ahmedghanem7361@gmail.com>
 */
class DesktopMessage implements MessageInterface, FromNotificationInterface
{
    private ?string $transport = null;
    private ?Notification $notification = null;

    public function __construct(
        private string $subject,
        private string $content,
        private ?MessageOptionsInterface $options = null,
    ) {
    }

    public static function fromNotification(Notification $notification): self
    {
        $message = new self($notification->getSubject(), $notification->getContent());

        $message->setNotification($notification);

        return $message;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getRecipientId(): ?string
    {
        return $this->options?->getRecipientId();
    }

    /**
     * @return $this
     */
    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return $this
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return $this
     */
    public function setOptions(MessageOptionsInterface $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function getOptions(): ?MessageOptionsInterface
    {
        return $this->options;
    }

    public function getTransport(): ?string
    {
        return $this->transport;
    }

    /**
     * @return $this
     */
    public function setTransport(string $transport): self
    {
        $this->transport = $transport;

        return $this;
    }

    public function getNotification(): ?Notification
    {
        return $this->notification;
    }

    /**
     * @return $this
     */
    public function setNotification(Notification $notification): self
    {
        $this->notification = $notification;

        return $this;
    }
}
