<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Session_model extends CI_Model
{
    public function inscription($data)
    {
        $this->db->insert('utilisateurs',$data);
    }
    
    public function connexion($login)
    {
        $results = $this->db->get_where('utilisateurs',array('login'=>$login))->row();
        return $results;
    }
    
    public function dateConnexion($login,$data)
    {
        $this->db->where('login',$login);
        $this->db->update('utilisateurs',$data);
    }
    
    public function bloquerUtilisateur($login)
    {
        $bloque = 1;
        $data = array('util_bloque' => $bloque);
        $this->db->where('login',$login);
        $this->db->update('utilisateurs',$data);
    }
    
    public function changerMdp($id,$mdp)
    {
        $bloque = 0;
        $data = array('util_bloque' => $bloque,
            'mot_de_passe' => $mdp
        );
        $this->db->where('util_id',$id);
        $this->db->update('utilisateurs',$data);
    }
    
    public function estBloque($id)
    {
        $this->db->select('util_bloque');
        $results = $this->db->get_where('utilisateurs',array('util_id'=>$id))->row();
        if ($results->util_bloque == '1') 
        {
            return true;
        }
        else 
        {
            return false;
        }
    }
}