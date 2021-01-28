<?php

/**
 *
 * Set active css class if the specific URI is current URI
 *
 * @param string $path       A specific URI
 * @param string $class_name Css class name, optional
 * @return string            Css class name if it's current URI,
 *                           otherwise - empty string
 */

function setActive($path, $active = 'active')
{
	return !request()->input() && Request::segments()[0] == $path ? $active : null;
}

function setActiveFull($path, $active = 'active')
{
	return request()->is($path) || request()->is($path.'/*') ? $active : null;
}

function setActiveParam($param, $value, $active = 'active')
{
	return request()->input($param) == $value ? $active : null;
}

function getInitials($name)
{
	$words = preg_split("/\s+/", $name);
	$acronym = "";

	foreach ($words as $w) {
	$acronym .= $w[0];
	}

	return $acronym;
}
