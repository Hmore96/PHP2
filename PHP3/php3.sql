-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Apr 2024 um 20:13
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `php3`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `id` int(10) UNSIGNED NOT NULL,
  `benutzername` varchar(255) NOT NULL,
  `passwort` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`id`, `benutzername`, `passwort`, `email`) VALUES
(1, 'Markus', '$2y$10$XMQxpfZeExzUPB0sgYsGdeb8MwK9FQda/oH/.PpmRrMr7CpFFzCl2', 'wifi@diebeiden.at');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fahrzeuge`
--

CREATE TABLE `fahrzeuge` (
  `id` int(10) UNSIGNED NOT NULL,
  `kennzeichen` varchar(50) NOT NULL,
  `marken_id` int(10) UNSIGNED NOT NULL,
  `farbe` varchar(255) NOT NULL,
  `baujahr` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `fahrzeuge`
--

INSERT INTO `fahrzeuge` (`id`, `kennzeichen`, `marken_id`, `farbe`, `baujahr`) VALUES
(1, 'S-345JK', 7, 'Blau', '0000'),
(2, 'SL-456DK', 6, 'Grau', '2005'),
(3, 'S-320OK', 7, 'Lila', '2020'),
(4, 'VB-777VK', 6, 'Weiss', '2017'),
(5, 'S-300UB', 1, 'Grün', '2021');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `marken`
--

CREATE TABLE `marken` (
  `id` int(10) UNSIGNED NOT NULL,
  `hersteller` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `marken`
--

INSERT INTO `marken` (`id`, `hersteller`) VALUES
(1, 'Volkswagen'),
(2, 'BMW'),
(5, 'Toyota'),
(6, 'Nissan'),
(7, 'Opel'),
(8, 'AUDI');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `benutzername` (`benutzername`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indizes für die Tabelle `fahrzeuge`
--
ALTER TABLE `fahrzeuge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marken_id` (`marken_id`);

--
-- Indizes für die Tabelle `marken`
--
ALTER TABLE `marken`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `fahrzeuge`
--
ALTER TABLE `fahrzeuge`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `marken`
--
ALTER TABLE `marken`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `fahrzeuge`
--
ALTER TABLE `fahrzeuge`
  ADD CONSTRAINT `fahrzeuge_ibfk_1` FOREIGN KEY (`marken_id`) REFERENCES `marken` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
