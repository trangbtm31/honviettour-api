<?php

use Illuminate\Database\Seeder;

class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("insert IGNORE into `admin_menu`(`id`,`parent_id`,`order`,`title`,`icon`,`uri`,`permission`,`created_at`,`updated_at`) values (1,0,1,'Dashboard','fa-bar-chart','/',NULL,NULL,NULL),(2,0,2,'Admin','fa-tasks','',NULL,NULL,NULL),(3,2,3,'Users','fa-users','auth/users',NULL,NULL,NULL),(4,2,4,'Roles','fa-user','auth/roles',NULL,NULL,NULL),(5,2,5,'Permission','fa-ban','auth/permissions',NULL,NULL,NULL),(6,2,6,'Menu','fa-bars','auth/menu',NULL,NULL,NULL),(7,2,7,'Operation log','fa-history','auth/logs',NULL,NULL,NULL),(8,0,9,'Web','fa-globe',NULL,NULL,'2019-03-02 07:39:55','2019-03-02 08:43:55'),(10,0,13,'Helpers','fa-life-bouy','/helpers','*','2019-03-02 08:15:03','2019-03-06 19:10:42'),(11,10,16,'Routes','fa-sitemap','/helpers/routes','*','2019-03-02 08:23:11','2019-03-06 19:10:42'),(12,10,17,'Scaffold','fa-suitcase','/helpers/scaffold','*','2019-03-02 08:26:21','2019-03-06 19:10:42'),(13,8,12,'Tours','fa-plane','/tours','*','2019-03-02 08:27:36','2019-03-06 19:10:42'),(14,8,10,'Hotels','fa-building','/hotels','*','2019-03-02 08:28:17','2019-03-06 19:10:42'),(15,0,8,'Config','fa-toggle-on','config',NULL,'2019-03-02 08:30:56','2019-03-02 08:30:56'),(17,10,14,'ComposerViewer','fa-archive','composer-viewer',NULL,'2019-03-02 08:34:05','2019-03-06 19:10:42'),(18,0,18,'API Tester','fa-play','/api-tester','*','2019-03-02 08:39:41','2019-03-06 19:10:42'),(19,10,15,'Log viewer','fa-database','logs',NULL,'2019-03-02 08:41:23','2019-03-06 19:10:42'),(21,0,19,'Media manager','fa-file','media',NULL,'2019-03-02 08:46:00','2019-03-06 19:10:42'),(22,8,11,'Plans','fa-sticky-note','/plans','*','2019-03-06 18:54:25','2019-03-06 19:10:42'),(23,8,0,'News','fa-newspaper-o','/news',NULL,'2019-05-03 00:43:02','2019-05-03 00:43:02'),(24,0,19,'Helpers','fa-gears','',NULL,'2019-05-04 16:37:55','2019-05-04 16:37:55'),(25,24,20,'Scaffold','fa-keyboard-o','helpers/scaffold',NULL,'2019-05-04 16:37:55','2019-05-04 16:37:55'),(26,24,21,'Database terminal','fa-database','helpers/terminal/database',NULL,'2019-05-04 16:37:55','2019-05-04 16:37:55'),(27,24,22,'Laravel artisan','fa-terminal','helpers/terminal/artisan',NULL,'2019-05-04 16:37:55','2019-05-04 16:37:55'),(28,24,23,'Routes','fa-list-alt','helpers/routes',NULL,'2019-05-04 16:37:55','2019-05-04 16:37:55'),(29,8,0,'Feedbacks','fa-wechat','/feedbacks',NULL,'2019-05-16 21:36:31','2019-05-16 21:36:31'),(30,8,0,'Banner Management','fa-image','/banners',NULL,'2019-05-25 19:26:24','2019-05-25 19:26:24'),(31,8,0,'Schedule','fa-calendar','/schedules',NULL,'2019-06-01 16:32:16','2019-06-01 16:32:42');");
    }
}
