--
-- Banco de dados: `gerci`
--

create database gerci;
-- --------------------------------------------------------

--
-- Estrutura para tabela `maquinas`
--

CREATE TABLE IF NOT EXISTS `maquinas` (
`id` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `local` varchar(30) NOT NULL,
  `descricao` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices de tabela `maquinas`
--
ALTER TABLE `maquinas`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabela `maquinas`
--
ALTER TABLE `maquinas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
