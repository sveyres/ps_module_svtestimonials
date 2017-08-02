<?php
class svtestimonialslistModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('list.tpl');


        $postslist = $this->get_post() ;
        if ($postslist) {
            foreach ($postslist as $post) {
                $post["link"] = $this->context->link->getModuleLink('svtestimonials', 'postdetail', array('id' =>$post['id_svtestimonials']));
                $posts[] = $post;
            }
            $this->context->smarty->assign(
                array(
                    'posts' => $posts
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
