<?php 
// --
class M_Products extends Model {
    // --
    public function __construct() {
		parent::__construct();
    }

    // Consulta para traer los 4 productos destacados
    public function get_products_home() {
        try {
            // Ajusta los nombres de las columnas según tu tabla 'products'
            $sql = "SELECT id, name, price, image, category FROM products WHERE status = 1 LIMIT 4";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en M_Products: " . $e->getMessage());
            return [];
        }
    }
}