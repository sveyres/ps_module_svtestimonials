<?php

class AdminSvTestimonialsController extends ModuleAdminController {

    public function __construct()
    {
        $this->table = 'svtestimonials';
        $this->className = 'TestimonialsPost';
        $this->actions = array('delete');
        $this->bootstrap = True;

        $this->fields_list = array(
            'author' => array(
                'title' => $this->l('author'),
            ),
            'testimonial' => array(
                'title' => $this->l('testimonial'),
            ),
            'date' => array(
                'title' => $this->l('date'),
            ),
        );

        $this->fields_form = array(
			'legend' => array(
				'title' => $this->l('author'),
			),
			'input' => array(
				array(
					'type' => 'text',
					'label' => $this->l('Auteur:'),
					'name' => 'author'
				),
				array(
					'type' => 'text',
					'label' => $this->l('Témoignage:'),
					'name' => 'testimonial',
				),

			),
			'submit' => array(
				'title' => $this->l('Save'),
				'class' => 'btn btn-default pull-right'
			)
        );
        parent::__construct();
    }
}
