<?php

function getInitials($name)
{
    $words = preg_split("/\s+/", $name);
    $acronym = "";

    foreach ($words as $w) {
        $acronym .= $w[0];
    }

    return $acronym;
}

function previousRoute()
{
    $url = url()->previous();
    return app("router")
        ->getRoutes($url)
        ->match(app("request")->create($url));
}
