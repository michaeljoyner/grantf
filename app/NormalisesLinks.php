<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 5/20/16
 * Time: 10:47 AM
 */

namespace App;


trait NormalisesLinks
{
    public function normaliseLink($link)
    {
        if(preg_match('/^[a-zA-Z]+:\/\//', $link)) {
            return $link;
        }

        return 'http://' . $link;
    }
}