<?php

namespace App\Models\Tag;

interface HasType
{
    /**
     * Get the type of the tag.
     */
    public function getType(): TagType;
}
