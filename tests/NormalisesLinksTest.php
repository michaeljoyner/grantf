<?php

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 5/20/16
 * Time: 10:22 AM
 */
class NormalisesLinksTest extends TestCase
{
    /**
     *@test
     */
    public function a_writeup_will_normalise_relative_links()
    {
        $link = 'burra.org';
        $writeup = new \App\Writeups\Writeup();

        $this->assertEquals('http://burra.org', $writeup->normaliseLink($link));
    }

    /**
     *@test
     */
    public function a_writeup_wont_change_an_absolute_link()
    {
        $link = 'http://burra.org';
        $writeup = new \App\Writeups\Writeup();

        $this->assertEquals('http://burra.org', $writeup->normaliseLink($link));
    }
}