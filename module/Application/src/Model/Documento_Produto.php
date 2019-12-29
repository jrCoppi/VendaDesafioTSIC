<?php
namespace Application\Model;
  
use Doctrine\ORM\Mapping as ORM;
  
/**
 * @ORM\Entity
 */
class Documento_Produto {
  
    /**
     * @ORM\Id
     */
    private $id_documento;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id_produto;

    public function getIdProduto() {
        return $this->id_produto;
    }
  
    public function setIdProduto($id_produto) {
        $this->id_produto = $id_produto;
    }
     
    public function getIdDocumento() {
        return $this->id_documento;
    }
  
    public function setIdDocumento($id_documento) {
        $this->id_documento = $id_documento;
    }
     
}