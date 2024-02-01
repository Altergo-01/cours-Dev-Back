<?php

namespace App\Service;

use Symfony\Component\String\Slugger\AsciiSlugger;

class TestSlug
{
    public function slugify($sentence){

        $slugger = new AsciiSlugger();
        $slug = $slugger->slug($sentence);
        return $slug;

    }

}