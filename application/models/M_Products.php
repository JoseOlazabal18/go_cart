<?php 
// --
class M_Products extends Model {
    // --
    public function __construct() {
		parent::__construct();
    }

public function get_products_limit() {
        try {
            $sql = 'SELECT 
                        id,
                        code,
                        name,
                        description,
                        price
                    FROM products
                    WHERE status = 1
                    LIMIT 4';

            // 🔥 CORRECTO
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($result) {
                $response = array('status' => 'OK', 'result' => $result);
            } else {
                $response = array('status' => 'ERROR', 'result' => array());
            }

        } catch (PDOException $e) {
            $response = array('status' => 'EXCEPTION', 'result' => $e);
        }

        return $response;
    }
}