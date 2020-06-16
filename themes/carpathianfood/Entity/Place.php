<?php


namespace Entity;


use Service\PostTypeCreator;

class Place extends PostType
{
    public static $MACHINE_NAME = 'place';

    public static function init($singularName, $pluralName)
    {

	    add_filter('ffflabel/post/taxonomies', function($taxonomies, $post_type) {
		    if ($post_type === self::$MACHINE_NAME) {
			    $taxonomies = [
				    static::$MACHINE_NAME . '-type' => [
					    'singular' => 'Type',
					    'plural'   => 'Types',
					    'filter'   => true
				    ]
			    ];
		    }
		    return $taxonomies;
	    }, 1, 2);


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