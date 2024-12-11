<?php

// Clase base Personaje
abstract class Personaje {
    abstract public function atacar(): void;
    abstract public function velocidad(): int;
}

// Clase Esqueleto
class Esqueleto extends Personaje {
    public function atacar(): void {
        echo "El Esqueleto ataca con flechas.\n";
    }

    public function velocidad(): int {
        return 5;
    }
}

// Clase Zombi
class Zombi extends Personaje {
    public function atacar(): void {
        echo "El Zombi ataca con mordiscos.\n";
    }

    public function velocidad(): int {
        return 2;
    }
}

// Factory para crear personajes
class PersonajeFactory {
    public static function crearPersonaje(string $nivel): Personaje {
        switch (strtolower($nivel)) {
            case "fácil":
                return new Esqueleto();
            case "difícil":
                return new Zombi();
            default:
                throw new Exception("Nivel desconocido");
        }
    }
}

// Función para iniciar el juego
function iniciarJuego(string $nivel): void {
    try {
        echo "Creando personaje para el nivel: $nivel\n";
        $personaje = PersonajeFactory::crearPersonaje($nivel);
        $personaje->atacar();
        echo "Velocidad del personaje: " . $personaje->velocidad() . "\n";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
}

// Pruebas
iniciarJuego("fácil");  // Crea un Esqueleto
iniciarJuego("difícil"); // Crea un Zombi
iniciarJuego("medio");   // Genera un error

?>
