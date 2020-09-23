<?php

function setActive($routeName)
{
    return request()->routeIs($routeName) ? 'active' : '';
}

function showMenu($routeName)
{
    return request()->routeIs($routeName) ? 'menu-open' : '';
}

function setBadge($state)
{
    if ($state)
    {
        return '<span class="badge badge-success">En uso</span>';
    } else {
        return '<span class="badge badge-danger">Inactivo</span>';
    }
}
