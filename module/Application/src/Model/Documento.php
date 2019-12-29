<?php
namespace Application\Model;
  
use Doctrine\ORM\Mapping as ORM;
  
/**
 * @ORM\Entity
 */
class Documento {
  
    /**
     * @ORM\Id
     * @ORM\GeneratedValue("AUTO")
     * @ORM\Column(type="integer")
     */
    private $id_documento;
    /**
     * @ORM\Column(type="float")
     */
    private $vl_total_documento;
    /**
     * @ORM\Column(type="integer", length=1)
     */
    private $sn_documento_confirmado;
    /**
     * @ORM\Column(type="integer", length=1)
     */
    private $sn_documento_cancelado;
     
    public function getIdDocumento() {
        return $this->id_documento;
    }
  
    public function setIdDocumento($id_documento) {
        $this->id_documento = $id_documento;
    }
  
    public function getVlTotalDocumento() {
        return $this->vl_total_documento;
    }
  
    public function setVlTotalDocumento($vl_total_documento) {
        $this->vl_total_documento = $vl_total_documento;
    }
  
    public function isDocumentoConfirmado() {
        return $this->sn_documento_confirmado;
    }
  
    public function confirmaDocumento($sn_documento_confirmado) {
        $this->sn_documento_confirmado = $sn_documento_confirmado;
    }
  
    public function isDocumentoCancelado() {
        return $this->sn_documento_cancelado;
    }
  
    public function cancelaDocumento($sn_documento_cancelado) {
        $this->sn_documento_cancelado = $sn_documento_cancelado;
    }
     
}