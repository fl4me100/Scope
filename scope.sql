-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Dez-2024 às 14:56
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `scope`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `icons`
--

CREATE TABLE `icons` (
  `id` int(100) NOT NULL,
  `icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `icons`
--

INSERT INTO `icons` (`id`, `icon`) VALUES
(1, 'https://mrwallpaper.com/images/hd/horror-film-s-ghostface-pfp-wq62a61lyr53z7op.jpg'),
(2, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTiHnhUUHR6VPYuAr7oI4XB4BqsphIQekMYQg&s'),
(3, 'https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/69d79c77-7a14-4d6e-a6e4-6aadb16f4fdb/dg0fvry-5596c210-24b6-44b7-b55d-5a1c6215e54c.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzY5ZDc5Yzc3LTdhMTQtNGQ2ZS1hNmU0LTZhYWRiMTZmNGZkYlwvZGcwZnZyeS01NTk2YzIxMC0yNGI2LTQ0YjctYjU1ZC01YTFjNjIxNWU1NGMuanBnIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.3zDLUnQEcBcrq-uHAd60LkqBHlA5feyeIMTkPDsJdSM'),
(4, 'https://avatarfiles.alphacoders.com/326/326622.jpg'),
(5, 'https://i.pinimg.com/736x/23/81/68/238168f37a4180e4203ac867a108f166.jpg'),
(6, 'https://avatarfiles.alphacoders.com/240/thumb-1920-240676.jpg'),
(7, 'https://avatarfiles.alphacoders.com/324/thumb-1920-324856.jpg'),
(8, 'https://avatarfiles.alphacoders.com/172/thumb-1920-172286.jpg'),
(9, 'https://avatarfiles.alphacoders.com/336/thumb-1920-336818.jpg'),
(10, 'https://avatarfiles.alphacoders.com/919/91901.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id` int(11) NOT NULL,
  `nome` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `foto_perfil` int(2) NOT NULL,
  `1` text NOT NULL,
  `2` text NOT NULL,
  `3` text NOT NULL,
  `4` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`id`, `nome`, `email`, `password`, `foto_perfil`, `1`, `2`, `3`, `4`) VALUES
(1, 'topzao', 'asd@asd.pt', '12345678', 0, '', '', '', ''),
(2, 'asd', 'q@q.qq', '$2y$10$3HAEXvI78ES3BU/dUFhPLOf69QnOe/4RbgKhRyWSyAK3YpH/Y4JIm', 0, '', '', '', ''),
(3, 'qwe', 'qwe@qwe.qwe', '87654321', 0, '', '', '', ''),
(4, 'sheesh', '12@12.com', '$2y$10$VnEmOTL9GyJYUD/uZmamIedMlBG.HHUgxzvaUP6AlrWzy9NnJHJky', 0, '', '', '', ''),
(6, 'nuno', 'eu@eu.com', '$2y$10$KFE4EuVdxWP/5Ki6HenGUu6KxrxcJPIH0DYquB7fF4qj4tL9CxL8u', 0, '', '', '', ''),
(9, 'tu', 'omg@omg.omg', '$2y$10$KywyJx6GfdNbwvSXvZcrVelBR75K0/Gd7iYxU8AJHi69CiIpsWDGm', 3, 'Barb', '', '', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `icons`
--
ALTER TABLE `icons`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `icons`
--
ALTER TABLE `icons`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
