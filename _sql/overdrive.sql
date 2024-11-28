-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/11/2024 às 16:27
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
-- Banco de dados: `overdrive`
--
CREATE DATABASE IF NOT EXISTS `overdrive` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `overdrive`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresas`
--

CREATE TABLE `empresas` (
  `id_emp` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `fantasia` varchar(255) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `responsavel` varchar(255) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `registro` date DEFAULT NULL,
  `id_endereco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `empresas`
--

INSERT INTO `empresas` (`id_emp`, `nome`, `fantasia`, `cnpj`, `telefone`, `responsavel`, `foto`, `registro`, `id_endereco`) VALUES
(1, 'INATIVO', 'INATIVO', '00.000.000/0000-00', '', '', '', '2024-11-12', 1),
(2, 'HONDA AUTOMOVEIS DO BRASIL LTDA', 'HONDA', '01.192.333/0001-22', '(11) 1111-1111', 'CLEBER', '', '2024-11-13', 17),
(3, 'HYUNDAI MOTOR BRASIL MONTADORA DE AUTOMOVEIS LTDA', 'HYUNDAI', '10.394.422/0001-42', '(19) 3843-2613', 'JOãO', '', '2024-11-14', 8),
(4, 'SUZUKI MOTOS ADMINISTRADORA DE CONSORCIO LTDA', 'SUZUKI', '57.723.801/0001-00', '(55) 55555-5555', 'CONRADO', '', '2024-11-15', 9),
(5, 'FERRARI & FERRARI LTDA', 'FERRARI', '08.528.035/0001-00', '(22) 22222-2222', 'ALPHONSE', '', '2024-11-17', 10),
(6, 'TOYOTA DO BRASIL LTDA', 'TOYOTA', '59.104.760/0001-91', '(11) 11111-1111', 'VITOR', '', '2024-11-18', 11),
(7, 'STELLANTIS AUTOMOVEIS BRASIL LTDA.', 'FIAT', '16.701.716/0001-56', '(77) 47474-7474', 'CESAR', '', '2024-11-19', 12),
(8, 'GENERAL MOTORS DO BRASIL LTDA', 'CHEVROLET', '59.275.792/0001-50', '(84) 84848-4848', 'SAMUEL', '', '2024-11-24', 13),
(9, 'VOLKSWAGEN DO BRASIL INDUSTRIA DE VEICULOS AUTOMOTORES LTDA', 'VOLKSWAGEN', '59.104.422/0001-50', '(62) 63626-2626', 'TOMAS', '', '2024-11-26', 14),
(10, 'PEUGEOT-CITROEN DO BRASIL AUTOMOVEIS LTDA', 'CITROEN', '67.405.936/0001-73', '(19) 3843-2613', 'JONAS', '', '2024-11-27', 15),
(11, 'APPLE COMPUTER BRASIL LTDA', 'APPLE', '00.623.904/0001-73', '(11) 11111-1111', 'STEVE JOBS', '', '2024-11-27', 18),
(12, 'LOJAS AMERICANAS S.A.', 'LOJAS AMERICANAS', '33.014.556/0001-96', '(88) 88888-8888', 'MARIA', '', '2024-11-27', 19);

-- --------------------------------------------------------

--
-- Estrutura para tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `id_end` int(11) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `numero` varchar(6) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` char(2) NOT NULL,
  `bairro` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `enderecos`
--

INSERT INTO `enderecos` (`id_end`, `cep`, `numero`, `rua`, `cidade`, `estado`, `bairro`) VALUES
(1, '13973-274', '44', 'RUA HORTÊNCIO CANELA', 'ITAPIRA', 'SP', 'PARQUE FELICIDADE II'),
(2, '13973-275', '122', 'RUA JORGE DANIEL DA COSTA', 'ITAPIRA', 'SP', 'PARQUE DA FELICIDADE II'),
(3, '37590-971', '85', 'RUA CINCO', 'JACUTINGA', 'MG', 'CENTRO'),
(4, '13604-408', '66', 'RUA 05', 'ARARAS', 'SP', 'JARDIM DO LAGO'),
(5, '13604-380', '233', 'RUA 1', 'ARARAS', 'SP', 'CHáCARAS DE RECREIO COLINA VERDE'),
(6, '13605-305', 'S/N', 'RUA 14 BIS', 'ARARAS', 'SP', 'CHáCARAS GRANJA SãO FRANCISCO'),
(7, '13181-903', '777', 'ESTRADA MUNICIPAL VALêNCIO CALEGARI', 'SUMARé', 'SP', 'PARQUE SANTO ANTôNIO (NOVA VENEZA)'),
(8, '13413-900', '777', 'AVENIDA HYUNDAI', 'PIRACICABA', 'SP', 'ÁGUA SANTA'),
(9, '13209-430', '4950', 'AVENIDA PREFEITO LUíS LATORRE', 'JUNDIAí', 'SP', 'VILA DAS HORTêNCIAS'),
(10, '99435-000', '1312', 'AVENIDA PREFEITO LUíS LATORRE', 'CAMPOS BORGES', 'RS', 'VILA DAS HORTêNCIAS'),
(11, '09895-510', '1024', 'RUA MAX MANGELS SêNIOR', 'SãO BERNARDO DO CAMPO', 'SP', 'PLANALTO'),
(12, '32669-900', '3455', 'AVENIDA CONTORNO', 'BETIM', 'MG', 'DISTRITO INDUSTRIAL PAULO CAMILO SUL'),
(13, '09550-050', '1805', 'AVENIDA GOIáS', 'SãO CAETANO DO SUL', 'SP', 'BARCELONA'),
(14, '09823-901', 'S/N', 'VIA ANCHIETA', 'SãO BERNARDO DO CAMPO', 'SP', 'DEMARCHI'),
(15, '27570-000', '6901', 'AVENIDA HYUNDAI', 'PORTO REAL', 'RJ', 'ÁGUA SANTA'),
(16, '13973-274', '855', 'RUA HORTêNCIO CANELA', 'ITAPIRA', 'SP', 'PARQUE DA FELICIDADE II'),
(17, '13181-903', '777', 'EST MUNICIPAL VALENCIO CALEGARI', 'SUMARE', 'SP', 'NOVA VENEZA'),
(18, '04542-000', '700', 'R LEOPOLDO COUTO MAGALHAES JUNIOR', 'SAO PAULO', 'SP', 'ITAIM BIBI'),
(19, '20081-902', '102', 'RUA SACADURA CABRAL', 'RIO DE JANEIRO', 'RJ', 'SAUDE');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `cnh` varchar(11) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `carro` varchar(255) NOT NULL,
  `cargo` char(1) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `registro` date DEFAULT NULL,
  `id_endereco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `nome`, `cpf`, `cnh`, `telefone`, `carro`, `cargo`, `id_empresa`, `senha`, `foto`, `registro`, `id_endereco`) VALUES
(1, 'FELIPE GODOY', '111.111.111-11', '123456789', '(19) 9999-9999', 'PORSCHE', 'A', 1, '$2y$10$UGNH9ZekQ4lKUTLOoKm1O.mpZEcjW1LiGSJ2aILdHHGaRAGX.X/Oa', '', '2024-11-19', 6),
(2, 'DIEGO NEGRETTO', '222.222.222-22', '123456788', '(99) 99999-9999', 'UNO COM ESCADA', 'C', 1, '$2y$10$UGNH9ZekQ4lKUTLOoKm1O.mpZEcjW1LiGSJ2aILdHHGaRAGX.X/Oa', '', '2024-11-21', 2),
(3, 'JOÃO SILVA', '123.456.789-10', '12345678910', '(11) 91234-5678', 'GOL', 'C', 3, 'SENHA123', '', '2022-01-01', 1),
(4, 'MARIA SOUZA', '987.654.321-20', '98765432120', '(11) 98765-4321', 'CIVIC', 'C', 8, 'SENHA456', '', '2022-01-02', 2),
(5, 'PEDRO OLIVEIRA', '741.852.963-30', '74185296330', '(11) 97418-5296', 'COROLLA', 'C', 4, 'SENHA789', '', '2022-01-03', 3),
(6, 'ANA COSTA', '369.258.147-40', '36925814740', '(11) 93692-5814', 'FUSION', 'C', 2, 'SENHA101', '', '2022-01-04', 4),
(7, 'LUIZ SANTANA', '852.963.741-50', '85296374150', '(11) 98529-6374', 'FOCUS', 'C', 9, 'SENHA202', '', '2022-01-05', 5),
(8, 'CARLA PEREIRA', '258.147.369-60', '25814736960', '(11) 92581-4736', 'ASTRA', 'C', 5, 'SENHA303', '', '2022-01-06', 6),
(9, 'RAFAEL MARTINS', '456.789.123-70', '45678912370', '(11) 94567-8912', 'CRUZE', 'C', 3, 'SENHA404', '', '2022-01-07', 1),
(10, 'GABRIELA LIMA', '963.741.852-80', '96374185280', '(11) 99637-4185', 'PRISMA', 'C', 7, 'SENHA505', '', '2022-01-08', 2),
(11, 'DANIEL MENDES', '147.369.258-90', '14736925890', '(11) 91473-6925', 'S10', 'C', 7, 'SENHA606', '', '2022-01-09', 3),
(12, 'JULIANA CASTRO', '852.963.147-00', '85296314700', '(11) 98529-6314', 'SPIN', 'C', 7, 'SENHA707', '', '2022-01-10', 4),
(13, 'PATRICIA RIBEIRO', '741.852.963-31', '74185296331', '(11) 97418-5297', 'HRV', 'C', 6, 'SENHA808', '', '2022-01-11', 5),
(14, 'MARCOS LIMA', '852.963.741-51', '85296374151', '(11) 98529-6375', 'ARGO', 'C', 8, 'SENHA909', '', '2022-01-12', 6),
(15, 'LUCIANA SILVA', '963.741.852-81', '96374185281', '(11) 99637-4186', 'ONIX', 'C', 3, 'SENHA1010', '', '2022-01-13', 1),
(16, 'FABIO SANTOS', '147.369.258-91', '14736925891', '(11) 91473-6926', 'LOGAN', 'C', 4, 'SENHA1111', '', '2022-01-14', 2),
(17, 'CLAUDIA FERREIRA', '258.147.369-61', '25814736961', '(11) 92581-4737', 'SENTRA', 'C', 7, 'SENHA1212', '', '2022-01-15', 3),
(18, 'RODRIGO ALMEIDA', '369.258.147-41', '36925814741', '(11) 93692-5815', 'JETTA', 'C', 1, 'SENHA1313', '', '2022-01-16', 4),
(19, 'SANDRA OLIVEIRA', '456.789.123-71', '45678912371', '(11) 94567-8913', 'GOLF', 'C', 3, 'SENHA1414', '', '2022-01-17', 5),
(20, 'PAULO HENRIQUE', '987.654.321-21', '98765432121', '(11) 98765-4322', 'PASSAT', 'C', 1, 'SENHA1515', '', '2022-01-18', 6),
(21, 'MIRELA RODRIGUES', '123.456.789-11', '12345678911', '(11) 91234-5679', 'CIVIC SI', 'C', 1, 'SENHA1616', '', '2022-01-19', 1),
(22, 'GUSTAVO GOMES', '741.852.963-32', '74185296332', '(11) 97418-5298', 'COROLLA XEI', 'C', 8, 'SENHA1717', '', '2022-01-20', 2),
(23, 'JONAS DUZO', '123.456.789-00', '111222222', '(19) 3843-2613', 'MERCEDES-BENZ', 'C', 7, '$2y$10$KQVz/tWLwGG6CrZK2t/7f.E4dhQXIlWs6pFThXrmhQdJyb8GqVt3e', '', '2024-11-27', 16),
(24, 'JUNIOR', '848.848.848-84', '545402121', '555555555555555', 'MERCEDES-BENZ', 'C', 1, '$2y$10$7uCNfoqjB2qSmq.KHsx4xeMjX11BWUkm0hFj.hFu/n0foxHQhIMBq', '', '2024-11-27', 16);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_emp`),
  ADD UNIQUE KEY `id` (`id_emp`),
  ADD UNIQUE KEY `cnpj` (`cnpj`),
  ADD UNIQUE KEY `fantasia` (`fantasia`),
  ADD KEY `id_endereco` (`id_endereco`);

--
-- Índices de tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`id_end`),
  ADD UNIQUE KEY `id` (`id_end`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `id` (`id_user`),
  ADD UNIQUE KEY `cpf` (`cpf`,`cnh`),
  ADD KEY `id_empresa` (`id_empresa`),
  ADD KEY `id_endereco` (`id_endereco`) USING BTREE;

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_emp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id_end` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `empresas_ibfk_1` FOREIGN KEY (`id_endereco`) REFERENCES `enderecos` (`id_end`);

--
-- Restrições para tabelas `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_endereco`) REFERENCES `enderecos` (`id_end`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_emp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
