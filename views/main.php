<?
/* Класс представления */

class view  
{
	/* Генерация главной страницы  */
	public function main(array $result, //Результирующий массив
								$s,   //Параметр посика
								$page  //Текущая страница
								)  
	{
		$message = '<table border="1" cellpadding="5" cellspacing="0"><tr><td>ID</td><td>Name</td></tr>';  //В переменную message будем формировать вывод динамической части шаблона
		foreach ($result as $line){
			$message .='<tr><td>'.$line['id'].'</td><td>'.$line['name'].'</td></tr>';
		}
		$message .='</table>';
		
		if ($page > 1)  //Требуется ссылка на предыдущую страницу!
			$message .= "<a href=\"index.php?s=". $s ."&page=". ($page-1) . "\">Назад</a> &nbsp;";
		if (count($result) === PAGE_COUNT) // Требуется ссылка на следующую страницу
			$message .= "<a href=\"index.php?s=". $s ."&page=". ($page+1) . "\">Вперед</a>";
			
		include_once('layout.php');
	}
	
	public function error($message="")  //Генерация страницы с ошибкой__halt_compiler
	{
		include_once('layout.php');
	}
}