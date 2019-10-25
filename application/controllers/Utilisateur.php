<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur extends CI_Controller
{
    public function inscription()
    {
        $this->load->model('session_model');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('nom', 'nom', 'htmlspecialchars|max_length[30]|required|regex_match[/^([a-zA-Z\'àâäãåéèêëôöœøùûüçñÀÂÄÃÅÉÈËÔÖŒØÙÛÜÇÑ\s -]{1,30})$/]',
            array('max_length' => 'Le %s est trop long (pas plus de 30 caractères).',
                  'required' => 'Ce champ est obligatoire.',
                  'regex_match' => 'Ce champ comporte des caractères non autorisés.'
            ));
        $this->form_validation->set_rules('prenom', 'prénom', 'htmlspecialchars|max_length[30]|required|regex_match[/^([a-zA-Z\'àâäãåéèêëôöœøùûüçñÀÂÄÃÅÉÈËÔÖŒØÙÛÜÇÑ\s -]{1,30})$/]',
            array('max_length' => 'Le %s est trop long (pas plus de 30 caractères).',
                  'required' => 'Ce champ est obligatoire.',
                  'regex_match' => 'Ce champ comporte des caractères non autorisés.'
            ));
        $this->form_validation->set_rules('login', 'identifiant', 'max_length[100]|valid_email|required|is_unique[utilisateurs.login]',
            array('max_length' => 'L\'%s est trop long (pas plus de 100 caractères).',
                'valid_email' => 'L\'%s n\'est pas valide (doit être une adresse mel).',
                'required' => 'Ce champ est obligatoire.',
                'is_unique' => 'Cet identifiant existe déjà.'
            ));
        $this->form_validation->set_rules('mot_de_passe', 'mot de passe', 'max_length[20]|min_length[8]|required',
            array('max_length' => 'Le %s est trop long (pas plus de 20 caractères).',
                'min_length' => 'Le %s est trop court (pas moins de 8 caractères).',
                'required' => 'Ce champ est obligatoire.'
            ));
        $this->form_validation->set_rules('mot_de_passe_confirme', 'mot de passe', 'required|matches[mot_de_passe]',
            array('required' => 'La confirmation du mot de passe est obligatoire.',
                  'matches' => 'Le mot de passe confirmé doit correspondre au mot de passe.'));
        if ($this->input->post("valider")) //quand le formulaire a été soumis, appel de la fonction d'ajout dans la base de données
        {
            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('inscription');
            }
            else 
            {
                $date = date('Y-m-d');
                $data = array(
                    'nom' => $_POST['nom'],
                    'prenom' => $_POST['prenom'],
                    'login' => $_POST['login'],
                    'mot_de_passe' => password_hash($_POST['mot_de_passe'],PASSWORD_DEFAULT),
                    'date_inscription' => $date
                );
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $login = $_POST['login'];
                
                $this->load->library('email');
                
                $config['charset'] = 'utf-8';
                $config['wrapchars'] = '70';
                $config['newline'] = "\r\n";
                $config['crlf'] = "\r\n";
                $this->email->initialize($config);
                
                $this->email->from('mikael.blondel@hotmail.fr', 'Jarditou');
                $this->email->to($login);
                
                $this->email->subject('Bienvenue parmi nous '.$prenom.'🌷');
                $this->email->message("Félicitations ".$prenom." ".$nom."!\r\n\r\nVous êtes maintenant inscrit sur le site Jarditou. Vous pouvez dès à présent vous connecter et profiter de nos nombreux services, tels que notre boutique en ligne.\r\n\r\nCordialement,\r\n\r\nL'administrateur Jarditou ");
                
                if ($this->email->send())
                {
                    $this->session_model->inscription($data);
                    redirect("utilisateur/connexion");
                }
                else
                {
                    $message['erreur']='<div class="text-success">Erreur dans l\'envoi du courriel de confirmation. Assurez-vous de ne pas avoir fait d\'erreur en écrivant votre identifiant.</div>';
                    $this->load->view('inscription',$message);
                }
            }
        }
        else  if ($this->session->login == null)// premier appel de la page
        {
            $this->load->view('inscription');
        }
        else
        {
            $message = array();
            $message['erreur']='<div class="text-danger">Vous êtes déjà inscrit.</div>';
            $this->load->view('erreur',$message);
        }
    }
    
    public function connexion()
    {
        $this->load->model('session_model');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('login', 'identifiant', 'valid_email|required',
            array('valid_email' => 'L\' %s n\'est pas valide (doit être une adresse mel).',
                'required' => 'Ce champ est obligatoire.'
            ));
        $this->form_validation->set_rules('mot_de_passe', 'mot de passe', 'required',
            array('required' => 'Ce champ est obligatoire.'
            ));
        if ($this->input->post()) //quand le formulaire a été soumis, appel de la fonction
        {
            if ($this->form_validation->run() == FALSE) // si une erreur a été commise dans le remplissage du formulaire, chargement de la page avec l'erreur
            {
                $this->load->view('connexion');
            }
            else
            {
                $login = $_POST['login'];
                $resultat = $this->session_model->connexion($login); // chargement des données de l'utilisateur correspondant au login donné
                if ($resultat!=null && $_SESSION['échec'] < 3 && $resultat->util_bloque==0) //si l'utilisateur a été trouvé dans la base de données et n'est pas bloqué
                {
                    if ($resultat->util_bloque ==1) //si l'utilisateur est bloqué suite à un oubli de mot de passe, il ne peut se connecter tant qu'il n'a pas changé son mot de passe
                    {
                        $data = array();
                        $data["erreur"] = '<div class="alert alert-danger">Vous devez changer de mot de passe avant de pouvoir vous connecter. Veuillez suivre le lien qui vous a été envoyé par courriel.</div>';
                        $this->load->view('connexion',$data);
                    }
                    else if (password_verify($_POST['mot_de_passe'],$resultat->mot_de_passe) && $_SESSION['échec'] < 3) // si le mot de passe est correct et compteur d'échec suffisamment petit, connexion
                    {
                        unset($_SESSION['échec']); 
                        $this->session->login=$resultat->login; //création des variables de session
                        $this->session->util_id=$resultat->id;
                        $this->session->nom=$resultat->nom;
                        $this->session->prenom=$resultat->prenom;
                        $this->session->rôle=$resultat->util_role;
                        $this->session->jeton = bin2hex(openssl_random_pseudo_bytes(6));
                        
                        $date = date('Y-m-d');
                        $data = array('date_connexion' => $date);
                        $this->session_model->dateConnexion($login,$data);
                        
                        redirect('produits/liste');
                    }
                    else if ($_SESSION['échec'] >= 3) //si compteur d'échecs trop grand
                    {
                        $this->session->mark_as_temp('échec',120); //compteur d'échecs déclaré temporaire pendant 2 min
                        $data = array();
                        $data["erreur"] = '<div class="alert alert-danger">Vous avez échoué trop de fois à vous connecter et vous êtes temporairement bloqué. Veuillez patienter un moment.</div>';
                        $this->load->view('connexion',$data);
                    }
                    else 
                    {
                        $_SESSION['échec'] ++ ; //en cas d'échec de connexion, incrémentation du compteur d'échecs
                        $essai = 4 - $_SESSION['échec'];
                        $data = array();
                        $data["erreur"] = '<div class="alert alert-danger">Le mot de passe ou l\'identifiant est incorrect. Vous avez encore '.$essai.' essais.</div>';
                        $this->load->view('connexion',$data);
                    }
                }
                else if ($_SESSION['échec'] >= 3)
                {
                    $this->session->mark_as_temp('échec',120);
                    $data = array();
                    $data["erreur"] = '<div class="alert alert-danger">Vous avez échoué trop de fois à vous connecter et vous êtes temporairement bloqué. Veuillez patienter un moment.</div>';
                    $this->load->view('connexion',$data);
                }
                else
                {
                    $_SESSION['échec'] ++ ;
                    $essai = 4 - $_SESSION['échec'];
                    $data = array();
                    $data["erreur"] = '<div class="alert alert-danger">Le mot de passe ou l\'identifiant est incorrect. Vous avez encore '.$essai.' essais.</div>';
                    $this->load->view('connexion',$data);
                }
            }
        }
        else if ($this->session->login == null)// premier appel de la page
        {
            isset($_SESSION['échec'])? $_SESSION['échec']: $_SESSION['échec'] = 0; //compteur d'échec de connexion (mot de passe ou identifiant non valide)
            $data = array();
            if ($_SESSION['échec'] >= 3) { //si trop d'échec
                $this->session->mark_as_temp('échec',120); //connexion temporairement impossible
                $data["erreur"] = '<div class="alert alert-danger">Vous avez échoué trop de fois à vous connecter et vous êtes temporairement bloqué. Veuillez patienter un moment.</div>';
            }    
            $this->load->view('connexion',$data);
        }
        else 
        {
            $message = array();
            $message['erreur']='<div class="text-danger">Vous êtes déjà connecté.</div>';
            $this->load->view('erreur',$message);
        }
    }

    public function deconnexion()
    {
        $this->session->login = array();
        $this->session->nom = array();
        $this->session->prenom = array();
        $this->session->jeton = array();
        
        unset($this->session->login);
        unset($this->session->nom);
        unset($this->session->prenom);
        unset($this->session->jeton);
        
        if (ini_get("session.use_cookies"))
        {
            setcookie(session_name(), '', time()-42000);
        }
        
        session_destroy();
        redirect('produits/liste');
    }
    
    public function mdpoublie()
    {
        $this->load->model('session_model');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('login', 'identifiant', 'valid_email|required',
            array('valid_email' => 'L\'%s n\'est pas valide (doit être une adresse mel).',
                  'required' => 'Ce champ est obligatoire.'
            ));
        if ($this->input->post())
        {
            if ($this->form_validation->run() == FALSE) // si une erreur a été commise dans le remplissage du formulaire, chargement de la page avec l'erreur
            {
                $this->load->view('mdpoublie');
            }
            else
            {
                $login = $_POST['login'];
                $resultat = $this->session_model->connexion($login); // chargement des données de l'utilisateur correspondant au login donné
                if ($resultat!=null)
                {
                    $data = $this->input->post();
                        
                    $this->load->library('email'); //envoi d'un courriel avec un lien permettant d'accéder à une page pour changer de mot de passe
                    
                    $config['charset'] = 'utf-8';
                    $config['wrapchars'] = '70';
                    $config['newline'] = "\r\n";
                    $config['crlf'] = "\r\n";
                    $this->email->initialize($config);
                    
                    $this->email->from('mikael.blondel@hotmail.fr', 'Jarditou');
                    $this->email->to($login);
                    
                    $this->email->subject('Mot de passe oublié');
                    $this->email->message("Bonjour ".$resultat->prenom." ".$resultat->nom.",\r\n\r\nVous avez oublié votre mot de passe. Pour en saisir un nouveau, veuillez cliquer sur le lien suivant et suivre les instructions : {unwrap}http://projetphp/ci/index.php/utilisateur/changerMdp/".$resultat->util_id."{/unwrap} .\r\n\r\nCordialement,\r\n\r\nL'administrateur Jarditou ");
                    
                    if ($this->email->send())
                    {
                        $this->session_model->bloquerUtilisateur($login); //blocage de l'utilisateur tant que le mot de passe n'a pas été modifié
                        $this->load->view('recapmail');
                    }
                    else 
                    {
                        $data = array();
                        $data["erreur"] = '<div class="alert alert-danger">Le courriel n\'a pas pu être envoyé.</div>';
                        $this->load->view('mdpoublie',$data);
                    }
                }
                else 
                {
                    $data = array();
                    $data["erreur"] = '<div class="alert alert-danger">L\'identifiant est inconnu.</div>';
                    $this->load->view('mdpoublie',$data);
                }
            }
        }
        else //premier appel de la page
        {
            $this->load->view('mdpoublie');
        }
    }
    
    public function compte($jeton)
    {
        if (isset($jeton) && $jeton==$this->session->jeton) 
        {
            $this->load->view('moncompte');
        }
        else 
        {
            $message = array();
            $message['erreur']='<div class="text-danger">Une erreur est survenue.</div>';
            $this->load->view('erreur',$message);
        }
    }
    
    public function changerMdp($id) 
    {
        $this->load->model('session_model');
        $bloque = $this->session_model->estBloque($id); //vérification que l'utilisateur dont l'id est dans l'url est bien bloqué et qu'il souhaite donc changer de mot de passe
        if ($bloque) 
        {
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            $this->form_validation->set_rules('mot_de_passe', 'mot de passe', 'max_length[20]|min_length[8]|required',
                array('max_length' => 'Le %s est trop long (pas plus de 20 caractères).',
                    'min_length' => 'Le %s est trop court (pas moins de 8 caractères).',
                    'required' => 'Ce champ est obligatoire.'
                ));
            $this->form_validation->set_rules('mot_de_passe_confirme', 'mot de passe', 'required|matches[mot_de_passe]',
                array('required' => 'La confirmation du mot de passe est obligatoire.',
                      'matches' => 'Le mot de passe confirmé doit correspondre au mot de passe.'));
            if ($this->input->post())
            {
                if ($this->form_validation->run() == FALSE) // si une erreur a été commise dans le remplissage du formulaire, chargement de la page avec l'erreur
                {
                    $this->load->view('changer_mot_de_passe');
                }
                else
                {
                    $mdp = password_hash($this->input->post('mot_de_passe'),PASSWORD_DEFAULT); 
                    $this->session_model->changerMdp($id,$mdp); //changement du mot de passe
                    $message = array();
                    $message['confirmation'] = '<div class="text-success">Vous pouvez maintenant vous connecter avec votre nouveau mot de passe.</div>';
                    redirect('utilisateur/connexion',$message);
                }
            }
            else
            {
                $this->load->view('changer_mot_de_passe');
            }
        }
        else 
        {
            $message['erreur']='<div class="text-danger">Une erreur est survenue.</div>';
            $this->load->view('erreur',$message); //chargement d'une page d'erreur si l'id dans l'url ne correspond pas à celui d'un utilisateur souhaitant changer de mot de passe
        }
    }
}





