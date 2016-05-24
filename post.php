
<? 
// ----------------------------конфигурация-------------------------- // 
 
$adminemail="acril-ston@rambler.ru";  // e-mail админа
$date=date("d.m.y"); // число.месяц.год 
$time=date("H:i"); // часы:минуты:секунды 
$backurl="http://acril-stone.ru/pages/contacts.html";  // На какую страничку переходит после отправки письма
 
//---------------------------------------------------------------------- // 

// Принимаем данные с формы 
 
$name=$_POST['name']; 
$email=$_POST['email'];
$phone=$_POST['phone'];
$msg=$_POST['text']; 
 
// Проверяем валидность e-mail 
 
if (!preg_match("|^([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})|is", 
strtolower($email))) { 
  echo 
"<center>Вернитесь <a 
href='javascript:history.back(1)'><B>назад</B></a>. Вы 
указали неверные данные!"; 
  } else { 
 
$msg=
"Имя: $name 
E-mail: $email
Телефон: $phone
Сообщение: $msg"; 
 
  
// Отправляем письмо админу  
 
mail("$adminemail", "$date $time Сообщение от $name", "$msg"); 
 
// Сохраняем в базу данных 
 
$f = fopen("message.txt", "a+"); 
fwrite($f," \n $date $time Сообщение от $name"); 
fwrite($f,"\n $msg "); 
fwrite($f,"\n ---------------"); 
fclose($f); 

// Выводим сообщение пользователю 

	echo "<p>Сообщение отправлено!</p>"; 
exit; 
} 
?>