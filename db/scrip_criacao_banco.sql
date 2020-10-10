SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `sistema_vendas` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sistema_vendas`;

DROP TABLE IF EXISTS `fornecedor`;
CREATE TABLE `fornecedor` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `fornecedor` (`id`, `nome`) VALUES
(1, 'Mor Casa e Lazer'),
(2, 'Soprano'),
(3, 'Pedroso'),
(4, 'Rafaeli');

DROP TABLE IF EXISTS `produto`;
CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `referencia` varchar(45) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `preco` decimal(10,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `produto` (`id`, `referencia`, `nome`, `preco`) VALUES
(1, '000001', 'Cadeira Alta', '14.5400'),
(2, '000002', 'Piscina 1000L', '54.0000'),
(5, '000003', 'Cadeira Infantil', '7.0000'),
(6, '000004', 'Escorredor', '5.0000'),
(7, '000005', 'Garrafa Térmica 1L', '32.2400'),
(8, '334721', 'Garrafa Térmica 250ml', '24.1580'),
(9, '043578', 'Garrafa Térmica 500ml', '28.3600'),
(10, '002002', 'Televisão', '1423.9900'),
(11, '957124', 'Smartphone', '984.9900'),
(12, '346518', 'Sofá 3 lugares modular', '1428.0000');

DROP TABLE IF EXISTS `produto_fornecedor`;
CREATE TABLE `produto_fornecedor` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `fornecedor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `produto_fornecedor` (`id`, `produto_id`, `fornecedor_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 5, 3),
(5, 11, 3),
(6, 12, 3),
(7, 12, 4),
(8, 10, 1),
(9, 6, 4),
(10, 9, 2),
(11, 7, 4),
(12, 8, 3);

DROP TABLE IF EXISTS `venda`;
CREATE TABLE `venda` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `venda_produto`;
CREATE TABLE `venda_produto` (
  `id` int(11) NOT NULL,
  `venda_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `preco_unit` decimal(10,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `produto_fornecedor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produto_fornecedor_produto1` (`produto_id`),
  ADD KEY `fk_produto_fornecedor_fornecedor1` (`fornecedor_id`);

ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `venda_produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_venda_produto_venda` (`venda_id`),
  ADD KEY `fk_venda_produto_produto1` (`produto_id`);


ALTER TABLE `fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `produto_fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `venda_produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `produto_fornecedor`
  ADD CONSTRAINT `fk_produto_fornecedor_fornecedor1` FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produto_fornecedor_produto1` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `venda_produto`
  ADD CONSTRAINT `fk_venda_produto_produto1` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venda_produto_venda` FOREIGN KEY (`venda_id`) REFERENCES `venda` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
