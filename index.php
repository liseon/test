<?

/*Все запросы будем принимать через этот файл. */
require_once('conf/config.php');  //Файл с настройками
require_once("controller/MainController.php");  //Контроллер
require_once("model/Items.php");  //Модуль
require_once("views/main.php");  //Представление

MainController::run();