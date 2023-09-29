<?php

namespace Controllers;

use Model\Evento;
use Model\Dia;
use Model\Hora;
use Model\Ponente;
use MVC\Router;

class PaginasController {
    public static function index(Router $router) {

        $eventos = Evento::ordenar('hora_id','ASC');
        $eventos_filtrados = [];
        foreach($eventos as $evento){

            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);

            if($evento->dia_id === "1" && $evento->categoria_id === "1"){
                $eventos_filtrados['conferencias_v'][] = $evento;
            }
            if($evento->dia_id === "2" && $evento->categoria_id === "1"){
                $eventos_filtrados['conferencias_s'][] = $evento;
            }
            if($evento->dia_id === "1" && $evento->categoria_id === "2"){
                $eventos_filtrados['workshops_v'][] = $evento;
            }
            if($evento->dia_id === "2" && $evento->categoria_id === "2"){
                $eventos_filtrados['workshops_s'][] = $evento;
            }
        }

        //Obtener el total de cada bloque
        $ponentes_total = Ponente::total();
        $conferencias_total = Evento::total('categoria_id',1);
        $workshops_total = Evento::total('categoria_id',2);

        //Obtener todos los ponentes
        $ponentes = Ponente::all();

        $router->render('paginas/index',[
            'titulo'=>'Inicio',
            'eventos' => $eventos_filtrados,
            'ponentes_total' => $ponentes_total,
            'conferencias_total' => $conferencias_total,
            'workshops_total' => $workshops_total,
            'ponentes' => $ponentes
        ]);
    }

    public static function evento(Router $router) {
        $router->render('paginas/devwebcamp',[
            'titulo'=>'Sobre DevWebCamp'
        ]);
    }

    public static function paquetes(Router $router) {
        $router->render('paginas/paquetes',[
            'titulo'=>'Paquetes DevWebCamp'
        ]);
    }

    /*Lo que es facil para el backend es deificil para el frontend y lo que es dificil 
    para el backend es facil para el frintend, por ello siempre de debe incluit toda 
    la logica en el backend para que las vistas lo unico que tengan que haces es presentarla*/
    public static function conferencias(Router $router) {

        $eventos = Evento::ordenar('hora_id','ASC');
        $eventos_filtrados = [];
        foreach($eventos as $evento){

            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);

            if($evento->dia_id === "1" && $evento->categoria_id === "1"){
                $eventos_filtrados['conferencias_v'][] = $evento;
            }
            if($evento->dia_id === "2" && $evento->categoria_id === "1"){
                $eventos_filtrados['conferencias_s'][] = $evento;
            }
            if($evento->dia_id === "1" && $evento->categoria_id === "2"){
                $eventos_filtrados['workshops_v'][] = $evento;
            }
            if($evento->dia_id === "2" && $evento->categoria_id === "2"){
                $eventos_filtrados['workshops_s'][] = $evento;
            }
        }

        $router->render('paginas/conferencias',[
            'titulo'=>'Conferencias & Workshops',
            'eventos'=>$eventos_filtrados
        ]);
    }

    public static function error(Router $router) {

        $router->render('paginas/error',[
            'titulo'=>'Pagina no encontrada'
        ]);
    }
}
?>