-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13/10/2023 às 18:24
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
-- Banco de dados: `lab_plasticos`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `classe_material`
--

CREATE TABLE `classe_material` (
  `idClasse` int(11) NOT NULL COMMENT 'PK - chave identificadora que guarda a id de cada classe da matéria prima',
  `descricao` varchar(32) NOT NULL COMMENT 'Descrição da classe da matéria prima(comodities, engenharia)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Registro da classe associada a uma matéria prima';

--
-- Despejando dados para a tabela `classe_material`
--

INSERT INTO `classe_material` (`idClasse`, `descricao`) VALUES
(1, 'Comodities'),
(2, 'Engenharia');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ferramental_maquna`
--

CREATE TABLE `ferramental_maquna` (
  `idFerramental` int(11) NOT NULL COMMENT 'PK/FK - Chave composta que relaciona um molde com uma maquina',
  `idMaquina` int(11) NOT NULL COMMENT 'PK/FK - Chave composta que relaciona uma maquina com um molde'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela associativa que relaciona ferramental com maquinas';

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `idFornecedor` int(11) NOT NULL COMMENT 'PK - chave identificadora das ids de cada fornecedor',
  `descricao` varchar(50) NOT NULL COMMENT 'Descrição de cada fornecedor(Nome);'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Registro dos fornecedores de materiais do laboratório';

-- --------------------------------------------------------

--
-- Estrutura para tabela `maquinas`
--

CREATE TABLE `maquinas` (
  `idMaquina` int(11) NOT NULL COMMENT 'PK - chave identificadora das maquinas usadas para fazer os produtos',
  `decricao` varchar(50) NOT NULL COMMENT 'descrição da maquina registrada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela para registro das maquinas a serem usadas na receita';

-- --------------------------------------------------------

--
-- Estrutura para tabela `materia_fornecedor`
--

CREATE TABLE `materia_fornecedor` (
  `idMateriaPrima` int(11) NOT NULL COMMENT 'PK/FK - chave composta que relaciona uma matéria prima com um fornecedor.',
  `idFornecedor` int(11) NOT NULL COMMENT 'PK/FK - chave composta que relaciona um fornecedor com uma matéria prima.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Registro da relação de uma matéria prima com um fornecedor';

-- --------------------------------------------------------

--
-- Estrutura para tabela `materia_pigmento`
--

CREATE TABLE `materia_pigmento` (
  `idMateriaPrima` int(11) NOT NULL,
  `idPigmento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `materia_prima`
--

CREATE TABLE `materia_prima` (
  `idMateriaPrima` int(11) NOT NULL COMMENT 'PK - chave identificadora das matérias primas salvas no estoque ',
  `idClasse` int(11) NOT NULL COMMENT 'FK - chave estrangeira que identifica a classe da matéria prima(comodities e engenharia) ',
  `idTipoMateriaPrima` int(11) NOT NULL COMMENT 'FK - chave estrangeira que identifica o tipo de matéria prima(virgem, reciclado, remoido, scrap). ',
  `descricao` varchar(50) NOT NULL COMMENT 'Descrição da matéria prima(Nome). ',
  `quantidade` int(11) NOT NULL COMMENT 'Mostra a quantidade de uma matéria prima guardada no estoque'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Salva os registros de Cadastros e alterações no estoque';

--
-- Despejando dados para a tabela `materia_prima`
--

INSERT INTO `materia_prima` (`idMateriaPrima`, `idClasse`, `idTipoMateriaPrima`, `descricao`, `quantidade`) VALUES
(1, 1, 2, 'plastico', 500),
(2, 1, 1, 'Polistileno', 300),
(3, 2, 4, 'Polioneto de carbonato', 400),
(4, 1, 3, 'Sódio', 200),
(5, 2, 1, 'Polistileno', 100),
(6, 2, 3, 'Exopor', 50),
(7, 1, 1, 'Java', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL COMMENT 'PK - chave identificadora da tabela Pedidos.',
  `idProduto` int(11) NOT NULL COMMENT 'FK - Chave estrangeira para identificar qual o produto relacionado ao pedido',
  `idUsuario` int(11) NOT NULL COMMENT 'FK - Chave estrangeira para identificar qual o usuário abriu o pedido',
  `DataHora_aberto` datetime NOT NULL COMMENT 'Salva a data e a hora em que o pedido foi aberto',
  `DataHora_fechado` datetime NOT NULL COMMENT 'Salva a data e a hora em que o pedido foi fechado',
  `Status` tinyint(1) NOT NULL COMMENT 'Identifica se um pedido está em aberto ou se ja foi fechado:\r\naberto(1);\r\nfechado(2)',
  `Observacoes` varchar(80) DEFAULT NULL COMMENT 'Permite gravar observações sobre um pedido. Ex: \r\npedido feito programou 500g de matéria prima para fazer 500 copos mas acabou fazendo apenas 490 copos.',
  `quantidade` int(11) NOT NULL COMMENT 'Mostra a quantidade de um produto a ser feito no pedido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela que registra os pedidos feito pelo usuário';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pigmentos`
--

CREATE TABLE `pigmentos` (
  `idPigmento` int(11) NOT NULL COMMENT 'PK - codigo identificador do pigmento',
  `descricao` varchar(80) NOT NULL COMMENT 'descricao do pigmento',
  `idTipoPigmento` int(11) NOT NULL COMMENT 'FK - tipo de pigmento',
  `quantidade` int(11) NOT NULL COMMENT 'Mostra a quantidade de material de pigmento guardado no estoque'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pigmento_fornecedor`
--

CREATE TABLE `pigmento_fornecedor` (
  `idPigmentos` int(11) NOT NULL COMMENT 'PK/FK chave composta que relaciona uma id da tabela pigmentos com uma id da tabela fornecedores',
  `idFornecedor` int(11) NOT NULL COMMENT 'PK/FK chave composta que relaciona uma id da tabela fornecedores com uma id da tabela pigmentos '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Registro da relação entre um fornecedor e um pigmento';

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `idProduto` int(11) NOT NULL COMMENT 'PK - chave identificadora da tabela produtos, onde cada id representa um produto feito.',
  `decricao` varchar(80) NOT NULL COMMENT 'descrição do produto feito'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela que identifica o produto feito ';

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto_maquina`
--

CREATE TABLE `produto_maquina` (
  `idProduto` int(11) NOT NULL COMMENT 'PK/FK Chave composta que relaciona id da tabela produtos com uma id da tabela de maquinas',
  `idMaquina` int(11) NOT NULL COMMENT 'PK/FK Chave composta que relaciona id da tabela maquinas com uma id da tabela de produtos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela associativa que relaciona uma maquina a um produto ';

-- --------------------------------------------------------

--
-- Estrutura para tabela `receitas`
--

CREATE TABLE `receitas` (
  `idReceita` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `observacoes` varchar(50) DEFAULT NULL,
  `idProduto` int(11) NOT NULL,
  `idMateriaPrima` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipos_ferramental`
--

CREATE TABLE `tipos_ferramental` (
  `idTiposFerramental` int(11) NOT NULL COMMENT 'PK - chave identificadora das ids dos tipos de moldes das maquinas.',
  `descricao` varchar(50) NOT NULL COMMENT 'Descrição do molde a ser usado(Nome e algumas observações).'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela de registro dos tipos de moldes usados no laboratório';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_materia_prima`
--

CREATE TABLE `tipo_materia_prima` (
  `idTipoMateriaPrima` int(11) NOT NULL COMMENT 'PK - chave identificadora de id dos tipos de matéria prima',
  `descricao` varchar(32) NOT NULL COMMENT 'Descrição dos tipos de matéria prima(virgem, reciclado, remoído, scrap);'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela identificadora dos tipos de matéria prima ';

--
-- Despejando dados para a tabela `tipo_materia_prima`
--

INSERT INTO `tipo_materia_prima` (`idTipoMateriaPrima`, `descricao`) VALUES
(1, 'Virgem'),
(2, 'Reciclado'),
(3, 'Remoido'),
(4, 'Scrap');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_pigmentos`
--

CREATE TABLE `tipo_pigmentos` (
  `idTipoPigmento` int(11) NOT NULL COMMENT 'PK - codigo identificador dos tipos de pigmentos',
  `descricao` varchar(80) NOT NULL COMMENT 'descricao do tipo pigmento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `turma`
--

CREATE TABLE `turma` (
  `idTurma` int(11) NOT NULL COMMENT 'PK - chave identificadora da turma a qual o usuário pertence\r\nOBS: o admin não necessita estar em uma turma',
  `turno` char(1) DEFAULT NULL COMMENT 'Mostra a qual turno uma turma pertence',
  `nomeTurma` varchar(32) DEFAULT NULL COMMENT 'Nome da turma. \r\nEx: TDesi Senai/N1',
  `ativo` char(1) DEFAULT NULL COMMENT 'Se a conta podea ou não pode ser usada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela que salva as informações sobre a turma dos usuários ';

--
-- Despejando dados para a tabela `turma`
--

INSERT INTO `turma` (`idTurma`, `turno`, `nomeTurma`, `ativo`) VALUES
(1, 'N', 'T DESI 2022', 'S');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL COMMENT 'Pk - Chave identificadora dos usuários que farão uso do sistema',
  `login` varchar(50) NOT NULL COMMENT 'Identificação de login do usuário',
  `senha` varchar(32) NOT NULL COMMENT 'Senha de acesso ao sistema para o usuário.',
  `nome` varchar(80) NOT NULL COMMENT 'Nome do usuário.',
  `sobrenome` varchar(80) NOT NULL COMMENT 'Registra o sobrenome do usuários',
  `idTurma` int(11) NOT NULL COMMENT 'FK - Chave estrangeira da tabela turma que permite ver a qual turma um usuário está cadastrado.',
  `tipo` tinyint(1) NOT NULL COMMENT 'Nível de acesso dos usuários:\r\nadministrador(1);\r\nusuário comum(2).  ',
  `ativo` char(1) NOT NULL COMMENT 'Serve para ver se uma conta ainda está ativa.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela de registro dos usuários cadastrados  no sistema';

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `login`, `senha`, `nome`, `sobrenome`, `idTurma`, `tipo`, `ativo`) VALUES
(1, 'a@teste.com', '202cb962ac59075b964b07152d234b70', 'Luis', 'Fernando Pereira', 1, 1, 'S'),
(2, 'b@teste.com', '202cb962ac59075b964b07152d234b70', 'Marco', 'dos Santos', 1, 2, 'S'),
(3, 'c@teste.com', '202cb962ac59075b964b07152d234b70', 'Teste', 'Testudo de teste', 1, 2, 'N');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `classe_material`
--
ALTER TABLE `classe_material`
  ADD PRIMARY KEY (`idClasse`);

--
-- Índices de tabela `ferramental_maquna`
--
ALTER TABLE `ferramental_maquna`
  ADD PRIMARY KEY (`idFerramental`,`idMaquina`),
  ADD KEY `FK_idMaquina` (`idMaquina`),
  ADD KEY `FK_idFerramental` (`idFerramental`);

--
-- Índices de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`idFornecedor`);

--
-- Índices de tabela `maquinas`
--
ALTER TABLE `maquinas`
  ADD PRIMARY KEY (`idMaquina`);

--
-- Índices de tabela `materia_fornecedor`
--
ALTER TABLE `materia_fornecedor`
  ADD PRIMARY KEY (`idMateriaPrima`,`idFornecedor`),
  ADD KEY `FK_idMateriaPrima` (`idMateriaPrima`),
  ADD KEY `FK_idFornecedor` (`idFornecedor`);

--
-- Índices de tabela `materia_pigmento`
--
ALTER TABLE `materia_pigmento`
  ADD PRIMARY KEY (`idMateriaPrima`,`idPigmento`),
  ADD KEY `FK_id_pigmento` (`idPigmento`),
  ADD KEY `FK_idMateriaPrima` (`idMateriaPrima`);

--
-- Índices de tabela `materia_prima`
--
ALTER TABLE `materia_prima`
  ADD PRIMARY KEY (`idMateriaPrima`),
  ADD KEY `FK_idClasse` (`idClasse`),
  ADD KEY `FK_idTipoMateria` (`idTipoMateriaPrima`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `FK_idProduto` (`idProduto`),
  ADD KEY `FK_idUsuario` (`idUsuario`);

--
-- Índices de tabela `pigmentos`
--
ALTER TABLE `pigmentos`
  ADD PRIMARY KEY (`idPigmento`),
  ADD KEY `FK_idTipoPigmento` (`idTipoPigmento`);

--
-- Índices de tabela `pigmento_fornecedor`
--
ALTER TABLE `pigmento_fornecedor`
  ADD PRIMARY KEY (`idPigmentos`,`idFornecedor`),
  ADD KEY `FK_idPigmento` (`idPigmentos`),
  ADD KEY `FK_idFornecedor` (`idFornecedor`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idProduto`);

--
-- Índices de tabela `produto_maquina`
--
ALTER TABLE `produto_maquina`
  ADD PRIMARY KEY (`idProduto`,`idMaquina`),
  ADD KEY `FK_idMaquina` (`idMaquina`),
  ADD KEY `FK_idProduto` (`idProduto`);

--
-- Índices de tabela `receitas`
--
ALTER TABLE `receitas`
  ADD PRIMARY KEY (`idReceita`),
  ADD KEY `FK_idMateriaPrima` (`idMateriaPrima`),
  ADD KEY `FK_idProduto` (`idProduto`);

--
-- Índices de tabela `tipos_ferramental`
--
ALTER TABLE `tipos_ferramental`
  ADD PRIMARY KEY (`idTiposFerramental`);

--
-- Índices de tabela `tipo_materia_prima`
--
ALTER TABLE `tipo_materia_prima`
  ADD PRIMARY KEY (`idTipoMateriaPrima`);

--
-- Índices de tabela `tipo_pigmentos`
--
ALTER TABLE `tipo_pigmentos`
  ADD PRIMARY KEY (`idTipoPigmento`);

--
-- Índices de tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`idTurma`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `FK_idTurma` (`idTurma`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `classe_material`
--
ALTER TABLE `classe_material`
  MODIFY `idClasse` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora que guarda a id de cada classe da matéria prima', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `idFornecedor` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora das ids de cada fornecedor';

--
-- AUTO_INCREMENT de tabela `maquinas`
--
ALTER TABLE `maquinas`
  MODIFY `idMaquina` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora das maquinas usadas para fazer os produtos';

--
-- AUTO_INCREMENT de tabela `materia_prima`
--
ALTER TABLE `materia_prima`
  MODIFY `idMateriaPrima` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora das matérias primas salvas no estoque ', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da tabela Pedidos.';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;