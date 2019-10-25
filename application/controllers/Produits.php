<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produits extends CI_Controller
{
    public function recherche() //permet de recherche un produit ou une catégorie dans la bdd et d'afficher les résultats
    {
        $this->load->model('produits_model');
        
        $this->form_validation->set_rules('recherche', 'recherche', 'htmlspecialchars');
        $data=$this->input->post('recherche');
        $aView["resultat_recherche"] = $this->produits_model->recherche($data); //recherche du terme dans la bdd
        if ($aView["resultat_recherche"]==array()) //si rien n'est trouvé
        {
            $aView["erreur"] = '<div class="alert alert-danger">Les termes de votre recherche n\'ont donné aucun résultat.</div>';
            $this->load->view('resultat_recherche',$aView);
        }
        else //sinon affichage des résultats de la recherche
        {
            $this->load->view('resultat_recherche',$aView);
        }
    }
    
    public function liste()
    {
        $this->load->model('produits_model');
        $aView["liste_produits"] = $this->produits_model->liste();
        $this->load->view('liste',$aView);
    }
    
    public function listeCategorie($id)
    {
        $this->load->model('produits_model');
        $aView["liste_produits"] = $this->produits_model->listeCategorie($id);
        if ($aView["liste_produits"]!=null) 
        {
            $this->load->view('listeCat',$aView);
        }
        else 
        {
            $this->load->model('produits_model');
            $aView["liste_categorie"] = $this->produits_model->listeCategories();
            $aView["erreur"]='<div class="alert alert-danger">Cette catégorie de produits n\'existe pas. Toutes nos catégories sont listées ci-dessous.</div>';;
            $this->load->view('cartes',$aView);
        }
    }
    
    public function sousCategorie($cat)
    {
        $this->load->model('produits_model');
        $aView["liste_sous_categories"] = $this->produits_model->sousCategorie($cat);
        $this->load->view('listeoption2',$aView);
    }
    
    public function listePrixCroissants()
    {
        $this->load->model('produits_model');
        $aView["liste_produits"] = $this->produits_model->listePrixCroissants();
        $this->load->view('liste',$aView);
    }
    
    public function listePrixDecroissants()
    {
        $this->load->model('produits_model');
        $aView["liste_produits"] = $this->produits_model->listePrixDecroissants();
        $this->load->view('liste',$aView);
    }
    
    public function categories()
    {
        $this->load->model('produits_model');
        $aView["liste_categorie"] = $this->produits_model->listeCategories();
        $this->load->view('cartes',$aView);
    }
    
    public function ajout($jeton)
    {
        $this->load->model('produits_model');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('pro_libelle', 'libellé', 'htmlspecialchars|trim|required|max_length[200]',
            array('required' => 'Vous n\'avez pas rempli ce champ.',
                  'max_length' => 'Le %s est trop long (pas plus de 200 caractères).'
            ));
        $this->form_validation->set_rules('pro_ref', 'référence', 'htmlspecialchars|required|is_unique[produits.pro_ref]|max_length[10]|alpha_dash',
            array('required' => 'Vous n\'avez pas rempli ce champ.',
                  'is_unique' => 'Cette %s existe déjà.',
                  'max_length' => 'La %s est trop longue (pas plus de 10 caractères).',
                  'alpha_dash' => 'Format non valide (les espaces ne sont pas autorisés).'
            ));
        $this->form_validation->set_rules('pro_description', 'description', 'htmlspecialchars|required|max_length[1000]',
            array('required' => 'Vous n\'avez pas rempli ce champ.',
                  'max_length' => 'La %s est trop longue (pas plus de 1000 caractères).'
            ));
        $this->form_validation->set_rules('pro_prix', 'prix', 'required|decimal|max_length[7]|greater_than_equal_to[0]',
            array('required' => 'Vous n\'avez pas rempli ce champ.',
                  'decimal' => 'Le %s n\'est pas valide.',
                  'max_length' => 'Le %s ne peut être supérieur à 9 999€.',
                  'greater_than_equal_to' => 'Le %s doit être au moins égal à 0.'
            ));
        $this->form_validation->set_rules('pro_stock', 'stock', 'required|integer|greater_than_equal_to[0]',
            array('required' => 'Vous n\'avez pas rempli ce champ.',
                  'integer' => 'Le %s doit être un nombre entier.',
                  'greater_than_equal_to' => 'Le %s doit être au moins égal à 0.'
            ));
        $this->form_validation->set_rules('pro_couleur', 'couleur', 'htmlspecialchars|required|alpha|max_length[30]',
            array('required' => 'Vous n\'avez pas rempli ce champ.',
                  'alpha' => 'La %s doit être uniquement écrite en lettres.',
                  'max_length' => 'La %s est trop longue (pas plus de 30 caractères)'
            ));
        $this->form_validation->set_rules('pro_photo', 'photo', 'required|in_list[jpg,jpeg,png]',
            array('required' => 'Vous n\'avez pas rempli ce champ.',
                  'in_list' => 'L\'extension saisie n\'est pas dans la liste des extensions autorisées.'));
        if ($this->input->post()) 
        { // 2ème appel de la page: traitement du formulaire
            if ($this->form_validation->run() == FALSE) // si une erreur a été commise dans le remplissage du formulaire, chargement de la page avec l'erreur
            {
                $aView["liste_categories"] = $this->produits_model->categories();
                $this->load->view('ajout',$aView);
            }
            else // sinon inclusion des données dans la bdd
            {
                $data = $this->input->post();
                $this->produits_model->ajout($data); //inclusion des données 
                $produit=$this->produits_model->selectDernierProduit(); //recherche de l'id et de l'extension du produit ajouté
                
                // téléchargement de la photo
                $config['upload_path'] = './assets/images/jarditou_photos/'; // fichier où sera stocké la photo
                $config['file_name'] = $produit->pro_id.'.'.$produit->pro_photo; // nom du fichier final
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 355;
                $config['max_height']           = 550;
                $this->load->library('upload', $config);
                
                if ( ! $this->upload->do_upload('photo'))
                {
                    $id = $produit->pro_id;
                    $this->produits_model->supprime($id);
                    $errors = $this->upload->display_errors("<div class='alert alert-danger'>", "</div>");
                    $aView["liste_categories"] = $this->produits_model->categories();
                    $aView["errors"] = $errors;
                    $this->load->view('ajout', $aView);
                }
                else
                {
                    redirect("produits/liste");
                }
            }
        }
        else if (isset($jeton) && $jeton === $this->session->jeton)
        { // 1er appel de la page: affichage du formulaire
            $aView["liste_categories"] = $this->produits_model->categories();
            $this->load->view('ajout',$aView);
        }
        else
        {
            $message = array();
            $message['erreur']='<div class="text-danger">Une erreur est survenue.</div>';
            $this->load->view('erreur',$message);
        }
    }
      
    public function details($id)
    {
        $fil = '<a href="';
        $lien = 'http://projetphp/ci/index.php/produits/liste/';
        $texte = '">Accueil</a>';
        $this->load->model('produits_model');
        $aView["fil_ariane"]=$this->tisserFilAriane($fil, $lien, $texte);
        $aView["details_produit"] = $this->produits_model->details($id);
        $this->load->view('details',$aView);
    }
    
    public function modif($id,$jeton)
    {
        $this->load->model('produits_model');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('pro_libelle', 'libellé', 'htmlspecialchars|trim|max_length[200]',
            array('max_length' => 'Le %s est trop long (pas plus de 200 caractères).'
            ));
        $this->form_validation->set_rules('pro_ref', 'référence', 'htmlspecialchars|max_length[10]|alpha_dash',
            array('max_length' => 'La %s est trop longue (pas plus de 10 caractères).',
                  'alpha_dash' => 'Format non valide (les espaces ne sont pas autorisés).'
            ));
        $this->form_validation->set_rules('pro_description', 'description', 'htmlspecialchars|max_length[1000]',
            array('max_length' => 'La %s est trop longue (pas plus de 1000 caractères).'
            ));
        $this->form_validation->set_rules('pro_prix', 'prix', 'htmlspecialchars|decimal|max_length[7]|greater_than_equal_to[0]',
            array('decimal' => 'Le %s n\'est pas valide.',
                  'max_length' => 'Le %s ne peut être supérieur à 9 999€.',
                  'greater_than_equal_to' => 'Le %s doit être au moins égal à 0.'
            ));
        $this->form_validation->set_rules('pro_stock', 'stock', 'htmlspecialchars|integer|greater_than_equal_to[0]',
            array('integer' => 'Le %s doit être un nombre entier.',
                  'greater_than_equal_to' => 'Le %s doit être au moins égal à 0.'
            ));
        $this->form_validation->set_rules('pro_couleur', 'couleur', 'htmlspecialchars|alpha|max_length[30]',
            array('alpha' => 'La %s doit être uniquement écrite en lettres.',
                  'max_length' => 'La %s est trop longue (pas plus de 30 caractères)'
            ));
        $this->form_validation->set_rules('pro_photo', 'photo', 'in_list[jpg,jpeg,png]',
            array('in_list' => 'L\'extension saisie n\'est pas dans la liste des extensions autorisées.'));
            
        if ($this->input->post()) //appel de la page quand le formulaire a été soumis
        {
            if ($this->form_validation->run() == FALSE) // si une erreur a été commise dans le remplissage du formulaire, chargement de la page avec l'erreur
            {
                $model["produits"] = $this->produits_model->details($id);
                $model["categories"] = $this->produits_model->categories();
                $this->load->view('modif', $model);
            }
            else //si pas d'erreur dans le remplissage du formulaire, chargement des nouvelles données
            {
                $data=$this->input->post();
                $pro_bloque = ($this->input->post('pro_bloque')==FALSE)? NULL : $this->input->post('pro_bloque');
                $data['pro_bloque']=$pro_bloque;
                $this->produits_model->modif($id,$data);
                redirect("produits/liste");
            }
        }
        else if (isset($jeton) && $jeton == $this->session->jeton) //premier appel de la page
        {
            $model["produits"] = $this->produits_model->details($id);
            $model["categories"] = $this->produits_model->categories();
            $this->load->view('modif', $model);
        }
        else
        {
            $message = array();
            $message['erreur']='<div class="text-danger">Une erreur est survenue.</div>';
            $this->load->view('erreur',$message);
        }
    }
    
    public function supprime($id,$jeton)
    {
        $this->load->model('produits_model'); 
        if ($this->input->post()) //quand le bouton de suppression a été activé, appel de la fonction de suppression dans la base de données
        {
            if ($this->input->post("jeton") == $this->session->jeton) 
            {
                $this->produits_model->supprime($id);
                redirect("produits/liste");
            }
            else 
            {
                $model["produits"] = $this->produits_model->details($id);
                $model["erreur"] = '<div class="alert alert-danger">Le jeton est inconnu.</div>';
                $this->load->view('supprime', $model);
            }
        }
        else if (isset($jeton) && $jeton == $this->session->jeton)// premier appel de la page
        {
            $this->session->jeton = bin2hex(openssl_random_pseudo_bytes(6));
            $model["produits"] = $this->produits_model->details($id); 
            $this->load->view('supprime', $model);
        }
        else 
        {
            $message = array();
            $message['erreur']='<div class="text-danger">Une erreur est survenue.</div>';
            $this->load->view('erreur',$message);
        }
    }
    
    public function tableau()
    {
        $this->load->view('tableau');
    }
    
    public function contactjarditou()
    {
        $this->load->view('contactjarditou');
    }
    
    public function tisserFilAriane($fil,$lien,$texte)
    {
        $fil_ariane = $fil.$lien.$texte;
        return $fil_ariane;
    }
}