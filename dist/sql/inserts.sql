#delete from usuarios;
#delete from turma;
#delete from materia_prima;
#delete from tipo_materia_prima;
#delete from classe_material;
#delete from materia_prima;

#drop database lab_plasticos;
#create database lab_plasticos;
#use lab_plasticos;

INSERT INTO `tipo_pigmentos` (`descricao`, `ativo`) VALUES
(1,'MB',1),
(2,'MTB',1);

INSERT INTO `pigmentos` (`descricao`, `idTipoPigmento`, `quantidade`, `codigo`, `lote`, `ativo`, `observacoes`) VALUES
(1,'Verde claro', 1, 200, '5415466','B/656482',1,''),
(2,'Azul escuro', 2, 245, '48684Ad874','C/64882',1,''),
(3,'Vermelho', 1, 300, '94686545','A/48654',1,''); 

INSERT INTO `turma` (`idTurma`,`turno`, `nomeTurma`, `ativo`) VALUES
(1,'N', 'T DESI 2022', 'S'),
(2,'M','Estilos de Moda','S'),
(3,'V','Mecânica','S');

INSERT INTO `usuarios` (`idUsuario`,`login`, `senha`, `nome`, `sobrenome`, `idTurma`, `tipo`, `ativo`) VALUES
(1,'a@teste.com', '202cb962ac59075b964b07152d234b70', 'Luis', 'Fernando Pereira', 1, 1, 'S'),
(2,'b@teste.com', '202cb962ac59075b964b07152d234b70', 'Marco', 'dos Santos', 1, 2, 'S'),
(3,'c@teste.com', '202cb962ac59075b964b07152d234b70', 'Teste', 'Testudo de teste', 1, 2, 'N');

INSERT INTO `tipo_materia_prima` (`idTipoMateriaPrima`,`descricao`,`ativo`) VALUES
(1,'Virgem',1),
(2,'Reciclado',1),
(3,'Remoido',1),
(4,'Scrap',1);

INSERT INTO `classe_material` (`idClasse`,`descricao`,`ativo`) VALUES
(1,'Comodities',1),
(2,'Engenharia',1);

INSERT INTO `materia_prima` (`idMateriaPrima`,`idClasse`, `idTipoMateriaPrima`, `descricao`, `quantidade`,`ativo`) VALUES
(1,1, 2, 'plastico', 500,1),
(2,1, 1, 'Polistileno', 300,1),
(3,2, 4, 'Polioneto de carbonato', 400,1),
(4,1, 3, 'Sódio', 200,1),
(5,2, 1, 'Polistileno', 100,1),
(6,2, 3, 'Exopor', 50,1),
(7,1, 1, 'Java', 1,1);