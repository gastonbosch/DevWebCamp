<?php

namespace Controllers;

use Model\Paquete;
use Model\Registro;
use Model\Usuario;
use Model\Evento;
use Model\Dia;
use Model\EventosRegistros;
use Model\Hora;
use Model\Ponente;
use Model\Regalo;
use MVC\Router;

class RegistroController{

    public static function crear(Router $router){

        if(!is_auth()){
            header('Location: /');
            return;
        }

        //Si ya tiene un boleto lo redirecciono al mismo
        $registro = Registro::where('usuario_id',$_SESSION['id']);
        if(isset($registro) && ($registro->paquete_id === "3" || $registro->paquete_id === "2")){
            header('Location: /boleto?id='.urlencode($registro->token));
            return;
        }

        if(isset($registro) && $registro->paquete_id === "1"){
            header('Location: /finalizar-registro/conferencias');
            return;
        }

        $router->render('registro/crear',[
            'titulo' => 'Finalizar Registro'
        ]);
    }

    public static function pagar(Router $router){
        
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(!is_auth()){
                header('Location: /login');
                return;
            }
        }

        if(empty($_POST)){
            echo json_encode([]);
            return;
        }

        //Crear Registro
        $datos = $_POST;
        $datos['token'] = substr(md5(uniqid(rand(), true)),0,8);
        $datos['usuario_id'] = $_SESSION['id'];

        try {
            $registro = new Registro($datos);
            $resultado = $registro->guardar();
            echo json_encode($resultado);
        } catch (\Throwable $th) {
            echo json_encode(['resultado'=>'error']);
        }
    }

    public static function virual(Router $router){
        
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(!is_auth()){
                header('Location: /login');
                return;
            }
        }

        //Si ya tiene un boleto lo redirecciono al mismo
        $registro = Registro::where('usuario_id',$_SESSION['id']);
        if(isset($registro) && $registro->paquete_id === 2){
            header('Location: /boleto?id='.urlencode($registro->token));
            return;
        }

        $token = substr(md5(uniqid(rand(), true)),0,8);

        //Crear Registro
        $datos = [
            'paquete_id' => 2,
            'pago_id' => '',
            'token' => $token,
            'usuario_id' => $_SESSION['id']
        ];

        $registro = new Registro($datos);
        $resultado = $registro->guardar();

        if($resultado){
            header('Location: /boleto?id='.urlencode($registro->token));
            return;
        }
    }

    public static function presencial(Router $router){
        
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(!is_auth()){
                header('Location: /login');
                return;
            }
        }

        //Si ya tiene un boleto lo redirecciono al mismo
        $registro = Registro::where('usuario_id',$_SESSION['id']);
        if(isset($registro) && $registro->paquete_id === 1){
            header('Location: /boleto?id='.urlencode($registro->token));
            return;
        }

        $token = substr(md5(uniqid(rand(), true)),0,8);

        //Crear Registro
        $datos = [
            'paquete_id' => 1,
            'pago_id' => '',
            'token' => $token,
            'usuario_id' => $_SESSION['id']
        ];

        $registro = new Registro($datos);
        $resultado = $registro->guardar();

        if($resultado){
            header('Location: /boleto?id='.urlencode($registro->token));
            return;
        }
    }

    public static function gratis(Router $router){
        
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(!is_auth()){
                header('Location: /login');
                return;
            }
        }

        //Si ya tiene un boleto lo redirecciono al mismo
        $registro = Registro::where('usuario_id',$_SESSION['id']);
        if(isset($registro) && $registro->paquete_id === 3){
            header('Location: /boleto?id='.urlencode($registro->token));
            return;
        }

        $token = substr(md5(uniqid(rand(), true)),0,8);

        //Crear Registro
        $datos = [
            'paquete_id' => 3,
            'pago_id' => '',
            'token' => $token,
            'usuario_id' => $_SESSION['id']
        ];

        $registro = new Registro($datos);
        $resultado = $registro->guardar();

        if($resultado){
            header('Location: /boleto?id='.urlencode($registro->token));
            return;
        }
    }

    public static function boleto(Router $router){

        //Validar URL
        $id = $_GET['id'];
        
        if(!$id || !strlen($id)===8){
            header('Location: /');
            return;
        }

        //Buscar boleto en la BD
        $registro = Registro::where('token',$id);
        if(!$registro){
            header('Location: /');
            return;
        }

        //Leenar la tabla de refernecias
        $registro->usuario = Usuario::find($registro->usuario_id);
        $registro->paquete = Paquete::find($registro->paquete_id);

        $router->render('registro/boleto',[
            'titulo' => 'Asistencia a DevWebCamp',
            'registro' => $registro
        ]);
    }

    public static function conferencias(Router $router){

        if(!is_auth()){
            header('Location: /login');
            return;
        }

        $registro = Registro::where('usuario_id', $_SESSION['id']);

        if(isset($registro) && $registro->paquete_id === "2"){
            header('Location: /boleto?id='.urlencode($registro->token));
            return;
        }

        if($registro->paquete_id !== "1"){
            header('Location: /');
            return;
        }

        //Redireccionar al boleto virtual si ya teien una compra registrada
        if(isset($registro) && $registro->paquete_id === "1"){
            header('Location: /boleto?id='.urlencode($registro->token));
            return;
        }

        $eventos = Evento::ordenar('hora_id','ASC');
        $eventos_filtrados = [];
        foreach($eventos as $evento){
            $evento->categoria = Dia::find($evento->categoria_id);
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

        $regalos = Regalo::all('ASC');

        if($_SERVER['REQUEST_METHOD']==='POST'){

            if(!is_auth()){
                header('Location: /');
                return;
            }

            $eventos = explode(',',$_POST['eventos']);
            if(empty($eventos)){
                echo json_encode(['resultado' => false]);
                return;
            }

            $registro = Registro::where('usuario_id',$_SESSION['id']);
            if(!isset($registro) || $registro->paquete_id !== '1'){
                echo json_encode(['resultado' => false]);
                return;
            }

            $eventos_array = [];
            //Validar la disponibilidad de eventos
            foreach($eventos as $evento_id){
                $evento = Evento::find($evento_id);

                //Validar que el evento exista
                if(!isset($evento) || $evento->disponibles === '0'){
                    echo json_encode(['resultado' => false]);
                    return;
                }

                $eventos_array[] = $evento;
            }

            foreach($eventos_array as $evento){
                $evento->disponibles -= 1;
                $evento->guardar();

                //Almacenar el registro
                $datos = [
                    'evento_id'=>$evento->id,
                    'registro_id'=>$registro->id
                ];

                $registro_usuario = new EventosRegistros($datos);
                $registro_usuario->guardar();
            }

            //Almacenar el regalo
            $registro->sincronizar(['regalo_id'=>$_POST['regalo_id']]);
            $resultado = $registro->guardar();

            if($resultado){
                echo json_encode([
                    'resultado'=>$resultado,
                    'token'=>$registro->token
                ]);
            }else{
                echo json_encode(['resultado' => false]);   
            }

            return;
        }

        $router->render('registro/conferencias',[
            'titulo' => 'Elije Workshops y Conferencias',
            'eventos' => $eventos_filtrados,
            'regalos' => $regalos
        ]);
    }


}