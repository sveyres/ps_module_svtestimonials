<?php
class svtestimonialslistModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('list.tpl');


        $postslist = $this->get_post() ;
        if ($postslist) {
            $this->context->smarty->assign(
                array(
                    'posts' => $postslist
                )
            );
        }
    }

    function get_post()
    {
        $dbquery = new DbQuery();
        $dbquery->select('id_svtestimonials,author,testimonial,date');
        $dbquery->from('svtestimonials');

        return Db::getInstance()->ExecuteS($dbquery);
    }
}
