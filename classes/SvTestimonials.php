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
            || !$this->installDb()
            || !$this->registerHook('displayHome')

        ){
            return false;
        }
        return true;
    }

// --------------------------------------------------------- SQL
    public function installDb()
    {
        return Db::getInstance()->Execute('
        CREATE TABLE '._DB_PREFIX_.'svtestimonials (
            id_svtestimonials INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            author VARCHAR(200) NOT NULL,
            testimonial TEXT NOT NULL,
            date DATETIME DEFAULT CURRENT_TIMESTAMP )'
        );
    }

    public function uninstallDb()
    {
        return Db::getInstance()->Execute('DROP TABLE '._DB_PREFIX_.'svtestimonials');
    }
// ------------------- END SQL
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
        $id_tab = (int)Tab::getIdFromClassName('AdminSvTestimonials');
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
            ||!$this->uninstallDb()
        ) {
            return false;
        }
        return true;
    }

// --------------------------------------------------------- HOOK
    public function hookDisplayHome($params)
    {
        $this->context->smarty->assign(
            array(
            'my_module_name' => Configuration::get('SVTESTIMONIALS_NAME'),
            'my_module_link' => $this->context->link->getModuleLink('svtestimonials', 'list'),
            'my_module_message' => $this->l('This is a simple text message'),

            )
        );
        return $this->display(_PS_MODULE_DIR_.$this->name, 'svtestimonials.tpl');
    }

    public function hookDisplayHeader()
    {
        $this->context->controller->addCSS($this->_path.'css/svtestimonial.css', 'all');
    }
// -------------------END HOOK

}
