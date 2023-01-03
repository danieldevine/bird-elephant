<?php

namespace Coderjerk\BirdElephant\Compose;

class DirectMessage
{
    public $text;
    public $attachments;

    public function text($text)
    {
        $this->text = $text;
        return $this;
    }

    public function attachments($attachments)
    {
        $this->attachments = [
            ['media_id' => $attachments]
        ];

        return $this;
    }

    /**
     * Add all non null properties to an array
     *
     * @return array
     */
    public function build(): array
    {
        $vars =  get_object_vars($this);
        $data = [];

        foreach ($vars as $key => $value) {
            if ($value !== null) {
                $data[$key] = $value;
            }
        }
        return $data;
    }
}
