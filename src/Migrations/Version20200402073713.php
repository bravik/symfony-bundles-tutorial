<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200402073713 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE event (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, starts_at DATETIME NOT NULL, ends_at DATETIME DEFAULT NULL, description CLOB DEFAULT NULL, venue_address VARCHAR(255) DEFAULT NULL, venue_name VARCHAR(255) DEFAULT NULL, archived BOOLEAN NOT NULL)');

        // Add example data
        $this->addSql('
            INSERT INTO event (id, title, starts_at, ends_at, description, venue_address, venue_name, archived) VALUES 
            (1, \'Интересная встреча\', \'2018-01-01 00:00:00\', null, \'Прекрасное описание\', \'ул. Уборевича 3\', \'Лекторий "Мансарда"\', 0),
            (2, \'Бизнес-конференция\', \'2019-06-13 07:10:00\', null, \'Прекрасная конференция для бизнеса\', \'ул. Юмашева, 5\', \'Цирк-шапито\', 0),
            (3, \'Симфони-курс\', \'2021-01-01 00:00:00\', \'2021-01-05 01:05:00\', \'Учимся делать бандлы\', \'www.leningrad.www.ru\', \'Интернеты\', 0),
            (4, \'Проектирование велосипедов\', \'2021-03-17 00:14:00\', null, \'Мастер класс солидной компании\', \'Москва\', \'Офис солидной компании\', 0),
            (5, \'Как устроиться в Яндекс?\', \'2021-04-17 00:14:00\', null, \'Лекция от Google\', \'google\', \'Офис Google\', 0),
            (6, \'10 причин бросить Symfony и перейти на Yii\', \'2012-03-15 13:02:17\', null, \'Мы научим тебя писать код\', \'Салтыквар\', \'Коворкинг "Олдфаг"\', 0),
            (7, \'Не рыдай\', \'2023-03-15 13:03:51\', null, \'Когда тебе за 30 и не берут на работу\', \'Яндексовая 4\', \'Подъезд офиса Яндекса\', 0),
            (8, \'Боремся с депрессией\', \'2021-03-17 13:06:08\', \'2021-08-20 11:11:00\', \'7 уроков от Харви Вайнштайна\', \'Америка\', \'Офис Харви Вайнштайна\', 0),
            (9, \'Принятие\', \'2023-03-15 13:04:43\', null, \'5 стадий принятия горя\', \'Биржевая 4\', \'Биржа труда\', 0),
            (10, \'Собираем маску от коронавируса\', \'2020-06-15 13:07:54\', null, \'DIY мастер класс\', \'ручковая 4\', \'Студия "Умелые ручки"\', 0),
            (11, \'Релокация в Финляндию\', \'2026-03-15 13:08:48\', null, \'Поможем получить оффер и визу\', \'Валежниковая 5а\', \'Журнал "Пора валить"\', 0);
        ');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE event');
    }
}
