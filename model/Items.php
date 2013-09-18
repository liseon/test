<?
/*Класс для работы с базой данных*/

class Items  
{
private $bd;

	function __construct()  //При создании подключаемся к базе данных
	{
		$this->bd = new mysqli( BD_HOST , BD_USER , BD_PW , BD_NAME ) or die("Error " . mysqli_error($this->bd)); 
	}
	
	public function search($s,$nav=0)  //Функция поиска
	{
		$answ=array();
		$result=$this->bd->query("SELECT * FROM tbl_items WHERE name LIKE '%$s%' LIMIT $nav,". PAGE_COUNT );  //Делаем запрос к БД. Считаем, что переменная "s" безопасна, т.к. мы уже провели её проверку в контроллере!
		while($row=$result->fetch_array()){
			$answ[]=$row;   //В цикле собираем массив для ответа
		}
		return $answ;  //Вернем массив результирующих данных
	}
}