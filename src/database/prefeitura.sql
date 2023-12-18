-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/12/2023 às 02:12
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
(7, 'Rosane de Melo Viana', '1976-08-12', '312.424.424-00', 'Feminino', 'Novo Hamburgo', 'Lomba Grande', 'Rua 1', 1212, 'Casa'),
(10, 'matheus borba', '2004-07-22', '555.555.555-55', 'Masculino', 'São Leopoldo ', 'Cristo rei', 'rua tal', 0, 'casa'),
(13, 'Rodrigo', '2023-06-28', '123.123.123-88', 'Masculino', 'Sao leopoldo', 'Cristo rei ', 'Jose algusto', 12, 'Apartamento'),
(14, 'Manuela', '2005-02-04', '333.333.333-00', 'Feminino', 'Sao leopoldo', '', '', 0, ''),
(64, 'João Pedro de Melo Viana', '2005-01-08', '031.051.309-00', 'Masculino', 'Novo Hamburgo', 'Lomba Grande', 'Rua x', 21, 'Casa');

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
(60, 'Processo do João Pedro', '2023-12-18', 3, 64),
(61, 'Processo da Manuela', '2023-12-18', 45, 14),
(62, 'Processo do Matheus ', '2023-12-18', 23, 10),
(63, 'Processo do Pedro', '2023-12-18', 7, 4),
(64, 'Processo do Rodrigo', '2023-12-18', 12, 13);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES
(20, 'João Pedro', 'jpmeloviana738@gmail.com', '$2y$10$IS1le3kJvdNm5lk7aj9j1.P4OQfmGWmN292sxrbLntNnf76ZcPIAC'),
(21, 'Rosane de Melo', 'saneviana204@gmail.com', '$2y$10$p5stzbUk5mT4WRWq7mRBsetJNjS5EpiQSHeUDQXHTeiAexIxJBWdG');

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
  ADD PRIMARY KEY (`numero`),
  ADD KEY `fk_id_contribuinte` (`id_pessoa`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de tabela `processos`
--
ALTER TABLE `processos`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `processos`
--
ALTER TABLE `processos`
  ADD CONSTRAINT `fk_id_contribuinte` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
