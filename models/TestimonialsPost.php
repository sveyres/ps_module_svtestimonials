<?php
class TestimonialsPost extends ObjectModel
{
    public $id_svtestimonials;
    public $author;
    public $testimonial;
    public $date;
    public static $definition = array(
        'table' => 'svtestimonials',
        'primary' => 'id_svtestimonials',
        'fields' => array(
            'author' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'testimonial' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
        ),
    );
}
