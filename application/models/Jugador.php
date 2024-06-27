<?php

//namespace App\Models;

//use CodeIgniter\Model;

class Jugador extends CI_Model
{
    private $id;
    private $nombre;
    private $genero;
    private $habilidad = null;
    private $fuerza = null;
    private $velocidad = null;
    private $reaccion = null;

    public function __construct() {

        $this->load->database();  
             
    }

    public function inicializar_jugador($id){ 

        $res = $this->db
                ->select('id, nombre, genero, habilidad, fuerza, velocidad, reaccion')
                ->where('id', $id)
                ->get('jugadores');

        $jugador = $res->row();

        //var_dump( $jugador);

        $this->id = $id;
        $this->nombre = $jugador->nombre;
        $this->genero = $jugador->genero;
        $this->habilidad = $jugador->habilidad;
        $this->fuerza = $jugador->fuerza;
        $this->velocidad = $jugador->velocidad;
        $this->reaccion = $jugador->reaccion;
       

        
    }

    public function get_pts(){ 

        if($this->genero == 'm'){
            //masculino
            $pts = $this->habilidad + ($this->fuerza/2) + ($this->velocidad/2);
        } else {
            //femenino
            $pts = $this->habilidad + ($this->reaccion/2);

        }

        return $pts;

    }
/*
        //definir suertes
        $suerteJ1 = rand(1, 30);
        $suerteJ2 = rand(1, 30);

        //$jugador1_pts = $this->jugador_1->get_pts();
        $jugador1_pts = rand(1, 100);
        //$jugador2_pts = $this->jugador_2->get_pts();
        $jugador2_pts = rand(1, 100);

        $jugador1_pts = $jugador1_pts + $suerteJ1;
        $jugador2_pts = $jugador2_pts + $suerteJ2;
        
        if($jugador1_pts > $jugador2_pts){
            $this->ganador = $jugador_1; 
        } elseif ($jugador2_pts > $jugador1_pts){
            $this->ganador = $jugador_2; 
        } else {
            //si es empate utilizo el método para desempatar
            $this->$ganador = $this->desempatar($jugador_1, $jugador_2);
        }

        //actualizo el ganador del partido
        $partido['ganador'] = $this->ganador;

        $this->db->where('id', $this->id_partido)
                   ->update('partidos', $partido);
                    
        
        return $this->ganador;
        
    */








}

?>