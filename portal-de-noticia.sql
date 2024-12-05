-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/12/2024 às 03:58
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `portal-de-noticia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticia`
--

CREATE TABLE `noticia` (
  `id_noticia` int(11) NOT NULL,
  `titulo_noticia` varchar(32) NOT NULL,
  `descricao_noticia` varchar(254) NOT NULL,
  `arquivo` varchar(100) NOT NULL,
  `data` datetime NOT NULL,
  `status` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `noticia`
--

INSERT INTO `noticia` (`id_noticia`, `titulo_noticia`, `descricao_noticia`, `arquivo`, `data`, `status`) VALUES
(34, 'Anistia Internacional acusa Isra', 'A Anistia Internacional (AI) acusou Israel de genocÃ­dio contra os palestinos desde o inÃ­cio da guerra na Faixa de Gaza hÃ¡ 14 meses, em um relatÃ³rio publicado na noite desta quarta-feira (4), pelo horÃ¡rio de BrasÃ­lia. De acordo com a AI, o documento', '43497eec054c6e2ad558e529efaf485davif', '2024-12-04 23:36:54', 'pendente'),
(35, 'ONU abre processo contra eleiÃ§Ã', 'O ComitÃª de Direitos Humanos da ONU abriu um processo contra o governo da Venezuela para analisar a alegada fraude eleitoral nas eleiÃ§Ãµes de julho. O Ã³rgÃ£o solicitou que o paÃ­s preserve as atas das eleiÃ§Ãµes enquanto o caso Ã© analisado.\r\n\r\nA denÃ', '043f85f8124fded5c1c94eca454a214eavif', '2024-12-04 23:39:04', 'pendente'),
(36, 'Ed Sheeran serÃ¡ o primeiro arti', 'Ed Sheeran será o primeiro artista ocidental da histÃ³ria a se apresentar em ButÃ£o. O cantor e compositor farÃ¡ uma apresentaÃ§Ã£o no paÃ­s asiÃ¡tico em 24 de janeiro de 2025, no Changlimithang Stadium.\n\n\"Eu tenho ouvido ciosas maravilhosas sobre o B', '18bd2d3ff0803886029ba77d2444fc7bavif', '2024-12-04 23:40:17', 'aprovada'),
(37, 'Em meio a pressÃµes dos EUA, MÃ©', 'Autoridades mexicanas prenderam mais de 5.200 imigrantes na terÃ§a-feira (3), em uma grande operaÃ§Ã£o em todo o paÃ­s para impedir a chegada deles na fronteira com os Estados Unidos.\r\n\r\nO governo do MÃ©xico vem sofrendo pressÃµes dos Estados Unidos para', 'bd965fbf40543b3c7dd4235b98caec7aavif', '2024-12-04 23:42:29', 'pendente'),
(38, 'Por que crise no governo da Fran', 'A FranÃ§a vive mais um capÃ­tulo de turbulÃªncia polÃ­tica, nesta quarta-feira (4), com a queda do primeiro-ministro Michel Barnier.\r\n\r\nO Parlamento decidiu aprovar um voto de desconfianÃ§a a Barnier, que usou poderes especiais para aprovar, na segunda-f', '3e6194b63aabd7fa9a1703ae7b8af3ebavif', '2024-12-04 23:44:00', 'aprovada');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id_noticia`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
