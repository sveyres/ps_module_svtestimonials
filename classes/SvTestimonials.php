<?php

class SvTestimonials extends Module
{
    public function __construct()
    {
        $this->name = 'svtestimonials';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Moi même aussi';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Testimonial');
        $this->description = $this->l('en cours');
        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        if (!Configuration::get('SVTESTIMONIALSMODULE_NAME')) {
            $this->warning = $this->l('No name provided');
        }
    }

    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        if (!parent::install()
            || !$this->installTab()
            || !$this->registerHook('displayHome')

        ){
            return false;
        }
        return true;
    }


// --------------------------------------------------------- TAB
    public function installTab()
    {
        $tab = new Tab();
        $tab->active = 1;
        $tab->class_name = 'AdminSvTestimonials';
        $tab->name = array();
        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = 'Sv Testimonials';
        }
        $tab->id_parent = 0;
        $tab->module = $this->name;
        return $tab->add();
    }

    public function uninstallTab()
    {
        $id_tab = (int)Tab::getIdFromClassName('SvTestimonials');
        if ($id_tab) {
            $tab = new Tab($id_tab);
            return $tab->delete();
        } else {
            return false;
        }
    }
// -------------------END TAB

    public function uninstall()
    {
        if (!parent::uninstall()
            ||!$this->uninstallTab()
        ) {
            return false;
        }
        return true;
    }

}
