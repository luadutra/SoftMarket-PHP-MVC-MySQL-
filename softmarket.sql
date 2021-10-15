-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.31 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para softmarket
CREATE DATABASE IF NOT EXISTS `softmarket` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `softmarket`;

-- Copiando estrutura para tabela softmarket.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipos_produtos` int(11) NOT NULL,
  `nome` char(255) NOT NULL DEFAULT '',
  `descricao` text NOT NULL,
  `preco` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=108 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela softmarket.produtos: 5 rows
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` (`id`, `id_tipos_produtos`, `nome`, `descricao`, `preco`) VALUES
	(1, 1, 'Óleo de Soja Soya', 'Óleo de Soja Soya 1L', 6.89),
	(2, 2, 'Arroz Branco Camil 5kg', 'Arroz Branco Camil Tipo 1 5kg', 16.99),
	(3, 3, 'Pepsi 2L', 'Refrigerante Pepsi 2L', 4.50),
	(4, 4, 'Feijão Preto Camil 1kg', 'Feijão Preto Camil Tipo 1 1kg', 5.79),
	(5, 5, 'Macarrão Parafuso Isabela 500g', 'Macarrão Parafuso Isabela 500g', 3.50);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;

-- Copiando estrutura para tabela softmarket.tipos_produtos
CREATE TABLE IF NOT EXISTS `tipos_produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` char(255) NOT NULL DEFAULT '',
  `imposto` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela softmarket.tipos_produtos: 5 rows
/*!40000 ALTER TABLE `tipos_produtos` DISABLE KEYS */;
INSERT INTO `tipos_produtos` (`id`, `nome`, `imposto`) VALUES
	(1, 'Óleo de Soja', 21.00),
	(2, 'Arroz', 17.33),
	(3, 'Refrigerante', 19.00),
	(4, 'Feijão', 14.00),
	(5, 'Macarrão', 8.00);
/*!40000 ALTER TABLE `tipos_produtos` ENABLE KEYS */;

-- Copiando estrutura para tabela softmarket.vendas
CREATE TABLE IF NOT EXISTS `vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_venda` char(100) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_sem_imposto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `valor_impostos` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_com_imposto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `data_venda` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela softmarket.vendas: 0 rows
/*!40000 ALTER TABLE `vendas` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
