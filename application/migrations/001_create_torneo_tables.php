<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_torneo_tables extends CI_Migration {

    public function up() {
        // Tabla jugadores
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'nombre' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'habilidad' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'fuerza' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'velocidad' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'reaccion' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'genero' => array(
                'type' => 'VARCHAR',
                'constraint' => '1',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('jugadores');

        // Insertar datos en jugadores
        $data = array(
            array('id' => 1, 'nombre' => 'Nadal Rafael', 'habilidad' => 80, 'fuerza' => 60, 'velocidad' => 90, 'reaccion' => 60, 'genero' => 'm'),
            array('id' => 2, 'nombre' => 'Federer Roger', 'habilidad' => 90, 'fuerza' => 50, 'velocidad' => 60, 'reaccion' => 40, 'genero' => 'm'),
            array('id' => 3, 'nombre' => 'Gaudio Gaston', 'habilidad' => 60, 'fuerza' => 50, 'velocidad' => 30, 'reaccion' => 50, 'genero' => 'm'),
            array('id' => 4, 'nombre' => 'Nalbandian David', 'habilidad' => 80, 'fuerza' => 70, 'velocidad' => 30, 'reaccion' => 50, 'genero' => 'm'),
            array('id' => 5, 'nombre' => 'Djokovic Novak', 'habilidad' => 70, 'fuerza' => 60, 'velocidad' => 80, 'reaccion' => 65, 'genero' => 'm'),
            array('id' => 6, 'nombre' => 'Alcaraz Carlos', 'habilidad' => 60, 'fuerza' => 60, 'velocidad' => 90, 'reaccion' => 80, 'genero' => 'm'),
            array('id' => 8, 'nombre' => 'Hass Tommy', 'habilidad' => 60, 'fuerza' => 43, 'velocidad' => 52, 'reaccion' => 60, 'genero' => 'm'),
            array('id' => 9, 'nombre' => 'Chang Michael', 'habilidad' => 76, 'fuerza' => 38, 'velocidad' => 60, 'reaccion' => 40, 'genero' => 'm'),
            array('id' => 10, 'nombre' => 'Agassi Andre', 'habilidad' => 75, 'fuerza' => 56, 'velocidad' => 71, 'reaccion' => 40, 'genero' => 'm'),
            array('id' => 7, 'nombre' => 'Sampras Pete', 'habilidad' => 68, 'fuerza' => 55, 'velocidad' => 47, 'reaccion' => 80, 'genero' => 'm'),
            array('id' => 12, 'nombre' => 'Evert Chris', 'habilidad' => 70, 'fuerza' => 40, 'velocidad' => 50, 'reaccion' => 60, 'genero' => 'f'),
            array('id' => 13, 'nombre' => 'Hingis Martina', 'habilidad' => 60, 'fuerza' => 50, 'velocidad' => 60, 'reaccion' => 70, 'genero' => 'f'),
            array('id' => 14, 'nombre' => 'Williams Serena', 'habilidad' => 80, 'fuerza' => 80, 'velocidad' => 60, 'reaccion' => 70, 'genero' => 'f'),
            array('id' => 15, 'nombre' => 'Sabatini Gabriela', 'habilidad' => 85, 'fuerza' => 40, 'velocidad' => 60, 'reaccion' => 75, 'genero' => 'f'),
            array('id' => 16, 'nombre' => 'Seles Mónica', 'habilidad' => 60, 'fuerza' => 50, 'velocidad' => 60, 'reaccion' => 70, 'genero' => 'f'),
            array('id' => 17, 'nombre' => 'Williams Venus', 'habilidad' => 80, 'fuerza' => 80, 'velocidad' => 60, 'reaccion' => 50, 'genero' => 'f'),
            array('id' => 18, 'nombre' => 'Henin Justine', 'habilidad' => 60, 'fuerza' => 50, 'velocidad' => 50, 'reaccion' => 60, 'genero' => 'f'),
            array('id' => 19, 'nombre' => 'Navratilova Martina', 'habilidad' => 80, 'fuerza' => 40, 'velocidad' => 60, 'reaccion' => 60, 'genero' => 'f'),
            array('id' => 20, 'nombre' => 'Graf Steffie', 'habilidad' => 80, 'fuerza' => 60, 'velocidad' => 70, 'reaccion' => 70, 'genero' => 'f'),
            array('id' => 21, 'nombre' => 'Davenport Lindsay', 'habilidad' => 60, 'fuerza' => 80, 'velocidad' => 40, 'reaccion' => 55, 'genero' => 'f'),
        );
        $this->db->insert_batch('jugadores', $data);

        // Tabla migrations
        $this->dbforge->add_field(array(
            'version' => array(
                'type' => 'BIGINT',
                'constraint' => 20,
            ),
        ));
        //$this->dbforge->create_table('migrations');

        // Insertar datos en migrations
        $this->db->insert('migrations', array('version' => 1));

        // Tabla partidos
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_torneo' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'jugador_1' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'puntaje_1' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
            ),
            'jugador_2' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'puntaje_2' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
            ),
            'ganador' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
            ),
            'ronda' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('partidos');

        // Tabla torneos
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'fecha' => array(
                'type' => 'DATETIME',
            ),
            'tipo' => array(
                'type' => 'CHAR',
                'constraint' => '1',
            ),
            'ganador' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('torneos');
    }

    public function down() {
        $this->dbforge->drop_table('jugadores');
        $this->dbforge->drop_table('migrations');
        $this->dbforge->drop_table('partidos');
        $this->dbforge->drop_table('torneos');
    }
}
