<?php
// Php/Service/SolrIndexer.php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../config_solr.php';

class SolrIndex {
    private $client;

    public function __construct() {
        global $config; // Traemos la config del archivo externo
        $this->client = new \Solarium\Client(
            new \Solarium\Core\Client\Adapter\Curl(),
            new \Symfony\Component\EventDispatcher\EventDispatcher(),
            $config
        );
    }

    /**
     * Indexa una planta en Solr. Si ya existe, la actualiza.
     */
    public function indexarPlanta(array $datosPlanta) {
        try {
            $update = $this->client->createUpdate();
            $doc = $update->createDocument();

            // Mapeo estricto de campos (Mejor que campos dinámicos _t)
            $doc->id = '' . $datosPlanta['id_arbol'];
            $doc->nombre_comun = $datosPlanta['nombre_comun'];
            $doc->nombre_cientifico = $datosPlanta['nombre_cientifico'];
            $doc->descripcion = $datosPlanta['descripcion'];
            $doc->usos = $datosPlanta['usos'];
            $doc->imagen = $datosPlanta['nombre_imagen'];
            $doc->familia = $datosPlanta['nombre_familia']; // Asumiendo que pasas el nombre, no el ID

            $update->addDocument($doc);
            $update->addCommit();

            $this->client->update($update);
            return true;
        } catch (Exception $e) {
            // Loguear error en archivo de servidor, no mostrar al usuario
            error_log("Error Solr: " . $e->getMessage());
            return false;
        }
    }

    public function eliminarPlanta($id) {
        $update = $this->client->createUpdate();
        $update->addDeleteById('planta_' . $id);
        $update->addCommit();
        $this->client->update($update);
    }
}
?>