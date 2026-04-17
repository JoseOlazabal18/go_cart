<?php

// Model pequeño para leer la configuracion SMTP almacenada en base de datos.
// Se usa como fallback cuando no existe un archivo .env.
class M_MailConfig extends Model {

    public function __construct() {
        parent::__construct();
    }

    // Toma la primera configuracion disponible de la tabla token.
    public function get_mail_settings() {
        $sql = 'SELECT host, email, password
                FROM token
                ORDER BY id ASC
                LIMIT 1';

        $statement = $this->pdo->query($sql);

        return $statement->fetch();
    }
}
