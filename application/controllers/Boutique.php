<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* \class Boutique
* \author Mikaël Blondel
* \version 1.0
* \date 17 juin 2019
* \brief La classe Boutique permet de gérer le panier du site.
* \details Cette classe permet de créer un panier, d'y ajouter ou d'en supprimer des produits, de l'afficher, de le modifier et de le supprimer
*/

class Boutique extends CI_Controller
{
    /**
     * \brief Méthode qui ajoute un produit dans le panier et affiche la page boutique
     * \details Lorsque l'utilisateur est connecté grâce à son \a login et qu'il transmet les données \data d'un produit, 
     *          le \a panier est complété s'il existe ou créé sinon et la page de la boutique est chargée en affichant les informations \aView des produits. 
     *          Si le produit existe déjà dans le \a panier, un message d'\a erreur est envoyé.
     * \param   aView    données issues du tableau produits de la base de données    
     * \param   data    données transmises via la méthode post quand l'utilisateur ajoute un produit au panier (quantité, prix, id, libellé)
     * \param   panier    contenu du panier
     */
    
    public function ajoute($aView)
    {
        if (isset($_SESSION['login'])) //si l'utilisateur est connecté
        {
            $data=$this->input->post();
            if ($this->session->panier==null) //création du panier s'il n'existe pas
            {
                $this->session->panier = array();
                $tab=$this->session->panier;
                //On ajoute le produit
                array_push($tab,$data);
                $this->session->panier = $tab;
                $this->load->view('boutique',$aView);
            }
            else //si le panier existe
            {
                $tab=$this->session->panier; 
                $idProduit=$this->input->post('pro_id');
                $sortie = false;
                foreach ($tab as $produit) //on cherche si le produit existe déjà dans le panier
                {
                    if ($produit['pro_id'] == $idProduit) 
                    {
                        $sortie = true;
                    }
                }
                if ($sortie) //si le produit existe déjà, l'utilisateur est averti
                {
                    $aView["erreur"]='<div class="alert alert-danger">Ce produit est déjà présent dans le panier.</div>';
                    $this->load->view('boutique',$aView);
                }
                else //sinon le produit est ajouté dans le panier
                {
                    array_push($tab,$data);
                    $this->session->panier = $tab;
                    $this->load->view('boutique',$aView);
                }
            }
        }
        else
        {
            $aView["erreur"]='<div class="alert alert-danger">Veuillez vous connecter pour ajouter un produit dans le panier.</div>';
            $this->load->view('boutique',$aView);
        }
    }
    
    /**
     * \brief Méthode qui affiche la page boutique
     * \details Cette méthode affiche la page boutique lors du premier chargement de cette page, ou appelle la méthode ajoute() 
     *          lorsque l'utilisateur ajoute un produit dans le panier
     * \param   aView    données issues du tableau produits de la base de données
     */
    
    public function listeBoutique()
    {
        $this->load->model('produits_model');
        $aView["liste_produits"] = $this->produits_model->listeBoutique();
        if ($this->input->post()) //deuxième appel de la page quand une tentative d'ajout au panier est effectuée
        {
            $this->ajoute($aView);
        }
        else
        {
            $this->load->view('boutique',$aView);
        }
    }
    
    /**
     * \brief Méthode qui liste les produits par prix croissants et affiche la page boutique
     * \details Cette méthode affiche la page boutique lors du premier chargement de cette page, ou appelle la méthode ajoute()
     *          lorsque l'utilisateur ajoute un produit dans le panier, en classant les produits par prix croissants
     * \param   aView    données issues du tableau produits de la base de données où les produits sont classés par prix croissants
     */
    
    public function listePrixCroissants()
    {
        $this->load->model('produits_model');
        $aView["liste_produits"] = $this->produits_model->listeBoutiquePrixCroissants();
        if ($this->input->post()) //deuxième appel de la page quand une tentative d'ajout au panier est effectuée
        {
            $this->ajoute($aView);
        }
        else
        {
            $this->load->view('boutique',$aView);
        }
    }
    
    /**
     * \brief Méthode qui liste les produits par prix décroissants et affiche la page boutique
     * \details Cette méthode affiche la page boutique lors du premier chargement de cette page, ou appelle la méthode ajoute()
     *          lorsque l'utilisateur ajoute un produit dans le panier, en classant les produits par prix décroissants
     * \param   aView    données issues du tableau produits de la base de données où les produits sont classés par prix décroissants
     */
    
    public function listePrixDecroissants()
    {
        $this->load->model('produits_model');
        $aView["liste_produits"] = $this->produits_model->listeBoutiquePrixDecroissants();
        if ($this->input->post()) //deuxième appel de la page quand une tentative d'ajout au panier est effectuée
        {
            $this->ajoute($aView);
        }
        else
        {
            $this->load->view('boutique',$aView);
        }
    }
    
    /**
     * \brief Méthode qui charge la page panier
     * \details Cette méthode affiche la page panier
     */
    
    public function affiche()
    {
        $this->load->view('panier');
    }
    
    /**
     * \brief Méthode qui efface le \a panier puis qui charge la page panier
     * \details Cette méthode affiche la page panier après avoir effacé le \a panier
     * \param   panier    représente le contenu du panier effacé par cette méthode
     */
    
    public function efface()
    {
        $this->session->panier=array();
        $this->affiche();
    }
    
    /**
     * \brief Méthode qui supprime un des produits du panier
     * \details Cette méthode permet d'effacer uniquement un des produits du panier puis charge la page panier
     * \param   id    correspond au numéro du produit à supprimer du panier
     * \param   jeton    numéro sécurisant l'étape de suppression
     */
    
    public function effaceProduit($id,$jeton)
    {
        $tab=$this->session->panier;
        $temp=array(); //création d'un tableau temporaire vide
        if (isset($jeton) && $jeton == $this->session->jeton) 
        {
            for ($i=0; $i<count($tab); $i++) //on cherche dans le panier les produits à ne pas supprimer
            {
                if ($tab[$i]['pro_id'] !== $id)
                {
                    array_push($temp, $tab[$i]); //ces produits sont ajoutés dans le tableau temporaire
                }
            }
            $tab=$temp;
            unset($temp);
            $this->session->panier=$tab; //le panier prend la valeur du tableau temporaire et ne contient donc plus le produit à supprimer
            $this->affiche();
        }
        else 
        {
            $data['erreur'] = '<div class="alert alert-danger">Jeton invalide</div>';
            $this->load->view('panier',$data);
        }
    }
    
    /**
     * \brief Méthode qui diminue la quantité d'un des produits du panier
     * \details Cette méthode permet de diminuer d'une unité la quantité du produit dont le numéro est \a id. 
     *          Elle bloque l'opération quand la quantité arrive à 1. 
     *          Une fois la quantité diminuée, la page panier est rechargée.
     * \param   id    correspond au numéro du produit dont la quantité doit être diminuée
     */
    
    public function qtemoins($id)
    {
        $tab=$this->session->panier; //tableau panier placé dans un tableau tab
        $temp=array(); //tableau temporaire vide
        for ($i=0; $i<count($tab); $i++) //on parcourt le tableau produit après produit
        {
            if ($tab[$i]['pro_id'] !== $id) //quand le produit rencontré dans le tableau tab ne correspond pas au produit dont la qté doit être diminuée
            {
                array_push($temp, $tab[$i]); //les données de ce produit sont ajoutées dans le tableau temporaire
            }
            else //sinon la quantité du produit est décrémentée sauf si on est à 1
            {
                if ($tab[$i]['pro_qte'] > 1) 
                {
                    $tab[$i]['pro_qte']--;
                }
                else
                {
                    $tab[$i]['pro_qte'] = 1; 
                }
                array_push($temp, $tab[$i]); //les nouvelles données sont introduites dans le tableau temporaire
            }
        }
        $tab=$temp;
        unset($temp);
        $this->session->panier=$tab; //les données du tableau temporaire remplacent les anciennes données du tableau
        redirect('boutique/affiche');
    }
    
    /**
     * \brief Méthode qui accroît la quantité d'un des produits du panier
     * \details Cette méthode permet d'incrémenter d'une unité la quantité du produit dont le numéro est \a id.
     *          Une fois la quantité incrémentée, la page panier est rechargée.
     * \param   id    correspond au numéro du produit dont la quantité doit être augmentée
     */
    
    public function qteplus($id)
    {
        $tab=$this->session->panier;
        $temp=array();
        for ($i=0; $i<count($tab); $i++) //on parcourt le tableau produit après produit
        {
            if ($tab[$i]['pro_id'] !== $id)
            {
                array_push($temp, $tab[$i]);
            }
            else
            {
                $tab[$i]['pro_qte']++;
                array_push($temp, $tab[$i]);
            }
        }
        $tab=$temp;
        unset($temp);
        $this->session->panier=$tab;
        redirect('boutique/affiche');
    }
}




