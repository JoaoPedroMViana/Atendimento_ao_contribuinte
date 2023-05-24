-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/05/2023 às 22:39
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `prefeitura`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `sexo` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `complemento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pessoas`
--

INSERT INTO `pessoas` (`id`, `nome`, `data_nascimento`, `cpf`, `sexo`, `cidade`, `bairro`, `rua`, `numero`, `complemento`) VALUES
(4, 'Pedro de Amaral', '2023-05-12', '999.999.999-99', 'Masculino', 'Novo Hamburgo', 'nao sei', 'nao sei', 999, 'Apartamento'),
(5, 'Manuela', '2023-05-08', '312.424.424-00', 'Feminino', '', '', '', 0, ''),
(6, 'João Pedro', '2023-05-06', '071.061.400-08', 'Masculino', 'Travessa Afonso Strack', '', '', 0, ''),
(7, 'Rosane de Melo Viana', '1976-08-12', '312.424.424-00', 'Feminino', 'Novo Hamburgo', 'Lomba Grande', 'Rua 1', 1212, 'Casa'),
(8, 'Pessoa 1', '2023-05-05', '123.123.123-09', 'Outro', 'São Leopoldo ', '', '', 0, ''),
(9, 'alexsandro da rocha', '1974-11-22', '343.343.333-99', 'Masculino', 'Novo Hamburgo', '', '', 0, ''),
(10, 'matheus borba', '2004-07-22', '555.555.555-55', 'Masculino', 'São Leopoldo ', 'Cristo rei', 'rua tal', 0, 'casa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `processos`
--

CREATE TABLE `processos` (
  `numero` int(11) NOT NULL,
  `descricao` longtext NOT NULL,
  `data_de_registro` date NOT NULL,
  `prazo` int(11) NOT NULL,
  `id_pessoa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `processos`
--

INSERT INTO `processos` (`numero`, `descricao`, `data_de_registro`, `prazo`, `id_pessoa`) VALUES
(8, 'nova descricao', '2023-05-24', 4, 4),
(9, 'processo manu', '2023-05-24', 7, 5),
(10, 'decricao joao pedro', '2023-05-24', 8, 6),
(11, 'processo borba', '2023-05-24', 44, 10),
(12, 'descricao Dalessandro', '2023-05-24', 12, 12),
(13, 'outro processo do João ', '2023-05-24', 4, 6);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `processos`
--
ALTER TABLE `processos`
  ADD PRIMARY KEY (`numero`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `processos`
--
ALTER TABLE `processos`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
