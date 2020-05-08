-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Maio-2020 às 14:55
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `euklides`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `cod_aluno` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `senha` varchar(40) DEFAULT NULL,
  `sala_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`cod_aluno`, `nome`, `email`, `senha`, `sala_id`) VALUES
(14, 'aluno', 'aluno@', '202cb962ac59075b964b07152d234b70', 54);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogada`
--

CREATE TABLE `jogada` (
  `cod_jogada` int(11) NOT NULL,
  `tempo_gasto` int(11) DEFAULT NULL,
  `num_dicas` int(11) DEFAULT NULL,
  `num_acertos` int(11) DEFAULT NULL,
  `num_erros` int(11) DEFAULT NULL,
  `level` varchar(30) DEFAULT NULL,
  `aluno_id` int(11) NOT NULL,
  `sala_id` int(11) NOT NULL,
  `jogo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `jogada`
--

INSERT INTO `jogada` (`cod_jogada`, `tempo_gasto`, `num_dicas`, `num_acertos`, `num_erros`, `level`, `aluno_id`, `sala_id`, `jogo_id`) VALUES
(2, 10, 1, 1, 1, 'Tema 1', 14, 54, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogo`
--

CREATE TABLE `jogo` (
  `cod_jogo` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `jogo`
--

INSERT INTO `jogo` (`cod_jogo`, `nome`) VALUES
(1, 'Quiz Game'),
(2, 'Teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `cod_professor` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `senha` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`cod_professor`, `nome`, `email`, `senha`) VALUES
(34, 'professor', 'professor@', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Estrutura da tabela `recuperacao`
--

CREATE TABLE `recuperacao` (
  `utilizador` varchar(255) NOT NULL,
  `confirmacao` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `recuperacao`
--

INSERT INTO `recuperacao` (`utilizador`, `confirmacao`) VALUES
('thamyla.sl@gmail.com', '70b5d02c1b3f91781a7e89eb7021f8a5904f14de'),
('thamyla.sl@gmail.com', '7960a2a8fb8669ae1a6ffce83552b32efa6dd5c0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sala`
--

CREATE TABLE `sala` (
  `cod_sala` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `descricao` varchar(150) DEFAULT NULL,
  `disciplina` varchar(30) NOT NULL,
  `professor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `sala`
--

INSERT INTO `sala` (`cod_sala`, `nome`, `descricao`, `disciplina`, `professor_id`) VALUES
(54, 'Sala1', 'Conceitos de if e else', 'Algoritmos', 34);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sala_jogo`
--

CREATE TABLE `sala_jogo` (
  `cod_sala_jogo` int(11) NOT NULL,
  `sala_id` int(11) NOT NULL,
  `jogo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `sala_jogo`
--

INSERT INTO `sala_jogo` (`cod_sala_jogo`, `sala_id`, `jogo_id`) VALUES
(5, 54, 1),
(6, 54, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`cod_aluno`),
  ADD KEY `fk_sala` (`sala_id`);

--
-- Índices para tabela `jogada`
--
ALTER TABLE `jogada`
  ADD PRIMARY KEY (`cod_jogada`),
  ADD KEY `fk_jogada_sala` (`sala_id`),
  ADD KEY `fk_jogada_jogo` (`jogo_id`),
  ADD KEY `fk_jogada_aluno` (`aluno_id`);

--
-- Índices para tabela `jogo`
--
ALTER TABLE `jogo`
  ADD PRIMARY KEY (`cod_jogo`);

--
-- Índices para tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`cod_professor`);

--
-- Índices para tabela `recuperacao`
--
ALTER TABLE `recuperacao`
  ADD KEY `utilizador` (`utilizador`,`confirmacao`);

--
-- Índices para tabela `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`cod_sala`) USING BTREE,
  ADD KEY `fk_professor` (`professor_id`);

--
-- Índices para tabela `sala_jogo`
--
ALTER TABLE `sala_jogo`
  ADD PRIMARY KEY (`cod_sala_jogo`),
  ADD KEY `fk_sala_jogo` (`jogo_id`),
  ADD KEY `fk_jogo_sala` (`sala_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `cod_aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `jogada`
--
ALTER TABLE `jogada`
  MODIFY `cod_jogada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `jogo`
--
ALTER TABLE `jogo`
  MODIFY `cod_jogo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `cod_professor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `sala`
--
ALTER TABLE `sala`
  MODIFY `cod_sala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de tabela `sala_jogo`
--
ALTER TABLE `sala_jogo`
  MODIFY `cod_sala_jogo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `fk_sala` FOREIGN KEY (`sala_id`) REFERENCES `sala` (`cod_sala`);

--
-- Limitadores para a tabela `jogada`
--
ALTER TABLE `jogada`
  ADD CONSTRAINT `fk_jogada_aluno` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`cod_aluno`),
  ADD CONSTRAINT `fk_jogada_jogo` FOREIGN KEY (`jogo_id`) REFERENCES `jogo` (`cod_jogo`),
  ADD CONSTRAINT `fk_jogada_sala` FOREIGN KEY (`sala_id`) REFERENCES `sala` (`cod_sala`);

--
-- Limitadores para a tabela `sala`
--
ALTER TABLE `sala`
  ADD CONSTRAINT `fk_professor` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`cod_professor`);

--
-- Limitadores para a tabela `sala_jogo`
--
ALTER TABLE `sala_jogo`
  ADD CONSTRAINT `fk_jogo_sala` FOREIGN KEY (`sala_id`) REFERENCES `sala` (`cod_sala`),
  ADD CONSTRAINT `fk_sala_jogo` FOREIGN KEY (`jogo_id`) REFERENCES `jogo` (`cod_jogo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
