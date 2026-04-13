<?php

class M_Products extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Obtener todos los productos para el listado principal
    public function get_products()
    {
        try {
            $sql = 'SELECT 
                        p.id AS id_product,
                        p.code,
                        p.id_unit,
                        u.description AS unit,
                        p.name,
                        p.description,
                        p.price,
                        p.id_label,
                        COALESCE(l.name, "Sin etiqueta") AS label,
                        p.status
                    FROM products p
                    INNER JOIN measuring_unit u ON u.id = p.id_unit
                    LEFT JOIN labels l ON l.id = p.id_label';
            
            $result = $this->pdo->fetchAll($sql);
            return $result ? ['status' => 'OK', 'result' => $result] : ['status' => 'ERROR', 'result' => []];
        } catch (PDOException $e) {
            return ['status' => 'EXCEPTION', 'result' => $e->getMessage()];
        }
    }

    // Obtener un producto específico para edición
    public function get_product_by_id($bind)
    {
        try {
            $sql = 'SELECT 
                        p.id AS id_product,
                        p.code,
                        p.id_unit,
                        u.description AS unit,
                        GROUP_CONCAT(ch.id_header) AS id_headers,
                        p.name,
                        p.description,
                        p.price,
                        p.id_label,
                        COALESCE(l.name, "Sin etiqueta") AS label,
                        p.status
                    FROM products p
                    INNER JOIN measuring_unit u ON u.id = p.id_unit   
                    LEFT JOIN labels l ON l.id = p.id_label
                    LEFT JOIN content_headers ch ON ch.id_product = p.id
                    WHERE p.id = :id_product
                    GROUP BY p.id';
            
            $result = $this->pdo->fetchOne($sql, $bind);
            return $result ? ['status' => 'OK', 'result' => $result] : ['status' => 'ERROR', 'result' => []];
        } catch (PDOException $e) {
            return ['status' => 'EXCEPTION', 'result' => $e->getMessage()];
        }
    }

    // Obtener contenido estructurado (Cabeceras y Filas Dinámicas)
    public function get_product_content($bind)
    {
        try {
            $sql = 'SELECT ct.id_header, ct.position, ct.content, h.name 
                    FROM content_headers ct 
                    INNER JOIN headers h ON h.id = ct.id_header 
                    WHERE ct.id_product = :id_product
                    ORDER BY ct.position, ct.id_header';

            $resultados = $this->pdo->fetchAll($sql, $bind);

            $data = ['headers' => [], 'rows' => []];

            if ($resultados) {
                foreach ($resultados as $row) {
                    if (!in_array($row['name'], $data['headers'])) {
                        $data['headers'][] = $row['name'];
                    }
                    $data['rows'][$row['position']][$row['name']] = $row['content'];
                }
                $data['rows'] = array_values($data['rows']);
                return ['status' => 'OK', 'result' => $data];
            }
            return ['status' => 'ERROR', 'result' => []];
        } catch (PDOException $e) {
            return ['status' => 'EXCEPTION', 'result' => $e->getMessage()];
        }
    }

    public function create_product($bind)
    {
        $this->pdo->beginTransaction();
        try {
            $sql = 'INSERT INTO products (id_unit, name, description, code) 
                    VALUES (:id_u_medida, :name, :description, :code)';
            
            $this->pdo->perform($sql, [
                'id_u_medida' => $bind['id_u_medida'],
                'name'        => $bind['name'],
                'description' => $bind['description'],
                'code'        => $bind['code']
            ]);
            
            $id = $this->pdo->lastInsertId();

            if (!empty($bind['head_type']) && is_array($bind['head_type'])) {
                foreach ($bind['head_type'] as $value) {
                    $sql_insert = 'INSERT INTO content_headers (id_product, id_header) VALUES (:id_product, :id_header)';
                    $this->pdo->perform($sql_insert, ['id_product' => $id, 'id_header' => $value]);
                }
            }

            $this->pdo->commit();
            return ['status' => 'OK', 'result' => []];
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return ['status' => 'ERROR', 'result' => $e->getMessage()];
        }
    }

    public function update_product($bind)
    {
        $this->pdo->beginTransaction();
        try {
            $sql = 'UPDATE products 
                    SET id_unit = :id_u_medida, name = :name, description = :description, code = :code
                    WHERE id = :id_product';
            
            $this->pdo->perform($sql, [
                'id_u_medida' => $bind['id_u_medida'],
                'name'        => $bind['name'],
                'description' => $bind['description'],
                'code'        => $bind['code'],
                'id_product'  => $bind['id_product']
            ]);

            $this->pdo->perform('DELETE FROM content_headers WHERE id_product = :id_product', ['id_product' => $bind['id_product']]);

            if (!empty($bind['head_type']) && is_array($bind['head_type'])) {
                foreach ($bind['head_type'] as $value) {
                    $sql_insert = 'INSERT INTO content_headers (id_product, id_header) VALUES (:id_product, :id_header)';
                    $this->pdo->perform($sql_insert, ['id_product' => $bind['id_product'], 'id_header' => $value]);
                }
            }

            $this->pdo->commit();
            return ['status' => 'OK', 'result' => []];
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return ['status' => 'EXCEPTION', 'result' => $e->getMessage()];
        }
    }

    // Métodos de apoyo para Selects
    public function get_u_medida() {
        try {
            $result = $this->pdo->fetchAll('SELECT id, description, status FROM measuring_unit');
            return $result ? ['status' => 'OK', 'result' => $result] : ['status' => 'ERROR', 'result' => []];
        } catch (PDOException $e) { return ['status' => 'EXCEPTION', 'result' => $e->getMessage()]; }
    }

    public function get_head_types() {
        try {
            $result = $this->pdo->fetchAll('SELECT id, name FROM headers');
            return $result ? ['status' => 'OK', 'result' => $result] : ['status' => 'ERROR', 'result' => []];
        } catch (PDOException $e) { return ['status' => 'EXCEPTION', 'result' => $e->getMessage()]; }
    }

    public function get_labels() {
        try {
            $result = $this->pdo->fetchAll('SELECT id, name FROM labels');
            return $result ? ['status' => 'OK', 'result' => $result] : ['status' => 'ERROR', 'result' => []];
        } catch (PDOException $e) { return ['status' => 'EXCEPTION', 'result' => $e->getMessage()]; }
    }
}
