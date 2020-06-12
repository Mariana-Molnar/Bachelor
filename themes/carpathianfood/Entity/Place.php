<?php


namespace Entity;


use Service\PostTypeCreator;

class Place extends PostType
{
    public static $MACHINE_NAME = 'place';

    public static function init($singularName, $pluralName)
    {

        parent::init($singularName, $pluralName);

        PostTypeCreator::setArgs([
            'supports'            => ['title', 'editor', 'thumbnail','excerpt'],
            'menu_icon'           => 'dashicons-groups',
            'exclude_from_search' => true,
            'has_archive'         => true,
            'show_in_rest'        => true
        ], self::$MACHINE_NAME);
    }
}