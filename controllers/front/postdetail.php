<?php
class svtestimonialspostdetailModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('post_detail.tpl');
        $post = $this->get_post(Tools::getValue('id'));
        if ($post) {
            $this->context->smarty->assign(
                array(
                    'post' => $post,
                )
            );
        }
    }
    function get_post(int $id)
    {
        $dbquery = new DbQuery();
        $dbquery->select('id_svtestimonials,author,testimonial,date');
        $dbquery->from('svtestimonials');
        $dbquery->where('id_svtestimonials = '.$id);

        return Db::getInstance()->ExecuteS($dbquery);
    }
}
