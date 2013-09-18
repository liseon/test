<?
/* Контроллер главной страницы */

class MainController   
{
	public function run()
	{
		$page = (isset($_GET['page']) && $_GET['page']>0 && preg_match("/^[0-9]+$/",$_GET['page'])>0) ? $_GET['page'] : 1;  //Текущая страница
		$from = ($page-1)*PAGE_COUNT ;  // С какой записи начинать поиск
		
		if (!isset($_GET['s']) || strlen($_GET['s'])<3) {  // Если ключ не задан, либо короче 3-ех символов, то выводим ошибку!
			view::error('Get - ключ "s" не задан или короче 3-ех символов!');
			return false;
		}
		$s = substr($_GET['s'],0,3);   //Обрежем ключ согласно условию
		
		/*Т.к. мы точно знаем, что хэш может состоять только из букв a-f и цифр, то проверим наш запрос по шаблону!
		Такая проверка исключит возможность иньекции через GET-параметр*/
		if (preg_match("/^[0-9a-fA-F]{3}$/",$s)<1){  
			view::error('Записей не найдено!');
			return false;
		}
		$model = new Items();  //Теперь имеет смысл создать модель 
		$answ = $model->search($s,$from);  //Получаем массив искомых значений из БД
		if (count($answ)===0){
			view::error('Поиск произведен, но записей не найдено!');
			return false;
		}
		view::main($answ,$s,$page);
		return true;
	}

}