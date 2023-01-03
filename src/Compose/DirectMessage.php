<?php

namespace Coderjerk\BirdElephant\Compose;

class DirectMessage
{
    public ?string $text = null;
    public ?string $attachments = null;

    public function text($text)
    {
        $this->text = $text;
        return $this;
    }

    public function attachments($attachments)
    {
        $this->attachments = $attachments;

        return $this;
    }

    /**
     * Add all non null properties to an array
     *
     * @return array
     */
    public function build(): array
    {
        $data = [
            'text' => $this->text,
            'attachments' =>
            [
                array('media_id' => $this->attachments)
            ]

        ];

        return $data;
    }
}
