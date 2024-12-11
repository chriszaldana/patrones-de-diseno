<?php

// Interfaz base para los personajes
interface Personaje {
    public function obtenerHabilidades(): string;
    public function obtenerFuerza(): int;
}

// Clase concreta: Guerrero
class Guerrero implements Personaje {
    public function obtenerHabilidades(): string {
        return "Lucha cuerpo a cuerpo";
    }

    public function obtenerFuerza(): int {
        return 10;
    }
}

// Clase concreta: Mago
class Mago implements Personaje {
    public function obtenerHabilidades(): string {
        return "Uso de hechizos mágicos";
    }

    public function obtenerFuerza(): int {
        return 7;
    }
}

// Clase abstracta Decorador
abstract class PersonajeDecorador implements Personaje {
    protected Personaje $personaje;

    public function __construct(Personaje $personaje) {
        $this->personaje = $personaje;
    }

    public function obtenerHabilidades(): string {
        return $this->personaje->obtenerHabilidades();
    }

    public function obtenerFuerza(): int {
        return $this->personaje->obtenerFuerza();
    }
}

// Decorador concreto: Espada
class Espada extends PersonajeDecorador {
    public function obtenerHabilidades(): string {
        return parent::obtenerHabilidades() . ", Manejo de espada";
    }

    public function obtenerFuerza(): int {
        return parent::obtenerFuerza() + 5;
    }
}

// Decorador concreto: Arco y Flecha
class ArcoYFlecha extends PersonajeDecorador {
    public function obtenerHabilidades(): string {
        return parent::obtenerHabilidades() . ", Tiro con arco";
    }

    public function obtenerFuerza(): int {
        return parent::obtenerFuerza() + 3;
    }
}

// Decorador concreto: Bastón Mágico
class BastonMagico extends PersonajeDecorador {
    public function obtenerHabilidades(): string {
        return parent::obtenerHabilidades() . ", Uso de bastón mágico";
    }

    public function obtenerFuerza(): int {
        return parent::obtenerFuerza() + 4;
    }
}

// Simulación del programa
function mostrarDetalles(Personaje $personaje): void {
    echo "Habilidades: " . $personaje->obtenerHabilidades() . "\n";
    echo "Fuerza: " . $personaje->obtenerFuerza() . "\n";
}

// Pruebas
echo "=== Guerrero con Espada y Arco ===\n";
$guerrero = new Guerrero();
$guerreroConEspada = new Espada($guerrero);
$guerreroConEspadaYArco = new ArcoYFlecha($guerreroConEspada);
mostrarDetalles($guerreroConEspadaYArco);

echo "\n=== Mago con Bastón Mágico ===\n";
$mago = new Mago();
$magoConBaston = new BastonMagico($mago);
mostrarDetalles($magoConBaston);

?>
