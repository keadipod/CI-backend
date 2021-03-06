<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends MY_Controller
{

   public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        
        $data = array(
            'res' => $this->web->getMenu(),
            'title' => $this->web->getmenuLable(32),
            'msg' => $this->session->tempdata('msg'),
            'error' => $this->session->tempdata('error'),
            'ac'=>'11',
            'sac'=>'32'
        );
        echo $this->blade->view()->make('mt-admin.menuadmin.menu', $data)->render();
    }

public function add()
{
    if($post=$this->input->post()){
     extract($post);

$ins=array(
     'menu_name_'.$this->session->configlang => $menu_name,
     'menu_url' => $menu_slug,
     'menu_status' => $permission,
     'menu_icon' => $menu_icon,
     'menu_sorting' => $this->web->getPeriodeNummer(MENUS,'menu_sorting',array('menu_parent'=>$menu_parent)),
     'menu_parent' => $menu_parent,
     'active' => $status=='on'?0:1,
     'timestamp_create' =>date('Y-m-d H:i:s'),
     'timestamp_update' =>date('Y-m-d H:i:s'),
      );

    $id=$this->web->insertData(MENUS,$ins);

     if(!empty($id)){

         if(!empty($save)){
         $this->session->set_tempdata('msg', $this->web->getLable('msg_save'), 3);    
         redirect(base_url('mt-admin/'.$this->uri->segment(2)),'refresh');
         
         }else{
         $this->session->set_tempdata('msg', $this->web->getLable('msg_save'), 3);    
         redirect(base_url('mt-admin/'.$this->uri->segment(2).'/edit/'.$id),'refresh'); 
         
         }

     }

    }
     $data = array(
            'title' => $this->web->getmenuLable(32),
            'resmenu' => $this->web->getMenu(),
            'ac'=>'11',
            'sac'=>'32'

        );
        echo $this->blade->view()->make('mt-admin.menuadmin.menuform', $data)->render();
}

public function edit($id)
{
     if($post=$this->input->post()){
     extract($post);

$ins=array(
     'menu_name_'.$this->session->configlang => $menu_name,
     'menu_url' => $menu_slug,
     'menu_status' => $permission,
     'menu_icon' => $menu_icon,
     'menu_parent' => $menu_parent,
     'active' => $status=='on'?0:1,
     'timestamp_update' =>date('Y-m-d H:i:s'),
      );


     if($this->web->updateData(MENUS,$ins,array('menu_id'=>$id))){

         if(!empty($save)){
         $this->session->set_tempdata('msg', $this->web->getLable('msg_edit'), 3);    
         redirect(base_url('mt-admin/'.$this->uri->segment(2)),'refresh');
         
         }else{
         $this->session->set_tempdata('msg', $this->web->getLable('msg_edit'), 3);    
         redirect(base_url('mt-admin/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$id),'refresh'); 
         
         }

     }

    }

    $data = array(
            'res' => $this->web->getDataOne(MENUS,array('menu_id'=>$id),1),
            'title' => $this->web->getmenuLable(32),
            'resmenu' => $this->web->getMenu(),
            'msg' => $this->session->tempdata('msg'),
            'error' => $this->session->tempdata('error'),
            'ac'=>'11',
            'sac'=>'32'
        );
        echo $this->blade->view()->make('mt-admin.menuadmin.menuform', $data)->render();
}


public function delete($id)
{
   if($this->web->deleteData(MENUS,array('menu_id' =>$id))>0){
    $this->session->set_tempdata('msg', $this->web->getLable('msg_delete'), 3); 
    redirect(base_url('mt-admin/'.$this->uri->segment(2)),'refresh');     

   }else{
      $this->session->set_tempdata('error', $this->web->getLable('error_delete'), 3);  
      redirect(base_url('mt-admin/'.$this->uri->segment(2)),'refresh'); 
   }
}

public function action()
{
    //print_r($this->input->post());
    if($post=$this->input->post()){
        extract($post);
        if(!empty($action)){
        if($action=='Del'){
            if(count($del)>0){
                foreach ($del as $key => $value) {

                 if($this->web->deleteData(MENUS,array('menu_id' =>$value))>0){
                 $this->session->set_tempdata('msg', $this->web->getLable('msg_delete'), 3);     
                 }

                }
                 redirect(base_url('mt-admin/'.$this->uri->segment(2)),'refresh');     
            }else{
                 redirect(base_url('mt-admin/'.$this->uri->segment(2)),'refresh');  
            }
        }
        }else{
           redirect(base_url('mt-admin/'.$this->uri->segment(2)),'refresh');  
        }
    }
   //echo "DELETE";
}

}