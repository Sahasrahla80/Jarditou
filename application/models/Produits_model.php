<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Produits_model extends CI_Model
{
    public function liste()
    {
        $results = $this->db->query('Select * from produits join categories on produits.pro_cat_id=categories.cat_id order by cat_nom');
        $aListe =$results->result();
        return $aListe;
    }
    
    public function listePrixCroissants()
    {
        $results = $this->db->query('Select * from produits join categories on produits.pro_cat_id=categories.cat_id order by pro_prix');
        $aListe =$results->result();
        return $aListe;
    }
    
    public function listePrixDecroissants()
    {
        $results = $this->db->query('Select * from produits join categories on produits.pro_cat_id=categories.cat_id order by pro_prix desc');
        $aListe =$results->result();
        return $aListe;
    }
    
    public function ajout($data)
    {
        $this->db->insert('produits', $data);
    }
    
    public function details($id)
    {
        $results = $this->db->get_where('produits',array('pro_id'=>$id));
        if (!$results->row())
        {
            echo"<p>L'id ".$id." n'existe pas dans la base de données.</p>";
            exit;
        }
        return $results->row();
    }
    
    public function categories()
    {
        $this->db->where('cat_parent',NULL);
        $results = $this->db->get('categories')->result();
        return $results;
    }
    
    public function sousCategories($cat)
    {
        $this->db->where('cat_parent',$cat);
        $results = $this->db->get('categories')->result();
        return $results;
    }
      
    public function listeCategories()
    {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->join('produits', 'categories.cat_id = produits.pro_cat_id');
        $this->db->group_by('cat_nom');
        $results = $this->db->get()->result();
        return $results;
    }
    
    public function listeCategorie($id)
    {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->join('produits', 'categories.cat_id = produits.pro_cat_id');
        $this->db->where('cat_id',$id);
        $this->db->order_by('pro_prix','ASC');
        $results = $this->db->get()->result();
        return $results;
    }
    
    public function modif($id,$data)
    {
        $this->db->where('pro_id',$id);
        $this->db->update('produits',$data);
    }
    
    public function supprime($id)
    {
        $this->db->where('pro_id',$id);
        $this->db->delete('produits');
    }
    
    public function selectDernierProduit()
    {
        $results = $this->db->query('Select MAX(pro_id) as pro_id,pro_photo from produits')->row();
        return $results;
    }
    
    public function listeBoutique()
    {
        $results = $this->db->query('Select * from produits join categories on produits.pro_cat_id=categories.cat_id where pro_bloque is null order by cat_nom');
        $aListe =$results->result();
        return $aListe;
    }
    
    public function listeBoutiquePrixCroissants()
    {
        $results = $this->db->query('Select * from produits join categories on produits.pro_cat_id=categories.cat_id where pro_bloque is null order by pro_prix');
        $aListe =$results->result();
        return $aListe;
    }
    
    public function listeBoutiquePrixDecroissants()
    {
        $results = $this->db->query('Select * from produits join categories on produits.pro_cat_id=categories.cat_id where pro_bloque is null order by pro_prix desc');
        $aListe =$results->result();
        return $aListe;
    }
    
    public function recherche($data)
    {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->join('produits', 'categories.cat_id = produits.pro_cat_id');
        $this->db->like('cat_nom',$data, 'after');
        $this->db->or_like('pro_libelle',$data, 'after');
        $this->db->or_like('pro_description',$data, 'after');
        $this->db->order_by('pro_prix','ASC');
        $results= $this->db->get()->result();
        return $results;
    }
}

