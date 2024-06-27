<?php

//namespace App\Models;

//use CodeIgniter\Model;

class Partido extends CI_Model
{
    private $jugador_1;
    private $jugador_2;
    private $ganador = null;
    private $id_partido = null;
    private $id_torneo = null;

    public function __construct() {

        $this->load->database();
        $this->load->model('Jugador');  
             
    }

    public function resolver_partido($jugador_1, $jugador_2, $id){ 
        
        $this->jugador_1 = new Jugador();
        $this->jugador_1->inicializar_jugador($jugador_1);
        
        $this->jugador_2 = new Jugador();
        $this->jugador_2->inicializar_jugador($jugador_2);
        
        $this->id_partido = $id;

        //definir suertes
        $suerteJ1 = rand(1, 30);
        $suerteJ2 = rand(1, 30);

        $jugador1_pts = $this->jugador_1->get_pts();
        //$jugador1_pts = rand(1, 100);
        $jugador2_pts = $this->jugador_2->get_pts();
        //$jugador2_pts = rand(1, 100);

        $jugador1_pts = $jugador1_pts + $suerteJ1;
        $jugador2_pts = $jugador2_pts + $suerteJ2;
        
        if($jugador1_pts > $jugador2_pts){
            $this->ganador = $jugador_1; 
        } elseif ($jugador2_pts > $jugador1_pts){
            $this->ganador = $jugador_2; 
        } else {
            //si es empate utilizo el método para desempatar
            $this->ganador = $this->desempatar($jugador_1, $jugador_2);
        }

        //actualizo el ganador del partido
        $partido['ganador'] = $this->ganador;
        $partido['puntaje_1'] = $jugador1_pts;
        $partido['puntaje_2'] = $jugador2_pts;

        $this->db->where('id', $this->id_partido)
                   ->update('partidos', $partido);
                    
        
        return $this->ganador;
        
    }

    private function desempatar($jugador_1, $jugador_2){
        $numero = rand(1, 100);

        // Verificar si el número es impar o par
        if ($numero % 2 == 0) {
            return $jugador_1;
        } else {
            return $jugador_2;
        }
    }






}

?>