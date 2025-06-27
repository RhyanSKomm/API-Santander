<?php

namespace App\DTOs;

use DateTime;

class TransacaoDTO
{
    private ?string $dataHora = null;
    private ?string $valor = null;
    private ?string $usuarioOrigem = null;
    private ?string $usuarioDestino = null;



    /**
     * Get the value of dataHora
     */ 
    public function getDataHora()
    {
        return $this->dataHora;
    }

    /**
     * Set the value of dataHora
     *
     * @return  self
     */ 
    public function setDataHora($dataHora)
    {
        $this->dataHora = $dataHora;

        return $this;
    }

    /**
     * Get the value of valor
     */ 
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set the value of valor
     *
     * @return  self
     */ 
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get the value of usuarioOrigem
     */ 
    public function getUsuarioOrigem()
    {
        return $this->usuarioOrigem;
    }

    /**
     * Set the value of usuarioOrigem
     *
     * @return  self
     */ 
    public function setUsuarioOrigem($usuarioOrigem)
    {
        $this->usuarioOrigem = $usuarioOrigem;

        return $this;
    }

    /**
     * Get the value of usuarioDestino
     */ 
    public function getUsuarioDestino()
    {
        return $this->usuarioDestino;
    }

    /**
     * Set the value of usuarioDestino
     *
     * @return  self
     */ 
    public function setUsuarioDestino($usuarioDestino)
    {
        $this->usuarioDestino = $usuarioDestino;

        return $this;
    }
}