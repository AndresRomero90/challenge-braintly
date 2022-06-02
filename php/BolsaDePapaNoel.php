<?php

class Regalo
{
  public function __construct(public string $name, public int $peso)
  {
  }
}

class BolsaDePapaNoel
{
  public static int $PESO_MAXIMO = 5000;
  private int $_peso;
  private array $_regalos;

  public function __construct()
  {
    $this->_regalos = array();
    $this->_peso = 0;
  }

  public function agregarRegalo(Regalo $regalo): void
  {
    if ($regalo->peso > BolsaDePapaNoel::$PESO_MAXIMO || ($regalo->peso + $this->_peso) > BolsaDePapaNoel::$PESO_MAXIMO) {
      throw new Exception("La bolsa no puede contener mas de 5000 gramos");
    }
    if ($this->yaExiste($regalo)) {
      throw new Exception("El regalo ya fue agregado");
    }
    array_push($this->_regalos, $regalo);
    $this->_peso += $regalo->peso;
  }

  public function yaExiste(Regalo $regalo): bool
  {
    return in_array($regalo, $this->_regalos);
  }

  public function pesoActual(): int
  {
    return $this->_peso;
  }

  public function regaloMasPesado(): string
  {
    $regaloMasPesado = array_reduce($this->_regalos, fn ($a, $b) => $a->peso > $b->peso ? $a : $b, new Regalo('', 0));
    return $regaloMasPesado->name;
  }
}
