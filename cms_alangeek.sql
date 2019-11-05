-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06-Nov-2019 às 00:47
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_alangeek`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admins`
--

CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `aname` varchar(30) NOT NULL,
  `aheadline` varchar(30) NOT NULL,
  `abio` varchar(500) NOT NULL,
  `aimage` varchar(60) NOT NULL DEFAULT 'avatar.png',
  `addedby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `admins`
--

INSERT INTO `admins` (`id`, `datetime`, `username`, `password`, `aname`, `aheadline`, `abio`, `aimage`, `addedby`) VALUES
(1, '19-October-2019 23:54:49', 'alan', '1234', 'alan christian pereira', 'Freealancer, Engeener', 'Sou Programador FullStack', '36712437_1690859030991805_6469166542524252160_n.jpg', 'AlanGeek'),
(2, '03-November-2019 16:07:11', 'lulu', '12345', 'luci', '', '', 'avatar.png', 'alan');

-- --------------------------------------------------------

--
-- Estrutura da tabela `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `datetime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `category`
--

INSERT INTO `category` (`id`, `title`, `author`, `datetime`) VALUES
(1, 'Tecnologia', 'AlanGeek', '20-September-2019 21:43:43'),
(2, 'PHP', 'AlanGeek', '20-September-2019 21:59:11'),
(3, 'programador', 'AlanGeek', '20-September-2019 22:02:06'),
(5, 'News', 'AlanGeek', '20-September-2019 22:13:08'),
(7, 'Cinema', 'AlanGeek', '20-September-2019 22:16:02'),
(10, 'Fitness', 'AlanGeek', '20-September-2019 22:25:30'),
(14, 'NodeJS', 'alan', '24-October-2019 15:28:27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `approvedby` varchar(50) NOT NULL,
  `status` varchar(3) NOT NULL,
  `post_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `comments`
--

INSERT INTO `comments` (`id`, `datetime`, `name`, `email`, `comment`, `approvedby`, `status`, `post_id`) VALUES
(6, '18-October-2019 19:49:13', 'Carlos', 'carlos@hotmail.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of ', 'alan christian', 'OFF', 9),
(8, '25-October-2019 15:50:25', 'alan', 'alan@hotmail.com', 'show de bola', 'alan christian', 'ON', 10),
(9, '25-October-2019 16:48:52', 'jubileu', 'jubilues@hotmail.com', 'muito booooooooooom', 'alan christian', 'ON', 9),
(12, '25-October-2019 18:13:16', 'alangeek', 'alan@hotmail.com', 'njÃ§jkÃ§', 'alan christian', 'ON', 9),
(16, '26-October-2019 20:50:47', 'Alan', 'alan@hotmail.com', 'Fazendo teste de comentÃ¡rios', 'alan christian', 'ON', 9),
(17, '01-November-2019 19:50:43', 'Alan', 'alanlindo@hotmail.com', 'Me conte mais gostei desse conteudo :D', 'alan christian', 'ON', 11),
(18, '01-November-2019 20:02:50', 'Alan', 'alanlindo@hotmail.com', 'Amor Ã© Love You...', 'alan christian', 'OFF', 11),
(19, '03-November-2019 13:19:45', 'ALAN BRWON', 'brawn@hotmail.com', 'Interessante materia', 'Pending', 'OFF', 15),
(20, '03-November-2019 13:20:52', 'paÃ§oca', 'amendoin@hotmail.com', 'Nossa nÃ£o quero mais perder mais nenhum conteÃºdo', 'Pending', 'OFF', 14),
(21, '05/11/2019 20:41:40', 'teste', 'testee@hotmail.com', '<h1>OlÃ¡ teste</h1>', '', 'ON', 18),
(22, '05/11/2019 20:46:25', 'cssteste', 'testee@hotmail.com', '<h1 style=\"background-color:red;widht:200%;height:500px;\">Cachorro quente</h1>', '', 'ON', 18),
(23, '05/11/2019 20:49:15', 'outrotest', 'testee@hotmail.com', '<h1>caracas</h1>', '', 'ON', 18),
(24, '05/11/2019 20:52:07', 'cssteste', 'testee@hotmail.com', '<h1>,mvjklh</h1>', '', 'ON', 18);

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `title` varchar(300) NOT NULL,
  `category` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `post` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `datetime`, `title`, `category`, `author`, `image`, `post`) VALUES
(9, '27-September-2019 17:37:14', 'Gambiarra', 'programador', 'AlanGeek', 'banner1.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum'),
(10, '18-October-2019 20:03:36', 'Velocidade todo Estante', 'Esporte', 'AlanGeek', 'banner.jpg', 'Os Carros Mais veloz numero do brasil corre pra caramba'),
(11, '31-October-2019 23:47:37', 'Efeito Borboleta', 'News', 'alan', '0_xZZuWFn-Eut9lcjZ.jpg', 'Efeito Borboleta Na ProgramaÃ§Ã£o '),
(12, '01-November-2019 22:25:03', 'Engenharia Reversa', 'programador', 'alan', '1_cUOknyEHrQ6wGqynmp__Eg.jpeg', 'O que Ã© Engenharia Reversa na ProgramÃ§aÃµ'),
(13, '01-November-2019 22:25:59', 'RAP Ã© Sucesso', 'News', 'alan', 'adult-audio-black-1762578.jpg', 'Rap venm Contagiando o pessoal mais jovem'),
(14, '01-November-2019 22:30:48', 'O Futuro da IA', 'Tecnologia', 'alan', 'asoo.jpg', 'Inteligencia artificial Ã¨ o futuro diz especialista do PHP'),
(15, '01-November-2019 22:33:06', 'Simdrome Do Impostor', 'News', 'alan', '1_H3jokXWR3VMNV8slFx51Ug.jpeg', 'Design Patterns Ã© para amadores'),
(16, '04-November-2019 20:30:18', 'PHP Morreu ?', 'PHP', 'alan', 'apple-desk-desktop-38568.jpg', 'SerÃ¡ que relamente PHP morreu ?'),
(17, '04-November-2019 20:32:33', 'Qualidade de software', 'News', 'alan', 'arts-build-close-up-273230.jpg', 'Os Melhores  sistema altuamente....'),
(18, '04-November-2019 20:36:54', 'Teste de Unitarios', 'programador', 'alan', '1_cUOknyEHrQ6wGqynmp__Eg.jpeg', 'Por que Ã© importante programaar com testes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Foreign_Relation` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
