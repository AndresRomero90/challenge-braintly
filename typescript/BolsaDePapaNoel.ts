export interface Regalo {
  name: string;
  peso: number;
}

class BolsaDePapaNoel {
  private static PESO_MAXIMO = 5000;
  private _peso = 0;
  private _regalos: Regalo[] = [];

  agregarRegalo(regalo: Regalo) {
    if (regalo.peso > BolsaDePapaNoel.PESO_MAXIMO) {
      throw Error("El regalo no puede pesar más de 5 kg");
    }
    if (this.yaExiste(regalo)) {
      throw Error("El regalo ya fue agregado");
    }
    this._regalos.push(regalo);
    this._peso += regalo.peso;
  }

  yaExiste(regalo: Regalo): boolean {
    return this._regalos.some(
      (regaloBolsa: Regalo) =>
        regaloBolsa.name === regalo.name && regaloBolsa.peso === regalo.peso
    );
  }

  pesoActual(): number {
    return this._peso;
  }

  regaloMasPesado(): Regalo | undefined {
    return this._regalos.reduce((prev, cur) =>
      prev.peso > cur.peso ? prev : cur
    );
  }
}

export default BolsaDePapaNoel;
