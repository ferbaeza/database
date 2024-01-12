<?php

namespace Baezeta\Psql\Database\Migrator;

use ReflectionClass;

class Finder
{
    private const CLASE = "Tests\Varios\Pruebas\BusquedaPatron\Herencia\Schema";
    private const DIRECTORY = __DIR__ . '/../../../';
    private array $subArchivos = [];
    private static array $clases = [];

    public function __construct(
    )
    {
    }

    public static function findSchemas(?string $path = null): array
    {
        $directorio = $path ?? self::DIRECTORY;
        $finder = new Finder();
        $finder->recorreDirectorio($directorio);
        // $finder->recorrerSubArchivos();
        return self::$clases;
    }

    public function recorrerSubArchivos()
    {
        foreach ($this->subArchivos as $archivo) {
            $this->recorreFichero($archivo);
        }
    }
    
    public function recorreDirectorio(string $directorio):void
    {
        // Buscar archivos PHP en el directorio
        foreach (glob($directorio . '/*.php') as $archivo) {
            $this->subArchivos[] = $archivo;
            $this->recorreFichero($archivo);
        }

        foreach (glob($directorio . '/*', GLOB_ONLYDIR) as $subdirectorio) {
            if (strpos($subdirectorio, 'vendor') !== false) {
                continue;
            }
            $this->recorreDirectorio($subdirectorio);
        }
    }

    public function recorreFichero(string $archivo): void
    {
        $claseBase = (self::CLASE);
        // Asegúrate de incluir el archivo
        require_once $archivo;
        $clasesEnArchivo = get_declared_classes();
        foreach ($clasesEnArchivo as $clase) {
            $claseRef = new ReflectionClass($clase);

            if ($claseRef->isSubclassOf($claseBase)) {
                $this->register($clase);
            }
        }
    }

    public function register(string $clase): void
    {
        $nameClass = substr($clase, strrpos($clase, '\\') + 1);

        if (!array_keys(self::$clases, $nameClass)) {
            self::$clases[$nameClass] = $clase;
        }
        return;
    }

}
