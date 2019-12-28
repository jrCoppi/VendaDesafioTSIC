<?php
namespace Application\Model;
  
use Doctrine\ORM\Mapping as ORM;
  
/**
 * @ORM\Entity
 */
class Produto {
  
    /**
     * @ORM\id_produto
     * @ORM\GeneratedValue("AUTO")
     * @ORM\Column(type="integer")
     */
    private $id_produto;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ds_codigo_produto;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ds_produto;
    /**
     * @ORM\Column(type="float")
     */
    private $vl_produto;
     
    public function getIdProduto() {
        return $this->id_produto;
    }
  
    public function setIdProduto($id_produto) {
        $this->id_produto = $id_produto;
    }
  
    public function getDsCodigoProduto() {
        return $this->ds_codigo_produto;
    }
  
    public function setDsCodigoProduto($ds_codigo_produto) {
        $this->ds_codigo_produto = $ds_codigo_produto;
    }
  
    public function getDsProduto() {
        return $this->ds_produto;
    }
  
    public function setDsProduto($ds_produto) {
        $this->ds_produto = $ds_produto;
    }
  
    public function getVlProduto() {
        return $this->vl_produto;
    }
  
    public function setVlProduto($vl_produto) {
        $this->vl_produto = $vl_produto;
    }
     
}