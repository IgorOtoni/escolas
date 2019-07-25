-- MySQL dump 10.13  Distrib 5.6.25, for linux-glibc2.5 (x86_64)
--
-- Host: localhost    Database: db_escolas
-- ------------------------------------------------------
-- Server version	5.6.25

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_09_15_123748_create_tbl_igrejas_table',1),(2,'2014_09_15_123749_create_tbl_perfis_table',1),(3,'2014_10_11_113023_create_tbl_funcoes_table',1),(4,'2014_10_11_113024_create_tbl_membros_table',1),(5,'2014_10_12_000000_create_users_table',1),(6,'2014_10_12_100000_create_password_resets_table',1),(7,'2019_03_14_152659_create_tbl_modulos_table',1),(8,'2019_03_15_114221_create_tbl_igrejas_modulos_table',1),(9,'2019_03_15_115028_create_tbl_permissoes_table',1),(10,'2019_03_15_123832_create_tbl_perfis_igrejas_modulos_table',1),(11,'2019_03_15_141130_create_tbl_modulos_permissoes_table',1),(12,'2019_03_18_135055_create_tbl_igrejas_perfis_table',1),(13,'2019_03_22_095319_create_tbl_templates_table',1),(14,'2019_03_22_095440_create_tbl_configuracoes_table',1),(15,'2019_03_22_104445_create_tbl_logs_table',1),(16,'2019_03_22_131204_create_tbl_sermoes_table',1),(17,'2019_03_22_131221_create_tbl_eventos_table',1),(18,'2019_03_22_131236_create_tbl_doacoes_table',1),(19,'2019_03_27_105307_create_tbl_eventos_fixos_table',1),(20,'2019_03_27_133242_create_tbl_noticias_table',1),(21,'2019_03_29_082127_create_tbl_galerias_table',1),(22,'2019_03_29_082434_create_tbl_fotos_table',1),(23,'2019_04_04_084440_create_tbl_menus_table',1),(24,'2019_04_04_084532_create_tbl_sub_menus_table',1),(25,'2019_04_04_084555_create_tbl_sub_sub_menus_table',1),(26,'2019_04_05_085818_create_tbl_publicacoes_table',1),(27,'2019_04_05_134004_create_tbl_banners_table',1),(28,'2019_04_08_141640_create_tbl_publicacao_fotos_table',1),(29,'2019_04_10_095143_create_tbl_contatos_table',1),(30,'2019_04_10_095220_create_tbl_inscricoes_table',1),(31,'2019_04_11_083206_create_tbl_perfis_permissoes_table',1),(32,'2019_05_20_100008_create_tbl_template_fotos_table',1),(33,'2019_05_23_145607_create_tbl_comunidades_table',1),(34,'2019_05_23_145730_create_tbl_membros_comunidades_table',1),(35,'2019_05_23_145746_create_tbl_reunioes_table',1),(36,'2019_05_23_145801_create_tbl_frequencias_table',1),(37,'2019_05_24_140734_create_tbl_menus_android_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_banners`
--

DROP TABLE IF EXISTS `tbl_banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_banners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_igreja` bigint(20) unsigned NOT NULL,
  `ordem` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_banners_id_igreja_foreign` (`id_igreja`),
  CONSTRAINT `tbl_banners_id_igreja_foreign` FOREIGN KEY (`id_igreja`) REFERENCES `tbl_igrejas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_banners`
--

LOCK TABLES `tbl_banners` WRITE;
/*!40000 ALTER TABLE `tbl_banners` DISABLE KEYS */;
INSERT INTO `tbl_banners` VALUES (1,'Venha conhecer nossa escola!','Temos prazer em recebê-lo.','banner-1-1.jpeg','contatos',1,100,NULL,'2019-07-11 14:38:33'),(2,'Foco no essencial!','Aqui nós não perdemos tempo com atividades sem sentido.','banner-2-1.jpeg','contatos',1,2,NULL,'2019-07-11 14:39:07'),(3,'Companheirismo!','Clique aqui para saber mais sobre nossa equipe.','banner-3-1.jpeg','apresentacao',1,2,NULL,'2019-07-09 17:42:17'),(4,'Ensino bilíngue!','Clique aqui para saber mais sobre nossa localização e contatos.','banner-4-1.jpeg','contatos',1,3,NULL,'2019-07-09 17:42:34'),(5,'Professores qualificados!','Clique aqui para saber mais sobre nossa localização e contatos.','banner-5-1.jpeg','contatos',1,1,NULL,'2019-07-09 17:43:59'),(6,'Valorização do meio-ambiente!','Clique aqui para saber mais sobre nossa localização e contatos.','banner-6-1.jpeg','contatos',1,6,NULL,'2019-07-09 17:44:52'),(7,'Todo carinho com os pequeninos!','Temos professores altamente preparados para lidar com os pequenos.','banner-7-1.jpeg','contatos',1,9,NULL,'2019-07-10 14:52:10'),(8,'Interação com os pais!','Clique aqui para saber mais sobre nossa localização e contatos.','banner-8-1.jpeg','contatos',1,11,NULL,'2019-07-09 17:45:41'),(9,'Atividades extra-classe!','Clique aqui para saber mais sobre nossa localização e contatos.','banner-9-1.jpeg','contatos',1,14,NULL,'2019-07-09 17:45:58'),(12,'Ensino fundamental','Uma base bem firmada!','banner-12-2.jpg',NULL,2,6,'2019-07-09 18:57:33','2019-07-11 18:32:54'),(13,'Modernidade','Temos o melhor preparo para a educação do seu filho.','banner-13-2.jpg',NULL,2,15,'2019-07-09 18:59:10','2019-07-11 18:33:12'),(14,'Educação infantil','Aprendizado divertido!','banner-14-2.jpg',NULL,2,5,'2019-07-09 19:02:28','2019-07-11 18:33:56'),(15,'Escola moderna e inovadora!','Temos a melhor proposta pedagógica.','banner-15-3.jpg',NULL,3,5,'2019-07-10 13:39:20','2019-07-21 18:14:29'),(16,'Iniciação esportiva básica!','Iniciação esportiva básica para seu filho!','banner-16-3.jpg',NULL,3,10,'2019-07-10 13:46:17','2019-07-10 23:04:59'),(17,'Profissionais qualificados!','Os melhores profissionais, treinados e capacidados para melhor lhe atender.','banner-17-3.jpg',NULL,3,15,'2019-07-10 13:48:15','2019-07-10 23:05:29'),(18,'Sejam bem-vindos à nossa escola!','Aqui é puro sorriso!','banner-18-4.jpg',NULL,4,5,'2019-07-11 16:53:29','2019-07-11 16:53:29'),(19,'Do infantil ao ensino médio.','Venha nos visitar e conhecer nosso espaço.','banner-19-4.jpg',NULL,4,10,'2019-07-11 16:54:19','2019-07-11 16:54:19'),(20,'Uma escola moderna e inovadora!','Temos a melhor pedagogia.','banner-20-4.jpg',NULL,4,15,'2019-07-11 16:55:30','2019-07-11 16:59:34'),(21,'Ensino médio!','Solidez para o futuro!','banner-21-2.jpg',NULL,2,10,'2019-07-11 19:04:46','2019-07-11 19:04:46'),(22,'Responsabilidade.','Mantemos o foco.','banner-22-5.jpg',NULL,5,10,'2019-07-19 17:23:06','2019-07-21 18:08:41'),(23,'Engajamento','Fazendo do jeito certo.','banner-23-5.jpg',NULL,5,20,'2019-07-19 17:24:23','2019-07-21 18:09:05'),(24,'Preparo','Melhor equipe.','banner-24-5.jpg',NULL,5,30,'2019-07-19 17:25:22','2019-07-21 18:09:25'),(25,'Responsabilidade','Temos um contrato de confiança mútua com nossos clientes.','banner-25-6.jpg',NULL,6,10,'2019-07-22 16:54:37','2019-07-22 16:54:37'),(26,'Agilidade','Temos o menor tempo de resolução do mercado.','banner-26-6.jpg',NULL,6,15,'2019-07-22 16:55:12','2019-07-22 16:55:12'),(27,'Menor taxa','Preços justos é o nosso lema.','banner-27-6.jpg',NULL,6,20,'2019-07-22 16:55:49','2019-07-22 16:55:49');
/*!40000 ALTER TABLE `tbl_banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_comunidades`
--

DROP TABLE IF EXISTS `tbl_comunidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_comunidades` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `id_igreja` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_comunidades_id_igreja_foreign` (`id_igreja`),
  CONSTRAINT `tbl_comunidades_id_igreja_foreign` FOREIGN KEY (`id_igreja`) REFERENCES `tbl_igrejas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_comunidades`
--

LOCK TABLES `tbl_comunidades` WRITE;
/*!40000 ALTER TABLE `tbl_comunidades` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_comunidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_configuracoes`
--

DROP TABLE IF EXISTS `tbl_configuracoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_configuracoes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_igreja` bigint(20) unsigned NOT NULL,
  `id_template` bigint(20) unsigned NOT NULL DEFAULT '1',
  `cor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `texto_apresentativo` text COLLATE utf8mb4_unicode_ci,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_configuracoes_id_igreja_foreign` (`id_igreja`),
  KEY `tbl_configuracoes_id_template_foreign` (`id_template`),
  CONSTRAINT `tbl_configuracoes_id_igreja_foreign` FOREIGN KEY (`id_igreja`) REFERENCES `tbl_igrejas` (`id`),
  CONSTRAINT `tbl_configuracoes_id_template_foreign` FOREIGN KEY (`id_template`) REFERENCES `tbl_templates` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_configuracoes`
--

LOCK TABLES `tbl_configuracoes` WRITE;
/*!40000 ALTER TABLE `tbl_configuracoes` DISABLE KEYS */;
INSERT INTO `tbl_configuracoes` VALUES (1,1,1,'blue','cepsma','NOSSA MISSÃO É OFERECER ORIENTAÇÃO CRISTÃ COM UMA EDUCAÇÃO ALICERÇADA NA \"ROCHA\" DO RESPEITO VOLTADA PARA OS VALORES PRIMEIROS , PREPARANDO OS EDUCANDOS PARA A VIDA. COM O COMPROMISSO DE FORMAR CRIANÇAS E ADOLESCENTES CAPAZES DE RACIOCINAR POR SI PRÓPRIOS, JOVENS QUE FAÇAM PARTE DA SOCIEDADE CONTEMPORÂNEA, COMO INDIVÍDUOS FELIZES E PESSOAS PLENAS. Tipos de educação: Maternal, Educação Infantil, Ensino Fundamental e Ensino Médio Regular - Supletivo Ensino Fundamental (anos finais) e Médio - Cursos Superiores EAD.',NULL,NULL,NULL,NULL,'2019-07-09 11:28:01'),(2,2,2,'white','iepa','Visão: Sermos Reconhecidos como uma referência do setor educacional, buscando a vanguarda das transformações, aprimorando a qualidade de relação com as pessoas a quem estivermos servindo e cumprindo nossa responsabilidade social.\r\nValores: Relações éticas - Trabalho cooperativo - Melhoramento Contínuo.\r\n\r\nObjetivos:\r\n* Alto desempenho dos alunos\r\n* Competência da força de trabalho\r\n* Comprometimento com a realidade social\r\n* Relações de pareceria\r\n* Qualidade total.',NULL,NULL,NULL,'2019-07-09 18:22:47','2019-07-09 19:04:11'),(3,3,1,'white','iepg','Evolução do ensino:\r\n*Temos uma excelente estrutura física!\r\n*Temos Profissionais dos mais qualificados! \r\n*Provemos iniciação esportiva básica para seu filho!\r\n*Temos uma Proposta pedagógica moderna e inovadora!\r\n\r\nDo berçário ao quinto ano fundamental',NULL,NULL,NULL,'2019-07-09 23:03:42','2019-07-11 13:54:49'),(4,4,2,'white','ethos','NOSSA MISSÃO\r\nFormar cidadãos responsáveis, empreendedores, solidários, capazes de transformar informação em conhecimento, utilizando talentos pessoais e tecnologias avançadas em prol do bem comum, promovendo resultados crescentes na sociedade.\r\n\r\n\r\n\r\nNOSSA VISÃO\r\nPromover o desenvolvimento do processo educativo com qualidade, estabelecendo parcerias entre educandos, familiares, educadores e colaboradores.\r\nSermos reconhecidos como Instituição dinâmica, integrada e comprometida com a formação de cidadãos plenos, críticos, éticos e conscientes.\r\nEm um prazo máximo de cinco anos, transcender a função educacional local, atingindo reconhecimento e credibilidade da comunidade acadêmica regional, estadual e nacional como uma Instituição de excelência em educação e formação da consciência social, ambiental e da cidadania.\r\n\r\n\r\n\r\nNOSSOS VALORES\r\nRelações éticas - Observar os mais elevados princípios e padrões éticos, dando exemplo de solidez moral, honestidade e integridade rc drones.\r\nResponsabilidade Social - Exercer a cidadania contribuindo, por meio da Educação, para o desenvolvimento da Sociedade e respeito ao meio ambiente.\r\nSer humano - Propiciar um tratamento justo a todos, valorizando o trabalho em equipe, estimulando um ambiente de aprendizagem, desenvolvimento, respeito, colaboração e autoestima.\r\nGestão - Valorizar e seguir os princípios da Transparência, Equidade, Prestação de contas e Responsabilidade Corporativa.\r\nQualidade - Estimular a inovação e criatividade de forma planejada e integrada, com foco nos resultados, propiciando a perenidade da organização.',NULL,NULL,NULL,'2019-07-11 16:37:35','2019-07-11 17:13:30'),(5,5,2,'black','cesp',NULL,NULL,NULL,NULL,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(6,6,2,'black','CabralPorto',NULL,NULL,NULL,NULL,'2019-07-21 17:51:58','2019-07-21 17:51:58');
/*!40000 ALTER TABLE `tbl_configuracoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_contatos`
--

DROP TABLE IF EXISTS `tbl_contatos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_contatos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensagem` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_igreja` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_contatos_id_igreja_foreign` (`id_igreja`),
  CONSTRAINT `tbl_contatos_id_igreja_foreign` FOREIGN KEY (`id_igreja`) REFERENCES `tbl_igrejas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_contatos`
--

LOCK TABLES `tbl_contatos` WRITE;
/*!40000 ALTER TABLE `tbl_contatos` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_contatos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_doacoes`
--

DROP TABLE IF EXISTS `tbl_doacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_doacoes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_doacoes`
--

LOCK TABLES `tbl_doacoes` WRITE;
/*!40000 ALTER TABLE `tbl_doacoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_doacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_eventos`
--

DROP TABLE IF EXISTS `tbl_eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_eventos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dados_horario_inicio` datetime NOT NULL,
  `dados_horario_fim` datetime NOT NULL,
  `dados_local` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_igreja` bigint(20) unsigned NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_eventos_id_igreja_foreign` (`id_igreja`),
  CONSTRAINT `tbl_eventos_id_igreja_foreign` FOREIGN KEY (`id_igreja`) REFERENCES `tbl_igrejas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_eventos`
--

LOCK TABLES `tbl_eventos` WRITE;
/*!40000 ALTER TABLE `tbl_eventos` DISABLE KEYS */;
INSERT INTO `tbl_eventos` VALUES (1,'Viagem a Ouro Preto','2019-10-16 00:00:00','2019-10-18 23:00:00','Encontro na Escola no dia 15 as 05 horas em ponto.',3,'timeline-1-3.jpg','Neste dia, o sexto ano fará uma viagem cultural a Ouro Preto.','2019-07-10 14:25:42','2019-07-10 14:25:42'),(2,'Viagem a Ouro Preto','2019-07-19 00:00:00','2019-07-19 23:59:00','Encontro na portaria da Escola as 05h',5,'timeline-2-5.jpg','Vamos conhecer esta maravilhosa cidade histórica mineira.','2019-07-19 17:49:18','2019-07-19 17:49:18');
/*!40000 ALTER TABLE `tbl_eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_eventos_fixos`
--

DROP TABLE IF EXISTS `tbl_eventos_fixos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_eventos_fixos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dados_horario_local` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_igreja` bigint(20) unsigned NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_eventos_fixos_id_igreja_foreign` (`id_igreja`),
  CONSTRAINT `tbl_eventos_fixos_id_igreja_foreign` FOREIGN KEY (`id_igreja`) REFERENCES `tbl_igrejas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_eventos_fixos`
--

LOCK TABLES `tbl_eventos_fixos` WRITE;
/*!40000 ALTER TABLE `tbl_eventos_fixos` DISABLE KEYS */;
INSERT INTO `tbl_eventos_fixos` VALUES (1,'Aulas do ensino médio','De segunda a sexta, de 7:00 ás 11:30, na escola.',1,'evento-1-1.jpeg','Horário de todas as turmas do ensino médio.',NULL,NULL),(2,'Aulas do ensino fundamental','De segunda a sexta, de 7:00 ás 13:30 e de 13:00 ás 17:30, na escola.',1,'evento-2-1.jpeg','Horário de todas as turmas do ensino fundamental.',NULL,NULL);
/*!40000 ALTER TABLE `tbl_eventos_fixos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_fotos`
--

DROP TABLE IF EXISTS `tbl_fotos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_fotos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_galeria` bigint(20) unsigned NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_fotos_id_galeria_foreign` (`id_galeria`),
  CONSTRAINT `tbl_fotos_id_galeria_foreign` FOREIGN KEY (`id_galeria`) REFERENCES `tbl_galerias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_fotos`
--

LOCK TABLES `tbl_fotos` WRITE;
/*!40000 ALTER TABLE `tbl_fotos` DISABLE KEYS */;
INSERT INTO `tbl_fotos` VALUES (1,1,'foto-1-1-1.jpeg','2019-07-08 07:50:01',NULL),(2,1,'foto-2-1-1.jpeg','2019-07-08 07:50:01',NULL),(3,1,'foto-3-1-1.jpeg','2019-07-08 07:50:01',NULL),(4,1,'foto-4-1-1.jpeg','2019-07-08 07:50:01',NULL),(5,1,'foto-5-1-1.jpeg','2019-07-08 07:50:01',NULL),(6,1,'foto-6-1-1.jpeg','2019-07-08 07:50:01',NULL),(7,1,'foto-7-1-1.jpeg','2019-07-08 07:50:01',NULL),(8,1,'foto-8-1-1.jpeg','2019-07-08 07:50:01',NULL),(9,1,'foto-9-1-1.jpeg','2019-07-08 07:50:01',NULL),(10,1,'foto-10-1-1.jpeg','2019-07-08 07:50:01',NULL),(18,2,'foto-18-2-3.jpg','2019-07-10 23:14:01','2019-07-10 23:14:01'),(19,2,'foto-19-2-3.jpg','2019-07-10 23:14:01','2019-07-10 23:14:01'),(20,2,'foto-20-2-3.jpg','2019-07-10 23:14:01','2019-07-10 23:14:01'),(21,2,'foto-21-2-3.jpg','2019-07-10 23:14:01','2019-07-10 23:14:01'),(22,2,'foto-22-2-3.jpg','2019-07-10 23:14:01','2019-07-10 23:14:01'),(23,2,'foto-23-2-3.jpg','2019-07-10 23:14:01','2019-07-10 23:14:01'),(24,2,'foto-24-2-3.jpg','2019-07-10 23:14:01','2019-07-10 23:14:01'),(25,3,'foto-25-3-4.jpg','2019-07-11 17:09:45','2019-07-11 17:09:45'),(26,3,'foto-26-3-4.jpg','2019-07-11 17:09:45','2019-07-11 17:09:45'),(27,3,'foto-27-3-4.jpg','2019-07-11 17:09:45','2019-07-11 17:09:45'),(28,3,'foto-28-3-4.jpg','2019-07-11 17:09:45','2019-07-11 17:09:45'),(29,3,'foto-29-3-4.jpg','2019-07-11 17:09:45','2019-07-11 17:09:45'),(30,3,'foto-30-3-4.jpg','2019-07-11 17:09:45','2019-07-11 17:09:46'),(31,3,'foto-31-3-4.jpg','2019-07-11 17:09:46','2019-07-11 17:09:46'),(32,3,'foto-32-3-4.jpg','2019-07-11 17:09:46','2019-07-11 17:09:46');
/*!40000 ALTER TABLE `tbl_fotos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_frequencias`
--

DROP TABLE IF EXISTS `tbl_frequencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_frequencias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ausente` tinyint(1) NOT NULL,
  `id_membro_comunidade` bigint(20) unsigned NOT NULL,
  `id_reuniao` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_frequencias_id_membro_comunidade_foreign` (`id_membro_comunidade`),
  KEY `tbl_frequencias_id_reuniao_foreign` (`id_reuniao`),
  CONSTRAINT `tbl_frequencias_id_membro_comunidade_foreign` FOREIGN KEY (`id_membro_comunidade`) REFERENCES `tbl_membros_comunidades` (`id`),
  CONSTRAINT `tbl_frequencias_id_reuniao_foreign` FOREIGN KEY (`id_reuniao`) REFERENCES `tbl_reunioes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_frequencias`
--

LOCK TABLES `tbl_frequencias` WRITE;
/*!40000 ALTER TABLE `tbl_frequencias` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_frequencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_funcoes`
--

DROP TABLE IF EXISTS `tbl_funcoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_funcoes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `apresentar` tinyint(1) NOT NULL DEFAULT '0',
  `id_igreja` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_funcoes_id_igreja_foreign` (`id_igreja`),
  CONSTRAINT `tbl_funcoes_id_igreja_foreign` FOREIGN KEY (`id_igreja`) REFERENCES `tbl_igrejas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_funcoes`
--

LOCK TABLES `tbl_funcoes` WRITE;
/*!40000 ALTER TABLE `tbl_funcoes` DISABLE KEYS */;
INSERT INTO `tbl_funcoes` VALUES (1,'Professor',NULL,1,1,NULL,NULL),(2,'Diretor',NULL,1,1,NULL,NULL),(3,'Secretário',NULL,1,1,NULL,NULL),(4,'Diretora','Diretora',1,3,'2019-07-10 13:51:27','2019-07-10 13:51:27'),(5,'Pedagoga','Pedagoga',1,3,'2019-07-10 13:51:45','2019-07-10 13:51:45'),(6,'Professor','Professor',1,3,'2019-07-10 13:51:58','2019-07-10 13:51:58');
/*!40000 ALTER TABLE `tbl_funcoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_galerias`
--

DROP TABLE IF EXISTS `tbl_galerias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_galerias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_igreja` bigint(20) unsigned NOT NULL,
  `data` date DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_galerias_id_igreja_foreign` (`id_igreja`),
  CONSTRAINT `tbl_galerias_id_igreja_foreign` FOREIGN KEY (`id_igreja`) REFERENCES `tbl_igrejas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_galerias`
--

LOCK TABLES `tbl_galerias` WRITE;
/*!40000 ALTER TABLE `tbl_galerias` DISABLE KEYS */;
INSERT INTO `tbl_galerias` VALUES (1,'Fotos de apresentação da nossa escola',1,'2019-07-06','Fotos de apresentação da nossa escola.','2019-07-08 07:50:01',NULL),(2,'Arraial do IEPG',3,'2019-07-10',NULL,'2019-07-10 14:03:36','2019-07-10 23:14:01'),(3,'Festa Junina',4,'2019-07-11','Vejam as fotos da nossa festa junina.','2019-07-11 17:09:45','2019-07-11 17:09:45');
/*!40000 ALTER TABLE `tbl_galerias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_igrejas`
--

DROP TABLE IF EXISTS `tbl_igrejas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_igrejas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnpj` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bairro` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rua` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complemento` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_igrejas`
--

LOCK TABLES `tbl_igrejas` WRITE;
/*!40000 ALTER TABLE `tbl_igrejas` DISABLE KEYS */;
INSERT INTO `tbl_igrejas` VALUES (1,' Colégio CEPSMA','99.999.999/9999-99','35.170-300','MG','Coronel Fabriciano','Centro','Avenida Pedro Nolasco',NULL,'609','(31) 38413-797_','cepsma@teste.com',1,'logo-igreja-1.png',NULL,'2019-07-10 15:51:58'),(2,' Colégio Padre Abdala','21.323.231/3213-12','35.180-056','MG','Timóteo','Vila dos Técnicos','Rua Maria Aparecida Martins Prado',NULL,'12','(31) 38492-810_','email@escola.com',1,'logo-igreja-2.jpg','2019-07-09 18:22:47','2019-07-10 22:44:28'),(3,' IEPG - Pingo De Gente','99.999.999/9999-99','35.180-410','MG','Timóteo','Funcionários','Avenida Juscelino Kubitschek',NULL,'07','(31) 38484-106_','iepg@escola.com',1,'logo-igreja-3.png','2019-07-09 23:03:42','2019-07-10 23:09:34'),(4,' Ethos Instituto De Educação','99.999.999/9999-99','35.170-006','MG','Coronel Fabriciano','Centro','Rua Efrem Macedo',NULL,'466','(31) 38411-743_','ethos@escola.com',1,'logo-igreja-4.png','2019-07-11 16:37:35','2019-07-11 16:37:35'),(5,' Colégio CESP','99.999.999/9999-99','35.930-003','MG','João Monlevade','Carneirinhos','Avenida Getúlio Vargas',NULL,'5074','(31) 38525-582_','CESP@escola.com',1,'logo-igreja-5.jpg','2019-07-19 16:38:01','2019-07-19 16:38:01'),(6,' Cabral Porto Imóveis','99.999.999/9999-99','35.180-012','MG','Timóteo','Centro','Rua Doze de Outubro',NULL,'65','(31) 38487-131_','cabralporto@hotsystems.com.br',1,'logo-igreja-6.jpg','2019-07-21 17:51:58','2019-07-21 17:51:58');
/*!40000 ALTER TABLE `tbl_igrejas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_igrejas_modulos`
--

DROP TABLE IF EXISTS `tbl_igrejas_modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_igrejas_modulos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_igreja` bigint(20) NOT NULL,
  `id_modulo` bigint(20) NOT NULL,
  `icone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_igrejas_modulos`
--

LOCK TABLES `tbl_igrejas_modulos` WRITE;
/*!40000 ALTER TABLE `tbl_igrejas_modulos` DISABLE KEYS */;
INSERT INTO `tbl_igrejas_modulos` VALUES (1,1,19,NULL,'2019-07-09 11:27:46','2019-07-09 11:27:46'),(2,1,22,NULL,'2019-07-09 11:27:46','2019-07-09 11:27:46'),(3,1,25,NULL,'2019-07-09 11:27:46','2019-07-09 11:27:46'),(4,1,5,NULL,'2019-07-09 11:27:46','2019-07-09 11:27:46'),(5,1,16,NULL,'2019-07-09 11:27:46','2019-07-09 11:27:46'),(6,1,24,NULL,'2019-07-09 11:27:46','2019-07-09 11:27:46'),(7,1,10,NULL,'2019-07-09 11:27:46','2019-07-09 11:27:46'),(8,1,15,NULL,'2019-07-09 11:27:46','2019-07-09 11:27:46'),(9,1,6,NULL,'2019-07-09 11:27:46','2019-07-09 11:27:46'),(10,1,17,NULL,'2019-07-09 11:27:46','2019-07-09 11:27:46'),(11,1,23,NULL,'2019-07-09 11:27:46','2019-07-09 11:27:46'),(12,1,9,NULL,'2019-07-09 11:27:46','2019-07-09 11:27:46'),(13,1,18,NULL,'2019-07-09 11:27:46','2019-07-09 11:27:46'),(14,1,14,NULL,'2019-07-09 11:27:46','2019-07-09 11:27:46'),(15,1,21,NULL,'2019-07-09 11:27:46','2019-07-09 11:27:46'),(16,1,12,NULL,'2019-07-09 11:27:46','2019-07-09 11:27:46'),(17,1,13,NULL,'2019-07-09 11:27:46','2019-07-09 11:27:46'),(18,1,20,NULL,'2019-07-09 11:27:46','2019-07-09 11:27:46'),(19,2,5,NULL,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(20,2,6,NULL,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(21,2,9,NULL,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(22,2,10,NULL,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(23,2,12,NULL,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(24,2,13,NULL,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(25,2,14,NULL,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(26,2,15,NULL,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(27,2,16,NULL,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(28,2,17,NULL,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(29,2,18,NULL,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(30,2,19,NULL,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(31,2,20,NULL,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(32,2,21,NULL,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(33,2,22,NULL,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(34,2,23,NULL,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(35,2,24,NULL,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(36,2,25,NULL,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(37,3,5,NULL,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(38,3,6,NULL,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(39,3,9,NULL,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(40,3,10,NULL,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(41,3,12,NULL,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(42,3,13,NULL,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(43,3,14,NULL,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(44,3,15,NULL,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(45,3,16,NULL,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(46,3,17,NULL,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(47,3,18,NULL,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(48,3,19,NULL,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(49,3,20,NULL,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(50,3,21,NULL,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(51,3,22,NULL,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(52,3,23,NULL,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(53,3,24,NULL,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(54,3,25,NULL,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(55,4,5,NULL,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(56,4,6,NULL,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(57,4,9,NULL,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(58,4,10,NULL,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(59,4,12,NULL,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(60,4,13,'fa fa-child','2019-07-11 16:37:35','2019-07-11 16:37:35'),(61,4,14,'fa fa-users','2019-07-11 16:37:35','2019-07-11 16:37:35'),(62,4,15,'fa fa-file-image-o','2019-07-11 16:37:35','2019-07-11 16:37:35'),(63,4,16,'fa fa-calendar','2019-07-11 16:37:35','2019-07-11 16:37:35'),(64,4,17,'fa fa-clock-o','2019-07-11 16:37:35','2019-07-11 16:37:35'),(65,4,18,'fa fa-newspaper-o','2019-07-11 16:37:35','2019-07-11 16:37:35'),(66,4,19,'fa fa-play','2019-07-11 16:37:35','2019-07-11 16:37:35'),(67,4,20,'fa fa-microphone','2019-07-11 16:37:35','2019-07-11 16:37:35'),(68,4,21,'fa fa-thumbs-o-up','2019-07-11 16:37:35','2019-07-11 16:37:35'),(69,4,22,'fa fa-cogs','2019-07-11 16:37:35','2019-07-11 16:37:35'),(70,4,23,NULL,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(71,4,24,'fa fa-tags','2019-07-11 16:37:35','2019-07-11 16:37:35'),(72,4,25,'fa fa-user-plus','2019-07-11 16:37:35','2019-07-11 16:37:35'),(73,5,5,NULL,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(74,5,6,NULL,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(75,5,9,NULL,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(76,5,10,NULL,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(77,5,12,NULL,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(78,5,13,'fa fa-child','2019-07-19 16:38:01','2019-07-19 16:38:01'),(79,5,14,'fa fa-users','2019-07-19 16:38:01','2019-07-19 16:38:01'),(80,5,15,'fa fa-file-image-o','2019-07-19 16:38:01','2019-07-19 16:38:01'),(81,5,16,'fa fa-calendar','2019-07-19 16:38:01','2019-07-19 16:38:01'),(82,5,17,'fa fa-clock-o','2019-07-19 16:38:01','2019-07-19 16:38:01'),(83,5,18,'fa fa-newspaper-o','2019-07-19 16:38:01','2019-07-19 16:38:01'),(84,5,19,'fa fa-play','2019-07-19 16:38:01','2019-07-19 16:38:01'),(85,5,20,'fa fa-microphone','2019-07-19 16:38:01','2019-07-19 16:38:01'),(86,5,21,'fa fa-thumbs-o-up','2019-07-19 16:38:01','2019-07-19 16:38:01'),(87,5,22,'fa fa-cogs','2019-07-19 16:38:01','2019-07-19 16:38:01'),(88,5,23,NULL,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(89,5,24,'fa fa-tags','2019-07-19 16:38:01','2019-07-19 16:38:01'),(90,5,25,'fa fa-user-plus','2019-07-19 16:38:01','2019-07-19 16:38:01'),(91,6,5,NULL,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(92,6,6,NULL,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(93,6,9,NULL,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(94,6,10,NULL,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(95,6,12,NULL,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(96,6,13,'fa fa-child','2019-07-21 17:51:58','2019-07-21 17:51:58'),(97,6,14,'fa fa-users','2019-07-21 17:51:58','2019-07-21 17:51:58'),(98,6,15,'fa fa-file-image-o','2019-07-21 17:51:58','2019-07-21 17:51:58'),(99,6,16,'fa fa-calendar','2019-07-21 17:51:58','2019-07-21 17:51:58'),(100,6,17,'fa fa-clock-o','2019-07-21 17:51:58','2019-07-21 17:51:58'),(101,6,18,'fa fa-newspaper-o','2019-07-21 17:51:58','2019-07-21 17:51:58'),(102,6,19,'fa fa-play','2019-07-21 17:51:58','2019-07-21 17:51:58'),(103,6,20,'fa fa-microphone','2019-07-21 17:51:58','2019-07-21 17:51:58'),(104,6,21,'fa fa-thumbs-o-up','2019-07-21 17:51:58','2019-07-21 17:51:58'),(105,6,22,'fa fa-cogs','2019-07-21 17:51:58','2019-07-21 17:51:58'),(106,6,23,NULL,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(107,6,24,'fa fa-tags','2019-07-21 17:51:58','2019-07-21 17:51:58'),(108,6,25,'fa fa-user-plus','2019-07-21 17:51:58','2019-07-21 17:51:58');
/*!40000 ALTER TABLE `tbl_igrejas_modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_inscricoes`
--

DROP TABLE IF EXISTS `tbl_inscricoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_inscricoes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_evento` bigint(20) unsigned NOT NULL,
  `cancelada` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_inscricoes_id_evento_foreign` (`id_evento`),
  CONSTRAINT `tbl_inscricoes_id_evento_foreign` FOREIGN KEY (`id_evento`) REFERENCES `tbl_eventos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_inscricoes`
--

LOCK TABLES `tbl_inscricoes` WRITE;
/*!40000 ALTER TABLE `tbl_inscricoes` DISABLE KEYS */;
INSERT INTO `tbl_inscricoes` VALUES (1,'jeanesbc@gmail.com','(31) 38496-771_',1,0,'2019-07-10 14:48:04','2019-07-10 14:48:04');
/*!40000 ALTER TABLE `tbl_inscricoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_logs`
--

DROP TABLE IF EXISTS `tbl_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_usuario` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_logs_id_usuario_foreign` (`id_usuario`),
  CONSTRAINT `tbl_logs_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_logs`
--

LOCK TABLES `tbl_logs` WRITE;
/*!40000 ALTER TABLE `tbl_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_membros`
--

DROP TABLE IF EXISTS `tbl_membros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_membros` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `twitter` text COLLATE utf8mb4_unicode_ci,
  `youtube` text COLLATE utf8mb4_unicode_ci,
  `facebook` text COLLATE utf8mb4_unicode_ci,
  `foto` text COLLATE utf8mb4_unicode_ci,
  `dt_nascimento` date DEFAULT NULL,
  `cep` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bairro` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rua` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complemento` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_igreja` bigint(20) unsigned NOT NULL,
  `id_funcao` bigint(20) unsigned DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_membros_id_igreja_foreign` (`id_igreja`),
  KEY `tbl_membros_id_funcao_foreign` (`id_funcao`),
  CONSTRAINT `tbl_membros_id_funcao_foreign` FOREIGN KEY (`id_funcao`) REFERENCES `tbl_funcoes` (`id`),
  CONSTRAINT `tbl_membros_id_igreja_foreign` FOREIGN KEY (`id_igreja`) REFERENCES `tbl_igrejas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_membros`
--

LOCK TABLES `tbl_membros` WRITE;
/*!40000 ALTER TABLE `tbl_membros` DISABLE KEYS */;
INSERT INTO `tbl_membros` VALUES (1,'Ana','Professora do ensino médio e fundamental de matemática.',NULL,NULL,NULL,'membro-1-1.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,NULL,NULL),(2,'Beth','Professora do ensino médio e fundamental de portugês.',NULL,NULL,NULL,'membro-2-1.jpeg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,NULL,NULL),(3,'Clara',NULL,NULL,NULL,NULL,'membro-3-1.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,2,1,NULL,NULL),(4,'Débora','Responsável pela recepção na escola.',NULL,NULL,NULL,'membro-4-1.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,3,1,NULL,NULL),(5,'Eliane',NULL,NULL,NULL,NULL,'membro-5-3.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,4,1,'2019-07-10 13:55:44','2019-07-10 13:55:44'),(6,'Eduarda',NULL,NULL,NULL,NULL,'membro-6-3.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,5,1,'2019-07-10 13:56:11','2019-07-11 13:52:48'),(7,'Deise',NULL,NULL,NULL,NULL,'membro-7-3.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,6,1,'2019-07-10 13:56:55','2019-07-11 13:53:01'),(8,'Felipe',NULL,NULL,NULL,NULL,'membro-8-3.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,6,1,'2019-07-10 13:57:19','2019-07-10 13:57:19');
/*!40000 ALTER TABLE `tbl_membros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_membros_comunidades`
--

DROP TABLE IF EXISTS `tbl_membros_comunidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_membros_comunidades` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `lider` tinyint(1) NOT NULL,
  `id_membro` bigint(20) unsigned NOT NULL,
  `id_comunidade` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_membros_comunidades_id_membro_foreign` (`id_membro`),
  KEY `tbl_membros_comunidades_id_comunidade_foreign` (`id_comunidade`),
  CONSTRAINT `tbl_membros_comunidades_id_comunidade_foreign` FOREIGN KEY (`id_comunidade`) REFERENCES `tbl_comunidades` (`id`),
  CONSTRAINT `tbl_membros_comunidades_id_membro_foreign` FOREIGN KEY (`id_membro`) REFERENCES `tbl_membros` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_membros_comunidades`
--

LOCK TABLES `tbl_membros_comunidades` WRITE;
/*!40000 ALTER TABLE `tbl_membros_comunidades` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_membros_comunidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_menus`
--

DROP TABLE IF EXISTS `tbl_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_configuracao` bigint(20) unsigned NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ordem` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_menus_id_configuracao_foreign` (`id_configuracao`),
  CONSTRAINT `tbl_menus_id_configuracao_foreign` FOREIGN KEY (`id_configuracao`) REFERENCES `tbl_configuracoes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_menus`
--

LOCK TABLES `tbl_menus` WRITE;
/*!40000 ALTER TABLE `tbl_menus` DISABLE KEYS */;
INSERT INTO `tbl_menus` VALUES (1,'Portal',1,'http://www.eduno.com.br/',100,NULL,'2019-07-09 19:55:58'),(2,'Administrativo',1,'login',90,NULL,'2019-07-09 14:46:06'),(3,'Sobre nós',1,NULL,3,NULL,NULL),(4,'Vídeos',1,'sermoes',4,NULL,NULL),(5,'Galeria',1,'galeria',5,NULL,NULL),(6,'Notícias',1,'noticias',6,NULL,NULL),(7,'Eventos',1,NULL,7,NULL,NULL),(8,'Portal do Aluno',2,'http://www.eduno.com.br/',19,'2019-07-09 18:22:47','2019-07-09 19:03:51'),(9,'Administrativo',2,'login',20,'2019-07-09 18:22:47','2019-07-09 19:06:49'),(10,'Sobre nós',2,NULL,3,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(11,'Mídia',2,NULL,4,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(12,'Eventos',2,NULL,5,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(13,'Portal do Aluno',3,'http://www.eduno.com.br/',20,'2019-07-09 23:03:42','2019-07-10 13:37:53'),(14,'Administrativo',3,'login',30,'2019-07-09 23:03:42','2019-07-10 13:37:43'),(15,'Institucional',3,NULL,3,'2019-07-09 23:03:42','2019-07-10 14:04:30'),(16,'Galerias',3,NULL,4,'2019-07-09 23:03:42','2019-07-10 14:22:23'),(17,'Eventos',3,NULL,5,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(18,'Portal do Aluno',4,'http://www.eduno.com.br/',100,'2019-07-11 16:37:35','2019-07-11 17:00:32'),(19,'Administração',4,'login',90,'2019-07-11 16:37:35','2019-07-11 17:03:01'),(20,'A Escola',4,NULL,1,'2019-07-11 16:37:35','2019-07-11 17:14:24'),(21,'Mídia',4,NULL,4,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(22,'Eventos',4,NULL,5,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(23,'Eduno',5,'http://www.eduno.com.br/',19,'2019-07-19 16:38:01','2019-07-19 17:40:48'),(24,'Administrativo',5,'login',20,'2019-07-19 16:38:01','2019-07-19 17:41:00'),(25,'Sobre nós',5,NULL,3,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(26,'Mídia',5,NULL,4,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(27,'Eventos',5,NULL,5,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(28,'Imóveis',6,'publicacao/3',100,'2019-07-21 17:51:58','2019-07-22 17:03:38'),(29,'Administrativo',6,'login',200,'2019-07-21 17:51:58','2019-07-22 16:56:49'),(30,'Sobre nós',6,NULL,3,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(31,'Mídia',6,NULL,4,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(32,'Eventos',6,NULL,5,'2019-07-21 17:51:58','2019-07-21 17:51:58');
/*!40000 ALTER TABLE `tbl_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_modulos`
--

DROP TABLE IF EXISTS `tbl_modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_modulos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rota` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sistema` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `gerencial` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_modulos`
--

LOCK TABLES `tbl_modulos` WRITE;
/*!40000 ALTER TABLE `tbl_modulos` DISABLE KEYS */;
INSERT INTO `tbl_modulos` VALUES (5,'Eventos Fixos','Funcionalidade do site apresentativo.','eventosfixos','web',0,NULL,NULL),(6,'Linha do tempo','Funcionalidade do site apresentativo.','eventos','web',0,NULL,NULL),(9,'Notícias','Funcionalidade do site apresentativo.','noticias','web',0,NULL,NULL),(10,'Galeria','Funcionalidade do site apresentativo.','galeria','web',0,NULL,NULL),(12,'Sermões','Funcionalidade do site apresentativo.','sermoes','web',0,NULL,NULL),(13,'Usuários','Funcionalidade do site gerencial.','usuarios','web',1,NULL,NULL),(14,'Perfis','Funcionalidade do site gerencial.','perfis','web',1,NULL,NULL),(15,'Galerias','Funcionalidade do site gerencial.','galerias','web',1,NULL,NULL),(16,'Eventos fixos','Funcionalidade do site gerencial.','eventosfixos','web',1,NULL,NULL),(17,'Linha do tempo','Funcionalidade do site gerencial.','eventos','web',1,NULL,NULL),(18,'Notícias','Funcionalidade do site gerencial.','noticias','web',1,NULL,NULL),(19,'Banners','Funcionalidade do site gerencial.','banners','web',1,NULL,NULL),(20,'Vídeos','Funcionalidade do site gerencial.','sermoes','web',1,NULL,NULL),(21,'Publicações','Funcionalidade do site gerencial.','publicacoes','web',1,NULL,NULL),(22,'Configurações','Funcionalidade do site gerencial.','configuracoes','web',1,NULL,NULL),(23,'Login','Funcionalidade do site apresentativo.','login','web',0,NULL,NULL),(24,'Funções','Funcionalidade do site gerencial.','funcoes','web',1,NULL,NULL),(25,'Equipe','Funcionalidade do site gerencial.','membros','web',1,NULL,NULL);
/*!40000 ALTER TABLE `tbl_modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_modulos_permissoes`
--

DROP TABLE IF EXISTS `tbl_modulos_permissoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_modulos_permissoes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_modulo` bigint(20) unsigned NOT NULL,
  `id_permissao` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_modulos_permissoes_id_modulo_foreign` (`id_modulo`),
  KEY `tbl_modulos_permissoes_id_permissao_foreign` (`id_permissao`),
  CONSTRAINT `tbl_modulos_permissoes_id_modulo_foreign` FOREIGN KEY (`id_modulo`) REFERENCES `tbl_modulos` (`id`),
  CONSTRAINT `tbl_modulos_permissoes_id_permissao_foreign` FOREIGN KEY (`id_permissao`) REFERENCES `tbl_permissoes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_modulos_permissoes`
--

LOCK TABLES `tbl_modulos_permissoes` WRITE;
/*!40000 ALTER TABLE `tbl_modulos_permissoes` DISABLE KEYS */;
INSERT INTO `tbl_modulos_permissoes` VALUES (1,13,1,NULL,NULL),(2,13,2,NULL,NULL),(3,13,3,NULL,NULL),(4,14,1,NULL,NULL),(5,14,2,NULL,NULL),(6,14,3,NULL,NULL),(7,15,1,NULL,NULL),(8,15,2,NULL,NULL),(9,15,3,NULL,NULL),(10,16,1,NULL,NULL),(11,16,2,NULL,NULL),(12,16,3,NULL,NULL),(13,17,1,NULL,NULL),(14,17,2,NULL,NULL),(15,17,3,NULL,NULL),(16,18,1,NULL,NULL),(17,18,2,NULL,NULL),(18,18,3,NULL,NULL),(19,19,1,NULL,NULL),(20,19,2,NULL,NULL),(21,19,3,NULL,NULL),(22,20,1,NULL,NULL),(23,20,2,NULL,NULL),(24,20,3,NULL,NULL),(25,21,1,NULL,NULL),(26,21,2,NULL,NULL),(27,21,3,NULL,NULL),(28,22,1,NULL,NULL),(29,22,2,NULL,NULL),(30,22,3,NULL,NULL),(31,24,1,NULL,NULL),(32,24,2,NULL,NULL),(33,24,3,NULL,NULL),(34,25,1,NULL,NULL),(35,25,2,NULL,NULL),(36,25,3,NULL,NULL);
/*!40000 ALTER TABLE `tbl_modulos_permissoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_noticias`
--

DROP TABLE IF EXISTS `tbl_noticias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_noticias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_igreja` bigint(20) unsigned NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_noticias_id_igreja_foreign` (`id_igreja`),
  CONSTRAINT `tbl_noticias_id_igreja_foreign` FOREIGN KEY (`id_igreja`) REFERENCES `tbl_igrejas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_noticias`
--

LOCK TABLES `tbl_noticias` WRITE;
/*!40000 ALTER TABLE `tbl_noticias` DISABLE KEYS */;
INSERT INTO `tbl_noticias` VALUES (1,'Campanha a favor das árvores!',1,'Nossa escola está incentivando os alunos a plantar uma árvore e promovendo conscientização sobre o desmatamento.','noticia-1-1.jpeg','2019-07-06 05:50:01',NULL),(2,'Curso de inglês extra-classe!',1,'Venham participar da nossa nova turma de inglês.','noticia-2-1.jpeg','2019-07-06 15:50:01',NULL),(3,'Dia do meio-ambiente',2,'Vamos plantar árvores em nosso bairro? Neste dia nos encontraremos na portaria às 08h.','noticia-3-2.jpg','2019-07-09 19:05:04','2019-07-09 19:08:14');
/*!40000 ALTER TABLE `tbl_noticias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_perfis`
--

DROP TABLE IF EXISTS `tbl_perfis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_perfis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `id_igreja` bigint(20) unsigned DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_perfis_id_igreja_foreign` (`id_igreja`),
  CONSTRAINT `tbl_perfis_id_igreja_foreign` FOREIGN KEY (`id_igreja`) REFERENCES `tbl_igrejas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_perfis`
--

LOCK TABLES `tbl_perfis` WRITE;
/*!40000 ALTER TABLE `tbl_perfis` DISABLE KEYS */;
INSERT INTO `tbl_perfis` VALUES (1,'ADM Plataforma','Administrador da plataforma.',NULL,1,NULL,NULL),(2,'ADM Site','Administrador do site da escola.',1,1,NULL,'2019-07-09 11:28:22'),(3,'Administrador','Perfil dos administradores da escola.',2,1,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(4,'Administrador','Perfil dos administradores da escola.',3,1,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(5,'Administrador','Perfil dos administradores da escola.',4,1,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(6,'Administrador','Perfil dos administradores da escola.',5,1,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(7,'Administrador','Perfil dos administradores da escola.',6,1,'2019-07-21 17:51:58','2019-07-21 17:51:58');
/*!40000 ALTER TABLE `tbl_perfis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_perfis_igrejas_modulos`
--

DROP TABLE IF EXISTS `tbl_perfis_igrejas_modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_perfis_igrejas_modulos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_perfil` bigint(20) unsigned NOT NULL,
  `id_modulo_igreja` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_perfis_igrejas_modulos_id_perfil_foreign` (`id_perfil`),
  KEY `tbl_perfis_igrejas_modulos_id_modulo_igreja_foreign` (`id_modulo_igreja`),
  CONSTRAINT `tbl_perfis_igrejas_modulos_id_modulo_igreja_foreign` FOREIGN KEY (`id_modulo_igreja`) REFERENCES `tbl_igrejas_modulos` (`id`),
  CONSTRAINT `tbl_perfis_igrejas_modulos_id_perfil_foreign` FOREIGN KEY (`id_perfil`) REFERENCES `tbl_perfis` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_perfis_igrejas_modulos`
--

LOCK TABLES `tbl_perfis_igrejas_modulos` WRITE;
/*!40000 ALTER TABLE `tbl_perfis_igrejas_modulos` DISABLE KEYS */;
INSERT INTO `tbl_perfis_igrejas_modulos` VALUES (1,2,1,'2019-07-09 11:28:52','2019-07-09 11:28:52'),(2,2,2,'2019-07-09 11:28:52','2019-07-09 11:28:52'),(3,2,3,'2019-07-09 11:28:52','2019-07-09 11:28:52'),(4,2,5,'2019-07-09 11:28:52','2019-07-09 11:28:52'),(5,2,6,'2019-07-09 11:28:52','2019-07-09 11:28:52'),(6,2,8,'2019-07-09 11:28:52','2019-07-09 11:28:52'),(7,2,10,'2019-07-09 11:28:52','2019-07-09 11:28:52'),(8,2,13,'2019-07-09 11:28:52','2019-07-09 11:28:52'),(9,2,14,'2019-07-09 11:28:52','2019-07-09 11:28:52'),(10,2,15,'2019-07-09 11:28:52','2019-07-09 11:28:52'),(11,2,17,'2019-07-09 11:28:52','2019-07-09 11:28:52'),(12,2,18,'2019-07-09 11:28:52','2019-07-09 11:28:52'),(13,3,24,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(14,3,25,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(15,3,26,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(16,3,27,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(17,3,28,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(18,3,29,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(19,3,30,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(20,3,31,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(21,3,32,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(22,3,33,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(23,3,35,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(24,3,36,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(25,4,42,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(26,4,43,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(27,4,44,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(28,4,45,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(29,4,46,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(30,4,47,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(31,4,48,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(32,4,49,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(33,4,50,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(34,4,51,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(35,4,53,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(36,4,54,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(37,5,60,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(38,5,61,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(39,5,62,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(40,5,63,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(41,5,64,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(42,5,65,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(43,5,66,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(44,5,67,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(45,5,68,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(46,5,69,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(47,5,71,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(48,5,72,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(49,6,78,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(50,6,79,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(51,6,80,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(52,6,81,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(53,6,82,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(54,6,83,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(55,6,84,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(56,6,85,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(57,6,86,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(58,6,87,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(59,6,89,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(60,6,90,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(61,7,96,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(62,7,97,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(63,7,98,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(64,7,99,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(65,7,100,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(66,7,101,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(67,7,102,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(68,7,103,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(69,7,104,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(70,7,105,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(71,7,107,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(72,7,108,'2019-07-21 17:51:58','2019-07-21 17:51:58');
/*!40000 ALTER TABLE `tbl_perfis_igrejas_modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_perfis_permissoes`
--

DROP TABLE IF EXISTS `tbl_perfis_permissoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_perfis_permissoes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_perfil_igreja_modulo` bigint(20) unsigned DEFAULT NULL,
  `id_permissao` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_perfis_permissoes_id_perfil_igreja_modulo_foreign` (`id_perfil_igreja_modulo`),
  KEY `tbl_perfis_permissoes_id_permissao_foreign` (`id_permissao`),
  CONSTRAINT `tbl_perfis_permissoes_id_perfil_igreja_modulo_foreign` FOREIGN KEY (`id_perfil_igreja_modulo`) REFERENCES `tbl_perfis_igrejas_modulos` (`id`),
  CONSTRAINT `tbl_perfis_permissoes_id_permissao_foreign` FOREIGN KEY (`id_permissao`) REFERENCES `tbl_permissoes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_perfis_permissoes`
--

LOCK TABLES `tbl_perfis_permissoes` WRITE;
/*!40000 ALTER TABLE `tbl_perfis_permissoes` DISABLE KEYS */;
INSERT INTO `tbl_perfis_permissoes` VALUES (1,1,2,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(2,1,3,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(3,1,1,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(4,2,2,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(5,2,3,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(6,2,1,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(7,3,2,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(8,3,3,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(9,3,1,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(10,4,2,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(11,4,3,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(12,4,1,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(13,5,2,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(14,5,3,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(15,5,1,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(16,6,2,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(17,6,3,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(18,6,1,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(19,7,2,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(20,7,3,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(21,7,1,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(22,8,2,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(23,8,3,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(24,8,1,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(25,9,2,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(26,9,3,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(27,9,1,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(28,10,2,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(29,10,3,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(30,10,1,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(31,11,2,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(32,11,3,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(33,11,1,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(34,12,2,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(35,12,3,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(36,12,1,'2019-07-09 11:58:29','2019-07-09 11:58:29'),(37,19,2,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(38,19,3,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(39,19,1,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(40,22,2,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(41,22,3,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(42,22,1,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(43,24,2,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(44,24,3,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(45,24,1,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(46,16,2,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(47,16,3,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(48,16,1,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(49,23,2,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(50,23,3,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(51,23,1,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(52,15,2,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(53,15,3,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(54,15,1,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(55,17,2,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(56,17,3,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(57,17,1,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(58,18,2,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(59,18,3,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(60,18,1,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(61,14,2,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(62,14,3,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(63,14,1,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(64,21,2,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(65,21,3,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(66,21,1,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(67,13,2,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(68,13,3,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(69,13,1,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(70,20,2,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(71,20,3,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(72,20,1,'2019-07-09 18:50:51','2019-07-09 18:50:51'),(73,31,2,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(74,31,3,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(75,31,1,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(76,34,2,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(77,34,3,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(78,34,1,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(79,36,2,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(80,36,3,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(81,36,1,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(82,28,2,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(83,28,3,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(84,28,1,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(85,35,2,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(86,35,3,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(87,35,1,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(88,27,2,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(89,27,3,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(90,27,1,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(91,29,2,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(92,29,3,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(93,29,1,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(94,30,2,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(95,30,3,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(96,30,1,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(97,26,2,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(98,26,3,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(99,26,1,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(100,33,2,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(101,33,3,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(102,33,1,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(103,25,2,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(104,25,3,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(105,25,1,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(106,32,2,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(107,32,3,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(108,32,1,'2019-07-10 13:25:14','2019-07-10 13:25:14'),(109,43,2,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(110,43,3,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(111,43,1,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(112,46,2,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(113,46,3,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(114,46,1,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(115,48,2,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(116,48,3,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(117,48,1,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(118,40,2,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(119,40,3,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(120,40,1,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(121,47,2,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(122,47,3,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(123,47,1,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(124,39,2,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(125,39,3,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(126,39,1,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(127,41,2,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(128,41,3,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(129,41,1,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(130,42,2,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(131,42,3,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(132,42,1,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(133,38,2,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(134,38,3,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(135,38,1,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(136,45,2,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(137,45,3,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(138,45,1,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(139,37,2,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(140,37,3,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(141,37,1,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(142,44,2,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(143,44,3,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(144,44,1,'2019-07-11 16:43:51','2019-07-11 16:43:51'),(178,55,2,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(179,55,3,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(180,55,1,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(181,58,2,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(182,58,3,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(183,58,1,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(184,60,2,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(185,60,3,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(186,60,1,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(187,52,2,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(188,52,3,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(189,52,1,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(190,59,2,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(191,59,3,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(192,59,1,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(193,51,2,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(194,51,3,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(195,51,1,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(196,53,2,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(197,53,3,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(198,53,1,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(199,54,2,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(200,54,3,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(201,54,1,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(202,50,2,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(203,50,3,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(204,50,1,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(205,57,2,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(206,57,3,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(207,57,1,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(208,49,2,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(209,49,3,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(210,49,1,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(211,56,2,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(212,56,3,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(213,56,1,'2019-07-19 17:27:00','2019-07-19 17:27:00'),(214,67,2,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(215,67,3,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(216,67,1,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(217,70,2,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(218,70,3,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(219,70,1,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(220,72,2,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(221,72,3,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(222,72,1,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(223,64,2,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(224,64,3,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(225,64,1,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(226,71,2,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(227,71,3,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(228,71,1,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(229,63,2,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(230,63,3,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(231,63,1,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(232,65,2,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(233,65,3,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(234,65,1,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(235,66,2,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(236,66,3,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(237,66,1,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(238,62,2,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(239,62,3,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(240,62,1,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(241,69,2,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(242,69,3,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(243,69,1,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(244,61,2,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(245,61,3,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(246,61,1,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(247,68,2,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(248,68,3,'2019-07-22 16:51:59','2019-07-22 16:51:59'),(249,68,1,'2019-07-22 16:51:59','2019-07-22 16:51:59');
/*!40000 ALTER TABLE `tbl_perfis_permissoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_permissoes`
--

DROP TABLE IF EXISTS `tbl_permissoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_permissoes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_permissoes`
--

LOCK TABLES `tbl_permissoes` WRITE;
/*!40000 ALTER TABLE `tbl_permissoes` DISABLE KEYS */;
INSERT INTO `tbl_permissoes` VALUES (1,'Incluír um novo registro.','',NULL,NULL),(2,'Alterar um registro.','',NULL,NULL),(3,'Desativar um registro.','',NULL,NULL);
/*!40000 ALTER TABLE `tbl_permissoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_publicacao_fotos`
--

DROP TABLE IF EXISTS `tbl_publicacao_fotos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_publicacao_fotos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_publicacao` bigint(20) unsigned NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_publicacao_fotos_id_publicacao_foreign` (`id_publicacao`),
  CONSTRAINT `tbl_publicacao_fotos_id_publicacao_foreign` FOREIGN KEY (`id_publicacao`) REFERENCES `tbl_publicacoes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_publicacao_fotos`
--

LOCK TABLES `tbl_publicacao_fotos` WRITE;
/*!40000 ALTER TABLE `tbl_publicacao_fotos` DISABLE KEYS */;
INSERT INTO `tbl_publicacao_fotos` VALUES (1,1,'foto-1-1-1.jpg','2019-07-09 17:47:43','2019-07-09 17:47:43'),(2,2,'foto-2-2-1.jpg','2019-07-09 17:55:16','2019-07-09 17:55:16'),(3,2,'foto-3-2-1.png','2019-07-09 17:55:16','2019-07-09 17:55:17'),(4,2,'foto-4-2-1.jpg','2019-07-09 17:55:17','2019-07-09 17:55:17'),(5,2,'foto-5-2-1.jpg','2019-07-09 17:55:17','2019-07-09 17:55:17'),(6,2,'foto-6-2-1.png','2019-07-09 17:55:17','2019-07-09 17:55:17'),(7,2,'foto-7-2-1.jpg','2019-07-09 17:55:17','2019-07-09 17:55:17'),(9,3,'foto-9-3-6.jpg','2019-07-22 17:06:20','2019-07-22 17:06:20');
/*!40000 ALTER TABLE `tbl_publicacao_fotos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_publicacoes`
--

DROP TABLE IF EXISTS `tbl_publicacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_publicacoes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `html` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_igreja` bigint(20) unsigned NOT NULL,
  `galeria` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_publicacoes_id_igreja_foreign` (`id_igreja`),
  CONSTRAINT `tbl_publicacoes_id_igreja_foreign` FOREIGN KEY (`id_igreja`) REFERENCES `tbl_igrejas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_publicacoes`
--

LOCK TABLES `tbl_publicacoes` WRITE;
/*!40000 ALTER TABLE `tbl_publicacoes` DISABLE KEYS */;
INSERT INTO `tbl_publicacoes` VALUES (1,'Conheça nossas instalações!','<p>sadfsafasdfasdfsadf</p>',1,0,'2019-07-09 17:47:43','2019-07-09 17:47:43'),(2,'dfsdfsf','<p>resteteste teste te t</p>',1,0,'2019-07-09 17:55:16','2019-07-09 17:55:16'),(3,'Imóvel no Bairro Alvorada para venda','<p>Im&oacute;vel com 3 quartos, sala, copa, cozinha, banheiro social e uma &aacute;rea de churrasco nos fundos.</p>',6,0,'2019-07-22 16:58:50','2019-07-22 16:58:50');
/*!40000 ALTER TABLE `tbl_publicacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_reunioes`
--

DROP TABLE IF EXISTS `tbl_reunioes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_reunioes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `observacao` text COLLATE utf8mb4_unicode_ci,
  `inicio` datetime NOT NULL,
  `fim` datetime DEFAULT NULL,
  `cep` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bairro` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rua` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complemento` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_comunidade` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_reunioes_id_comunidade_foreign` (`id_comunidade`),
  CONSTRAINT `tbl_reunioes_id_comunidade_foreign` FOREIGN KEY (`id_comunidade`) REFERENCES `tbl_comunidades` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_reunioes`
--

LOCK TABLES `tbl_reunioes` WRITE;
/*!40000 ALTER TABLE `tbl_reunioes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_reunioes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sermoes`
--

DROP TABLE IF EXISTS `tbl_sermoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sermoes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_igreja` bigint(20) unsigned NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_sermoes_id_igreja_foreign` (`id_igreja`),
  CONSTRAINT `tbl_sermoes_id_igreja_foreign` FOREIGN KEY (`id_igreja`) REFERENCES `tbl_igrejas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sermoes`
--

LOCK TABLES `tbl_sermoes` WRITE;
/*!40000 ALTER TABLE `tbl_sermoes` DISABLE KEYS */;
INSERT INTO `tbl_sermoes` VALUES (1,'Evento da escola','https://www.youtube.com/embed/mJnIPgmEtJU',1,'Evento da escola.','2019-07-07 11:50:01',NULL),(2,'Eduno','https://www.youtube.com/embed/8nEFSJKKTnA',1,'Apresentação do Eduno.','2019-07-07 11:50:01',NULL);
/*!40000 ALTER TABLE `tbl_sermoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sub_menus`
--

DROP TABLE IF EXISTS `tbl_sub_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sub_menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_menu` bigint(20) unsigned NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ordem` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_sub_menus_id_menu_foreign` (`id_menu`),
  CONSTRAINT `tbl_sub_menus_id_menu_foreign` FOREIGN KEY (`id_menu`) REFERENCES `tbl_menus` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sub_menus`
--

LOCK TABLES `tbl_sub_menus` WRITE;
/*!40000 ALTER TABLE `tbl_sub_menus` DISABLE KEYS */;
INSERT INTO `tbl_sub_menus` VALUES (1,'Visões e valores',3,'apresentacao',1,NULL,NULL),(2,'Contatos',3,'contato',2,NULL,NULL),(3,'Eventos fixos',7,'eventosfixos',1,NULL,NULL),(4,'Linha do tempo',7,'eventos',2,NULL,NULL),(5,'Visões e Valores',10,'apresentacao',1,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(6,'Contatos',10,'contato',2,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(7,'Vídeos',11,'sermoes',1,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(8,'Galerias',11,'galeria',2,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(9,'Notícias',11,'noticias',3,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(10,'Eventos fixos',12,'eventosfixos',1,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(11,'Linha do tempo',12,'eventos',2,'2019-07-09 18:22:47','2019-07-09 18:22:47'),(12,'Visões e Valores',15,'apresentacao',1,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(13,'Contatos',15,'contato',2,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(14,'Vídeos',16,'sermoes',1,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(15,'Fotos',16,'galeria',2,'2019-07-09 23:03:42','2019-07-10 14:22:38'),(16,'Notícias',16,'noticias',3,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(17,'Eventos fixos',17,'eventosfixos',1,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(18,'Linha do tempo',17,'eventos',2,'2019-07-09 23:03:42','2019-07-09 23:03:42'),(19,'Visões e Valores',20,'apresentacao',1,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(20,'Contatos',20,'contato',2,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(21,'Vídeos',21,'sermoes',1,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(22,'Galerias',21,'galeria',2,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(23,'Notícias',21,'noticias',3,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(24,'Eventos fixos',22,'eventosfixos',1,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(25,'Linha do tempo',22,'eventos',2,'2019-07-11 16:37:35','2019-07-11 16:37:35'),(26,'Visões e Valores',25,'apresentacao',1,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(27,'Contatos',25,'contato',2,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(28,'Vídeos',26,'sermoes',1,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(29,'Galerias',26,'galeria',2,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(30,'Notícias',26,'noticias',3,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(31,'Eventos fixos',27,'eventosfixos',1,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(32,'Linha do tempo',27,'eventos',2,'2019-07-19 16:38:01','2019-07-19 16:38:01'),(33,'Visões e Valores',30,'apresentacao',1,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(34,'Contatos',30,'contato',2,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(35,'Vídeos',31,'sermoes',1,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(36,'Galerias',31,'galeria',2,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(37,'Notícias',31,'noticias',3,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(38,'Eventos fixos',32,'eventosfixos',1,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(39,'Linha do tempo',32,'eventos',2,'2019-07-21 17:51:58','2019-07-21 17:51:58'),(40,'Venda',28,'publicacao/3',10,'2019-07-22 17:03:56','2019-07-22 17:05:42'),(41,'Aluguel',28,NULL,20,'2019-07-22 17:07:16','2019-07-22 17:07:16'),(42,'Compra',28,NULL,30,'2019-07-22 17:07:53','2019-07-22 17:07:53');
/*!40000 ALTER TABLE `tbl_sub_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sub_sub_menus`
--

DROP TABLE IF EXISTS `tbl_sub_sub_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sub_sub_menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_submenu` bigint(20) unsigned NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordem` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_sub_sub_menus_id_submenu_foreign` (`id_submenu`),
  CONSTRAINT `tbl_sub_sub_menus_id_submenu_foreign` FOREIGN KEY (`id_submenu`) REFERENCES `tbl_sub_menus` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sub_sub_menus`
--

LOCK TABLES `tbl_sub_sub_menus` WRITE;
/*!40000 ALTER TABLE `tbl_sub_sub_menus` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_sub_sub_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_template_fotos`
--

DROP TABLE IF EXISTS `tbl_template_fotos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_template_fotos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_template` bigint(20) unsigned NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_template_fotos_id_template_foreign` (`id_template`),
  CONSTRAINT `tbl_template_fotos_id_template_foreign` FOREIGN KEY (`id_template`) REFERENCES `tbl_templates` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_template_fotos`
--

LOCK TABLES `tbl_template_fotos` WRITE;
/*!40000 ALTER TABLE `tbl_template_fotos` DISABLE KEYS */;
INSERT INTO `tbl_template_fotos` VALUES (1,1,'template-1-1.png','2019-07-08 07:50:01',NULL),(2,1,'template-2-1.png','2019-07-08 07:50:01',NULL),(3,1,'template-3-1.png','2019-07-08 07:50:01',NULL),(4,1,'template-4-1.png','2019-07-08 07:50:01',NULL),(5,1,'template-5-1.png','2019-07-08 07:50:01',NULL),(6,1,'template-6-1.png','2019-07-08 07:50:01',NULL),(7,1,'template-7-1.png','2019-07-08 07:50:01',NULL),(8,1,'template-8-1.png','2019-07-08 07:50:01',NULL),(9,1,'template-9-1.png','2019-07-08 07:50:01',NULL),(10,1,'template-10-1.png','2019-07-08 07:50:01',NULL),(11,1,'template-11-1.png','2019-07-08 07:50:01',NULL),(12,1,'template-12-1.png','2019-07-08 07:50:01',NULL),(13,2,'template-13-2.png','2019-07-08 07:50:01',NULL),(14,2,'template-14-2.png','2019-07-08 07:50:01',NULL),(15,2,'template-15-2.png','2019-07-08 07:50:01',NULL),(16,2,'template-16-2.png','2019-07-08 07:50:01',NULL),(17,2,'template-17-2.png','2019-07-08 07:50:01',NULL),(18,2,'template-18-2.png','2019-07-08 07:50:01',NULL),(19,2,'template-19-2.png','2019-07-08 07:50:01',NULL),(20,2,'template-20-2.png','2019-07-08 07:50:01',NULL),(21,2,'template-21-2.png','2019-07-08 07:50:01',NULL),(22,2,'template-22-2.png','2019-07-08 07:50:01',NULL),(23,2,'template-23-2.png','2019-07-08 07:50:01',NULL),(24,2,'template-24-2.png','2019-07-08 07:50:01',NULL),(25,3,'template-25-3.png','2019-07-08 07:50:01',NULL),(26,3,'template-26-3.png','2019-07-08 07:50:01',NULL),(27,3,'template-27-3.png','2019-07-08 07:50:01',NULL),(28,3,'template-28-3.png','2019-07-08 07:50:01',NULL),(29,3,'template-29-3.png','2019-07-08 07:50:01',NULL),(30,3,'template-30-3.png','2019-07-08 07:50:01',NULL),(31,3,'template-31-3.png','2019-07-08 07:50:01',NULL),(32,3,'template-32-3.png','2019-07-08 07:50:01',NULL),(33,3,'template-33-3.png','2019-07-08 07:50:01',NULL),(34,3,'template-34-3.png','2019-07-08 07:50:01',NULL),(35,3,'template-35-3.png','2019-07-08 07:50:01',NULL),(36,3,'template-36-3.png','2019-07-08 07:50:01',NULL);
/*!40000 ALTER TABLE `tbl_template_fotos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_templates`
--

DROP TABLE IF EXISTS `tbl_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_templates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_templates`
--

LOCK TABLES `tbl_templates` WRITE;
/*!40000 ALTER TABLE `tbl_templates` DISABLE KEYS */;
INSERT INTO `tbl_templates` VALUES (1,'Template padrão 1',NULL,NULL,NULL),(2,'Template padrão 2',NULL,NULL,NULL),(3,'Template padrão 3',NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbl_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perfil` bigint(20) unsigned NOT NULL,
  `id_membro` bigint(20) unsigned DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `ultimo_acesso` datetime DEFAULT NULL,
  `ultima_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_id_perfil_foreign` (`id_perfil`),
  KEY `users_id_membro_foreign` (`id_membro`),
  CONSTRAINT `users_id_membro_foreign` FOREIGN KEY (`id_membro`) REFERENCES `tbl_membros` (`id`),
  CONSTRAINT `users_id_perfil_foreign` FOREIGN KEY (`id_perfil`) REFERENCES `tbl_perfis` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Igor Otoni','igorotoni96@outlook.com',NULL,'$2y$10$vrw2Q4CBYNZraynvQ17e0e0aPz3F/e7KUz.fw/Ci1j6RWUcsJHWOu',1,NULL,1,'2019-07-25 11:30:12','admin/usuarios/tbl_usuarios',NULL,NULL,'2019-07-25 14:30:12'),(2,'Professor','professor@teste.com',NULL,'$2y$10$xFA5lX1fm5JEvhVHd5q3geQFng61Wfe02W.4v95Gk6DBrXyBWi7rO',2,1,1,'2019-07-11 14:13:15','login',NULL,NULL,'2019-07-11 17:13:15'),(3,'Administrador_6007','administrador_6007@teste.com',NULL,'$2y$10$qE9.tm2jEUW2kEW7YujB2Oo3IKYsFwk1shBv6nPsDTcZmEaZ6tgG2',3,NULL,1,'2019-07-22 13:57:41','usuario/editarUsuario/3',NULL,'2019-07-09 18:22:47','2019-07-22 16:57:41'),(4,'Administrador_479','administrador_479@teste.com',NULL,'$2y$10$FJ1Pa.AD8drYNY7mLbNTSOROP6CJ600dYOIjMs8SlT6cNvK06derS',4,NULL,1,'2019-07-21 15:15:19','usuario/editarBanner/17',NULL,'2019-07-09 23:03:42','2019-07-21 18:15:19'),(5,'Administrador_9058','administrador_9058@teste.com',NULL,'$2y$10$4PTm6VYbY0nmlUFQi2TrT.uPrpLMs.RI71a.efPRyCiG5jZ5RAg8C',5,NULL,1,'2019-07-11 17:05:25','iepa',NULL,'2019-07-11 16:37:36','2019-07-11 20:05:25'),(6,'Administrador_7250','administrador_7250@teste.com',NULL,'$2y$10$C3yYK8vZl/r3jloPiduBDO7P.YEIXXZFlZ5TSzIk7m6vkbHiLlTPW',6,NULL,1,'2019-07-22 16:48:44','usuario/tbl_banners',NULL,'2019-07-19 16:38:02','2019-07-22 19:48:44'),(7,'Administrador_8254','administrador_8254@teste.com',NULL,'$2y$10$cj4.TGjFnM4u.GVQXYGL0u6V5e.AY7/38It5P3O0/1FT0fhEdWTO.',7,NULL,1,'2019-07-22 14:08:26','usuario/adicionarSubSubMenu',NULL,'2019-07-21 17:51:58','2019-07-22 17:08:26');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-25 11:39:39
