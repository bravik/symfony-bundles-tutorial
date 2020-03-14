# Руководство по созданию переиспользуемых бандлов Symfony 5

Дисклеймер: Эта статья обобщение моего личного опыта работы с бандлами. Вполне допустимо, что в чем-то будет выбран не лучший способ работы с бандлом. Я буду рад вашей критике и улучшениям.

# Зачем
Symfony Bundle понадобятся вам тогда (и только тогда), когда вы устанете копипастить из проекта в проект и задумаетесь о переиспользовании кода.

Рано или поздно любой программист приходит к пониманию, что вместо копипастинга кода из проекта в проект, удобнее выделить код в переиспользуемый подключаемый модуль. Symfony Bundle - это и есть такой модуль в терминах Symfony.


Бандл - это не более чем пакет PHP кода, выделенный в отдельный подключаемый модуль или библиотеку для использования в нескольких проектах. 

Приставка Symfony к слову Bundle означает,
 что этот пакет имеет дополнительно хорошую интеграцию с приложениями, написаными на Symfony Framework и использует его инструменты.
На практике это сводится к тому, что бандлы автоматически подключаться к проекту при выполнении команды `composer require`. 

Бандлы хранятся в своем отдельном репозитории и подключаются к проекту через менеджер зависимостей (composer).


# Example Project: Calendar


<small>
Представьте, что вы написали сайт, подключили блог и написали свой красивый календарь мероприятий. Посмотрев на этот сайт к вам пришел еще один клиент и попросил сайт себе, с таким же красивым календарем, только с другим дизайном. Вы копируете код сайта в новый проект, меняете дизайн. Потом вы находите ошибку в коде календаря и вам приходится обновить код на двух сайтах. Потом к вам приходит еще 10 клиентов. Один из них заказывает новую фишку для календаря - уведомления. Посмотрев на крутую фишку остальные клиенты тоже хотят получить эту новую фичу, и вам приходится копировать и настраивать изменения у всех 12 клиентов… Очень скоро уследить за изменениями становиться невозможно и поддержка такого продукта превращается в кошмар.
<br><br>
Представьте, что вы выделили весь код вашего календаря со всех 10 проектов в один бандл. Теперь, при появлении ошибки, вам достаточно исправить код в одном месте, а в каждом из проектов для обновления достаточно выполнить `composer update`
</small>






1. [Создание и подключение бандла](./1_Bootstraping.md)
    - Окружение проекта, 2 способа разработки
    - Создаем хост приложение
    - Создаем минимальный бандл
# Полезная нагрузка бандла, сервисы, зависимости, файл конфигурации
 - Полезная нагрузка бандла
 - Сервисы
 - Зависимости бандла
 - Добавляем файл конфигурации
# Тестирование бандлов
  - Создание микроприложения для тестов
# Контроллеры и шаблоны
 - Создание шаблонов
 - Встраивание в хост-приложение
 - Переопределение частей бандла
# Сущности и команды
 - Проблема с миграциями
 - Добавление команды
# Работа с assets, JS, SASS, webpack-encore
# Жизненный цикл бандла
  - Версионирование
  - Фиксация изменений в CHANGELOG.md
  - Утановка: командой? рецепт?
  - Проблема миграций
  - Обновление
  - README.md
# Кастомизация бандла и расширение
  - Переопределение шаблонов
  - Использование тегов для расширения бандла

