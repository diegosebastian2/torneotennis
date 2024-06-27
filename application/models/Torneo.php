<?php

//namespace App\Models;

//use CodeIgniter\Model;

class Torneo extends CI_Model
{
    private $jugadores = array();
    private $ganador = array();
    private $tipo_torneo = "";
    private $id_torneo = null;
    private $id_ganador = null;
    //private $fecha = "";

    public function __construct() {

        $this->load->database();
        
		$this->load->model('Partido');
             
    }

    public function armar_torneo($tipo){
        //seteo el tipo de torneo (m/f)
        $this->tipo_torneo = $tipo;

        //insert del torneo
        $torneo['fecha'] = date("Y-m-d H:i:s");
        $torneo['tipo'] = $tipo;
        $this->db->insert('torneos', $torneo);

        //seteo el id de torneo
        $this->id_torneo = $this->db->insert_id();       
       
        //selecciono los jugadores por genero
        $res = $this->db
                        ->select('id, nombre')
                        ->where('genero', $tipo)
                        //->limit(8)
                        ->get('jugadores');
        
        //seteo el listado de jugadores que van a participar
        $this->jugadores =  $res->result();

    }

    public function armar_cuadro(){
        
        $cant_jugadores = count($this->jugadores);
        $maximo_jugadores = $this->maximo_jugadores($cant_jugadores);

        $jugadores_sobrantes = $cant_jugadores - $maximo_jugadores;
        //desordeno la lista de jugadores para armar los partidos aleatoriamente
        shuffle($this->jugadores);
        for ($i=0; $i <$jugadores_sobrantes ; $i++) { 
            array_pop($this->jugadores);
        }

        $partido['jugador_1'] = $partido['jugador_2']  = null;
        $partido['id_torneo'] = $this->id_torneo;
        $partido['ronda'] = 1;

        foreach($this->jugadores as $k => $v){
            if(!$partido['jugador_1'] ){

                $partido['jugador_1'] = $v->id;

            }elseif(!$partido['jugador_2']){
                
                $partido['jugador_2'] = $v->id;

                //guardo el partido y limpio los jugadores
                $this->db->insert('partidos', $partido);
                $partido['jugador_1'] = $partido['jugador_2']  = null;               
            }
        }
    }

    public function resolver_cuadro(){

        //selecciono los partidos del torneo
        $res = $this->db
            ->select('jugador_1, jugador_2, id')
            ->where('id_torneo', $this->id_torneo)
            ->get('partidos');

        //seteo el listado de jugadores que van a participar
        $partidos =  $res->result();

        $partido['ronda'] = 2;

        while (!$this->id_ganador) {
            foreach ($partidos as $k => $v) {

                $p = new Partido();
               
                //var_dump($v);
                $ganadores[] = $p->resolver_partido($v->jugador_1,$v->jugador_2, $v->id);
                //$ganadores[] = $v->jugador_1;
                
            }

            //var_dump($ganadores);
            //die();
    
            if(count($ganadores)==1){
                $this->id_ganador = $torneo['ganador'] = $ganadores[0];

                $this->db->where('id', $this->id_torneo)
                        ->update('torneos', $torneo);

            }else{
    
                $j1 = $j2 = null;
                $partidos = array();
                $partido['id_torneo'] = $this->id_torneo; 
                foreach($ganadores as $k => $v){
                    if(!$j1){
                        $j1= $partido['jugador_1'] = $v;
                    }elseif(!$j2){                
                        $j2= $partido['jugador_2'] = $v;
    
                        //guardo el partido y limpio los jugadores
                        $this->db->insert('partidos', $partido);
                        $pobj = new stdClass();
                        $pobj->jugador_1 = $j1;
                        $pobj->jugador_2 = $j2;
                        $pobj->id = $this->db->insert_id();
                        //$partidos[] = json_decode('{"jugador_1":$j1,"jugador_2":$j2}');
                        $partidos[] = $pobj;
                        $j1 = $j2 = $partido['jugador_1'] = $partido['jugador_2']  = null;
                    }
                }
            }

            //var_dump($partidos);
            //die();
            $partido['ronda'] ++;
            $ganadores = array();
        }

        


    }

    private function maximo_jugadores($length) {
        $potencia = 1;
        
        // Encuentra la mayor potencia de 2 menor o igual a la longitud
        while ($potencia * 2 <= $length) {
            $potencia *= 2;
        }
        
        return $potencia;
    }
  
    public function get_partidos(){

        //selecciono los partidos del torneo
        $res = $this->db
            ->select('p.jugador_1, p.puntaje_1, p.jugador_2, p.puntaje_2, p.ronda, p.ganador, j1.nombre as nombre_1, j2.nombre as nombre_2')
            ->join('jugadores j1','j1.id = p.jugador_1')
            ->join('jugadores j2','j2.id = p.jugador_2')
            ->where('p.id_torneo', $this->id_torneo)
            ->order_by('p.ronda asc')
            ->get('partidos p');

        //seteo el listado de partidos de ese torneo
        $partidos =  $res->result();

        foreach($partidos as $k => $v){
            $p['jugador_1'] = $v->jugador_1;
            $p['jugador_2'] = $v->jugador_2;
            $p['puntaje_1'] = $v->puntaje_1;
            $p['puntaje_2'] = $v->puntaje_2;
            $p['nombre_1'] = $v->nombre_1;
            $p['nombre_2'] = $v->nombre_2;
            $p['ganador'] = $v->ganador;

            $par[$v->ronda][] = $p;
        }

        return $par;
    }

}

?>